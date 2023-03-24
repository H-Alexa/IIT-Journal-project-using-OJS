{**
 * templates/workflow/submissionProgressBar.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Include the submission progress bar and the tab structure for the workflow.
 *}
{* Calculate the selected tab index for the current stage *}
{assign var=selectedTabIndex value=0}
{foreach from=$workflowStages item=$stage}
	{if $stage.id < $currentStageId}
		{assign var=selectedTabIndex value=$selectedTabIndex+1}
	{/if}
{/foreach}

<script type="text/javascript">
	// Attach the JS file tab handler.
	$(function() {ldelim}
		$('#stageTabs').pkpHandler(
			'$.pkp.controllers.tab.workflow.WorkflowTabHandler',
			{ldelim}
				selected: {$selectedTabIndex},
				emptyLastTab: true
			{rdelim}
		);
	{rdelim});
</script>
<div id="stageTabs" class="pkp_controllers_tab">
	<ul>
		{foreach from=$workflowStages item=$stage}
			<li class="pkp_workflow_{$stage.path} stageId{$stage.id}{if $stage.id === $currentStageId} initiated{/if}">
				<a href="{url router=$smarty.const.ROUTE_COMPONENT component="tab.workflow.WorkflowTabHandler" op="fetchTab" submissionId=$submission->getId() stageId=$stage.id escape=false}">
					{translate key=$stage.translationKey}
				</a>
			</li>
		{/foreach}
	</ul>
</div>
