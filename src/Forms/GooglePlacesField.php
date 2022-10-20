<?php

namespace TheWebmen\Addressfield\Forms;

use SilverStripe\Core\Environment;
use SilverStripe\Forms\TextField;
use SilverStripe\View\Requirements;
use SilverStripe\Core\Config\Config;
class GooglePlacesField extends TextField {

    private $_cityField = '';
    private $_countryField = '';
    private $_countryCodeField = '';
    private $_zipCodeField = '';
    private $_streetField = '';
    private $_streetNumberField = '';
    private $_latitudeField = '';
    private $_longitudeField = '';
    private $_mapurlField = '';
    private $_placeidField = '';
    private $_htmladdressField = '';

    public function __construct($name, $title = null, $value = '', $maxLength = null, $form = null)
    {
        $config = Config::inst()->get(self::class);
        if ($config->get('maps_api_key')) {
            $key = $config->get('maps_api_key');
        }

        if (empty($key) && Environment::getEnv('WDVLP_ELEMENTAL_MAPS_API_KEY')) {
            $key = Environment::getEnv('WDVLP_ADDRESSFIELD_MAPS_API_KEY');
        }

        if (empty($key)) {
            throw new \InvalidArgumentException("maps_api_key is empty", 1);
        }

        Requirements::javascript('thewebmen/silverstripe-addressfield:resources/js/googleplacesfield.js');
        Requirements::javascript('https://maps.googleapis.com/maps/api/js?key='.$key.'&libraries=places');

        $this->addExtraClass('text');
        parent::__construct($name, $title, $value, $maxLength, $form);
    }

    /**
     * @return string
     */
    public function getLongitudeField()
    {
        return $this->_longitudeField;
    }

    /**
     * @param string $longitudeField
     */
    public function setLongitudeField($longitudeField)
    {
        $this->setAttribute('data-longitudefield', $longitudeField);
        $this->_longitudeField = $longitudeField;
    }

    /**
     * @return string
     */
    public function getLatitudeField()
    {
        return $this->_latitudeField;
    }

    /**
     * @param string $latitudeField
     */
    public function setLatitudeField($latitudeField)
    {
        $this->setAttribute('data-latitudefield', $latitudeField);
        $this->_latitudeField = $latitudeField;
    }

    /**
     * @return string
     */
    public function getStreetNumberField()
    {
        return $this->_streetNumberField;
    }

    /**
     * @param string $streetNumberField
     */
    public function setStreetNumberField($streetNumberField)
    {
        $this->setAttribute('data-streetnumberfield', $streetNumberField);
        $this->_streetNumberField = $streetNumberField;
    }

    /**
     * @return string
     */
    public function getStreetField()
    {
        return $this->_streetField;
    }

    /**
     * @param string $streetField
     */
    public function setStreetField($streetField)
    {
        $this->setAttribute('data-streetfield', $streetField);
        $this->_streetField = $streetField;
    }

    /**
     * @return string
     */
    public function getZipCodeField()
    {
        return $this->_zipCodeField;
    }

    /**
     * @param string $zipCodeField
     */
    public function setZipCodeField($zipCodeField)
    {
        $this->setAttribute('data-zipcodefield', $zipCodeField);
        $this->_zipCodeField = $zipCodeField;
    }

    /**
     * @return string
     */
    public function getCountryField()
    {
        return $this->_countryField;
    }

    /**
     * @param string $countryField
     */
    public function setCountryField($countryField)
    {
        $this->setAttribute('data-countryfield', $countryField);
        $this->_countryField = $countryField;
    }

    /**
     * @return string
     */
    public function getCityField()
    {
        return $this->_cityField;
    }

    /**
     * @param string $cityField
     */
    public function setCityField($cityField)
    {
        $this->setAttribute('data-cityfield', $cityField);
        $this->_cityField = $cityField;
    }

    /**
     * @return string
     */
    public function getMapurlField()
    {
        return $this->_mapurlField;
    }

    /**
     * @param string $mapurlField
     */
    public function setMapurlField($mapurlField)
    {
        $this->setAttribute('data-mapurlfield', $mapurlField);
        $this->_mapurlField = $mapurlField;
    }

    /**
     * @return string
     */
    public function getPlaceidField()
    {
        return $this->_placeidField;
    }

    /**
     * @param string $placeidField
     */
    public function setPlaceidField($placeidField)
    {
        $this->setAttribute('data-placeidfield', $placeidField);
        $this->_placeidField = $placeidField;
    }

    /**
     * @return string
     */
    public function getHtmladdressField()
    {
        return $this->_htmladdressField;
    }

    /**
     * @param string $htmladdressField
     */
    public function setHtmladdressField($htmladdressField)
    {
        $this->setAttribute('data-htmladdressfield', $htmladdressField);
        $this->_htmladdressField = $htmladdressField;
    }

    /**
     * @return string
     */
    public function getCountryCodeField()
    {
        return $this->_countryCodeField;
    }

    /**
     * @param string $countryCodeField
     */
    public function setCountryCodeField($countryCodeField)
    {
        $this->setAttribute('data-countrycodefield', $countryCodeField);
        $this->_countryCodeField = $countryCodeField;
    }

}
