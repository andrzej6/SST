function initMap() {
        
		
		

        var myLatLng = {lat: 51.507351, lng: -0.127758};
		var myLatLng1 = {lat: 52.486243, lng: -1.890401};

		var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: myLatLng
        });

		window.setTimeout(slowAlert, 500000);
		
		function slowAlert() {
 

		
		
        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
		  icon: image,
          title: 'London',
		  animation: google.maps.Animation.DROP
        });
		
		var marker1 = new google.maps.Marker({
          position: myLatLng1,
          map: map,
          title: 'Birmigham',
		  icon: image
        });
		
		 var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
            '<div id="bodyContent">'+
            'Heritage Site.</p>'+
            '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
            'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
            '(last visited June 22, 2009).</p>'+
            '</div>'+
            '</div>';
	     var cont = 'another';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
		
		var infowindow1 = new google.maps.InfoWindow({
          content: cont
        });
		
		/*
		marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
		*/
		marker.addListener('click', toggleBounce);
		
		
		marker1.addListener('click', function() {
          infowindow1.open(map, marker1);
        });
		
		function toggleBounce() {
        if (marker.getAnimation() !== null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
        }
      }
		
		}
		
		
      }
	  