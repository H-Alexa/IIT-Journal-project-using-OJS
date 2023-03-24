<?php
/* Smarty version 3.1.39, created on 2021-09-27 18:34:48
  from 'app:controllersgridgridCellCo' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151f2a8967c09_82785159',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13079afb8321a2a0363ebe7d6bab5378471300e1' => 
    array (
      0 => 'app:controllersgridgridCellCo',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:linkAction/linkAction.tpl' => 1,
  ),
),false)) {
function content_6151f2a8967c09_82785159 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\OJS\\lib\\pkp\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>

<?php $_smarty_tpl->_assignInScope('_label', $_smarty_tpl->tpl_vars['label']->value);?>

<?php if ($_smarty_tpl->tpl_vars['column']->value->hasFlag('multilingual')) {?>
		<?php if ((isset($_smarty_tpl->tpl_vars['_label']->value[$_smarty_tpl->tpl_vars['currentLocale']->value]))) {?>
		<?php $_smarty_tpl->_assignInScope('_label', $_smarty_tpl->tpl_vars['_label']->value[$_smarty_tpl->tpl_vars['currentLocale']->value]);?>
	<?php } else { ?>
		<?php $_smarty_tpl->_assignInScope('_primaryLocale', AppLocale::getPrimaryLocale());?>
		<?php $_smarty_tpl->_assignInScope('_label', $_smarty_tpl->tpl_vars['_label']->value[$_smarty_tpl->tpl_vars['_primaryLocale']->value]);?>
	<?php }
}?>

<?php if ($_smarty_tpl->tpl_vars['column']->value->hasFlag('anyhtml')) {?>
	<?php } elseif ($_smarty_tpl->tpl_vars['column']->value->hasFlag('html')) {?>
		<?php $_smarty_tpl->_assignInScope('_label', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( $_smarty_tpl->tpl_vars['_label']->value )));
} else { ?>
		<?php $_smarty_tpl->_assignInScope('_label', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['_label']->value )));
}?>

<?php if ($_smarty_tpl->tpl_vars['_label']->value != '') {?>
	<span class="label<?php if (count($_smarty_tpl->tpl_vars['actions']->value) > 0) {?> before_actions<?php }?>">
		<?php if ($_smarty_tpl->tpl_vars['column']->value->hasFlag('maxLength')) {?>
			<?php $_smarty_tpl->_assignInScope('maxLength', $_smarty_tpl->tpl_vars['column']->value->getFlag('maxLength'));?>
			<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['_label']->value,$_smarty_tpl->tpl_vars['maxLength']->value);?>

		<?php } else { ?>
			<?php echo $_smarty_tpl->tpl_vars['_label']->value;?>

		<?php }?>
	</span>
<?php }?>

<?php if (count($_smarty_tpl->tpl_vars['actions']->value) > 0) {?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['actions']->value, 'action');
$_smarty_tpl->tpl_vars['action']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['action']->value) {
$_smarty_tpl->tpl_vars['action']->do_else = false;
?>
		<?php $_smarty_tpl->_subTemplateRender("app:linkAction/linkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('action'=>$_smarty_tpl->tpl_vars['action']->value,'contextId'=>$_smarty_tpl->tpl_vars['cellId']->value,'anyhtml'=>$_smarty_tpl->tpl_vars['column']->value->hasFlag('anyhtml')), 0, true);
?>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
}
