<?php

/**
 * @defgroup FormBuilderVocabulary Form Builder Vocabulary
 * Implements a form construction toolkit for generating standard form markup.
 */

/**
 * @file classes/form/FormBuilderVocabulary.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class Fbv
 * @ingroup core
 *
 * @brief Class defining Form Builder Vocabulary methods.
 *
 * Form Builder Vocabulary - FBV
 * Generates form markup in templates using {fbvX} calls.
 * Group form areas with the {fbvFormArea} call.  These sections mark off groups of semantically
 *  related form sections.
 *  Parameters:
 *   id: The form area ID
 *   class (optional): Any additional classes
 *   title (optional): Title of the area
 * Group form sections with the {fbvFormSection} call.  These sections organize directly related form elements.
 *  Parameters:
 *   id: The section ID
 *   class (optional): Any additional classes
 *   title (optional): Title of the area
 * Form submit/cancel buttons should be created with {fbvFormButtons}
 *  Parameters:
 *   submitText (optional): Text to display for the submit link (default is 'Ok')
 *   submitDisabled (optional): Whether the submit button should be disabled
 *   confirmSubmit (optional): Text to display in a confirmation dialog that must be okayed
 * 		before the form is submitted
 *   cancelText (optional): Text to display for the cancel link (default is 'Cancel')
 *   hideCancel (optional): Whether the submit button should be disabled
 *   cancelAction (optional): A LinkAction object to execute when cancel is clicked
 *   cancelUrl (optional): URL to redirect to when cancel is clicked
 * Form elements are created with {fbvElement type="type"} plus any additional parameters.
 * Each specific element type may have other additional attributes (see their method comments)
 *  Parameters:
 *   type: The form element type (one of the cases in the smartyFBVElement method)
 *   id: The element ID
 *   class (optional): Any additional classes
 *   required (optional) whether the section should have a 'required' label (adds span.required)
 *   for (optional): What the section's label is for
 *   inline: Adds .inline to the element's parent container and causes it to display inline with other elements
 *   size: One of $fbvStyles.size.SMALL (adds .quarter to element's parent container) or $fbvStyles.size.MEDIUM (adds
 *    .half to element's parentcontainer)
 *   required: Adds an asterisk and a .required class to the element's label
 */

class FormBuilderVocabulary {
	/** Form associated with this object, if any.  Will inform smarty which forms to label as required **/
	var $_form;

	/** Styles organized by parameter name */
	var $_fbvStyles;

	/**
	 * Constructor.
	 * @param $form object Form associated with this object
	 */
	function __construct($form = null) {
		$this->_fbvStyles = array(
			'size' => array('SMALL' => 'SMALL', 'MEDIUM' => 'MEDIUM', 'LARGE' => 'LARGE'),
			'height' => array('SHORT' => 'SHORT', 'MEDIUM' => 'MEDIUM', 'TALL' => 'TALL')
		);
	}


	//
	// Setters and Getters
	//
	/**
	 * Set the form
	 * @param $form object
	 */
	function setForm($form) {
		if ($form) assert(is_a($form, 'Form'));
		$this->_form = $form;
	}

	/**
	 * Get the form
	 * @return Object
	 */
	function getForm() {
		return $this->_form;
	}

	/**
	 * Get the form style constants
	 * @return array
	 */
	function getStyles() {
		return $this->_fbvStyles;
	}


	//
	// Public Methods
	//
	/**
	 * A form area that contains form sections.
	 * @param $params array
	 * @param $content string
	 * @param $smarty object
	 * @param $repeat
	 */
	function smartyFBVFormArea($params, $content, $smarty, &$repeat) {
		assert(isset($params['id']));
		if (!$repeat) {
			$smarty->assign(array(
				'FBV_class' => isset($params['class']) ? $params['class'] : null,
				'FBV_id' => $params['id'],
				'FBV_content' => isset($content) ? $content : null,
				'FBV_translate' => isset($params['translate']) ? $params['translate'] : true,
				'FBV_title' => isset($params['title']) ? $params['title'] : null,
			));
			return $smarty->fetch('form/formArea.tpl');
		}
		return '';
	}

	/**
	 * A form section that contains controls in a variety of layout possibilities.
	 * @param $params array
	 * @param $content string
	 * @param $smarty object
	 * @param $repeat
	 */
	function smartyFBVFormSection($params, $content, $smarty, &$repeat) {
		$form = $this->getForm();
		if (!$repeat) {
			$smarty->assign('FBV_required', isset($params['required']) ? $params['required'] : false);
			$smarty->assign('FBV_id', isset($params['id']) ? $params['id'] : null);

			// Since $content will contain input fields that may have unique Ids appended, the 'for'
			// attribute on the form section's label needs to include this.  Look for the assigned
			// form element within $content and extract the full id.  Default to the passed in param
			// otherwise.
			if (!empty($params['for'])) {
				if (preg_match('/id="(' . preg_quote($params['for'], '/') . '\-[^"]+)"/', $content, $matches)) {
					$smarty->assign('FBV_labelFor', $matches[1]);
				} else {
					$smarty->assign('FBV_labelFor', $params['for']);
				}
			} else {
				$smarty->assign('FBV_labelFor', null);
			}
			$smarty->assign(array(
				'FBV_title' => isset($params['title']) ? $params['title'] : null,
				'FBV_label' => isset($params['label']) ? $params['label'] : null,
				'FBV_layoutInfo' => $this->_getLayoutInfo($params),
				'FBV_description' => isset($params['description']) ? $params['description'] : null,
				'FBV_content' => isset($content) ? $content: null,
				'FBV_translate' => isset($params['translate']) ? $params['translate'] : true,
			));

			$class = $params['class'] ?? null;

			// Check if we are using the Form class and if there are any errors
			if (isset($form) && !empty($form->formSectionErrors)) {
				$class = $class . (empty($class) ? '' : ' ') . 'error';
				$smarty->assign('FBV_sectionErrors', $form->formSectionErrors);
				$form->formSectionErrors = array();
			} else $smarty->assign('FBV_sectionErrors', null);

			// If we are displaying checkboxes or radio options, we'll need to use a
			//  list to organize our elements -- Otherwise we use divs and spans
			if (isset($params['list']) && $params['list'] != false) {
				$smarty->assign('FBV_listSection', true);
			} else {
				// Double check that we don't have lists in the content.
				//  This is a kludge but the only way to make sure we've
				//  set the list parameter when we're using lists
				if (substr(trim($content), 0, 4) == "<li>") {
					throw new Exception('FBV: list attribute not set on form section containing lists');
				}

				$smarty->assign('FBV_listSection', false);
			}

			$smarty->assign('FBV_class', $class);
			$smarty->assign('FBV_layoutColumns', empty($params['layout']) ? false : true);

			return $smarty->fetch('form/formSection.tpl');
		} else {
			if (isset($form)) $form->formSectionErrors = array();
		}
		return '';
	}

	/**
	 * Submit and (optional) cancel button for a form.
	 * @param $params array
	 * @param $smarty object
	 * @param $repeat
	 */
	function smartyFBVFormButtons($params, $smarty) {
		$smarty->assign(array(
			'FBV_submitText' => isset($params['submitText']) ? $params['submitText'] : 'common.ok',
			'FBV_submitDisabled' => isset($params['submitDisabled']) ? (boolean)$params['submitDisabled'] : false,
			'FBV_confirmSubmit' => isset($params['confirmSubmit']) ? $params['confirmSubmit'] : null,
			'FBV_cancelText' => isset($params['cancelText']) ? $params['cancelText'] : 'common.cancel',
			'FBV_hideCancel' => isset($params['hideCancel']) ? (boolean)$params['hideCancel'] : false,
			'FBV_cancelAction' => isset($params['cancelAction']) ? $params['cancelAction'] : null,
			'FBV_cancelUrl' => isset($params['cancelUrl']) ? $params['cancelUrl'] : null,
			'FBV_cancelUrlTarget' => isset($params['cancelUrlTarget']) ? $params['cancelUrlTarget'] : '',
			'FBV_translate' => isset($params['translate']) ? $params['translate'] : true,
			'FBV_saveText' => isset($params['saveText']) ? $params['saveText'] : null,
		));
		return $smarty->fetch('form/formButtons.tpl');
	}

	/**
	 * Base form element.
	 * @param $params array
	 * @param $smarty object-
	 */
	function smartyFBVElement($params, $smarty, $content = null) {
		if (!isset($params['type'])) throw new Exception('FBV: Element type not set');
		if (!isset($params['id'])) throw new Exception('FBV: Element ID not set');

		// Set up the element template
		$smarty->assign(array(
			'FBV_id' => $params['id'],
			'FBV_class' => isset($params['class']) ? $params['class'] : null,
			'FBV_required' => isset($params['required']) ? $params['required'] : false,
			'FBV_layoutInfo' => $this->_getLayoutInfo($params),
			'FBV_label' => isset($params['label']) ? $params['label'] : null,
			'FBV_for' => isset($params['for']) ? $params['for'] : null,
			'FBV_tabIndex' => isset($params['tabIndex']) ? $params['tabIndex'] : null,
			'FBV_translate' => isset($params['translate']) ? $params['translate'] : true,
			'FBV_keepLabelHtml' => isset($params['keepLabelHtml']) ? $params['keepLabelHtml'] : false,
		));

		// Unset these parameters so they don't get assigned twice
		unset($params['class']);

		// Find fields that the form class has marked as required and add the 'required' class to them
		$params = $this->_addClientSideValidation($params);
		$smarty->assign('FBV_validation', isset($params['validation']) ? $params['validation'] : null);

		// Set up the specific field's template
		switch (strtolower_codesafe($params['type'])) {
			case 'autocomplete':
				$content = $this->_smartyFBVAutocompleteInput($params, $smarty);
				break;
			case 'button':
			case 'submit':
				$content = $this->_smartyFBVButton($params, $smarty);
				break;
			case 'checkbox':
				$content = $this->_smartyFBVCheckbox($params, $smarty);
				unset($params['label']);
				break;
			case 'checkboxgroup':
				$content = $this->_smartyFBVCheckboxGroup($params, $smarty);
				unset($params['label']);
				break;
			case 'file':
				$content = $this->_smartyFBVFileInput($params, $smarty);
				break;
			case 'hidden':
				$content = $this->_smartyFBVHiddenInput($params, $smarty);
				break;
			case 'keyword':
				$content = $this->_smartyFBVKeywordInput($params, $smarty);
				break;
			case 'interests':
				$content = $this->_smartyFBVInterestsInput($params, $smarty);
				break;
			case 'radio':
				$content = $this->_smartyFBVRadioButton($params, $smarty);
				unset($params['label']);
				break;
			case 'email':
			case 'search':
			case 'tel':
			case 'text':
			case 'url':
				$content = $this->_smartyFBVTextInput($params, $smarty);
				break;
			case 'select':
				$content = $this->_smartyFBVSelect($params, $smarty);
				break;
			case 'textarea':
				$content = $this->_smartyFBVTextArea($params, $smarty);
				break;
			default: assert(false);
		}

		unset($params['type']);

		return $content;
	}

	//
	// Private methods
	//

	/**
	 * Form button.
	 * parameters: label (or value), disabled (optional), type (optional)
	 * @param $params array
	 * @param $smarty object
	 */
	function _smartyFBVButton($params, $smarty) {
		// the type of this button. the default value is 'button' (but could be 'submit')

		$buttonParams = '';
		$smarty->assign(array('FBV_label' => null, 'FBV_disabled' => false));
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'inline':
				case 'translate':
					break;
				case 'label':
				case 'type':
				case 'disabled':
					$smarty->assign('FBV_' . $key, $value);
					break;
				default: $buttonParams .= htmlspecialchars($key, ENT_QUOTES, LOCALE_ENCODING) . '="' . htmlspecialchars($value, ENT_QUOTES, LOCALE_ENCODING) . '" ';
			}
		}

		$smarty->assign('FBV_buttonParams', $buttonParams);

		return $smarty->fetch('form/button.tpl');
	}

	/**
	 * Form Autocomplete text input. (actually two inputs, label and value)
	 * parameters: disabled (optional), name (optional - assigned value of 'id' by default)
	 * @param $params array
	 * @param $smarty object
	 */
	function _smartyFBVAutocompleteInput($params, $smarty) {
		assert(isset($params['autocompleteUrl']) && isset($params['id']));

		// This id will be used for the hidden input that should be read by the Form.
		$autocompleteId = $params['id'];

		// We then override the id parameter to differentiate it from the hidden element
		//  and make sure that the text input is not read by the Form class.
		$params['id'] = $autocompleteId . '_input';

		// We set this now, so that we unset the param for the text input.
		$smarty->assign(array(
			'FBV_autocompleteUrl' => $params['autocompleteUrl'],
			'FBV_autocompleteValue' => isset($params['autocompleteValue']) ? $params['autocompleteValue'] : null,
			'FBV_disableSync' => isset($params['disableSync']) ? true : null,
		));

		unset($params['autocompleteUrl'], $params['autocompleteValue']);

		$smarty->assign(array(
			'FBV_textInput' => $this->_smartyFBVTextInput($params, $smarty),
			'FBV_id' => $autocompleteId,
		));

		return $smarty->fetch('form/autocompleteInput.tpl');
	}

	/**
	 * Form text input.
	 * parameters: disabled (optional), name (optional - assigned value of 'id' by default), multilingual (optional)
	 * @param $params array
	 * @param $smarty object
	 */
	function _smartyFBVTextInput($params, $smarty) {
		$params['name'] = isset($params['name']) ? $params['name'] : $params['id'];
		$params['subLabelTranslate'] = isset($params['subLabelTranslate']) ? (boolean) $params['subLabelTranslate'] : true;
		$params['uniqId'] = uniqid();

		$textInputParams = '';
		$smarty->assign(array(
			'FBV_isPassword' => isset($params['password']) ? true : false,
			'FBV_isTypeURL' => $params['type'] === 'url' ? true : false,
			'FBV_isTypeSearch' => $params['type'] === 'search' ? true : false,
			'FBV_isTypeEmail' => $params['type'] === 'email' ? true : false,
			'FBV_isTypeTel' => $params['type'] === 'tel' ? true : false,
			'FBV_disabled' => false,
			'FBV_readonly' => false,
			'FBV_multilingual' => false,
			'FBV_name' => null,
			'FBV_value' => null,
			'FBV_label_content' => null,
			'FBV_uniqId' => null,
			'FBV_urlValidationErrorMessage' => null,
		));
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'label': 
					$smarty->assign('FBV_label_content', $this->_smartyFBVSubLabel($params, $smarty)); 
				break;
				case 'type':
				case 'size':
				case 'inline': 
				case 'subLabelTranslate':
					break;
				case 'urlValidationErrorMsg':
					if ($params['type'] === 'url') {
						$smarty->assign('FBV_urlValidationErrorMessage', __($value));
					}
					break;
				case 'placeholder': 
					$textInputParams .= 'placeholder="' . htmlspecialchars(__($value), ENT_QUOTES, LOCALE_ENCODING) . '" '; 
				break;
				case 'disabled':
				case 'readonly':
				case 'multilingual':
				case 'name':
				case 'id':
				case 'value':
				case 'uniqId':
					$smarty->assign('FBV_' . $key, $value); break;
				case 'required': 
					if ($value) $textInputParams .= 'required="' . htmlspecialchars($value, ENT_QUOTES, LOCALE_ENCODING) . '"'; 
				break;
				default: 
					$textInputParams .= htmlspecialchars($key, ENT_QUOTES, LOCALE_ENCODING) . '="' . htmlspecialchars($value, ENT_QUOTES, LOCALE_ENCODING). '" ';
			}
		}

		$smarty->assign('FBV_textInputParams', $textInputParams);

		return $smarty->fetch('form/textInput.tpl');
	}

	/**
	 * Form text area.
	 * parameters:
	 *  - value: string for single language inputs, array (xx_YY => language_value) for multilingual
	 *  - name: string (optional - assigned value based on ID by default)
	 *  - disabled: boolean (default false)
	 *  - multilingual: boolean (default false)
	 *  - rich: false (default), true, or 'extended'
	 * @param $params array
	 * @param $smarty object
	 */
	function _smartyFBVTextArea($params, $smarty) {
		$params['name'] = isset($params['name']) ? $params['name'] : $params['id'];
		$params['rows'] = isset($params['rows']) ? $params['rows'] : 10;
		$params['cols'] = isset($params['cols']) ? $params['cols'] : 80;
		$params['subLabelTranslate'] = isset($params['subLabelTranslate']) ? (boolean) $params['subLabelTranslate'] : true;
		$params['uniqId'] = uniqid();

		$textAreaParams = '';
		$smarty->assign(array(
			'FBV_label_content' => null,
			'FBV_disabled' => false,
			'FBV_readonly' => false,
			'FBV_multilingual' => false,
			'FBV_value' => null,
			'FBV_height' => null,
			'FBV_rich' => false,
			'FBV_variables' => null,
			'FBV_variablesType' => null,
		));
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'name':
				case 'value':
				case 'rows':
				case 'cols':
				case 'rich':
				case 'disabled':
				case 'readonly':
				case 'multilingual':
				case 'uniqId':
				case 'variablesType':
				case 'variables':
				case 'required':
					$smarty->assign('FBV_' . $key, $value);
					break;
				case 'label': $smarty->assign('FBV_label_content', $this->_smartyFBVSubLabel($params, $smarty)); break;
				case 'type': break;
				case 'size': break;
				case 'inline': break;
				case 'subLabelTranslate': break;
				case 'height':
					$styles = $this->getStyles();
					switch($value) {
						case $styles['height']['SHORT']: $smarty->assign('FBV_height', 'short'); break;
						case $styles['height']['MEDIUM']: $smarty->assign('FBV_height', 'medium'); break;
						case $styles['height']['TALL']: $smarty->assign('FBV_height', 'tall'); break;
						default:
							throw new Exception('FBV: invalid height specified for textarea.');
					}
					break;
				case 'id': break; // if we don't do this, the textarea ends up with two id attributes because FBV_id is also set.
				default: $textAreaParams .= htmlspecialchars($key, ENT_QUOTES, LOCALE_ENCODING) . '="' . htmlspecialchars($value, ENT_QUOTES, LOCALE_ENCODING) . '" ';
			}
		}

		$smarty->assign('FBV_textAreaParams', $textAreaParams);

		return $smarty->fetch('form/textarea.tpl');
	}

	/**
	 * Hidden input element.
	 * parameters: value, id, name (optional - assigned value of 'id' by default), disabled (optional), multilingual (optional)
	 * @param $params array
	 * @param $smarty object
	 */
	function _smartyFBVHiddenInput($params, $smarty) {
		$params['name'] = isset($params['name']) ? $params['name'] : $params['id'];

		$hiddenInputParams = '';
		$smarty->assign(array('FBV_id' => null, 'FBV_value' => null));
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'name':
				case 'id':
				case 'value':
					$smarty->assign('FBV_' . $key, $value);
					break;
				case 'label': break;
				case 'type': break;
				default: $hiddenInputParams .= htmlspecialchars($key, ENT_QUOTES, LOCALE_ENCODING) . '="' . htmlspecialchars($value, ENT_QUOTES, LOCALE_ENCODING) . '" ';
			}
		}

		$smarty->assign('FBV_hiddenInputParams', $hiddenInputParams);

		return $smarty->fetch('form/hiddenInput.tpl');
	}

	/**
	 * Form select control.
	 * parameters: from [array], selected [array index], defaultLabel (optional), defaultValue (optional), disabled (optional),
	 * 	translate (optional), name (optional - value of 'id' by default)
	 * @param $params array
	 * @param $smarty object
	 */
	function _smartyFBVSelect($params, $smarty) {
		$params['name'] = isset($params['name']) ? $params['name'] : $params['id'];
		$params['translate'] = isset($params['translate']) ? $params['translate'] : true;
		$params['subLabelTranslate'] = isset($params['subLabelTranslate']) ? (boolean) $params['subLabelTranslate'] : true;

		$selectParams = '';

		$smarty->assign(array(
			'FBV_label' => null,
			'FBV_from' => null,
			'FBV_selected' => null,
			'FBV_label_content' => null,
			'FBV_defaultValue' => null,
			'FBV_defaultLabel' => null,
			'FBV_required' => false,
			'FBV_disabled' => false,
		));
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'from':
				case 'selected':
				case 'translate':
				case 'defaultValue':
				case 'defaultLabel':
				case 'disabled':
				case 'required':
					$smarty->assign('FBV_' . $key, $value);
					break;
				case 'type':
				case 'inline':
				case 'size':
					break;
				case 'subLabelTranslate': break;
				case 'label': $smarty->assign('FBV_label_content', $this->_smartyFBVSubLabel($params, $smarty)); break;
				default: $selectParams .= htmlspecialchars($key, ENT_QUOTES, LOCALE_ENCODING) . '="' . htmlspecialchars($value, ENT_QUOTES, LOCALE_ENCODING) . '" ';
			}
		}

		$smarty->assign('FBV_selectParams', $selectParams);

		return $smarty->fetch('form/select.tpl');
	}

	/**
	 * Form checkbox group control.
	 * parameters: from [array], selected [array index], defaultLabel (optional), defaultValue (optional), disabled (optional),
	 * 	translate (optional), name (optional - value of 'id' by default)
	 * @param $params array
	 * @param $smarty object
	 */
	function _smartyFBVCheckboxGroup($params, $smarty) {
		$params['name'] = isset($params['name']) ? $params['name'] : $params['id'];
		$params['translate'] = isset($params['translate']) ? (boolean)$params['translate'] : true;
		$params['subLabelTranslate'] = isset($params['subLabelTranslate']) ? (boolean) $params['subLabelTranslate'] : true;
		$checkboxParams = '';

		$smarty->assign(array('FBV_from' => null, 'FBV_selected' => false, 'FBV_label_content' => null, 'FBV_defaultValue' => null, 'FBV_defaultLabel' => null));
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'from':
				case 'selected':
				case 'defaultValue':
				case 'defaultLabel':
				case 'translate':
				case 'name':
				case 'validation':
				case 'disabled':
					$smarty->assign('FBV_' . $key, $value);
					break;
				case 'type': break;
				case 'inline': break;
				case 'subLabelTranslate': break;
				default: $checkboxParams .= htmlspecialchars($key, ENT_QUOTES, LOCALE_ENCODING) . '="' . htmlspecialchars($value, ENT_QUOTES, LOCALE_ENCODING) . '" ';
			}
		}

		$smarty->assign('FBV_checkboxParams', $checkboxParams);

		return $smarty->fetch('form/checkboxGroup.tpl');
	}

	/**
	 * Checkbox input control.
	 * parameters: label, disabled (optional), translate (optional), name (optional - value of 'id' by default)
	 * @param $params array
	 * @param $smarty object
	 */
	function _smartyFBVCheckbox($params, $smarty) {
		$params['name'] = isset($params['name']) ? $params['name'] : $params['id'];
		$params['translate'] = isset($params['translate']) ? (boolean)$params['translate'] : true;

		$checkboxParams = '';
		$smarty->assign(array('FBV_id' => null, 'FBV_label' => null, 'FBV_checked' => false, 'FBV_disabled' => false));
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'type': break;
				case 'id':
				case 'label':
				case 'translate':
				case 'checked':
				case 'disabled':
					$smarty->assign('FBV_' . $key, $value);
					break;
				default: $checkboxParams .= htmlspecialchars($key, ENT_QUOTES, LOCALE_ENCODING) . '="' . htmlspecialchars($value, ENT_QUOTES, LOCALE_ENCODING) . '" ';
			}
		}

		$smarty->assign('FBV_checkboxParams', $checkboxParams);

		return $smarty->fetch('form/checkbox.tpl');
	}

	/**
	 * Radio input control.
	 * parameters: label, disabled (optional), translate (optional), name (optional - value of 'id' by default)
	 * @param $params array
	 * @param $smarty object
	 */
	function _smartyFBVRadioButton($params, $smarty) {
		$params['name'] = isset($params['name']) ? $params['name'] : $params['id'];
		$params['translate'] = isset($params['translate']) ? $params['translate'] : true;

		if (isset($params['label']) && isset($params['content'])) {
			throw new Exception('FBV: radio button cannot have both a content and a label parameter.  Label has precedence.');
		}

		$radioParams = '';
		$smarty->assign(array('FBV_id' => null, 'FBV_label' => null, 'FBV_content' => null, 'FBV_checked' => false, 'FBV_disabled' => false));
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'type': break;
				case 'id':
				case 'label':
				case 'translate':
				case 'checked':
				case 'disabled':
				case 'content':
					$smarty->assign('FBV_' . $key, $value);
					break;
				default: $radioParams .= htmlspecialchars($key, ENT_QUOTES, LOCALE_ENCODING) . '="' . htmlspecialchars($value, ENT_QUOTES, LOCALE_ENCODING) . '" ';
			}
		}

		$smarty->assign('FBV_radioParams', $radioParams);

		return $smarty->fetch('form/radioButton.tpl');
	}

	/**
	 * File upload input.
	 * parameters: submit (optional - name of submit button to include), disabled (optional), name (optional - value of 'id' by default)
	 * @param $params array
	 * @param $smarty object
	 */
	function _smartyFBVFileInput($params, $smarty) {
		$params['name'] = isset($params['name']) ? $params['name'] : $params['id'];
		$params['translate'] = isset($params['translate']) ? $params['translate'] : true;

		$smarty->assign(array('FBV_id' => null, 'FBV_label_content' => null, 'FBV_checked' => false, 'FBV_disabled' => false, 'FBV_submit' => null));
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'type': break;
				case 'id':
				case 'submit':
				case 'name':
				case 'disabled':
					$smarty->assign('FBV_' . $key, $value);
					break;
				case 'label': $smarty->assign('FBV_label_content', $this->_smartyFBVSubLabel($params, $smarty)); break;
			}
		}

		return $smarty->fetch('form/fileInput.tpl');
	}

	/**
	 * Keyword input.
	 * parameters: available - all available keywords (for autosuggest); current - user's current keywords
	 * @param $params array
	 * @param $smarty object
	 */
	function _smartyFBVKeywordInput($params, $smarty) {
		$params['uniqId'] = uniqid();

		$smarty->assign(array('FBV_id' => null, 'FBV_label' => null, 'FBV_label_content' => null, 'FBV_currentKeywords' => null, 'FBV_multilingual' => false, 'FBV_sourceUrl' => null, 'FBV_disabled' => false));
		$emptyFormLocaleMap = array_fill_keys(array_keys($smarty->getTemplateVars('formLocales')), array());
		$smarty->assign('FBV_availableKeywords', $emptyFormLocaleMap);
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'type': break;
				case 'id':
				case 'uniqId':
				case 'disabled':
				case 'multilingual':
					$smarty->assign('FBV_' . $key, $value);
					break;
				case 'label': $smarty->assign('FBV_label_content', $this->_smartyFBVSubLabel($params, $smarty)); break;
				case 'available': $smarty->assign(
					'FBV_availableKeywords',
					$thing = array_merge(
						$emptyFormLocaleMap,
						$value
					)
				); break;
				case 'current': $smarty->assign('FBV_currentKeywords', $value); break;
				case 'sourceUrl': $smarty->assign('FBV_sourceUrl', $value); break;
			}
		}

		return $smarty->fetch('form/keywordInput.tpl');
	}

	/**
	 * Reviewing interests input.
	 * parameters: interests - current users's keywords (array)
	 * @param $params array
	 * @param $smarty object
	 */
	function _smartyFBVInterestsInput($params, $smarty) {
		$smarty->assign(array('FBV_id' => null, 'FBV_label' => null, 'FBV_label_content' => null, 'FBV_interests' => null));
		$params['subLabelTranslate'] = isset($params['subLabelTranslate']) ? (boolean) $params['subLabelTranslate'] : true;
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'type': break;
				case 'id':
				case 'interests':
					$smarty->assign('FBV_' . $key, $value);
					break;
				case 'label': $smarty->assign('FBV_label_content', $this->_smartyFBVSubLabel($params, $smarty)); break;
			}
		}

		return $smarty->fetch('form/interestsInput.tpl');
	}

	/**
	 * Custom Smarty function for labelling/highlighting of form fields.
	 * @param $params array can contain 'name' (field name/ID), 'required' (required field), 'key' (localization key), 'label' (non-localized label string), 'suppressId' (boolean)
	 * @param $smarty Smarty
	 */
	function _smartyFBVSubLabel($params, $smarty) {
		assert(isset($params['label']));

		$returner = '';

		$smarty->assign(array('FBV_suppressId' => null, 'FBV_label' => null, 'FBV_required' => false, 'FBV_uniqId' => null, 'FBV_multilingual' => false, 'FBV_required' => false));
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'subLabelTranslate': $smarty->assign('FBV_subLabelTranslate', $value); break;
				case 'label':
				case 'uniqId':
				case 'multilingual':
				case 'suppressId':
				case 'required':
					$smarty->assign('FBV_' . $key, $value);
					break;
			}
		}

		$form = $this->getForm();
		if (isset($form) && isset($form->errorFields[$params['name']])) {
			$smarty->assign('FBV_error', true);
			$errors = $form->getErrorsArray();
			$smarty->assign('FBV_subLabelTranslate', false);
			$smarty->assign('FBV_label', $errors[$params['name']]);
		} else {
			$smarty->assign('FBV_error', false);
		}

		$returner = $smarty->fetch('form/subLabel.tpl');

		return $returner;
	}

	/**
	 * Assign the appropriate class name to the element for client-side validation
	 * @param $params array
	 * return array
	 */
	function _addClientSideValidation($params) {
		$form = $this->getForm();
		if (isset($form)) {
			// Assign the appropriate class name to the element for client-side validation
			$fieldId = $params['id'];
			if (isset($form->cssValidation[$fieldId])) {
				$params['validation'] = implode(' ', $form->cssValidation[$fieldId]);
			}
		}
		return $params;
	}

	/**
	 * Cycle through layout parameters to add the appropriate classes to the element's parent container
	 * @param $params array
	 * @return string
	 */
	function _getLayoutInfo($params) {
		$classes = array();
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'size':
					switch($value) {
						case 'SMALL': $classes[] = 'pkp_helpers_quarter'; break;
						case 'MEDIUM': $classes[] = 'pkp_helpers_half'; break;
						CASE 'LARGE': $classes[] = 'pkp_helpers_threeQuarter'; break;
					}
					break;
				case 'inline':
					if($value) $classes[] = 'inline'; break;
			}
		}
		if(!empty($classes)) {
			return implode(' ', $classes);
		} else return null;
	}


	/**
	 * Custom Smarty function for labelling/highlighting of form fields.
	 * @param $params array can contain 'name' (field name/ID), 'required' (required field), 'key' (localization key), 'label' (non-localized label string), 'suppressId' (boolean)
	 * @param $smarty Smarty
	 */
	function smartyFieldLabel($params, $smarty) {
		$returner = '';
		if (isset($params) && !empty($params)) {
			if (isset($params['key'])) {
				$params['label'] = __($params['key'], $params);
			}

			$form = $this->getForm();
			if (isset($form) && isset($form->errorFields[$params['name']])) {
				$smarty->assign('FBV_class', 'error ' . $params['class']);
			} else {
				$smarty->assign('FBV_class', $params['class']);
			}

			$smarty->assign(array('FBV_suppressId' => null, 'FBV_label' => null, 'FBV_required' => false, 'FBV_disabled' => false, 'FBV_name' => null));
			foreach ($params as $key => $value) {
				switch ($key) {
					case 'label':
					case 'required':
					case 'suppressId':
					case 'disabled':
					case 'name':
						$smarty->assign('FBV_' . $key, $value);
						break;
				}
			}

			$returner = $smarty->fetch('form/fieldLabel.tpl');
		}
		return $returner;
	}
}


