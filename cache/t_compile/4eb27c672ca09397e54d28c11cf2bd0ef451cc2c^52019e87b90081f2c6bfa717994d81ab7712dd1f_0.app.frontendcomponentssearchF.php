<?php
/* Smarty version 3.1.39, created on 2021-09-27 19:45:40
  from 'app:frontendcomponentssearchF' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61520344d21bf7_57330345',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '52019e87b90081f2c6bfa717994d81ab7712dd1f' => 
    array (
      0 => 'app:frontendcomponentssearchF',
      1 => 1599486834,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61520344d21bf7_57330345 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['currentJournal']->value || $_smarty_tpl->tpl_vars['currentJournal']->value->getData('publishingMode') != (defined('PUBLISHING_MODE_NONE') ? constant('PUBLISHING_MODE_NONE') : null)) {?>
<form class="navbar-form navbar-left" role="search" method="post" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"search",'op'=>"search"),$_smarty_tpl ) );?>
">
  <div class="form-group">
    <input class="form-control" name="query" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['searchQuery']->value ));?>
" type="search" aria-label="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.searchQuery"),$_smarty_tpl ) ) ));?>
" placeholder="">
  </div>
  <button type="submit" class="btn btn-default"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.search"),$_smarty_tpl ) );?>
</button>
</form>
<?php }
}
}
