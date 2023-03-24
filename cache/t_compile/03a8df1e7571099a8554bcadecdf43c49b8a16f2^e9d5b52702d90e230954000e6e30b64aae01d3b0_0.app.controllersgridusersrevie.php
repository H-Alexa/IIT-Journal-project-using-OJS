<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:55:20
  from 'app:controllersgridusersrevie' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152ae48d692e6_86030511',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9d5b52702d90e230954000e6e30b64aae01d3b0' => 
    array (
      0 => 'app:controllersgridusersrevie',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/grid/users/reviewer/form/noFilesWarning.tpl' => 1,
    'app:controllers/extrasOnDemand.tpl' => 1,
  ),
),false)) {
function content_6152ae48d692e6_86030511 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="reviewerFormFooter" class="reviewerFormFooterContainer">
	<!--  message template choice -->
	<?php if (count($_smarty_tpl->tpl_vars['templates']->value) == 1) {?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['templates']->value, 'template', false, 'templateKey');
$_smarty_tpl->tpl_vars['template']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['templateKey']->value => $_smarty_tpl->tpl_vars['template']->value) {
$_smarty_tpl->tpl_vars['template']->do_else = false;
?>
			<input type="hidden" name="template" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['templateKey']->value ));?>
"/>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<?php } else { ?>
		<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"stageParticipants.notify.chooseMessage",'for'=>"template",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['medium']));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"stageParticipants.notify.chooseMessage",'for'=>"template",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['medium']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"select",'from'=>$_smarty_tpl->tpl_vars['templates']->value,'translate'=>false,'id'=>"template"),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array('title'=>"stageParticipants.notify.chooseMessage",'for'=>"template",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['medium']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }?>

	<!--  Message to reviewer textarea -->
	<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"editor.review.personalMessageToReviewer",'for'=>"personalMessage"));
$_block_repeat=true;
echo $_block_plugin3->smartyFBVFormSection(array('title'=>"editor.review.personalMessageToReviewer",'for'=>"personalMessage"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'name'=>"personalMessage",'id'=>"personalMessage",'value'=>$_smarty_tpl->tpl_vars['personalMessage']->value,'variables'=>$_smarty_tpl->tpl_vars['emailVariables']->value,'rich'=>true,'rows'=>25),$_smarty_tpl ) );?>

	<?php $_block_repeat=false;
echo $_block_plugin3->smartyFBVFormSection(array('title'=>"editor.review.personalMessageToReviewer",'for'=>"personalMessage"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<!-- skip email checkbox -->
	<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('for'=>"skipEmail",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'list'=>true));
$_block_repeat=true;
echo $_block_plugin4->smartyFBVFormSection(array('for'=>"skipEmail",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'list'=>true), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'id'=>"skipEmail",'name'=>"skipEmail",'label'=>"editor.review.skipEmail"),$_smarty_tpl ) );?>

	<?php $_block_repeat=false;
echo $_block_plugin4->smartyFBVFormSection(array('for'=>"skipEmail",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'list'=>true), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"editor.review.importantDates"));
$_block_repeat=true;
echo $_block_plugin5->smartyFBVFormSection(array('title'=>"editor.review.importantDates"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'id'=>"responseDueDate",'name'=>"responseDueDate",'label'=>"submission.task.responseDueDate",'value'=>$_smarty_tpl->tpl_vars['responseDueDate']->value,'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'class'=>"datepicker"),$_smarty_tpl ) );?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'id'=>"reviewDueDate",'name'=>"reviewDueDate",'label'=>"editor.review.reviewDueDate",'value'=>$_smarty_tpl->tpl_vars['reviewDueDate']->value,'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'class'=>"datepicker"),$_smarty_tpl ) );?>

	<?php $_block_repeat=false;
echo $_block_plugin5->smartyFBVFormSection(array('title'=>"editor.review.importantDates"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php $_smarty_tpl->_subTemplateRender("app:controllers/grid/users/reviewer/form/noFilesWarning.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "extraContent", null);?>
		<!-- Available review files -->
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'limitReviewFilesGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_COMPONENT') ? constant('ROUTE_COMPONENT') : null),'component'=>"grid.files.review.LimitReviewFilesGridHandler",'op'=>"fetchGrid",'submissionId'=>$_smarty_tpl->tpl_vars['submissionId']->value,'stageId'=>$_smarty_tpl->tpl_vars['stageId']->value,'reviewRoundId'=>$_smarty_tpl->tpl_vars['reviewRoundId']->value,'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"limitReviewFilesGrid",'url'=>$_smarty_tpl->tpl_vars['limitReviewFilesGridUrl']->value),$_smarty_tpl ) );?>

	<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<div id="filesAccordian" class="section">
		<?php $_smarty_tpl->_subTemplateRender("app:controllers/extrasOnDemand.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('id'=>"filesAccordianController",'widgetWrapper'=>"#filesAccordian",'moreDetailsText'=>"editor.submissionReview.restrictFiles",'lessDetailsText'=>"editor.submissionReview.restrictFiles.hide",'extraContent'=>$_smarty_tpl->tpl_vars['extraContent']->value), 0, false);
?>
	</div>

	<?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('list'=>true,'title'=>"editor.submissionReview.reviewType"));
$_block_repeat=true;
echo $_block_plugin6->smartyFBVFormSection(array('list'=>true,'title'=>"editor.submissionReview.reviewType"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reviewMethods']->value, 'methodTranslationKey', false, 'methodId');
$_smarty_tpl->tpl_vars['methodTranslationKey']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['methodId']->value => $_smarty_tpl->tpl_vars['methodTranslationKey']->value) {
$_smarty_tpl->tpl_vars['methodTranslationKey']->do_else = false;
?>
			<?php $_smarty_tpl->_assignInScope('elementId', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "reviewMethod","-" )),$_smarty_tpl->tpl_vars['methodId']->value )));?>
			<?php if ($_smarty_tpl->tpl_vars['reviewMethod']->value == $_smarty_tpl->tpl_vars['methodId']->value) {?>
				<?php $_smarty_tpl->_assignInScope('elementChecked', true);?>
			<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('elementChecked', false);?>
			<?php }?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'name'=>"reviewMethod",'id'=>$_smarty_tpl->tpl_vars['elementId']->value,'value'=>$_smarty_tpl->tpl_vars['methodId']->value,'checked'=>$_smarty_tpl->tpl_vars['elementChecked']->value,'label'=>$_smarty_tpl->tpl_vars['methodTranslationKey']->value),$_smarty_tpl ) );?>

		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<?php $_block_repeat=false;
echo $_block_plugin6->smartyFBVFormSection(array('list'=>true,'title'=>"editor.submissionReview.reviewType"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php if (count($_smarty_tpl->tpl_vars['reviewForms']->value) > 0) {?>
		<?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"submission.reviewForm"));
$_block_repeat=true;
echo $_block_plugin7->smartyFBVFormSection(array('title'=>"submission.reviewForm"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"select",'name'=>"reviewFormId",'id'=>"reviewFormId",'defaultLabel'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'translate' ][ 0 ], array( "manager.reviewForms.noneChosen" )),'defaultValue'=>"0",'translate'=>false,'from'=>$_smarty_tpl->tpl_vars['reviewForms']->value,'selected'=>$_smarty_tpl->tpl_vars['reviewFormId']->value),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin7->smartyFBVFormSection(array('title'=>"submission.reviewForm"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }?>

	<!-- All of the hidden inputs -->
	<input type="hidden" name="selectionType" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['selectionType']->value ));?>
" />
	<input type="hidden" name="submissionId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['submissionId']->value ));?>
" />
	<input type="hidden" name="stageId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['stageId']->value ));?>
" />
	<input type="hidden" name="reviewRoundId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['reviewRoundId']->value ));?>
" />
</div>
<?php }
}
