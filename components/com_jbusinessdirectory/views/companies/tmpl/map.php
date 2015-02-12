 <script>
      function initialize() {
	      var mapOptions = {
	         zoom: 6,
	         mapTypeId: google.maps.MapTypeId.ROADMAP
	      }

	      var mapdiv = document.getElementById("company-map");
	  	  mapdiv.style.width = '100%';
	  	  mapdiv.style.height = '450px';
	  	  
	      var map = new google.maps.Map(mapdiv, mapOptions);
	  		 
	      setMarkers(map, locations);
      }

      /**
       * Data for the markers consisting of a name, a LatLng and a zIndex for
       * the order in which these markers should display on top of each
       * other.
       */
		<?php
	      $marker = 0;
		   	if(!empty( $this->company->categoryMarker)){
		   		$marker = JURI::root().PICTURES_PATH. $this->company->categoryMarker;
		   	}    
       ?>
      var locations = [
           [<?php echo $this->company->latitude ?>, <?php echo  $this->company->longitude ?>,<?php echo "'$marker'" ?>],            
        <?php 
        $db = JFactory::getDBO();
        
     	$index = 1;
        foreach($this->company->locations as $location){

        	if(!empty($location->latitude) && !empty($location->longitude)){
        		echo "[".$location->latitude.",".$location->longitude."],"."\n";
       		
        	}
        	$index++;
     	 } ?>
     	
      ];

      function setMarkers(map, locations) {
        // Add markers to the map

        // Marker sizes are expressed as a Size of X,Y
        // where the origin of the image (0,0) is located
        // in the top left of the image.

        // Origins, anchor positions and coordinates of the marker
        // increase in the X direction to the right and in
        // the Y direction down.
        
 
		var bounds = new google.maps.LatLngBounds();
        
         for (var i = 0; i < locations.length; i++) {
	          var company = locations[i];

	          var pinColor = "0071AF";
	          var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=B|" + pinColor+"|FFFFFF",
	              new google.maps.Size(21, 34),
	              new google.maps.Point(0,0),
	              new google.maps.Point(10, 34));
	          var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
	              new google.maps.Size(40, 37),
	              new google.maps.Point(0, 0),
	              new google.maps.Point(12, 35));


		      var shape = {
	              coord: [1, 1, 1, 20, 18, 20, 18 , 1],
	              type: 'poly'
	          };


		      if(company[2] != '0'){
		      		pinImage = new google.maps.MarkerImage(company[2],
		              // This marker is 20 pixels wide by 32 pixels tall.
		              new google.maps.Size(32, 32),
		              // The origin for this image is 0,0.
		              new google.maps.Point(0,0),
		              // The anchor for this image is the base of the flagpole at 0,32.
		              new google.maps.Point(0, 32));
		      }
	          
	          var myLatLng = new google.maps.LatLng(company[0], company[1]);
	          var marker = new google.maps.Marker({
	              position: myLatLng,
	              map: map,
	              icon: pinImage,
	              shadow: pinShadow,
	              shape: shape
	          });
			 
	          var contentBody = company[4];
	          var infowindow = new google.maps.InfoWindow({
		          content: contentBody
		      });
	      	 

	          google.maps.event.addListener(marker, 'click', function(contentBody) {
	        	    return function(){
	        	        infowindow.setContent(contentBody);//set the content
	        	        infowindow.open(map,this);
	        	    }
	        	}(contentBody));
	        		        	
	          bounds.extend(myLatLng);
      	  }


         <?php if(!empty($this->location["latitude"])){ ?>
         var pinImage = new google.maps.MarkerImage(" https://maps.google.com/mapfiles/kml/shapes/library_maps.png",
	              new google.maps.Size(31, 34),
	              new google.maps.Point(0,0),
	              new google.maps.Point(10, 34));

       
         var myLatLng = new google.maps.LatLng(<?php echo $this->location["latitude"] ?>,  <?php echo $this->location["longitude"] ?>);
         var marker = new google.maps.Marker({
             position: myLatLng,
             map: map,
             icon: pinImage
         });

         bounds.extend(myLatLng);
         <?php } ?>
         map.fitBounds(bounds);

         var listener = google.maps.event.addListener(map, "idle", function() { 
	   		  if (map.getZoom() > 16) map.setZoom(16); 
	   		  google.maps.event.removeListener(listener); 
   		});
    	  
      }

      function loadScript() {
          if(!initialized){
	    	  var script = document.createElement("script");
	    	  script.type = "text/javascript";
	    	  script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
	    	  document.body.appendChild(script);
	    	  initialized = true;
          }
    	}

  		var initialized = false;  

  			<?php 
  				if($this->tabId == 2){
  						echo "window.onload = loadScript;"; 
  				}
  			?>
  			
  		</script>

	
<div id="company-map" style="position: relative;">	
</div>
		


