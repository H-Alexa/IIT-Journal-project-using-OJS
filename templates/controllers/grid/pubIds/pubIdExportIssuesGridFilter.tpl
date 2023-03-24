{**
 * templates/controllers/grid/pubIds/pubIdExportIssuesGridFilter.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Filter template for issues lists.
 *}
{assign var="formId" value="issuesListFilter-"|concat:$filterData.gridId}
<script type="text/javascript">
	// Attach the form handler to the form.
	$('#{$formId}').pkpHandler('$.pkp.controllers.form.ClientFormHandler',
		{ldelim}
			trackFormChanges: false
		{rdelim}
	);
</script>
<form class="pkp_form filter" id="{$formId}" action="{url op="fetchGrid"}" method="post">
	{csrf}
	{fbvFormArea id="issueSearchFormArea"|concat:$filterData.gridId}
		{fbvFormSection}
			{fbvElement type="select" name="statusId" id="statusId"|concat:$filterData.gridId from=$filterData.status selected=$filterSelectionData.statusId size=$fbvStyles.size.SMALL translate=false inline="true"}
		{/fbvFormSection}
		{* Buttons generate their own section *}
		{fbvFormButtons hideCancel=true submitText="common.search"}
	{/fbvFormArea}
</form>
