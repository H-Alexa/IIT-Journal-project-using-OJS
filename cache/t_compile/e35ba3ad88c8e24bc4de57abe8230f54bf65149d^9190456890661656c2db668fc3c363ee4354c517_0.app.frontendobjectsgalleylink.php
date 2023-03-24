<?php
/* Smarty version 3.1.39, created on 2021-09-27 16:14:11
  from 'app:frontendobjectsgalleylink' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151d1b38bc194_52218905',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9190456890661656c2db668fc3c363ee4354c517' => 
    array (
      0 => 'app:frontendobjectsgalleylink',
      1 => 1599486834,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6151d1b38bc194_52218905 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['journalOverride']->value) {?>
	<?php $_smarty_tpl->_assignInScope('currentJournal', $_smarty_tpl->tpl_vars['journalOverride']->value);
}?>

<?php if ($_smarty_tpl->tpl_vars['galley']->value->isPdfGalley()) {?>
	<?php $_smarty_tpl->_assignInScope('type', "pdf");
} else { ?>
	<?php $_smarty_tpl->_assignInScope('type', "file");
}?>

<?php if ($_smarty_tpl->tpl_vars['parent']->value instanceOf Issue) {?>
	<?php $_smarty_tpl->_assignInScope('page', "issue");?>
	<?php $_smarty_tpl->_assignInScope('parentId', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['parent']->value->getBestIssueId() )));
} else { ?>
	<?php $_smarty_tpl->_assignInScope('page', "article");?>
	<?php $_smarty_tpl->_assignInScope('parentId', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['parent']->value->getBestId() )));
}?>

<?php if (!$_smarty_tpl->tpl_vars['hasAccess']->value) {?>
	<?php if ($_smarty_tpl->tpl_vars['restrictOnlyPdf']->value && $_smarty_tpl->tpl_vars['type']->value == "pdf") {?>
		<?php $_smarty_tpl->_assignInScope('restricted', "1");?>
	<?php } elseif (!$_smarty_tpl->tpl_vars['restrictOnlyPdf']->value) {?>
		<?php $_smarty_tpl->_assignInScope('restricted', "1");?>
	<?php }
}?>

<a class="galley-link btn <?php if ($_smarty_tpl->tpl_vars['isSupplementary']->value) {?>btn-default<?php } else { ?>btn-primary<?php }?> <?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" role="button" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['page']->value,'op'=>"view",'path'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'to_array' ][ 0 ], array( $_smarty_tpl->tpl_vars['parentId']->value,$_smarty_tpl->tpl_vars['galley']->value->getBestGalleyId($_smarty_tpl->tpl_vars['currentJournal']->value) ))),$_smarty_tpl ) ) ));?>
">

		<?php if ($_smarty_tpl->tpl_vars['restricted']->value) {?>
		<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
		<span class="sr-only">
			<?php if ($_smarty_tpl->tpl_vars['purchaseArticleEnabled']->value) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"reader.subscriptionOrFeeAccess"),$_smarty_tpl ) );?>

			<?php } else { ?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"reader.subscriptionAccess"),$_smarty_tpl ) );?>

			<?php }?>
		</span>
	<?php }?>

	<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['galley']->value->getGalleyLabel() ));?>


	<?php if ($_smarty_tpl->tpl_vars['restricted']->value && $_smarty_tpl->tpl_vars['purchaseFee']->value && $_smarty_tpl->tpl_vars['purchaseCurrency']->value) {?>
		<span class="purchase-cost">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"reader.purchasePrice",'price'=>$_smarty_tpl->tpl_vars['purchaseFee']->value,'currency'=>$_smarty_tpl->tpl_vars['purchaseCurrency']->value),$_smarty_tpl ) );?>

		</span>
	<?php }?>
</a>
<?php }
}
