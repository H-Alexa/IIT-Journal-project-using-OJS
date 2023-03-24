<?php
/**
 * @file classes/components/form/context/MastheadForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class MastheadForm
 * @ingroup classes_controllers_form
 *
 * @brief Add OJS-specific fields to the masthead form.
 */
namespace APP\components\forms\context;
use \PKP\components\forms\context\PKPMastheadForm;
use \PKP\components\forms\FieldText;

class MastheadForm extends PKPMastheadForm {

	/**
	 * @copydoc PKPMastheadForm::__construct()
	 */
	public function __construct($action, $locales, $context, $imageUploadUrl) {
		parent::__construct($action, $locales, $context, $imageUploadUrl);

		$this->addField(new FieldText('abbreviation', [
				'label' => __('manager.setup.journalAbbreviation'),
				'isMultilingual' => true,
				'groupId' => 'identity',
				'value' => $context->getData('abbreviation'),
			]))
			->addGroup([
				'id' => 'publishing',
				'label' => __('manager.setup.publishing'),
				'description' => __('manager.setup.publishingDescription'),
			], [FIELD_POSITION_AFTER, 'identity'])
			->addField(new FieldText('publisherInstitution', [
				'label' => __('manager.setup.publisher'),
				'groupId' => 'publishing',
				'value' => $context->getData('publisherInstitution'),
			]))
			->addField(new FieldText('onlineIssn', [
				'label' => __('manager.setup.onlineIssn'),
				'size' => 'small',
				'groupId' => 'publishing',
				'value' => $context->getData('onlineIssn'),
			]))
			->addField(new FieldText('printIssn', [
				'label' => __('manager.setup.printIssn'),
				'size' => 'small',
				'groupId' => 'publishing',
				'value' => $context->getData('printIssn'),
			]));
	}
}
