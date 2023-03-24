<?php
/* Smarty version 3.1.39, created on 2021-09-27 16:14:14
  from 'app:frontendcomponentsannounc' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151d1b6f1cd28_57593272',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9462510335e36fd0c92bd371372fb9c9173699b4' => 
    array (
      0 => 'app:frontendcomponentsannounc',
      1 => 1582650121,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/objects/announcement_summary.tpl' => 1,
  ),
),false)) {
function content_6151d1b6f1cd28_57593272 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="announcements">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['announcements']->value, 'announcement');
$_smarty_tpl->tpl_vars['announcement']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['announcement']->value) {
$_smarty_tpl->tpl_vars['announcement']->do_else = false;
?>
		<?php $_smarty_tpl->_subTemplateRender("app:frontend/objects/announcement_summary.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>
<?php }
}
