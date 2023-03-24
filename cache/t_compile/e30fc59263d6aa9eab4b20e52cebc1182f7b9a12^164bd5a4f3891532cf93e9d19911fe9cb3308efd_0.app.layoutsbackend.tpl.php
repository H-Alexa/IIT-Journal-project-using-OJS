<?php
/* Smarty version 3.1.39, created on 2021-09-28 07:50:23
  from 'app:layoutsbackend.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6152ad1fe75da5_84893203',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '164bd5a4f3891532cf93e9d19911fe9cb3308efd' => 
    array (
      0 => 'app:layoutsbackend.tpl',
      1 => 1624492183,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:controllers/notification/notificationOptions.tpl' => 1,
    'app:common/loadingContainer.tpl' => 1,
  ),
),false)) {
function content_6152ad1fe75da5_84893203 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\OJS\\lib\\pkp\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['currentLocale']->value,"_","-");?>
" xml:lang="<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['currentLocale']->value,"_","-");?>
">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['defaultCharset']->value ));?>
" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo preg_replace('!<[^>]*?>!', ' ', call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['title'][0], array( array('value'=>$_smarty_tpl->tpl_vars['pageTitle']->value),$_smarty_tpl ) ));?>
</title>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_header'][0], array( array('context'=>"backend"),$_smarty_tpl ) );?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_stylesheet'][0], array( array('context'=>"backend"),$_smarty_tpl ) );?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_script'][0], array( array('context'=>"backend"),$_smarty_tpl ) );?>

</head>
<body class="pkp_page_<?php echo (($tmp = @call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['requestedPage']->value )))===null||$tmp==='' ? "index" : $tmp);?>
 pkp_op_<?php echo (($tmp = @call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['requestedOp']->value )))===null||$tmp==='' ? "index" : $tmp);?>
" dir="<?php echo (($tmp = @call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['currentLocaleLangDir']->value )))===null||$tmp==='' ? "ltr" : $tmp);?>
">

	<?php echo '<script'; ?>
 type="text/javascript">
		// Initialise JS handler.
		$(function() {
			$('body').pkpHandler(
				'$.pkp.controllers.SiteHandler',
				{
					<?php $_smarty_tpl->_subTemplateRender("app:controllers/notification/notificationOptions.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
				});
		});
	<?php echo '</script'; ?>
>

	<div id="app" class="app <?php if ($_smarty_tpl->tpl_vars['isLoggedInAs']->value) {?> app--isLoggedInAs<?php }?>">
		<header class="app__header" role="banner">
			<?php if ($_smarty_tpl->tpl_vars['availableContexts']->value) {?>
				<dropdown class="app__headerAction app__contexts" v-cloak>
					<template slot="button">
						<icon icon="sitemap"></icon>
						<span class="-screenReader"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"context.contexts"),$_smarty_tpl ) );?>
</span>
					</template>
					<ul>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['availableContexts']->value, 'availableContext');
$_smarty_tpl->tpl_vars['availableContext']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['availableContext']->value) {
$_smarty_tpl->tpl_vars['availableContext']->do_else = false;
?>
							<?php if (!$_smarty_tpl->tpl_vars['currentContext']->value || $_smarty_tpl->tpl_vars['availableContext']->value->name !== $_smarty_tpl->tpl_vars['currentContext']->value->getLocalizedData('name')) {?>
								<li>
									<a href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['availableContext']->value->url ));?>
" class="pkpDropdown__action">
										<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['availableContext']->value->name ));?>

									</a>
								</li>
							<?php }?>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</ul>
				</dropdown>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['currentContext']->value) {?>
				<a class="app__contextTitle" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"index"),$_smarty_tpl ) );?>
">
					<?php echo $_smarty_tpl->tpl_vars['currentContext']->value->getLocalizedData('name');?>

				</a>
			<?php } elseif ($_smarty_tpl->tpl_vars['siteTitle']->value) {?>
				<a class="app__contextTitle" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
">
					<?php echo $_smarty_tpl->tpl_vars['siteTitle']->value;?>

				</a>
			<?php } else { ?>
				<div class="app__contextTitle">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.software"),$_smarty_tpl ) );?>

				</div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['currentUser']->value) {?>
				<div class="app__headerActions" v-cloak>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['call_hook'][0], array( array('name'=>"Template::Layout::Backend::HeaderActions"),$_smarty_tpl ) );?>

					<div class="app__headerAction app__tasks">
						<button ref="tasksButton" @click="openTasks">
							<icon icon="bell-o"></icon>
							<span class="-screenReader"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.tasks"),$_smarty_tpl ) );?>
</span>
							<span v-if="unreadTasksCount" class="app__tasksCount">{{ unreadTasksCount }}</span>
						</button>
					</div>
					<dropdown class="app__headerAction app__userNav">
						<template slot="button">
							<icon icon="user-circle-o"></icon>
							<?php if ($_smarty_tpl->tpl_vars['isUserLoggedInAs']->value) {?>
								<icon icon="user-circle" class="app__userNav__isLoggedInAsWarning"></icon>
							<?php }?>
							<span class="-screenReader"><?php echo $_smarty_tpl->tpl_vars['currentUser']->value->getData('username');?>
</span>
						</template>
						<nav aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.navigation.user"),$_smarty_tpl ) );?>
">
							<?php if (count($_smarty_tpl->tpl_vars['supportedLocales']->value) > 1) {?>
								<div class="pkpDropdown__section">
									<div class="app__userNav__changeLocale">Change Language</div>
									<ul>
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['supportedLocales']->value, 'locale', false, 'localeKey');
$_smarty_tpl->tpl_vars['locale']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['localeKey']->value => $_smarty_tpl->tpl_vars['locale']->value) {
$_smarty_tpl->tpl_vars['locale']->do_else = false;
?>
											<li>
												<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_PAGE') ? constant('ROUTE_PAGE') : null),'page'=>"user",'op'=>"setLocale",'path'=>$_smarty_tpl->tpl_vars['localeKey']->value),$_smarty_tpl ) );?>
" class="pkpDropdown__action">
													<?php if ($_smarty_tpl->tpl_vars['localeKey']->value == $_smarty_tpl->tpl_vars['currentLocale']->value) {?>
														<icon icon="check" :inline="true"></icon>
													<?php }?>
													<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['locale']->value ));?>

												</a>
											</li>
										<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
									</ul>
								</div>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['isUserLoggedInAs']->value) {?>
								<div class="pkpDropdown__section">
									<div class="app__userNav__loggedInAs">
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"manager.people.signedInAs",'username'=>$_smarty_tpl->tpl_vars['currentUser']->value->getData('username')),$_smarty_tpl ) );?>

										<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_PAGE') ? constant('ROUTE_PAGE') : null),'page'=>"login",'op'=>"signOutAsUser"),$_smarty_tpl ) );?>
" class="app__userNav__logOutAs"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.logOutAs",'username'=>$_smarty_tpl->tpl_vars['currentUser']->value->getData('username')),$_smarty_tpl ) );?>
</a>.
									</div>
								</div>
							<?php }?>
							<div class="pkpDropdown__section">
								<ul>
									<li v-if="backToDashboardLink">
										<a :href="backToDashboardLink.url" class="pkpDropdown__action">
											{{ backToDashboardLink.name }}
										</a>
									</li>
									<li>
										<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_PAGE') ? constant('ROUTE_PAGE') : null),'page'=>"user",'op'=>"profile"),$_smarty_tpl ) );?>
" class="pkpDropdown__action">
											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.profile.editProfile"),$_smarty_tpl ) );?>

										</a>
									</li>
									<li>
										<?php if ($_smarty_tpl->tpl_vars['isUserLoggedInAs']->value) {?>
											<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_PAGE') ? constant('ROUTE_PAGE') : null),'page'=>"login",'op'=>"signOutAsUser"),$_smarty_tpl ) );?>
" class="pkpDropdown__action">
												<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.logOutAs",'username'=>$_smarty_tpl->tpl_vars['currentUser']->value->getData('username')),$_smarty_tpl ) );?>

											</a>
										<?php } else { ?>
											<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_PAGE') ? constant('ROUTE_PAGE') : null),'page'=>"login",'op'=>"signOut"),$_smarty_tpl ) );?>
" class="pkpDropdown__action">
												<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.logOut"),$_smarty_tpl ) );?>

											</a>
										<?php }?>
									</li>
								</ul>
							</div>
						</nav>
					</dropdown>
				</div>
			<?php }?>
		</header>

				<nav v-if="backToDashboardLink" class="app__returnHeader" aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.navigation.site"),$_smarty_tpl ) );?>
">
			<a class="app__returnHeaderLink" :href="backToDashboardLink.url">
				{{ backToDashboardLabel }}
			</a>
		</nav>

		<div class="app__body">
			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11748657986152ad1fe4bae2_45328587', "menu");
?>


			<main class="app__main">
				<div class="app__page<?php if ($_smarty_tpl->tpl_vars['pageWidth']->value) {?> app__page--<?php echo $_smarty_tpl->tpl_vars['pageWidth']->value;
}?>">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19404772736152ad1fe53a36_65614075', "breadcrumbs");
?>


					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16111462486152ad1fe61654_98150791', "page");
?>


				</div>
			</main>
		</div>
		<div
			aria-live="polite"
			aria-atomic="true"
			class="app__notifications"
			ref="notifications"
			role="status"
		>
			<transition-group name="app__notification">
				<notification v-for="notification in notifications" :key="notification.key" :type="notification.type" :can-dismiss="true" @dismiss="dismissNotification(notification.key)">
					{{ notification.message }}
				</notification>
			</transition-group>
		</div>
	</div>

	<?php echo '<script'; ?>
 type="text/javascript">
		pkp.registry.init('app', <?php echo json_encode($_smarty_tpl->tpl_vars['pageComponent']->value);?>
, <?php echo json_encode($_smarty_tpl->tpl_vars['state']->value);?>
);
	<?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
 type="text/javascript">
		// Initialize JS handler
		$(function() {
			$('#pkpHelpPanel').pkpHandler(
				'$.pkp.controllers.HelpPanelHandler',
				{
					helpUrl: <?php echo json_encode(call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"help",'escape'=>false),$_smarty_tpl ) ));?>
,
					helpLocale: '<?php echo substr($_smarty_tpl->tpl_vars['currentLocale']->value,0,2);?>
',
				}
			);
		});
	<?php echo '</script'; ?>
>
	<div id="pkpHelpPanel" class="pkp_help_panel" tabindex="-1">
		<div class="panel">
			<div class="header">
				<a href="#" class="pkpHomeHelpPanel home">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"help.toc"),$_smarty_tpl ) );?>

				</a>
				<a href="#" class="pkpCloseHelpPanel close">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.close"),$_smarty_tpl ) );?>

				</a>
			</div>
			<div class="content">
				<?php $_smarty_tpl->_subTemplateRender("app:common/loadingContainer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			</div>
			<div class="footer">
				<a href="#" class="pkpPreviousHelpPanel previous">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"help.previous"),$_smarty_tpl ) );?>

				</a>
				<a href="#" class="pkpNextHelpPanel next">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"help.next"),$_smarty_tpl ) );?>

				</a>
			</div>
		</div>
	</div>

</body>
</html>
<?php }
/* {block "menu"} */
class Block_11748657986152ad1fe4bae2_45328587 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'menu' => 
  array (
    0 => 'Block_11748657986152ad1fe4bae2_45328587',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<nav v-if="!!menu && Object.keys(menu).length > 1" class="app__nav" aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.navigation.site"),$_smarty_tpl ) );?>
">
					<ul>
						<li v-for="(menuItem, key) in menu" :key="key" :class="!!menuItem.submenu ? 'app__navGroup' : ''">
							<div v-if="!!menuItem.submenu" class="app__navItem app__navItem--hasSubmenu">
								{{ menuItem.name }}
							</div>
							<a v-else class="app__navItem" :class="menuItem.isCurrent ? 'app__navItem--isCurrent' : ''" :href="menuItem.url">
								{{ menuItem.name }}
							</a>
							<ul v-if="!!menuItem.submenu">
								<li v-for="(submenuItem, submenuKey) in menuItem.submenu" :key="submenuKey">
									<a class="app__navItem" :class="submenuItem.isCurrent ? 'app__navItem--isCurrent' : ''" :href="submenuItem.url">
										{{ submenuItem.name }}
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</nav>
			<?php
}
}
/* {/block "menu"} */
/* {block "breadcrumbs"} */
class Block_19404772736152ad1fe53a36_65614075 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'breadcrumbs' => 
  array (
    0 => 'Block_19404772736152ad1fe53a36_65614075',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

						<?php if ($_smarty_tpl->tpl_vars['breadcrumbs']->value) {?>
							<nav class="app__breadcrumbs" role="navigation" aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"navigation.breadcrumbLabel"),$_smarty_tpl ) );?>
">
								<ol>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['breadcrumbs']->value, 'breadcrumb', false, NULL, 'breadcrumbs', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['breadcrumb']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['breadcrumb']->value) {
$_smarty_tpl->tpl_vars['breadcrumb']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumbs']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumbs']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumbs']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumbs']->value['total'];
?>
										<li>
											<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumbs']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumbs']->value['last'] : null)) {?>
												<span aria-current="page"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['breadcrumb']->value['name'] ));?>
</span>
											<?php } else { ?>
												<a href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['breadcrumb']->value['url'] ));?>
">
													<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['breadcrumb']->value['name'] ));?>

												</a>
												<span class="app__breadcrumbsSeparator" aria-hidden="true"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"navigation.breadcrumbSeparator"),$_smarty_tpl ) );?>
</span>
											<?php }?>
										</li>
									<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								</ol>
							</nav>
						<?php }?>
					<?php
}
}
/* {/block "breadcrumbs"} */
/* {block "page"} */
class Block_16111462486152ad1fe61654_98150791 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page' => 
  array (
    0 => 'Block_16111462486152ad1fe61654_98150791',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "page"} */
}
