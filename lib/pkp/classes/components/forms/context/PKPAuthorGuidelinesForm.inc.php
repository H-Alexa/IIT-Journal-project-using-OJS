<?php
/**
 * @file classes/components/form/context/PKPAuthorGuidelinesForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPAuthorGuidelinesForm
 * @ingroup classes_controllers_form
 *
 * @brief A preset form for author submission guidance settings.
 */
namespace PKP\components\forms\context;
use \PKP\components\forms\FormComponent;
use \PKP\components\forms\FieldRichTextarea;

define('FORM_AUTHOR_GUIDELINES', 'authorGuidelines');

class PKPAuthorGuidelinesForm extends FormComponent {
	/** @copydoc FormComponent::$id */
	public $id = FORM_AUTHOR_GUIDELINES;

	/** @copydoc FormComponent::$method */
	public $method = 'PUT';

	/**
	 * Constructor
	 *
	 * @param $action string URL to submit the form to
	 * @param $locales array Supported locales
	 * @param $context Context Journal or Press to change settings for
	 */
	public function __construct($action, $locales, $context) {
		$this->action = $action;
		$this->locales = $locales;

		$this->addField(new FieldRichTextarea('authorGuidelines', [
				'label' => __('manager.setup.authorGuidelines'),
				'description' => __('manager.setup.authorGuidelines.description'),
				'isMultilingual' => true,
				'value' => $context->getData('authorGuidelines'),
				'toolbar' => 'bold italic superscript subscript | link | blockquote bullist numlist',
				'plugins' => 'paste,link,lists',
			]))
			->addField(new FieldRichTextarea('copyrightNotice', [
				'label' => __('manager.setup.copyrightNotice'),
				'description' => __('manager.setup.copyrightNotice.description'),
				'isMultilingual' => true,
				'value' => $context->getData('copyrightNotice'),
				'toolbar' => 'bold italic superscript subscript | link | blockquote bullist numlist',
				'plugins' => 'paste,link,lists',
			]));
	}
}
