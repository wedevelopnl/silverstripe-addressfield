<?php

namespace TheWebmen\Addressfield\Helpers;

use SilverStripe\ORM\DataList;

class DistanceHelper
{

    /**
     * Add a distance column to your list, after this you can use this like any other column for example: ->sort('Distance')
     * @param DataList $list
     * @param $fromLatitude
     * @param $fromLongitude
     * @param string $distanceFieldName
     * @param string $latitudeFieldName
     * @param string $longitudeFieldName
     * @return DataList
     */
    public static function addDistance(DataList $list, $fromLatitude, $fromLongitude, $distanceFieldName = 'Distance', $latitudeFieldName = 'Latitude', $longitudeFieldName = 'Longitude')
    {
        $list = $list->alterDataQuery(function ($dataQuery) use ($fromLatitude, $fromLongitude, $distanceFieldName, $latitudeFieldName, $longitudeFieldName) {
            $dataQuery->selectField('111.111 *
                                     DEGREES(ACOS(COS(RADIANS('.$latitudeFieldName.'))
                                     * COS(RADIANS(' . $fromLatitude . '))
                                     * COS(RADIANS('.$longitudeFieldName.' - ' . $fromLongitude . '))
                                     + SIN(RADIANS('.$latitudeFieldName.'))
                                     * SIN(RADIANS(' . $fromLatitude . '))))', $distanceFieldName);
            return $dataQuery;
        });
        return $list;
    }

}
