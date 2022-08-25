@extends('layouts.app', ['class' => 'bg-default'])

@section('content')

 <section class="auctions-category">
            <div class="inner-container">
                <div class="row">
                    <div class="tab-link">
                        <ul>
                            <li><a href="{{route('auctions.type','current')}}">Auctions</a></li>
                            <li class="active"><a href="#">Auction Map</a></li>
                            <li><a href="{{route('auctions.lots')}}">Lot List</a></li>
                        </ul>
                    </div>
                    <div class="category-main">
                        <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                            <div class="search-form">
                                <form>
                                    <input type="text" name="text" id="text" class="form-control" placeholder="Search">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="categories-button">
                                <select class="form-control" id="auction-search-category" name="cat"><option value="">All Groups &amp; Categories</option>
                                @foreach($category as $ct)
                                    <option value="{{$ct->id}}" {{!empty($data["cat"]) && $ct->id== $data['cat'] ? 'selected':''}}>{{$ct->title}} ({{$ct->item_count}})</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        <section class="auctions-list map-section">
            <div class="inner-container">
                <div class="row">
                
				<div id="map"></div>	
				</div>
			</div>
        </section>
       
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBM3RUZl8MZdhQTsZlUAj-613rkiW6ExvE&callback=initMap" defer></script>
    <!--- End of Auctions List --->
    <script>
    const neighborhoods = <?php echo $mapdata; ?>;
let markers = [];
let map;

function initMap() {
   $("#map").css('width','100%');
   $("#map").css('height','500px');
   $("#map").css('margin-bottom','10px');
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 10,
    center: { lat:24.6655, lng: -81.625 },
  });
  drop();
}

function drop() {
  

  for (let i = 0; i < neighborhoods.length; i++) {
    
     
    addMarkerWithTimeout(neighborhoods[i], i * 200);
  }
}

function addMarkerWithTimeout(positiondata, timeout) {
    const contentString ='<div><div style="color:black; line-height: 1.35; white-space: nowrap;text-align: center;"><h5>'+positiondata.heading+'</h5><p>'+positiondata.company_name+'</p><p><a target="_blank" href="https://maps.google.com/maps?q='+positiondata.address+'">'+positiondata.address+'</a><br>Event Date(s): '+positiondata.eventDates+'</p><p><a href="'+positiondata.link+'" style="color:blue">Click Here to View the '+positiondata.lotcount+' Lots</a></p></div></div>';
    const infowindow = new google.maps.InfoWindow({
    content: contentString,
    
  });
  window.setTimeout(() => {
    
    var marker = new google.maps.Marker({
        position: {  lat : positiondata.geolat, lng : positiondata.geolong },
        map,
        animation: google.maps.Animation.DROP,

      })
      markers.push(marker)
      marker.addListener("click", () => {
        infowindow.open(map, marker);
    });
  }, timeout);
  
  
}
    </script>
@endsection