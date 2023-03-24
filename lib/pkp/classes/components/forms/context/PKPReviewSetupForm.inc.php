<?php
/**
 * @file classes/components/form/context/PKPReviewSetupForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPReviewSetupForm
 * @ingroup classes_controllers_form
 *
 * @brief A preset form for configuring review options, such as the default
 *  review type and deadlines.
 */
namespace PKP\components\forms\context;
use \PKP\components\forms\FormComponent;
use \PKP\components\forms\FieldHTML;
use \PKP\components\forms\FieldOptions;
use \PKP\components\forms\FieldText;

define('FORM_REVIEW_SETUP', 'reviewSetup');

class PKPReviewSetupForm extends FormComponent {
	/** @copydoc FormComponent::$id */
	public $id = FORM_REVIEW_SETUP;

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

		// Load SUBMISSION_REVIEW_METHOD_... constants
		import('lib.pkp.classes.submission.reviewAssignment.ReviewAssignment');

		$this->addField(new FieldOptions('defaultReviewMode', [
				'label' => __('manager.setup.reviewOptions.reviewMode'),
				'type' => 'radio',
				'value' => $context->getData('defaultReviewMode'),
				'options' => [
					['value' => SUBMISSION_REVIEW_METHOD_DOUBLEANONYMOUS, 'label' => __('editor.submissionReview.doubleAnonymous')],
					['value' => SUBMISSION_REVIEW_METHOD_ANONYMOUS, 'label' => __('editor.submissionReview.anonymous')],
					['value' => SUBMISSION_REVIEW_METHOD_OPEN, 'label' => __('editor.submissionReview.open')],
				],
			]))
			->addField(new FieldOptions('restrictReviewerFileAccess', [
				'label' => __('manager.setup.reviewOptions.restrictReviewerFileAccess'),
				'type' => 'checkbox',
				'value' => $context->getData('restrictReviewerFileAccess'),
				'options' => [
					['value' => true, 'label' => __('manager.setup.reviewOptions.restrictReviewerFileAccess.description')],
				]
			]))
			->addField(new FieldOptions('reviewerAccessKeysEnabled', [
				'label' => __('manager.setup.reviewOptions.reviewerAccessKeysEnabled'),
				'description' => __('manager.setup.reviewOptions.reviewerAccessKeysEnabled.description'),
				'type' => 'checkbox',
				'value' => $context->getData('reviewerAccessKeysEnabled'),
				'options' => [
					['value' => true, 'label' => __('manager.setup.reviewOptions.reviewerAccessKeysEnabled.label')],
				]
			]))
			->addField(new FieldText('numWeeksPerResponse', [
				'label' => __('manager.setup.reviewOptions.defaultReviewResponseTime'),
				'description' => __('manager.setup.reviewOptions.numWeeksPerResponse'),
				'value' => $context->getData('numWeeksPerResponse'),
				'size' => 'small',
			]))
			->addField(new FieldText('numWeeksPerReview', [
				'label' => __('manager.setup.reviewOptions.defaultReviewCompletionTime'),
				'description' => __('manager.setup.reviewOptions.numWeeksPerReview'),
				'value' => $context->getData('numWeeksPerReview'),
				'size' => 'small',
			]));

		if (\Config::getVar('general', 'scheduled_tasks')) {
			$this->addField(new FieldText('numDaysBeforeInviteReminder', [
					'label' => __('manager.setup.reviewOptions.reminders.response'),
					'description' => __('manager.setup.reviewOptions.reminders.response.description'),
					'value' => $context->getData('numDaysBeforeInviteReminder'),
					'size' => 'small',
				]))
				->addField(new FieldText('numDaysBeforeSubmitReminder', [
					'label' => __('manager.setup.reviewOptions.reminders.submit'),
					'description' => __('manager.setup.reviewOptions.reminders.submit.description'),
					'value' => $context->getData('numDaysBeforeSubmitReminder'),
					'size' => 'small',
				]));
		} else {
			$this->addField(new FieldHTML('reviewRemindersDisabled', [
				'label' => __('manager.setup.reviewOptions.automatedReminders'),
				'description' => __('manager.setup.reviewOptions.automatedRemindersDisabled'),
			]));
		}
	}
}
