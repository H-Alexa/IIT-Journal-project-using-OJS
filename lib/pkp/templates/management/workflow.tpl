{**
 * templates/management/workflow.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @brief The workflow settings page.
 *}
{extends file="layouts/backend.tpl"}

{block name="page"}
	<h1 class="app__pageHeading">
		{translate key="manager.workflow.title"}
	</h1>

	{if $currentContext->getData('disableSubmissions')}
		<notification>
			{translate key="manager.setup.disableSubmissions.notAccepting"}
		</notification>
	{/if}

	<tabs :track-history="true">
		<tab id="submission" label="{translate key="manager.publication.submissionStage"}">
			{help file="settings/workflow-settings" section="submission" class="pkp_help_tab"}
			<tabs :is-side-tabs="true" :track-history="true">
				<tab id="disableSubmissions" label="{translate key="manager.setup.disableSubmissions"}">
					<pkp-form
						v-bind="components.{$smarty.const.FORM_DISABLE_SUBMISSIONS}"
						@set="set"
					/>
				</tab>
				<tab id="metadata" label="{translate key="submission.informationCenter.metadata"}">
					<pkp-form
						v-bind="components.{$smarty.const.FORM_METADATA_SETTINGS}"
						@set="set"
					/>
				</tab>
				<tab id="components" label="{translate key="grid.genres.title.short"}">
					{capture assign=genresUrl}{url router=$smarty.const.ROUTE_COMPONENT component="grid.settings.genre.GenreGridHandler" op="fetchGrid" escape=false}{/capture}
					{load_url_in_div id="genresGridContainer" url=$genresUrl}
				</tab>
				<tab id="submissionChecklist" label="{translate key="manager.setup.checklist"}">
					{capture assign=submissionChecklistGridUrl}{url router=$smarty.const.ROUTE_COMPONENT component="grid.settings.submissionChecklist.SubmissionChecklistGridHandler" op="fetchGrid" escape=false}{/capture}
					{load_url_in_div id="submissionChecklistGridContainer" url=$submissionChecklistGridUrl}
				</tab>
				<tab id="authorGuidelines" label="{translate key="manager.setup.authorGuidelines"}">
					<pkp-form
						v-bind="components.{$smarty.const.FORM_AUTHOR_GUIDELINES}"
						@set="set"
					/>
				</tab>
				{call_hook name="Template::Settings::workflow::submission"}
			</tabs>
		</tab>
		<tab id="review" label="{translate key="manager.publication.reviewStage"}">
			{help file="settings/workflow-settings" section="review" class="pkp_help_tab"}
			<tabs :is-side-tabs="true" :track-history="true">
				<tab id="reviewSetup" label="{translate key="navigation.setup"}">
					<pkp-form
						v-bind="components.{$smarty.const.FORM_REVIEW_SETUP}"
						@set="set"
					/>
				</tab>
				<tab id="reviewerGuidance" label="{translate key="manager.publication.reviewerGuidance"}">
					<pkp-form
						v-bind="components.{$smarty.const.FORM_REVIEW_GUIDANCE}"
						@set="set"
					/>
				</tab>
				<tab id="reviewForms" label="{translate key="manager.reviewForms"}">
					{capture assign=reviewFormsUrl}{url router=$smarty.const.ROUTE_COMPONENT component="grid.settings.reviewForms.ReviewFormGridHandler" op="fetchGrid" escape=false}{/capture}
					{load_url_in_div id="reviewFormGridContainer" url=$reviewFormsUrl}
				</tab>
				{call_hook name="Template::Settings::workflow::review"}
			</tabs>
		</tab>
		<tab id="library" label="{translate key="manager.publication.library"}">
			{help file="settings/workflow-settings" section="publisher" class="pkp_help_tab"}
			{capture assign=libraryGridUrl}{url router=$smarty.const.ROUTE_COMPONENT component="grid.settings.library.LibraryFileAdminGridHandler" op="fetchGrid" canEdit=true escape=false}{/capture}
			{load_url_in_div id="libraryGridDiv" url=$libraryGridUrl}
		</tab>
		<tab id="emails" label="{translate key="manager.publication.emails"}">
			{help file="settings/workflow-settings" section="emails" class="pkp_help_tab"}
			<tabs :track-history="true">
				<tab id="emailsSetup" label="{translate key="navigation.setup"}">
					<pkp-form
						v-bind="components.{$smarty.const.FORM_EMAIL_SETUP}"
						@set="set"
					/>
				</tab>
				<tab id="emailTemplates" label="{translate key="manager.emails.emailTemplates"}">
					<email-templates-list-panel
						v-bind="components.emailTemplates"
						@set="set"
					/>
					{capture assign=preparedEmailsGridUrl}{url router=$smarty.const.ROUTE_COMPONENT component="grid.settings.preparedEmails.preparedEmailsGridHandler" op="fetchGrid" escape=false}{/capture}
					{load_url_in_div id="preparedEmailsGridDiv" url=$preparedEmailsGridUrl}
				</tab>
				{call_hook name="Template::Settings::workflow::emails"}
			</tabs>
		</tab>
		{call_hook name="Template::Settings::workflow"}
	</tabs>
{/block}
