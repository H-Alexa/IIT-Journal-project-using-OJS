<?php
/* Smarty version 3.1.39, created on 2021-09-27 20:14:09
  from 'app:controllersgridusersstage' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_615209f15b9515_54305130',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ab1597004e611fd0a9d0d6dc376fc76586701af5' => 
    array (
      0 => 'app:controllersgridusersstage',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_615209f15b9515_54305130 (Smarty_Internal_Template $_smarty_tpl) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['help'][0], array( array('file'=>"editorial-workflow",'section'=>"participants",'class'=>"pkp_help_modal"),$_smarty_tpl ) );?>


<?php echo '<script'; ?>
 type="text/javascript">
	$(function() {
		// Attach the form handler.
		$('#addParticipantForm').pkpHandler('$.pkp.controllers.grid.users.stageParticipant.form.StageParticipantNotifyHandler',
			{
				possibleRecommendOnlyUserGroupIds: <?php echo json_encode($_smarty_tpl->tpl_vars['possibleRecommendOnlyUserGroupIds']->value);?>
,
				recommendOnlyUserGroupIds: <?php echo json_encode($_smarty_tpl->tpl_vars['recommendOnlyUserGroupIds']->value);?>
,
				anonymousReviewerIds: <?php echo json_encode($_smarty_tpl->tpl_vars['anonymousReviewerIds']->value);?>
,
				anonymousReviewerWarning: <?php echo json_encode($_smarty_tpl->tpl_vars['anonymousReviewerWarning']->value);?>
,
				anonymousReviewerWarningOk: <?php echo json_encode($_smarty_tpl->tpl_vars['anonymousReviewerWarningOk']->value);?>
,
				templateUrl: <?php echo json_encode(call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>'grid.users.stageParticipant.StageParticipantGridHandler','op'=>'fetchTemplateBody','stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'escape'=>false),$_smarty_tpl ) ));?>
,
				notChangeMetadataEditPermissionRoles: <?php echo json_encode($_smarty_tpl->tpl_vars['notPossibleEditSubmissionMetadataPermissionChange']->value);?>
,
				permitMetadataEditUserGroupIds: <?php echo json_encode($_smarty_tpl->tpl_vars['permitMetadataEditUserGroupIds']->value);?>

			}
		);
	});
<?php echo '</script'; ?>
>

<form class="pkp_form" id="addParticipantForm" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"saveParticipant"),$_smarty_tpl ) );?>
" method="post">
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

	<div class="pkp_helpers_clear"></div>

	<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"addParticipant"));
$_block_repeat=true;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>"addParticipant"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<input type="hidden" name="submissionId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['submissionId']->value ));?>
" />
		<input type="hidden" name="stageId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['stageId']->value ));?>
" />
		<input type="hidden" name="userGroupId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['userGroupId']->value ));?>
" />
		<input type="hidden" name="userIdSelected" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['userIdSelected']->value ));?>
" />
		<input type="hidden" name="assignmentId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['assignmentId']->value ));?>
" />

		<?php if ($_smarty_tpl->tpl_vars['assignmentId']->value) {?>
			<input type="hidden" name="userId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['userIdSelected']->value ));?>
" />
			<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"stageParticipants.selectedUser"));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"stageParticipants.selectedUser"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<b><?php echo $_smarty_tpl->tpl_vars['currentUserName']->value;?>
</b> (<?php echo $_smarty_tpl->tpl_vars['currentUserGroup']->value;?>
)
			<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"stageParticipants.selectedUser"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

			<?php if ($_smarty_tpl->tpl_vars['isChangeRecommendOnlyAllowed']->value) {?>
				<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"stageParticipants.options",'list'=>"true",'class'=>"recommendOnlyWrapperNoJavascript"));
$_block_repeat=true;
echo $_block_plugin3->smartyFBVFormSection(array('title'=>"stageParticipants.options",'list'=>"true",'class'=>"recommendOnlyWrapperNoJavascript"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'name'=>"recommendOnly",'id'=>"recommendOnly",'label'=>"stageParticipants.recommendOnly",'checked'=>$_smarty_tpl->tpl_vars['currentAssignmentRecommendOnly']->value),$_smarty_tpl ) );?>

				<?php $_block_repeat=false;
echo $_block_plugin3->smartyFBVFormSection(array('title'=>"stageParticipants.options",'list'=>"true",'class'=>"recommendOnlyWrapperNoJavascript"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['isChangePermitMetadataAllowed']->value) {?>
				<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"stageParticipants.submissionEditMetadataOptions",'list'=>"true",'class'=>"submissionEditMetadataPermitNoJavascript"));
$_block_repeat=true;
echo $_block_plugin4->smartyFBVFormSection(array('title'=>"stageParticipants.submissionEditMetadataOptions",'list'=>"true",'class'=>"submissionEditMetadataPermitNoJavascript"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'name'=>"canChangeMetadata",'id'=>"canChangeMetadata",'label'=>"stageParticipants.canChangeMetadata",'checked'=>$_smarty_tpl->tpl_vars['currentAssignmentPermitMetadataEdit']->value),$_smarty_tpl ) );?>

				<?php $_block_repeat=false;
echo $_block_plugin4->smartyFBVFormSection(array('title'=>"stageParticipants.submissionEditMetadataOptions",'list'=>"true",'class'=>"submissionEditMetadataPermitNoJavascript"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php }?>

			<?php if (!$_smarty_tpl->tpl_vars['isChangePermitMetadataAllowed']->value && !$_smarty_tpl->tpl_vars['isChangeRecommendOnlyAllowed']->value) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"stageParticipants.noOptionsToHandle"),$_smarty_tpl ) );?>

			<?php }?>
		<?php } else { ?>
			<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'userSelectGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.users.userSelect.UserSelectGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>'userSelectGridContainer','url'=>$_smarty_tpl->tpl_vars['userSelectGridUrl']->value),$_smarty_tpl ) );?>


			<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"stageParticipants.options",'list'=>"true",'class'=>"recommendOnlyWrapper"));
$_block_repeat=true;
echo $_block_plugin5->smartyFBVFormSection(array('title'=>"stageParticipants.options",'list'=>"true",'class'=>"recommendOnlyWrapper"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'name'=>"recommendOnly",'id'=>"recommendOnly",'label'=>"stageParticipants.recommendOnly"),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin5->smartyFBVFormSection(array('title'=>"stageParticipants.options",'list'=>"true",'class'=>"recommendOnlyWrapper"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

			<?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"stageParticipants.submissionEditMetadataOptions",'list'=>"true",'class'=>"submissionEditMetadataPermit"));
$_block_repeat=true;
echo $_block_plugin6->smartyFBVFormSection(array('title'=>"stageParticipants.submissionEditMetadataOptions",'list'=>"true",'class'=>"submissionEditMetadataPermit"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'name'=>"canChangeMetadata",'id'=>"canChangeMetadata",'label'=>"stageParticipants.canChangeMetadata"),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin6->smartyFBVFormSection(array('title'=>"stageParticipants.submissionEditMetadataOptions",'list'=>"true",'class'=>"submissionEditMetadataPermit"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>
	<?php $_block_repeat=false;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>"addParticipant"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php if (!(isset($_smarty_tpl->tpl_vars['assignmentId']->value))) {?>
		<?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"notifyFormArea"));
$_block_repeat=true;
echo $_block_plugin7->smartyFBVFormArea(array('id'=>"notifyFormArea"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"stageParticipants.notify.chooseMessage",'for'=>"template",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['medium']));
$_block_repeat=true;
echo $_block_plugin8->smartyFBVFormSection(array('title'=>"stageParticipants.notify.chooseMessage",'for'=>"template",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['medium']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"select",'from'=>$_smarty_tpl->tpl_vars['templates']->value,'translate'=>false,'id'=>"template",'defaultValue'=>'','defaultLabel'=>''),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin8->smartyFBVFormSection(array('title'=>"stageParticipants.notify.chooseMessage",'for'=>"template",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['medium']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

			<?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"stageParticipants.notify.message",'for'=>"message"));
$_block_repeat=true;
echo $_block_plugin9->smartyFBVFormSection(array('title'=>"stageParticipants.notify.message",'for'=>"message"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'id'=>"message",'rich'=>true),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin9->smartyFBVFormSection(array('title'=>"stageParticipants.notify.message",'for'=>"message"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<p><span class="formRequired"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.requiredField"),$_smarty_tpl ) );?>
</span></p>
		<?php $_block_repeat=false;
echo $_block_plugin7->smartyFBVFormArea(array('id'=>"notifyFormArea"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array(),$_smarty_tpl ) );?>

</form>
<?php }
}
