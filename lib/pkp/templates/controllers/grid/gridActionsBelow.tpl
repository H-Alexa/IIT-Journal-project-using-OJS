{**
 * templates/controllers/grid/gridActionsBelow.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Grid actions in bottom position
 *}

<ul class="actions btm">
	{foreach from=$grid->getActions($smarty.const.GRID_ACTION_POSITION_BELOW) item=action}
		<li>
			{include file="linkAction/linkAction.tpl" action=$action contextId=$gridId}
		</li>
	{/foreach}
</ul>
