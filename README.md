# SilverStripe Address field

## Introduction

Address field with geolocation

## Requirements

* Silverstripe CMS `^4 || ^5`
* "jeroendesloovere/geolocation-php-api": "1.3.*"

## Installation

```
composer require "thewebmen/silverstripe-addressfield" "dev-master"
```

## Config
Add the Google Maps API key:

```yaml
TheWebmen\Addressfield\Forms\GooglePlacesField:
  maps_api_key: 'API_KEY'
```

Or add the following variable to your `.env`:

```
WDVLP_ADDRESSFIELD_MAPS_API_KEY='API_KEY'
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
