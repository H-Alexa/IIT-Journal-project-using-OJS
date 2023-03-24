<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:42:54
  from 'plugins-1-plugins-generic-pdfJsViewer-generic-pdfJsViewer:display.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152ab5ea27708_07112565',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '73e5346aaf408dcf1a4b78878ba72a76778861af' => 
    array (
      0 => 'plugins-1-plugins-generic-pdfJsViewer-generic-pdfJsViewer:display.tpl',
      1 => 1624492184,
      2 => 'plugins-1-plugins-generic-pdfJsViewer-generic-pdfJsViewer',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6152ab5ea27708_07112565 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\OJS\\lib\\pkp\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>
<!DOCTYPE html>
<html lang="<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['currentLocale']->value,"_","-");?>
" xml:lang="<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['currentLocale']->value,"_","-");?>
">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['defaultCharset']->value ));?>
" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"article.pageTitle",'title'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['title']->value ))),$_smarty_tpl ) );?>
</title>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_header'][0], array( array('context'=>"frontend",'headers'=>$_smarty_tpl->tpl_vars['headers']->value),$_smarty_tpl ) );?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_stylesheet'][0], array( array('context'=>"frontend",'stylesheets'=>$_smarty_tpl->tpl_vars['stylesheets']->value),$_smarty_tpl ) );?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_script'][0], array( array('context'=>"frontend",'scripts'=>$_smarty_tpl->tpl_vars['scripts']->value),$_smarty_tpl ) );?>

</head>
<body class="pkp_page_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['requestedPage']->value ));?>
 pkp_op_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['requestedOp']->value ));?>
">

		<header class="header_view">

		<a href="<?php echo $_smarty_tpl->tpl_vars['parentUrl']->value;?>
" class="return">
			<span class="pkp_screen_reader">
				<?php if ($_smarty_tpl->tpl_vars['parent']->value instanceOf Issue) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"issue.return"),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"article.return"),$_smarty_tpl ) );?>

				<?php }?>
			</span>
		</a>

		<a href="<?php echo $_smarty_tpl->tpl_vars['parentUrl']->value;?>
" class="title">
			<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['title']->value ));?>

		</a>

		<a href="<?php echo $_smarty_tpl->tpl_vars['pdfUrl']->value;?>
" class="download" download>
			<span class="label">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.download"),$_smarty_tpl ) );?>

			</span>
			<span class="pkp_screen_reader">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.downloadPdf"),$_smarty_tpl ) );?>

			</span>
		</a>

	</header>

	<?php echo '<script'; ?>
 type="text/javascript">
		// Creating iframe's src in JS instead of Smarty so that EZProxy-using sites can find our domain in $pdfUrl and do their rewrites on it.
		$(document).ready(function() {
			var urlBase = "<?php echo $_smarty_tpl->tpl_vars['pluginUrl']->value;?>
/pdf.js/web/viewer.html?file=";
			var pdfUrl = <?php echo json_encode($_smarty_tpl->tpl_vars['pdfUrl']->value);?>
;
			$("#pdfCanvasContainer > iframe").attr("src", urlBase + encodeURIComponent(pdfUrl));
		});
	<?php echo '</script'; ?>
>

	<div id="pdfCanvasContainer" class="galley_view<?php if (!$_smarty_tpl->tpl_vars['isLatestPublication']->value) {?> galley_view_with_notice<?php }?>">
		<?php if (!$_smarty_tpl->tpl_vars['isLatestPublication']->value) {?>
			<div class="galley_view_notice">
				<div class="galley_view_notice_message" role="alert">
					<?php echo $_smarty_tpl->tpl_vars['datePublished']->value;?>

				</div>
			</div>
		<?php }?>
		<iframe src="" width="100%" height="100%" style="min-height: 500px;" title="<?php echo $_smarty_tpl->tpl_vars['galleyTitle']->value;?>
" allowfullscreen webkitallowfullscreen></iframe>
	</div>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['call_hook'][0], array( array('name'=>"Templates::Common::Footer::PageFooter"),$_smarty_tpl ) );?>

</body>
</html>
<?php }
}
