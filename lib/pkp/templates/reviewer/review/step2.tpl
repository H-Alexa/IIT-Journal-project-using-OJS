{**
 * templates/reviewer/review/step2.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Show the step 2 review page
 *
 *}
<script type="text/javascript">
	$(function() {ldelim}
		// Attach the form handler.
		$('#reviewStep2Form').pkpHandler(
			'$.pkp.controllers.form.AjaxFormHandler'
		);
	{rdelim});
</script>

<form class="pkp_form" id="reviewStep2Form" method="post" action="{url page="reviewer" op="saveStep" path=$submission->getId() step="2" escape=false}">
{csrf}
{include file="controllers/notification/inPlaceNotification.tpl" notificationId="reviewStep2FormNotification"}

{fbvFormArea id="reviewStep2"}
	{fbvFormSection label="reviewer.submission.reviewerGuidelines"}
		<p>{$reviewerGuidelines}</p>
	{/fbvFormSection}

	{capture assign=cancelUrl}{url page="reviewer" op="submission" path=$submission->getId() step=1 escape=false}{/capture}
	{fbvFormButtons submitText="reviewer.submission.continueToStepThree" cancelText="navigation.goBack" cancelUrl=$cancelUrl cancelUrlTarget="_self" submitDisabled=$reviewIsClosed}
{/fbvFormArea}
</form>
