<?php
/* Smarty version 3.1.39, created on 2021-09-27 18:21:19
  from 'app:frontendcomponentsregistr' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151ef7f676361_36466779',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cea4d98dd922416eabba9bb0a4e8286e214a0ca4' => 
    array (
      0 => 'app:frontendcomponentsregistr',
      1 => 1599486834,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6151ef7f676361_36466779 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\OJS\\lib\\pkp\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<fieldset class="identity">
	<legend>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.profile"),$_smarty_tpl ) );?>

	</legend>
	<div class="fields">
		<div class="form-group given_name">
			<label>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.givenName"),$_smarty_tpl ) );?>

				<span class="form-control-required">*</span>
				<span class="sr-only"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.required"),$_smarty_tpl ) );?>
</span>
				<input class="form-control" type="text" name="givenName" id="givenName" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['givenName']->value ));?>
" maxlength="255" required>
			</label>
		</div>
		<div class="form-group family_name">
			<label>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.familyName"),$_smarty_tpl ) );?>

				<span class="form-control-required">*</span>
				<span class="sr-only"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.required"),$_smarty_tpl ) );?>
</span>
				<input class="form-control" type="text" name="familyName" id="familyName" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['familyName']->value ));?>
" maxlength="255" required>
			</label>
		</div>
		<div class="form-group affiliation">
			<label>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.affiliation"),$_smarty_tpl ) );?>

				<span class="form-control-required">*</span>
				<span class="sr-only"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.required"),$_smarty_tpl ) );?>
</span>
				<input class="form-control" type="text" name="affiliation[<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['primaryLocale']->value ));?>
]" id="affiliation" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['affiliation']->value[$_smarty_tpl->tpl_vars['primaryLocale']->value] ));?>
" required>
			</label>
		</div>
		<div class="form-group country">
			<label>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.country"),$_smarty_tpl ) );?>

				<span class="form-control-required">*</span>
				<span class="sr-only"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.required"),$_smarty_tpl ) );?>
</span>
				<select class="form-control" name="country" id="country" required>
					<option></option>
					<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['countries']->value,'selected'=>$_smarty_tpl->tpl_vars['country']->value),$_smarty_tpl);?>

				</select>
			</label>
		</div>
	</div>
</fieldset>

<fieldset class="login">
	<legend>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.login"),$_smarty_tpl ) );?>

	</legend>
	<div class="fields">
		<div class="form-group email">
			<label>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.email"),$_smarty_tpl ) );?>

				<span class="form-control-required">*</span>
				<span class="sr-only"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.required"),$_smarty_tpl ) );?>
</span>
				<input class="form-control" type="email" name="email" id="email" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['email']->value ));?>
" maxlength="90" required>
			</label>
		</div>
		<div class="form-group username">
			<label>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.username"),$_smarty_tpl ) );?>

				<span class="form-control-required">*</span>
				<span class="sr-only"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.required"),$_smarty_tpl ) );?>
</span>
				<input class="form-control" type="text" name="username" id="username" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['username']->value ));?>
" maxlength="32" required>
			</label>
		</div>
		<div class="form-group password">
			<label>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.password"),$_smarty_tpl ) );?>

				<span class="form-control-required">*</span>
				<span class="sr-only"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.required"),$_smarty_tpl ) );?>
</span>
				<input class="form-control" type="password" name="password" id="password" password="true" maxlength="32" required>
			</label>
		</div>
		<div class="form-group password">
			<label>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.repeatPassword"),$_smarty_tpl ) );?>

				<span class="form-control-required">*</span>
				<span class="sr-only"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.required"),$_smarty_tpl ) );?>
</span>
				<input class="form-control" type="password" name="password2" id="password2" password="true" maxlength="32" required>
			</label>
		</div>
	</div>
</fieldset>
<?php }
}
