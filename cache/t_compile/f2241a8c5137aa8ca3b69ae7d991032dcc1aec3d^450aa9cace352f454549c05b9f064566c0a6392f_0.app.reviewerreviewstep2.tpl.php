<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:57:57
  from 'app:reviewerreviewstep2.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152aee531b9f9_65548560',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '450aa9cace352f454549c05b9f064566c0a6392f' => 
    array (
      0 => 'app:reviewerreviewstep2.tpl',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/notification/inPlaceNotification.tpl' => 1,
  ),
),false)) {
function content_6152aee531b9f9_65548560 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
	$(function() {
		// Attach the form handler.
		$('#reviewStep2Form').pkpHandler(
			'$.pkp.controllers.form.AjaxFormHandler'
		);
	});
<?php echo '</script'; ?>
>

<form class="pkp_form" id="reviewStep2Form" method="post" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"reviewer",'op'=>"saveStep",'path'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'step'=>"2",'escape'=>false),$_smarty_tpl ) );?>
">
<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/inPlaceNotification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('notificationId'=>"reviewStep2FormNotification"), 0, false);
?>

<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"reviewStep2"));
$_block_repeat=true;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>"reviewStep2"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>"reviewer.submission.reviewerGuidelines"));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array('label'=>"reviewer.submission.reviewerGuidelines"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<p><?php echo $_smarty_tpl->tpl_vars['reviewerGuidelines']->value;?>
</p>
	<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array('label'=>"reviewer.submission.reviewerGuidelines"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'cancelUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"reviewer",'op'=>"submission",'path'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'step'=>1,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('submitText'=>"reviewer.submission.continueToStepThree",'cancelText'=>"navigation.goBack",'cancelUrl'=>$_smarty_tpl->tpl_vars['cancelUrl']->value,'cancelUrlTarget'=>"_self",'submitDisabled'=>$_smarty_tpl->tpl_vars['reviewIsClosed']->value),$_smarty_tpl ) );?>

<?php $_block_repeat=false;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>"reviewStep2"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
</form>
<?php }
}
