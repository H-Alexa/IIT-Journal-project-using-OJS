<?php
/* Smarty version 3.1.39, created on 2021-09-27 18:34:48
  from 'app:controllersgridfeaturefea' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151f2a89f9660_90748009',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4912f05bbf9193b6e3b34341126ecc3fbe974c23' => 
    array (
      0 => 'app:controllersgridfeaturefea',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6151f2a89f9660_90748009 (Smarty_Internal_Template $_smarty_tpl) {
?>{
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['features']->value, 'feature', false, NULL, 'features', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['feature']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['feature']->value) {
$_smarty_tpl->tpl_vars['feature']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_features']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_features']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_features']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_features']->value['total'];
?>
		<?php echo json_encode($_smarty_tpl->tpl_vars['feature']->value->getId());?>
: {
			JSClass: <?php echo json_encode($_smarty_tpl->tpl_vars['feature']->value->getJSClass());?>
,
			options: {
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['feature']->value->getOptions(), 'optionValue', false, 'optionName', 'featureOptions', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['optionValue']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['optionName']->value => $_smarty_tpl->tpl_vars['optionValue']->value) {
$_smarty_tpl->tpl_vars['optionValue']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_featureOptions']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_featureOptions']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_featureOptions']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_featureOptions']->value['total'];
?>
					<?php echo $_smarty_tpl->tpl_vars['optionName']->value;?>
: <?php if ($_smarty_tpl->tpl_vars['optionValue']->value) {?>'<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['optionValue']->value,'javascript' ));?>
'<?php } else { ?>false<?php }
if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_featureOptions']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_featureOptions']->value['last'] : null)) {?>,<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			}
		}<?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_features']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_features']->value['last'] : null)) {?>,<?php }?>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
}
<?php }
}
