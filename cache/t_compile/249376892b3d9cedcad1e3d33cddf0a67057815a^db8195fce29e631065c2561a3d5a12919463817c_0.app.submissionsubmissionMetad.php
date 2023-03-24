<?php
/* Smarty version 3.1.39, created on 2021-09-27 19:58:35
  from 'app:submissionsubmissionMetad' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152064bbb65e5_27698025',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db8195fce29e631065c2561a3d5a12919463817c' => 
    array (
      0 => 'app:submissionsubmissionMetad',
      1 => 1624492110,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'core:submission/submissionMetadataFormFields.tpl' => 1,
  ),
),false)) {
function content_6152064bbb65e5_27698025 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "languagesField", null);?>
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "sectionDescription", null);
if (!$_smarty_tpl->tpl_vars['readOnly']->value) {?>submission.submit.metadataForm.tip<?php }
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('description'=>$_smarty_tpl->tpl_vars['sectionDescription']->value,'label'=>"common.languages",'required'=>$_smarty_tpl->tpl_vars['languagesRequired']->value));
$_block_repeat=true;
echo $_block_plugin5->smartyFBVFormSection(array('description'=>$_smarty_tpl->tpl_vars['sectionDescription']->value,'label'=>"common.languages",'required'=>$_smarty_tpl->tpl_vars['languagesRequired']->value), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'languagesSourceUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_PAGE') ? constant('ROUTE_PAGE') : null),'page'=>"submission",'op'=>"fetchChoices",'list'=>"languages"),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"keyword",'id'=>"languages",'subLabelTranslate'=>true,'multilingual'=>true,'current'=>$_smarty_tpl->tpl_vars['languages']->value,'sourceUrl'=>$_smarty_tpl->tpl_vars['languagesSourceUrl']->value,'disabled'=>$_smarty_tpl->tpl_vars['readOnly']->value),$_smarty_tpl ) );?>

	<?php $_block_repeat=false;
echo $_block_plugin5->smartyFBVFormSection(array('description'=>$_smarty_tpl->tpl_vars['sectionDescription']->value,'label'=>"common.languages",'required'=>$_smarty_tpl->tpl_vars['languagesRequired']->value), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
$_smarty_tpl->_subTemplateRender("core:submission/submissionMetadataFormFields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
