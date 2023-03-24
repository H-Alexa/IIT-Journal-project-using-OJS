<?php
/* Smarty version 3.1.39, created on 2021-09-27 16:14:11
  from 'app:frontendpagesissue.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151d1b319e3b4_30586141',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fcbc2cabc0d4dff6219d7e4b5d36c1363533cfd8' => 
    array (
      0 => 'app:frontendpagesissue.tpl',
      1 => 1582650121,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/header.tpl' => 1,
    'app:frontend/components/breadcrumbs_issue.tpl' => 2,
    'app:frontend/components/notification.tpl' => 1,
    'app:frontend/objects/issue_toc.tpl' => 1,
    'app:common/frontend/footer.tpl' => 1,
  ),
),false)) {
function content_6151d1b319e3b4_30586141 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("app:frontend/components/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('pageTitleTranslated'=>$_smarty_tpl->tpl_vars['issueIdentification']->value), 0, false);
?>

<div id="main-content" class="page page_issue">

		<?php if (!$_smarty_tpl->tpl_vars['issue']->value) {?>
		<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/breadcrumbs_issue.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('currentTitleKey'=>"current.noCurrentIssue"), 0, false);
?>
		<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/notification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"warning",'messageKey'=>"current.noCurrentIssueDesc"), 0, false);
?>

		<?php } else { ?>
		<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/breadcrumbs_issue.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('currentTitle'=>$_smarty_tpl->tpl_vars['issueIdentification']->value), 0, true);
?>
		<?php $_smarty_tpl->_subTemplateRender("app:frontend/objects/issue_toc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	<?php }?>

</div>

<?php $_smarty_tpl->_subTemplateRender("app:common/frontend/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
