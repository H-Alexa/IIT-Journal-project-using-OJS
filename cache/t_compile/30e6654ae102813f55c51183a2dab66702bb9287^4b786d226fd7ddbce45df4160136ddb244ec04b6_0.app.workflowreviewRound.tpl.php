<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:55:10
  from 'app:workflowreviewRound.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152ae3ec7a834_94807945',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b786d226fd7ddbce45df4160136ddb244ec04b6' => 
    array (
      0 => 'app:workflowreviewRound.tpl',
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
function content_6152ae3ec7a834_94807945 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="pkp_panel_wrapper">

	<?php if ($_smarty_tpl->tpl_vars['isLastReviewRound']->value) {?>
		<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/inPlaceNotification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('notificationId'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "reviewRoundNotification_",$_smarty_tpl->tpl_vars['reviewRoundId']->value )),'requestOptions'=>$_smarty_tpl->tpl_vars['reviewRoundNotificationRequestOptions']->value), 0, false);
?>
	<?php }?>

		<div class="pkp_workflow_sidebar">
		<?php if (!$_smarty_tpl->tpl_vars['isAssignedAsAuthor']->value) {?>
			<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'reviewDecisionsUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_PAGE') ? constant('ROUTE_PAGE') : null),'page'=>"workflow",'op'=>"editorDecisionActions",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'contextId'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "reviewRoundTab-",$_smarty_tpl->tpl_vars['reviewRoundId']->value )),'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "reviewDecisionsDiv-",$_smarty_tpl->tpl_vars['reviewRoundId']->value )),'url'=>$_smarty_tpl->tpl_vars['reviewDecisionsUrl']->value,'class'=>"pkp_tab_actions",'refreshOn'=>"decisionActionUpdated"),$_smarty_tpl ) );?>

		<?php }?>
		<?php $_smarty_tpl->_subTemplateRender("app:controllers/tab/workflow/stageParticipants.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	</div>

	<div class="pkp_workflow_content">

				<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'reviewFileSelectionGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.review.EditorReviewFilesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "reviewFileSelection-round_",$_smarty_tpl->tpl_vars['reviewRoundId']->value )),'url'=>$_smarty_tpl->tpl_vars['reviewFileSelectionGridUrl']->value),$_smarty_tpl ) );?>


				<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'reviewersGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.users.reviewer.ReviewerGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "reviewersGrid-round_",$_smarty_tpl->tpl_vars['reviewRoundId']->value )),'url'=>$_smarty_tpl->tpl_vars['reviewersGridUrl']->value),$_smarty_tpl ) );?>


				<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'revisionsGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.review.WorkflowReviewRevisionsGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "revisionsGrid-round_",$_smarty_tpl->tpl_vars['reviewRoundId']->value )),'url'=>$_smarty_tpl->tpl_vars['revisionsGridUrl']->value),$_smarty_tpl ) );?>

	</div>
</div>
<?php }
}
