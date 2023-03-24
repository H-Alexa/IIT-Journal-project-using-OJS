{**
 * templates/addThis.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * The included template that is hooked into the front end display.
 *}
<div class="item addthis">
	<div class="value">
		<!-- AddThis Button BEGIN -->
		{if $addThisDisplayStyle == 'button'}
			<a class="addthis_button" href="//www.addthis.com/bookmark.php?v=250&amp;pubid={$addThisProfileId|escape:"url"}"><img src="//s7.addthis.com/static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0"/></a>
			<script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js#pubid={$addThisProfileId|escape:"url"}"></script>
		{elseif $addThisDisplayStyle == 'simple_button'}
			<div class="addthis_toolbox addthis_default_style ">
			<a href="//www.addthis.com/bookmark.php?v=250&amp;pubid={$addThisProfileId|escape:"url"}" class="addthis_button_compact">Share</a>
			</div>
			<script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js#pubid={$addThisProfileId|escape:"url"}"></script>
		{elseif $addThisDisplayStyle == 'large_toolbox'}
			<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
			<a class="addthis_button_preferred_1"></a>
			<a class="addthis_button_preferred_2"></a>
			<a class="addthis_button_preferred_3"></a>
			<a class="addthis_button_preferred_4"></a>
			<a class="addthis_button_compact"></a>
			<a class="addthis_counter addthis_bubble_style"></a>
			</div>
			<script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js#pubid={$addThisProfileId|escape:"url"}"></script>
		{elseif $addThisDisplayStyle == 'small_toolbox_with_share'}
			<div class="addthis_toolbox addthis_default_style ">
			<a href="//www.addthis.com/bookmark.php?v=250&amp;pubid={$addThisProfileId|escape:"url"}" class="addthis_button_compact">Share</a>
			<span class="addthis_separator">|</span>
			<a class="addthis_button_preferred_1"></a>
			<a class="addthis_button_preferred_2"></a>
			<a class="addthis_button_preferred_3"></a>
			<a class="addthis_button_preferred_4"></a>
			</div>
			<script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js#pubid={$addThisProfileId|escape:"url"}"></script>
		{elseif $addThisDisplayStyle == 'plus_one_share_counter'}
			<div class="addthis_toolbox addthis_default_style ">
			<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
			<a class="addthis_button_tweet"></a>
			<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
			<a class="addthis_counter addthis_pill_style"></a>
			</div>
			<script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js#pubid={$addThisProfileId|escape:"url"}"></script>
		{else} {* small_toolbox is default *}
			<div class="addthis_toolbox addthis_default_style ">
			<a class="addthis_button_preferred_1"></a>
			<a class="addthis_button_preferred_2"></a>
			<a class="addthis_button_preferred_3"></a>
			<a class="addthis_button_preferred_4"></a>
			<a class="addthis_button_compact"></a>
			<a class="addthis_counter addthis_bubble_style"></a>
			</div>
			<script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js#pubid={$addThisProfileId|escape:"url"}"></script>
		{/if}
		<!-- AddThis Button END -->
	</div>
</div>
