<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:03:28
  from 'app:authorDashboardreviewRoun' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152b030263ca5_14540888',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0860ca1a56fc1f07ebaba1e46da544f8359957e7' => 
    array (
      0 => 'app:authorDashboardreviewRoun',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152b030263ca5_14540888 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
	// Attach the JS file tab handler.
	$(function() {
		$('#<?php echo $_smarty_tpl->tpl_vars['reviewRoundTabsId']->value;?>
').pkpHandler(
			'$.pkp.controllers.TabHandler',
			{
				<?php $_smarty_tpl->_assignInScope('roundIndex', $_smarty_tpl->tpl_vars['lastReviewRoundNumber']->value-1);?>
				selected: <?php echo $_smarty_tpl->tpl_vars['roundIndex']->value;?>

			}
		);
	});
<?php echo '</script'; ?>
>
<div id="<?php echo $_smarty_tpl->tpl_vars['reviewRoundTabsId']->value;?>
" class="pkp_controllers_tab">
	<ul>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reviewRounds']->value, 'reviewRound');
$_smarty_tpl->tpl_vars['reviewRound']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['reviewRound']->value) {
$_smarty_tpl->tpl_vars['reviewRound']->do_else = false;
?>
			<li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"tab.authorDashboard.AuthorDashboardReviewRoundTabHandler",'op'=>"fetchReviewRoundInfo",'submissionId'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['reviewRound']->value->getStageId(),'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRound']->value->getId(),'escape'=>false),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.round",'round'=>$_smarty_tpl->tpl_vars['reviewRound']->value->getRound()),$_smarty_tpl ) );?>
</a></li>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</ul>
</div>
<?php }
}
