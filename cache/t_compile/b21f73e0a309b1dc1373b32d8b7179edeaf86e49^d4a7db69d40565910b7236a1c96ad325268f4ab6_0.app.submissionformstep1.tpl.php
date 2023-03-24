<?php
/* Smarty version 3.1.39, created on 2021-09-27 19:46:57
  from 'app:submissionformstep1.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_615203918d0d92_73284862',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd4a7db69d40565910b7236a1c96ad325268f4ab6' => 
    array (
      0 => 'app:submissionformstep1.tpl',
      1 => 1624492110,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:submission/form/sectionPolicy.tpl' => 1,
    'app:submission/form/section.tpl' => 1,
    'core:submission/form/step1.tpl' => 1,
  ),
),false)) {
function content_615203918d0d92_73284862 (Smarty_Internal_Template $_smarty_tpl) {
if (count($_smarty_tpl->tpl_vars['sectionOptions']->value) == 1) {?>
	 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"author.submit.notAccepting"),$_smarty_tpl ) );?>

<?php } elseif ($_smarty_tpl->tpl_vars['currentContext']->value->getData('disableSubmissions')) {?>
	<notification>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"manager.setup.disableSubmissions.notAccepting"),$_smarty_tpl ) );?>

	</notification>
<?php } else { ?>
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "additionalFormContent2", null);?>
		<?php if (count($_smarty_tpl->tpl_vars['sectionOptions']->value) == 2) {?>
						<?php $_smarty_tpl->_assignInScope('preselectedSectionId', array_pop(array_keys($_smarty_tpl->tpl_vars['sectionOptions']->value)));?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"hidden",'id'=>"sectionId",'value'=>$_smarty_tpl->tpl_vars['preselectedSectionId']->value),$_smarty_tpl ) );?>


			<?php if ($_smarty_tpl->tpl_vars['sectionPolicies']->value[$_smarty_tpl->tpl_vars['preselectedSectionId']->value]) {?>
				<?php $_smarty_tpl->_subTemplateRender("app:submission/form/sectionPolicy.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('sectionId'=>$_smarty_tpl->tpl_vars['preselectedSectionId']->value,'content'=>$_smarty_tpl->tpl_vars['sectionPolicies']->value[$_smarty_tpl->tpl_vars['preselectedSectionId']->value]), 0, false);
?>
			<?php }?>
		<?php } else { ?>
			<?php $_smarty_tpl->_subTemplateRender("app:submission/form/section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php }?>
	<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

	<?php $_smarty_tpl->_subTemplateRender("core:submission/form/step1.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
}
