<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:50:32
  from 'app:controllerstabauthorDashb' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152ad2888d954_12172265',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc32d36e7a4ad3303ec79e51951776442360a0aa' => 
    array (
      0 => 'app:controllerstabauthorDashb',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:authorDashboard/reviewRoundTab.tpl' => 1,
  ),
),false)) {
function content_6152ad2888d954_12172265 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['submission']->value->getStageId() >= (defined('WORKFLOW_STAGE_ID_EXTERNAL_REVIEW') ? constant('WORKFLOW_STAGE_ID_EXTERNAL_REVIEW') : null) && count($_smarty_tpl->tpl_vars['reviewRounds']->value)) {?>
	<?php $_smarty_tpl->_subTemplateRender("app:authorDashboard/reviewRoundTab.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('reviewRounds'=>$_smarty_tpl->tpl_vars['reviewRounds']->value,'reviewRoundTabsId'=>"externalReviewRoundTabs",'lastReviewRoundNumber'=>$_smarty_tpl->tpl_vars['lastReviewRoundNumber']->value), 0, false);
?>

	<!-- Display queries grid -->
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'queriesGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.queries.QueriesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>(defined('WORKFLOW_STAGE_ID_EXTERNAL_REVIEW') ? constant('WORKFLOW_STAGE_ID_EXTERNAL_REVIEW') : null),'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"queriesGrid",'url'=>$_smarty_tpl->tpl_vars['queriesGridUrl']->value),$_smarty_tpl ) );?>

<?php } else { ?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.stageNotInitiated"),$_smarty_tpl ) );?>

<?php }
}
}
