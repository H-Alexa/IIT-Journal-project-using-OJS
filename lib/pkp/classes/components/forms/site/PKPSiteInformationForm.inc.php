<?php
/**
 * @file classes/components/form/site/PKPSiteInformationForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPSiteInformationForm
 * @ingroup classes_controllers_form
 *
 * @brief A preset form for the site information settings.
 */
namespace PKP\components\forms\site;
use \PKP\components\forms\FormComponent;
use \PKP\components\forms\FieldRichTextarea;
use \PKP\components\forms\FieldText;

define('FORM_SITE_INFO', 'siteInfo');

class PKPSiteInformationForm extends FormComponent {
	/** @copydoc FormComponent::$id */
	public $id = FORM_SITE_INFO;

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

		$this->addField(new FieldRichTextarea('about', [
				'label' => __('admin.settings.about'),
				'isMultilingual' => true,
				'value' => $site->getData('about'),
			]))
			->addField(new FieldText('contactName', [
				'label' => __('admin.settings.contactName'),
				'isRequired' => true,
				'isMultilingual' => true,
				'value' => $site->getData('contactName'),
			]))
			->addField(new FieldText('contactEmail', [
				'label' => __('admin.settings.contactEmail'),
				'isRequired' => true,
				'isMultilingual' => true,
				'value' => $site->getData('contactEmail'),
			]))
			->addField(new FieldRichTextarea('privacyStatement', [
				'label' => __('manager.setup.privacyStatement'),
				'description' => __('manager.setup.privacyStatement.description'),
				'isMultilingual' => true,
				'value' => $site->getData('privacyStatement'),
			]));
	}
}
