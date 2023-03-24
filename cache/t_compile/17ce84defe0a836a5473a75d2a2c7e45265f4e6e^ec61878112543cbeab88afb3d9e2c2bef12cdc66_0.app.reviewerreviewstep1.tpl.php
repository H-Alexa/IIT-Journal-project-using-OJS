<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:57:20
  from 'app:reviewerreviewstep1.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152aec0bcb738_32911838',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec61878112543cbeab88afb3d9e2c2bef12cdc66' => 
    array (
      0 => 'app:reviewerreviewstep1.tpl',
      1 => 1624492110,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'core:reviewer/review/step1.tpl' => 1,
  ),
),false)) {
function content_6152aec0bcb738_32911838 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('descriptionFieldKey', "article.abstract");
$_smarty_tpl->_subTemplateRender("core:reviewer/review/step1.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
