<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:02:19
  from 'core:controllersgridusersrevie' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152afebb0b7c6_63366076',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '326ab21b8c88a1187923a7cfe12de419eae7d79b' => 
    array (
      0 => 'core:controllersgridusersrevie',
      1 => 1624492183,
      2 => 'core',
    ),
  ),
  'includes' => 
  array (
    'app:reviewer/review/reviewFormResponse.tpl' => 1,
    'app:controllers/revealMore.tpl' => 2,
    'app:controllers/notification/inPlaceNotificationContent.tpl' => 1,
  ),
),false)) {
function content_6152afebb0b7c6_63366076 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\OJS\\lib\\pkp\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>


<form class="pkp_form" id="readReviewForm" method="post" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"reviewRead"),$_smarty_tpl ) );?>
">
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

	<input type="hidden" name="reviewAssignmentId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['reviewAssignment']->value->getId() ));?>
" />
	<input type="hidden" name="submissionId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['reviewAssignment']->value->getSubmissionId() ));?>
" />
	<input type="hidden" name="stageId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['reviewAssignment']->value->getStageId() ));?>
" />


	<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<div id="reviewAssignment-<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['reviewAssignment']->value->getId() ));?>
">
			<h2><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['reviewAssignment']->value->getReviewerFullName() ));?>
</h2>
			<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('class'=>"description"));
$_block_repeat=true;
echo $_block_plugin3->smartyFBVFormSection(array('class'=>"description"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.review.readConfirmation"),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin3->smartyFBVFormSection(array('class'=>"description"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

			<?php if ($_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateCompleted()) {?>
				<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin4->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
					<div class="pkp_controllers_informationCenter_itemLastEvent">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.completed.date",'dateCompleted'=>smarty_modifier_date_format($_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateCompleted(),$_smarty_tpl->tpl_vars['datetimeFormatShort']->value)),$_smarty_tpl ) );?>

					</div>
				<?php $_block_repeat=false;
echo $_block_plugin4->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

				<?php if ($_smarty_tpl->tpl_vars['reviewAssignment']->value->getRecommendation()) {?>
					<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin5->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
						<div class="pkp_controllers_informationCenter_itemLastEvent">
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.recommendation",'recommendation'=>$_smarty_tpl->tpl_vars['reviewAssignment']->value->getLocalizedRecommendation()),$_smarty_tpl ) );?>

						</div>
					<?php $_block_repeat=false;
echo $_block_plugin5->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
				<?php }?>

				<?php if ($_smarty_tpl->tpl_vars['reviewAssignment']->value->getReviewFormId()) {?>
					<?php $_smarty_tpl->_subTemplateRender("app:reviewer/review/reviewFormResponse.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
				<?php } elseif ($_smarty_tpl->tpl_vars['comments']->value->getCount() || $_smarty_tpl->tpl_vars['commentsPrivate']->value->getCount()) {?>
					<h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.review.reviewerComments"),$_smarty_tpl ) );?>
</h3>
					<?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['iterate'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['iterate'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'smartyIterate'))) {
throw new SmartyException('block tag \'iterate\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('iterate', array('from'=>'comments','item'=>'comment'));
$_block_repeat=true;
echo $_block_plugin6->smartyIterate(array('from'=>'comments','item'=>'comment'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
						<h4><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.comments.canShareWithAuthor"),$_smarty_tpl ) );?>
</h4>
						<?php $_smarty_tpl->_subTemplateRender("app:controllers/revealMore.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('content'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( $_smarty_tpl->tpl_vars['comment']->value->getComments() ))), 0, false);
?>
					<?php $_block_repeat=false;
echo $_block_plugin6->smartyIterate(array('from'=>'comments','item'=>'comment'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
					<?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['iterate'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['iterate'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'smartyIterate'))) {
throw new SmartyException('block tag \'iterate\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('iterate', array('from'=>'commentsPrivate','item'=>'comment'));
$_block_repeat=true;
echo $_block_plugin7->smartyIterate(array('from'=>'commentsPrivate','item'=>'comment'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
						<h4><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.comments.cannotShareWithAuthor"),$_smarty_tpl ) );?>
</h4>
						<?php $_smarty_tpl->_subTemplateRender("app:controllers/revealMore.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('content'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( $_smarty_tpl->tpl_vars['comment']->value->getComments() ))), 0, true);
?>
					<?php $_block_repeat=false;
echo $_block_plugin7->smartyIterate(array('from'=>'commentsPrivate','item'=>'comment'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['reviewAssignment']->value->getCompetingInterests()) {?>
					<h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"reviewer.submission.competingInterests"),$_smarty_tpl ) );?>
</h3>
					<div class="review_competing_interests">
						<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( nl2br($_smarty_tpl->tpl_vars['reviewAssignment']->value->getCompetingInterests()) ));?>

					</div>
				<?php }?>

			<?php } else { ?>
				<?php if ($_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateCompleted()) {?>
					<span class="pkp_controllers_informationCenter_itemLastEvent"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.completed.date",'dateCompleted'=>smarty_modifier_date_format($_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateCompleted(),$_smarty_tpl->tpl_vars['datetimeFormatShort']->value)),$_smarty_tpl ) );?>
</span>
				<?php } elseif ($_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateConfirmed()) {?>
					<span class="pkp_controllers_informationCenter_itemLastEvent"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.confirmed.date",'dateConfirmed'=>smarty_modifier_date_format($_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateConfirmed(),$_smarty_tpl->tpl_vars['datetimeFormatShort']->value)),$_smarty_tpl ) );?>
</span>
				<?php } elseif ($_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateReminded()) {?>
					<span class="pkp_controllers_informationCenter_itemLastEvent"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.reminded.date",'dateReminded'=>smarty_modifier_date_format($_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateReminded(),$_smarty_tpl->tpl_vars['datetimeFormatShort']->value)),$_smarty_tpl ) );?>
</span>
				<?php } elseif ($_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateNotified()) {?>
					<span class="pkp_controllers_informationCenter_itemLastEvent"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.notified.date",'dateNotified'=>smarty_modifier_date_format($_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateNotified(),$_smarty_tpl->tpl_vars['datetimeFormatShort']->value)),$_smarty_tpl ) );?>
</span>
				<?php } elseif ($_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateAssigned()) {?>
					<span class="pkp_controllers_informationCenter_itemLastEvent"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.assigned.date",'dateAssigned'=>smarty_modifier_date_format($_smarty_tpl->tpl_vars['reviewAssignment']->value->getDateAssigned(),$_smarty_tpl->tpl_vars['datetimeFormatShort']->value)),$_smarty_tpl ) );?>
</span>
				<?php }?>
			<?php }?>
		</div>
	<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>


	<div class="pkp_notification" id="noFilesWarning" style="display: none;">
		<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/inPlaceNotificationContent.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('notificationId'=>'noFilesWarningContent','notificationStyleClass'=>'notifyWarning','notificationTitle'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'translate' ][ 0 ], array( "editor.review.noReviewFilesUploaded" )),'notificationContents'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'translate' ][ 0 ], array( "editor.review.noReviewFilesUploaded.details" ))), 0, false);
?>
	</div>

	<?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"readReview"));
$_block_repeat=true;
echo $_block_plugin8->smartyFBVFormArea(array('id'=>"readReview"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"reviewer.submission.reviewerFiles"));
$_block_repeat=true;
echo $_block_plugin9->smartyFBVFormSection(array('title'=>"reviewer.submission.reviewerFiles"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'reviewAttachmentsGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.attachment.EditorReviewAttachmentsGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'reviewId'=>$_smarty_tpl->tpl_vars['reviewAssignment']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['reviewAssignment']->value->getStageId(),'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"readReviewAttachmentsGridContainer",'url'=>$_smarty_tpl->tpl_vars['reviewAttachmentsGridUrl']->value),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin9->smartyFBVFormSection(array('title'=>"reviewer.submission.reviewerFiles"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

		<?php echo $_smarty_tpl->tpl_vars['reviewerRecommendations']->value;?>


		<?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>"editor.review.rateReviewer",'description'=>"editor.review.rateReviewer.description"));
$_block_repeat=true;
echo $_block_plugin10->smartyFBVFormSection(array('label'=>"editor.review.rateReviewer",'description'=>"editor.review.rateReviewer.description"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reviewerRatingOptions']->value, 'stars', false, 'value');
$_smarty_tpl->tpl_vars['stars']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value => $_smarty_tpl->tpl_vars['stars']->value) {
$_smarty_tpl->tpl_vars['stars']->do_else = false;
?>
				<label class="pkp_star_selection">
					<input type="radio" name="quality" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['value']->value ));?>
"<?php if ($_smarty_tpl->tpl_vars['value']->value == $_smarty_tpl->tpl_vars['reviewAssignment']->value->getQuality()) {?> checked<?php }?>>
					<?php echo $_smarty_tpl->tpl_vars['stars']->value;?>

				</label>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php $_block_repeat=false;
echo $_block_plugin10->smartyFBVFormSection(array('label'=>"editor.review.rateReviewer",'description'=>"editor.review.rateReviewer.description"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('id'=>"closeButton",'hideCancel'=>false,'submitText'=>"common.confirm"),$_smarty_tpl ) );?>

	<?php $_block_repeat=false;
echo $_block_plugin8->smartyFBVFormArea(array('id'=>"readReview"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
</form>
<?php }
}
