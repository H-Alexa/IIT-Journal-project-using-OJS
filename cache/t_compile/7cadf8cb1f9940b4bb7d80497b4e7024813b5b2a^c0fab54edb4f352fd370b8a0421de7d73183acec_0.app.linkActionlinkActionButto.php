<?php
/* Smarty version 3.1.39, created on 2021-09-27 20:14:10
  from 'app:linkActionlinkActionButto' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_615209f256d7e3_24983649',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c0fab54edb4f352fd370b8a0421de7d73183acec' => 
    array (
      0 => 'app:linkActionlinkActionButto',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_615209f256d7e3_24983649 (Smarty_Internal_Template $_smarty_tpl) {
?><a href="#" id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['buttonId']->value ));?>
"<?php if ($_smarty_tpl->tpl_vars['action']->value->getToolTip()) {?> title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action']->value->getToolTip() ));?>
"<?php }?> class="pkp_controllers_linkAction pkp_linkaction_<?php echo $_smarty_tpl->tpl_vars['action']->value->getId();?>
 pkp_linkaction_icon_<?php echo $_smarty_tpl->tpl_vars['action']->value->getImage();?>
"><?php if ($_smarty_tpl->tpl_vars['anyhtml']->value) {
echo $_smarty_tpl->tpl_vars['action']->value->getTitle();
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( $_smarty_tpl->tpl_vars['action']->value->getTitle() ));
}?></a>
<?php }
}
