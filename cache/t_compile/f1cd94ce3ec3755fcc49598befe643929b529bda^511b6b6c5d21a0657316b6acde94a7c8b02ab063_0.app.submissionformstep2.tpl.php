<?php
/* Smarty version 3.1.39, created on 2021-09-27 19:51:12
  from 'app:submissionformstep2.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61520490d82509_45464956',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '511b6b6c5d21a0657316b6acde94a7c8b02ab063' => 
    array (
      0 => 'app:submissionformstep2.tpl',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/notification/inPlaceNotification.tpl' => 1,
  ),
),false)) {
function content_61520490d82509_45464956 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
	$(function() {
		// Attach the form handler.
		$('#submitStep2Form').pkpHandler('$.pkp.pages.submission.SubmissionStep2FormHandler');
	});
<?php echo '</script'; ?>
>
<form class="pkp_form" id="submitStep2Form" method="post" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"saveStep",'path'=>$_smarty_tpl->tpl_vars['submitStep']->value),$_smarty_tpl ) );?>
" enctype="multipart/form-data" onsubmit="$.pkp.pages.submission.SubmissionStep2FormHandler.prototype.checkSubmit(event)">
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

	<input type="hidden" name="submissionId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['submissionId']->value ));?>
" />
	<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/inPlaceNotification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('notificationId'=>"submitStep2FormNotification"), 0, false);
?>

	<div id="submission-files-container">
		<submission-files-list-panel v-bind="components.submissionFiles" @set="set"></submission-files-list-panel>
		<?php echo '<script'; ?>
 type="text/javascript">
			pkp.registry.init('submission-files-container', 'Container', <?php echo json_encode($_smarty_tpl->tpl_vars['state']->value);?>
);
		<?php echo '</script'; ?>
>
	</div>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('id'=>"step2Buttons",'submitText'=>"common.saveAndContinue"),$_smarty_tpl ) );?>

</form><?php }
}
