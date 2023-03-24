{**
 * templates/form/textInput.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * form text input
 *}

{assign var="uniqId" value="-"|concat:$FBV_uniqId|escape}
<div{if $FBV_layoutInfo} class="{$FBV_layoutInfo}"{/if}>
{if $FBV_multilingual && count($formLocales) > 1}
	<script>
	$(function() {ldelim}
		$('#{$FBV_id|escape:javascript}-localization-popover-container{$uniqId}').pkpHandler(
			'$.pkp.controllers.form.MultilingualInputHandler'
			);
	{rdelim});
	</script>
	{* This is a multilingual control. Enable popover display. *}
	<span id="{$FBV_id|escape}-localization-popover-container{$uniqId}" class="localization_popover_container">
		<input type="{if $FBV_isPassword}password{elseif $FBV_isTypeURL}url{else}text{/if}"
			{$FBV_textInputParams}
			class="localizable {if $FBV_class}{$FBV_class|escape}{/if}{if $FBV_validation} {$FBV_validation}{/if}{if $formLocale != $currentLocale} locale_{$formLocale|escape}{/if}"
			{if $FBV_disabled} disabled="disabled"{/if}
			{if $FBV_readonly} readonly="readonly"{/if}
			value="{$FBV_value[$formLocale]|escape}"
			name="{$FBV_name|escape}[{$formLocale|escape}]"
			id="{$FBV_id|escape}-{$formLocale|escape}{$uniqId}"
			{if $FBV_required} required aria-required="true"{/if}
		/>

		{$FBV_label_content}

		<div class="localization_popover">
			{foreach from=$formLocales key=thisFormLocale item=thisFormLocaleName}{if $formLocale != $thisFormLocale}
				<input	type="{if $FBV_isPassword}password{else}text{/if}"
					{$FBV_textInputParams}
					placeholder="{$thisFormLocaleName|escape}"
					class="multilingual_extra flag flag_{$thisFormLocale|escape}{if $FBV_sizeInfo} {$FBV_sizeInfo|escape}{/if}"
					{if $FBV_disabled} disabled="disabled"{/if}
					{if $FBV_readonly} readonly="readonly"{/if}
					value="{$FBV_value[$thisFormLocale]|escape}"
					name="{$FBV_name|escape}[{$thisFormLocale|escape}]"
					id="{$FBV_id|escape}-{$thisFormLocale|escape}{$uniqId}"
					{if $FBV_tabIndex} tabindex="{$FBV_tabIndex|escape}"{/if}
				/>
				<label for="{$FBV_id|escape}-{$thisFormLocale|escape}{$uniqId}" class="locale">({$thisFormLocaleName|escape})</label>
			{/if}{/foreach}
		</div>
	</span>
{else}
	{* This is not a multilingual control or there is only one locale available *}
	<input	type="{if $FBV_isPassword}password{elseif $FBV_isTypeURL}url{elseif $FBV_isTypeSearch}search{elseif $FBV_isTypeEmail}email{elseif $FBV_isTypeTel}tel{else}text{/if}"
		{$FBV_textInputParams}
		class="field text{if $FBV_class} {$FBV_class|escape}{/if}{if $FBV_validation} {$FBV_validation}{/if}"
		{if $FBV_disabled} disabled="disabled"{/if}
		{if $FBV_readonly} readonly="readonly"{/if}
		name="{$FBV_name|escape}{if $FBV_multilingual}[{$formLocale|escape}]{/if}"
		value="{if $FBV_multilingual}{$FBV_value[$formLocale]|escape}{elseif $FBV_class|strstr:"datepicker" && $FBV_value!==null}{$FBV_value|date_format:$dateFormatShort|escape}{else}{$FBV_value|escape}{/if}"
		id="{$FBV_id|escape}{$uniqId}"
		{if $FBV_tabIndex} tabindex="{$FBV_tabIndex|escape}"{/if}
		{if $FBV_required} required aria-required="true"{/if}
		{if $FBV_urlValidationErrorMessage} data-msg-url="{$FBV_urlValidationErrorMessage|escape}"{/if}
	/>

	{if $FBV_class|strstr:"datepicker"} 
		<input data-date-format="{$dateFormatShort|dateformatPHP2JQueryDatepicker}" type="hidden" 
		name="{$FBV_name|escape}"
		value="{if !empty($FBV_value)}{$FBV_value|date_format:"%Y-%m-%d"|escape}{/if}"
		id="{$FBV_id|escape}{$uniqId}-altField" />
	{/if}

	<span>{$FBV_label_content}</span>
{/if}
</div>
