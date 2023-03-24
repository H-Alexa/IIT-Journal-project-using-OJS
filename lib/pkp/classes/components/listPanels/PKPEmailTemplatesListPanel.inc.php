<?php
/**
 * @file classes/components/listPanels/PKPEmailTemplatesListPanel.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPEmailTemplatesListPanel
 * @ingroup classes_components_list
 *
 * @brief A ListPanel component for viewing and editing email templates
 */
namespace PKP\components\listPanels;
use PKP\components\forms\emailTemplate\PKPEmailTemplateForm;

class PKPEmailTemplatesListPanel extends ListPanel {

	/** @var string URL to the API endpoint where items can be retrieved */
	public $apiUrl = '';

	/** @param array Form for adding or editing an email template */
	public $form = [];

	/** @var array Query parameters to pass if this list executes GET requests  */
	public $getParams = [];

	/** @var boolean Whether or not this component should be lazy-loaded */
	public $lazyLoad = [];

	/** @var int Max number of items available to display in this list panel  */
	public $itemsMax = [];

	/**
	 * Initialize the form with config parameters
	 *
	 * @param $id string
	 * @param $title string
	 * @param $supportedLocales array
	 * @param $args array Configuration params
	 */
	function __construct($id, $title, $supportedLocales, $args = []) {
		parent::__construct($id, $title, $args);
		$this->form = new PKPEmailTemplateForm('POST', $supportedLocales);
	}

	/**
	 * @copydoc ListPanel::getConfig()
	 */
	public function getConfig() {
		\AppLocale::requireComponents(LOCALE_COMPONENT_PKP_MANAGER);
		\AppLocale::requireComponents(LOCALE_COMPONENT_APP_MANAGER);
		\AppLocale::requireComponents(LOCALE_COMPONENT_APP_DEFAULT);

		$config = parent::getConfig();

		$config['apiUrl'] = $this->apiUrl;
		$config['form'] = $this->form->getConfig();
		$config['itemsMax'] = $this->itemsMax;
		$config['lazyLoad'] = $this->lazyLoad;
		$config['roles'] = [
			ROLE_ID_MANAGER => __('user.role.editor'),
			ROLE_ID_SITE_ADMIN => __('user.role.siteAdmin'),
			ROLE_ID_SUB_EDITOR => __('default.groups.name.sectionEditor'),
			ROLE_ID_AUTHOR => __('user.role.author'),
			ROLE_ID_REVIEWER => __('user.role.reviewer'),
			ROLE_ID_ASSISTANT => __('user.role.assistant'),
			ROLE_ID_READER => __('user.role.reader'),
			ROLE_ID_SUBSCRIPTION_MANAGER => __('default.groups.name.subscriptionManager'),
		];
		$config['filters'] = [
			[
				'filters' => [
					[
						'param' => 'isEnabled',
						'title' => __('common.enabled'),
						'value' => 1,
					],
					[
						'param' => 'isEnabled',
						'title' => __('common.disabled'),
						'value' => 0,
					],
					[
						'param' => 'isCustom',
						'title' => __('manager.emails.customTemplate'),
						'value' => 1,
					],
				],
			],
			[
				'heading' => __('manager.emails.sentFrom'),
				'filters' => [
					[
						'param' => 'fromRoleIds',
						'title' => __('user.role.editor'),
						'value' => ROLE_ID_MANAGER,
					],
					[
						'param' => 'fromRoleIds',
						'title' => __('user.role.reviewer'),
						'value' => ROLE_ID_REVIEWER,
					],
					[
						'param' => 'fromRoleIds',
						'title' => __('user.role.assistant'),
						'value' => ROLE_ID_ASSISTANT,
					],
					[
						'param' => 'fromRoleIds',
						'title' => __('user.role.reader'),
						'value' => ROLE_ID_READER,
					],
				],
			],
			[
				'heading' => __('manager.emails.sentTo'),
				'filters' => [
					[
						'param' => 'toRoleIds',
						'title' => __('user.role.editor'),
						'value' => ROLE_ID_MANAGER,
					],
					[
						'param' => 'toRoleIds',
						'title' => __('user.role.reviewer'),
						'value' => ROLE_ID_REVIEWER,
					],
					[
						'param' => 'toRoleIds',
						'title' => __('user.role.assistant'),
						'value' => ROLE_ID_ASSISTANT,
					],
					[
						'param' => 'toRoleIds',
						'title' => __('user.role.author'),
						'value' => ROLE_ID_AUTHOR,
					],
					[
						'param' => 'toRoleIds',
						'title' => __('user.role.reader'),
						'value' => ROLE_ID_READER,
					],
				],
			],
		];

		$workflowStageDao = \DAORegistry::getDAO('WorkflowStageDAO');
		$stageFilters = array();
		foreach ($workflowStageDao->getWorkflowStageTranslationKeys() as $stageId => $stageKey) {
			$stageFilters[] = [
					'param' => 'stageIds',
					'title' => __($stageKey),
					'value' => $stageId
			];
		}

		import('lib.pkp.classes.services.PKPEmailTemplateService'); // load const
		$stageFilters[] = [
			'param' => 'stageIds',
			'title' => __('common.other'),
			'value' => EMAIL_TEMPLATE_STAGE_DEFAULT
		];

		$config['filters'][] = [
			'heading' => __('workflow.stage'),
			'filters' => $stageFilters
		];

		$config['addLabel'] = __('manager.emails.addEmail');
		$config['delete'] = __('common.delete');
		$config['deleteConfirmMessage'] = __('manager.emails.confirmDelete');
		$config['descriptionLabel'] = __('common.description');
		$config['disableLabel'] = __('common.disable');
		$config['disabledLabel'] = __('common.disabled');
		$config['editTemplateLabel'] = __('manager.emails.editEmail');
		$config['enableLabel'] = __('common.enable');
		$config['fromLabel'] = __('common.fromWithValue');
		$config['resetAllLabel'] = __('manager.emails.resetAll');
		$config['resetAllCompleteLabel'] = __('manager.emails.resetAll.complete');
		$config['resetAllConfirmLabel'] = __('manager.emails.resetAll.message');
		$config['resetCompleteLabel'] = __('manager.emails.resetComplete');
		$config['resetConfirmLabel'] = __('manager.emails.confirmReset');
		$config['resetLabel'] = __('manager.emails.reset');
		$config['subjectLabel'] = __('manager.emails.subjectWithValue');
		$config['toLabel'] = __('common.toWithValue');

		if (!empty($this->getParams)) {
			$config['getParams'] = $this->getParams;
		}

		return $config;
	}
}
