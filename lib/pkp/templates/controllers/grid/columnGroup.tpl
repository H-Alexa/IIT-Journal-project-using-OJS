{**
 * templates/controllers/grid/columnGroup.tpl
 *
 * Copyright (c) 2016-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Column group HTML markup for grids.
 *}

<colgroup>
	{foreach from=$columns item=column}
		{* @todo indent columns should be killed at their source *}
		{if $column->hasFlag('indent')}
			{continue}
		{/if}
		<col class="grid-column column-{$column->getId()}"
		{if $column->hasFlag('width')}
			style="width: {$column->getFlag('width')}%;"
		{/if} />
	{/foreach}
</colgroup>
