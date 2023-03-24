{**
 * templates/controllers/grid/feature/infiniteScrolling.tpl
 *
 * Copyright (c) 2016-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Grid infinite scrolling markup.
 *}
{if $iterator->getCount()}
	<div class="gridPagingScrolling">
		{if $moreItemsLinkAction}
			{include file="linkAction/linkAction.tpl" action=$moreItemsLinkAction}
		{/if}
		<span class="item_count">
			{translate key="navigation.items.shownTotal" shown=$shown total=$iterator->getCount()}
		</span>
		{include file="common/loadingContainer.tpl"}
	</div>
{/if}
