<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:19:45
  from 'app:controllerstabworkflowsta' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152b401683d97_89051196',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2809c06c8ddb23547415d73ac5d7fe0d8115ef40' => 
    array (
      0 => 'app:controllerstabworkflowsta',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152b401683d97_89051196 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'stageParticipantGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.users.stageParticipant.StageParticipantGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "stageParticipantGridContainer-",$_smarty_tpl->tpl_vars['reviewRoundId']->value )),'url'=>$_smarty_tpl->tpl_vars['stageParticipantGridUrl']->value,'class'=>"pkp_participants_grid"),$_smarty_tpl ) );?>

<?php }
}
