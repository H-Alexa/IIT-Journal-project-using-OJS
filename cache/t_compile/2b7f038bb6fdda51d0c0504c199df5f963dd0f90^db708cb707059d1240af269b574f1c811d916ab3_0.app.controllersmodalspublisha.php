<?php
/* Smarty version 3.1.39, created on 2021-09-28 08:22:55
  from 'app:controllersmodalspublisha' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152b4bf5c2840_83704270',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db708cb707059d1240af269b574f1c811d916ab3' => 
    array (
      0 => 'app:controllersmodalspublisha',
      1 => 1624492110,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152b4bf5c2840_83704270 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php $_smarty_tpl->_assignInScope('uuid', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( uniqid('') )));?>
<div id="assign-<?php echo $_smarty_tpl->tpl_vars['uuid']->value;?>
" class="pkpWorkflow__publishModal">
	<pkp-form v-bind="components.<?php echo (defined('FORM_ASSIGN_TO_ISSUE') ? constant('FORM_ASSIGN_TO_ISSUE') : null);?>
" @set="set" />
	<?php echo '<script'; ?>
 type="text/javascript">
		pkp.registry.init('assign-<?php echo $_smarty_tpl->tpl_vars['uuid']->value;?>
', 'Container', <?php echo json_encode($_smarty_tpl->tpl_vars['assignData']->value);?>
);
	<?php echo '</script'; ?>
>
</div>
<?php }
}
