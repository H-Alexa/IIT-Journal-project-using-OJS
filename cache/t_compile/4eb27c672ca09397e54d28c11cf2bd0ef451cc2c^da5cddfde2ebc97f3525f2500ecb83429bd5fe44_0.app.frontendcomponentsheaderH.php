<?php
/* Smarty version 3.1.39, created on 2021-09-27 19:45:40
  from 'app:frontendcomponentsheaderH' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61520344b89984_09418813',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da5cddfde2ebc97f3525f2500ecb83429bd5fe44' => 
    array (
      0 => 'app:frontendcomponentsheaderH',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61520344b89984_09418813 (Smarty_Internal_Template $_smarty_tpl) {
?><head>
	<meta charset="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['defaultCharset']->value ));?>
">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['pageTitleTranslated']->value);?>

				<?php if ((($tmp = @call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['requestedPage']->value )))===null||$tmp==='' ? "index" : $tmp) != 'index' && $_smarty_tpl->tpl_vars['currentContext']->value && $_smarty_tpl->tpl_vars['currentContext']->value->getLocalizedName()) {?>
			| <?php echo $_smarty_tpl->tpl_vars['currentContext']->value->getLocalizedName();?>

		<?php }?>
	</title>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_header'][0], array( array('context'=>"frontend"),$_smarty_tpl ) );?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_stylesheet'][0], array( array('context'=>"frontend"),$_smarty_tpl ) );?>

</head>
<?php }
}
