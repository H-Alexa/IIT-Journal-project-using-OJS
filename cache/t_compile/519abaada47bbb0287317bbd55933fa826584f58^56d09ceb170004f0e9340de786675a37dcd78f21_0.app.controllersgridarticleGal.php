<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:22:52
  from 'app:controllersgridarticleGal' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152b4bcbf61b6_07438413',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '56d09ceb170004f0e9340de786675a37dcd78f21' => 
    array (
      0 => 'app:controllersgridarticleGal',
      1 => 1624492110,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152b4bcbf61b6_07438413 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['urlRemote']->value) {?>
	<?php $_smarty_tpl->_assignInScope('remoteRepresentation', true);
} else { ?>
	<?php $_smarty_tpl->_assignInScope('remoteRepresentation', false);
}
echo '<script'; ?>
 type="text/javascript">
	$(function() {
		// Attach the form handler.
		$('#articleGalleyForm').pkpHandler('$.pkp.controllers.grid.representations.form.RepresentationFormHandler',
			{
				remoteRepresentation: <?php echo json_encode($_smarty_tpl->tpl_vars['remoteRepresentation']->value);?>

			}
		);
	});
<?php echo '</script'; ?>
>
<form class="pkp_form" id="articleGalleyForm" method="post" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>"updateGalley",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'publicationId'=>$_smarty_tpl->tpl_vars['publicationId']->value,'representationId'=>$_smarty_tpl->tpl_vars['representationId']->value),$_smarty_tpl ) );?>
">
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

	<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"galley"));
$_block_repeat=true;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>"galley"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"submission.layout.galleyLabel",'required'=>true));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"submission.layout.galleyLabel",'required'=>true), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'label'=>"submission.layout.galleyLabelInstructions",'value'=>$_smarty_tpl->tpl_vars['label']->value,'id'=>"label",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'inline'=>true,'required'=>true),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"submission.layout.galleyLabel",'required'=>true), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin3->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"select",'id'=>"galleyLocale",'label'=>"common.language",'from'=>$_smarty_tpl->tpl_vars['supportedLocales']->value,'selected'=>(($tmp = @$_smarty_tpl->tpl_vars['galleyLocale']->value)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['formLocale']->value : $tmp),'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'translate'=>false,'inline'=>true,'required'=>true),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin3->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('for'=>"remotelyHostedContent",'list'=>true));
$_block_repeat=true;
echo $_block_plugin4->smartyFBVFormSection(array('for'=>"remotelyHostedContent",'list'=>true), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'label'=>"submission.layout.galley.remotelyHostedContent",'id'=>"remotelyHostedContent"),$_smarty_tpl ) );?>

			<div id="remote" style="display:none">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'id'=>"urlRemote",'label'=>"submission.layout.galley.remoteURL",'value'=>$_smarty_tpl->tpl_vars['urlRemote']->value),$_smarty_tpl ) );?>

			</div>
		<?php $_block_repeat=false;
echo $_block_plugin4->smartyFBVFormSection(array('for'=>"remotelyHostedContent",'list'=>true), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('id'=>"urlPathSection",'title'=>"publication.urlPath"));
$_block_repeat=true;
echo $_block_plugin5->smartyFBVFormSection(array('id'=>"urlPathSection",'title'=>"publication.urlPath"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'label'=>"publication.urlPath.description",'value'=>$_smarty_tpl->tpl_vars['urlPath']->value,'id'=>"urlPath",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'inline'=>true),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin5->smartyFBVFormSection(array('id'=>"urlPathSection",'title'=>"publication.urlPath"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php $_block_repeat=false;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>"galley"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php if ($_smarty_tpl->tpl_vars['supportsDependentFiles']->value) {?>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'dependentFilesGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.dependent.DependentFilesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'submissionFileId'=>$_smarty_tpl->tpl_vars['articleGalleyFile']->value->getId(),'stageId'=>(defined('WORKFLOW_STAGE_ID_PRODUCTION') ? constant('WORKFLOW_STAGE_ID_PRODUCTION') : null),'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"dependentFilesGridDiv",'url'=>$_smarty_tpl->tpl_vars['dependentFilesGridUrl']->value),$_smarty_tpl ) );?>

	<?php }?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('submitText'=>"common.save"),$_smarty_tpl ) );?>

</form>
<?php }
}
