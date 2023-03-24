/**
 * @file js/controllers/UrlInDivHandler.js
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class UrlInDivHandler
 * @ingroup js_controllers
 *
 * @brief "URL in div" handler
 */
(function($) {


	/**
	 * @constructor
	 *
	 * @extends $.pkp.classes.Handler
	 *
	 * @param {jQueryObject} $divElement the wrapped div element.
	 * @param {Object} options options to be passed.
	 */
	$.pkp.controllers.UrlInDivHandler = function($divElement, options) {
		this.parent($divElement, options);

		// Store the URL (e.g. for reloads)
		this.sourceUrl_ = options.sourceUrl;

		// Load the contents.
		this.reload();

		if (options.refreshOn) {
			this.bindGlobal(options.refreshOn, this.reload);
		}
	};
	$.pkp.classes.Helper.inherits(
			$.pkp.controllers.UrlInDivHandler, $.pkp.classes.Handler);


	//
	// Private properties
	//
	/**
	 * The URL to be used for data loaded into this div
	 * @private
	 * @type {?string}
	 */
	$.pkp.controllers.UrlInDivHandler.sourceUrl_ = null;


	//
	// Public Methods
	//
	/**
	 * Reload the div contents.
	 */
	$.pkp.controllers.UrlInDivHandler.prototype.reload = function() {
		$.get(this.sourceUrl_,
				this.callbackWrapper(this.handleLoadedContent_), 'json');
	};


	/**
	 * Fetches the progress bar URL.
	 * @return {?string} the source URL.
	 */
	$.pkp.controllers.UrlInDivHandler.prototype.getSourceUrl = function() {
		return this.sourceUrl_;
	};


	/**
	 * Sets the progress bar URL.
	 * @param {string} sourceUrl the new source URL.
	 */
	$.pkp.controllers.UrlInDivHandler.prototype.setSourceUrl = function(sourceUrl) {
		this.sourceUrl_ = sourceUrl;
	};


	//
	// Private Methods
	//
	/**
	 * Handle a callback after a load operation returns.
	 *
	 * @param {Object} ajaxContext The AJAX request context.
	 * @param {Object} jsonData A parsed JSON response object.
	 * @return {boolean} Message handling result.
	 * @private
	 */
	$.pkp.controllers.UrlInDivHandler.prototype.handleLoadedContent_ =
			function(ajaxContext, jsonData) {

		var handledJsonData = this.handleJson(jsonData), urlInDivHandler = this;
		if (handledJsonData.status === true) {
			if (handledJsonData.content === undefined) {
				// Request successful, but no data returned.
				// Hide this div element.
				this.getHtmlElement().hide();
			} else {
				// See bug #8237.
				if (! /msie/.test(navigator.userAgent.toLowerCase())) {
					this.getHtmlElement().hide();
					this.html(handledJsonData.content);
					this.getHtmlElement().fadeIn(400);
				} else {
					this.html(handledJsonData.content);
				}

				$(function() {
					urlInDivHandler.trigger('urlInDivLoaded',
							[urlInDivHandler.getHtmlElement().attr('id')]);
				});
			}
		} else {
			// Alert that loading failed.
			alert(handledJsonData.content);
		}

		return false;
	};


}(jQuery));
