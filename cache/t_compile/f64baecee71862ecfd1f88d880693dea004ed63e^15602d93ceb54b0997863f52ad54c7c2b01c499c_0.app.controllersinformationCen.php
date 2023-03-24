<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:52:59
  from 'app:controllersinformationCen' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152adbb06f9a6_14891262',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15602d93ceb54b0997863f52ad54c7c2b01c499c' => 
    array (
      0 => 'app:controllersinformationCen',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/informationCenter/note.tpl' => 1,
  ),
),false)) {
function content_6152adbb06f9a6_14891262 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="<?php echo $_smarty_tpl->tpl_vars['notesListId']->value;?>
" class="pkp_notes_list">
	<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['iterate'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['iterate'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyIterate'))) {
throw new SmartyException('block tag \'iterate\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('iterate', array('from'=>'notes','item'=>'note'));
$_block_repeat=true;
echo $_block_plugin1->smartyIterate(array('from'=>'notes','item'=>'note'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php $_smarty_tpl->_assignInScope('noteId', $_smarty_tpl->tpl_vars['note']->value->getId());?>
		<?php $_smarty_tpl->_subTemplateRender("app:controllers/informationCenter/note.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	<?php $_block_repeat=false;
echo $_block_plugin1->smartyIterate(array('from'=>'notes','item'=>'note'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php if ($_smarty_tpl->tpl_vars['notes']->value->wasEmpty()) {?>
		<p class="no_notes"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"informationCenter.noNotes"),$_smarty_tpl ) );?>
</p>
	<?php }?>
</div>
<?php }
}
