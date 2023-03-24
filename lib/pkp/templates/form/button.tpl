{**
 * templates/form/button.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * form button
 *}
{strip}
<button class="pkp_button {$FBV_class}" type="{$FBV_type}" {if $FBV_disabled} disabled="disabled"{/if} {$FBV_buttonParams}>
	{if $FBV_translate}{translate key=$FBV_label}{else}{$FBV_label}{/if}
</button>
{/strip}
