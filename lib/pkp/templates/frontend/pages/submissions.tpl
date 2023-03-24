{**
 * templates/frontend/pages/submissions.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @brief Display the page to view the editorial team.
 *
 * @uses $currentContext Journal|Press The current journal or press
 * @uses $submissionChecklist array List of requirements for submissions
 *}
{include file="frontend/components/header.tpl" pageTitle="about.submissions"}

<div class="page page_submissions">
	{include file="frontend/components/breadcrumbs.tpl" currentTitleKey="about.submissions"}
	<h1>
		{translate key="about.submissions"}
	</h1>

	<div class="cmp_notification">
		{if $sections|@count == 0 || $currentContext->getData('disableSubmissions')}
			{translate key="author.submit.notAccepting"}
		{else}
			{if $isUserLoggedIn}
				{capture assign="newSubmission"}<a href="{url page="submission" op="wizard"}">{translate key="about.onlineSubmissions.newSubmission"}</a>{/capture}
				{capture assign="viewSubmissions"}<a href="{url page="submissions"}">{translate key="about.onlineSubmissions.viewSubmissions"}</a>{/capture}
					{translate key="about.onlineSubmissions.submissionActions" newSubmission=$newSubmission viewSubmissions=$viewSubmissions}
			{else}
				{capture assign="login"}<a href="{url page="login"}">{translate key="about.onlineSubmissions.login"}</a>{/capture}
				{capture assign="register"}<a href="{url page="user" op="register"}">{translate key="about.onlineSubmissions.register"}</a>{/capture}
					{translate key="about.onlineSubmissions.registrationRequired" login=$login register=$register}
			{/if}
		{/if}
	</div>

	{if $submissionChecklist}
		<div class="submission_checklist">
			<h2>
				{translate key="about.submissionPreparationChecklist"}
				{include file="frontend/components/editLink.tpl" page="management" op="settings" path="workflow" anchor="submission/submissionChecklist" sectionTitleKey="about.submissionPreparationChecklist"}
			</h2>
			{translate key="about.submissionPreparationChecklist.description"}
			<ul>
				{foreach from=$submissionChecklist item=checklistItem}
					<li>
						<span class="fa fa-check" aria-hidden="true"></span>
						{$checklistItem.content|nl2br}
					</li>
				{/foreach}
			</ul>
		</div>
	{/if}

	{if $currentContext->getLocalizedData('authorGuidelines')}
	<div class="author_guidelines" id="authorGuidelines">
		<h2>
			{translate key="about.authorGuidelines"}
			{include file="frontend/components/editLink.tpl" page="management" op="settings" path="workflow" anchor="submission/authorGuidelines" sectionTitleKey="about.authorGuidelines"}
		</h2>
		{$currentContext->getLocalizedData('authorGuidelines')}
	</div>
	{/if}

	{foreach from=$sections item="section"}
		{if $section->getLocalizedPolicy()}
			<div class="section_policy">
				<h2>{$section->getLocalizedTitle()|escape}</h2>
				{$section->getLocalizedPolicy()}
				{if $isUserLoggedIn}
					{capture assign="sectionSubmissionUrl"}{url page="submission" op="wizard" sectionId=$section->getId()}{/capture}
					<p>
						{translate key="about.onlineSubmissions.submitToSection" name=$section->getLocalizedTitle() url=$sectionSubmissionUrl}
					</p>
				{/if}
			</div>
		{/if}
	{/foreach}

	{if $currentContext->getLocalizedData('copyrightNotice')}
		<div class="copyright_notice">
			<h2>
				{translate key="about.copyrightNotice"}
				{include file="frontend/components/editLink.tpl" page="management" op="settings" path="workflow" anchor="submission/authorGuidelines" sectionTitleKey="about.copyrightNotice"}
			</h2>
			{$currentContext->getLocalizedData('copyrightNotice')}
		</div>
	{/if}

	{if $currentContext->getLocalizedData('privacyStatement')}
	<div class="privacy_statement" id="privacyStatement">
		<h2>
			{translate key="about.privacyStatement"}
			{include file="frontend/components/editLink.tpl" page="management" op="settings" path="website" anchor="setup/privacy" sectionTitleKey="about.privacyStatement"}
		</h2>
		{$currentContext->getLocalizedData('privacyStatement')}
	</div>
	{/if}

</div><!-- .page -->

{include file="frontend/components/footer.tpl"}
