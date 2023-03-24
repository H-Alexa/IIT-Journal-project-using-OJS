{**
 * templates/orcidVerify.tpl
 *
 * Copyright (c) 2014-2020 Simon Fraser University
 * Copyright (c) 2000-2020 John Willinsky
 * Copyright (c) 2018-2019 University Library Heidelberg
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Page template to display from the OrcidHandler to show ORCID verification success or failure.
 *}
{include file="frontend/components/header.tpl"}

<div class="page page_message">
	{include file="frontend/components/breadcrumbs.tpl" currentTitleKey="plugins.generic.orcidProfile.verify.title"}
	<h2>
		{translate key="plugins.generic.orcidProfile.verify.title"}
	</h2>
	<div class="description">
	{if $verifySuccess}
		<p>
			<span class="orcid"><a href="{$orcid|escape}" target="_blank">{$orcidIcon}{$orcid|escape}</a></span>
		</p>
		<div class="orcid-success">
		{translate key="plugins.generic.orcidProfile.verify.success"}
		</div>
		{if $sendSubmission}
			{if $sendSubmissionSuccess}
				<div class="orcid-success">
				{translate key="plugins.generic.orcidProfile.verify.sendSubmissionToOrcid.success"}
				</div>
			{else}
				<div class="orcid-failure">
				{translate key="plugins.generic.orcidProfile.verify.sendSubmissionToOrcid.failure"}
				</div>
			{/if}
		{elseif $submissionNotPublished}
			{translate key="plugins.generic.orcidProfile.verify.sendSubmissionToOrcid.notpublished"}
		{/if}
	{else}
		<div class="orcid-failure">
		{if $denied}
			{translate key="plugins.generic.orcidProfile.authDenied"}
		{elseif $authFailure}
			{translate key="plugins.generic.orcidProfile.authFailure"}
		{elseif $duplicateOrcid}
			{translate key="plugins.generic.orcidProfile.verify.duplicateOrcid"}
		{else}
			{translate key="plugins.generic.orcidProfile.verify.failure"}
		{/if}
		</div>
		{translate key="plugins.generic.orcidProfile.failure.contact"}
	{/if}
	</div>
</div>

{include file="frontend/components/footer.tpl"}
