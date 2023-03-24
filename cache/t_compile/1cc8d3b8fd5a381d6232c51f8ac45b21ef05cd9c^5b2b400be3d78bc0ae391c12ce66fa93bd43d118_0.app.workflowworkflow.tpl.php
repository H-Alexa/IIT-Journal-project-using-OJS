<?php
/* Smarty version 3.1.39, created on 2021-09-27 20:13:59
  from 'app:workflowworkflow.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_615209e70a7ef7_62996904',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5b2b400be3d78bc0ae391c12ce66fa93bd43d118' => 
    array (
      0 => 'app:workflowworkflow.tpl',
      1 => 1624492110,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/notification/inPlaceNotification.tpl' => 1,
  ),
),false)) {
function content_615209e70a7ef7_62996904 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_730424630615209e6f41428_99829128', "page");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/backend.tpl");
}
/* {block "page"} */
class Block_730424630615209e6f41428_99829128 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page' => 
  array (
    0 => 'Block_730424630615209e6f41428_99829128',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<pkp-header :is-one-line="true" class="pkpWorkflow__header">
		<h1 class="pkpWorkflow__identification">
			<badge
				v-if="submission.status === getConstant('STATUS_PUBLISHED')"
				class="pkpWorkflow__identificationStatus"
				:is-success="true"
			>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.status.published"),$_smarty_tpl ) );?>

			</badge>
			<badge
				v-else-if="submission.status === getConstant('STATUS_SCHEDULED')"
				class="pkpWorkflow__identificationStatus"
				:is-primary="true"
			>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.status.scheduled"),$_smarty_tpl ) );?>

			</badge>
			<badge
				v-else-if="submission.status === getConstant('STATUS_DECLINED')"
				class="pkpWorkflow__identificationStatus"
				:is-warnable="true"
			>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.declined"),$_smarty_tpl ) );?>

			</badge>
			<span class="pkpWorkflow__identificationId">{{ submission.id }}</span>
			<span class="pkpWorkflow__identificationDivider">/</span>
			<span class="pkpWorkflow__identificationAuthor">
				{{ currentPublication.authorsStringShort }}
			</span>
			<span class="pkpWorkflow__identificationDivider">/</span>
			<span class="pkpWorkflow__identificationTitle">
				{{ localizeSubmission(currentPublication.fullTitle, currentPublication.locale) }}
			</span>
		</h1>
		<template slot="actions">
			<pkp-button
				v-if="submission.status === getConstant('STATUS_PUBLISHED')"
				element="a"
				:href="submission.urlPublished"
			>
				{{ __('common.view') }}
			</pkp-button>
			<pkp-button
				v-else-if="submission.status !== getConstant('STATUS_PUBLISHED') && submission.stageId >= getConstant('WORKFLOW_STAGE_ID_EDITING')"
				element="a"
				:href="submission.urlPublished"
			>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.preview"),$_smarty_tpl ) );?>

			</pkp-button>
			<?php if ($_smarty_tpl->tpl_vars['submissionPaymentsEnabled']->value) {?>
				<dropdown
					class="pkpWorkflow__submissionPayments"
					label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.payments"),$_smarty_tpl ) );?>
"
				>
					<pkp-form class="pkpWorkflow__submissionPaymentsForm" v-bind="components.<?php echo (defined('FORM_SUBMISSION_PAYMENTS') ? constant('FORM_SUBMISSION_PAYMENTS') : null);?>
" @set="set">
				</dropdown>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['canAccessEditorialHistory']->value) {?>
				<pkp-button
					ref="activityButton"
					@click="openActivity"
				>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.activityLog"),$_smarty_tpl ) );?>

				</pkp-button>
			<?php }?>
			<pkp-button
				ref="library"
				@click="openLibrary"
			>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submissionLibrary"),$_smarty_tpl ) );?>

			</pkp-button>
		</template>
	</pkp-header>
	<tabs default-tab="workflow" :track-history="true">
		<tab id="workflow" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"manager.workflow"),$_smarty_tpl ) );?>
">
			<?php echo '<script'; ?>
 type="text/javascript">
				// Initialize JS handler.
				$(function() {
					$('#submissionWorkflow').pkpHandler(
						'$.pkp.pages.workflow.WorkflowHandler'
					);
				});
			<?php echo '</script'; ?>
>

			<div id="submissionWorkflow" class="pkp_submission_workflow">
				<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/inPlaceNotification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('notificationId'=>"workflowNotification",'requestOptions'=>$_smarty_tpl->tpl_vars['workflowNotificationRequestOptions']->value), 0, false);
?>
				<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'submissionProgressBarUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"submissionProgressBar",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['requestedStageId']->value,'contextId'=>"submission",'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"submissionProgressBarDiv",'url'=>$_smarty_tpl->tpl_vars['submissionProgressBarUrl']->value),$_smarty_tpl ) );?>

			</div>
		</tab>
		<?php if ($_smarty_tpl->tpl_vars['canAccessPublication']->value) {?>
			<tab id="publication" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.publication"),$_smarty_tpl ) );?>
">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['help'][0], array( array('file'=>"editorial-workflow/publication",'class'=>"pkp_help_tab"),$_smarty_tpl ) );?>

				<div class="pkpPublication" ref="publication" aria-live="polite">
					<pkp-header class="pkpPublication__header" :is-one-line="false">
						<span class="pkpPublication__status">
							<strong>{{ statusLabel }}</strong>
							<span v-if="workingPublication.status === getConstant('STATUS_QUEUED') && workingPublication.id === currentPublication.id" class="pkpPublication__statusUnpublished"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.status.unscheduled"),$_smarty_tpl ) );?>
</span>
							<span v-else-if="workingPublication.status === getConstant('STATUS_SCHEDULED')"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.status.scheduled"),$_smarty_tpl ) );?>
</span>
							<span v-else-if="workingPublication.status === getConstant('STATUS_PUBLISHED')" class="pkpPublication__statusPublished"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.status.published"),$_smarty_tpl ) );?>
</span>
							<span v-else class="pkpPublication__statusUnpublished"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.status.unpublished"),$_smarty_tpl ) );?>
</span>
						</span>
						<span v-if="publicationList.length > 1" class="pkpPublication__version">
							<strong tabindex="0">{{ versionLabel }}</strong> {{ workingPublication.version }}
							<dropdown
								class="pkpPublication__versions"
								label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.version.all"),$_smarty_tpl ) );?>
"
								:is-link="true"
								submenu-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.submenu"),$_smarty_tpl ) );?>
"
							>
								<ul>
									<li v-for="publication in publicationList" :key="publication.id">
										<button
											class="pkpDropdown__action"
											:disabled="publication.id === workingPublication.id"
											@click="setWorkingPublicationById(publication.id)"
										>
											{{ publication.version }} /
											<template v-if="publication.status === getConstant('STATUS_QUEUED') && publication.id === currentPublication.id"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.status.unscheduled"),$_smarty_tpl ) );?>
</template>
											<template v-else-if="publication.status === getConstant('STATUS_SCHEDULED')"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.status.scheduled"),$_smarty_tpl ) );?>
</template>
											<template v-else-if="publication.status === getConstant('STATUS_PUBLISHED')">{{ publication.datePublished }}</template>
											<template v-else><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.status.unpublished"),$_smarty_tpl ) );?>
</template>
										</button>
									</li>
								</ul>
							</dropdown>
						</span>
						<?php if ($_smarty_tpl->tpl_vars['canPublish']->value) {?>
							<template slot="actions">
								<pkp-button
									v-if="workingPublication.status !== getConstant('STATUS_PUBLISHED') && submission.stageId >= getConstant('WORKFLOW_STAGE_ID_EDITING')"
									element="a"
									:href="workingPublication.urlPublished"
								>
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.preview"),$_smarty_tpl ) );?>

								</pkp-button>
								<pkp-button
									v-if="workingPublication.status === getConstant('STATUS_QUEUED')"
									ref="publish"
									@click="workingPublication.issueId ? openPublish() : openAssignToIssue()"
								>
									{{ submission.status === getConstant('STATUS_PUBLISHED') ? publishLabel : schedulePublicationLabel }}
								</pkp-button>
								<pkp-button
									v-else-if="workingPublication.status === getConstant('STATUS_SCHEDULED')"
									:is-warnable="true"
									@click="openUnpublish"
								>
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.unschedule"),$_smarty_tpl ) );?>

								</pkp-button>
								<pkp-button
									v-else-if="workingPublication.status === getConstant('STATUS_PUBLISHED')"
									:is-warnable="true"
									@click="openUnpublish"
								>
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.unpublish"),$_smarty_tpl ) );?>

								</pkp-button>
								<pkp-button
									v-if="canCreateNewVersion"
									ref="createVersion"
									@click="openCreateVersionPrompt"
								>
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.createVersion"),$_smarty_tpl ) );?>

								</pkp-button>
							</template>
						<?php }?>
					</pkp-header>
					<div
						v-if="workingPublication.status === getConstant('STATUS_PUBLISHED')"
						class="pkpPublication__versionPublished"
					>
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.editDisabled"),$_smarty_tpl ) );?>

					</div>
					<tabs class="pkpPublication__tabs" :is-side-tabs="true" :track-history="true" :label="currentPublicationTabsLabel">
						<tab id="titleAbstract" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.titleAbstract"),$_smarty_tpl ) );?>
">
							<pkp-form v-bind="components.<?php echo (defined('FORM_TITLE_ABSTRACT') ? constant('FORM_TITLE_ABSTRACT') : null);?>
" @set="set" />
						</tab>
						<tab id="contributors" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.contributors"),$_smarty_tpl ) );?>
">
							<div id="contributors-grid" ref="contributors">
								<spinner></spinner>
							</div>
						</tab>
						<?php if ($_smarty_tpl->tpl_vars['metadataEnabled']->value) {?>
							<tab id="metadata" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.informationCenter.metadata"),$_smarty_tpl ) );?>
">
								<pkp-form v-bind="components.<?php echo (defined('FORM_METADATA') ? constant('FORM_METADATA') : null);?>
" @set="set" />
							</tab>
						<?php }?>
						<tab v-if="supportsReferences" id="citations" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.citations"),$_smarty_tpl ) );?>
">
							<pkp-form v-bind="components.<?php echo (defined('FORM_CITATIONS') ? constant('FORM_CITATIONS') : null);?>
" @set="set" />
						</tab>
						<?php if ($_smarty_tpl->tpl_vars['identifiersEnabled']->value) {?>
							<tab id="identifiers" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.identifiers"),$_smarty_tpl ) );?>
">
								<pkp-form v-bind="components.<?php echo (defined('FORM_PUBLICATION_IDENTIFIERS') ? constant('FORM_PUBLICATION_IDENTIFIERS') : null);?>
" @set="set" />
							</tab>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['canAccessProduction']->value) {?>
							<tab id="galleys" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.layout.galleys"),$_smarty_tpl ) );?>
">
								<div id="representations-grid" ref="representations">
									<spinner></spinner>
								</div>
							</tab>
							<tab id="license" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.publicationLicense"),$_smarty_tpl ) );?>
">
								<pkp-form v-bind="components.<?php echo (defined('FORM_PUBLICATION_LICENSE') ? constant('FORM_PUBLICATION_LICENSE') : null);?>
" @set="set" />
							</tab>
							<tab id="issue" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"issue.issue"),$_smarty_tpl ) );?>
">
								<pkp-form v-bind="components.<?php echo (defined('FORM_ISSUE_ENTRY') ? constant('FORM_ISSUE_ENTRY') : null);?>
" @set="set" />
							</tab>
						<?php }?>
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['call_hook'][0], array( array('name'=>"Template::Workflow::Publication"),$_smarty_tpl ) );?>

					</tabs>
					<span class="pkpPublication__mask" :class="publicationMaskClasses">
						<spinner></spinner>
					</span>
				</div>
			</tab>
		<?php }?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['call_hook'][0], array( array('name'=>"Template::Workflow"),$_smarty_tpl ) );?>

	</tabs>
<?php
}
}
/* {/block "page"} */
}
