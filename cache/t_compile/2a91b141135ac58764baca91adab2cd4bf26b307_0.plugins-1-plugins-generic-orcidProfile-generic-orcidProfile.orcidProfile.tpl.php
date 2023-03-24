<?php
/* Smarty version 3.1.39, created on 2021-09-27 18:21:19
  from 'plugins-1-plugins-generic-orcidProfile-generic-orcidProfile:orcidProfile.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6151ef7f8620f8_02735092',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a91b141135ac58764baca91adab2cd4bf26b307' => 
    array (
      0 => 'plugins-1-plugins-generic-orcidProfile-generic-orcidProfile:orcidProfile.tpl',
      1 => 1624492184,
      2 => 'plugins-1-plugins-generic-orcidProfile-generic-orcidProfile',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6151ef7f8620f8_02735092 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'orcidButton', 'orcidButton', null);?>
<button id="connect-orcid-button" class="cmp_button" onclick="return openORCID();">
	<?php echo $_smarty_tpl->tpl_vars['orcidIcon']->value;?>

	<?php if ($_smarty_tpl->tpl_vars['orcid']->value && !$_smarty_tpl->tpl_vars['orcidAuthenticated']->value) {?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>'plugins.generic.orcidProfile.authorise'),$_smarty_tpl ) );?>

	<?php } else { ?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>'plugins.generic.orcidProfile.connect'),$_smarty_tpl ) );?>

	<?php }?>
</button>
<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>"page",'page'=>"orcidapi",'op'=>"about"),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>'plugins.generic.orcidProfile.about.title'),$_smarty_tpl ) );?>
</a>
<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>


<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'orcidLink', 'orcidLink', null);
if ($_smarty_tpl->tpl_vars['orcidAuthenticated']->value) {?>
	<a href="<?php echo $_smarty_tpl->tpl_vars['orcid']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['orcidIcon']->value;
echo $_smarty_tpl->tpl_vars['orcid']->value;?>
</a>
<?php } else { ?>
	<a href="<?php echo $_smarty_tpl->tpl_vars['orcid']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['orcid']->value;?>
</a>&nbsp;<?php echo $_smarty_tpl->tpl_vars['orcidButton']->value;?>

<?php }
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

<?php echo '<script'; ?>
 type="text/javascript">
	function openORCID() {
		// First sign out from ORCID to make sure no other user is logged in
		// with ORCID
		$.ajax({
            url: '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['orcidUrl']->value ));?>
userStatus.json?logUserOut=true',
            dataType: 'jsonp',
            success: function(result,status,xhr) {
                console.log("ORCID Logged In: " + result.loggedIn);
            },
            error: function (xhr, status, error) {
                console.log(status + ", error: " + error);
            }
        });
		var oauthWindow = window.open("<?php echo $_smarty_tpl->tpl_vars['orcidOAuthUrl']->value;?>
", "_blank", "toolbar=no, scrollbars=yes, width=500, height=700, top=500, left=500");
		oauthWindow.opener = self;
		return false;
	}
<?php if ($_smarty_tpl->tpl_vars['targetOp']->value == 'profile') {?>
	$(document).ready(function() {        
		var orcidInput = $('input[name=orcid]');
        orcidInput.attr('type', 'hidden');
        var orcidLinkOrButton = $(
        	<?php if ($_smarty_tpl->tpl_vars['orcid']->value) {?>
        		<?php echo json_encode($_smarty_tpl->tpl_vars['orcidLink']->value);?>

        	<?php } else { ?>
        		<?php echo json_encode($_smarty_tpl->tpl_vars['orcidButton']->value);?>

        	<?php }?>);       
        orcidLinkOrButton.insertAfter(orcidInput);		
	});
<?php }
echo '</script'; ?>
>

<?php if ($_smarty_tpl->tpl_vars['targetOp']->value == 'register') {?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"hidden",'name'=>"orcid",'id'=>"orcid",'value'=>$_smarty_tpl->tpl_vars['orcid']->value,'maxlength'=>"37"),$_smarty_tpl ) );?>

	<?php echo $_smarty_tpl->tpl_vars['orcidButton']->value;?>

<?php }
}
}
