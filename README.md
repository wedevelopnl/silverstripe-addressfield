# SilverStripe Address field

## Introduction

Address field with geolocation

## Requirements

* SilverStripe CMS ^4.0
* "jeroendesloovere/geolocation-php-api": "1.3.*"

## Installation

```
composer require "thewebmen/silverstripe-addressfield" "dev-master"
```

## Usage
Add all db fields to the db array:
```
private static $db = [
        'City' => 'Varchar',
        'Country' => 'Varchar',
        'ZipCode' => 'Varchar',
        'Street' => 'Varchar',
        'StreetNumber' => 'Varchar',
        'Latitude' => 'Varchar',
        'Longitude' => 'Varchar'
    ];
```
Then add the field like any other field
```php
public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab('Root.Address', new AddressField($this->owner));
    }
```

See the addressfield class for all constructor options.

## Distance helper
The module comes with a distance helper to calculate the distance between two latitude/longitudes, example usage:
```php
    $list = ObjectWithLatitudeLongitude::get();
    $list = TheWebmen\Addressfield\Helpers\DistanceHelper::addDistance($list, '52.2112', '5.9699');
    $list = $list->sort('Distance');
    foreach($list as $item){
        var_dump($item->Distance);
    }
```

## Todo
* Improve documentation
