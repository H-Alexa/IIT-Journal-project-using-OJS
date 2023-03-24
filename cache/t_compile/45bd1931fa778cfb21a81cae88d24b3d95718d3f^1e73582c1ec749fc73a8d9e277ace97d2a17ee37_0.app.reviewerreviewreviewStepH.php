<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:57:19
  from 'app:reviewerreviewreviewStepH' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152aebf6d26b3_07618454',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1e73582c1ec749fc73a8d9e277ace97d2a17ee37' => 
    array (
      0 => 'app:reviewerreviewreviewStepH',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152aebf6d26b3_07618454 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19745771986152aebf6b0971_12418440', "page");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/backend.tpl");
}
/* {block "page"} */
class Block_19745771986152aebf6b0971_12418440 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page' => 
  array (
    0 => 'Block_19745771986152aebf6b0971_12418440',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<h1 class="app__pageHeading">
		<?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>

	</h1>

	<?php echo '<script'; ?>
 type="text/javascript">
		// Attach the JS file tab handler.
		$(function() {
			$('#reviewTabs').pkpHandler(
				'$.pkp.pages.reviewer.ReviewerTabHandler',
				{
					reviewStep: <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['reviewStep']->value ));?>
,
					selected: <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['selected']->value ));?>

				}
			);
		});
	<?php echo '</script'; ?>
>

	<div id="reviewTabs" class="pkp_controllers_tab">
		<ul>
			<li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"step",'path'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'step'=>1),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"reviewer.reviewSteps.request"),$_smarty_tpl ) );?>
</a></li>
			<li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"step",'path'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'step'=>2),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"reviewer.reviewSteps.guidelines"),$_smarty_tpl ) );?>
</a></li>
			<li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"step",'path'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'step'=>3),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"reviewer.reviewSteps.download"),$_smarty_tpl ) );?>
</a></li>
			<li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"step",'path'=>$_smarty_tpl->tpl_vars['submission']->value->getId(),'step'=>4),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"reviewer.reviewSteps.completion"),$_smarty_tpl ) );?>
</a></li>
		</ul>
	</div>
<?php
}
}
/* {/block "page"} */
}
