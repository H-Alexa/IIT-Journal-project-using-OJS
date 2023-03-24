{**
 * plugins/generic/customBlockManager/templates/block.tpl
 *
 * Copyright (c) 2014-2020 Simon Fraser University
 * Copyright (c) 2003-2020 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Sidebar custom block.
 *
 *}
<div class="pkp_block block_custom" id="{$customBlockId|escape}">
	<h2 class="title{if !$showName} pkp_screen_reader{/if}">{$customBlockTitle}</h2>
	<div class="content">
		{$customBlockContent}
	</div>
</div>
