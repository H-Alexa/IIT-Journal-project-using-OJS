<?php
/* Smarty version 3.1.39, created on 2021-09-27 20:01:13
  from 'app:formradioButton.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_615206e9c83052_08804331',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f19efbd814895da94751737363f3fa209a30f575' => 
    array (
      0 => 'app:formradioButton.tpl',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_615206e9c83052_08804331 (Smarty_Internal_Template $_smarty_tpl) {
?>
<li<?php if ($_smarty_tpl->tpl_vars['FBV_layoutInfo']->value) {?> class="<?php echo $_smarty_tpl->tpl_vars['FBV_layoutInfo']->value;?>
"<?php }?>>
	<label>
	<input type="radio" id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_id']->value ));?>
" <?php echo $_smarty_tpl->tpl_vars['FBV_radioParams']->value;?>
 class="field radio"<?php if ($_smarty_tpl->tpl_vars['FBV_checked']->value) {?> checked="checked"<?php }
if ($_smarty_tpl->tpl_vars['FBV_disabled']->value) {?> disabled="disabled"<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['FBV_required']->value) {?> required aria-required="true"<?php }?>>
	<?php if ($_smarty_tpl->tpl_vars['FBV_label']->value) {?>
		<?php if ($_smarty_tpl->tpl_vars['FBV_translate']->value) {?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['FBV_label']->value),$_smarty_tpl ) );?>

		<?php } else { ?>
			<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_label']->value ));?>

		<?php }?>
	<?php } elseif ($_smarty_tpl->tpl_vars['FBV_content']->value) {?>
		<?php echo $_smarty_tpl->tpl_vars['FBV_content']->value;?>

	<?php }?>
	</label>
</li>
<?php }
}
