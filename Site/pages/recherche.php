
<h1>Votre recherche : <?php echo $_GET['query']; ?></h1>
<div id="map"></div>
<script src="./js/load_mapsApi.js"></script>

<script>

function initMap() {
		var uluru = {lat: -25.363, lng: 131.044};
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 4,
			center: uluru
		});
		var marker = new google.maps.Marker({
			position: uluru,
			map: map
		});
}

</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP7_LbdZOnYrIlJl4WG6cyIJOp2oPyHT0&callback=initMap"></script>
