<?php
/* Smarty version 3.1.39, created on 2021-09-27 19:46:30
  from 'app:formsubLabel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61520376c7bb43_20603024',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5147b9bbe18438a54e3d58eef18ae82049b2d346' => 
    array (
      0 => 'app:formsubLabel.tpl',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61520376c7bb43_20603024 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['FBV_uniqId']->value) {?>
	<?php if ($_smarty_tpl->tpl_vars['FBV_multilingual']->value) {?>
		<?php $_smarty_tpl->_assignInScope('forElement', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_id']->value,"-",$_smarty_tpl->tpl_vars['formLocale']->value,"-",$_smarty_tpl->tpl_vars['FBV_uniqId']->value )));?>
	<?php } else { ?>
		<?php $_smarty_tpl->_assignInScope('forElement', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_id']->value,"-",$_smarty_tpl->tpl_vars['FBV_uniqId']->value )));?>
	<?php }
} else { ?>
	<?php $_smarty_tpl->_assignInScope('forElement', $_smarty_tpl->tpl_vars['FBV_id']->value);
}?>
<label class="sub_label<?php if ($_smarty_tpl->tpl_vars['FBV_error']->value) {?> error<?php }?>" <?php if (!$_smarty_tpl->tpl_vars['FBV_suppressId']->value) {?> for="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['forElement']->value ));?>
"<?php }?>>
	<?php if ($_smarty_tpl->tpl_vars['FBV_subLabelTranslate']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_label']->value ))),$_smarty_tpl ) );
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_label']->value ));
}
if ($_smarty_tpl->tpl_vars['FBV_required']->value) {?><span class="req">*</span><?php }?>
</label>
<?php }
}
