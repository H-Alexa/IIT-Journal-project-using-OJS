<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:22:22
  from 'app:controllersnotificationno' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152b49ed62994_40350298',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cfd20313d2dd5e8340329d3788780cfe42673a89' => 
    array (
      0 => 'app:controllersnotificationno',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152b49ed62994_40350298 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['refreshOn']->value) {?>
	refreshOn: <?php echo json_encode($_smarty_tpl->tpl_vars['refreshOn']->value);?>
,
<?php }?>
fetchNotificationUrl: <?php echo json_encode(call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_PAGE') ? constant('ROUTE_PAGE') : null),'page'=>'notification','op'=>'fetchNotification','escape'=>false),$_smarty_tpl ) ));?>
,
hasSystemNotifications: <?php echo json_encode($_smarty_tpl->tpl_vars['hasSystemNotifications']->value);?>

<?php if ($_smarty_tpl->tpl_vars['requestOptions']->value) {?>
	,
	requestOptions: {
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['requestOptions']->value, 'levelOptions', false, 'level', 'levels', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['levelOptions']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['level']->value => $_smarty_tpl->tpl_vars['levelOptions']->value) {
$_smarty_tpl->tpl_vars['levelOptions']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_levels']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_levels']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_levels']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_levels']->value['total'];
?>
			<?php echo json_encode($_smarty_tpl->tpl_vars['level']->value);?>
: <?php if ($_smarty_tpl->tpl_vars['levelOptions']->value) {?> {
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['levelOptions']->value, 'typeOptions', false, 'type', 'types', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['typeOptions']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['type']->value => $_smarty_tpl->tpl_vars['typeOptions']->value) {
$_smarty_tpl->tpl_vars['typeOptions']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_types']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_types']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_types']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_types']->value['total'];
?>
					<?php echo json_encode($_smarty_tpl->tpl_vars['type']->value);?>
: <?php if ($_smarty_tpl->tpl_vars['typeOptions']->value) {?> {
						assocType: <?php echo json_encode($_smarty_tpl->tpl_vars['typeOptions']->value[0]);?>
,
						assocId: <?php echo json_encode($_smarty_tpl->tpl_vars['typeOptions']->value[1]);?>

					}<?php } else { ?>0<?php }
if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_types']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_types']->value['last'] : null)) {?>,<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			}<?php } else { ?>0<?php }
if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_levels']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_levels']->value['last'] : null)) {?>,<?php }?>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	}
<?php }
}
}
