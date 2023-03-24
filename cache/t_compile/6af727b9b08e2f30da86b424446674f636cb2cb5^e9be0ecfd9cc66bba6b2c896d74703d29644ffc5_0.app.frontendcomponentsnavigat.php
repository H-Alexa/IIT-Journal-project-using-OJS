<?php
/* Smarty version 3.1.39, created on 2021-09-27 15:47:25
  from 'app:frontendcomponentsnavigat' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151cb6dc3b361_45935727',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9be0ecfd9cc66bba6b2c896d74703d29644ffc5' => 
    array (
      0 => 'app:frontendcomponentsnavigat',
      1 => 1582650121,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6151cb6dc3b361_45935727 (Smarty_Internal_Template $_smarty_tpl) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['navigationMenuItem']->value->getLocalizedTitle() ));?>

<span class="badge">
	<?php echo $_smarty_tpl->tpl_vars['unreadNotificationCount']->value;?>

</span>
<?php }
}
