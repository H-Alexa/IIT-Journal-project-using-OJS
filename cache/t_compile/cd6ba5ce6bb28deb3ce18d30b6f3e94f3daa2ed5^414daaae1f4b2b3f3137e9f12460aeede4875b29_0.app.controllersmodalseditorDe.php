<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:18:32
  from 'app:controllersmodalseditorDe' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152b3b8477870_88942819',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '414daaae1f4b2b3f3137e9f12460aeede4875b29' => 
    array (
      0 => 'app:controllersmodalseditorDe',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152b3b8477870_88942819 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
	$(function() {
		// Attach the form handler.
		$('#newRoundForm').pkpHandler('$.pkp.controllers.form.AjaxFormHandler', null);
	});
<?php echo '</script'; ?>
>

<form class="pkp_form" id="newRoundForm" method="post" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"saveNewReviewRound"),$_smarty_tpl ) );?>
" >
	<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submission.newRoundDescription"),$_smarty_tpl ) );?>
</p>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

	<input type="hidden" name="submissionId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['submissionId']->value ));?>
" />
	<input type="hidden" name="stageId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['stageId']->value ));?>
" />
	<input type="hidden" name="reviewRoundId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['reviewRoundId']->value ));?>
" />
	<input type="hidden" name="decision" value="<?php echo (defined('SUBMISSION_EDITOR_DECISION_NEW_ROUND') ? constant('SUBMISSION_EDITOR_DECISION_NEW_ROUND') : null);?>
" />

	<!-- Revision files grid (Displays only revisions at first, and hides all other files which can then be displayed with filter button -->
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'newRoundRevisionsUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.review.SelectableReviewRevisionsGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"newRoundRevisionsGrid",'url'=>$_smarty_tpl->tpl_vars['newRoundRevisionsUrl']->value),$_smarty_tpl ) );?>


	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('submitText'=>"editor.submission.createNewRound"),$_smarty_tpl ) );?>

</form>
<?php }
}
