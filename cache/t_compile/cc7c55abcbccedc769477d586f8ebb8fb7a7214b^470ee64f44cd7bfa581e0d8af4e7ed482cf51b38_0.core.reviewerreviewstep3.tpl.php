<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:58:08
  from 'core:reviewerreviewstep3.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152aef09897a9_45259216',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '470ee64f44cd7bfa581e0d8af4e7ed482cf51b38' => 
    array (
      0 => 'core:reviewerreviewstep3.tpl',
      1 => 1624492183,
      2 => 'core',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/notification/inPlaceNotification.tpl' => 1,
    'app:linkAction/linkAction.tpl' => 1,
    'app:reviewer/review/reviewFormResponse.tpl' => 1,
  ),
),false)) {
function content_6152aef09897a9_45259216 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
	$(function() {
		// Attach the form handler.
		$('#reviewStep3Form').pkpHandler(
			'$.pkp.controllers.form.reviewer.ReviewerReviewStep3FormHandler'
		);
	});
<?php echo '</script'; ?>
>

<form class="pkp_form" id="reviewStep3Form" method="post" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"saveStep",'path'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'step'=>"3"),$_smarty_tpl ) );?>
">
	<input type="hidden" name="isSave" />	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

	<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/inPlaceNotification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('notificationId'=>"reviewStep3FormNotification"), 0, false);
?>

<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"reviewStep3"));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormArea(array('id'=>"reviewStep3"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>

	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "reviewFilesGridUrl", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.review.ReviewerReviewFilesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['reviewAssignment']->value->getStageId(),'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'reviewAssignmentId'=>$_smarty_tpl->tpl_vars['reviewAssignment']->value->getId(),'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"reviewFilesStep3",'url'=>$_smarty_tpl->tpl_vars['reviewFilesGridUrl']->value),$_smarty_tpl ) );?>


	<?php if ($_smarty_tpl->tpl_vars['viewGuidelinesAction']->value) {?>
		<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"reviewer.submission.reviewerGuidelines"));
$_block_repeat=true;
echo $_block_plugin3->smartyFBVFormSection(array('title'=>"reviewer.submission.reviewerGuidelines"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<div id="viewGuidelines">
				<?php $_smarty_tpl->_subTemplateRender("app:linkAction/linkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('action'=>$_smarty_tpl->tpl_vars['viewGuidelinesAction']->value,'contextId'=>"viewGuidelines"), 0, false);
?>
			</div>
		<?php $_block_repeat=false;
echo $_block_plugin3->smartyFBVFormSection(array('title'=>"reviewer.submission.reviewerGuidelines"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }?>
	
	<?php if ($_smarty_tpl->tpl_vars['reviewForm']->value) {?>
		<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin4->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<h3><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['reviewForm']->value->getLocalizedTitle() ));?>
</h3>
			<p><?php echo $_smarty_tpl->tpl_vars['reviewForm']->value->getLocalizedDescription();?>
</p>

			<?php $_smarty_tpl->_subTemplateRender("app:reviewer/review/reviewFormResponse.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php $_block_repeat=false;
echo $_block_plugin4->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>	
	<?php } else { ?>
		<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>"submission.review",'description'=>"reviewer.submission.reviewDescription"));
$_block_repeat=true;
echo $_block_plugin5->smartyFBVFormSection(array('label'=>"submission.review",'description'=>"reviewer.submission.reviewDescription"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>"submission.comments.canShareWithAuthor"));
$_block_repeat=true;
echo $_block_plugin6->smartyFBVFormSection(array('label'=>"submission.comments.canShareWithAuthor"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'id'=>"comments",'name'=>"comments",'value'=>$_smarty_tpl->tpl_vars['comments']->value,'readonly'=>$_smarty_tpl->tpl_vars['reviewIsClosed']->value,'rich'=>true),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin6->smartyFBVFormSection(array('label'=>"submission.comments.canShareWithAuthor"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>"submission.comments.cannotShareWithAuthor"));
$_block_repeat=true;
echo $_block_plugin7->smartyFBVFormSection(array('label'=>"submission.comments.cannotShareWithAuthor"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'id'=>"commentsPrivate",'name'=>"commentsPrivate",'value'=>$_smarty_tpl->tpl_vars['commentsPrivate']->value,'readonly'=>$_smarty_tpl->tpl_vars['reviewIsClosed']->value,'rich'=>true),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin7->smartyFBVFormSection(array('label'=>"submission.comments.cannotShareWithAuthor"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_repeat=false;
echo $_block_plugin5->smartyFBVFormSection(array('label'=>"submission.review",'description'=>"reviewer.submission.reviewDescription"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }?>

	<?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>"common.upload",'description'=>"reviewer.submission.uploadDescription"));
$_block_repeat=true;
echo $_block_plugin8->smartyFBVFormSection(array('label'=>"common.upload",'description'=>"reviewer.submission.uploadDescription"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "reviewAttachmentsGridUrl", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.attachment.ReviewerReviewAttachmentsGridHandler",'op'=>"fetchGrid",'assocType'=>(defined('ASSOC_TYPE_REVIEW_ASSIGNMENT') ? constant('ASSOC_TYPE_REVIEW_ASSIGNMENT') : null),'assocId'=>$_smarty_tpl->tpl_vars['submission']->value->getReviewId(),'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['submission']->value->getStageId(),'reviewIsClosed'=>$_smarty_tpl->tpl_vars['reviewIsClosed']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"reviewAttachmentsGridContainer",'url'=>$_smarty_tpl->tpl_vars['reviewAttachmentsGridUrl']->value),$_smarty_tpl ) );?>

	<?php $_block_repeat=false;
echo $_block_plugin8->smartyFBVFormSection(array('label'=>"common.upload",'description'=>"reviewer.submission.uploadDescription"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<!-- Display queries grid -->
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "queriesGridUrl", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.queries.QueriesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>(defined('WORKFLOW_STAGE_ID_EXTERNAL_REVIEW') ? constant('WORKFLOW_STAGE_ID_EXTERNAL_REVIEW') : null),'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"queriesGrid",'url'=>$_smarty_tpl->tpl_vars['queriesGridUrl']->value),$_smarty_tpl ) );?>
	

	<?php echo $_smarty_tpl->tpl_vars['additionalFormFields']->value;?>


	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "cancelUrl", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"reviewer",'op'=>"submission",'path'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'step'=>2,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('submitText'=>"reviewer.submission.submitReview",'confirmSubmit'=>"reviewer.confirmSubmit",'saveText'=>"reviewer.submission.saveReviewForLater",'cancelText'=>"navigation.goBack",'cancelUrl'=>$_smarty_tpl->tpl_vars['cancelUrl']->value,'cancelUrlTarget'=>"_self",'submitDisabled'=>$_smarty_tpl->tpl_vars['reviewIsClosed']->value),$_smarty_tpl ) );?>

<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormArea(array('id'=>"reviewStep3"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

<p><span class="formRequired"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.requiredField"),$_smarty_tpl ) );?>
</span></p>
</form>
<?php }
}
