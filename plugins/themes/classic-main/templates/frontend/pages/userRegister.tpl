{**
 * templates/frontend/pages/userRegister.tpl
 *
 * Copyright (c) 2014-2020 Simon Fraser University
 * Copyright (c) 2003-2020 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @brief User registration form.
 *
 * @uses $primaryLocale string The primary locale for this journal/press
 *}

{include file="frontend/components/header.tpl" pageTitle="user.register"}

<main class="page page_register">
	<div class="container-fluid container-page container-narrow">

		{include file="frontend/components/headings.tpl" currentTitleKey="user.register"}

		<form class="cmp_form register" id="register" method="post" action="{url op="register"}">
			{csrf}

			{if $source}
				<input type="hidden" name="source" value="{$source|escape}" />
			{/if}

			{include file="common/formErrors.tpl"}

			{include file="frontend/components/registrationForm.tpl"}

			{* When a user is registering with a specific journal *}
			{if $currentContext}

				<fieldset class="consent">
					{* Require the user to agree to the terms of the privacy policy *}
					<div class="fields">
						{if $currentContext->getData('privacyStatement')}
							<div class="custom-control custom-checkbox optin optin-privacy">
								<input type="checkbox" class="custom-control-input" id="privacyConsent" name="privacyConsent" value="1"{if $privacyConsent} checked="checked"{/if}>
								<label class="custom-control-label" for="privacyConsent">
									{capture assign="privacyUrl"}{url router=$smarty.const.ROUTE_PAGE page="about" op="privacy"}{/capture}
									{translate key="user.register.form.privacyConsent" privacyUrl=$privacyUrl}
								</label>
							</div>
						{/if}
					</div>
					{* Ask the user to opt into public email notifications *}
					<div class="fields">
						<div class="custom-control custom-checkbox optin optin-email">
							<input type="checkbox" class="custom-control-input" name="emailConsent" id="emailConsent" value="1"{if $emailConsent} checked="checked"{/if}>
							<label class="custom-control-label" for="emailConsent">
								{translate key="user.register.form.emailConsent"}
							</label>
						</div>
					</div>
				</fieldset>

				{* Allow the user to sign up as a reviewer *}
				{assign var=contextId value=$currentContext->getId()}
				{assign var=userCanRegisterReviewer value=0}
				{foreach from=$reviewerUserGroups[$contextId] item=userGroup}
					{if $userGroup->getPermitSelfRegistration()}
						{assign var=userCanRegisterReviewer value=$userCanRegisterReviewer+1}
					{/if}
				{/foreach}
				{if $userCanRegisterReviewer}
					<fieldset class="reviewer">
						{if $userCanRegisterReviewer > 1}
							<legend>
								{translate key="user.reviewerPrompt"}
							</legend>
							{capture assign="checkboxLocaleKey"}user.reviewerPrompt.userGroup{/capture}
						{else}
							{capture assign="checkboxLocaleKey"}user.reviewerPrompt.optin{/capture}
						{/if}
						<div class="fields">
							<div id="reviewerOptinGroup" class="custom-control custom-checkbox optin">
								{foreach from=$reviewerUserGroups[$contextId] item=userGroup}
									{if $userGroup->getPermitSelfRegistration()}
										{assign var="userGroupId" value=$userGroup->getId()}
										<input id="checkbox-reviewer-interests" class="custom-control-input" type="checkbox" name="reviewerGroup[{$userGroupId}]" value="1"{if in_array($userGroupId, $userGroupIds)} checked="checked"{/if}>
										<label class="custom-control-label" for="checkbox-reviewer-interests">
											{translate key=$checkboxLocaleKey userGroup=$userGroup->getLocalizedName()}
										</label>
									{/if}
								{/foreach}
							</div>

							<div id="reviewerInterests" class="reviewer_interests hidden">
								{*
								 * This container will be processed by the tag-it jQuery
								 * plugin. In order for it to work, your theme will need to
								 * load the jQuery tag-it plugin and initialize the
								 * component.
								 *
								 * Two data attributes are added which are not a default
								 * feature of the plugin. These are converted into options
								 * when the plugin is initialized on the element.
								 *
								 * See: /plugins/themes/default/js/main.js
								 *
								 * `data-field-name` represents the name used to POST the
								 * interests when the form is submitted.
								 *
								 * `data-autocomplete-url` is the URL used to request
								 * existing entries from the server.
								 *
								 * @link: http://aehlke.github.io/tag-it/
								 *}
								<div class="label">
									{translate key="user.interests"}
								</div>
								<ul id="tagitInput" class="interests tag-it" data-field-name="interests[]" data-autocomplete-url="{url|escape router=$smarty.const.ROUTE_PAGE page='user' op='getInterests'}">
									{foreach from=$interests item=interest}
										<li>{$interest|escape}</li>
									{/foreach}
								</ul>
							</div>
						</div>
					</fieldset>
				{/if}
			{/if}

			{include file="frontend/components/registrationFormContexts.tpl"}

			{* When a user is registering for no specific journal, allow them to
			   enter their reviewer interests *}
			{if !$currentContext}
				<fieldset class="reviewer_nocontext_interests">
					<legend>
						{translate key="user.register.noContextReviewerInterests"}
					</legend>
					<div class="fields">
						<div class="reviewer_nocontext_interests">
							{* See comment for .tag-it above *}
							<ul id="tagitInput" class="interests tag-it" data-field-name="interests[]" data-autocomplete-url="{url|escape router=$smarty.const.ROUTE_PAGE page='user' op='getInterests'}">
								{foreach from=$interests item=interest}
									<li>{$interest|escape}</li>
								{/foreach}
							</ul>
						</div>
					</div>
				</fieldset>

				{* Require the user to agree to the terms of the privacy policy *}
				{if $siteWidePrivacyStatement}
					<div class="fields">
						<div class="custom-control custom-checkbox optin optin-privacy">
							<input type="checkbox" class="custom-control-input" name="privacyConsent[{$smarty.const.CONTEXT_ID_NONE}]" id="privacyConsent[{$smarty.const.CONTEXT_ID_NONE}]" value="1"{if $privacyConsent[$smarty.const.CONTEXT_ID_NONE]} checked="checked"{/if}>
							<label class="custom-control-label" for="privacyConsent[{$smarty.const.CONTEXT_ID_NONE}]">
								{capture assign="privacyUrl"}{url router=$smarty.const.ROUTE_PAGE page="about" op="privacy"}{/capture}
								{translate key="user.register.form.privacyConsent" privacyUrl=$privacyUrl}
							</label>
						</div>
					</div>
				{/if}

				{* Ask the user to opt into public email notifications *}
				<div class="fields">
					<div class="custom-control custom-checkbox optin optin-email">
						<input type="checkbox" class="custom-control-input" name="emailConsent" id="emailConsent" value="1"{if $emailConsent} checked="checked"{/if}>
						<label class="custom-control-label" for="emailConsent">
							{translate key="user.register.form.emailConsent"}
						</label>
					</div>
				</div>
			{/if}

			{* recaptcha spam blocker *}
			{if $reCaptchaHtml}
				<fieldset class="recaptcha_wrapper">
					<div class="fields">
						<div class="recaptcha">
							{$reCaptchaHtml}
						</div>
					</div>
				</fieldset>
			{/if}

			<div class="buttons">
				<button class="submit btn btn-primary" type="submit">
					{translate key="user.register"}
				</button>

				{capture assign="rolesProfileUrl"}{url page="user" op="profile" path="roles"}{/capture}
				<a href="{url page="login" source=$rolesProfileUrl}" class="login btn register-button">{translate key="user.login"}</a>
			</div>
		</form>
	</div>
</main><!-- .page -->

{include file="frontend/components/footer.tpl"}
