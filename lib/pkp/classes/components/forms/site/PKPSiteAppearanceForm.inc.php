<?php
/**
 * @file classes/components/form/site/PKPSiteAppearanceForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPSiteAppearanceForm
 * @ingroup classes_controllers_form
 *
 * @brief A preset form for the site appearance settings.
 */
namespace PKP\components\forms\site;
use \PKP\components\forms\FormComponent;
use \PKP\components\forms\FieldOptions;
use \PKP\components\forms\FieldRichTextarea;
use \PKP\components\forms\FieldUpload;
use \PKP\components\forms\FieldUploadImage;

define('FORM_SITE_APPEARANCE', 'siteAppearance');

class PKPSiteAppearanceForm extends FormComponent {
	/** @copydoc FormComponent::$id */
	public $id = FORM_SITE_APPEARANCE;

	/** @copydoc FormComponent::$method */
	public $method = 'PUT';

	/**
	 * Constructor
	 *
	 * @param $action string URL to submit the form to
	 * @param $locales array Supported locales
	 * @param $site Site
	 * @param $baseUrl string Site's base URL. Used for image previews.
	 * @param $temporaryFileApiUrl string URL to upload files to
	 */
	public function __construct($action, $locales, $site, $baseUrl, $temporaryFileApiUrl) {
		$this->action = $action;
		$this->locales = $locales;

		$sidebarOptions = [];
		$plugins = \PluginRegistry::loadCategory('blocks', true);
		foreach ($plugins as $pluginName => $plugin) {
			$sidebarOptions[] = [
				'value' => $pluginName,
				'label' => $plugin->getDisplayName(),
			];
		}

		$this->addField(new FieldUploadImage('pageHeaderTitleImage', [
				'label' => __('manager.setup.logo'),
				'value' => $site->getData('pageHeaderTitleImage'),
				'isMultilingual' => true,
				'baseUrl' => $baseUrl,
				'options' => [
					'url' => $temporaryFileApiUrl,
				],
			]))
			->addField(new FieldRichTextarea('pageFooter', [
				'label' => __('manager.setup.pageFooter'),
				'description' => __('manager.setup.pageFooter.description'),
				'isMultilingual' => true,
				'value' => $site->getData('pageFooter'),
			]))
			->addField(new FieldOptions('sidebar', [
				'label' => __('manager.setup.layout.sidebar'),
				'isOrderable' => true,
				'value' => (array) $site->getData('sidebar'),
				'options' => $sidebarOptions,
			]))
			->addField(new FieldUpload('styleSheet', [
				'label' => __('admin.settings.siteStyleSheet'),
				'value' => $site->getData('styleSheet'),
				'options' => [
					'url' => $temporaryFileApiUrl,
					'acceptedFiles' => '.css',
				],
			]));
	}
}
