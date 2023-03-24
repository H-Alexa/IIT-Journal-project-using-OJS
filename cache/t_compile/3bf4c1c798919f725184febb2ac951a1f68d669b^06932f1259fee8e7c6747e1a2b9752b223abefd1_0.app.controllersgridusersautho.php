<?php
/* Smarty version 3.1.39, created on 2021-09-27 20:01:13
  from 'app:controllersgridusersautho' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_615206e9a48d56_88555569',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '06932f1259fee8e7c6747e1a2b9752b223abefd1' => 
    array (
      0 => 'app:controllersgridusersautho',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/notification/inPlaceNotification.tpl' => 1,
    'app:common/userDetails.tpl' => 1,
  ),
),false)) {
function content_615206e9a48d56_88555569 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
	$(function() {
		$('#editAuthor').pkpHandler(
			'$.pkp.controllers.form.AjaxFormHandler'
		);
	});
<?php echo '</script'; ?>
>

<form class="pkp_form" id="editAuthor" method="post" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"updateAuthor",'authorId'=>$_smarty_tpl->tpl_vars['authorId']->value),$_smarty_tpl ) );?>
">
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

	<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/inPlaceNotification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('notificationId'=>"authorFormNotification"), 0, false);
?>

	<?php $_smarty_tpl->_subTemplateRender("app:common/userDetails.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('disableUserNameSection'=>true,'disableAuthSourceSection'=>true,'disablePasswordSection'=>true,'disableSendNotifySection'=>true,'disableSalutationSection'=>true,'disableInitialsSection'=>true,'disablePhoneSection'=>true,'disableLocaleSection'=>true,'disableInterestsSection'=>true,'disableMailingSection'=>true,'disableSignatureSection'=>true,'extraContentSectionUnfolded'=>true,'countryRequired'=>true), 0, false);
?>

	<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"submissionSpecific"));
$_block_repeat=true;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>"submissionSpecific"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('id'=>"userGroupId",'title'=>"submission.submit.contributorRole",'list'=>true,'required'=>true));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array('id'=>"userGroupId",'title'=>"submission.submit.contributorRole",'list'=>true,'required'=>true), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['iterate'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['iterate'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyIterate'))) {
throw new SmartyException('block tag \'iterate\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('iterate', array('from'=>'authorUserGroups','item'=>'userGroup'));
$_block_repeat=true;
echo $_block_plugin3->smartyIterate(array('from'=>'authorUserGroups','item'=>'userGroup'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php if ($_smarty_tpl->tpl_vars['userGroupId']->value == $_smarty_tpl->tpl_vars['userGroup']->value->getId()) {
$_smarty_tpl->_assignInScope('checked', true);
} else {
$_smarty_tpl->_assignInScope('checked', false);
}?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'id'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "userGroup",$_smarty_tpl->tpl_vars['userGroup']->value->getId() )),'name'=>"userGroupId",'value'=>$_smarty_tpl->tpl_vars['userGroup']->value->getId(),'checked'=>$_smarty_tpl->tpl_vars['checked']->value,'label'=>$_smarty_tpl->tpl_vars['userGroup']->value->getLocalizedName(),'translate'=>false),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin3->smartyIterate(array('from'=>'authorUserGroups','item'=>'userGroup'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array('id'=>"userGroupId",'title'=>"submission.submit.contributorRole",'list'=>true,'required'=>true), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('list'=>"true"));
$_block_repeat=true;
echo $_block_plugin4->smartyFBVFormSection(array('list'=>"true"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'label'=>"submission.submit.selectPrincipalContact",'id'=>"primaryContact",'checked'=>$_smarty_tpl->tpl_vars['primaryContact']->value),$_smarty_tpl ) );?>

			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'label'=>"submission.submit.includeInBrowse",'id'=>"includeInBrowse",'checked'=>$_smarty_tpl->tpl_vars['includeInBrowse']->value),$_smarty_tpl ) );?>

			<?php echo $_smarty_tpl->tpl_vars['additionalCheckboxes']->value;?>

		<?php $_block_repeat=false;
echo $_block_plugin4->smartyFBVFormSection(array('list'=>"true"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php $_block_repeat=false;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>"submissionSpecific"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php if ($_smarty_tpl->tpl_vars['submissionId']->value) {?>
		<input type="hidden" name="submissionId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['submissionId']->value ));?>
" />
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['publicationId']->value) {?>
		<input type="hidden" name="publicationId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['publicationId']->value ));?>
" />
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['gridId']->value) {?>
		<input type="hidden" name="gridId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['gridId']->value ));?>
" />
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['rowId']->value) {?>
		<input type="hidden" name="rowId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['rowId']->value ));?>
" />
	<?php }?>

	<p><span class="formRequired"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.requiredField"),$_smarty_tpl ) );?>
</span></p>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('id'=>"step2Buttons",'submitText'=>"common.save"),$_smarty_tpl ) );?>

</form>
<?php }
}
