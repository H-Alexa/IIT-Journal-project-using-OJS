<?php
/* Smarty version 3.1.39, created on 2021-09-27 18:35:04
  from 'app:controllersgridcommoncell' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151f2b8360320_91886691',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '171578df788edec9584fb613f51bde9fd89d147a' => 
    array (
      0 => 'app:controllersgridcommoncell',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:linkAction/buttonGenericLinkAction.tpl' => 1,
  ),
),false)) {
function content_6151f2b8360320_91886691 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('cellId', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "cell-",$_smarty_tpl->tpl_vars['id']->value )));?>
<span id="<?php echo $_smarty_tpl->tpl_vars['cellId']->value;?>
">
	<?php if (count($_smarty_tpl->tpl_vars['actions']->value) > 0) {?>
		<?php $_smarty_tpl->_assignInScope('defaultCellAction', $_smarty_tpl->tpl_vars['actions']->value[0]);?>
		<?php $_smarty_tpl->_subTemplateRender("app:linkAction/buttonGenericLinkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('action'=>$_smarty_tpl->tpl_vars['defaultCellAction']->value,'buttonSelector'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "#select-",$_smarty_tpl->tpl_vars['cellId']->value ))), 0, false);
?>
	<?php }?>
	<input type="radio" id="select-<?php echo $_smarty_tpl->tpl_vars['cellId']->value;?>
" style="height: 15px; width: 15px;" <?php if ($_smarty_tpl->tpl_vars['selected']->value) {?>checked="checked"<?php }?> <?php if ($_smarty_tpl->tpl_vars['disabled']->value) {?>disabled="disabled"<?php }?>/>
</span>

<?php }
}
