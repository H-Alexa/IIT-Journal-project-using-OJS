<?php
/* Smarty version 3.1.39, created on 2021-09-27 20:14:10
  from 'app:controllersgridfeaturecol' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_615209f24ee0f4_03169030',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92cad1571673b04316cfee05e9afc7e4df433a7d' => 
    array (
      0 => 'app:controllersgridfeaturecol',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:linkAction/linkAction.tpl' => 1,
  ),
),false)) {
function content_615209f24ee0f4_03169030 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("app:linkAction/linkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('action'=>$_smarty_tpl->tpl_vars['controlLink']->value,'contextId'=>'collapsibleGridControl'), 0, false);
}
}
