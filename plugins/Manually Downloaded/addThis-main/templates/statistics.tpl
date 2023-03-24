{**
 * templates/statistics.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * The statistics setting tab for the AddThis plugin.
 *}
<script type="text/javascript">
	$(function() {ldelim}
		// Attach the form handler.
		$('#statisticsDisplayForm').pkpHandler('$.pkp.controllers.form.FormHandler');
	{rdelim});
</script>
<p>{translate key="plugins.generic.addThis.statistics.instructions"}</p>

<form class="pkp_form" id="statisticsDisplayForm">
	{capture assign="addThisStatisticsGridUrl"}{url router=$smarty.const.ROUTE_COMPONENT component="plugins.generic.addThis.controllers.grid.AddThisStatisticsGridHandler" op="fetchGrid" escape=false}{/capture}
	{load_url_in_div id="addThisStatisticsGridContainer" url=$addThisStatisticsGridUrl}
	{fbvElement type="button" id="cancelFormButton" label="common.close"}
</form>
