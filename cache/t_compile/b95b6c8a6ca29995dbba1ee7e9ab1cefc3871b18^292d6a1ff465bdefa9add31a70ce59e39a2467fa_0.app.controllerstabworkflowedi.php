<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:19:45
  from 'app:controllerstabworkflowedi' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152b401508042_75209471',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '292d6a1ff465bdefa9add31a70ce59e39a2467fa' => 
    array (
      0 => 'app:controllerstabworkflowedi',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/notification/inPlaceNotification.tpl' => 1,
    'app:controllers/tab/workflow/stageParticipants.tpl' => 1,
  ),
),false)) {
function content_6152b401508042_75209471 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="editorial">

	<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/inPlaceNotification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('notificationId'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "editingNotification_",$_smarty_tpl->tpl_vars['submission']->value->getId() )),'requestOptions'=>$_smarty_tpl->tpl_vars['editingNotificationRequestOptions']->value,'refreshOn'=>"stageStatusUpdated"), 0, false);
?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['help'][0], array( array('file'=>"editorial-workflow/copyediting",'class'=>"pkp_help_tab"),$_smarty_tpl ) );?>


	<div class="pkp_workflow_sidebar">
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'copyeditingEditorDecisionsUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_PAGE') ? constant('ROUTE_PAGE') : null),'page'=>"workflow",'op'=>"editorDecisionActions",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"copyeditingEditorDecisionsDiv",'url'=>$_smarty_tpl->tpl_vars['copyeditingEditorDecisionsUrl']->value,'class'=>"editorDecisionActions pkp_tab_actions"),$_smarty_tpl ) );?>

		<?php $_smarty_tpl->_subTemplateRender("app:controllers/tab/workflow/stageParticipants.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	</div>

	<div class="pkp_workflow_content">
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'finalDraftFilesGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.final.FinalDraftFilesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"finalDraftFilesGrid",'url'=>$_smarty_tpl->tpl_vars['finalDraftFilesGridUrl']->value),$_smarty_tpl ) );?>


		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'queriesGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.queries.QueriesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"queriesGrid",'url'=>$_smarty_tpl->tpl_vars['queriesGridUrl']->value),$_smarty_tpl ) );?>


		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'copyeditedFilesGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.copyedit.CopyeditFilesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"copyeditedFilesGrid",'url'=>$_smarty_tpl->tpl_vars['copyeditedFilesGridUrl']->value),$_smarty_tpl ) );?>

	</div>

</div>
<?php }
}
