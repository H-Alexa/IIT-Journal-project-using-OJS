{**
 * templates/controllers/statistics/form/reportGeneratorForm.tpl
 *
 * Copyright (c) 2013-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Report generator form template.
 *
 *}
<script type="text/javascript">
	$(function() {ldelim}
		// Attach the form handler.
		$('#reportGeneratorForm').pkpHandler('$.pkp.controllers.statistics.ReportGeneratorFormHandler',
			{ldelim}
				fetchFormUrl: {url|json_encode op=fetchReportGenerator escape=false},
				metricTypeSelectSelector: '#metricType',
				reportTemplateSelectSelector: '#reportTemplate',
				aggregationOptionsSelector: "input[type='checkbox'], #aggregationColumns",
				columnsSelector: '#columns',
				timeFilterWrapperSelector: '#reportTimeFilterArea',
				currentMonthSelector: '#currentMonth',
				yesterdaySelector: '#yesterday',
				rangeByMonthSelector: '#rangeByMonth',
				rangeByDaySelector: '#rangeByDay',
				startDayElementSelector: "select[name='dateStartDay']",
				endDayElementSelector: "select[name='dateEndDay']",
				dateRangeWrapperSelector : '#dateRangeElementsWrapper',
				objectTypeSelectSelector: '#objectTypes',
				fileTypeSelectSelector: '#fileTypes',
				fileAssocTypes: {ldelim}
					{foreach from=$fileAssocTypes key=key item=assocType}
						{$key|json_encode}: {$assocType|json_encode},
					{/foreach}
				{rdelim},
				fetchRegionsUrl: {url|json_encode op=fetchRegions escape=false},
				regionSelectSelector: '#regions',
				countrySelectSelector: '#countries',
				optionalColumns: {ldelim}
					{foreach from=$optionalColumns key=key item=column}
						{$key|escape:"javascript"}: '{$column|escape:"javascript"}',
					{/foreach}
				{rdelim}
			{rdelim}
		);
	{rdelim});
</script>

<form class="pkp_form" id="reportGeneratorForm" method="post" action="{url op="saveReportGenerator"}">
	{csrf}
	{if $metricTypeOptions}
		{fbvFormArea id="columnsFormArea" title="defaultMetric.availableMetrics"}
			{fbvFormSection}
				{fbvElement type="select" name="metricType" id="metricType" from=$metricTypeOptions selected=$metricType translate=false}
			{/fbvFormSection}
		{/fbvFormArea}
	{else}
		{fbvElement type="hidden" name="metricType" id="metricType" value=$metricType}
	{/if}

	{if $reportTemplateOptions}
		{fbvFormArea id="reportTemplatesFormArea" title="manager.statistics.reports.defaultReportTemplates"}
			{fbvFormSection}
				{fbvElement type="select" name="reportTemplate" id="reportTemplate" from=$reportTemplateOptions selected=$reportTemplate translate=false}
				{include file="common/loadingContainer.tpl"}
			{/fbvFormSection}
		{/fbvFormArea}
		{fbvFormArea id="aggregationColumnsFormArea" title="manager.statistics.reports.aggregationColumns"}
			{fbvFormSection for="aggregationColumns" description="manager.statistics.reports.optionalColumns.description" list=true}
				{fbvElement type="checkboxgroup" name="aggregationColumns" id="aggregationColumns" from=$aggregationOptions selected=$selectedAggregationOptions translate=false}
			{/fbvFormSection}
		{/fbvFormArea}
	{/if}
	{if $showMonthInputs || $showDayInputs}
		{fbvFormArea id="reportTimeFilterArea" title="manager.statistics.reports.filters.byTime"}
			{fbvFormSection for="currentMonth" list=true}
				{fbvElement type="radio" name="timeFilterOption" value=$smarty.const.TIME_FILTER_OPTION_YESTERDAY id="yesterday" checked=$yesterday label="manager.statistics.reports.yesterday"}
				{fbvElement type="radio" name="timeFilterOption" value=$smarty.const.TIME_FILTER_OPTION_CURRENT_MONTH id="currentMonth" checked=$currentMonth label="manager.statistics.reports.currentMonth"}
			{/fbvFormSection}
			{fbvFormSection title="manager.statistics.reports.filters.byTime.dimensionSelector" list=true}
				{fbvElement type="radio" name="timeFilterOption" value=$smarty.const.TIME_FILTER_OPTION_RANGE_DAY id="rangeByDay" inline=true checked=$byDay label="common.day"}
				{fbvElement type="radio" name="timeFilterOption" value=$smarty.const.TIME_FILTER_OPTION_RANGE_MONTH id="rangeByMonth" checked=$byMonth label="common.month"}
			{/fbvFormSection}
			<div id="dateRangeElementsWrapper">
				{fbvFormSection title="common.from"}
					{html_select_date prefix="dateStart" time=$dateStart all_extra="class=\"selectMenu\"" start_year="0" end_year="+0" field_order=YMD}
				{/fbvFormSection}
				{fbvFormSection title="common.until"}
					{html_select_date prefix="dateEnd" time=$dateEnd all_extra="class=\"selectMenu\"" start_year="0" end_year="+0" field_order=YMD}
				{/fbvFormSection}
			</div>
		{/fbvFormArea}
	{/if}

	{capture assign="advancedOptionsContent"}
		{fbvFormArea id="columnsFormArea" title="manager.statistics.reports.columns"}
			<p>{translate key="manager.statistics.reports.columns.description"}</p>
			{fbvFormSection description="manager.statistics.reports.optionalColumns.description"}
				{fbvElement type="select" name="columns[]" id="columns" from=$columnsOptions multiple="multiple" selected=$columns translate=false required=true}
			{/fbvFormSection}
		{/fbvFormArea}

		{fbvFormArea id="filterFormArea" title="manager.statistics.reports.filters"}
			{fbvFormSection label="manager.statistics.reports.filters.byObject"}
				<p>{translate key="manager.statistics.reports.filters.byObject.description"}</p>
				{fbvFormSection description="manager.statistics.reports.objectType" for="objectTypes"}
					{fbvElement type="select" name="objectTypes[]" id="objectTypes" from=$objectTypesOptions multiple="multiple" selected=$objectTypes translate=false}
				{/fbvFormSection}
				{if $fileTypesOptions}
					{fbvFormSection description="common.fileType" for="fileTypes"}
						{fbvElement type="select" name="fileTypes[]" id="fileTypes" from=$fileTypesOptions multiple="multiple" selected=$fileTypes translate=false}
					{/fbvFormSection}
				{/if}

				{fbvFormSection description="manager.statistics.reports.objectId" for="objectIds"}
					{fbvElement type="text" name="objectIds" id="objectIds" value=$objectIds label="manager.statistics.reports.objectId.label"}
				{/fbvFormSection}
			{/fbvFormSection}

			{if $countriesOptions}
				{fbvFormSection label="manager.statistics.reports.filters.byLocation"}
					<p>{translate key="manager.statistics.reports.filters.byLocation.description"}</p>
					{fbvFormSection description="common.country" for="countries"}
						{fbvElement type="select" name="countries[]" id="countries" from=$countriesOptions multiple="multiple" selected=$countries translate=false}
					{/fbvFormSection}
					{if $showRegionInput}
						{fbvFormSection description="manager.statistics.region" for="regions"}
							{fbvElement type="select" name="regions[]" id="regions" from=$regionsOptions multiple="multiple" selected=$regions translate=false}
						{/fbvFormSection}
					{/if}
					{if $showCityInput}
						{fbvFormSection description="manager.statistics.city" for="cityNames"}
							{fbvElement type="text" name="cityNames" id="cityNames" value=$cityNames label="manager.statistics.reports.cities.label"}
						{/fbvFormSection}
					{/if}
				{/fbvFormSection}
			{/if}

		{/fbvFormArea}

		{fbvFormArea id="orderByFormArea" title="manager.statistics.reports.orderBy"}
			{fbvFormSection description="manager.statistics.reports.optionalColumns.description"}
				<div style="clear:both"></div>
				{foreach from=$orderColumnsOptions item=item key=key}
					{fbvFormSection}
						{fbvElement type="select" name="orderByColumn[]" id="orderByColumn-$key" from=$orderColumnsOptions defaultValue=0 defaultLabel="manager.statistics.reports.columns"|translate selected=$orderByColumn translate=false}
					{/fbvFormSection}
					{fbvFormSection}
						{fbvElement type="select" name="orderByDirection[]" id="orderByDirection-$key" from=$orderDirectionsOptions defaultValue=0 defaultLabel="manager.statistics.reports.orderDir"|translate selected=$orderByDirection translate=false}
					{/fbvFormSection}
					<div style="clear:both"></div>
				{/foreach}
			{/fbvFormSection}
		{/fbvFormArea}
	{/capture}

	<div id="advancedOptionsWrapper" class="left full">
		{include file="controllers/extrasOnDemand.tpl"
			id="advancedOptionsExtras"
			widgetWrapper="#advancedOptionsWrapper"
			moreDetailsText="manager.statistics.reports.advancedOptions"
			lessDetailsText="manager.statistics.reports.advancedOptions.hide"
			extraContent=$advancedOptionsContent
		}
	</div>

	{fbvFormArea id="reportUrlFormArea" title="manager.statistics.reports.reportUrl"}
		{fbvFormSection}
			{fbvElement type="text" name="reportUrl" id="reportUrl" value=$reportUrl label="manager.statistics.reports.reportUrl.label"}
		{/fbvFormSection}
	{/fbvFormArea}

	{fbvFormButtons id="reportGeneratorFormSubmit" submitText="manager.statistics.reports.generateReport" hideCancel=true}
</form>
