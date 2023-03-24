<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:50:23
  from 'app:authorDashboardauthorDash' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152ad1fde9d55_72698692',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '242d18fd85c62857d843c6ceeeba446f98b58766' => 
    array (
      0 => 'app:authorDashboardauthorDash',
      1 => 1624492110,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/notification/inPlaceNotification.tpl' => 1,
  ),
),false)) {
function content_6152ad1fde9d55_72698692 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2651947936152ad1fd95643_31995136', "page");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/backend.tpl");
}
/* {block "page"} */
class Block_2651947936152ad1fd95643_31995136 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page' => 
  array (
    0 => 'Block_2651947936152ad1fd95643_31995136',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<div class="pkpWorkflow">
		<pkp-header class="pkpWorkflow__header">
			<h1 class="pkpWorkflow__identification">
				<span class="pkpWorkflow__identificationId">{{ submission.id }}</span>
				<span class="pkpWorkflow__identificationDivider">/</span>
				<span class="pkpWorkflow__identificationAuthor">
					{{ currentPublication.authorsStringShort }}
				</span>
				<span class="pkpWorkflow__identificationDivider">/</span>
				<span class="pkpWorkflow__identificationTitle">
					{{ localizeSubmission(currentPublication.title, currentPublication.locale) }}
				</span>
			</h1>
			<template slot="actions">
				<pkp-button
					v-if="uploadFileUrl"
					ref="uploadFileButton"
					@click="openFileUpload"
				>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.upload.addFile"),$_smarty_tpl ) );?>

				</pkp-button>
				<pkp-button
					@click="openLibrary"
				>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submissionLibrary"),$_smarty_tpl ) );?>

				</pkp-button>
			</template>
		</pkp-header>
		<tabs :track-history="true">
			<tab id="workflow" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"manager.workflow"),$_smarty_tpl ) );?>
">

				<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/inPlaceNotification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('notificationId'=>"authorDashboardNotification",'requestOptions'=>$_smarty_tpl->tpl_vars['authorDashboardNotificationRequestOptions']->value), 0, false);
?>

				<?php $_smarty_tpl->_assignInScope('selectedTabIndex', 0);?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['workflowStages']->value, 'stage');
$_smarty_tpl->tpl_vars['stage']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['stage']->value) {
$_smarty_tpl->tpl_vars['stage']->do_else = false;
?>
					<?php if ($_smarty_tpl->tpl_vars['stage']->value['id'] < $_smarty_tpl->tpl_vars['submission']->value->getStageId()) {?>
						<?php $_smarty_tpl->_assignInScope('selectedTabIndex', $_smarty_tpl->tpl_vars['selectedTabIndex']->value+1);?>
					<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

				<?php echo '<script'; ?>
 type="text/javascript">
					// Attach the JS file tab handler.
					$(function() {
						$('#stageTabs').pkpHandler(
							'$.pkp.controllers.tab.workflow.WorkflowTabHandler',
							{
								selected: <?php echo $_smarty_tpl->tpl_vars['selectedTabIndex']->value;?>
,
								emptyLastTab: true
							}
						);
					});
				<?php echo '</script'; ?>
>
				<div id="stageTabs" class="pkp_controllers_tab">
					<ul>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['workflowStages']->value, 'stage');
$_smarty_tpl->tpl_vars['stage']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['stage']->value) {
$_smarty_tpl->tpl_vars['stage']->do_else = false;
?>
							<li class="pkp_workflow_<?php echo $_smarty_tpl->tpl_vars['stage']->value['path'];?>
 stageId<?php echo $_smarty_tpl->tpl_vars['stage']->value['id'];
if ($_smarty_tpl->tpl_vars['stage']->value['statusKey']) {?> initiated<?php }?>">
								<a name="stage-<?php echo $_smarty_tpl->tpl_vars['stage']->value['path'];?>
" class="<?php echo $_smarty_tpl->tpl_vars['stage']->value['path'];?>
 stageId<?php echo $_smarty_tpl->tpl_vars['stage']->value['id'];?>
" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"tab.authorDashboard.AuthorDashboardTabHandler",'op'=>"fetchTab",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stage']->value['id'],'escape'=>false),$_smarty_tpl ) );?>
">
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['stage']->value['translationKey']),$_smarty_tpl ) );?>

									<?php if ($_smarty_tpl->tpl_vars['stage']->value['statusKey']) {?>
										<span class="pkp_screen_reader">
											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['stage']->value['statusKey']),$_smarty_tpl ) );?>

										</span>
									<?php }?>
								</a>
							</li>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</ul>
				</div>
			</tab>
			<tab id="publication" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.publication"),$_smarty_tpl ) );?>
">
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
								<strong tabindex="0">{{ versionLabel }}</strong> {{ workingPublication.id }}
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
												{{ publication.id }} /
												<template v-if="publication.status === getConstant('STATUS_QUEUED') && publication.id === currentPublication.id"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.status.unscheduled"),$_smarty_tpl ) );?>
</template>
												<template v-else-if="publication.status === getConstant('STATUS_SCHEDULED')"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.status.scheduled"),$_smarty_tpl ) );?>
</template>
												<template v-else-if="publication.status === getConstant('STATUS_PUBLISHED')"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.status.published"),$_smarty_tpl ) );?>
</template>
												<template v-else><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.status.unpublished"),$_smarty_tpl ) );?>
</template>
											</button>
										</li>
									</ul>
								</dropdown>
							</span>
					</pkp-header>
					<div
						v-if="workingPublication.status === getConstant('STATUS_PUBLISHED')"
						class="pkpPublication__versionPublished"
					>
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"publication.editDisabled"),$_smarty_tpl ) );?>

					</div>
					<tabs :is-side-tabs="true" :track-history="true" class="pkpPublication__tabs" :label="currentPublicationTabsLabel">
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
						<?php if ($_smarty_tpl->tpl_vars['canAccessProductionStage']->value) {?>
							<tab id="galleys" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.layout.galleys"),$_smarty_tpl ) );?>
">
								<div id="representations-grid" ref="representations">
									<spinner></spinner>
								</div>
							</tab>
						<?php }?>
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['call_hook'][0], array( array('name'=>"Template::Workflow::Publication"),$_smarty_tpl ) );?>

					</tabs>
					<span class="pkpPublication__mask" :class="publicationMaskClasses">
						<spinner></spinner>
					</span>
				</div>
			</tab>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['call_hook'][0], array( array('name'=>"Template::Workflow"),$_smarty_tpl ) );?>

		</tabs>
	</div>
<?php
}
}
/* {/block "page"} */
}
