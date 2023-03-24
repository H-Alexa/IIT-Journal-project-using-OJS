<?php
/* Smarty version 3.1.39, created on 2021-09-27 20:01:13
  from 'app:commonuserDetails.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_615206e9b57fe9_03492571',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e565cf5500e8246b7982cbf0654d2bdb3bbd22b6' => 
    array (
      0 => 'app:commonuserDetails.tpl',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/extrasOnDemand.tpl' => 1,
  ),
),false)) {
function content_615206e9b57fe9_03492571 (Smarty_Internal_Template $_smarty_tpl) {
$_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"userDetails"));
$_block_repeat=true;
echo $_block_plugin5->smartyFBVFormArea(array('id'=>"userDetails"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"user.name"));
$_block_repeat=true;
echo $_block_plugin6->smartyFBVFormSection(array('title'=>"user.name"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'label'=>"user.givenName",'multilingual'=>"true",'name'=>"givenName",'id'=>"givenName",'value'=>$_smarty_tpl->tpl_vars['givenName']->value,'maxlength'=>"255",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM'],'required'=>"true"),$_smarty_tpl ) );?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'label'=>"user.familyName",'multilingual'=>"true",'name'=>"familyName",'id'=>"familyName",'value'=>$_smarty_tpl->tpl_vars['familyName']->value,'maxlength'=>"255",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']),$_smarty_tpl ) );?>

	<?php $_block_repeat=false;
echo $_block_plugin6->smartyFBVFormSection(array('title'=>"user.name"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('for'=>"preferredPublicName",'description'=>"user.preferredPublicName.description"));
$_block_repeat=true;
echo $_block_plugin7->smartyFBVFormSection(array('for'=>"preferredPublicName",'description'=>"user.preferredPublicName.description"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'label'=>"user.preferredPublicName",'multilingual'=>"true",'name'=>"preferredPublicName",'id'=>"preferredPublicName",'value'=>$_smarty_tpl->tpl_vars['preferredPublicName']->value,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['LARGE']),$_smarty_tpl ) );?>

	<?php $_block_repeat=false;
echo $_block_plugin7->smartyFBVFormSection(array('for'=>"preferredPublicName",'description'=>"user.preferredPublicName.description"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php if (!$_smarty_tpl->tpl_vars['disableUserNameSection']->value) {?>
		<?php if (!$_smarty_tpl->tpl_vars['userId']->value) {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "usernameInstruction", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.register.usernameRestriction"),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
}?>
		<?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('for'=>"username",'description'=>$_smarty_tpl->tpl_vars['usernameInstruction']->value,'translate'=>false));
$_block_repeat=true;
echo $_block_plugin8->smartyFBVFormSection(array('for'=>"username",'description'=>$_smarty_tpl->tpl_vars['usernameInstruction']->value,'translate'=>false), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php if (!$_smarty_tpl->tpl_vars['userId']->value) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'label'=>"user.username",'id'=>"username",'required'=>"true",'value'=>$_smarty_tpl->tpl_vars['username']->value,'maxlength'=>"32",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']),$_smarty_tpl ) );?>

				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"button",'label'=>"common.suggest",'id'=>"suggestUsernameButton",'inline'=>true,'class'=>"default"),$_smarty_tpl ) );?>

			<?php } else { ?>
				<?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"user.username",'suppressId'=>"true"));
$_block_repeat=true;
echo $_block_plugin9->smartyFBVFormSection(array('title'=>"user.username",'suppressId'=>"true"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['username']->value ));?>

				<?php $_block_repeat=false;
echo $_block_plugin9->smartyFBVFormSection(array('title'=>"user.username",'suppressId'=>"true"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php }?>
		<?php $_block_repeat=false;
echo $_block_plugin8->smartyFBVFormSection(array('for'=>"username",'description'=>$_smarty_tpl->tpl_vars['usernameInstruction']->value,'translate'=>false), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }?>

	<?php if (!$_smarty_tpl->tpl_vars['disableEmailSection']->value) {?>
		<?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"about.contact"));
$_block_repeat=true;
echo $_block_plugin10->smartyFBVFormSection(array('title'=>"about.contact"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"email",'label'=>"user.email",'id'=>"email",'required'=>"true",'value'=>$_smarty_tpl->tpl_vars['email']->value,'maxlength'=>"90",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin10->smartyFBVFormSection(array('title'=>"about.contact"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }?>

	<?php if (!$_smarty_tpl->tpl_vars['disableAuthSourceSection']->value) {?>
		<?php $_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin11, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"grid.user.authSource",'for'=>"authId"));
$_block_repeat=true;
echo $_block_plugin11->smartyFBVFormSection(array('title'=>"grid.user.authSource",'for'=>"authId"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"select",'name'=>"authId",'id'=>"authId",'defaultLabel'=>'','defaultValue'=>'','from'=>$_smarty_tpl->tpl_vars['authSourceOptions']->value,'translate'=>"true",'selected'=>$_smarty_tpl->tpl_vars['authId']->value),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin11->smartyFBVFormSection(array('title'=>"grid.user.authSource",'for'=>"authId"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }?>

	<?php if (!$_smarty_tpl->tpl_vars['disablePasswordSection']->value) {?>
		<?php if ($_smarty_tpl->tpl_vars['userId']->value) {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "passwordInstruction", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.profile.leavePasswordBlank"),$_smarty_tpl ) );?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.register.form.passwordLengthRestriction",'length'=>$_smarty_tpl->tpl_vars['minPasswordLength']->value),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
}?>
		<?php $_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin12, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"passwordSection",'title'=>"user.password"));
$_block_repeat=true;
echo $_block_plugin12->smartyFBVFormArea(array('id'=>"passwordSection",'title'=>"user.password"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php $_block_plugin13 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin13, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('for'=>"password",'description'=>$_smarty_tpl->tpl_vars['passwordInstruction']->value,'translate'=>false));
$_block_repeat=true;
echo $_block_plugin13->smartyFBVFormSection(array('for'=>"password",'description'=>$_smarty_tpl->tpl_vars['passwordInstruction']->value,'translate'=>false), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'label'=>"user.password",'required'=>$_smarty_tpl->tpl_vars['passwordRequired']->value,'name'=>"password",'id'=>"password",'password'=>"true",'value'=>$_smarty_tpl->tpl_vars['password']->value,'maxlength'=>"32",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']),$_smarty_tpl ) );?>

				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'label'=>"user.repeatPassword",'required'=>$_smarty_tpl->tpl_vars['passwordRequired']->value,'name'=>"password2",'id'=>"password2",'password'=>"true",'value'=>$_smarty_tpl->tpl_vars['password2']->value,'maxlength'=>"32",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin13->smartyFBVFormSection(array('for'=>"password",'description'=>$_smarty_tpl->tpl_vars['passwordInstruction']->value,'translate'=>false), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

			<?php if (!$_smarty_tpl->tpl_vars['userId']->value) {?>
				<?php $_block_plugin14 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin14, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"grid.user.generatePassword",'for'=>"generatePassword",'list'=>true));
$_block_repeat=true;
echo $_block_plugin14->smartyFBVFormSection(array('title'=>"grid.user.generatePassword",'for'=>"generatePassword",'list'=>true), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
					<?php if ($_smarty_tpl->tpl_vars['generatePassword']->value) {?>
						<?php $_smarty_tpl->_assignInScope('checked', true);?>
					<?php } else { ?>
						<?php $_smarty_tpl->_assignInScope('checked', false);?>
					<?php }?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'name'=>"generatePassword",'id'=>"generatePassword",'checked'=>$_smarty_tpl->tpl_vars['checked']->value,'label'=>"grid.user.generatePasswordDescription",'translate'=>"true"),$_smarty_tpl ) );?>

				<?php $_block_repeat=false;
echo $_block_plugin14->smartyFBVFormSection(array('title'=>"grid.user.generatePassword",'for'=>"generatePassword",'list'=>true), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php }?>
			<?php $_block_plugin15 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin15, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"grid.user.mustChangePassword",'for'=>"mustChangePassword",'list'=>true));
$_block_repeat=true;
echo $_block_plugin15->smartyFBVFormSection(array('title'=>"grid.user.mustChangePassword",'for'=>"mustChangePassword",'list'=>true), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php if ($_smarty_tpl->tpl_vars['mustChangePassword']->value) {?>
					<?php $_smarty_tpl->_assignInScope('checked', true);?>
				<?php } else { ?>
					<?php $_smarty_tpl->_assignInScope('checked', false);?>
				<?php }?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'name'=>"mustChangePassword",'id'=>"mustChangePassword",'checked'=>$_smarty_tpl->tpl_vars['checked']->value,'label'=>"grid.user.mustChangePasswordDescription",'translate'=>"true"),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin15->smartyFBVFormSection(array('title'=>"grid.user.mustChangePassword",'for'=>"mustChangePassword",'list'=>true), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_repeat=false;
echo $_block_plugin12->smartyFBVFormArea(array('id'=>"passwordSection",'title'=>"user.password"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['countryRequired']->value) {?>
		<?php $_smarty_tpl->_assignInScope('countryRequired', true);?>
	<?php } else { ?>
		<?php $_smarty_tpl->_assignInScope('countryRequired', false);?>
	<?php }?>
	<?php $_block_plugin16 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin16, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('for'=>"country",'title'=>"common.country"));
$_block_repeat=true;
echo $_block_plugin16->smartyFBVFormSection(array('for'=>"country",'title'=>"common.country"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"select",'label'=>"common.country",'name'=>"country",'id'=>"country",'required'=>$_smarty_tpl->tpl_vars['countryRequired']->value,'defaultLabel'=>'','defaultValue'=>'','from'=>$_smarty_tpl->tpl_vars['countries']->value,'selected'=>$_smarty_tpl->tpl_vars['country']->value,'translate'=>"0",'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['MEDIUM']),$_smarty_tpl ) );?>

	<?php $_block_repeat=false;
echo $_block_plugin16->smartyFBVFormSection(array('for'=>"country",'title'=>"common.country"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php if (!$_smarty_tpl->tpl_vars['disableSendNotifySection']->value) {?>
		<?php $_block_plugin17 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin17, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"grid.user.notifyUser",'for'=>"sendNotify",'list'=>true));
$_block_repeat=true;
echo $_block_plugin17->smartyFBVFormSection(array('title'=>"grid.user.notifyUser",'for'=>"sendNotify",'list'=>true), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php if ($_smarty_tpl->tpl_vars['sendNotify']->value) {?>
				<?php $_smarty_tpl->_assignInScope('checked', true);?>
			<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('checked', false);?>
			<?php }?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'name'=>"sendNotify",'id'=>"sendNotify",'checked'=>$_smarty_tpl->tpl_vars['checked']->value,'label'=>"grid.user.notifyUserDescription",'translate'=>"true"),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin17->smartyFBVFormSection(array('title'=>"grid.user.notifyUser",'for'=>"sendNotify",'list'=>true), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }
$_block_repeat=false;
echo $_block_plugin5->smartyFBVFormArea(array('id'=>"userDetails"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['call_hook'][0], array( array('name'=>"Common::UserDetails::AdditionalItems"),$_smarty_tpl ) );?>

<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "extraContent", null);?>
	<?php $_block_plugin18 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormArea'][0][0] : null;
if (!is_callable(array($_block_plugin18, 'smartyFBVFormArea'))) {
throw new SmartyException('block tag \'fbvFormArea\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormArea', array('id'=>"userFormExtendedLeft"));
$_block_repeat=true;
echo $_block_plugin18->smartyFBVFormArea(array('id'=>"userFormExtendedLeft"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php $_block_plugin19 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin19, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin19->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'label'=>"user.url",'name'=>"userUrl",'id'=>"userUrl",'value'=>$_smarty_tpl->tpl_vars['userUrl']->value,'maxlength'=>"255",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['SMALL']),$_smarty_tpl ) );?>

			<?php if (!$_smarty_tpl->tpl_vars['disablePhoneSection']->value) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"tel",'label'=>"user.phone",'name'=>"phone",'id'=>"phone",'value'=>$_smarty_tpl->tpl_vars['phone']->value,'maxlength'=>"24",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['SMALL']),$_smarty_tpl ) );?>

			<?php }?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'label'=>"user.orcid",'name'=>"orcid",'id'=>"orcid",'value'=>$_smarty_tpl->tpl_vars['orcid']->value,'maxlength'=>"37",'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['SMALL']),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin19->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

		<?php if (!$_smarty_tpl->tpl_vars['disableLocaleSection']->value && count($_smarty_tpl->tpl_vars['availableLocales']->value) > 1) {?>
			<?php $_block_plugin20 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin20, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"user.workingLanguages",'list'=>true));
$_block_repeat=true;
echo $_block_plugin20->smartyFBVFormSection(array('title'=>"user.workingLanguages",'list'=>true), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['availableLocales']->value, 'localeName', false, 'localeKey');
$_smarty_tpl->tpl_vars['localeName']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['localeKey']->value => $_smarty_tpl->tpl_vars['localeName']->value) {
$_smarty_tpl->tpl_vars['localeName']->do_else = false;
?>
					<?php if ($_smarty_tpl->tpl_vars['userLocales']->value && in_array($_smarty_tpl->tpl_vars['localeKey']->value,$_smarty_tpl->tpl_vars['userLocales']->value)) {?>
						<?php $_smarty_tpl->_assignInScope('checked', true);?>
					<?php } else { ?>
						<?php $_smarty_tpl->_assignInScope('checked', false);?>
					<?php }?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"checkbox",'name'=>"userLocales[]",'id'=>"userLocales-".((string)$_smarty_tpl->tpl_vars['localeKey']->value),'value'=>$_smarty_tpl->tpl_vars['localeKey']->value,'checked'=>$_smarty_tpl->tpl_vars['checked']->value,'label'=>$_smarty_tpl->tpl_vars['localeName']->value,'translate'=>false),$_smarty_tpl ) );?>

				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php $_block_repeat=false;
echo $_block_plugin20->smartyFBVFormSection(array('title'=>"user.workingLanguages",'list'=>true), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>

		<?php if (!$_smarty_tpl->tpl_vars['disableInterestsSection']->value) {?>
			<?php $_block_plugin21 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin21, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('for'=>"interests"));
$_block_repeat=true;
echo $_block_plugin21->smartyFBVFormSection(array('for'=>"interests"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"interests",'id'=>"interests",'interests'=>$_smarty_tpl->tpl_vars['interests']->value,'label'=>"user.interests"),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin21->smartyFBVFormSection(array('for'=>"interests"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>

		<?php $_block_plugin22 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin22, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('for'=>"affiliation"));
$_block_repeat=true;
echo $_block_plugin22->smartyFBVFormSection(array('for'=>"affiliation"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'label'=>"user.affiliation",'multilingual'=>"true",'name'=>"affiliation",'id'=>"affiliation",'value'=>$_smarty_tpl->tpl_vars['affiliation']->value,'inline'=>true,'size'=>$_smarty_tpl->tpl_vars['fbvStyles']->value['size']['LARGE']),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin22->smartyFBVFormSection(array('for'=>"affiliation"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

		<?php $_block_plugin23 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin23, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin23->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'label'=>"user.biography",'multilingual'=>"true",'name'=>"biography",'id'=>"biography",'rich'=>true,'value'=>$_smarty_tpl->tpl_vars['biography']->value),$_smarty_tpl ) );?>

		<?php $_block_repeat=false;
echo $_block_plugin23->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

		<?php if (!$_smarty_tpl->tpl_vars['disableMailingSection']->value) {?>
			<?php $_block_plugin24 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin24, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin24->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'label'=>"common.mailingAddress",'name'=>"mailingAddress",'id'=>"mailingAddress",'rich'=>true,'value'=>$_smarty_tpl->tpl_vars['mailingAddress']->value),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin24->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>

		<?php if (!$_smarty_tpl->tpl_vars['disableSignatureSection']->value) {?>
			<?php $_block_plugin25 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin25, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin25->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"textarea",'label'=>"user.signature",'multilingual'=>"true",'name'=>"signature",'id'=>"signature",'value'=>$_smarty_tpl->tpl_vars['signature']->value,'rich'=>true),$_smarty_tpl ) );?>

			<?php $_block_repeat=false;
echo $_block_plugin25->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>
	<?php $_block_repeat=false;
echo $_block_plugin18->smartyFBVFormArea(array('id'=>"userFormExtendedLeft"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

<?php $_block_plugin26 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin26, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array());
$_block_repeat=true;
echo $_block_plugin26->smartyFBVFormSection(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php if ($_smarty_tpl->tpl_vars['extraContentSectionUnfolded']->value) {?>
		<?php $_block_plugin27 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin27, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('title'=>"grid.user.userDetails"));
$_block_repeat=true;
echo $_block_plugin27->smartyFBVFormSection(array('title'=>"grid.user.userDetails"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
			<?php echo $_smarty_tpl->tpl_vars['extraContent']->value;?>

		<?php $_block_repeat=false;
echo $_block_plugin27->smartyFBVFormSection(array('title'=>"grid.user.userDetails"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php } else { ?>
		<div id="userExtraFormFields" class="left full">
			<?php $_smarty_tpl->_subTemplateRender("app:controllers/extrasOnDemand.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('id'=>"userExtras",'widgetWrapper'=>"#userExtraFormFields",'moreDetailsText'=>"grid.user.moreDetails",'lessDetailsText'=>"grid.user.lessDetails",'extraContent'=>$_smarty_tpl->tpl_vars['extraContent']->value), 0, false);
?>
		</div>
	<?php }
$_block_repeat=false;
echo $_block_plugin26->smartyFBVFormSection(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
