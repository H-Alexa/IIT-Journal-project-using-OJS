{**
 * linkActionButton.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Template that renders a button for a link action.
 *
 * Parameter:
 *  action: The LinkAction we create a button for.
 *  buttonId: The id of the link.
 *  hoverTitle: Whether to show the title as hover text only.
 *  anyhtml: True iff the link action text permits all HTML (i.e. escaping handled elsewhere).
 *}
<a href="#" id="{$buttonId|escape}"{if $action->getToolTip()} title="{$action->getToolTip()|escape}"{/if} class="pkp_controllers_linkAction pkp_linkaction_{$action->getId()} pkp_linkaction_icon_{$action->getImage()}">{if $anyhtml}{$action->getTitle()}{else}{$action->getTitle()|strip_unsafe_html}{/if}</a>
