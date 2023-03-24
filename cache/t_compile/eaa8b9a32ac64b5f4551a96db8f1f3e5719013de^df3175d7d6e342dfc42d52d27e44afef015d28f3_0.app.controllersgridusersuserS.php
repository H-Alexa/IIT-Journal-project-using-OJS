<?php
/* Smarty version 3.1.39, created on 2021-09-27 20:14:10
  from 'app:controllersgridusersuserS' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_615209f21c2536_99117440',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df3175d7d6e342dfc42d52d27e44afef015d28f3' => 
    array (
      0 => 'app:controllersgridusersuserS',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_615209f21c2536_99117440 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('formId', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "searchUserFilter-",$_smarty_tpl->tpl_vars['filterData']->value['gridId'] )));
echo '<script'; ?>
 type="text/javascript">
	// Attach the form handler to the form.
	$('#<?php echo $_smarty_tpl->tpl_vars['formId']->value;?>
').pkpHandler('$.pkp.controllers.grid.users.stageParticipant.form.AddParticipantFormHandler',
		{
			trackFormChanges: false
		}
	);
<?php echo '</script'; ?>
>
<form class="pkp_form filter" id="<?php echo $_smarty_tpl->tpl_vars['formId']->value;?>
" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"fetchGrid"),$_smarty_tpl ) );?>
" method="post">
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

	<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "userSearchFormArea",$_smarty_tpl->tpl_vars['filterData']->value['gridId'] ))));
$_block_repeat=true;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "userSearchFormArea",$_smarty_tpl->tpl_vars['filterData']->value['gridId'] ))), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<input type="hidden" name="submissionId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filterData']->value['submissionId'] ));?>
" />
		<input type="hidden" name="stageId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filterData']->value['stageId'] ));?>
" />
		<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"select",'name'=>"filterUserGroupId",'id'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "filterUserGroupId",$_smarty_tpl->tpl_vars['filterData']->value['gridId'] )),'from'=>$_smarty_tpl->tpl_vars['filterData']->value['userGroupOptions'],'selected'=>$_smarty_tpl->tpl_vars['filterSelectionData']->value['filterUserGroupId'],'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['SMALL'],'translate'=>false,'inline'=>"true"),$_smarty_tpl ) );?>

			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'name'=>"name",'id'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "name",$_smarty_tpl->tpl_vars['filterData']->value['gridId'] )),'value'=>$_smarty_tpl->tpl_vars['filterSelectionData']->value['name'],'label'=>"manager.userSearch.searchByName",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['LARGE'],'inline'=>"true"),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('hideCancel'=>true,'submitText'=>"common.search"),$_smarty_tpl ) );?>

	<?php $_block_repeat=false;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "userSearchFormArea",$_smarty_tpl->tpl_vars['filterData']->value['gridId'] ))), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
</form>
<?php }
}
