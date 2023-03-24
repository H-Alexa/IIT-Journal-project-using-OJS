<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:50:34
  from 'app:controllerstabauthorDashb' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152ad2a2aff52_87957143',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a640ad8d32580750f2be7dc476f75eb6b9eb66cf' => 
    array (
      0 => 'app:controllerstabauthorDashb',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:authorDashboard/submissionEmails.tpl' => 1,
  ),
),false)) {
function content_6152ad2a2aff52_87957143 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['submission']->value->getStageId() >= (defined('WORKFLOW_STAGE_ID_EDITING') ? constant('WORKFLOW_STAGE_ID_EDITING') : null)) {?>
	<!-- Display editor's message to the author -->
	<?php $_smarty_tpl->_subTemplateRender("app:authorDashboard/submissionEmails.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('submissionEmails'=>$_smarty_tpl->tpl_vars['copyeditingEmails']->value), 0, false);
?>

	<!-- Display queries grid -->
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'queriesGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.queries.QueriesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>(defined('WORKFLOW_STAGE_ID_EDITING') ? constant('WORKFLOW_STAGE_ID_EDITING') : null),'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"queriesGrid",'url'=>$_smarty_tpl->tpl_vars['queriesGridUrl']->value),$_smarty_tpl ) );?>


	<!-- Copyedited Files grid -->
	<?php if ($_smarty_tpl->tpl_vars['canAccessCopyeditingStage']->value) {?>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'copyeditedFilesGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.copyedit.CopyeditFilesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"copyeditedFilesGrid",'url'=>$_smarty_tpl->tpl_vars['copyeditedFilesGridUrl']->value),$_smarty_tpl ) );?>

	<?php }
} else { ?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.stageNotInitiated"),$_smarty_tpl ) );?>

<?php }
}
}
