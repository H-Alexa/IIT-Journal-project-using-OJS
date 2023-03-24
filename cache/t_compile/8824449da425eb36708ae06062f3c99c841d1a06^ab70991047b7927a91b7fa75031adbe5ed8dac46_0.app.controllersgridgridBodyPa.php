<?php
/* Smarty version 3.1.39, created on 2021-09-27 19:04:59
  from 'app:controllersgridgridBodyPa' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151f9bb303040_69470624',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ab70991047b7927a91b7fa75031adbe5ed8dac46' => 
    array (
      0 => 'app:controllersgridgridBodyPa',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/grid/columnGroup.tpl' => 2,
  ),
),false)) {
function content_6151f9bb303040_69470624 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('categoryId', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "component-",$_smarty_tpl->tpl_vars['categoryRow']->value->getGridId(),"-category-",$_smarty_tpl->tpl_vars['categoryRow']->value->getId() )) )));?>
<tbody id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['categoryId']->value ));?>
" class="element<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['categoryRow']->value->getId() ));?>
 category_grid_body">
	<?php echo $_smarty_tpl->tpl_vars['renderedCategoryRow']->value;?>

	<?php if ($_smarty_tpl->tpl_vars['grid']->value->getIsSubcomponent()) {?>
		</tbody></table>
		<div class="scrollable"><table>
			<?php $_smarty_tpl->_subTemplateRender("app:controllers/grid/columnGroup.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('columns'=>$_smarty_tpl->tpl_vars['grid']->value->getColumns()), 0, false);
?>
			<tbody>
	<?php }?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rows']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
		<?php echo $_smarty_tpl->tpl_vars['row']->value;?>

	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</tbody>
<tbody id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( $_smarty_tpl->tpl_vars['categoryId']->value,'-emptyPlaceholder' )) ));?>
" class="empty category_placeholder"<?php if (count($_smarty_tpl->tpl_vars['rows']->value) > 0) {?> style="display: none;"<?php }?>>
		<tr>
		<td colspan="<?php echo $_smarty_tpl->tpl_vars['grid']->value->getColumnsCount('indent');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['grid']->value->getEmptyCategoryRowText()),$_smarty_tpl ) );?>
</td>
	</tr>
</tbody>
<?php if ($_smarty_tpl->tpl_vars['grid']->value->getIsSubcomponent()) {?>
	</table></div><table>
		<?php $_smarty_tpl->_subTemplateRender("app:controllers/grid/columnGroup.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('columns'=>$_smarty_tpl->tpl_vars['grid']->value->getColumns()), 0, true);
}
}
}
