{**
 * templates/workflow/reviewHistory.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Review history for a particular review assignment.
 *}
<div class="pkp_review_history">
	{foreach from=$dates key="localeKey" item="date"}
		{if $date}
		<div>
			<strong>{$date|date_format:$datetimeFormatShort}</strong>
			{translate key=$localeKey}
		</div>
		{/if}
	{/foreach}
</div>
