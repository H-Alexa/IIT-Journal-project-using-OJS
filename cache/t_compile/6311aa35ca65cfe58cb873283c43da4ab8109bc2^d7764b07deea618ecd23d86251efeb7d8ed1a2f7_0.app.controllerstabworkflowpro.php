<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:22:22
  from 'app:controllerstabworkflowpro' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152b49ecd8ac5_20613059',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd7764b07deea618ecd23d86251efeb7d8ed1a2f7' => 
    array (
      0 => 'app:controllerstabworkflowpro',
      1 => 1624492110,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/notification/inPlaceNotification.tpl' => 1,
  ),
),false)) {
function content_6152b49ecd8ac5_20613059 (Smarty_Internal_Template $_smarty_tpl) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['help'][0], array( array('file'=>"editorial-workflow/production",'class'=>"pkp_help_tab"),$_smarty_tpl ) );?>


<div id="production">
	<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/inPlaceNotification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('notificationId'=>"productionNotification",'requestOptions'=>$_smarty_tpl->tpl_vars['productionNotificationRequestOptions']->value,'refreshOn'=>"stageStatusUpdated"), 0, false);
?>

	<div class="pkp_workflow_sidebar">
		<div class="pkp_tab_actions">
			<ul class="pkp_workflow_decisions">
				<li>
					<button
						class="pkpButton pkpButton--isPrimary"
						onClick="pkp.eventBus.$emit('open-tab', 'publication')"
					>
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submission.schedulePublication"),$_smarty_tpl ) );?>

					</button>
				</li>
			</ul>
		</div>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'stageParticipantGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.users.stageParticipant.StageParticipantGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"stageParticipantGridContainer",'url'=>$_smarty_tpl->tpl_vars['stageParticipantGridUrl']->value,'class'=>"pkp_participants_grid"),$_smarty_tpl ) );?>

	</div>

	<div class="pkp_workflow_content">
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'productionReadyFilesGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.productionReady.ProductionReadyFilesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"productionReadyFilesGridDiv",'url'=>$_smarty_tpl->tpl_vars['productionReadyFilesGridUrl']->value),$_smarty_tpl ) );?>

		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'queriesGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.queries.QueriesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"queriesGrid",'url'=>$_smarty_tpl->tpl_vars['queriesGridUrl']->value),$_smarty_tpl ) );?>

	</div>

</div>
<?php }
}
