<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:42:23
  from 'plugins-1-plugins-generic-pdfJsViewer-generic-pdfJsViewer:submissionGalley.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152ab3f8b1346_89924421',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e60dfbe008759521933fa34101e1d5648a9027f7' => 
    array (
      0 => 'plugins-1-plugins-generic-pdfJsViewer-generic-pdfJsViewer:submissionGalley.tpl',
      1 => 1624492184,
      2 => 'plugins-1-plugins-generic-pdfJsViewer-generic-pdfJsViewer',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152ab3f8b1346_89924421 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\OJS\\lib\\pkp\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "pdfUrl", null);
if ($_smarty_tpl->tpl_vars['isLatestPublication']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"download",'path'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'to_array' ][ 0 ], array( $_smarty_tpl->tpl_vars['bestId']->value,$_smarty_tpl->tpl_vars['galley']->value->getBestGalleyId($_smarty_tpl->tpl_vars['currentJournal']->value),$_smarty_tpl->tpl_vars['galleyFile']->value->getId() )),'escape'=>false),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"download",'path'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'to_array' ][ 0 ], array( $_smarty_tpl->tpl_vars['bestId']->value,'version',$_smarty_tpl->tpl_vars['galleyPublication']->value->getId(),$_smarty_tpl->tpl_vars['galley']->value->getBestGalleyId($_smarty_tpl->tpl_vars['currentJournal']->value),$_smarty_tpl->tpl_vars['galleyFile']->value->getId() )),'escape'=>false),$_smarty_tpl ) );
}
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "parentUrl", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['submissionNoun']->value,'op'=>"view",'path'=>$_smarty_tpl->tpl_vars['bestId']->value),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "galleyTitle", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.representationOfTitle",'representation'=>$_smarty_tpl->tpl_vars['galley']->value->getLabel(),'title'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['publication']->value->getLocalizedFullTitle() ))),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "datePublished", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.outdatedVersion",'datePublished'=>smarty_modifier_date_format($_smarty_tpl->tpl_vars['galleyPublication']->value->getData('datePublished'),$_smarty_tpl->tpl_vars['dateFormatLong']->value),'urlRecentVersion'=>$_smarty_tpl->tpl_vars['parentUrl']->value),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['displayTemplateResource']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>$_smarty_tpl->tpl_vars['submission']->value->getLocalizedTitle(),'parentUrl'=>$_smarty_tpl->tpl_vars['parentUrl']->value,'pdfUrl'=>$_smarty_tpl->tpl_vars['pdfUrl']->value,'galleyTitle'=>$_smarty_tpl->tpl_vars['galleyTitle']->value,'datePublished'=>$_smarty_tpl->tpl_vars['datePublished']->value), 0, true);
}
}
