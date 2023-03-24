<?php
/* Smarty version 3.1.39, created on 2021-09-27 18:34:48
  from 'app:controllersgridgrid.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151f2a89c7228_32135706',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7320d3cb4fdcdb20c42291056bf24fb3e1ab3ae7' => 
    array (
      0 => 'app:controllersgridgrid.tpl',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/grid/feature/featuresOptions.tpl' => 1,
    'app:controllers/grid/gridHeader.tpl' => 1,
    'app:controllers/grid/columnGroup.tpl' => 2,
    'app:linkAction/linkAction.tpl' => 1,
    'app:controllers/grid/gridActionsBelow.tpl' => 1,
  ),
),false)) {
function content_6151f2a89c7228_32135706 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('staticId', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( "component-",$_smarty_tpl->tpl_vars['grid']->value->getId() )));
$_smarty_tpl->_assignInScope('gridId', uniqid(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( $_smarty_tpl->tpl_vars['staticId']->value,'-' ))));
$_smarty_tpl->_assignInScope('gridTableId', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'concat' ][ 0 ], array( $_smarty_tpl->tpl_vars['gridId']->value,"-table" )));
$_smarty_tpl->_assignInScope('gridActOnId', $_smarty_tpl->tpl_vars['gridTableId']->value);?>

<?php echo '<script'; ?>
>
	$(function() {
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['gridConstants']->value, 'value', false, 'constant');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['constant']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
			$.pkp.cons.<?php echo $_smarty_tpl->tpl_vars['constant']->value;?>
 = <?php echo $_smarty_tpl->tpl_vars['value']->value;?>
;
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		$('#<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['gridId']->value,'javascript' ));?>
').pkpHandler(
			'<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['grid']->value->getJSHandler(),'javascript' ));?>
',
			{
				gridId: <?php echo json_encode($_smarty_tpl->tpl_vars['grid']->value->getId());?>
,
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['grid']->value->getUrls(), 'itemUrl', false, 'key', 'gridUrls', array (
));
$_smarty_tpl->tpl_vars['itemUrl']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['itemUrl']->value) {
$_smarty_tpl->tpl_vars['itemUrl']->do_else = false;
?>
					<?php echo json_encode($_smarty_tpl->tpl_vars['key']->value);?>
: <?php echo json_encode($_smarty_tpl->tpl_vars['itemUrl']->value);?>
,
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				bodySelector: '#<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['gridActOnId']->value,'javascript' ));?>
',
				<?php if ($_smarty_tpl->tpl_vars['grid']->value->getPublishChangeEvents()) {?>
					publishChangeEvents: <?php echo json_encode($_smarty_tpl->tpl_vars['grid']->value->getPublishChangeEvents());?>
,
				<?php }?>
				features: <?php $_smarty_tpl->_subTemplateRender('app:controllers/grid/feature/featuresOptions.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('features'=>$_smarty_tpl->tpl_vars['features']->value), 0, false);
?>
			}
		);
	});
<?php echo '</script'; ?>
>

<div id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['gridId']->value ));?>
" class="pkp_controllers_grid<?php if (is_a($_smarty_tpl->tpl_vars['grid']->value,'CategoryGridHandler')) {?> pkp_grid_category<?php }
if (!$_smarty_tpl->tpl_vars['grid']->value->getTitle()) {?> pkp_grid_no_title<?php }?>">
	<?php $_smarty_tpl->_subTemplateRender("app:controllers/grid/gridHeader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	<table id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['gridTableId']->value ));?>
">
		<?php $_smarty_tpl->_subTemplateRender("app:controllers/grid/columnGroup.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('columns'=>$_smarty_tpl->tpl_vars['columns']->value), 0, false);
?>
		<thead>
						<tr>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['columns']->value, 'column', false, NULL, 'columns', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['column']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['column']->value) {
$_smarty_tpl->tpl_vars['column']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_columns']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_columns']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_columns']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_columns']->value['total'];
?>
										<?php if ($_smarty_tpl->tpl_vars['column']->value->hasFlag('indent')) {?>
						<?php continue 1;?>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['column']->value->hasFlag('alignment')) {?>
						<?php $_smarty_tpl->_assignInScope('alignment', $_smarty_tpl->tpl_vars['column']->value->getFlag('alignment'));?>
					<?php } else { ?>
						<?php $_smarty_tpl->_assignInScope('alignment', (defined('COLUMN_ALIGNMENT_LEFT') ? constant('COLUMN_ALIGNMENT_LEFT') : null));?>
					<?php }?>
					<th scope="col" style="text-align: <?php echo $_smarty_tpl->tpl_vars['alignment']->value;?>
;">
						<?php echo $_smarty_tpl->tpl_vars['column']->value->getLocalizedTitle();?>

												<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_columns']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_columns']->value['last'] : null) && $_smarty_tpl->tpl_vars['grid']->value->getActions((defined('GRID_ACTION_POSITION_LASTCOL') ? constant('GRID_ACTION_POSITION_LASTCOL') : null))) {?>
							<span class="options pkp_linkActions">
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['grid']->value->getActions((defined('GRID_ACTION_POSITION_LASTCOL') ? constant('GRID_ACTION_POSITION_LASTCOL') : null)), 'action');
$_smarty_tpl->tpl_vars['action']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['action']->value) {
$_smarty_tpl->tpl_vars['action']->do_else = false;
?>
									<?php $_smarty_tpl->_subTemplateRender("app:linkAction/linkAction.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('action'=>$_smarty_tpl->tpl_vars['action']->value,'contextId'=>$_smarty_tpl->tpl_vars['staticId']->value), 0, true);
?>
								<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</span>
						<?php }?>
					</th>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</tr>
		</thead>
		<?php if ($_smarty_tpl->tpl_vars['grid']->value->getIsSubcomponent() && !is_a($_smarty_tpl->tpl_vars['grid']->value,'CategoryGridHandler')) {?>
						</table>
			<div class="scrollable">
			<table>
				<?php $_smarty_tpl->_subTemplateRender("app:controllers/grid/columnGroup.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('columns'=>$_smarty_tpl->tpl_vars['columns']->value), 0, true);
?>
		<?php }?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['gridBodyParts']->value, 'bodyPart');
$_smarty_tpl->tpl_vars['bodyPart']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['bodyPart']->value) {
$_smarty_tpl->tpl_vars['bodyPart']->do_else = false;
?>
			<?php echo $_smarty_tpl->tpl_vars['bodyPart']->value;?>

		<?php
}
if ($_smarty_tpl->tpl_vars['bodyPart']->do_else) {
?>
 			<tbody></tbody>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<tbody class="empty"<?php if (count($_smarty_tpl->tpl_vars['gridBodyParts']->value) > 0) {?> style="display: none;"<?php }?>>
						<tr>
				<td colspan="<?php echo $_smarty_tpl->tpl_vars['grid']->value->getColumnsCount('indent');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['grid']->value->getEmptyRowText()),$_smarty_tpl ) );?>
</td>
			</tr>
		</tbody>
	</table>

	<?php if ($_smarty_tpl->tpl_vars['grid']->value->getIsSubcomponent() && !is_a($_smarty_tpl->tpl_vars['grid']->value,'CategoryGridHandler')) {?>
		</div>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['grid']->value->getActions((defined('GRID_ACTION_POSITION_BELOW') ? constant('GRID_ACTION_POSITION_BELOW') : null)) || $_smarty_tpl->tpl_vars['grid']->value->getFootNote()) {?>
	<div class="footer">

		<?php if ($_smarty_tpl->tpl_vars['grid']->value->getActions((defined('GRID_ACTION_POSITION_BELOW') ? constant('GRID_ACTION_POSITION_BELOW') : null))) {?>
			<?php $_smarty_tpl->_subTemplateRender("app:controllers/grid/gridActionsBelow.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('actions'=>$_smarty_tpl->tpl_vars['grid']->value->getActions((defined('GRID_ACTION_POSITION_BELOW') ? constant('GRID_ACTION_POSITION_BELOW') : null)),'gridId'=>$_smarty_tpl->tpl_vars['staticId']->value), 0, false);
?>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['grid']->value->getFootNote()) {?>
			<div class="footnote">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['grid']->value->getFootNote()),$_smarty_tpl ) );?>

			</div>
		<?php }?>
	</div>
	<?php }?>

</div>
<?php }
}
