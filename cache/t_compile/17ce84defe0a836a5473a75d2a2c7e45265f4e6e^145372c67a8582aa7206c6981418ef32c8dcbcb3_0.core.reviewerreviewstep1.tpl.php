<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:57:20
  from 'core:reviewerreviewstep1.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152aec0c50157_56840584',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '145372c67a8582aa7206c6981418ef32c8dcbcb3' => 
    array (
      0 => 'core:reviewerreviewstep1.tpl',
      1 => 1624492183,
      2 => 'core',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/notification/inPlaceNotification.tpl' => 1,
    'app:linkAction/linkAction.tpl' => 3,
  ),
),false)) {
function content_6152aec0c50157_56840584 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\OJS\\lib\\pkp\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
echo '<script'; ?>
 type="text/javascript">
	$(function() {
		// Attach the form handler.
		$('#reviewStep1Form').pkpHandler(
			'$.pkp.controllers.form.AjaxFormHandler'
		);
	});
<?php echo '</script'; ?>
>

<form class="pkp_form" id="reviewStep1Form" method="post" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"reviewer",'op'=>"saveStep",'path'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'step'=>"1",'escape'=>false),$_smarty_tpl ) );?>
">
<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/inPlaceNotification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('notificationId'=>"reviewStep1FormNotification"), 0, false);
?>

<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"reviewStep1"));
$_block_repeat=true;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>"reviewStep1"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"reviewer.step1.request"));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"reviewer.step1.request"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<p><?php echo nl2br($_smarty_tpl->tpl_vars['reviewerRequest']->value);?>
</p>
	<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"reviewer.step1.request"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>"submission.title"));
$_block_repeat=true;
echo $_block_plugin3->smartyFBVFormSection(array('label'=>"submission.title"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( $_smarty_tpl->tpl_vars['submission']->value->getLocalizedTitle() ));?>

	<?php $_block_repeat=false;
echo $_block_plugin3->smartyFBVFormSection(array('label'=>"submission.title"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>$_smarty_tpl->tpl_vars['descriptionFieldKey']->value));
$_block_repeat=true;
echo $_block_plugin4->smartyFBVFormSection(array('label'=>$_smarty_tpl->tpl_vars['descriptionFieldKey']->value), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( $_smarty_tpl->tpl_vars['submission']->value->getLocalizedAbstract() ));?>

	<?php $_block_repeat=false;
echo $_block_plugin4->smartyFBVFormSection(array('label'=>$_smarty_tpl->tpl_vars['descriptionFieldKey']->value), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>"editor.submissionReview.reviewType"));
$_block_repeat=true;
echo $_block_plugin5->smartyFBVFormSection(array('label'=>"editor.submissionReview.reviewType"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['reviewMethod']->value ));?>

	<?php $_block_repeat=false;
echo $_block_plugin5->smartyFBVFormSection(array('label'=>"editor.submissionReview.reviewType"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php if (!$_smarty_tpl->tpl_vars['restrictReviewerFileAccess']->value) {?>
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'reviewFilesGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.review.ReviewerReviewFilesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['reviewAssignment']->value->getStageId(),'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'reviewAssignmentId'=>$_smarty_tpl->tpl_vars['reviewAssignment']->value->getId(),'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"reviewFilesStep1",'url'=>$_smarty_tpl->tpl_vars['reviewFilesGridUrl']->value),$_smarty_tpl ) );?>

	<?php }?>

	<div class="pkp_linkActions">
		<?php $_smarty_tpl->_subTemplateRender("app:linkAction/linkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('action'=>$_smarty_tpl->tpl_vars['viewMetadataAction']->value,'contextId'=>"reviewStep1Form"), 0, false);
?>
	</div>
	<br /><br />

	<?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"reviewer.submission.reviewSchedule"));
$_block_repeat=true;
echo $_block_plugin6->smartyFBVFormSection(array('title'=>"reviewer.submission.reviewSchedule"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'id'=>"dateNotified",'label'=>"reviewer.submission.reviewRequestDate",'value'=>smarty_modifier_date_format($_smarty_tpl->tpl_vars['submission']->value->getDateNotified(),$_smarty_tpl->tpl_vars['dateFormatShort']->value),'readonly'=>true,'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['SMALL']),$_smarty_tpl ) );?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'id'=>"responseDue",'label'=>"reviewer.submission.responseDueDate",'value'=>smarty_modifier_date_format($_smarty_tpl->tpl_vars['submission']->value->getDateResponseDue(),$_smarty_tpl->tpl_vars['dateFormatShort']->value),'readonly'=>true,'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['SMALL']),$_smarty_tpl ) );?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'id'=>"dateDue",'label'=>"reviewer.submission.reviewDueDate",'value'=>smarty_modifier_date_format($_smarty_tpl->tpl_vars['submission']->value->getDateDue(),$_smarty_tpl->tpl_vars['dateFormatShort']->value),'readonly'=>true,'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['SMALL']),$_smarty_tpl ) );?>

	<?php $_block_repeat=false;
echo $_block_plugin6->smartyFBVFormSection(array('title'=>"reviewer.submission.reviewSchedule"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<br /><br />
		<div class="pkp_linkActions">
			<?php $_smarty_tpl->_subTemplateRender("app:linkAction/linkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('action'=>$_smarty_tpl->tpl_vars['aboutDueDatesAction']->value,'contextId'=>"reviewStep1"), 0, true);
?>
		</div>
	<br /><br />
	<?php if ($_smarty_tpl->tpl_vars['competingInterestsAction']->value) {?>
		<?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>"reviewer.submission.competingInterests",'description'=>"reviewer.submission.enterCompetingInterests"));
$_block_repeat=true;
echo $_block_plugin7->smartyFBVFormSection(array('label'=>"reviewer.submission.competingInterests",'description'=>"reviewer.submission.enterCompetingInterests"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<div class="pkp_linkActions">
				<?php $_smarty_tpl->_subTemplateRender("app:linkAction/linkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('action'=>$_smarty_tpl->tpl_vars['competingInterestsAction']->value,'contextId'=>"reviewStep1"), 0, true);
?>
			</div>
		<?php $_block_repeat=false;
echo $_block_plugin7->smartyFBVFormSection(array('label'=>"reviewer.submission.competingInterests",'description'=>"reviewer.submission.enterCompetingInterests"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['currentContext']->value->getData('competingInterests')) {?>
		<?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('list'=>true));
$_block_repeat=true;
echo $_block_plugin8->smartyFBVFormSection(array('list'=>true), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'value'=>"noCompetingInterests",'id'=>"noCompetingInterests",'name'=>"competingInterestOption",'checked'=>!$_smarty_tpl->tpl_vars['reviewerCompetingInterests']->value,'label'=>"reviewer.submission.noCompetingInterests",'disabled'=>$_smarty_tpl->tpl_vars['reviewIsClosed']->value),$_smarty_tpl ) );?>

			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'value'=>"hasCompetingInterests",'id'=>"hasCompetingInterests",'name'=>"competingInterestOption",'checked'=>!!$_smarty_tpl->tpl_vars['reviewerCompetingInterests']->value,'label'=>"reviewer.submission.hasCompetingInterests",'disabled'=>$_smarty_tpl->tpl_vars['reviewIsClosed']->value),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin8->smartyFBVFormSection(array('list'=>true), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

		<?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin9->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'name'=>"reviewerCompetingInterests",'id'=>"reviewerCompetingInterests",'value'=>$_smarty_tpl->tpl_vars['reviewerCompetingInterests']->value,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'disabled'=>$_smarty_tpl->tpl_vars['reviewIsClosed']->value,'rich'=>true),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin9->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }?>

	<?php if (!$_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateConfirmed() && $_smarty_tpl->tpl_vars['currentContext']->value->getData('privacyStatement')) {?>
		<?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('list'=>true));
$_block_repeat=true;
echo $_block_plugin10->smartyFBVFormSection(array('list'=>true), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "privacyUrl", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_PAGE') ? constant('ROUTE_PAGE') : null),'page'=>"about",'op'=>"privacy"),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
			<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "privacyLabel", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.register.form.privacyConsent",'privacyUrl'=>$_smarty_tpl->tpl_vars['privacyUrl']->value),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'id'=>"privacyConsent",'required'=>true,'value'=>1,'label'=>$_smarty_tpl->tpl_vars['privacyLabel']->value,'translate'=>false,'checked'=>$_smarty_tpl->tpl_vars['privacyConsent']->value),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin10->smartyFBVFormSection(array('list'=>true), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateConfirmed()) {?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('hideCancel'=>true,'submitText'=>"common.saveAndContinue",'submitDisabled'=>$_smarty_tpl->tpl_vars['reviewIsClosed']->value),$_smarty_tpl ) );?>

	<?php } elseif (!$_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateConfirmed()) {?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('submitText'=>"reviewer.submission.acceptReview",'cancelText'=>"reviewer.submission.declineReview",'cancelAction'=>$_smarty_tpl->tpl_vars['declineReviewAction']->value,'submitDisabled'=>$_smarty_tpl->tpl_vars['reviewIsClosed']->value),$_smarty_tpl ) );?>

	<?php }
$_block_repeat=false;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>"reviewStep1"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
</form>
<?php }
}
