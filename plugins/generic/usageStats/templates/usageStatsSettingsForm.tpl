{**
 * plugins/generic/usageStats/templates/usageStatsSettingsForm.tpl
 *
 * Copyright (c) 2013-2020 Simon Fraser University
 * Copyright (c) 2003-2020 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Usage statistics plugin management form.
 *
 *}
<script type="text/javascript">
	$(function() {ldelim}
		// Attach the form handler.
		$('#usageStatsSettingsForm').pkpHandler('$.pkp.controllers.form.AjaxFormHandler');
	{rdelim});
</script>

<form class="pkp_form" id="usageStatsSettingsForm" method="post" action="{url router=$smarty.const.ROUTE_COMPONENT op="manage" category="generic" plugin=$pluginName verb="save"}">
	{csrf}

	{include file="controllers/notification/inPlaceNotification.tpl" notificationId="usageStatsSettingsFormNotification"}

	{fbvFormArea id="usageStatsDisplayOptions"}
		{fbvFormSection for="displayStatistics" list=true}
			{fbvElement type="checkbox" id="displayStatistics" value="1" checked=$displayStatistics label="plugins.generic.usageStats.settings.statsDisplayOptions.display"}
		{/fbvFormSection}
		{fbvFormSection for="chartType" description="plugins.generic.usageStats.settings.statsDisplayOptions.chartType"}
			{fbvElement type="select" id="chartType" from=$chartTypes selected=$chartType translate=false size=$fbvStyles.size.SMALL}
		{/fbvFormSection}
		{fbvFormSection for="datasetMaxCount" description="plugins.generic.usageStats.settings.statsDisplayOptions.datasetMaxCount"}
			{fbvElement type="text" id="datasetMaxCount" value=$datasetMaxCount size=$fbvStyles.size.SMALL}
		{/fbvFormSection}
	{/fbvFormArea}
	{fbvFormButtons id="usageStatsSettingsFormSubmit" submitText="common.save" hideCancel=true}
</form>
