<?php
/* Smarty version 3.1.39, created on 2021-09-27 18:35:01
  from 'plugins-1-plugins-generic-staticPages-generic-staticPages:staticPagesTab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151f2b5ceb9e2_91981165',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '69bd445f2f2cf5b6df78b3a087006851d1c9e8bf' => 
    array (
      0 => 'plugins-1-plugins-generic-staticPages-generic-staticPages:staticPagesTab.tpl',
      1 => 1624492184,
      2 => 'plugins-1-plugins-generic-staticPages-generic-staticPages',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6151f2b5ceb9e2_91981165 (Smarty_Internal_Template $_smarty_tpl) {
?><tab id="staticPages" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"plugins.generic.staticPages.staticPages"),$_smarty_tpl ) );?>
">
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'staticPageGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"plugins.generic.staticPages.controllers.grid.StaticPageGridHandler",'op'=>"fetchGrid",'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"staticPageGridContainer",'url'=>$_smarty_tpl->tpl_vars['staticPageGridUrl']->value),$_smarty_tpl ) );?>

</tab>
<?php }
}
