{**
 * templates/reviewer/review/modal/regretMessage.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Display a field for reviewers to enter regret messages
 *
 *}

<script type="text/javascript">
	$(function() {ldelim}
		// Attach the form handler.
		$('#declineReviewForm').pkpHandler('$.pkp.controllers.form.AjaxFormHandler');
	{rdelim});
</script>

<form class="pkp_form" id="declineReviewForm" method="post" action="{url op="saveDeclineReview" path=$submissionId|escape}">
	{csrf}
	<p>{translate key="reviewer.submission.declineReviewMessage"}</p>

	{fbvFormArea id="declineReview"}
		{fbvFormSection}
			{fbvElement type="textarea" id="declineReviewMessage" value=$declineMessageBody rich=true}
		{/fbvFormSection}

		{fbvFormButtons submitText="reviewer.submission.declineReview" hideCancel=true}
	{/fbvFormArea}
</form>
