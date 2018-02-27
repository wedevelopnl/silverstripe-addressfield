(function ($) {
  $.entwine('ss', function ($) {

    $('input.googleplaces').entwine({
      onmatch: function () {

        var _this = this;
        var form = this.closest('form');

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
          var data = {};
          var place = autocomplete.getPlace();
          for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            var mapped = mapping[addressType];
            if(mapped){
              data[mapped['name']] = place.address_components[i][mapped['use']];
            }
          }
          data['latitude'] = place.geometry.location.lat();
          data['longitude'] = place.geometry.location.lng();
          for(var key in data){
            var fieldname = _this.data(key + 'field');
            form.find('[name="'+fieldname+'"]').val(data[key]);
          }
        }

        var autocomplete = new google.maps.places.Autocomplete(this[0], {
          types: ['geocode']
        });
        autocomplete.addListener('place_changed', onPlaceChanged);

      }
    });

  });
})(jQuery);
