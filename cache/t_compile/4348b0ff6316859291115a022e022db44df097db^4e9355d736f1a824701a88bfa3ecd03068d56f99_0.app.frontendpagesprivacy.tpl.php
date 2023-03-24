<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:44:57
  from 'app:frontendpagesprivacy.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152abd95f4563_92345042',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e9355d736f1a824701a88bfa3ecd03068d56f99' => 
    array (
      0 => 'app:frontendpagesprivacy.tpl',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/header.tpl' => 1,
    'app:frontend/components/breadcrumbs.tpl' => 1,
    'app:frontend/components/footer.tpl' => 1,
  ),
),false)) {
function content_6152abd95f4563_92345042 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("app:frontend/components/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('pageTitle'=>"manager.setup.privacyStatement"), 0, false);
?>

<div class="page page_privacy">
	<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/breadcrumbs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('currentTitleKey'=>"manager.setup.privacyStatement"), 0, false);
?>
	<h1>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"manager.setup.privacyStatement"),$_smarty_tpl ) );?>

	</h1>
	<?php echo $_smarty_tpl->tpl_vars['privacyStatement']->value;?>

</div><!-- .page -->

<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
