<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:19:19
  from 'app:controllersmodalseditorDe' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152b3e7919c66_45056158',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f98a67abb74c9aa755e1eb9577e5d7f9f966bd33' => 
    array (
      0 => 'app:controllersmodalseditorDe',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/modals/editorDecision/form/bccReviewers.tpl' => 1,
    'app:controllers/extrasOnDemand.tpl' => 1,
  ),
),false)) {
function content_6152b3e7919c66_45056158 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
	$(function() {
		$('#promote').pkpHandler(
			'$.pkp.controllers.modals.editorDecision.form.EditorDecisionFormHandler',
			{
				peerReviewUrl: <?php echo json_encode($_smarty_tpl->tpl_vars['peerReviewUrl']->value);?>

			}
		);
	});
<?php echo '</script'; ?>
>

<form class="pkp_form" id="promote" method="post" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>$_smarty_tpl->tpl_vars['saveFormOperation']->value),$_smarty_tpl ) );?>
" >
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

	<input type="hidden" name="submissionId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['submissionId']->value ));?>
" />
	<input type="hidden" name="stageId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['stageId']->value ));?>
" />
	<input type="hidden" name="decision" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['decision']->value ));?>
" />
	<input type="hidden" name="reviewRoundId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['reviewRoundId']->value ));?>
" />

	<div id="promoteForm-step1">
		<?php if (array_key_exists('help',$_smarty_tpl->tpl_vars['decisionData']->value)) {?>
			<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['decisionData']->value['help']),$_smarty_tpl ) );?>
</p>
		<?php }?>

		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "sendEmailLabel", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submissionReview.sendEmail",'authorName'=>$_smarty_tpl->tpl_vars['authorName']->value),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php if ($_smarty_tpl->tpl_vars['skipEmail']->value) {?>
			<?php $_smarty_tpl->_assignInScope('skipEmailSkip', true);?>
		<?php } else { ?>
			<?php $_smarty_tpl->_assignInScope('skipEmailSend', true);?>
		<?php }?>
		<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"common.sendEmail"));
$_block_repeat=true;
echo $_block_plugin1->smartyFBVFormSection(array('title'=>"common.sendEmail"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<ul class="checkbox_and_radiobutton">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'id'=>"skipEmail-send",'name'=>"skipEmail",'value'=>"0",'checked'=>$_smarty_tpl->tpl_vars['skipEmailSend']->value,'label'=>$_smarty_tpl->tpl_vars['sendEmailLabel']->value,'translate'=>false),$_smarty_tpl ) );?>

				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'id'=>"skipEmail-skip",'name'=>"skipEmail",'value'=>"1",'checked'=>$_smarty_tpl->tpl_vars['skipEmailSkip']->value,'label'=>"editor.submissionReview.skipEmail"),$_smarty_tpl ) );?>

			</ul>
		<?php $_block_repeat=false;
echo $_block_plugin1->smartyFBVFormSection(array('title'=>"common.sendEmail"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

		<div id="sendReviews-emailContent" style="margin-bottom: 30px;">
						<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('for'=>"personalMessage"));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array('for'=>"personalMessage"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'name'=>"personalMessage",'id'=>"personalMessage",'value'=>$_smarty_tpl->tpl_vars['personalMessage']->value,'rich'=>true,'variables'=>$_smarty_tpl->tpl_vars['allowedVariables']->value,'variablesType'=>$_smarty_tpl->tpl_vars['allowedVariablesType']->value),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array('for'=>"personalMessage"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

						<?php if ($_smarty_tpl->tpl_vars['reviewsAvailable']->value) {?>
				<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin3->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
					<a id="importPeerReviews" href="#" class="pkp_button">
						<span class="fa fa-plus" aria-hidden="true"></span>
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.comments.addReviews"),$_smarty_tpl ) );?>

					</a>
				<?php $_block_repeat=false;
echo $_block_plugin3->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php }?>

			<?php if ((isset($_smarty_tpl->tpl_vars['reviewers']->value))) {?>
				<?php $_smarty_tpl->_subTemplateRender("app:controllers/modals/editorDecision/form/bccReviewers.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('reviewers'=>$_smarty_tpl->tpl_vars['reviewers']->value,'selected'=>$_smarty_tpl->tpl_vars['bccReviewers']->value), 0, false);
?>
			<?php }?>
		</div>

		<?php if ($_smarty_tpl->tpl_vars['decisionData']->value['paymentType']) {?>
			<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"common.payment"));
$_block_repeat=true;
echo $_block_plugin4->smartyFBVFormSection(array('title'=>"common.payment"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<ul class="checkbox_and_radiobutton">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'id'=>"requestPayment-request",'name'=>"requestPayment",'value'=>"1",'checked'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'compare' ][ 0 ], array( $_smarty_tpl->tpl_vars['requestPayment']->value,1 )),'label'=>$_smarty_tpl->tpl_vars['decisionData']->value['requestPaymentText'],'translate'=>false),$_smarty_tpl ) );?>

					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'id'=>"requestPayment-waive",'name'=>"requestPayment",'value'=>"0",'checked'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'compare' ][ 0 ], array( $_smarty_tpl->tpl_vars['requestPayment']->value,0 )),'label'=>$_smarty_tpl->tpl_vars['decisionData']->value['waivePaymentText'],'translate'=>false),$_smarty_tpl ) );?>

				</ul>
			<?php $_block_repeat=false;
echo $_block_plugin4->smartyFBVFormSection(array('title'=>"common.payment"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>

				<?php if ($_smarty_tpl->tpl_vars['reviewRoundId']->value) {?>
			<div id="attachments">
				<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'reviewAttachmentsGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.attachment.EditorSelectableReviewAttachmentsGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"reviewAttachmentsGridContainer",'url'=>$_smarty_tpl->tpl_vars['reviewAttachmentsGridUrl']->value),$_smarty_tpl ) );?>

			</div>
		<?php }?>

		<div id="libraryFileAttachments" class="pkp_user_group_other_contexts">
			<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'libraryAttachmentsGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.SelectableLibraryFileGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
			<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'libraryAttachmentsGrid', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"libraryFilesAttachmentsGridContainer",'url'=>$_smarty_tpl->tpl_vars['libraryAttachmentsGridUrl']->value),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
			<?php $_smarty_tpl->_subTemplateRender("app:controllers/extrasOnDemand.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('id'=>"libraryFileAttachmentsExtras",'widgetWrapper'=>"#libraryFileAttachments",'moreDetailsText'=>"settings.libraryFiles.public.selectLibraryFiles",'lessDetailsText'=>"settings.libraryFiles.public.selectLibraryFiles",'extraContent'=>$_smarty_tpl->tpl_vars['libraryAttachmentsGrid']->value), 0, false);
?>
		</div>
	</div>

	<div id="promoteForm-step2">
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "stageName", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['decisionData']->value['toStage']),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submission.decision.selectFiles",'stageName'=>$_smarty_tpl->tpl_vars['stageName']->value),$_smarty_tpl ) );?>
</p>
				<?php if ($_smarty_tpl->tpl_vars['stageId']->value == (defined('WORKFLOW_STAGE_ID_SUBMISSION') ? constant('WORKFLOW_STAGE_ID_SUBMISSION') : null)) {?>
			<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'filesToPromoteGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.submission.SelectableSubmissionDetailsFilesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['reviewRoundId']->value) {?>
						<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'filesToPromoteGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.review.SelectableReviewRevisionsGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['stageId']->value == (defined('WORKFLOW_STAGE_ID_EDITING') ? constant('WORKFLOW_STAGE_ID_EDITING') : null)) {?>
			<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'filesToPromoteGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.copyedit.SelectableCopyeditFilesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
			<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'draftFilesToPromoteGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.final.SelectableFinalDraftFilesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"draftFilesToPromoteGridUrl",'url'=>$_smarty_tpl->tpl_vars['draftFilesToPromoteGridUrl']->value),$_smarty_tpl ) );?>

		<?php }?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"filesToPromoteGrid",'url'=>$_smarty_tpl->tpl_vars['filesToPromoteGridUrl']->value),$_smarty_tpl ) );?>

	</div>

	<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('class'=>"formButtons form_buttons"));
$_block_repeat=true;
echo $_block_plugin5->smartyFBVFormSection(array('class'=>"formButtons form_buttons"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<span class="pkp_spinner"></span>
		<button class="pkp_button promoteForm-step-btn" data-step="files">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submission.decision.nextButton",'stageName'=>$_smarty_tpl->tpl_vars['stageName']->value),$_smarty_tpl ) );?>

		</button>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"submit",'class'=>"submitFormButton pkp_button_primary",'id'=>"promoteForm-complete-btn",'label'=>"editor.submissionReview.recordDecision"),$_smarty_tpl ) );?>

		<button class="pkp_button promoteForm-step-btn" data-step="email">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submission.decision.previousAuthorNotification"),$_smarty_tpl ) );?>

		</button>
		<?php $_smarty_tpl->_assignInScope('cancelButtonId', uniqid(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "cancelFormButton","-" ))));?>
		<a href="#" id="<?php echo $_smarty_tpl->tpl_vars['cancelButtonId']->value;?>
" class="cancelButton"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.cancel"),$_smarty_tpl ) );?>
</a>
	<?php $_block_repeat=false;
echo $_block_plugin5->smartyFBVFormSection(array('class'=>"formButtons form_buttons"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
</form>
<?php }
}
