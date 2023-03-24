<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:00:19
  from 'app:controllerswizardfileUplo' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152af730f1d76_77409167',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8f917ad1c42f280d97b3fdb68c57a4b58ac7a833' => 
    array (
      0 => 'app:controllerswizardfileUplo',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/notification/inPlaceNotification.tpl' => 1,
    'app:controllers/fileUploadContainer.tpl' => 1,
    'app:linkAction/linkAction.tpl' => 1,
  ),
),false)) {
function content_6152af730f1d76_77409167 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('showFileNameOnly', false);
if ($_smarty_tpl->tpl_vars['revisionOnly']->value) {?>
	<?php $_smarty_tpl->_assignInScope('showGenreSelector', false);?>
	<?php if (is_numeric($_smarty_tpl->tpl_vars['revisedFileId']->value)) {?>
				<?php $_smarty_tpl->_assignInScope('showFileSelector', false);?>
		<?php $_smarty_tpl->_assignInScope('showFileNameOnly', true);?>
	<?php } else { ?>
				<?php if (empty($_smarty_tpl->tpl_vars['submissionFileOptions']->value)) {
$_smarty_tpl->_assignInScope('revisionOnlyWithoutFileOptions', true);
}?>
		<?php $_smarty_tpl->_assignInScope('showFileSelector', true);?>
	<?php }
} else { ?>
	<?php $_smarty_tpl->_assignInScope('showGenreSelector', true);?>
	<?php if (empty($_smarty_tpl->tpl_vars['submissionFileOptions']->value)) {?>
				<?php if (is_numeric($_smarty_tpl->tpl_vars['revisedFileId']->value)) {
echo fatalError("A revised file id cannot be given when uploading a new file!");
}?>
		<?php $_smarty_tpl->_assignInScope('showFileSelector', false);?>
	<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('showFileSelector', true);?>
	<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['isReviewAttachment']->value) {
$_smarty_tpl->_assignInScope('showGenreSelector', false);
}
}?>

<?php if ($_smarty_tpl->tpl_vars['revisionOnlyWithoutFileOptions']->value) {?>
	<br /><br />
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.upload.noAvailableReviewFiles"),$_smarty_tpl ) );?>

	<br /><br />
<?php } else { ?>

<?php $_smarty_tpl->_assignInScope('uploadFormId', uniqid("uploadForm"));
$_smarty_tpl->_assignInScope('pluploadControl', uniqid("plupload"));
$_smarty_tpl->_assignInScope('browseButtonId', uniqid("browseButton"));
echo '<script'; ?>
 type="text/javascript">
	$(function() {
		// Attach the upload form handler.
		$('#<?php echo $_smarty_tpl->tpl_vars['uploadFormId']->value;?>
').pkpHandler(
			'$.pkp.controllers.wizard.fileUpload.form.FileUploadFormHandler',
			{
				hasFileSelector: <?php if ($_smarty_tpl->tpl_vars['showFileSelector']->value) {?>true<?php } else { ?>false<?php }?>,
				hasGenreSelector: <?php if ($_smarty_tpl->tpl_vars['showGenreSelector']->value) {?>true<?php } else { ?>false<?php }?>,
				presetRevisedFileId: <?php echo json_encode($_smarty_tpl->tpl_vars['revisedFileId']->value);?>
,
				// File genres currently assigned to submission files.
				fileGenres: {
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currentSubmissionFileGenres']->value, 'fileGenre', false, 'submissionFileId', 'currentSubmissionFileGenres', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['fileGenre']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['submissionFileId']->value => $_smarty_tpl->tpl_vars['fileGenre']->value) {
$_smarty_tpl->tpl_vars['fileGenre']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_currentSubmissionFileGenres']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_currentSubmissionFileGenres']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_currentSubmissionFileGenres']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_currentSubmissionFileGenres']->value['total'];
?>
						<?php if (!empty($_smarty_tpl->tpl_vars['fileGenre']->value)) {?>
							<?php echo json_encode($_smarty_tpl->tpl_vars['submissionFileId']->value);?>
: <?php echo json_encode($_smarty_tpl->tpl_vars['fileGenre']->value);
if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_currentSubmissionFileGenres']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_currentSubmissionFileGenres']->value['last'] : null)) {?>,<?php }?>
						<?php }?>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				},
				$uploader: $('#<?php echo $_smarty_tpl->tpl_vars['pluploadControl']->value;?>
'),
				uploaderOptions: {
					uploadUrl: <?php echo json_encode(call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"uploadFile",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'fileStage'=>$_smarty_tpl->tpl_vars['fileStage']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'assocType'=>$_smarty_tpl->tpl_vars['assocType']->value,'assocId'=>$_smarty_tpl->tpl_vars['assocId']->value,'queryId'=>$_smarty_tpl->tpl_vars['queryId']->value,'escape'=>false),$_smarty_tpl ) ));?>
,
					baseUrl: <?php echo json_encode($_smarty_tpl->tpl_vars['baseUrl']->value);?>
,
					browse_button: '<?php echo $_smarty_tpl->tpl_vars['browseButtonId']->value;?>
'
				}
			});
	});
<?php echo '</script'; ?>
>

<form class="pkp_form" id="<?php echo $_smarty_tpl->tpl_vars['uploadFormId']->value;?>
" action="#" method="post">
	<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/inPlaceNotification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('notificationId'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( $_smarty_tpl->tpl_vars['uploadFormId']->value,"Notification" ))), 0, false);
?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

	<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"file"));
$_block_repeat=true;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>"file"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php if ($_smarty_tpl->tpl_vars['assocType']->value && $_smarty_tpl->tpl_vars['assocId']->value) {?>
			<input type="hidden" name="assocType" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['assocType']->value ));?>
" />
			<input type="hidden" name="assocId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['assocId']->value ));?>
" />
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['showFileNameOnly']->value) {?>
			<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"submission.submit.currentFile"));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"submission.submit.currentFile"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo $_smarty_tpl->tpl_vars['revisedFileName']->value;?>

			<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"submission.submit.currentFile"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

						<input type="hidden" id="revisedFileId" name="revisedFileId" value="<?php echo $_smarty_tpl->tpl_vars['revisedFileId']->value;?>
" />
		<?php } elseif ($_smarty_tpl->tpl_vars['showFileSelector']->value) {?>
						<?php if ($_smarty_tpl->tpl_vars['revisionOnly']->value) {?>
				<?php $_smarty_tpl->_assignInScope('revisionSelectTitle', "submission.upload.selectMandatoryFileToRevise");?>
			<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('revisionSelectTitle', "submission.upload.selectOptionalFileToRevise");?>
			<?php }?>
			<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>$_smarty_tpl->tpl_vars['revisionSelectTitle']->value,'required'=>$_smarty_tpl->tpl_vars['revisionOnly']->value));
$_block_repeat=true;
echo $_block_plugin3->smartyFBVFormSection(array('title'=>$_smarty_tpl->tpl_vars['revisionSelectTitle']->value,'required'=>$_smarty_tpl->tpl_vars['revisionOnly']->value), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"select",'name'=>"revisedFileId",'id'=>"revisedFileId",'from'=>$_smarty_tpl->tpl_vars['submissionFileOptions']->value,'selected'=>$_smarty_tpl->tpl_vars['revisedFileId']->value,'translate'=>false),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin3->smartyFBVFormSection(array('title'=>$_smarty_tpl->tpl_vars['revisionSelectTitle']->value,'required'=>$_smarty_tpl->tpl_vars['revisionOnly']->value), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['showGenreSelector']->value) {?>
			<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"submission.upload.fileContents",'required'=>true));
$_block_repeat=true;
echo $_block_plugin4->smartyFBVFormSection(array('title'=>"submission.upload.fileContents",'required'=>true), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "defaultLabel", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.upload.selectComponent"),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"select",'name'=>"genreId",'id'=>"genreId",'from'=>$_smarty_tpl->tpl_vars['submissionFileGenres']->value,'translate'=>false,'defaultLabel'=>$_smarty_tpl->tpl_vars['defaultLabel']->value,'defaultValue'=>'','required'=>true,'selected'=>$_smarty_tpl->tpl_vars['genreId']->value),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin4->smartyFBVFormSection(array('title'=>"submission.upload.fileContents",'required'=>true), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>

		<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin5->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
						<?php $_smarty_tpl->_subTemplateRender("app:controllers/fileUploadContainer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('id'=>$_smarty_tpl->tpl_vars['pluploadControl']->value,'browseButton'=>$_smarty_tpl->tpl_vars['browseButtonId']->value), 0, false);
?>
		<?php $_block_repeat=false;
echo $_block_plugin5->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

		<?php if ($_smarty_tpl->tpl_vars['ensuringLink']->value) {?>
			<div id="<?php echo $_smarty_tpl->tpl_vars['ensuringLink']->value->getId();?>
" class="pkp_linkActions">
				<?php $_smarty_tpl->_subTemplateRender("app:linkAction/linkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('action'=>$_smarty_tpl->tpl_vars['ensuringLink']->value,'contextId'=>"uploadForm"), 0, false);
?>
			</div>
		<?php }?>
	<?php $_block_repeat=false;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>"file"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
</form>
<?php }
}
}
