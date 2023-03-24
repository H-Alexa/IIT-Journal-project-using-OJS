/**
 * @file js/pages/header/TasksHandler.js
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class TasksHandler
 * @ingroup js_pages_index
 *
 * @brief Handler for the site header.
 *
 */
(function($) {


	/**
	 * @constructor
	 *
	 * @extends $.pkp.classes.Handler
	 *
	 * @param {jQueryObject} $tasksElement The HTML element encapsulating
	 *  the tasks.
	 * @param {{requestedPage: string,
	 *  fetchUnreadNotificationsCountUrl: string}} options Handler options.
	 */
	$.pkp.pages.header.TasksHandler =
			function($tasksElement, options) {

		this.options_ = options;
		this.parent($tasksElement, options);

		$('#notificationsToggle').click(this.callbackWrapper(
				this.appendToggleIndicator_));

		this.bind('updateUnreadNotificationsCount',
				this.fetchUnreadNotificationsCountHandler_);
	};
	$.pkp.classes.Helper.inherits(
			$.pkp.pages.header.TasksHandler,
			$.pkp.classes.Handler);


	/**
	 * Tasks handler options.
	 * @private
	 * @type {{requestedPage: string}?}
	 */
	$.pkp.pages.header.TasksHandler.prototype.options_ = null;


	//
	// Private helper methods
	//
	/**
	 * Toggle the notifications grid visibility
	 *
	 * @param {jQueryObject} callingElement The calling element.
	 *  that triggered the event.
	 * @param {Event} event The event.
	 * @private
	 */
	$.pkp.pages.header.TasksHandler.prototype.appendToggleIndicator_ =
			function(callingElement, event) {

		var $header = this.getHtmlElement(),
				$popover = $header.find('#notificationsPopover'),
				$toggle = $header.find('#notificationsToggle');

		$popover.toggle();
		$toggle.toggleClass('expandedIndicator');

		if ($toggle.hasClass('expandedIndicator')) {
			this.trigger('callWhenClickOutside', [{
				container: $header,
				callback: this.callbackWrapper(this.appendToggleIndicator_)
			}]);
			setTimeout(this.callbackWrapper(this.setPopoverSize_), 500);
		} else {
			$popover.css('height', '').css('overflow-y', '');
			if (event) {
				this.trigger('callWhenClickOutside', [{
					container: $header,
					clear: true
				}]);
			}
		}
	};


	/**
	 * Resize the popover if it is too big for the screen when opened
	 * @private
	 */
	$.pkp.pages.header.TasksHandler.prototype.setPopoverSize_ = function() {

		var $popover = this.getHtmlElement().find('#notificationsPopover'),
				maxHeight = $(window).height() - 60;

		if (maxHeight < $popover.height()) {
			$popover.height(maxHeight).css('overflow-y', 'scroll');
		}
	};


	/**
	 * Handler to kick off a request to update the unread notifications
	 * count.
	 * @param {Object} ajaxContext The AJAX request context.
	 * @param {Object} jsonData A parsed JSON response object.
	 * @private
	 */
	$.pkp.pages.header.TasksHandler.prototype.
			fetchUnreadNotificationsCountHandler_ = function(ajaxContext, jsonData) {

		$.get(this.options_.fetchUnreadNotificationsCountUrl,
				this.callbackWrapper(
				this.updateUnreadNotificationsCountHandler_), 'json');
	};


	/**
	 * Handler to update the unread notifications count upon receipt of
	 * an updated number.
	 * event.
	 * @param {Object} ajaxContext The AJAX request context.
	 * @param {Object} jsonData A parsed JSON response object.
	 * @private
	 */
	$.pkp.pages.header.TasksHandler.prototype.
			updateUnreadNotificationsCountHandler_ = function(ajaxContext, jsonData) {

		var el = this.getHtmlElement().find('#unreadNotificationCount');
		el.html(jsonData.content);

		if (jsonData.content == '0') {
			el.removeClass('hasTasks');
		} else {
			el.addClass('hasTasks');
		}
	};




}(jQuery));
