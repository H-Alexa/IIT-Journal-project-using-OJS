<?php
/* Smarty version 3.1.39, created on 2021-09-27 19:46:57
  from 'app:formtextarea.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61520391b88329_82923606',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd5e939b0a8cb0bc5dc34e285cf5fd069e3e44727' => 
    array (
      0 => 'app:formtextarea.tpl',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61520391b88329_82923606 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('uniqId', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "-",$_smarty_tpl->tpl_vars['FBV_uniqId']->value )) )));?>
<div<?php if ($_smarty_tpl->tpl_vars['FBV_layoutInfo']->value) {?> class="<?php echo $_smarty_tpl->tpl_vars['FBV_layoutInfo']->value;?>
"<?php }?>>
<?php if ($_smarty_tpl->tpl_vars['FBV_multilingual']->value && count($_smarty_tpl->tpl_vars['formLocales']->value) > 1) {?>
	<?php echo '<script'; ?>
>
	$(function() {
		$('#<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_name']->value,'javascript' ));?>
-localization-popover-container<?php echo $_smarty_tpl->tpl_vars['uniqId']->value;?>
').pkpHandler(
			'$.pkp.controllers.form.MultilingualInputHandler'
			);
	});
	<?php echo '</script'; ?>
>
		<span id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_name']->value ));?>
-localization-popover-container<?php echo $_smarty_tpl->tpl_vars['uniqId']->value;?>
" class="localization_popover_container">
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "localeDirection", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['locale_direction'][0], array( array('locale'=>$_smarty_tpl->tpl_vars['formLocale']->value),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?><textarea id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_id']->value ));?>
-<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['formLocale']->value ));
echo $_smarty_tpl->tpl_vars['uniqId']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['FBV_textAreaParams']->value;?>
rows="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_rows']->value ));?>
"cols="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_cols']->value ));?>
"class="localizable <?php echo $_smarty_tpl->tpl_vars['FBV_class']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['FBV_height']->value;
if ($_smarty_tpl->tpl_vars['FBV_validation']->value) {?> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_validation']->value ));
}
if ($_smarty_tpl->tpl_vars['formLocale']->value != $_smarty_tpl->tpl_vars['currentLocale']->value) {?> locale_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['formLocale']->value ));
}
if ($_smarty_tpl->tpl_vars['FBV_rich']->value && !$_smarty_tpl->tpl_vars['FBV_disabled']->value) {?> richContent<?php if ($_smarty_tpl->tpl_vars['FBV_rich']->value === "extended") {?> extendedRichContent<?php }
}?>"<?php if ($_smarty_tpl->tpl_vars['FBV_disabled']->value) {?> disabled="disabled"<?php }
if ($_smarty_tpl->tpl_vars['FBV_readonly']->value) {?> readonly="readonly"<?php }
if ($_smarty_tpl->tpl_vars['FBV_wordCount']->value) {?> wordCount="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_wordCount']->value ));?>
"<?php }
if ($_smarty_tpl->tpl_vars['FBV_variables']->value) {?> data-variables="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( json_encode($_smarty_tpl->tpl_vars['FBV_variables']->value),"url" ));?>
"<?php }
if ($_smarty_tpl->tpl_vars['FBV_variablesType']->value) {?> data-variablesType="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( json_encode($_smarty_tpl->tpl_vars['FBV_variablesType']->value),"url" ));?>
"<?php }
if ($_smarty_tpl->tpl_vars['FBV_required']->value) {?> required aria-required="true"<?php }
if ($_smarty_tpl->tpl_vars['FBV_rich']->value && $_smarty_tpl->tpl_vars['localeDirection']->value === "rtl") {?> dir="rtl"<?php }?>name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_name']->value ));?>
[<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['formLocale']->value ));?>
]"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_value']->value[$_smarty_tpl->tpl_vars['formLocale']->value] ));?>
</textarea>

		<?php echo $_smarty_tpl->tpl_vars['FBV_label_content']->value;?>


		<div class="localization_popover">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['formLocales']->value, 'thisFormLocaleName', false, 'thisFormLocale');
$_smarty_tpl->tpl_vars['thisFormLocaleName']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['thisFormLocale']->value => $_smarty_tpl->tpl_vars['thisFormLocaleName']->value) {
$_smarty_tpl->tpl_vars['thisFormLocaleName']->do_else = false;
if ($_smarty_tpl->tpl_vars['formLocale']->value != $_smarty_tpl->tpl_vars['thisFormLocale']->value) {?>
				<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "localeDirection", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['locale_direction'][0], array( array('locale'=>$_smarty_tpl->tpl_vars['thisFormLocale']->value),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?><label for="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_id']->value ));?>
-<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['thisFormLocale']->value ));
echo $_smarty_tpl->tpl_vars['uniqId']->value;?>
" class="locale_textarea"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['thisFormLocaleName']->value ));?>
</label><textarea id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_id']->value ));?>
-<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['thisFormLocale']->value ));
echo $_smarty_tpl->tpl_vars['uniqId']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['FBV_textAreaParams']->value;?>
placeholder="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['thisFormLocaleName']->value ));?>
"class="flag flag_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['thisFormLocale']->value ));?>
 <?php echo $_smarty_tpl->tpl_vars['FBV_class']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['FBV_height']->value;
if ($_smarty_tpl->tpl_vars['FBV_rich']->value && !$_smarty_tpl->tpl_vars['FBV_disabled']->value) {?> richContent<?php if ($_smarty_tpl->tpl_vars['FBV_rich']->value === "extended") {?> extendedRichContent<?php }
}?>"<?php if ($_smarty_tpl->tpl_vars['FBV_disabled']->value) {?> disabled="disabled"<?php }
if ($_smarty_tpl->tpl_vars['FBV_readonly']->value) {?> readonly="readonly"<?php }
if ($_smarty_tpl->tpl_vars['FBV_wordCount']->value) {?> wordCount="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_wordCount']->value ));?>
"<?php }
if ($_smarty_tpl->tpl_vars['FBV_variables']->value) {?> data-variables="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( json_encode($_smarty_tpl->tpl_vars['FBV_variables']->value),"url" ));?>
"<?php }
if ($_smarty_tpl->tpl_vars['FBV_variablesType']->value) {?> data-variablesType="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( json_encode($_smarty_tpl->tpl_vars['FBV_variablesType']->value),"url" ));?>
"<?php }
if ($_smarty_tpl->tpl_vars['FBV_required']->value) {?> required aria-required="true"<?php }
if ($_smarty_tpl->tpl_vars['FBV_rich']->value && $_smarty_tpl->tpl_vars['localeDirection']->value === "rtl") {?> dir="rtl"<?php }?>name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_name']->value ));?>
[<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['thisFormLocale']->value ));?>
]"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_value']->value[$_smarty_tpl->tpl_vars['thisFormLocale']->value] ));?>
</textarea>
			<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div>
	</span>
<?php } else { ?>
		<?php if ($_smarty_tpl->tpl_vars['FBV_rich']->value && $_smarty_tpl->tpl_vars['FBV_disabled']->value) {?>
		<?php if ($_smarty_tpl->tpl_vars['FBV_multilingual']->value) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_value']->value[$_smarty_tpl->tpl_vars['formLocale']->value] ));
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_value']->value ));
}?>
	<?php } else { ?>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "localeDirection", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['locale_direction'][0], array( array('locale'=>$_smarty_tpl->tpl_vars['formLocale']->value),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<textarea <?php echo $_smarty_tpl->tpl_vars['FBV_textAreaParams']->value;?>

			class="<?php echo $_smarty_tpl->tpl_vars['FBV_class']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['FBV_height']->value;
if ($_smarty_tpl->tpl_vars['FBV_validation']->value) {?> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_validation']->value ));
}
if ($_smarty_tpl->tpl_vars['FBV_rich']->value && !$_smarty_tpl->tpl_vars['FBV_disabled']->value) {?> richContent<?php if ($_smarty_tpl->tpl_vars['FBV_rich']->value === "extended") {?> extendedRichContent<?php }
}?>"
			<?php if ($_smarty_tpl->tpl_vars['FBV_disabled']->value) {?> disabled="disabled"<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['FBV_readonly']->value) {?> readonly="readonly"<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['FBV_wordCount']->value) {?> wordCount="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_wordCount']->value ));?>
"<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['FBV_variables']->value) {?> data-variables="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( json_encode($_smarty_tpl->tpl_vars['FBV_variables']->value),"url" ));?>
"<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['FBV_variablesType']->value) {?> data-variablesType="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( json_encode($_smarty_tpl->tpl_vars['FBV_variablesType']->value),"url" ));?>
"<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['FBV_required']->value) {?> required aria-required="true"<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['FBV_rich']->value && $_smarty_tpl->tpl_vars['localeDirection']->value === "rtl") {?> dir="rtl"<?php }?>
			name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_name']->value ));
if ($_smarty_tpl->tpl_vars['FBV_multilingual']->value) {?>[<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['formLocale']->value ));?>
]<?php }?>"
			rows="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_rows']->value ));?>
"
			cols="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_cols']->value ));?>
"
			id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_id']->value ));
echo $_smarty_tpl->tpl_vars['uniqId']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['FBV_multilingual']->value) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_value']->value[$_smarty_tpl->tpl_vars['formLocale']->value] ));
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['FBV_value']->value ));
}?></textarea>
	<?php }?>
		<span><?php echo $_smarty_tpl->tpl_vars['FBV_label_content']->value;?>
</span>
<?php }?>
</div>
<?php }
}
