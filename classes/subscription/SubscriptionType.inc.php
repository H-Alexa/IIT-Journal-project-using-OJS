<?php

/**
 * @file classes/subscription/SubscriptionType.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class Subscriptiontyoe
 * @ingroup subscription 
 * @see SubscriptionTypeDAO
 *
 * @brief Basic class describing a subscription type.
 */

/**
 * Subscription type formats
 */
define('SUBSCRIPTION_TYPE_FORMAT_ONLINE',		0x01); 
define('SUBSCRIPTION_TYPE_FORMAT_PRINT',		0x10);
define('SUBSCRIPTION_TYPE_FORMAT_PRINT_ONLINE',	0x11);


class SubscriptionType extends DataObject {
	//
	// Get/set methods
	//

	/**
	 * Get the journal ID of the subscription type.
	 * @return int
	 */
	function getJournalId() {
		return $this->getData('journalId');
	}

	/**
	 * Set the journal ID of the subscription type.
	 * @param $journalId int
	 */
	function setJournalId($journalId) {
		return $this->setData('journalId', $journalId);
	}

	/**
	 * Get the localized subscription type name
	 * @return string
	 */
	function getLocalizedName() {
		return $this->getLocalizedData('name');
	}

	/**
	 * Get subscription type name.
	 * @param $locale string
	 * @return string
	 */
	function getName($locale) {
		return $this->getData('name', $locale);
	}

	/**
	 * Set subscription type name.
	 * @param $name string
	 * @param $locale string
	 */
	function setName($name, $locale) {
		return $this->setData('name', $name, $locale);
	}

	/**
	 * Get the localized subscription type description
	 * @return string
	 */
	function getLocalizedDescription() {
		return $this->getLocalizedData('description');
	}

	/**
	 * Get subscription type description.
	 * @param $locale string
	 * @return string
	 */
	function getDescription($locale) {
		return $this->getData('description', $locale);
	}

	/**
	 * Set subscription type description.
	 * @param $description string
	 * @param $locale string
	 */
	function setDescription($description, $locale) {
		return $this->setData('description', $description, $locale);
	}

	/**
	 * Get subscription type cost.
	 * @return float 
	 */
	function getCost() {
		return $this->getData('cost');
	}

	/**
	 * Set subscription type cost.
	 * @param $cost float
	 */
	function setCost($cost) {
		return $this->setData('cost', $cost);
	}

	/**
	 * Get subscription type currency code.
	 * @return string
	 */
	function getCurrencyCodeAlpha() {
		return $this->getData('currencyCodeAlpha');
	}

	/**
	 * Set subscription type currency code.
	 * @param $currencyCodeAlpha string
	 */
	function setCurrencyCodeAlpha($currencyCodeAlpha) {
		return $this->setData('currencyCodeAlpha', $currencyCodeAlpha);
	}

	/**
	 * Get subscription type currency string.
	 * @return string
	 */
	public function getCurrencyString() {
		$isoCodes = new \Sokil\IsoCodes\IsoCodesFactory();
		$currency = $isoCodes->getCurrencies()->getByLetterCode($this->getData('currencyCodeAlpha'));
		return $currency?$currency->getLocalName():'subscriptionTypes.currency';
	}

	/**
	 * Get subscription type currency abbreviated string.
	 * @return int
	 */
	function getCurrencyStringShort() {
		$isoCodes = new \Sokil\IsoCodes\IsoCodesFactory();
		$currency = $isoCodes->getCurrencies()->getByLetterCode($this->getData('currencyCodeAlpha'));
		return $currency?$currency->getLetterCode():'subscriptionTypes.currency';
	}

	/**
	 * Get subscription type nonExpiring.
	 * @return boolean
	 */
	function getNonExpiring() {
		return $this->getDuration()==null;
	}

	/**
	 * Get subscription type duration.
	 * @return int
	 */
	function getDuration() {
		return $this->getData('duration');
	}

	/**
	 * Set subscription type duration.
	 * @param $duration int
	 */
	function setDuration($duration) {
		return $this->setData('duration', $duration);
	}

	/**
	 * Get subscription type duration in years and months.
	 * @param $locale string
	 * @return string
	 */
	function getDurationYearsMonths($locale = null) {
		if (!$this->getDuration()) {
			return __('subscriptionTypes.nonExpiring', null, $locale);
		}

		$years = (int)floor($this->getDuration()/12);
		$months = (int)fmod($this->getDuration(), 12);
		$yearsMonths = '';

		if ($years == 1) {
			$yearsMonths = '1 ' . __('subscriptionTypes.year', null, $locale);
		} elseif ($years > 1) {
			$yearsMonths = $years . ' ' . __('subscriptionTypes.years', null, $locale);
		}

		if ($months == 1) {
			$yearsMonths .= $yearsMonths == ''  ? '1 ' : ' 1 ';
			$yearsMonths .= __('subscriptionTypes.month', null, $locale);
		} elseif ($months > 1){
			$yearsMonths .= $yearsMonths == ''  ? $months . ' ' : ' ' . $months . ' ';
			$yearsMonths .= __('subscriptionTypes.months', null, $locale);
		}

		return $yearsMonths;
	}

	/**
	 * Get subscription type format.
	 * @return int
	 */
	function getFormat() {
		return $this->getData('format');
	}

	/**
	 * Set subscription type format.
	 * @param $format int
	 */
	function setFormat($format) {
		return $this->setData('format', $format);
	}

	/**
	 * Get subscription type format locale key.
	 * @return string
	 */
	function getFormatString() {
		switch ($this->getData('format')) {
			case SUBSCRIPTION_TYPE_FORMAT_ONLINE:
				return 'subscriptionTypes.format.online';
			case SUBSCRIPTION_TYPE_FORMAT_PRINT:
				return 'subscriptionTypes.format.print';
			case SUBSCRIPTION_TYPE_FORMAT_PRINT_ONLINE:
				return 'subscriptionTypes.format.printOnline';
			default:
				return 'subscriptionTypes.format';
		}
	}

	/**
	 * Check if this subscription type is for an institution.
	 * @return boolean
	 */
	function getInstitutional() {
		return $this->getData('institutional');
	}

	/**
	 * Set whether or not this subscription type is for an institution.
	 * @param $institutional boolean
	 */
	function setInstitutional($institutional) {
		return $this->setData('institutional', $institutional);
	}

	/**
	 * Check if this subscription type requires a membership.
	 * @return boolean
	 */
	function getMembership() {
		return $this->getData('membership');
	}

	/**
	 * Set whether or not this subscription type requires a membership.
	 * @param $membership boolean
	 */
	function setMembership($membership) {
		return $this->setData('membership', $membership);
	}

	/**
	 * Check if this subscription type should be publicly visible.
	 * @return boolean
	 */
	function getDisablePublicDisplay() {
		return $this->getData('disable_public_display');
	}

	/**
	 * Set whether or not this subscription type should be publicly visible.
	 * @param $disablePublicDisplay boolean
	 */
	function setDisablePublicDisplay($disablePublicDisplay) {
		return $this->setData('disable_public_display', $disablePublicDisplay);
	}

	/**
	 * Get subscription type display sequence.
	 * @return float
	 */
	function getSequence() {
		return $this->getData('sequence');
	}

	/**
	 * Set subscription type display sequence.
	 * @param $sequence float
	 */
	function setSequence($sequence) {
		return $this->setData('sequence', $sequence);
	}

	/**
	 * Get subscription type summary in the form: TypeName - Duration - Cost (CurrencyShort).
	 * @return string
	 */
	function getSummaryString() {
		$subscriptionTypeDao = DAORegistry::getDAO('SubscriptionTypeDAO'); /* @var $subscriptionTypeDao SubscriptionTypeDAO */
		return $this->getLocalizedName() . ' - ' . $this->getDurationYearsMonths() . ' - ' . sprintf('%.2f', $this->getCost()) . ' ' . $this->getCurrencyStringShort();
	}
}


