<?php
/* Smarty version 3.1.39, created on 2021-09-27 20:11:54
  from 'app:controllerspagetasks.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152096a131e40_42395886',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ff1cb192ef33fc9e3d92436bc42c54efdb4c274b' => 
    array (
      0 => 'app:controllerspagetasks.tpl',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152096a131e40_42395886 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'notificationsGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.notifications.TaskNotificationsGridHandler",'op'=>"fetchGrid",'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"notificationsGrid",'url'=>$_smarty_tpl->tpl_vars['notificationsGridUrl']->value),$_smarty_tpl ) );?>

<?php }
}
