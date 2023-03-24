{**
 * templates/workflow/submission.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Display submission details (metadata, file grid)
 *}

{* Help Link *}
{help file="editorial-workflow/submission" class="pkp_help_tab"}

<div class="pkp_workflow_sidebar">
	{capture assign=submissionEditorDecisionsUrl}{url router=$smarty.const.ROUTE_PAGE page="workflow" op="editorDecisionActions" submissionId=$submission->getId() stageId=$stageId contextId="submission" escape=false}{/capture}
	{load_url_in_div id="submissionEditorDecisionsDiv" url=$submissionEditorDecisionsUrl class="pkp_tab_actions"}
	{include file="controllers/tab/workflow/stageParticipants.tpl"}
</div>

<div class="pkp_workflow_content">
	{capture assign=submissionFilesGridUrl}{url router=$smarty.const.ROUTE_COMPONENT component="grid.files.submission.EditorSubmissionDetailsFilesGridHandler" op="fetchGrid" submissionId=$submission->getId() stageId=$stageId escape=false}{/capture}
	{load_url_in_div id="submissionFilesGridDiv" url=$submissionFilesGridUrl}

	{capture assign=queriesGridUrl}{url router=$smarty.const.ROUTE_COMPONENT component="grid.queries.QueriesGridHandler" op="fetchGrid" submissionId=$submission->getId() stageId=$stageId escape=false}{/capture}
	{load_url_in_div id="queriesGrid" url=$queriesGridUrl}
</div>
