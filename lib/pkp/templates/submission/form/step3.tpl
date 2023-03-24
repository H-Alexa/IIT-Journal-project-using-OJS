{**
 * templates/submission/form/step3.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Step 3 of author submission.
 *}
<script type="text/javascript">
	$(function() {ldelim}
		// Attach the JS form handler.
		$('#submitStep3Form').pkpHandler(
			'$.pkp.pages.submission.SubmissionStep3FormHandler',
			{ldelim}
				chaptersGridContainer: 'chaptersGridContainer',
				authorsGridContainer: 'authorsGridContainer',
			{rdelim});
	{rdelim});
</script>

<form class="pkp_form" id="submitStep3Form" method="post" action="{url op="saveStep" path=$submitStep}">
	{csrf}
	<input type="hidden" name="submissionId" value="{$submissionId|escape}" />
	{include file="controllers/notification/inPlaceNotification.tpl" notificationId="submitStep3FormNotification"}

	{include file="submission/submissionMetadataFormTitleFields.tpl"}

	<!--  Contributors -->
	{capture assign=authorGridUrl}{url router=$smarty.const.ROUTE_COMPONENT component="grid.users.author.AuthorGridHandler" op="fetchGrid" submissionId=$submissionId publicationId=$publicationId escape=false}{/capture}
	{load_url_in_div id="authorsGridContainer" url=$authorGridUrl}

	{$additionalContributorsFields}

	{include file="submission/submissionMetadataFormFields.tpl"}

	{fbvFormButtons id="step3Buttons" submitText="common.saveAndContinue"}
</form>
