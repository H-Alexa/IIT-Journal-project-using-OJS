<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:21:44
  from 'app:controllersgridqueriesfor' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152b4782c8962_11053018',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cf0184772fdd3e26e3949ba5f0001e34b4a3c1c1' => 
    array (
      0 => 'app:controllersgridqueriesfor',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/notification/inPlaceNotification.tpl' => 1,
  ),
),false)) {
function content_6152b4782c8962_11053018 (Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php if (!count($_smarty_tpl->tpl_vars['allParticipants']->value)) {?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.query.noParticipantOptions"),$_smarty_tpl ) );?>

 <?php } else { ?>
	<?php echo '<script'; ?>
>
		// Attach the handler.
		$(function() {
			$('#queryForm').pkpHandler(
				'$.pkp.controllers.form.CancelActionAjaxFormHandler',
				{
					cancelUrl: <?php if ($_smarty_tpl->tpl_vars['isNew']->value) {?>'<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"deleteQuery",'queryId'=>$_smarty_tpl->tpl_vars['queryId']->value,'csrfToken'=>$_smarty_tpl->tpl_vars['csrfToken']->value,'params'=>$_smarty_tpl->tpl_vars['actionArgs']->value,'escape'=>false),$_smarty_tpl ) ),'javascript' ));?>
'<?php } else { ?>null<?php }?>
				}
			);
		});
	<?php echo '</script'; ?>
>

	<form class="pkp_form" id="queryForm" method="post" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"updateQuery",'queryId'=>$_smarty_tpl->tpl_vars['queryId']->value,'params'=>$_smarty_tpl->tpl_vars['actionArgs']->value),$_smarty_tpl ) );?>
">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>


		<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/inPlaceNotification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('notificationId'=>"queryFormNotification"), 0, false);
?>

		<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('list'=>true,'title'=>"editor.submission.stageParticipants"));
$_block_repeat=true;
echo $_block_plugin1->smartyFBVFormSection(array('list'=>true,'title'=>"editor.submission.stageParticipants"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['allParticipants']->value, 'participant', false, 'id');
$_smarty_tpl->tpl_vars['participant']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['participant']->value) {
$_smarty_tpl->tpl_vars['participant']->do_else = false;
?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'id'=>"users[]",'value'=>$_smarty_tpl->tpl_vars['id']->value,'checked'=>in_array($_smarty_tpl->tpl_vars['id']->value,$_smarty_tpl->tpl_vars['assignedParticipants']->value),'label'=>$_smarty_tpl->tpl_vars['participant']->value,'translate'=>false),$_smarty_tpl ) );?>

			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php $_block_repeat=false;
echo $_block_plugin1->smartyFBVFormSection(array('list'=>true,'title'=>"editor.submission.stageParticipants"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

		<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"queryContentsArea"));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormArea(array('id'=>"queryContentsArea"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"common.subject",'for'=>"subject",'required'=>"true"));
$_block_repeat=true;
echo $_block_plugin3->smartyFBVFormSection(array('title'=>"common.subject",'for'=>"subject",'required'=>"true"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'id'=>"subject",'value'=>$_smarty_tpl->tpl_vars['subject']->value,'required'=>"true"),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin3->smartyFBVFormSection(array('title'=>"common.subject",'for'=>"subject",'required'=>"true"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

			<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"stageParticipants.notify.message",'for'=>"comment",'required'=>"true"));
$_block_repeat=true;
echo $_block_plugin4->smartyFBVFormSection(array('title'=>"stageParticipants.notify.message",'for'=>"comment",'required'=>"true"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'id'=>"comment",'rich'=>true,'value'=>$_smarty_tpl->tpl_vars['comment']->value,'required'=>"true"),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin4->smartyFBVFormSection(array('title'=>"stageParticipants.notify.message",'for'=>"comment",'required'=>"true"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormArea(array('id'=>"queryContentsArea"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

		<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"queryNoteFilesArea"));
$_block_repeat=true;
echo $_block_plugin5->smartyFBVFormArea(array('id'=>"queryNoteFilesArea"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'queryNoteFilesGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.query.QueryNoteFilesGridHandler",'op'=>"fetchGrid",'params'=>$_smarty_tpl->tpl_vars['actionArgs']->value,'queryId'=>$_smarty_tpl->tpl_vars['queryId']->value,'noteId'=>$_smarty_tpl->tpl_vars['noteId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"queryNoteFilesGrid",'url'=>$_smarty_tpl->tpl_vars['queryNoteFilesGridUrl']->value),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin5->smartyFBVFormArea(array('id'=>"queryNoteFilesArea"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

		<p><span class="formRequired"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.requiredField"),$_smarty_tpl ) );?>
</span></p>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('id'=>"addQueryButton"),$_smarty_tpl ) );?>


	</form>
<?php }
}
}
