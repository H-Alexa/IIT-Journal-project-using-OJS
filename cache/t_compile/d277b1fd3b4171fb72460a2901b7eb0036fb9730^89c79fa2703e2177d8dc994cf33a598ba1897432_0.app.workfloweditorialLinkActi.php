<?php
/* Smarty version 3.1.39, created on 2021-09-27 20:14:02
  from 'app:workfloweditorialLinkActi' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_615209ea79c890_27544581',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '89c79fa2703e2177d8dc994cf33a598ba1897432' => 
    array (
      0 => 'app:workfloweditorialLinkActi',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:linkAction/linkAction.tpl' => 2,
  ),
),false)) {
function content_615209ea79c890_27544581 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['editorActions']->value)) {?>
	<?php echo '<script'; ?>
>
		// Initialise JS handler.
		$(function() {
			$('#editorialActions').pkpHandler(
				'$.pkp.controllers.EditorialActionsHandler');
		});
	<?php echo '</script'; ?>
>
	<?php if (array_intersect(array(ROLE_ID_MANAGER,ROLE_ID_SUB_EDITOR),(array)$_smarty_tpl->tpl_vars['userRoles']->value)) {?>
		<ul id="editorialActions" class="pkp_workflow_decisions">
			<?php if ($_smarty_tpl->tpl_vars['allRecommendations']->value) {?>
				<li>
					<div class="pkp_workflow_recommendations">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submission.allRecommendations.display",'recommendations'=>$_smarty_tpl->tpl_vars['allRecommendations']->value),$_smarty_tpl ) );?>

					</div>
				</li>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['lastRecommendation']->value) {?>
				<li>
					<div class="pkp_workflow_recommendations">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submission.recommendation.display",'recommendation'=>$_smarty_tpl->tpl_vars['lastRecommendation']->value),$_smarty_tpl ) );?>

					</div>
				</li>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['lastDecision']->value) {?>
				<li>
					<div class="pkp_workflow_decided">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['lastDecision']->value),$_smarty_tpl ) );?>

						<?php if (count($_smarty_tpl->tpl_vars['editorActions']->value) > 0) {?>
							<button class="pkp_workflow_change_decision"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submission.workflowDecision.changeDecision"),$_smarty_tpl ) );?>
</button>
							<div class="pkp_workflow_decided_actions">
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['editorActions']->value, 'action');
$_smarty_tpl->tpl_vars['action']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['action']->value) {
$_smarty_tpl->tpl_vars['action']->do_else = false;
?>
									<?php $_smarty_tpl->_subTemplateRender("app:linkAction/linkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('action'=>$_smarty_tpl->tpl_vars['action']->value,'contextId'=>$_smarty_tpl->tpl_vars['contextId']->value), 0, true);
?>
								<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</div>
						<?php }?>
					</div>
				</li>
			<?php } elseif (count($_smarty_tpl->tpl_vars['editorActions']->value) > 0) {?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['editorActions']->value, 'action');
$_smarty_tpl->tpl_vars['action']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['action']->value) {
$_smarty_tpl->tpl_vars['action']->do_else = false;
?>
					<li>
						<?php $_smarty_tpl->_subTemplateRender("app:linkAction/linkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('action'=>$_smarty_tpl->tpl_vars['action']->value,'contextId'=>$_smarty_tpl->tpl_vars['contextId']->value), 0, true);
?>
					</li>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php }?>
		</ul>
	<?php }
} elseif (!$_smarty_tpl->tpl_vars['editorsAssigned']->value && array_intersect(array(ROLE_ID_MANAGER,ROLE_ID_SUB_EDITOR),(array)$_smarty_tpl->tpl_vars['userRoles']->value)) {?>
	<div class="pkp_no_workflow_decisions">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submission.decision.noDecisionsAvailable"),$_smarty_tpl ) );?>

	</div>
<?php } elseif ($_smarty_tpl->tpl_vars['lastDecision']->value) {?>
	<div class="pkp_no_workflow_decisions">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['lastDecision']->value),$_smarty_tpl ) );?>

	</div>
<?php }
}
}
