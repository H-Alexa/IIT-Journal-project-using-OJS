{**
 * templates/submission/submissionMetadataFormTitleFields.tpl
 *
 * Copyright (c) 2021 Madi Nuralin
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Submission's metadata form title fields. To be included in any form that wants to handle
 * submission metadata.
 *}
{if $formParams.submissionVersion && ($formParams.submissionVersion < $currentSubmissionVersion)}
  {assign var=readOnly value=1}
{else}
	{assign var=readOnly value=0}
{/if}
{fbvElement type="hidden" name="submissionVersion" id="submissionVersion" value=$formParams.submissionVersion}
<div class="pkp_helpers_clear">
	{if !$activeTheme->getOption('disablePrefixAndTitle')}
		{fbvFormSection for="title" title="common.prefix" inline="true" size=$fbvStyles.size.SMALL}
			{fbvElement label="common.prefixAndTitle.tip" type="text" multilingual=true name="prefix" id="prefix" value=$prefix readonly=$readOnly maxlength="32"}
		{/fbvFormSection}
	{/if}
	{fbvFormSection for="title" title="common.title" inline="true" size=$fbvStyles.size.LARGE required=true}
		{fbvElement type="text" multilingual=true name="title" id="title" value=$title readonly=$readOnly maxlength="255" required=true}
	{/fbvFormSection}
</div>
{if !$activeTheme->getOption('disableArticleSubtitle')}
	{fbvFormSection title="common.subtitle" for="subtitle"}
		{fbvElement type="text" multilingual=true name="subtitle" id="subtitle" value=$subtitle readonly=$readOnly}
	{/fbvFormSection}
{/if}
{fbvFormSection title="common.abstract" for="abstract" required=$abstractsRequired}
	{if $wordCount}
		<p class="pkp_help">{translate key="submission.abstract.wordCount.description" wordCount=$wordCount}
	{/if}
	{fbvElement type="textarea" multilingual=true name="abstract" id="abstract" value=$abstract rich="extended" readonly=$readOnly wordCount=$wordCount}
{/fbvFormSection}
