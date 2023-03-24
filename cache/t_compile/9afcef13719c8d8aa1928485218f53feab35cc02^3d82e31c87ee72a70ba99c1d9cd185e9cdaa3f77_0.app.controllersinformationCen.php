<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:52:59
  from 'app:controllersinformationCen' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152adbb16a594_31185853',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d82e31c87ee72a70ba99c1d9cd185e9cdaa3f77' => 
    array (
      0 => 'app:controllersinformationCen',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152adbb16a594_31185853 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
	// Attach the Notes handler.
	$(function() {
		$('#newNoteForm').pkpHandler(
			'$.pkp.controllers.form.AjaxFormHandler',
			{
				baseUrl: <?php echo json_encode($_smarty_tpl->tpl_vars['baseUrl']->value);?>

			}
		);
	});
<?php echo '</script'; ?>
>

<form class="pkp_form" id="newNoteForm" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'op'=>"saveNote",'params'=>$_smarty_tpl->tpl_vars['linkParams']->value),$_smarty_tpl ) );?>
" method="post">
	<div id="newNoteContainer">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

		<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"informationCenter.addNote",'for'=>"newNote"));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"informationCenter.addNote",'for'=>"newNote"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'id'=>"newNote"),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"informationCenter.addNote",'for'=>"newNote"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('hideCancel'=>true,'submitText'=>$_smarty_tpl->tpl_vars['submitNoteText']->value),$_smarty_tpl ) );?>

	</div>
</form>
<?php }
}
