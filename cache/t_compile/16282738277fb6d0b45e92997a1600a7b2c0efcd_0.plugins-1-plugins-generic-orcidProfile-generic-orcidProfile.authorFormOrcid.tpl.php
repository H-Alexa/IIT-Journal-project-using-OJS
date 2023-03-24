<?php
/* Smarty version 3.1.39, created on 2021-09-27 20:01:13
  from 'plugins-1-plugins-generic-orcidProfile-generic-orcidProfile:authorFormOrcid.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_615206e9d2d2c7_97993503',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '16282738277fb6d0b45e92997a1600a7b2c0efcd' => 
    array (
      0 => 'plugins-1-plugins-generic-orcidProfile-generic-orcidProfile:authorFormOrcid.tpl',
      1 => 1624492184,
      2 => 'plugins-1-plugins-generic-orcidProfile-generic-orcidProfile',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_615206e9d2d2c7_97993503 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\OJS\\lib\\pkp\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
$_block_plugin28 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin28, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('list'=>"true",'title'=>"ORCID",'translate'=>false));
$_block_repeat=true;
echo $_block_plugin28->smartyFBVFormSection(array('list'=>"true",'title'=>"ORCID",'translate'=>false), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php if ($_smarty_tpl->tpl_vars['orcidAccessToken']->value) {?>
		<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>'plugins.generic.orcidProfile.author.accessTokenStored','orcidAccessScope'=>$_smarty_tpl->tpl_vars['orcidAccessScope']->value),$_smarty_tpl ) );?>
 <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['orcidAccessExpiresOn']->value,$_smarty_tpl->tpl_vars['datetimeFormatShort']->value);?>
</p>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['orcidAccessDenied']->value) {?>
		<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>'plugins.generic.orcidProfile.author.accessDenied'),$_smarty_tpl ) );?>
 <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['orcidAccessDenied']->value,$_smarty_tpl->tpl_vars['datetimeFormatShort']->value);?>
</p>
	<?php }?>
	<?php if (!$_smarty_tpl->tpl_vars['orcidAuthenticated']->value) {?>
		<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>'plugins.generic.orcidProfile.author.unauthenticated'),$_smarty_tpl ) );?>
</p>
	<?php }?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'label'=>"plugins.generic.orcidProfile.author.requestAuthorization",'id'=>"requestOrcidAuthorization",'checked'=>false),$_smarty_tpl ) );?>

	<?php if ($_smarty_tpl->tpl_vars['orcid']->value) {?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'label'=>"plugins.generic.orcidProfile.author.deleteORCID",'id'=>"deleteOrcid",'checked'=>false),$_smarty_tpl ) );?>

	<?php } else { ?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'label'=>"plugins.generic.orcidProfile.author.deleteORCID",'id'=>"deleteOrcid",'checked'=>false,'disabled'=>true),$_smarty_tpl ) );?>

	<?php }
$_block_repeat=false;
echo $_block_plugin28->smartyFBVFormSection(array('list'=>"true",'title'=>"ORCID",'translate'=>false), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function() {
		var orcidInput = $('input[name=orcid]');
		orcidInput.attr('type', 'hidden');
		// make the container div use the whole available space
		orcidInput.parent().removeClass('pkp_helpers_quarter');
		<?php if ($_smarty_tpl->tpl_vars['orcid']->value) {?>
				<?php if ($_smarty_tpl->tpl_vars['orcidAuthenticated']->value) {?>
		var orcidIconSvg = <?php echo json_encode($_smarty_tpl->tpl_vars['orcidIcon']->value);?>

		<?php } else { ?>
		var orcidIconSvg = '';
		<?php }?>
		var orcidLink = $('<a href="<?php echo $_smarty_tpl->tpl_vars['orcid']->value;?>
" target="_blank">' + orcidIconSvg + '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['orcid']->value ));?>
</a>');
		orcidLink.insertAfter(orcidInput);
		<?php } else { ?>
		$('<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>'plugins.generic.orcidProfile.author.orcidEmptyNotice'),$_smarty_tpl ) );?>
</span>').insertAfter(orcidInput);
		<?php }?>
	});
<?php echo '</script'; ?>
>
<?php }
}
