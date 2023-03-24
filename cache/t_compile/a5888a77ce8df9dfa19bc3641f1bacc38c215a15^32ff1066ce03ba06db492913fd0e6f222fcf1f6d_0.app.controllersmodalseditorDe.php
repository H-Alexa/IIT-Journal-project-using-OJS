<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:19:19
  from 'app:controllersmodalseditorDe' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152b3e797e4c3_07633184',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '32ff1066ce03ba06db492913fd0e6f222fcf1f6d' => 
    array (
      0 => 'app:controllersmodalseditorDe',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152b3e797e4c3_07633184 (Smarty_Internal_Template $_smarty_tpl) {
if (count($_smarty_tpl->tpl_vars['reviewers']->value)) {?>
	<?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"submission.comments.sendToReviewers"));
$_block_repeat=true;
echo $_block_plugin6->smartyFBVFormSection(array('title'=>"submission.comments.sendToReviewers"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<span class="description"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.comments.sendCopyToReviewers"),$_smarty_tpl ) );?>
</span>
		<ul class="checkbox_and_radiobutton">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reviewers']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'id'=>"bccReviewers[]",'value'=>$_smarty_tpl->tpl_vars['id']->value,'checked'=>in_array($_smarty_tpl->tpl_vars['id']->value,$_smarty_tpl->tpl_vars['selected']->value),'label'=>$_smarty_tpl->tpl_vars['name']->value,'translate'=>false),$_smarty_tpl ) );?>

			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ul>
	<?php $_block_repeat=false;
echo $_block_plugin6->smartyFBVFormSection(array('title'=>"submission.comments.sendToReviewers"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
}
