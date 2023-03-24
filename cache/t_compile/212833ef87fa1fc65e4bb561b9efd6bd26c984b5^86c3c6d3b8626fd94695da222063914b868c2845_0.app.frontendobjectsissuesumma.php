<?php
/* Smarty version 3.1.39, created on 2021-09-27 16:14:11
  from 'app:frontendobjectsissuesumma' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151d1b3977bf1_53805987',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '86c3c6d3b8626fd94695da222063914b868c2845' => 
    array (
      0 => 'app:frontendobjectsissuesumma',
      1 => 1599486834,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6151d1b3977bf1_53805987 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="issue-summary media">

		<?php $_smarty_tpl->_assignInScope('issueTitle', $_smarty_tpl->tpl_vars['issue']->value->getLocalizedTitle());?>
	<?php $_smarty_tpl->_assignInScope('issueSeries', $_smarty_tpl->tpl_vars['issue']->value->getIssueSeries());?>

		<?php if ($_smarty_tpl->tpl_vars['issue']->value->getLocalizedCoverImage()) {?>
		<div class="media-left">
			<a class="cover" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"view",'path'=>$_smarty_tpl->tpl_vars['issue']->value->getBestIssueId($_smarty_tpl->tpl_vars['currentJournal']->value)),$_smarty_tpl ) ) ));?>
">
				<img class="media-object" src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['issue']->value->getLocalizedCoverImageUrl() ));?>
" alt="<?php echo (($tmp = @call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['issue']->value->getLocalizedCoverImageAltText() )))===null||$tmp==='' ? '' : $tmp);?>
">
			</a>
		</div>
	<?php }?>


	<div class="media-body">
		<h2 class="media-heading">
			<a class="title" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"view",'path'=>$_smarty_tpl->tpl_vars['issue']->value->getBestIssueId($_smarty_tpl->tpl_vars['currentJournal']->value)),$_smarty_tpl ) ) ));?>
">
				<?php if ($_smarty_tpl->tpl_vars['issueTitle']->value) {?>
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['issueTitle']->value ));?>

				<?php } else { ?>
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['issueSeries']->value ));?>

				<?php }?>
			</a>
			<?php if ($_smarty_tpl->tpl_vars['issueTitle']->value) {?>
				<div class="series lead">
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['issueSeries']->value ));?>

				</div>
			<?php }?>
		</h2>
		<div class="description">
			<?php echo nl2br(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( $_smarty_tpl->tpl_vars['issueDescription']->value )));?>

		</div>
	</div>
</div><!-- .issue-summary -->
<?php }
}
