{**
 * templates/controllers/grid/files/query/manageQueryNoteFiles.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Allows users to manage the list of files available to a query.
 *}

<script>
	$(function() {ldelim}
		// Attach the form handler.
		$('#manageQueryNoteFilesForm').pkpHandler('$.pkp.controllers.form.AjaxFormHandler');
	{rdelim});
</script>

<form class="pkp_form" id="manageQueryNoteFilesForm" action="{url component="grid.files.query.ManageQueryNoteFilesGridHandler" op="updateQueryNoteFiles" params=$actionArgs submissionId=$submissionId queryId=$queryId noteId=$noteId stageId=$smarty.const.WORKFLOW_STAGE_ID_EDITING}" method="post">
	<!-- Current query files -->
	<p>{translate key="editor.submission.query.manageQueryNoteFilesDescription"}</p>

	<div id="existingFilesContainer">
		{csrf}
		{fbvFormArea id="manageQueryNoteFiles"}
			{fbvFormSection}
				{capture assign=manageQueryNoteFilesGridUrl}{url router=$smarty.const.ROUTE_COMPONENT component="grid.files.query.ManageQueryNoteFilesGridHandler" op="fetchGrid" params=$actionArgs submissionId=$submissionId queryId=$queryId noteId=$noteId escape=false}{/capture}
				{load_url_in_div id="manageQueryNoteFilesGrid" url=$manageQueryNoteFilesGridUrl}
			{/fbvFormSection}

			{fbvFormButtons}
		{/fbvFormArea}
	</div>
</form>
