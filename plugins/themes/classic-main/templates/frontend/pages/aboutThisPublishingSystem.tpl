{**
 * templates/frontend/pages/aboutThisPublishingSystem.tpl
 *
 * Copyright (c) 2014-2020 Simon Fraser University
 * Copyright (c) 2003-2020 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @brief Display the page to view details about the OJS software.
 *
 * @uses $currentContext Journal The journal currently being viewed
 * @uses $appVersion string Current version of OJS
 * @uses $contactUrl string URL to the journal's contact page
 *}
{include file="frontend/components/header.tpl" pageTitle="about.aboutSoftware"}

<main class="page page_about_publishing_system">
	<div class="container-fluid container-page container-narrow">
		{include file="frontend/components/headings.tpl" currentTitleKey="about.aboutSoftware"}

		<p>
			{if $currentContext}
				{translate key="about.aboutOJSJournal" ojsVersion=$appVersion contactUrl=$contactUrl}
			{else}
				{translate key="about.aboutOJSSite" ojsVersion=$appVersion}
			{/if}
		</p>
	</div>
</main><!-- .page -->

{include file="frontend/components/footer.tpl"}
