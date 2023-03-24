{**
 * buttonRedirectLinkAction.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Attach a link action to a button that opens a confirmation dialog and
 * only clicks the button when the user confirms the dialog.
 *
 * Parameters:
 *  buttonSelector: A jQuery selector that designates the button to attach this
 *   link action to.
 *  dialogText: A translation key for the message to be displayed in the dialog.
 *}

<script>
	$(function() {ldelim}
		$('{$buttonSelector|escape:javascript}').pkpHandler(
				'$.pkp.controllers.linkAction.LinkActionHandler',
				{ldelim}
					actionRequest: '$.pkp.classes.linkAction.RedirectRequest',
					actionRequestOptions: {ldelim}
						url: {$cancelUrl|json_encode},
						name: {$cancelUrlTarget|json_encode}
					{rdelim},
			{rdelim});
	{rdelim});
</script>
