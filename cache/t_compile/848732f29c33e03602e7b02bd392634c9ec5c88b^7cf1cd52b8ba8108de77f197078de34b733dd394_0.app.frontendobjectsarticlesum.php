<?php
/* Smarty version 3.1.39, created on 2021-09-27 15:47:26
  from 'app:frontendobjectsarticlesum' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151cb6e1313f8_67344815',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7cf1cd52b8ba8108de77f197078de34b733dd394' => 
    array (
      0 => 'app:frontendobjectsarticlesum',
      1 => 1611655481,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/objects/galley_link.tpl' => 1,
  ),
),false)) {
function content_6151cb6e1313f8_67344815 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('articlePath', $_smarty_tpl->tpl_vars['article']->value->getBestId($_smarty_tpl->tpl_vars['currentJournal']->value));
if ((!$_smarty_tpl->tpl_vars['section']->value['hideAuthor'] && $_smarty_tpl->tpl_vars['article']->value->getHideAuthor() == (defined('AUTHOR_TOC_DEFAULT') ? constant('AUTHOR_TOC_DEFAULT') : null)) || $_smarty_tpl->tpl_vars['article']->value->getHideAuthor() == (defined('AUTHOR_TOC_SHOW') ? constant('AUTHOR_TOC_SHOW') : null)) {?>
	<?php $_smarty_tpl->_assignInScope('showAuthor', true);
}?>

<div class="article-summary media">
	<?php if ($_smarty_tpl->tpl_vars['article']->value->getLocalizedCoverImage()) {?>
		<div class="cover media-left">
			<a href="<?php if ($_smarty_tpl->tpl_vars['journal']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('journal'=>$_smarty_tpl->tpl_vars['journal']->value->getPath(),'page'=>"article",'op'=>"view",'path'=>$_smarty_tpl->tpl_vars['articlePath']->value),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"article",'op'=>"view",'path'=>$_smarty_tpl->tpl_vars['articlePath']->value),$_smarty_tpl ) );
}?>class="file">
				<img class="media-object" src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['article']->value->getLocalizedCoverImageUrl() ));?>
" alt="<?php echo (($tmp = @call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['article']->value->getLocalizedCoverImageAltText() )))===null||$tmp==='' ? '' : $tmp);?>
">
			</a>
		</div>
	<?php }?>

	<div class="media-body">
		<h3 class="media-heading">
            <a href="<?php if ($_smarty_tpl->tpl_vars['journal']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('journal'=>$_smarty_tpl->tpl_vars['journal']->value->getPath(),'page'=>"article",'op'=>"view",'path'=>$_smarty_tpl->tpl_vars['articlePath']->value),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"article",'op'=>"view",'path'=>$_smarty_tpl->tpl_vars['articlePath']->value),$_smarty_tpl ) );
}?>">
				<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( $_smarty_tpl->tpl_vars['article']->value->getLocalizedTitle() ));?>

				<?php if ($_smarty_tpl->tpl_vars['article']->value->getLocalizedSubtitle()) {?>
					<p>
						<small><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['article']->value->getLocalizedSubtitle() ));?>
</small>
					</p>
				<?php }?>
			</a>
		</h3>

		<?php if ($_smarty_tpl->tpl_vars['showAuthor']->value || $_smarty_tpl->tpl_vars['article']->value->getPages()) {?>

			<?php if ($_smarty_tpl->tpl_vars['showAuthor']->value) {?>
				<div class="meta">
					<?php if ($_smarty_tpl->tpl_vars['showAuthor']->value) {?>
						<div class="authors">
							<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['article']->value->getAuthorString() ));?>

						</div>
					<?php }?>
				</div>
			<?php }?>

						<?php if ($_smarty_tpl->tpl_vars['article']->value->getPages()) {?>
				<p class="pages">
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['article']->value->getPages() ));?>

				</p>
			<?php }?>

		<?php }?>

		<?php if (!$_smarty_tpl->tpl_vars['hideGalleys']->value && $_smarty_tpl->tpl_vars['article']->value->getGalleys()) {?>
			<div class="btn-group" role="group">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['article']->value->getGalleys(), 'galley');
$_smarty_tpl->tpl_vars['galley']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['galley']->value) {
$_smarty_tpl->tpl_vars['galley']->do_else = false;
?>
					<?php if ($_smarty_tpl->tpl_vars['primaryGenreIds']->value) {?>
						<?php $_smarty_tpl->_assignInScope('file', $_smarty_tpl->tpl_vars['galley']->value->getFile());?>
						<?php if (!$_smarty_tpl->tpl_vars['galley']->value->getRemoteUrl() && !($_smarty_tpl->tpl_vars['file']->value && in_array($_smarty_tpl->tpl_vars['file']->value->getGenreId(),$_smarty_tpl->tpl_vars['primaryGenreIds']->value))) {?>
							<?php continue 1;?>
						<?php }?>
					<?php }?>
					<?php $_smarty_tpl->_assignInScope('publication', $_smarty_tpl->tpl_vars['article']->value->getCurrentPublication());?>
					<?php $_smarty_tpl->_assignInScope('hasArticleAccess', $_smarty_tpl->tpl_vars['hasAccess']->value);?>
					<?php if ($_smarty_tpl->tpl_vars['currentContext']->value->getSetting('publishingMode') == (defined('PUBLISHING_MODE_OPEN') ? constant('PUBLISHING_MODE_OPEN') : null) || $_smarty_tpl->tpl_vars['publication']->value->getData('accessStatus') == (defined('ARTICLE_ACCESS_OPEN') ? constant('ARTICLE_ACCESS_OPEN') : null)) {?>
						<?php $_smarty_tpl->_assignInScope('hasArticleAccess', 1);?>
					<?php }?>
					<?php $_smarty_tpl->_subTemplateRender("app:frontend/objects/galley_link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('parent'=>$_smarty_tpl->tpl_vars['article']->value,'hasAccess'=>$_smarty_tpl->tpl_vars['hasArticleAccess']->value), 0, true);
?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</div>
		<?php }?>
	</div>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['call_hook'][0], array( array('name'=>"Templates::Issue::Issue::Article"),$_smarty_tpl ) );?>

</div><!-- .article-summary -->
<?php }
}
