<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:00:27
  from 'app:controllerswizardfileUplo' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152af7b96e1a4_83830315',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '06387ac8ba0d28c6b6ca2b48e70da889bc5aa391' => 
    array (
      0 => 'app:controllerswizardfileUplo',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152af7b96e1a4_83830315 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('metadataFormId', uniqid("metadataForm"));
echo '<script'; ?>
 type="text/javascript">
	$(function() {
		// Attach the form handler.
		$('#<?php echo $_smarty_tpl->tpl_vars['metadataFormId']->value;?>
').pkpHandler('$.pkp.controllers.form.AjaxFormHandler');
	});
<?php echo '</script'; ?>
>

<form class="pkp_form" id="<?php echo $_smarty_tpl->tpl_vars['metadataFormId']->value;?>
" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('component'=>"api.file.ManageFileApiHandler",'op'=>"saveMetadata",'submissionId'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('submissionId'),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'fileStage'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('fileStage'),'submissionFileId'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getId(),'escape'=>false),$_smarty_tpl ) );?>
" method="post">
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>


		<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"fileMetaData"));
$_block_repeat=true;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>"fileMetaData"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>

				<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"submission.form.name",'required'=>true));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"submission.form.name",'required'=>true), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'id'=>"name",'value'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('name'),'multilingual'=>true,'maxlength'=>"255",'required'=>true),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"submission.form.name",'required'=>true), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

				<?php if ($_smarty_tpl->tpl_vars['genre']->value && $_smarty_tpl->tpl_vars['genre']->value->getCategory() == (defined('GENRE_CATEGORY_SUPPLEMENTARY') ? constant('GENRE_CATEGORY_SUPPLEMENTARY') : null)) {?>
			<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin3->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('label'=>"common.description",'type'=>"textarea",'id'=>"description",'value'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('description'),'multilingual'=>true),$_smarty_tpl ) );?>

				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('label'=>"submission.supplementary.creator",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'type'=>"text",'id'=>"creator",'value'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('creator'),'multilingual'=>true,'maxlength'=>"255"),$_smarty_tpl ) );?>

				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('label'=>"submission.supplementary.publisher",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'type'=>"text",'id'=>"publisher",'value'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('publisher'),'multilingual'=>true,'maxlength'=>"255"),$_smarty_tpl ) );?>

				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('label'=>"common.source",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'type'=>"text",'id'=>"source",'value'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('source'),'multilingual'=>true,'maxlength'=>"255"),$_smarty_tpl ) );?>

				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('label'=>"submission.supplementary.subject",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'type'=>"text",'id'=>"subject",'value'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('subject'),'multilingual'=>true,'maxlength'=>"255"),$_smarty_tpl ) );?>

				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('label'=>"submission.supplementary.sponsor",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'type'=>"text",'id'=>"sponsor",'value'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('sponsor'),'multilingual'=>true,'maxlength'=>"255"),$_smarty_tpl ) );?>

				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('label'=>"common.date",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['SMALL'],'type'=>"text",'id'=>"dateCreated",'value'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('dateCreated'),'class'=>"datepicker"),$_smarty_tpl ) );?>

				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('label'=>"common.language",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['SMALL'],'type'=>"text",'id'=>"language",'value'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('language'),'maxlength'=>"255"),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin3->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>

				<?php if ($_smarty_tpl->tpl_vars['genre']->value && $_smarty_tpl->tpl_vars['genre']->value->getCategory() == (defined('GENRE_CATEGORY_ARTWORK') ? constant('GENRE_CATEGORY_ARTWORK') : null)) {?>
			<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"grid.artworkFile.caption",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']));
$_block_repeat=true;
echo $_block_plugin4->smartyFBVFormSection(array('title'=>"grid.artworkFile.caption",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'id'=>"artworkCaption",'height'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['height']['SHORT'],'value'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('caption')),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin4->smartyFBVFormSection(array('title'=>"grid.artworkFile.caption",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"grid.artworkFile.credit",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']));
$_block_repeat=true;
echo $_block_plugin5->smartyFBVFormSection(array('title'=>"grid.artworkFile.credit",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'id'=>"artworkCredit",'height'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['height']['SHORT'],'value'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('credit')),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin5->smartyFBVFormSection(array('title'=>"grid.artworkFile.credit",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"grid.artworkFile.copyrightOwner",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']));
$_block_repeat=true;
echo $_block_plugin6->smartyFBVFormSection(array('title'=>"grid.artworkFile.copyrightOwner",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'id'=>"artworkCopyrightOwner",'height'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['height']['SHORT'],'value'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('copyrightOwner')),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin6->smartyFBVFormSection(array('title'=>"grid.artworkFile.copyrightOwner",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"grid.artworkFile.permissionTerms",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']));
$_block_repeat=true;
echo $_block_plugin7->smartyFBVFormSection(array('title'=>"grid.artworkFile.permissionTerms",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'id'=>"artworkPermissionTerms",'height'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['height']['SHORT'],'value'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('terms')),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin7->smartyFBVFormSection(array('title'=>"grid.artworkFile.permissionTerms",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>

	<?php $_block_repeat=false;
echo $_block_plugin1->smartyFBVFormArea(array('id'=>"fileMetaData"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php if ($_smarty_tpl->tpl_vars['supportsDependentFiles']->value) {?>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'dependentFilesGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.dependent.DependentFilesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getData('submissionId'),'submissionFileId'=>$_smarty_tpl->tpl_vars['submissionFile']->value->getId(),'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"dependentFilesGridDiv",'url'=>$_smarty_tpl->tpl_vars['dependentFilesGridUrl']->value),$_smarty_tpl ) );?>

	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['showButtons']->value) {?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"hidden",'id'=>"showButtons",'value'=>$_smarty_tpl->tpl_vars['showButtons']->value),$_smarty_tpl ) );?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('submitText'=>"common.save"),$_smarty_tpl ) );?>

	<?php }?>
</form>
<?php }
}
