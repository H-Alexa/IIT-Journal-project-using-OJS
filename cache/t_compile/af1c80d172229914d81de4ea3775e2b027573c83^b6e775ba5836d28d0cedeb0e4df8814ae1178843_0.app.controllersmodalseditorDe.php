<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:12:41
  from 'app:controllersmodalseditorDe' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152b2597f1300_24063817',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b6e775ba5836d28d0cedeb0e4df8814ae1178843' => 
    array (
      0 => 'app:controllersmodalseditorDe',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152b2597f1300_24063817 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\OJS\\lib\\pkp\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

<?php echo '<script'; ?>
 type="text/javascript">
	$(function() {
		$('#recommendations').pkpHandler(
			'$.pkp.controllers.modals.editorDecision.form.EditorDecisionFormHandler'
		);
	});
<?php echo '</script'; ?>
>

<form class="pkp_form" id="recommendations" method="post" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('op'=>'saveRecommendation'),$_smarty_tpl ) );?>
" >
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

	<input type="hidden" name="submissionId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['submissionId']->value ));?>
" />
	<input type="hidden" name="stageId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['stageId']->value ));?>
" />
	<input type="hidden" name="reviewRoundId" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['reviewRoundId']->value ));?>
" />

	<?php if (!empty($_smarty_tpl->tpl_vars['editorRecommendations']->value)) {?>
		<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>"editor.submission.recordedRecommendations"));
$_block_repeat=true;
echo $_block_plugin1->smartyFBVFormSection(array('label'=>"editor.submission.recordedRecommendations"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['editorRecommendations']->value, 'editorRecommendation');
$_smarty_tpl->tpl_vars['editorRecommendation']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['editorRecommendation']->value) {
$_smarty_tpl->tpl_vars['editorRecommendation']->do_else = false;
?>
				<div>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.round",'round'=>$_smarty_tpl->tpl_vars['editorRecommendation']->value['round']),$_smarty_tpl ) );?>
 (<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['editorRecommendation']->value['dateDecided'],$_smarty_tpl->tpl_vars['datetimeFormatShort']->value);?>
): <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['recommendationOptions']->value[$_smarty_tpl->tpl_vars['editorRecommendation']->value['decision']]),$_smarty_tpl ) );?>

				</div>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php $_block_repeat=false;
echo $_block_plugin1->smartyFBVFormSection(array('label'=>"editor.submission.recordedRecommendations"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }?>

	<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('label'=>"editor.submission.recommendation",'description'=>(($tmp = @$_smarty_tpl->tpl_vars['description']->value)===null||$tmp==='' ? "editor.submission.recommendation.description" : $tmp)));
$_block_repeat=true;
echo $_block_plugin2->smartyFBVFormSection(array('label'=>"editor.submission.recommendation",'description'=>(($tmp = @$_smarty_tpl->tpl_vars['description']->value)===null||$tmp==='' ? "editor.submission.recommendation.description" : $tmp)), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"select",'id'=>"recommendation",'name'=>"recommendation",'from'=>$_smarty_tpl->tpl_vars['recommendationOptions']->value,'selected'=>$_smarty_tpl->tpl_vars['recommendation']->value,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'required'=>(($tmp = @$_smarty_tpl->tpl_vars['required']->value)===null||$tmp==='' ? true : $tmp),'disabled'=>$_smarty_tpl->tpl_vars['readOnly']->value),$_smarty_tpl ) );?>

	<?php $_block_repeat=false;
echo $_block_plugin2->smartyFBVFormSection(array('label'=>"editor.submission.recommendation",'description'=>(($tmp = @$_smarty_tpl->tpl_vars['description']->value)===null||$tmp==='' ? "editor.submission.recommendation.description" : $tmp)), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "sendEmailLabel", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"editor.submissionReview.sendEmail.editors",'editorNames'=>$_smarty_tpl->tpl_vars['editors']->value),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php if ($_smarty_tpl->tpl_vars['skipEmail']->value) {?>
		<?php $_smarty_tpl->_assignInScope('skipEmailSkip', true);?>
	<?php } else { ?>
		<?php $_smarty_tpl->_assignInScope('skipEmailSend', true);?>
	<?php }?>
	<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"editor.submissionReview.recordRecommendation.notifyEditors"));
$_block_repeat=true;
echo $_block_plugin3->smartyFBVFormSection(array('title'=>"editor.submissionReview.recordRecommendation.notifyEditors"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<ul class="checkbox_and_radiobutton">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'id'=>"skipEmail-send",'name'=>"skipEmail",'value'=>"0",'checked'=>$_smarty_tpl->tpl_vars['skipEmailSend']->value,'label'=>$_smarty_tpl->tpl_vars['sendEmailLabel']->value,'translate'=>false),$_smarty_tpl ) );?>

			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'id'=>"skipEmail-skip",'name'=>"skipEmail",'value'=>"1",'checked'=>$_smarty_tpl->tpl_vars['skipEmailSkip']->value,'label'=>"editor.submissionReview.skipEmail"),$_smarty_tpl ) );?>

		</ul>
	<?php $_block_repeat=false;
echo $_block_plugin3->smartyFBVFormSection(array('title'=>"editor.submissionReview.recordRecommendation.notifyEditors"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php if ($_smarty_tpl->tpl_vars['skipDiscussion']->value) {?>
		<?php $_smarty_tpl->_assignInScope('skipDiscussionSkip', true);?>
	<?php } else { ?>
		<?php $_smarty_tpl->_assignInScope('skipDiscussionSend', true);?>
	<?php }?>
	<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin4->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<ul class="checkbox_and_radiobutton">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'id'=>"skipDiscussion-send",'name'=>"skipDiscussion",'value'=>"0",'checked'=>$_smarty_tpl->tpl_vars['skipDiscussionSend']->value,'label'=>"editor.submissionReview.recordRecommendation.createDiscussion"),$_smarty_tpl ) );?>

			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"radio",'id'=>"skipDiscussion-skip",'name'=>"skipDiscussion",'value'=>"1",'checked'=>$_smarty_tpl->tpl_vars['skipDiscussionSkip']->value,'label'=>"editor.submissionReview.recordRecommendation.skipDiscussion"),$_smarty_tpl ) );?>

		</ul>
	<?php $_block_repeat=false;
echo $_block_plugin4->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<div id="sendReviews-emailContent" style="margin-bottom: 30px;">
		<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('for'=>"personalMessage"));
$_block_repeat=true;
echo $_block_plugin5->smartyFBVFormSection(array('for'=>"personalMessage"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'name'=>"personalMessage",'id'=>"personalMessage",'value'=>$_smarty_tpl->tpl_vars['personalMessage']->value,'rich'=>true,'variables'=>$_smarty_tpl->tpl_vars['allowedVariables']->value,'variablesType'=>$_smarty_tpl->tpl_vars['allowedVariablesType']->value),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin5->smartyFBVFormSection(array('for'=>"personalMessage"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	</div>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvFormButtons'][0], array( array('submitText'=>"editor.submissionReview.recordRecommendation"),$_smarty_tpl ) );?>

</form>
<?php }
}
