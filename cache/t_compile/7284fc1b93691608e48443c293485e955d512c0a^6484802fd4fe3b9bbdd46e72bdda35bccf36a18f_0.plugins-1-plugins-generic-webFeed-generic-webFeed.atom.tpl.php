<?php
/* Smarty version 3.1.39, created on 2021-09-29 05:31:42
  from 'plugins-1-plugins-generic-webFeed-generic-webFeed:atom.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6153de1e15a847_63353233',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6484802fd4fe3b9bbdd46e72bdda35bccf36a18f' => 
    array (
      0 => 'plugins-1-plugins-generic-webFeed-generic-webFeed:atom.tpl',
      1 => 1624492110,
      2 => 'plugins-1-plugins-generic-webFeed-generic-webFeed',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6153de1e15a847_63353233 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\OJS\\lib\\pkp\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),1=>array('file'=>'C:\\xampp\\htdocs\\OJS\\lib\\pkp\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.regex_replace.php','function'=>'smarty_modifier_regex_replace',),));
echo '<?xml ';?>
version="1.0" encoding="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['defaultCharset']->value ));?>
"<?php echo '?>';?>

<feed xmlns="http://www.w3.org/2005/Atom">
		<id><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"issue",'op'=>"feed"),$_smarty_tpl ) );?>
</id>
	<title><?php echo preg_replace('!\s+!u', ' ',call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['journal']->value->getLocalizedName(),"html" )));?>
</title>

		<?php $_smarty_tpl->_assignInScope('latestDate', $_smarty_tpl->tpl_vars['issue']->value->getDatePublished());?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['publishedSubmissions']->value, 'section', false, NULL, 'sections', array (
));
$_smarty_tpl->tpl_vars['section']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['section']->value) {
$_smarty_tpl->tpl_vars['section']->do_else = false;
?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['section']->value['articles'], 'article');
$_smarty_tpl->tpl_vars['article']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->do_else = false;
?>
			<?php if ($_smarty_tpl->tpl_vars['article']->value->getLastModified() > $_smarty_tpl->tpl_vars['latestDate']->value) {?>
				<?php $_smarty_tpl->_assignInScope('latestDate', $_smarty_tpl->tpl_vars['article']->value->getLastModified());?>
			<?php }?>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<updated><?php echo smarty_modifier_regex_replace(smarty_modifier_date_format($_smarty_tpl->tpl_vars['latestDate']->value,"%Y-%m-%dT%T%z"),"/00"."$"."/",":00");?>
</updated>

		<?php if ($_smarty_tpl->tpl_vars['journal']->value->getData('contactName')) {?>
		<author>
			<name><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['journal']->value->getData('contactName')),"html" ));?>
</name>
			<?php if ($_smarty_tpl->tpl_vars['journal']->value->getData('contactEmail')) {?>
			<email><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['journal']->value->getData('contactEmail')),"html" ));?>
</email>
			<?php }?>
		</author>
	<?php }?>

	<link rel="alternate" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('journal'=>$_smarty_tpl->tpl_vars['journal']->value->getPath()),$_smarty_tpl ) );?>
" />
	<link rel="self" type="application/atom+xml" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"feed",'op'=>"atom"),$_smarty_tpl ) );?>
" />

	
		
	<generator uri="http://pkp.sfu.ca/ojs/" version="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['ojsVersion']->value ));?>
">Open Journal Systems</generator>
	<?php if ($_smarty_tpl->tpl_vars['journal']->value->getLocalizedDescription()) {?>
		<?php $_smarty_tpl->_assignInScope('description', $_smarty_tpl->tpl_vars['journal']->value->getLocalizedDescription());?>
	<?php } elseif ($_smarty_tpl->tpl_vars['journal']->value->getLocalizedData('searchDescription')) {?>
		<?php $_smarty_tpl->_assignInScope('description', $_smarty_tpl->tpl_vars['journal']->value->getLocalizedData('searchDescription'));?>
	<?php }?>

	<subtitle type="html"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['description']->value),"html" ));?>
</subtitle>

	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['publishedSubmissions']->value, 'section', false, 'sectionId', 'sections', array (
));
$_smarty_tpl->tpl_vars['section']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sectionId']->value => $_smarty_tpl->tpl_vars['section']->value) {
$_smarty_tpl->tpl_vars['section']->do_else = false;
?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['section']->value['articles'], 'article');
$_smarty_tpl->tpl_vars['article']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->do_else = false;
?>
			<entry>
								<id><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"article",'op'=>"view",'path'=>$_smarty_tpl->tpl_vars['article']->value->getBestId()),$_smarty_tpl ) );?>
</id>
				<title><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['article']->value->getLocalizedTitle()),"html" ));?>
</title>
				<updated><?php echo smarty_modifier_regex_replace(smarty_modifier_date_format($_smarty_tpl->tpl_vars['article']->value->getLastModified(),"%Y-%m-%dT%T%z"),"/00"."$"."/",":00");?>
</updated>

				
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['article']->value->getAuthors(), 'author', false, NULL, 'authorList', array (
));
$_smarty_tpl->tpl_vars['author']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['author']->value) {
$_smarty_tpl->tpl_vars['author']->do_else = false;
?>
					<author>
						<name><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['author']->value->getFullName(false)),"html" ));?>
</name>
						<?php if ($_smarty_tpl->tpl_vars['author']->value->getEmail()) {?>
							<email><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['author']->value->getEmail()),"html" ));?>
</email>
						<?php }?>
					</author>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<link rel="alternate" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"article",'op'=>"view",'path'=>$_smarty_tpl->tpl_vars['article']->value->getBestId()),$_smarty_tpl ) );?>
" />

				<?php if ($_smarty_tpl->tpl_vars['article']->value->getLocalizedAbstract()) {?>
					<summary type="html" xml:base="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"article",'op'=>"view",'path'=>$_smarty_tpl->tpl_vars['article']->value->getBestId()),$_smarty_tpl ) );?>
"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['article']->value->getLocalizedAbstract()),"html" ));?>
</summary>
				<?php }?>

												
				<?php if ($_smarty_tpl->tpl_vars['article']->value->getDatePublished()) {?>
					<published><?php echo smarty_modifier_regex_replace(smarty_modifier_date_format($_smarty_tpl->tpl_vars['article']->value->getDatePublished(),"%Y-%m-%dT%T%z"),"/00"."$"."/",":00");?>
</published>
				<?php }?>

								<rights><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.copyrightStatement",'copyrightYear'=>$_smarty_tpl->tpl_vars['article']->value->getCopyrightYear(),'copyrightHolder'=>$_smarty_tpl->tpl_vars['article']->value->getLocalizedCopyrightHolder()),$_smarty_tpl ) ) ));?>
</rights>
			</entry>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></feed>
<?php }
}
