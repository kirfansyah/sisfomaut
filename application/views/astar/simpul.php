<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h 3class="m-0 font-weight-bold">Data Simpul</h3>
          </div>
          <div class="card-body" id="mapcontainer">
            <div id="mapidi" style="width: 100%; height: 400px;">           
            </div>
        </div>
  <!-- ini batas -->
    </div>
  <div class="row">
    <div class="col-md-6">
      <!-- DataTales Example -->
        <div class="card shadow mb-4">          
          <div class="card-body">
            <div class="table-responsive">              
              <table class="table table-bordered" id="i_simpul">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Simpul</th>                    
                    <th style="width: 80px;">Aksi</th>
                  </tr>
                </thead>
                
                <tbody>
                  
                </tbody>
              </table>
            </div>             
          </div>
        </div>    
    </div> 
    <div class="col-md-6">
    <div class="card shadow mb-4">
          
          <div class="card-body">
            <div class="form-group">
              <label>Nama Simpul</label>
              <input type="text" id="nama_simpul" name="nama_simpul" class="form-control" required >     
            </div>
            
            <div class="form-group">
              <label>Map</label>
              <div id="mapi" style="width: 100%; height: 400px;">
              </div>
            </div>

            <div class="form-group">
              <label>Latitude</label>
              <input type="text" name="sLatitude" id="sLatitude" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Longitude</label>
              <input type="text" name="sLongitude" id="sLongitude" class="form-control" required>
            </div>

            <div class="modal-footer">
            <!-- <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button> -->
            <button type="button" id="simpan_simpul" class="btn btn-sm btn-primary">Simpan</button>
          </div>
          </div>
        </div>  
      
    </div>   
  </div>  
</div>

<form method="post" id="tambah_d_simpul" enctype="multipart/form-data">
<div class="modal fade" id="tambah_simpul" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Input</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         
          <div class="modal-body">
           
            <center><font color="red"><p id="pesan"></p></font></center>
            <div class="form-group">
              <label>Nama Simpul</label>
              <input type="text" id="nama_simpul" name="nama_simpul" class="form-control" required >     
            </div>
            
            <div class="form-group">
              <label>Map</label>
              <div id="mapi" style="width: 100%; height: 400px;">
              </div>
            </div>

            <div class="form-group">
              <label>Latitude</label>
              <input type="number" name="sLatitude" id="sLatitude" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Longitude</label>
              <input type="number" name="sLongitude" id="sLongitude" class="form-control" required>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
          </div>
           
        </div>
      </div>
    </div>
</form>

<script type="text/javascript">
  // var map = L.map('map').setView([5.216585, 97.061562], 14);

   var tileLayer = new L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      });
   // get coordinate location

   //remember last position
    var rememberLat = document.getElementById('sLatitude').value;
    var rememberLong = document.getElementById('sLongitude').value;
    if( !rememberLat || !rememberLong ) { rememberLat = 5.216585; rememberLong = 97.061562;}
    var mapi = new L.Map('mapi', {
    'center': [rememberLat, rememberLong],
    'zoom': 14,
    'layers': [tileLayer]
    });
    var marker = L.marker([rememberLat, rememberLong],{
    draggable: true
    }).addTo(mapi);
    marker.on('dragend', function (e) {
    updateLatLng(marker.getLatLng().lat, marker.getLatLng().lng);
    });
    mapi.on('click', function (e) {
    marker.setLatLng(e.latlng);
    updateLatLng(marker.getLatLng().lat, marker.getLatLng().lng);
    });
    function updateLatLng(lat,lng,reverse) {
    if(reverse) {
    marker.setLatLng([lat,lng]);
    mapi.panTo([lat,lng]);
    } else {
    document.getElementById('sLatitude').value = marker.getLatLng().lat;
    document.getElementById('sLongitude').value = marker.getLatLng().lng;
    mapi.panTo([lat,lng]);
    }
    }

    
</script>

