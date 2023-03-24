<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:00:18
  from 'app:controllerswizardfileUplo' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152af726f6691_59114747',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cddfe063cc213310888ff528db4468d0d22f5ed0' => 
    array (
      0 => 'app:controllerswizardfileUplo',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152af726f6691_59114747 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('uploadWizardId', uniqid("fileUploadWizard"));
echo '<script'; ?>
 type="text/javascript">
	// Attach the JS file upload wizard handler.
	$(function() {
		$('#<?php echo $_smarty_tpl->tpl_vars['uploadWizardId']->value;?>
').pkpHandler(
			'$.pkp.controllers.wizard.fileUpload.FileUploadWizardHandler',
			{
				csrfToken: <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array('type'=>'json'),$_smarty_tpl ) );?>
,
				cancelButtonText: <?php echo json_encode(call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.cancel"),$_smarty_tpl ) ));?>
,
				continueButtonText: <?php echo json_encode(call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.continue"),$_smarty_tpl ) ));?>
,
				finishButtonText: <?php echo json_encode(call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.complete"),$_smarty_tpl ) ));?>
,
				deleteUrl: <?php echo json_encode(call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('component'=>"api.file.ManageFileApiHandler",'op'=>"deleteFile",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'fileStage'=>$_smarty_tpl->tpl_vars['fileStage']->value,'suppressNotification'=>true,'escape'=>false),$_smarty_tpl ) ));?>
,
				metadataUrl: <?php echo json_encode(call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"editMetadata",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'fileStage'=>$_smarty_tpl->tpl_vars['fileStage']->value,'assocType'=>$_smarty_tpl->tpl_vars['assocType']->value,'assocId'=>$_smarty_tpl->tpl_vars['assocId']->value,'queryId'=>$_smarty_tpl->tpl_vars['queryId']->value,'escape'=>false),$_smarty_tpl ) ));?>
,
				finishUrl: <?php echo json_encode(call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"finishFileSubmission",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'fileStage'=>$_smarty_tpl->tpl_vars['fileStage']->value,'assocType'=>$_smarty_tpl->tpl_vars['assocType']->value,'assocId'=>$_smarty_tpl->tpl_vars['assocId']->value,'queryId'=>$_smarty_tpl->tpl_vars['queryId']->value,'escape'=>false),$_smarty_tpl ) ));?>

			}
		);
	});
<?php echo '</script'; ?>
>

<div id="<?php echo $_smarty_tpl->tpl_vars['uploadWizardId']->value;?>
">
	<ul>
		<li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"displayFileUploadForm",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'uploaderRoles'=>$_smarty_tpl->tpl_vars['uploaderRoles']->value,'fileStage'=>$_smarty_tpl->tpl_vars['fileStage']->value,'revisionOnly'=>$_smarty_tpl->tpl_vars['revisionOnly']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'revisedFileId'=>$_smarty_tpl->tpl_vars['revisedFileId']->value,'assocType'=>$_smarty_tpl->tpl_vars['assocType']->value,'assocId'=>$_smarty_tpl->tpl_vars['assocId']->value,'dependentFilesOnly'=>$_smarty_tpl->tpl_vars['dependentFilesOnly']->value,'queryId'=>$_smarty_tpl->tpl_vars['queryId']->value),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.submit.uploadStep"),$_smarty_tpl ) );?>
</a></li>
		<li><a href="metadata"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.submit.metadataStep"),$_smarty_tpl ) );?>
</a></li>
		<li><a href="finish"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.submit.finishingUpStep"),$_smarty_tpl ) );?>
</a></li>
	</ul>
</div>
<?php }
}
