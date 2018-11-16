<?php

namespace TheWebmen\Addressfield\Forms;

use JeroenDesloovere\Geolocation\Geolocation;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataObjectInterface;
use SilverStripe\Forms\ReadonlyField;

class AddressField extends CompositeField {

    private $_cityField;
    private $_countryField;
    private $_zipCodeField;
    private $_streetField;
    private $_streetNumberField;
    private $_latitudeField;
    private $_longitudeField;
    private $_model;

    /**
     * AddressField constructor.
     * @param null $model
     * @param string $cityFieldName
     * @param string $countryFieldName
     * @param string $zipCodeFieldName
     * @param string $streetFieldName
     * @param string $streetNumberFieldName
     * @param string $latitudeFieldName
     * @param string $longitudeFieldName
     */
    public function __construct($model, $cityFieldName = 'City', $countryFieldName = 'Country', $zipCodeFieldName = 'ZipCode', $streetFieldName = 'Street', $streetNumberFieldName = 'StreetNumber', $latitudeFieldName = 'Latitude', $longitudeFieldName = 'Longitude')
    {
        $this->setTag('fieldset');
        $this->setLegend(_t(self::class . '.ADDRESS', 'Address'));

        $this->_model = $model;

        $this->_cityField = TextField::create($cityFieldName, _t(self::class . '.CITY', 'City'));
        $this->_countryField = TextField::create($countryFieldName, _t(self::class . '.COUNTRY', 'Country'));
        $this->_zipCodeField = TextField::create($zipCodeFieldName, _t(self::class . '.ZIP_CODE', 'Zip code'));
        $this->_streetField = TextField::create($streetFieldName, _t(self::class . '.STREET', 'Street'));
        $this->_streetNumberField = TextField::create($streetNumberFieldName, _t(self::class . '.STREET_NUMBER', 'Street number'));
        $this->_latitudeField = TextField::create($latitudeFieldName, _t(self::class . '.LATITUDE', 'Latitude'));
        $this->_longitudeField = TextField::create($longitudeFieldName, _t(self::class . '.LONGITUDE', 'Longitude'));

        parent::__construct([
            LiteralField::create('AddressLteral1', '<div class="row"><div class="col-md-6">'),
            $this->_countryField,
            LiteralField::create('AddressLteral2', '</div><div class="col-md-6">'),
            $this->_cityField,
            LiteralField::create('AddressLteral3', '</div><div class="col-md-4">'),
            $this->_zipCodeField,
            LiteralField::create('AddressLteral4', '</div><div class="col-md-5">'),
            $this->_streetField,
            LiteralField::create('AddressLteral5', '</div><div class="col-md-3">'),
            $this->_streetNumberField,
            LiteralField::create('AddressLteral6', '</div><div class="col-md-6">'),
            $this->_latitudeField,
            LiteralField::create('AddressLteral7', '</div><div class="col-md-6">'),
            $this->_longitudeField,
            LiteralField::create('AddressLteral8', '</div></div>'),
        ]);
    }

    public function isComposite()
    {
        return false;
    }

    public function hasData()
    {
        return true;
    }

    /*
    TODO: Replace deprecated geolocation with https://github.com/geocoder-php/Geocoder
    public function saveInto(DataObjectInterface $record)
    {
        //Check if a update is needed
        $fields = [
            $this->getCountryField(),
            $this->getCityField(),
            $this->getZipCodeField(),
            $this->getStreetField(),
            $this->getStreetNumberField()
        ];
        $needUpdate = false;
        foreach($fields as $field){
            $fieldName = $field->getName();
            $fieldValue = $field->value;

            if($this->_model->$fieldName != $fieldValue){
                $needUpdate = true;
                break;
            }
        }

        //Do the update
        if($needUpdate){
            $geolocation = new Geolocation();
            $coordinates = $geolocation->getCoordinates(
                $this->getStreetField()->value,
                $this->getStreetNumberField()->value,
                $this->getCityField()->value,
                $this->getZipCodeField()->value,
                $this->getCountryField()->value
            );
            $latitudeFieldName = $this->getLatitudeField()->getName();

            if($coordinates && isset($coordinates['latitude'])){
                $record->$latitudeFieldName = $coordinates['latitude'];
                $this->getLatitudeField()->value = $coordinates['latitude'];
            }else{
                $record->$latitudeFieldName = '';
                $this->getLatitudeField()->value = '';
            }
            $longitudeFieldName = $this->getLongitudeField()->getName();
            if($coordinates && isset($coordinates['longitude'])){
                $record->$longitudeFieldName = $coordinates['longitude'];
                $this->getLongitudeField()->value = $coordinates['longitude'];
            }else{
                $record->$longitudeFieldName = '';
                $this->getLongitudeField()->value = '';
            }
        }
    }
    */

    /**
     * @return TextField
     */
    public function getLongitudeField()
    {
        return $this->_longitudeField;
    }

    /**
     * @return TextField
     */
    public function getLatitudeField()
    {
        return $this->_latitudeField;
    }

    /**
     * @return TextField
     */
    public function getStreetNumberField()
    {
        return $this->_streetNumberField;
    }

    /**
     * @return TextField
     */
    public function getStreetField()
    {
        return $this->_streetField;
    }

    /**
     * @return TextField
     */
    public function getZipCodeField()
    {
        return $this->_zipCodeField;
    }

    /**
     * @return TextField
     */
    public function getCountryField()
    {
        return $this->_countryField;
    }

    /**
     * @return TextField
     */
    public function getCityField()
    {
        return $this->_cityField;
    }

}
