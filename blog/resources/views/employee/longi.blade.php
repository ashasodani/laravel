@extends('layout.a_ashh')
@section('pagecontent')
 <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
  </style>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                  <div class="box-header with-border">
                        <h3 class="box-title">Forms</h3>
                  </div>
                  <form method="post" action="{{ route('employee') }}" id="myform" role="form">
                    <div class="box-body">    
                      <div class="form-group">
                        <label for="input" class="col-lg-2 control-label">Filter Date</label>
                            <select name="filterdate" id="filterdate" onchange="java_script_:show(this.options[this.selectedIndex].value)">
                                <option value="">Select Dates</option>
                                <option value="selectdate">Select Date</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="today" >Today</option>
                            </select>
                      </div>
                     
                        <div id="selectdates" style="display:none">
                          <div class="form-group">
                            <label for="fromdate">From Date :</label>
                            <input type="date" class="form-control" name="fromdate" id="fromdate"/>
                          </div>
                          <div class="form-group">
                            <label for="fromdate">To Date :</label>
                            <input type="date" class="form-control" name="todate" id="todate"/>
                          </div>
                            
                        </div>
                        <!-- //////////////////////////////////////////////////////////  -->
                        <div id="searchdiv" style="display:none">
                          <div class="form-group">
                          <button type="button" class="btn btn-primary" id="search1" >search</button> 
                          </div>
                        </div> 
                        </div>
                </form>
            </div>
        </div>
    </div>
    <div class="box box-primary">
      <div id="map">
      </div>
    </div>
</section>
<!-- <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=23.022505,72.571365&key=AIzaSyA-U_ZXCNVsxK2GWyrBH0c3ZeIPBgQxXds"></iframe>
 -->
@stop
<script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(20.593683,20.593683),
          zoom: -5
        });
           
        Array.prototype.forEach.call(markers, function(markerElem) {
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));
              var marker = new google.maps.Marker({
                map: map,
                label: icon.label
              });
            
          });
      }

      function doNothing() {}
    </script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeokK_KWi8eriW6I0dla7uZTcgM3ScaB0&callback=initMap">
  </script>
    
  <script>
    function show(aval) {
      if (aval == "selectdate") {
          selectdates.style.display='inline-block';
          searchdiv.style.display='inline-block';
          // /Form.fileURL.focus();
      } 
      else if (aval == "today" || aval=="yesterday") {
        searchdiv.style.display='inline-block';
        selectdates.style.display='none';
        // Form.fileURL.focus();
      }
      else {
      selectdates.style.display='none';
      searchdiv.style.display='none';
      }
    }
  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    var APP_URL = {!! json_encode(url('/')) !!};
    $("#search1").click(function(){
      var values=$("#filterdate").val();
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth() + 1; //January is 0!
      var yyyy = today.getFullYear();
      if (dd < 10) {
          dd = '0' + dd;
      } 
      if (mm < 10) {
          mm = '0' + mm;
      } 
      var date1="";
      var fromdate="";
      var todate="";
      
      if(values=="today")
      {
        var today = yyyy + '-' + mm + '-' + dd; 
        date1 = today;
      }
      else if(values=="yesterday")
      { 
          var yesterdate=today.getDate()-1;
          var yesterday = yyyy + '-' + mm + '-' + yesterdate;
          date1 = yesterday; 
      }
      else if(values=="selectdate")
      { 
          var todate = $('#todate').val();
          todate=todate;
          var fromdate = $('#fromdate').val();
          fromdate=fromdate;
      }
      else{
          alert("nothiun");
      }
      $.ajax({
              type: 'get',
              url: APP_URL + '/yestoday',
              data: {date1: date1,fromdate:fromdate,todate:todate},
              success: function (data) {
                var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(20.593683,78.962883),
                zoom: -5
                });
                jQuery.each(data , function (index, value){
                    console.log(index + ':' + value.track_location_id);
                    var point = new google.maps.LatLng(
                    parseFloat(value.latitude),parseFloat(value.longitude));
                   
                    var marker = new google.maps.Marker({
                      map: map,
                      position: point,
                    });
                });
              },
      });
  });
 
});
</script>
    



    