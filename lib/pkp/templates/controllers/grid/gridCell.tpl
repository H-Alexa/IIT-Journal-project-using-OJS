{**
 * templates/controllers/grid/gridCell.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * a regular grid cell (with or without actions)
 *}
{if $id}
	{assign var=cellId value="cell-"|concat:$id}
{else}
	{assign var=cellId value=""}
{/if}
<span {if $cellId}id="{$cellId|escape}" {/if}class="gridCellContainer">
	{include file="controllers/grid/gridCellContents.tpl"}
</span>

