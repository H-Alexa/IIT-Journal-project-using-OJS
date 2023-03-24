<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:15:02
  from 'app:controllersmodalseditorDe' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152b2e666c547_51359069',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ede8901c9774a6f61d4fb40218a4977a4ee80112' => 
    array (
      0 => 'app:controllersmodalseditorDe',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/modals/editorDecision/form/bccReviewers.tpl' => 1,
  ),
),false)) {
function content_6152b2e666c547_51359069 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
	$(function() {
		$('#sendReviews').pkpHandler(
			'$.pkp.controllers.modals.editorDecision.form.EditorDecisionFormHandler',
			{
				<?php if ($_smarty_tpl->tpl_vars['revisionsEmail']->value) {?>
					revisionsEmail: <?php echo json_encode($_smarty_tpl->tpl_vars['revisionsEmail']->value);?>
,
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['resubmitEmail']->value) {?>
					resubmitEmail: <?php echo json_encode($_smarty_tpl->tpl_vars['resubmitEmail']->value);?>
,
				<?php }?>
				peerReviewUrl: <?php echo json_encode($_smarty_tpl->tpl_vars['peerReviewUrl']->value);?>

			}
		);
	});
<?php echo '</script'; ?>
>

<form class="pkp_form" id="sendReviews" method="post" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>$_smarty_tpl->tpl_vars['saveFormOperation']->value),$_smarty_tpl ) );?>
" >
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

	<input type="hidden" name="submissionId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['submissionId']->value ));?>
" />
	<input type="hidden" name="stageId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['stageId']->value ));?>
" />
	<input type="hidden" name="reviewRoundId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['reviewRoundId']->value ));?>
" />

		<?php if ($_smarty_tpl->tpl_vars['decision']->value != (defined('SUBMISSION_EDITOR_DECISION_PENDING_REVISIONS') ? constant('SUBMISSION_EDITOR_DECISION_PENDING_REVISIONS') : null) && $_smarty_tpl->tpl_vars['decision']->value != (defined('SUBMISSION_EDITOR_DECISION_RESUBMIT') ? constant('SUBMISSION_EDITOR_DECISION_RESUBMIT') : null)) {?>
		<input type="hidden" name="decision" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['decision']->value ));?>
" />
	<?php } else { ?>
		<?php if ($_smarty_tpl->tpl_vars['decision']->value == (defined('SUBMISSION_EDITOR_DECISION_PENDING_REVISIONS') ? constant('SUBMISSION_EDITOR_DECISION_PENDING_REVISIONS') : null)) {?>
			<?php $_smarty_tpl->_assignInScope('checkedRevisions', "1");?>
		<?php } elseif ($_smarty_tpl->tpl_vars['decision']->value == (defined('SUBMISSION_EDITOR_DECISION_RESUBMIT') ? constant('SUBMISSION_EDITOR_DECISION_RESUBMIT') : null)) {?>
			<?php $_smarty_tpl->_assignInScope('checkedResubmit', "1");?>
		<?php }?>
		<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"editor.review.newReviewRound"));
$_block_repeat=true;
echo $_block_plugin1->smartyFBVFormSection(array('title'=>"editor.review.newReviewRound"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<ul class="checkbox_and_radiobutton">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'id'=>"decisionRevisions",'name'=>"decision",'value'=>(defined('SUBMISSION_EDITOR_DECISION_PENDING_REVISIONS') ? constant('SUBMISSION_EDITOR_DECISION_PENDING_REVISIONS') : null),'checked'=>$_smarty_tpl->tpl_vars['checkedRevisions']->value,'label'=>"editor.review.NotifyAuthorRevisions"),$_smarty_tpl ) );?>

				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'id'=>"decisionResubmit",'name'=>"decision",'value'=>(defined('SUBMISSION_EDITOR_DECISION_RESUBMIT') ? constant('SUBMISSION_EDITOR_DECISION_RESUBMIT') : null),'checked'=>$_smarty_tpl->tpl_vars['checkedResubmit']->value,'label'=>"editor.review.NotifyAuthorResubmit"),$_smarty_tpl ) );?>

			</ul>
		<?php $_block_repeat=false;
echo $_block_plugin1->smartyFBVFormSection(array('title'=>"editor.review.newReviewRound"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }?>

	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "sendEmailLabel", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submissionReview.sendEmail",'authorName'=>$_smarty_tpl->tpl_vars['authorName']->value),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php if ($_smarty_tpl->tpl_vars['skipEmail']->value) {?>
		<?php $_smarty_tpl->_assignInScope('skipEmailSkip', true);?>
	<?php } else { ?>
		<?php $_smarty_tpl->_assignInScope('skipEmailSend', true);?>
	<?php }?>
	<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"common.sendEmail"));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"common.sendEmail"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<ul class="checkbox_and_radiobutton">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'id'=>"skipEmail-send",'name'=>"skipEmail",'value'=>"0",'checked'=>$_smarty_tpl->tpl_vars['skipEmailSend']->value,'label'=>$_smarty_tpl->tpl_vars['sendEmailLabel']->value,'translate'=>false),$_smarty_tpl ) );?>

			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'id'=>"skipEmail-skip",'name'=>"skipEmail",'value'=>"1",'checked'=>$_smarty_tpl->tpl_vars['skipEmailSkip']->value,'label'=>"editor.submissionReview.skipEmail"),$_smarty_tpl ) );?>

		</ul>
	<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"common.sendEmail"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<div id="sendReviews-emailContent">
				<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('for'=>"personalMessage"));
$_block_repeat=true;
echo $_block_plugin3->smartyFBVFormSection(array('for'=>"personalMessage"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'name'=>"personalMessage",'id'=>"personalMessage",'value'=>$_smarty_tpl->tpl_vars['personalMessage']->value,'rich'=>true,'variables'=>$_smarty_tpl->tpl_vars['allowedVariables']->value,'variablesType'=>$_smarty_tpl->tpl_vars['allowedVariablesType']->value),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin3->smartyFBVFormSection(array('for'=>"personalMessage"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

				<?php if ($_smarty_tpl->tpl_vars['reviewsAvailable']->value) {?>
			<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin4->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<a id="importPeerReviews" href="#" class="pkp_button">
					<span class="fa fa-plus" aria-hidden="true"></span>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.comments.addReviews"),$_smarty_tpl ) );?>

				</a>
			<?php $_block_repeat=false;
echo $_block_plugin4->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>

		<?php if ((isset($_smarty_tpl->tpl_vars['reviewers']->value))) {?>
			<?php $_smarty_tpl->_subTemplateRender("app:controllers/modals/editorDecision/form/bccReviewers.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('reviewers'=>$_smarty_tpl->tpl_vars['reviewers']->value,'selected'=>$_smarty_tpl->tpl_vars['bccReviewers']->value), 0, false);
?>
		<?php }?>
	</div>

		<?php if ($_smarty_tpl->tpl_vars['reviewRoundId']->value) {?>
		<div id="attachments" style="margin-top: 30px;">
			<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'reviewAttachmentsGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.attachment.EditorSelectableReviewAttachmentsGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"reviewAttachmentsGridContainer",'url'=>$_smarty_tpl->tpl_vars['reviewAttachmentsGridUrl']->value),$_smarty_tpl ) );?>

		</div>
	<?php }?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('submitText'=>"editor.submissionReview.recordDecision"),$_smarty_tpl ) );?>

</form>
<?php }
}
