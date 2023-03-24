<?php
/* Smarty version 3.1.39, created on 2021-09-27 19:58:35
  from 'app:submissionsubmissionMetad' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152064ba12554_61358998',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e0638d63205727cdd3162ef4f8c2bd1c2699be17' => 
    array (
      0 => 'app:submissionsubmissionMetad',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152064ba12554_61358998 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['formParams']->value['submissionVersion'] && ($_smarty_tpl->tpl_vars['formParams']->value['submissionVersion'] < $_smarty_tpl->tpl_vars['currentSubmissionVersion']->value)) {?>
  <?php $_smarty_tpl->_assignInScope('readOnly', 1);
} else { ?>
	<?php $_smarty_tpl->_assignInScope('readOnly', 0);
}
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"hidden",'name'=>"submissionVersion",'id'=>"submissionVersion",'value'=>$_smarty_tpl->tpl_vars['formParams']->value['submissionVersion']),$_smarty_tpl ) );?>

<div class="pkp_helpers_clear">
	<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('for'=>"title",'title'=>"common.prefix",'inline'=>"true",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['SMALL']));
$_block_repeat=true;
echo $_block_plugin1->smartyFBVFormSection(array('for'=>"title",'title'=>"common.prefix",'inline'=>"true",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['SMALL']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('label'=>"common.prefixAndTitle.tip",'type'=>"text",'multilingual'=>true,'name'=>"prefix",'id'=>"prefix",'value'=>$_smarty_tpl->tpl_vars['prefix']->value,'readonly'=>$_smarty_tpl->tpl_vars['readOnly']->value,'maxlength'=>"32"),$_smarty_tpl ) );?>

	<?php $_block_repeat=false;
echo $_block_plugin1->smartyFBVFormSection(array('for'=>"title",'title'=>"common.prefix",'inline'=>"true",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['SMALL']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('for'=>"title",'title'=>"common.title",'inline'=>"true",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['LARGE'],'required'=>true));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array('for'=>"title",'title'=>"common.title",'inline'=>"true",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['LARGE'],'required'=>true), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'multilingual'=>true,'name'=>"title",'id'=>"title",'value'=>$_smarty_tpl->tpl_vars['title']->value,'readonly'=>$_smarty_tpl->tpl_vars['readOnly']->value,'maxlength'=>"255",'required'=>true),$_smarty_tpl ) );?>

	<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array('for'=>"title",'title'=>"common.title",'inline'=>"true",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['LARGE'],'required'=>true), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
</div>
<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"common.subtitle",'for'=>"subtitle"));
$_block_repeat=true;
echo $_block_plugin3->smartyFBVFormSection(array('title'=>"common.subtitle",'for'=>"subtitle"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'multilingual'=>true,'name'=>"subtitle",'id'=>"subtitle",'value'=>$_smarty_tpl->tpl_vars['subtitle']->value,'readonly'=>$_smarty_tpl->tpl_vars['readOnly']->value),$_smarty_tpl ) );?>

<?php $_block_repeat=false;
echo $_block_plugin3->smartyFBVFormSection(array('title'=>"common.subtitle",'for'=>"subtitle"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"common.abstract",'for'=>"abstract",'required'=>$_smarty_tpl->tpl_vars['abstractsRequired']->value));
$_block_repeat=true;
echo $_block_plugin4->smartyFBVFormSection(array('title'=>"common.abstract",'for'=>"abstract",'required'=>$_smarty_tpl->tpl_vars['abstractsRequired']->value), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php if ($_smarty_tpl->tpl_vars['wordCount']->value) {?>
		<p class="pkp_help"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.abstract.wordCount.description",'wordCount'=>$_smarty_tpl->tpl_vars['wordCount']->value),$_smarty_tpl ) );?>

	<?php }?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'multilingual'=>true,'name'=>"abstract",'id'=>"abstract",'value'=>$_smarty_tpl->tpl_vars['abstract']->value,'rich'=>"extended",'readonly'=>$_smarty_tpl->tpl_vars['readOnly']->value,'wordCount'=>$_smarty_tpl->tpl_vars['wordCount']->value),$_smarty_tpl ) );?>

<?php $_block_repeat=false;
echo $_block_plugin4->smartyFBVFormSection(array('title'=>"common.abstract",'for'=>"abstract",'required'=>$_smarty_tpl->tpl_vars['abstractsRequired']->value), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
