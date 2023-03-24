{**
 * templates/settingsTabs.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * The setting tabs for the AddThis plugin.
 *}

<script type="text/javascript">
	// Attach the JS file tab handler.
	$(function() {ldelim}
		$('#addThisSettingsTabs').pkpHandler(
				'$.pkp.controllers.TabHandler');
	{rdelim});
</script>
<div id="addThisSettingsTabs" class="pkp_controllers_tab">
	<ul>
		<li><a href="{url router=$smarty.const.ROUTE_COMPONENT component="grid.settings.plugins.SettingsPluginGridHandler" op="manage" category="generic" plugin=$pluginName verb="showTab" tab="settings" escape=false}">{translate key="plugins.generic.addThis.settings"}</a></li>
		<li {if !$statsConfigured}class="ui-state-default ui-corner-top ui-state-disabled"{/if}>
			<a href="{url router=$smarty.const.ROUTE_COMPONENT component="grid.settings.plugins.SettingsPluginGridHandler" op="manage" category="generic" plugin=$pluginName verb="showTab" tab="statistics" escape=false}">{translate key="plugins.generic.addThis.settings.statistics"}</a>
		</li>
	</ul>
</div>

