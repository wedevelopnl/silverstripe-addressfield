(function ($) {
    $.entwine('ss', function ($) {

        $('input.googleplaces').entwine({
            onmatch: function () {

                function whenGoogleLoadedDo(func) {
                    if (typeof google != 'undefined') {
                        func();
                    } else {
                        setTimeout(function () {
                            (function (func) {
                                whenGoogleLoadedDo(func)
                            })(func)
                        }, 150);
                    }
                }

                var _this = this;
                var form = this.closest('form');
                var autocomplete;

                function onPlaceChanged() {
                    var mapping = {
                        'postal_code': {
                            'name': 'zipcode',
                            'use': 'long_name'
                        },
                        'country': {
                            'name': 'country',
                            'use': 'long_name'
                        },
                        'locality': {
                            'name': 'city',
                            'use': 'long_name'
                        },
                        'street_number': {
                            'name': 'streetnumber',
                            'use': 'long_name'
                        },
                        'route': {
                            'name': 'street',
                            'use': 'long_name'
                        },
                        'administrative_area_level_1': {
                            'name': 'state',
                            'use': 'long_name'
                        }
                    };
                    var data = {
                        'zipcode': false,
                        'country': false,
                        'city': false,
                        'streetnumber': false,
                        'street': false,
                        'state': false
                    };
                    var place = autocomplete.getPlace();
                    for (var i = 0; i < place.address_components.length; i++) {
                        var addressType = place.address_components[i].types[0];
                        var mapped = mapping[addressType];
                        if (mapped) {
                            data[mapped['name']] = place.address_components[i][mapped['use']];
                        }
                    }
                    data['latitude'] = place.geometry.location.lat();
                    data['longitude'] = place.geometry.location.lng();
                    for (var key in data) {
                        var fieldname = _this.data(key + 'field');
                        var field = form.find('[name="' + fieldname + '"]');
                        if(data[key]){
                            field.val(data[key]);
                        }else{
                            field.val('');
                        }
                    }
                }


                whenGoogleLoadedDo(function(){
                    autocomplete = new google.maps.places.Autocomplete(_this[0], {
                        types: ['geocode']
                    });
                    autocomplete.addListener('place_changed', onPlaceChanged);
                });

            }
        });

    });
})(jQuery);
