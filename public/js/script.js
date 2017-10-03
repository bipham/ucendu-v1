$(document).ready(function(){
    var myLatLng={lat: -34.397, lng: 150.644};
    var map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 8
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Hello World!'
    });

    var request = {
        location: myLatLng,
        radius: '1500',
        types: ['store']
    };

    service = new google.maps.places.PlacesService(map);
    service.nearbySearch(request, callback);

    function callback(results, status) {
        console.log(results);
        // if (status == google.maps.places.PlacesServiceStatus.OK) {
        //     for (var i = 0; i < results.length; i++) {
        //         var place = results[i];
        //         createMarker(results[i]);
        //     }
        // }
    }
});