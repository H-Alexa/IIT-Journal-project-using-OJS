<?php
/* Smarty version 3.1.39, created on 2021-09-27 18:21:19
  from 'app:formhiddenInput.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151ef7f91da37_92618172',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1506229aed1c1fbffe0f875462eaf53159807b5f' => 
    array (
      0 => 'app:formhiddenInput.tpl',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6151ef7f91da37_92618172 (Smarty_Internal_Template $_smarty_tpl) {
?><input type="hidden"
	  id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_id']->value ));?>
"
	  name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_name']->value ));?>
"
	  class="<?php echo $_smarty_tpl->tpl_vars['FBV_class']->value;
if ($_smarty_tpl->tpl_vars['FBV_validation']->value) {?> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_validation']->value ));
}?>"
	  value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_value']->value ));?>
"
	  <?php echo $_smarty_tpl->tpl_vars['FBV_hiddenInputParams']->value;?>
 />
<?php }
}
