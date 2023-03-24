<?php
/**
 * @file classes/components/form/site/PKPSiteConfigForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPSiteConfigForm
 * @ingroup classes_controllers_form
 *
 * @brief A preset form for the site config settings.
 */
namespace PKP\components\forms\site;
use \PKP\components\forms\FormComponent;
use \PKP\components\forms\FieldSelect;
use \PKP\components\forms\FieldText;

define('FORM_SITE_CONFIG', 'siteConfig');

class PKPSiteConfigForm extends FormComponent {
	/** @copydoc FormComponent::$id */
	public $id = FORM_SITE_CONFIG;

	/** @copydoc FormComponent::$method */
	public $method = 'PUT';

	/**
	 * Constructor
	 *
	 * @param $action string URL to submit the form to
	 * @param $locales array Supported locales
	 * @param $site Site
	 */
	public function __construct($action, $locales, $site) {
		$this->action = $action;
		$this->locales = $locales;

		$contextsIterator = \Services::get('context')->getMany(['isEnabled' => true]);

		$this->addField(new FieldText('title', [
			'label' => __('admin.settings.siteTitle'),
			'isRequired' => true,
			'isMultilingual' => true,
			'value' => $site->getData('title'),
		]));

		$options = [['value' => '', 'label' => '']];
		foreach ($contextsIterator as $context) {
			$options[] = [
				'value' => $context->getId(),
				'label' => $context->getLocalizedData('name'),
			];
		}
		if (count($options) > 1) $this->addField(new FieldSelect('redirect', [
			'label' => __('admin.settings.redirect'),
			'description' => __('admin.settings.redirectInstructions'),
			'options' => $options,
			'value' => $site->getData('redirect'),
		]));

		$this->addField(new FieldText('minPasswordLength', [
			'label' => __('admin.settings.minPasswordLength'),
			'isRequired' => true,
			'size' => 'small',
			'value' => $site->getData('minPasswordLength'),
		]));
	}
}
