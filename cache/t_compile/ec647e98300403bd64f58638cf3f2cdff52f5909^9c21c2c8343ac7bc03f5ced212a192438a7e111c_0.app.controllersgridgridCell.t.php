<?php
/* Smarty version 3.1.39, created on 2021-09-27 18:34:48
  from 'app:controllersgridgridCell.t' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151f2a8929486_07734180',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9c21c2c8343ac7bc03f5ced212a192438a7e111c' => 
    array (
      0 => 'app:controllersgridgridCell.t',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/grid/gridCellContents.tpl' => 1,
  ),
),false)) {
function content_6151f2a8929486_07734180 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['id']->value) {?>
	<?php $_smarty_tpl->_assignInScope('cellId', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "cell-",$_smarty_tpl->tpl_vars['id']->value )));
} else { ?>
	<?php $_smarty_tpl->_assignInScope('cellId', '');
}?>
<span <?php if ($_smarty_tpl->tpl_vars['cellId']->value) {?>id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cellId']->value ));?>
" <?php }?>class="gridCellContainer">
	<?php $_smarty_tpl->_subTemplateRender("app:controllers/grid/gridCellContents.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</span>

<?php }
}
