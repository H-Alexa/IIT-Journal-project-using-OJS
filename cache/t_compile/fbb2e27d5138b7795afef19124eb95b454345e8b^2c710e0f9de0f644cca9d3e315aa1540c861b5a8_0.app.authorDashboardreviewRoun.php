<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:03:29
  from 'app:authorDashboardreviewRoun' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152b031376494_82498698',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2c710e0f9de0f644cca9d3e315aa1540c861b5a8' => 
    array (
      0 => 'app:authorDashboardreviewRoun',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/notification/inPlaceNotification.tpl' => 1,
    'app:authorDashboard/submissionEmails.tpl' => 1,
  ),
),false)) {
function content_6152b031376494_82498698 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!--  Display round status -->
<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/inPlaceNotification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('notificationId'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "reviewRoundNotification_",$_smarty_tpl->tpl_vars['reviewRoundId']->value )),'requestOptions'=>$_smarty_tpl->tpl_vars['reviewRoundNotificationRequestOptions']->value), 0, false);
?>

<!-- Display editor's message to the author -->
<?php $_smarty_tpl->_subTemplateRender("app:authorDashboard/submissionEmails.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('submissionEmails'=>$_smarty_tpl->tpl_vars['submissionEmails']->value), 0, false);
?>

<?php if ($_smarty_tpl->tpl_vars['showReviewerGrid']->value) {?>
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "reviewersGridUrl", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.users.reviewer.AuthorReviewerGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "reviewersGrid-round_",$_smarty_tpl->tpl_vars['reviewRoundId']->value )),'url'=>$_smarty_tpl->tpl_vars['reviewersGridUrl']->value),$_smarty_tpl ) );?>

<?php }?>

<!-- Display review attachments grid -->
<?php if ($_smarty_tpl->tpl_vars['showReviewAttachments']->value) {?>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'reviewAttachmentsGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.attachment.AuthorReviewAttachmentsGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"reviewAttachmentsGridContainer-".((string)$_smarty_tpl->tpl_vars['stageId']->value)."-".((string)$_smarty_tpl->tpl_vars['reviewRoundId']->value),'url'=>$_smarty_tpl->tpl_vars['reviewAttachmentsGridUrl']->value),$_smarty_tpl ) );?>


	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'revisionsGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.review.AuthorReviewRevisionsGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"revisionsGrid-".((string)$_smarty_tpl->tpl_vars['stageId']->value)."-".((string)$_smarty_tpl->tpl_vars['reviewRoundId']->value),'url'=>$_smarty_tpl->tpl_vars['revisionsGridUrl']->value),$_smarty_tpl ) );?>

<?php }
}
}
