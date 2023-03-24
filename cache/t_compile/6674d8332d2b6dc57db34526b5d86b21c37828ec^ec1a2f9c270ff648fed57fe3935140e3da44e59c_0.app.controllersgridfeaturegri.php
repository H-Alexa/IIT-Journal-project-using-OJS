<?php
/* Smarty version 3.1.39, created on 2021-09-27 18:34:48
  from 'app:controllersgridfeaturegri' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151f2a8921f60_99363647',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec1a2f9c270ff648fed57fe3935140e3da44e59c' => 
    array (
      0 => 'app:controllersgridfeaturegri',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6151f2a8921f60_99363647 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="grid_controls order_finish_controls">
	<a href="#" id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( $_smarty_tpl->tpl_vars['gridId']->value ));?>
-saveButton" class="saveButton">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.done"),$_smarty_tpl ) );?>

	</a>
	<a href="#" id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( $_smarty_tpl->tpl_vars['gridId']->value ));?>
-cancel" class="cancelFormButton">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"grid.action.cancelOrdering"),$_smarty_tpl ) );?>

	</a>
</div>
<?php }
}
