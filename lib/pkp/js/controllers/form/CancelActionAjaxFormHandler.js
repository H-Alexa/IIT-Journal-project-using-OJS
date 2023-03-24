/**
 * @file js/controllers/form/CancelActionAjaxFormHandler.js
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class CancelActionAjaxFormHandler
 * @ingroup js_controllers_form
 *
 * @brief A Handler for controlling the Query form
 */
(function($) {


	/**
	 * @constructor
	 *
	 * @extends $.pkp.controllers.form.AjaxFormHandler
	 *
	 * @param {jQueryObject} $handledElement The clickable element
	 *  the modal will be attached to.
	 * @param {Object} options non-default Dialog options
	 *  to be passed into the dialog widget.
	 *
	 *  Options are:
	 *  - all options documented for the AjaxModalHandler.
	 *  - cancelUrl: The URL to POST to in case of cancel.
	 */
	$.pkp.controllers.form.CancelActionAjaxFormHandler =
			function($handledElement, options) {

		var formHandler = this;

		this.parent($handledElement, options);

		// Store the options.
		this.cancelUrl_ = options.cancelUrl;

		this.cancelActionHandler = function() {
			formHandler.handleCancelAction();
		};
		$(window).on('unload', this.cancelActionHandler);
	};
	$.pkp.classes.Helper.inherits($.pkp.controllers.form.
			CancelActionAjaxFormHandler, $.pkp.controllers.form.AjaxFormHandler);


	//
	// Public properties
	//
	/**
	 * Function to handle deregistration of the modal as needed
	 * @public
	 * @type {function()?}
	 */
	$.pkp.controllers.form.CancelActionAjaxFormHandler.
			prototype.cancelActionHandler = null;


	//
	// Private properties
	//
	/**
	 * The URL to be called when a cancel event occurs.
	 * @private
	 * @type {string?}
	 */
	$.pkp.controllers.form.CancelActionAjaxFormHandler.
			prototype.cancelUrl_ = null;


	/**
	 * True iff the form is complete (i.e. a normal "Save" action is in progress).
	 * @private
	 * @type {boolean}
	 */
	$.pkp.controllers.form.CancelActionAjaxFormHandler.
			prototype.isComplete_ = false;


	/**
	 * @inheritDoc
	 */
	$.pkp.controllers.form.CancelActionAjaxFormHandler.prototype.
			containerCloseHandler = function(input, event) {

		this.handleCancelAction();

		return /** @type {boolean} */ (
				this.parent('containerCloseHandler', input, event));
	};


	/**
	 * @inheritDoc
	 */
	$.pkp.controllers.form.CancelActionAjaxFormHandler.prototype.
			submitForm = function(validator, formElement) {

		// Flag the form as complete.
		this.isComplete_ = true;
		this.parent('submitForm', validator, formElement);
	};


	/**
	 * Cancel the form if necessary.
	 */
	$.pkp.controllers.form.CancelActionAjaxFormHandler.prototype.
			handleCancelAction = function() {

		// Unregister the window unload listener
		if (this.cancelActionHandler !== null) {
			$(window).off('unload', this.cancelActionHandler);
			this.cancelActionHandler = null;
		}

		// If the form wasn't completed, post a cancel.
		if (!this.isComplete_ && this.cancelUrl_ !== null) {
			$.post(this.cancelUrl_);
		}
	};

}(jQuery));
