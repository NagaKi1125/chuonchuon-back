function myFunction() {
    alert("Hello! I am an alert box!");
}

function geoFindMe(){
    navigator.geolocation.getCurrentPosition(success, error, geo_options);
}
function success(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    var altitude = position.coords.altitude;
    var accuracy = position.coords.accuracy;
    //do something with above position thing e.g. below
    document.getElementById('success').innerHTML = 'I am here! lat:' + latitude +' and long : ' +longitude;
    document.getElementById('lat').value = latitude;
    document.getElementById('lon').value = longitude;


    }
function error(error) {
    document.getElementById('error').innerHTML = "Unable to retrieve your location due to "+error.code + " : " + error.message;
};
var geo_options = {
    enableHighAccuracy: true,
    maximumAge : 30000,
    timeout : 27000
};

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        $('#imagePreview')
        .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// explain card-view
$('#bologna-list a').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
})
