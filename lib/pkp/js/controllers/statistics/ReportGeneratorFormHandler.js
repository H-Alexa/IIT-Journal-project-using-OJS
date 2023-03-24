/**
 * @defgroup js_statistics
 */
/**
 * @file js/controllers/statistics/ReportGeneratorFormHandler.js
 *
 * Copyright (c) 2013-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class ReportGeneratorFormHandler
 *
 * @brief Form handler that handles the statistics report
 * generator form.
 */
(function($) {

	/** @type {Object} */
	$.pkp.controllers.statistics = $.pkp.controllers.statistics || {};



	/**
	 * @constructor
	 *
	 * @extends $.pkp.controllers.form.AjaxFormHandler
	 *
	 * @param {jQueryObject} $form The wrapped HTML form element.
	 * @param {{
	 *  metricTypeSelectSelector: string,
	 *  reportTemplateSelectSelector: string,
	 *  aggregationOptionsSelector: string,
	 *  currentMonthSelector: string,
	 *  yesterdaySelector: string,
	 *  rangeByMonthSelector: string,
	 *  rangeByDaySelector: string,
	 *  dateRangeWrapperSelector: string,
	 *  fileTypeSelectSelector: string,
	 *  objectTypeSelectSelector: string,
	 *  regionSelectSelector: string,
	 *  countrySelectSelector: string,
	 *  optionalColumns: Object
	 *  }} options Configuration of the form handler.
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler =
			function($form, options) {
		var $objectTypeSelectElement, $countrySelectElement,
				$metricTypeSelectElement, $reportTemplateSelectElement,
				$currentTimeElements, $rangeTimeElements,
				$aggregationOptions;

		// Configure the form handler.
		options.trackFormChanges = false;
		options.transformButtons = false;
		this.parent($form, options);

		this.getHtmlElement().find(':submit').button();
		$('#reportUrlFormArea', $form).hide();

		this.timeFilterWrapperSelector_ = options.timeFilterWrapperSelector;
		this.rangeByDaySelector_ = options.rangeByDaySelector;
		this.rangeByMonthSelector_ = options.rangeByMonthSelector;
		this.startDayElementSelector_ = options.startDayElementSelector;
		this.endDayElementSelector_ = options.endDayElementSelector;
		this.optionalColumns_ = options.optionalColumns;
		this.aggregationOptionsSelector_ = options.aggregationOptionsSelector;

		// Update form when metric type is changed.
		this.fetchFormUrl_ = options.fetchFormUrl;
		$metricTypeSelectElement = $(options.metricTypeSelectSelector,
				this.getHtmlElement());
		this.$metricTypeSelectElement_ = $metricTypeSelectElement;
		if ($metricTypeSelectElement.length == 1) {
			$metricTypeSelectElement.change(this.callbackWrapper(
					this.fetchFormHandler_));
		}

		// Hide the loading container.
		$('.pkp_loading', $form).hide();

		// Update form when report template is changed.
		$reportTemplateSelectElement = $(options.reportTemplateSelectSelector,
				this.getHtmlElement());
		this.$reportTemplateSelectElement_ = $reportTemplateSelectElement;
		if ($reportTemplateSelectElement.length == 1) {
			$reportTemplateSelectElement.change(this.callbackWrapper(
					this.fetchFormHandler_));
		}

		// Update report columns when aggregation options are changed.
		this.columnsSelector_ = options.columnsSelector;
		$aggregationOptions = $(options.aggregationOptionsSelector);
		if ($aggregationOptions.length > 0) {
			$aggregationOptions.change(this.callbackWrapper(
					this.aggregationOptionsChangeHandler_));
		}

		// Add click handler to current time filter selectors.
		$currentTimeElements = $(options.currentMonthSelector,
				this.getHtmlElement()).add(options.yesterdaySelector,
				this.getHtmlElement()[0]);
		if ($currentTimeElements.length == 2) {
			$currentTimeElements.click(this.callbackWrapper(
					this.currentTimeElementsClickHandler_));
		}

		// Add click handler to range time filter selectors.
		$rangeTimeElements = $(options.rangeByMonthSelector,
				this.getHtmlElement()).add(options.rangeByDaySelector,
				this.getHtmlElement()[0]);
		if ($rangeTimeElements.length == 2) {
			$rangeTimeElements.click(this.callbackWrapper(
					this.rangeTimeElementsClickHandler_));
		}

		// Call a click event on the current selected
		// range time filter element, if any, so the event
		// handler can run and perform the necessary actions.
		this.dateRangeElementsWrapper_ = $(options.dateRangeWrapperSelector,
				this.getHtmlElement());
		if ($rangeTimeElements.filter('input:checked').length == 1) {
			$rangeTimeElements.filter('input:checked').click();
		} else {
			this.dateRangeElementsWrapper_.hide();
		}

		// Update the file type element when object type is changed.
		this.fileAssocTypes_ = options.fileAssocTypes;
		this.$fileTypeSelectElement_ = $(options.fileTypeSelectSelector,
				this.getHtmlElement());
		$objectTypeSelectElement = $(options.objectTypeSelectSelector,
				this.getHtmlElement());
		if (this.$fileTypeSelectElement_.length == 1) {
			this.$fileTypeSelectElement_.attr('disabled', 'disabled');
			$objectTypeSelectElement.change(this.callbackWrapper(
					this.updateFileTypeSelectHandler_));
		}

		// Call the change event on the object type select element,
		// so the event handler can perform the expected actions.
		$objectTypeSelectElement.change();

		// Update the region element when country is changed.
		this.fetchRegionsUrl_ = options.fetchRegionsUrl;
		this.$regionSelectElement_ = $(options.regionSelectSelector,
				this.getHtmlElement());
		if (this.$regionSelectElement_.length == 1) {
			$countrySelectElement = $(options.countrySelectSelector,
					this.getHtmlElement());
			$countrySelectElement.change(this.callbackWrapper(
					this.fetchRegionHandler_));
		}

		this.addOptionalColumnsClass_();
	};
	$.pkp.classes.Helper.inherits(
			$.pkp.controllers.statistics.ReportGeneratorFormHandler,
			$.pkp.controllers.form.AjaxFormHandler);


	//
	// Private properties
	//
	/**
	 * The fetch form url.
	 * @private
	 * @type {?string}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			fetchFormUrl_ = null;


	/**
	 * The fetch articles title and id url.
	 * @private
	 * @type {?string}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			fetchArticlesUrl_ = null;


	/**
	 * Metric type select element.
	 * @private
	 * @type {Object}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			$metricTypeSelectElement_ = {};


	/**
	 * Report template select element.
	 * @private
	 * @type {Object}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			$reportTemplateSelectElement_ = {};


	/**
	 * Region select element.
	 * @private
	 * @type {Object}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			$regionSelectElement_ = {};


	/**
	 * The fetch regions url.
	 * @private
	 * @type {?string}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			fetchRegionsUrl_ = null;


	/**
	 * File assoc types.
	 * @private
	 * @type {Object}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			$fileAssocTypes_ = {};


	/**
	 * Date filter range by day element selector.
	 * @private
	 * @type {?string}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			rangeByDaySelector_ = null;


	/**
	 * Date filter range by month element selector.
	 * @private
	 * @type {?string}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			rangeByMonthSelector_ = null;


	/**
	 * Start day filter input element selector.
	 * @private
	 * @type {?string}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			startDayElementSelector_ = null;


	/**
	 * End day filter input element selector.
	 * @private
	 * @type {?string}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			endDayElementSelector_ = null;


	/**
	 * Time filter form elements wrapper selector.
	 * @private
	 * @type {?string}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			timeFilterWrapperSelector_ = null;


	/**
	 * Columns select element selector.
	 * @private
	 * @type {?string}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			columnsSelector_ = null;


	/**
	 * Optional columns PHP constants values.
	 * @private
	 * @type {Object}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			optionalColumns_ = {};


	/**
	 * Aggregation options elements selector.
	 * @private
	 * @type {?string}
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			aggregationOptionsSelector_ = null;


	//
	// Protected extended methods.
	//
	/**
	 * @inheritDoc
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			handleResponse = function(formElement, jsonData) {
		var data = /** @type {{reportUrl: string}|boolean|undefined} */
				(this.handleJson(jsonData));
		if (data !== false && data.reportUrl !== undefined) {
			$('#reportUrlFormArea', this.getHtmlElement()).show().
					find(':input').val(data.reportUrl);

			window.location = data.reportUrl;
		}

		this.parent('handleResponse', formElement, jsonData);
		return false;
	};


	//
	// Private methods
	//
	/**
	 * Callback called by components that needs to
	 * refresh the form when changed (metric type and report
	 * template selectors).
	 * @private
	 *
	 * @param {Object} callingContext The calling element or object.
	 * @param {Event=} opt_event The triggering event (e.g. a click on
	 *  a button.
	 * @return {boolean} Should return false to stop event processing.
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			fetchFormHandler_ = function(callingContext, opt_event) {
		var $metricTypeSelectedOption, $reportTemplateSelectedOption,
				$timeFilterElements, timeFilterValues, args = {};

		// Serialize time filter values, so the form can be refreshed
		// with the same values.
		$timeFilterElements = $(this.timeFilterWrapperSelector_,
				this.getHtmlElement());
		timeFilterValues = $timeFilterElements.serializeArray();
		$.each(timeFilterValues, function(i, element) {
			args[element.name] = element.value;
		});

		// Show loading spinner.
		$('.pkp_loading', this.getHtmlElement()).show();

		$metricTypeSelectedOption = $('option:selected',
				this.$metricTypeSelectElement_);
		if ($metricTypeSelectedOption[0] !== undefined &&
				$metricTypeSelectedOption[0].value !== undefined) {
			args.metricType = $metricTypeSelectedOption[0].value;
		}

		$reportTemplateSelectedOption = $('option:selected',
				this.$reportTemplateSelectElement_);
		if ($reportTemplateSelectedOption[0] !== undefined &&
				$reportTemplateSelectedOption[0].value !== undefined) {
			args.reportTemplate = $reportTemplateSelectedOption[0].value;
		}

		args.refreshForm = true;

		$.get(this.fetchFormUrl_, args, this.callbackWrapper(
				this.handleResponse, null), 'json');

		return false;
	};


	/**
	 * Callback called after object type select is changed.
	 * @private
	 *
	 * @param {Object} callingContext The calling element or object.
	 * @param {Event=} opt_event The triggering event (e.g. a click on
	 *  a button.
	 * @return {boolean} Should return false to stop event processing.
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			updateFileTypeSelectHandler_ = function(callingContext, opt_event) {
		var $objectTypeElement, $objectTypeSelectedOptions, assocType, i;

		$objectTypeElement = $(callingContext);
		$objectTypeSelectedOptions = $('option:selected', $objectTypeElement);
		if ($objectTypeSelectedOptions.length == 1) {
			assocType = $objectTypeSelectedOptions[0].value;
			for (i in this.fileAssocTypes_) {
				if (this.fileAssocTypes_[i] == assocType) {
					this.$fileTypeSelectElement_.removeAttr('disabled');
					return false;
				}
			}
		}

		this.$fileTypeSelectElement_.attr('disabled', 'disabled');
		return false;
	};


	/**
	 * Callback called after country select is changed to fetch
	 * related region info.
	 * @private
	 *
	 * @param {Object} callingContext The calling element or object.
	 * @param {Event=} opt_event The triggering event (e.g. a click on
	 *  a button.
	 * @return {boolean} Should return false to stop event processing.
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			fetchRegionHandler_ = function(callingContext, opt_event) {
		var $countrySelectElement, $countrySelectedOptions, countryId;

		this.$regionSelectElement_.empty();

		$countrySelectElement = $(callingContext);
		$countrySelectedOptions = $('option:selected', $countrySelectElement);
		if ($countrySelectedOptions.length == 1) {
			countryId = $countrySelectedOptions[0].label;
			$.get(this.fetchRegionsUrl_, {countryId: countryId},
					this.callbackWrapper(this.updateRegionSelectCallback_, null), 'json');
		}

		return false;
	};


	/**
	 * Callback that will be activated when a request for region
	 * information returns.
	 *
	 * @private
	 *
	 * @param {Object} ajaxContext The AJAX request context.
	 * @param {Object} jsonData A parsed JSON response object.
	 * @return {boolean} Should return false to stop event processing.
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			updateRegionSelectCallback_ = function(ajaxContext, jsonData) {
		var $regionSelectElement, limit, content, i, processedJsonData;
		$regionSelectElement = this.$regionSelectElement_;

		$regionSelectElement.empty();

		processedJsonData = this.handleJson(jsonData);
		if (processedJsonData !== false) {
			content = processedJsonData.content;
			for (i = 0, limit = content.length; i < limit; i++) {
				$regionSelectElement.append(
						$('<option />').val(content[i].id).text(content[i].name));
			}
		}

		return false;
	};


	/**
	 * Callback called when current time selectors are clicked.
	 * @private
	 *
	 * @param {Object} callingContext The calling element or object.
	 * @param {Event=} opt_event The triggering event (e.g. a click on
	 *  a button.
	 * @return {boolean} Should return true to continue event processing.
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			currentTimeElementsClickHandler_ =
			function(callingContext, opt_event) {
		this.dateRangeElementsWrapper_.hide();
		return true;
	};


	/**
	 * Callback called when range time selectors are clicked.
	 * @private
	 *
	 * @param {Object} callingContext The calling element or object.
	 * @param {Event=} opt_event The triggering event (e.g. a click on
	 *  a button.
	 * @return {boolean} Should return true to continue event processing.
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			rangeTimeElementsClickHandler_ = function(callingContext, opt_event) {
		var $dayElements = $(this.startDayElementSelector_).
				add(this.endDayElementSelector_);

		this.dateRangeElementsWrapper_.show();
		if ('#' + $(callingContext).attr('id') == this.rangeByDaySelector_) {
			$dayElements.show();
		}

		if ('#' + $(callingContext).attr('id') == this.rangeByMonthSelector_) {
			$dayElements.hide();
		}

		return true;
	};


	/**
	 * Callback called when aggregation options are changed.
	 * @private
	 *
	 * @param {Object} callingContext The calling element or object.
	 * @param {Event=} opt_event The triggering event (e.g. a click on
	 *  a button.
	 * @return {boolean} Should return false to stop event processing.
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			aggregationOptionsChangeHandler_ =
			function(callingContext, opt_event) {
		var $aggregationOption, $columns, $column;
		$columns = $(this.columnsSelector_);
		$aggregationOption = $(callingContext);
		$column = $columns.find('option[value="' + $aggregationOption.
				attr('value') + '"]');

		if ($aggregationOption.is(':checked')) {
			$column.attr('selected', 'selected');
		} else {
			$column.removeAttr('selected');
		}

		return false;
	};


	/**
	 * Add optional class to elements that present optional columns
	 * information.
	 *
	 * @private
	 */
	$.pkp.controllers.statistics.ReportGeneratorFormHandler.prototype.
			addOptionalColumnsClass_ = function() {
		var columnName, optionalColumns, $columns,
				$aggregationOptions, $orderByColumns;

		$columns = $(this.columnsSelector_);
		$aggregationOptions = $(this.aggregationOptionsSelector_);
		$orderByColumns = $('#orderByFormArea select', this.getHtmlElement());
		$columns = $columns.add($orderByColumns);
		optionalColumns = this.optionalColumns_;
		for (columnName in optionalColumns) {
			$columns.find('option[value="' + columnName + '"]').
					addClass('optionalColumn');
			$aggregationOptions.filter('input[value="' + columnName + '"]').
					parent().addClass('optionalColumn');
		}
	};

}(jQuery));
