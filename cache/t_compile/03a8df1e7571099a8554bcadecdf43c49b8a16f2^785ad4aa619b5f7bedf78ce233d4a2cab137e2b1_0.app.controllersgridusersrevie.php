<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:55:20
  from 'app:controllersgridusersrevie' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152ae48cfe223_75061509',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '785ad4aa619b5f7bedf78ce233d4a2cab137e2b1' => 
    array (
      0 => 'app:controllersgridusersrevie',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/grid/users/reviewer/form/reviewerFormFooter.tpl' => 1,
  ),
),false)) {
function content_6152ae48cfe223_75061509 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
	$(function() {
		// Attach the form handler for second form.
		$('#advancedSearchReviewerForm').pkpHandler('$.pkp.controllers.grid.users.reviewer.form.AddReviewerFormHandler',
			{
				templateUrl: <?php echo json_encode(call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>'grid.users.reviewer.ReviewerGridHandler','op'=>'fetchTemplateBody','stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'escape'=>false),$_smarty_tpl ) ));?>

			}
		);
	});
<?php echo '</script'; ?>
>

<form class="pkp_form" id="advancedSearchReviewerForm" method="post" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"updateReviewer"),$_smarty_tpl ) );?>
" >
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"hidden",'id'=>"reviewerId",'value'=>$_smarty_tpl->tpl_vars['reviewerId']->value),$_smarty_tpl ) );?>


	<?php $_smarty_tpl->_subTemplateRender("app:controllers/grid/users/reviewer/form/reviewerFormFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('submitText'=>"editor.submission.addReviewer"),$_smarty_tpl ) );?>

</form>
<?php }
}
