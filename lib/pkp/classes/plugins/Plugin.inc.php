<?php

/**
 * @defgroup plugins Plugins
 * Implements a plugin structure that can be used to flexibly extend PKP
 * software via the use of a set of plugin categories.
 */

/**
 * @file classes/plugins/Plugin.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class Plugin
 * @ingroup plugins
 * @see PluginRegistry, PluginSettingsDAO
 *
 * @brief Abstract class for plugins
 *
 * For best performance, a plug-in should not be instantiated if it is
 * disabled or the current page/operation does not require the plug-in's
 * functionality.
 *
 * Newer plug-ins support enable/disable and request filter settings that
 * enable the PKP library plug-in framework to lazy-load plug-ins only
 * when their functionality is actually being required for a request.
 *
 * For backwards compatibility we need to assume that older plug-ins
 * do not support lazy-load because their register() method and hooks
 * may have side-effects required on all requests. We have no way of
 * knowing on which pages these side effects are important so we need
 * to load legacy plug-ins on all pages.
 *
 * In these cases the register() function will be called on every request
 * when the category the plug-in belongs to is being loaded. This was the
 * default behavior before plug-in lazy load was introduced.
 *
 * Plug-ins that want to enable lazy-load have to include a 'lazy-load'
 * setting in their version.xml:
 *
 *  <lazy-load>1</lazy-load>
 */


// Define the well-known file name for filter configuration data.
define('PLUGIN_FILTER_DATAFILE', 'filterConfig.xml');
define('PLUGIN_TEMPLATE_RESOURCE_PREFIX', 'plugins');

abstract class Plugin {
	/** @var string Path name to files for this plugin */
	var $pluginPath;

	/** @var string Category name this plugin is registered to*/
	var $pluginCategory;

	/** @var PKPRequest the current request object */
	var $request;

	/**
	 * Constructor
	 */
	function __construct() {
	}

	/*
	 * Public Plugin API (Registration and Initialization)
	 */
	/**
	 * Load and initialize the plug-in and register plugin hooks.
	 *
	 * For backwards compatibility this method will be called whenever
	 * the plug-in's category is being loaded. If, however, registerOn()
	 * returns an array then this method will only be called when
	 * the plug-in is enabled and an entry in the result set of
	 * registerOn() matches the current request operation. An empty array
	 * matches all request operations.
	 *
	 * @param $category String Name of category plugin was registered to
	 * @param $path String The path the plugin was found in
	 * @param $mainContextId integer To identify if the plugin is enabled
	 *  we need a context. This context is usually taken from the
	 *  request but sometimes there is no context in the request
	 *  (e.g. when executing CLI commands). Then the main context
	 *  can be given as an explicit ID.
	 * @return boolean True iff plugin registered successfully; if false,
	 * 	the plugin will not be executed.
	 */
	function register($category, $path, $mainContextId = null) {
		$this->pluginPath = $path;
		$this->pluginCategory = $category;
		if ($this->getInstallMigration()) {
			HookRegistry::register ('Installer::postInstall', [$this, 'updateSchema']);
		}
		if ($this->getInstallSitePluginSettingsFile()) {
			HookRegistry::register ('Installer::postInstall', [$this, 'installSiteSettings']);
		}
		if ($this->getInstallControlledVocabFiles()) {
			HookRegistry::register ('Installer::postInstall', [$this, 'installControlledVocabs']);
		}
		if ($this->getInstallEmailTemplatesFile()) {
			HookRegistry::register ('Installer::postInstall', [$this, 'installEmailTemplates']);
			HookRegistry::register ('PKPLocale::installLocale', [$this, 'installLocale']);
		}
		if ($this->getInstallEmailTemplateDataFile()) {
			HookRegistry::register ('Installer::postInstall', [$this, 'installEmailTemplateData']);
		}
		if ($this->getContextSpecificPluginSettingsFile()) {
			HookRegistry::register ('Context::add', [$this, 'installContextSpecificSettings']);
		}

		HookRegistry::register ('Installer::postInstall', [$this, 'installFilters']);

		$this->_registerTemplateResource();
		return true;
	}

	/**
	 * Protected methods (may be overridden by custom plugins)
	 */

	//
	// Plugin Display
	//

	/**
	 * Get the name of this plugin. The name must be unique within
	 * its category, and should be suitable for part of a filename
	 * (ie short, no spaces, and no dependencies on cases being unique).
	 *
	 * @return string name of plugin
	 */
	abstract function getName();

	/**
	 * Get the display name for this plugin.
	 *
	 * @return string
	 */
	abstract function getDisplayName();

	/**
	 * Get a description of this plugin.
	 *
	 * @return string
	 */
	abstract function getDescription();

	//
	// Plugin Behavior and Management
	//

	/**
	 * Return a number indicating the sequence in which this plugin
	 * should be registered compared to others of its category.
	 * Higher = later.
	 *
	 * @return integer
	 */
	function getSeq() {
		return 0;
	}

	/**
	 * Site-wide plugins should override this function to return true.
	 *
	 * @return boolean
	 */
	function isSitePlugin() {
		return false;
	}

	/**
	 * Perform a management function.
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage A JSON-encoded response
	 */
	function manage($args, $request) {
		throw new Exception('Unhandled management action!');
	}

	/**
	 * Determine whether or not this plugin should be hidden from the
	 * management interface. Useful in the case of derivative plugins,
	 * i.e. when a generic plugin registers a feed plugin.
	 *
	 * @return boolean
	 */
	function getHideManagement() {
		return false;
	}

	//
	// Plugin Installation
	//

	/**
	 * @deprecated See https://github.com/pkp/pkp-lib/issues/2493
	 */
	final public function getInstallSchemaFile() {
	}

	/**
	 * Get the installation migration for this plugin.
	 * @return Illuminate\Database\Migrations\Migration?
	 */
	function getInstallMigration() {
		return null;
	}

	/**
	 * Get the filename of the settings data for this plugin to install
	 * when the system is installed (i.e. site-level plugin settings).
	 * Subclasses using default settings should override this.
	 *
	 * @return string
	 */
	function getInstallSitePluginSettingsFile() {
		return null;
	}

	/**
	 * Get the filename of the controlled vocabulary for this plugin to
	 * install when the system is installed. Null if none included.
	 * @return array|null Filename of controlled vocabs XML file.
	 */
	function getInstallControlledVocabFiles() {
		return array();
	}

	/**
	 * Get the filename of the settings data for this plugin to install
	 * when a new application context (e.g. journal, conference or press)
	 * is installed.
	 *
	 * Subclasses using default settings should override this.
	 *
	 * @return string
	 */
	function getContextSpecificPluginSettingsFile() {
		return null;
	}

	/**
	 * Get the filename of the email templates for this plugin.
	 * Subclasses using email templates should override this.
	 *
	 * @return string
	 */
	function getInstallEmailTemplatesFile() {
		return null;
	}

	/**
	 * Get the filename of the email template data for this plugin.
	 * Subclasses using email templates should override this.
	 * @deprecated Starting with OJS/OMP 3.2, localized content should be
	 *  specified via getInstallEmailTemplatesFile(). (pkp/pkp-lib#5461)
	 *
	 * @return string
	 */
	function getInstallEmailTemplateDataFile() {
		return null;
	}

	/**
	 * Get the filename(s) of the filter configuration data for
	 * this plugin. Subclasses using filters can override this.
	 *
	 * The default implementation establishes "well known" locations
	 * for the filter configuration. If you keep your files in these
	 * locations then there's no need to override this method.
	 *
	 * @return string|array one or more file locations.
	 */
	function getInstallFilterConfigFiles() {
		// Construct the well-known filter configuration file names.
		$filterConfigFile = $this->getPluginPath().'/filter/'.PLUGIN_FILTER_DATAFILE;
		$filterConfigFiles = array(
			'./lib/pkp/'.$filterConfigFile,
			'./'.$filterConfigFile
		);
		return $filterConfigFiles;
	}

	/*
	 * Protected helper methods (can be used by custom plugins but
	 * should not be overridden by custom plugins)
	 */
	/**
	 * Get the name of the category this plugin is registered to.
	 * @return String category
	 */
	function getCategory() {
		return $this->pluginCategory;
	}

	/**
	 * Get the path this plugin's files are located in.
	 * @return String pathname
	 */
	function getPluginPath() {
		return $this->pluginPath;
	}

	/**
	 * Get the directory name of the plugin
	 * @return String directory name
	 */
	function getDirName() {
		return basename($this->pluginPath);
	}

	/**
	 * Return the Resource Name for templates in this plugin, or if specified, the full resource locator
	 * for a specific template.
	 * @param $template Template path/filename, if desired
	 * @param $inCore boolean True if a "core" template should be used.
	 * @return string
	 */
	public function getTemplateResource($template = null, $inCore = false) {
		$pluginPath = $this->getPluginPath();
		if ($inCore) {
			$pluginPath = PKP_LIB_PATH . DIRECTORY_SEPARATOR . $pluginPath;
		}
		$plugin = basename($pluginPath);
		$category = basename(dirname($pluginPath));

		$contextId = CONTEXT_SITE;
		if (Config::getVar('general', 'installed')) {
			$context = Application::get()->getRequest()->getContext();
			if (is_a($context, 'Context')) $contextId = $context->getId();
		}

		// Slash characters (/) are not allowed in resource names, so use dashes (-) instead.
		$resourceName = strtr(join('/', array(PLUGIN_TEMPLATE_RESOURCE_PREFIX, $contextId, $pluginPath, $category, $plugin)),'/','-');
		return $resourceName . ($template!==null?":$template":'');
	}

	/**
	 * Return the canonical template path of this plug-in
	 * @param $inCore Return the core template path if true.
	 * @return string|null
	 */
	function getTemplatePath($inCore = false) {
		$templatePath = ($inCore?PKP_LIB_PATH . DIRECTORY_SEPARATOR:'') . $this->getPluginPath() . DIRECTORY_SEPARATOR . 'templates';
		if (is_dir($templatePath)) return $templatePath;
		return null;
	}

	/**
	 * Register this plugin's templates as a template resource
	 * @param $inCore boolean True iff this is a core resource.
	 */
	protected function _registerTemplateResource($inCore = false) {
		if ($templatePath = $this->getTemplatePath($inCore)) {
			$templateMgr = TemplateManager::getManager();
			$pluginTemplateResource = new PKPTemplateResource($templatePath);
			$templateMgr->registerResource($this->getTemplateResource(null, $inCore), $pluginTemplateResource);
		}
	}

	/**
	 * Call this method when an enabled plugin is registered in order to override
	 * template files. Any plugin which calls this method can
	 * override template files by adding their own templates to:
	 * <overridingPlugin>/templates/plugins/<category>/<originalPlugin>/templates/<path>.tpl
	 *
	 * @param $hookName string TemplateResource::getFilename
	 * @param $args array [
	 *		@option string File path to preferred template. Leave as-is to not
	 *			override template.
	 *		@option string Template file requested
	 * ]
	 * @return boolean
	 */
	public function _overridePluginTemplates($hookName, $args) {
		$filePath =& $args[0];
		$template = $args[1];
		$checkFilePath = $filePath;

		// If there's a templates/ prefix on the template, clean up the test path.
		if (strpos($filePath, 'plugins/') === 0) $checkFilePath = 'templates/' . $checkFilePath;

		// If there's a lib/pkp/ prefix on the template, test without it.
		$libPkpPrefix = 'lib' . DIRECTORY_SEPARATOR . 'pkp' . DIRECTORY_SEPARATOR;
		if (strpos($checkFilePath, $libPkpPrefix) === 0) $checkFilePath = substr($filePath, strlen($libPkpPrefix));

		// Check if an overriding plugin exists in the plugin path.
		if ($overriddenFilePath = $this->_findOverriddenTemplate($checkFilePath)) {
			$filePath = $overriddenFilePath;
		}

		return false;
	}

	/**
	 * Recursive check for existing templates
	 * @param $path string
	 * @return string|null
	 */
	private function _findOverriddenTemplate($path) {
		$fullPath = sprintf('%s/%s', $this->getPluginPath(), $path);

		if (file_exists($fullPath)) {
			return $fullPath;
		}

		// Backward compatibility for OJS prior to 3.1.2; changed path to templates for plugins.
		if (($fullPath = preg_replace("/templates\/(?!.*templates\/)/", "", $fullPath)) && file_exists($fullPath)) {
			if (Config::getVar('debug', 'deprecation_warnings')) {
				trigger_error('Deprecated: The template at ' . $fullPath . ' has moved and will not be found in the future.');
			}
			return $fullPath;
		}

		// Recursive check for templates in ancestors of a current theme plugin
		if (is_a($this, 'ThemePlugin')
			&& $this->parent
			&& $fullPath = $this->parent->_findOverriddenTemplate($path)) {
			return $fullPath;
		}

		return null;
	}

	/**
	 * Load locale data for this plugin.
	 *
	 * @param $locale string|null
	 * @return boolean
	 */
	function addLocaleData($locale = null) {
		$locale = $locale ?? AppLocale::getLocale();
		if ($localeFilenames = $this->getLocaleFilename($locale)) {
			foreach((array) $localeFilenames as $localeFilename) {
				AppLocale::registerLocaleFile($locale, $localeFilename);
			}
			return true;
		}
		return false;
	}

	/**
	 * Retrieve a plugin setting within the given context
	 *
	 * @param $contextId int Context ID
	 * @param $name string Setting name
	 */
	function getSetting($contextId, $name) {
		if (!defined('RUNNING_UPGRADE') && !Config::getVar('general', 'installed')) return null;

		// Construct the argument list and call the plug-in settings DAO
		$arguments = array(
			$contextId,
			$this->getName(),
			$name,
		);

		$pluginSettingsDao = DAORegistry::getDAO('PluginSettingsDAO'); /* @var $pluginSettingsDao PluginSettingsDAO */
		return call_user_func_array(array(&$pluginSettingsDao, 'getSetting'), $arguments);
	}

	/**
	 * Update a plugin setting within the given context.
	 *
	 * @param $contextId int Context ID
	 * @param $name string The name of the setting
	 * @param $value mixed Setting value
	 * @param $type string optional
	 */
	function updateSetting($contextId, $name, $value, $type = null) {

		// Construct the argument list and call the plug-in settings DAO
		$arguments = array(
			$contextId,
			$this->getName(),
			$name,
			$value,
			$type,
		);

		$pluginSettingsDao = DAORegistry::getDAO('PluginSettingsDAO'); /* @var $pluginSettingsDao PluginSettingsDAO */
		call_user_func_array(array(&$pluginSettingsDao, 'updateSetting'), $arguments);
	}

	/**
	 * Load a PHP file from this plugin's installation directory.
	 *
	 * @param $class string
	 */
	function import($class) {
		require_once($this->getPluginPath() . '/' . str_replace('.', '/', $class) . '.inc.php');
	}

	/*
	 * Helper methods (for internal use only, should not
	 * be used by custom plug-ins)
	 *
	 * NB: These methods may change without notice in the future!
	 */
	/**
	 * Get the filename for the locale data for this plugin.
	 * (Warning: This function is used by the custom locale plugin)
	 *
	 * @param $locale string
	 * @return array The locale file names.
	 */
	public function getLocaleFilename($locale) {
		$masterLocale = MASTER_LOCALE;
		$baseLocaleFilename = $this->getPluginPath() . "/locale/$locale/locale.po";
		$baseMasterLocaleFilename = $this->getPluginPath() . "/locale/$masterLocale/locale.po";
		$libPkpFilename = "lib/pkp/$baseLocaleFilename";
		$masterLibPkpFilename = "lib/pkp/$baseMasterLocaleFilename";

		return array_filter([
			file_exists($baseMasterLocaleFilename) ? $baseLocaleFilename : false,
			file_exists($masterLibPkpFilename) ? $libPkpFilename : false,
		]);
	}

	/**
	 * Callback used to install settings on system install.
	 *
	 * @param $hookName string
	 * @param $args array
	 * @return boolean
	 */
	function installSiteSettings($hookName, $args) {
		// All contexts are set to zero for site-wide plug-in settings
		$application = Application::get();
		$contextDepth = $application->getContextDepth();
		if ($contextDepth >0) {
			$arguments = array_fill(0, $contextDepth, 0);
		} else {
			$arguments = array();
		}
		$arguments[] = $this->getName();
		$arguments[] = $this->getInstallSitePluginSettingsFile();
		$pluginSettingsDao = DAORegistry::getDAO('PluginSettingsDAO'); /* @var $pluginSettingsDao PluginSettingsDAO */
		call_user_func_array(array(&$pluginSettingsDao, 'installSettings'), $arguments);

		return false;
	}

	/**
	 * Callback used to install controlled vocabularies on system install.
	 * @param $hookName string
	 * @param $args array
	 * @return boolean
	 */
	function installControlledVocabs($hookName, $args) {
		// All contexts are set to zero for site-wide plug-in settings
		$controlledVocabDao = DAORegistry::getDAO('ControlledVocabDAO'); /* @var $controlledVocabDao ControlledVocabDAO */
		foreach ($this->getInstallControlledVocabFiles() as $file) {
			$controlledVocabDao->installXML($file);
		}
		return false;
	}
	/**
	 * Callback used to install settings on new context
	 * (e.g. journal, conference or press) creation.
	 *
	 * @param $hookName string
	 * @param $args array
	 * @return boolean
	 */
	function installContextSpecificSettings($hookName, $args) {
		$context = $args[0];
		$pluginSettingsDao = DAORegistry::getDAO('PluginSettingsDAO'); /* @var $pluginSettingsDao PluginSettingsDAO */
		$pluginSettingsDao->installSettings($context->getId(), $this->getName(), $this->getContextSpecificPluginSettingsFile());
		return false;
	}

	/**
	 * Callback used to install email templates.
	 *
	 * @param $hookName string
	 * @param $args array
	 * @return boolean
	 */
	function installEmailTemplates($hookName, $args) {
		$installer =& $args[0]; /* @var $installer Installer */
		$result =& $args[1];

		// Load email template data as required from the locale files.
		$emailTemplateDao = DAORegistry::getDAO('EmailTemplateDAO'); /* @var $emailTemplateDao EmailTemplateDAO */
		$emailTemplateLocales = [];
		foreach ($installer->installedLocales as $locale) {
			$emailFile = $this->getPluginPath() . "/locale/$locale/emails.po";
			if (!file_exists($emailFile)) continue;
			AppLocale::registerLocaleFile($locale, $emailFile);
			$emailTemplateLocales[] = $locale;
		}
		$sql = $emailTemplateDao->installEmailTemplates($this->getInstallEmailTemplatesFile(), $emailTemplateLocales, true, null, true);

		if ($sql === false) {
			// The template file seems to be invalid.
			$installer->setError(INSTALLER_ERROR_DB, str_replace('{$file}', $this->getInstallEmailTemplatesFile(), __('installer.installParseEmailTemplatesFileError')));
			$result = false;
		} else {
			// Are there any yet uninstalled email templates?
			assert(is_array($sql));
			if (!empty($sql)) {
				// Install templates.
				$result = $installer->executeSQL($sql);
			}
		}
		return false;
	}

	/**
	 * Callback used to install email template data.
	 * @deprecated Email template data should be installed via installEmailTemplates (pkp/pkp-lib#5461)
	 *
	 * @param $hookName string
	 * @param $args array
	 * @return boolean
	 */
	function installEmailTemplateData($hookName, $args) {
		$installer =& $args[0];
		$result =& $args[1];

		$emailTemplateDao = DAORegistry::getDAO('EmailTemplateDAO'); /* @var $emailTemplateDao EmailTemplateDAO */
		foreach ($installer->installedLocales as $locale) {
			$filename = str_replace('{$installedLocale}', $locale, $this->getInstallEmailTemplateDataFile());
			if (!file_exists($filename)) continue;
			$sql = $emailTemplateDao->installEmailTemplateData($filename, $locale, true);
			if ($sql) {
				$result = $installer->executeSQL($sql);
			} else {
				$installer->setError(INSTALLER_ERROR_DB, str_replace('{$file}', $filename, __('installer.installParseEmailTemplatesFileError')));
				$result = false;
			}
		}
		return false;
	}

	/**
	 * Callback used to install email template data on locale install.
	 *
	 * @param $hookName string
	 * @param $args array
	 * @return boolean
	 */
	function installLocale($hookName, $args) {
		$locale =& $args[0];
		$filename = str_replace('{$installedLocale}', $locale, $this->getInstallEmailTemplateDataFile());
		$emailTemplateDao = DAORegistry::getDAO('EmailTemplateDAO'); /* @var $emailTemplateDao EmailTemplateDAO */

		// Since pkp/pkp-lib#5461, there are two ways to specify localized email data in plugins.
		// Install locale data specified in the old form. (Deprecated!)
		if ($this->getInstallEmailTemplateDataFile()) $emailTemplateDao->installEmailTemplateData($filename, $locale);

		// Install locale data specified in the new form.
		if (file_exists($emailFile = $this->getPluginPath() . "/locale/$locale/emails.po")) {
			AppLocale::registerLocaleFile($locale, $emailFile);
			$emailTemplateDao->installEmailTemplateLocaleData($this->getInstallEmailTemplatesFile(), [$locale]);
		}
		return false;
	}

	/**
	 * Callback used to install filters.
	 * @param $hookName string
	 * @param $args array
	 */
	function installFilters($hookName, $args) {
		$installer =& $args[0]; /* @var $installer Installer */
		$result =& $args[1]; /* @var $result boolean */

		// Get the filter configuration file name(s).
		$filterConfigFiles = $this->getInstallFilterConfigFiles();
		if (is_scalar($filterConfigFiles)) $filterConfigFiles = array($filterConfigFiles);

		// Run through the config file positions and see
		// whether one of these exists and needs to be installed.
		foreach($filterConfigFiles as $filterConfigFile) {
			// Is there a filter configuration?
			if (!file_exists($filterConfigFile)) continue;

			// Install the filter configuration.
			$result = $installer->installFilterConfig($filterConfigFile);
			if (!$result) {
				// The filter configuration file seems to be invalid.
				$installer->setError(INSTALLER_ERROR_DB, str_replace('{$file}', $filterConfigFile, __('installer.installParseFilterConfigFileError')));
			}
		}

		// Do not stop installation.
		return false;
	}

	/**
	 * Called during the install process to install the plugin schema,
	 * if applicable.
	 *
	 * @param $hookName string
	 * @param $args array
	 * @return boolean
	 */
	function updateSchema($hookName, $args) {
		$installer =& $args[0];
		$result =& $args[1];

		if ($migration = $this->getInstallMigration()) try {
			$migration->up();
		} catch (Exception $e) {
			$installer->setError(INSTALLER_ERROR_DB, __('installer.installMigrationError', ['class' => get_class($migration)]));
			$result = false;
		}
		return false;
	}

	/**
	 * Extend the {url ...} smarty to support plugins.
	 *
	 * @param $params array
	 * @param $smarty Smarty
	 * @return string
	 */
	function smartyPluginUrl($params, $smarty) {
		$path = array($this->getCategory(), $this->getName());
		if (is_array($params['path'])) {
			$params['path'] = array_merge($path, $params['path']);
		} elseif (!empty($params['path'])) {
			$params['path'] = array_merge($path, array($params['path']));
		} else {
			$params['path'] = $path;
		}
		return $smarty->smartyUrl($params, $smarty);
	}

	/**
	 * Get the current version of this plugin
	 *
	 * @return Version
	 */
	function getCurrentVersion() {
		$versionDao = DAORegistry::getDAO('VersionDAO'); /* @var $versionDao VersionDAO */
		$pluginPath = $this->getPluginPath();
		$product = basename($pluginPath);
		$category = basename(dirname($pluginPath));
		$installedPlugin = $versionDao->getCurrentVersion('plugins.'.$category, $product, true);

		if ($installedPlugin) {
			return $installedPlugin;
		} else {
			return false;
		}
	}

	/**
	 * Get the current request object
	 * @return PKPRequest
	 */
	function &getRequest() {
		if (!$this->request) {
			$this->request =& Registry::get('request');
		}
		return $this->request;
	}

	/*
	 * Private helper methods
	 */
	/**
	 * Get a list of link actions for plugin management.
	 * @param request PKPRequest
	 * @param $actionArgs array The list of action args to be included in request URLs.
	 * @return array List of LinkActions
	 */
	function getActions($request, $actionArgs) {
		return array();
	}

	/**
	 * Determine whether the plugin can be enabled.
	 * @return boolean
	 */
	function getCanEnable() {
		return false;
	}

	/**
	 * Determine whether the plugin can be disabled.
	 * @return boolean
	 */
	function getCanDisable() {
		return false;
	}

	/**
	 * Determine whether the plugin is enabled.
	 * @return boolean
	 */
	function getEnabled() {
		return true;
	}
}
