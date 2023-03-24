<?php
/* Smarty version 3.1.39, created on 2021-09-27 19:58:35
  from 'core:submissionsubmissionMetad' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152064bd5c6d7_53662811',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '545f569b52401e3c9b315ed7e58bfc6c77855363' => 
    array (
      0 => 'core:submissionsubmissionMetad',
      1 => 1624492183,
      2 => 'core',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152064bd5c6d7_53662811 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['citationsEnabled']->value && array_intersect(array(ROLE_ID_MANAGER,ROLE_ID_SUB_EDITOR,ROLE_ID_ASSISTANT,ROLE_ID_REVIEWER,ROLE_ID_AUTHOR),(array)$_smarty_tpl->tpl_vars['userRoles']->value)) {?>
	<?php $_smarty_tpl->_assignInScope('citationsEnabled', true);
} else { ?>
	<?php $_smarty_tpl->_assignInScope('citationsEnabled', false);
}?>

<?php if ($_smarty_tpl->tpl_vars['coverageEnabled']->value || $_smarty_tpl->tpl_vars['typeEnabled']->value || $_smarty_tpl->tpl_vars['sourceEnabled']->value || $_smarty_tpl->tpl_vars['rightsEnabled']->value) {?>
	<?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"additionalDublinCore",'title'=>"submission.metadata"));
$_block_repeat=true;
echo $_block_plugin6->smartyFBVFormArea(array('id'=>"additionalDublinCore",'title'=>"submission.metadata"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('description'=>"submission.metadataDescription"));
$_block_repeat=true;
echo $_block_plugin7->smartyFBVFormSection(array('description'=>"submission.metadataDescription"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			
		<?php $_block_repeat=false;
echo $_block_plugin7->smartyFBVFormSection(array('description'=>"submission.metadataDescription"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php if ($_smarty_tpl->tpl_vars['coverageEnabled']->value) {?>
			<?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"submission.coverage",'for'=>"coverage",'required'=>$_smarty_tpl->tpl_vars['coverageRequired']->value));
$_block_repeat=true;
echo $_block_plugin8->smartyFBVFormSection(array('title'=>"submission.coverage",'for'=>"coverage",'required'=>$_smarty_tpl->tpl_vars['coverageRequired']->value), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'multilingual'=>true,'name'=>"coverage",'id'=>"coverage",'value'=>$_smarty_tpl->tpl_vars['coverage']->value,'maxlength'=>"255",'readonly'=>$_smarty_tpl->tpl_vars['readOnly']->value,'required'=>$_smarty_tpl->tpl_vars['coverageRequired']->value),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin8->smartyFBVFormSection(array('title'=>"submission.coverage",'for'=>"coverage",'required'=>$_smarty_tpl->tpl_vars['coverageRequired']->value), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['typeEnabled']->value) {?>
			<?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('for'=>"type",'title'=>"common.type",'required'=>$_smarty_tpl->tpl_vars['typeRequired']->value));
$_block_repeat=true;
echo $_block_plugin9->smartyFBVFormSection(array('for'=>"type",'title'=>"common.type",'required'=>$_smarty_tpl->tpl_vars['typeRequired']->value), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'label'=>"submission.type.tip",'multilingual'=>true,'name'=>"type",'id'=>"type",'value'=>$_smarty_tpl->tpl_vars['type']->value,'maxlength'=>"255",'readonly'=>$_smarty_tpl->tpl_vars['readOnly']->value,'required'=>$_smarty_tpl->tpl_vars['typeRequired']->value),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin9->smartyFBVFormSection(array('for'=>"type",'title'=>"common.type",'required'=>$_smarty_tpl->tpl_vars['typeRequired']->value), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['sourceEnabled']->value) {?>
			<?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>"submission.source",'for'=>"source",'required'=>$_smarty_tpl->tpl_vars['sourceRequired']->value));
$_block_repeat=true;
echo $_block_plugin10->smartyFBVFormSection(array('label'=>"submission.source",'for'=>"source",'required'=>$_smarty_tpl->tpl_vars['sourceRequired']->value), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'label'=>"submission.source.tip",'multilingual'=>true,'name'=>"source",'id'=>"source",'value'=>$_smarty_tpl->tpl_vars['source']->value,'maxlength'=>"255",'readonly'=>$_smarty_tpl->tpl_vars['readOnly']->value,'required'=>$_smarty_tpl->tpl_vars['sourceRequired']->value),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin10->smartyFBVFormSection(array('label'=>"submission.source",'for'=>"source",'required'=>$_smarty_tpl->tpl_vars['sourceRequired']->value), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['rightsEnabled']->value) {?>
			<?php $_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin11, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>"submission.rights",'for'=>"rights",'required'=>$_smarty_tpl->tpl_vars['rightsRequired']->value));
$_block_repeat=true;
echo $_block_plugin11->smartyFBVFormSection(array('label'=>"submission.rights",'for'=>"rights",'required'=>$_smarty_tpl->tpl_vars['rightsRequired']->value), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'label'=>"submission.rights.tip",'multilingual'=>true,'name'=>"rights",'id'=>"rights",'value'=>$_smarty_tpl->tpl_vars['rights']->value,'maxlength'=>"255",'readonly'=>$_smarty_tpl->tpl_vars['readOnly']->value,'required'=>$_smarty_tpl->tpl_vars['rightsRequired']->value),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin11->smartyFBVFormSection(array('label'=>"submission.rights",'for'=>"rights",'required'=>$_smarty_tpl->tpl_vars['rightsRequired']->value), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>
	<?php $_block_repeat=false;
echo $_block_plugin6->smartyFBVFormArea(array('id'=>"additionalDublinCore",'title'=>"submission.metadata"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}?>

<?php if ($_smarty_tpl->tpl_vars['languagesEnabled']->value || $_smarty_tpl->tpl_vars['subjectsEnabled']->value || $_smarty_tpl->tpl_vars['agenciesEnabled']->value || $_smarty_tpl->tpl_vars['keywordsEnabled']->value || $_smarty_tpl->tpl_vars['citationsEnabled']->value || $_smarty_tpl->tpl_vars['disciplinesEnabled']->value) {?>
	<?php $_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin12, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"tagitFields",'title'=>"submission.submit.metadataForm"));
$_block_repeat=true;
echo $_block_plugin12->smartyFBVFormArea(array('id'=>"tagitFields",'title'=>"submission.submit.metadataForm"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php if ($_smarty_tpl->tpl_vars['languagesEnabled']->value) {?>
			<?php echo $_smarty_tpl->tpl_vars['languagesField']->value;?>

		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['subjectsEnabled']->value) {?>
			<?php $_block_plugin13 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin13, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('description'=>"submission.submit.metadataForm.tip",'label'=>"common.subjects",'required'=>$_smarty_tpl->tpl_vars['subjectsRequired']->value));
$_block_repeat=true;
echo $_block_plugin13->smartyFBVFormSection(array('description'=>"submission.submit.metadataForm.tip",'label'=>"common.subjects",'required'=>$_smarty_tpl->tpl_vars['subjectsRequired']->value), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"keyword",'id'=>"subjects",'multilingual'=>true,'current'=>$_smarty_tpl->tpl_vars['subjects']->value,'disabled'=>$_smarty_tpl->tpl_vars['readOnly']->value,'required'=>$_smarty_tpl->tpl_vars['subjectsRequired']->value),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin13->smartyFBVFormSection(array('description'=>"submission.submit.metadataForm.tip",'label'=>"common.subjects",'required'=>$_smarty_tpl->tpl_vars['subjectsRequired']->value), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['disciplinesEnabled']->value) {?>
			<?php $_block_plugin14 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin14, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('description'=>"submission.submit.metadataForm.tip",'label'=>"search.discipline",'required'=>$_smarty_tpl->tpl_vars['disciplinesRequired']->value));
$_block_repeat=true;
echo $_block_plugin14->smartyFBVFormSection(array('description'=>"submission.submit.metadataForm.tip",'label'=>"search.discipline",'required'=>$_smarty_tpl->tpl_vars['disciplinesRequired']->value), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"keyword",'id'=>"disciplines",'multilingual'=>true,'current'=>$_smarty_tpl->tpl_vars['disciplines']->value,'disabled'=>$_smarty_tpl->tpl_vars['readOnly']->value,'required'=>$_smarty_tpl->tpl_vars['disciplinesRequired']->value),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin14->smartyFBVFormSection(array('description'=>"submission.submit.metadataForm.tip",'label'=>"search.discipline",'required'=>$_smarty_tpl->tpl_vars['disciplinesRequired']->value), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['keywordsEnabled']->value) {?>
			<?php $_block_plugin15 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin15, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('description'=>"submission.submit.metadataForm.tip",'label'=>"common.keywords",'required'=>$_smarty_tpl->tpl_vars['keywordsRequired']->value));
$_block_repeat=true;
echo $_block_plugin15->smartyFBVFormSection(array('description'=>"submission.submit.metadataForm.tip",'label'=>"common.keywords",'required'=>$_smarty_tpl->tpl_vars['keywordsRequired']->value), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"keyword",'id'=>"keywords",'multilingual'=>true,'current'=>$_smarty_tpl->tpl_vars['keywords']->value,'disabled'=>$_smarty_tpl->tpl_vars['readOnly']->value,'required'=>$_smarty_tpl->tpl_vars['keywordsRequired']->value),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin15->smartyFBVFormSection(array('description'=>"submission.submit.metadataForm.tip",'label'=>"common.keywords",'required'=>$_smarty_tpl->tpl_vars['keywordsRequired']->value), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['agenciesEnabled']->value) {?>
			<?php $_block_plugin16 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin16, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('description'=>"submission.submit.metadataForm.tip",'label'=>"submission.supportingAgencies",'required'=>$_smarty_tpl->tpl_vars['agenciesRequired']->value));
$_block_repeat=true;
echo $_block_plugin16->smartyFBVFormSection(array('description'=>"submission.submit.metadataForm.tip",'label'=>"submission.supportingAgencies",'required'=>$_smarty_tpl->tpl_vars['agenciesRequired']->value), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"keyword",'id'=>"agencies",'multilingual'=>true,'current'=>$_smarty_tpl->tpl_vars['agencies']->value,'disabled'=>$_smarty_tpl->tpl_vars['readOnly']->value,'required'=>$_smarty_tpl->tpl_vars['agenciesRequired']->value),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin16->smartyFBVFormSection(array('description'=>"submission.submit.metadataForm.tip",'label'=>"submission.supportingAgencies",'required'=>$_smarty_tpl->tpl_vars['agenciesRequired']->value), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['citationsEnabled']->value) {?>
			<?php $_block_plugin17 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin17, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>"submission.citations",'required'=>$_smarty_tpl->tpl_vars['citationsRequired']->value));
$_block_repeat=true;
echo $_block_plugin17->smartyFBVFormSection(array('label'=>"submission.citations",'required'=>$_smarty_tpl->tpl_vars['citationsRequired']->value), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'id'=>"citationsRaw",'value'=>$_smarty_tpl->tpl_vars['citationsRaw']->value,'multilingual'=>false,'disabled'=>$_smarty_tpl->tpl_vars['readOnly']->value,'required'=>$_smarty_tpl->tpl_vars['citationsRequired']->value),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin17->smartyFBVFormSection(array('label'=>"submission.citations",'required'=>$_smarty_tpl->tpl_vars['citationsRequired']->value), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>
	<?php $_block_repeat=false;
echo $_block_plugin12->smartyFBVFormArea(array('id'=>"tagitFields",'title'=>"submission.submit.metadataForm"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}?>

<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['call_hook'][0], array( array('name'=>"Templates::Submission::SubmissionMetadataForm::AdditionalMetadata"),$_smarty_tpl ) );?>

<?php }
}
