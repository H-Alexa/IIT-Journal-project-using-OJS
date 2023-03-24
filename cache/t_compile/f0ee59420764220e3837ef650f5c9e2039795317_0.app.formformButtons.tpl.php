<?php
/* Smarty version 3.1.39, created on 2021-09-27 18:35:04
  from 'app:formformButtons.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151f2b869c144_96724575',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f0ee59420764220e3837ef650f5c9e2039795317' => 
    array (
      0 => 'app:formformButtons.tpl',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:linkAction/buttonConfirmationLinkAction.tpl' => 1,
    'app:linkAction/buttonGenericLinkAction.tpl' => 1,
    'app:linkAction/buttonRedirectLinkAction.tpl' => 1,
  ),
),false)) {
function content_6151f2b869c144_96724575 (Smarty_Internal_Template $_smarty_tpl) {
$_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('class'=>"formButtons form_buttons"));
$_block_repeat=true;
echo $_block_plugin3->smartyFBVFormSection(array('class'=>"formButtons form_buttons"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>

		<span class="pkp_spinner"></span>

		<?php $_smarty_tpl->_assignInScope('submitButtonId', uniqid(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "submitFormButton","-" ))));?>

		<?php if ($_smarty_tpl->tpl_vars['FBV_confirmSubmit']->value) {?>
		<?php $_smarty_tpl->_subTemplateRender("app:linkAction/buttonConfirmationLinkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('buttonSelector'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "#",$_smarty_tpl->tpl_vars['submitButtonId']->value )),'dialogText'=>((string)$_smarty_tpl->tpl_vars['FBV_confirmSubmit']->value)), 0, false);
?>
	<?php }?>

	<?php ob_start();
if ($_smarty_tpl->tpl_vars['FBV_saveText']->value) {
echo "pkp_button_primary";
}
$_prefixVariable1=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"submit",'class'=>$_prefixVariable1." submitFormButton",'name'=>"submitFormButton",'id'=>$_smarty_tpl->tpl_vars['submitButtonId']->value,'label'=>$_smarty_tpl->tpl_vars['FBV_submitText']->value,'translate'=>$_smarty_tpl->tpl_vars['FBV_translate']->value,'disabled'=>$_smarty_tpl->tpl_vars['FBV_submitDisabled']->value),$_smarty_tpl ) );?>


		<?php if ($_smarty_tpl->tpl_vars['FBV_saveText']->value) {?>
		<?php $_smarty_tpl->_assignInScope('saveButtonId', uniqid(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "saveFormButton","-" ))));?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"submit",'class'=>"saveFormButton",'name'=>"saveFormButton",'id'=>$_smarty_tpl->tpl_vars['saveButtonId']->value,'label'=>$_smarty_tpl->tpl_vars['FBV_saveText']->value,'disabled'=>$_smarty_tpl->tpl_vars['FBV_submitDisabled']->value),$_smarty_tpl ) );?>

	<?php }?>

		<?php if (!$_smarty_tpl->tpl_vars['FBV_hideCancel']->value) {?>
		<?php $_smarty_tpl->_assignInScope('cancelButtonId', uniqid(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "cancelFormButton","-" ))));?>
		<?php if ($_smarty_tpl->tpl_vars['FBV_cancelAction']->value) {?>
			<?php $_smarty_tpl->_subTemplateRender("app:linkAction/buttonGenericLinkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('buttonSelector'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "#",$_smarty_tpl->tpl_vars['cancelButtonId']->value )),'action'=>$_smarty_tpl->tpl_vars['FBV_cancelAction']->value), 0, false);
?>
		<?php } elseif ($_smarty_tpl->tpl_vars['FBV_cancelUrl']->value) {?>
			<?php $_smarty_tpl->_subTemplateRender("app:linkAction/buttonRedirectLinkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('buttonSelector'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "#",$_smarty_tpl->tpl_vars['cancelButtonId']->value )),'cancelUrl'=>$_smarty_tpl->tpl_vars['FBV_cancelUrl']->value,'cancelUrlTarget'=>$_smarty_tpl->tpl_vars['FBV_cancelUrlTarget']->value), 0, false);
?>
		<?php }?>
		<a href="#" id="<?php echo $_smarty_tpl->tpl_vars['cancelButtonId']->value;?>
" class="cancelButton"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['FBV_cancelText']->value),$_smarty_tpl ) );?>
</a>
	<?php }
$_block_repeat=false;
echo $_block_plugin3->smartyFBVFormSection(array('class'=>"formButtons form_buttons"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
