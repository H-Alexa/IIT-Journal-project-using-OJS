<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:55:20
  from 'app:controllersgridusersrevie' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152ae48c204d3_89787425',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a5b00fa397b0a0e23833e91dc151ddc8111fce0b' => 
    array (
      0 => 'app:controllersgridusersrevie',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:linkAction/linkAction.tpl' => 2,
    'app:controllers/grid/users/reviewer/form/advancedSearchReviewerAssignmentForm.tpl' => 1,
  ),
),false)) {
function content_6152ae48c204d3_89787425 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
	$(function() {
		// Handle moving the reviewer ID from the grid to the second form
		$('#advancedReviewerSearch').pkpHandler('$.pkp.controllers.grid.users.reviewer.AdvancedReviewerSearchHandler');
	});
<?php echo '</script'; ?>
>

<div id="advancedReviewerSearch" class="pkp_form pkp_form_advancedReviewerSearch">

	<div id="searchGridAndButton">

		<?php $_smarty_tpl->_assignInScope('uuid', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( uniqid('') )));?>
		<div id="select-reviewer-<?php echo $_smarty_tpl->tpl_vars['uuid']->value;?>
">
			<select-reviewer-list-panel
				v-bind="components.selectReviewer"
				@set="set"
			/>
		</div>
		<?php echo '<script'; ?>
 type="text/javascript">
			pkp.registry.init('select-reviewer-<?php echo $_smarty_tpl->tpl_vars['uuid']->value;?>
', 'Container', <?php echo json_encode($_smarty_tpl->tpl_vars['selectReviewerListData']->value);?>
);
		<?php echo '</script'; ?>
>

				<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('class'=>"form_buttons"));
$_block_repeat=true;
echo $_block_plugin1->smartyFBVFormSection(array('class'=>"form_buttons"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reviewerActions']->value, 'action');
$_smarty_tpl->tpl_vars['action']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['action']->value) {
$_smarty_tpl->tpl_vars['action']->do_else = false;
?>
				<?php if ($_smarty_tpl->tpl_vars['action']->value->getId() == 'advancedSearch') {?>
					<?php continue 1;?>
				<?php }?>
				<?php $_smarty_tpl->_subTemplateRender("app:linkAction/linkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('action'=>$_smarty_tpl->tpl_vars['action']->value,'contextId'=>"createReviewerForm"), 0, true);
?>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php $_block_repeat=false;
echo $_block_plugin1->smartyFBVFormSection(array('class'=>"form_buttons"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	</div>

	<div id="regularReviewerForm" class="pkp_reviewer_form">
				<div class="selected_reviewer">
			<div class="label">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submission.selectedReviewer"),$_smarty_tpl ) );?>

			</div>
			<div class="value">
				<span id="selectedReviewerName" class="name"></span>
				<span class="actions">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reviewerActions']->value, 'action');
$_smarty_tpl->tpl_vars['action']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['action']->value) {
$_smarty_tpl->tpl_vars['action']->do_else = false;
?>
						<?php if ($_smarty_tpl->tpl_vars['action']->value->getId() == 'advancedSearch') {?>
							<?php $_smarty_tpl->_subTemplateRender("app:linkAction/linkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('action'=>$_smarty_tpl->tpl_vars['action']->value,'contextId'=>"createReviewerForm"), 0, true);
?>
						<?php }?>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</span>
			</div>
		</div>

		<?php $_smarty_tpl->_subTemplateRender("app:controllers/grid/users/reviewer/form/advancedSearchReviewerAssignmentForm.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	</div>
</div>
<?php }
}
