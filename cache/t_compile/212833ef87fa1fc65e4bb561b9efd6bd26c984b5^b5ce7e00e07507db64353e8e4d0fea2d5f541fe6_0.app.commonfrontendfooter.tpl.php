<?php
/* Smarty version 3.1.39, created on 2021-09-27 16:14:11
  from 'app:commonfrontendfooter.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151d1b3abd8f9_21413257',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b5ce7e00e07507db64353e8e4d0fea2d5f541fe6' => 
    array (
      0 => 'app:commonfrontendfooter.tpl',
      1 => 1599486834,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/footer.tpl' => 1,
  ),
),false)) {
function content_6151d1b3abd8f9_21413257 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('brandImage', "templates/images/ojs_brand.png");
$_smarty_tpl->_assignInScope('packageKey', "common.software");
$_smarty_tpl->_assignInScope('pkpLink', "http://pkp.sfu.ca/ojs");
$_smarty_tpl->_subTemplateRender("app:frontend/components/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
