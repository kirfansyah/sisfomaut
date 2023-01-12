<!-- Begin Page Content -->
<div class="container-fluid"> 
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h 3class="m-0 font-weight-bold">Perhitungan Maut</h3>
    </div>
    <div class="card-body">

       <div class="card-body">
        <div class="row mb-3">
            
              <button class="btn btn-sm btn-outline-primary" type="button" name="mulai" id="mulai"><i class="fa fa-play"></i> Mulai Perhitungan MAUT</button>
            
        </div>  
        <div class="row">
          <div id="mapidu" style="width: 100%; height: 400px;">
        </div>
      </div>


  
     </div>
    </div>
  </div>

   <div id="disini"> 
        
    </div>
</div>

<script type="text/javascript">
  var map = L.map('mapidu').setView([5.216585, 97.061562], 14);

   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      var greenIcon = L.icon({
          iconUrl: 'http://localhost/regresi/leaf-green.png',
          shadowUrl: 'http://localhost/regresi/leaf-shadow.png',

          iconSize:     [38, 95], // size of the icon
          shadowSize:   [50, 64], // size of the shadow
          iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
          shadowAnchor: [4, 62],  // the same for the shadow
          popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
      });

  
<?php   foreach ($lokasi as $d) { ?>

  L.marker([<?php echo $d->latitude ?>, <?php   echo $d->longitude ?>]).bindPopup('Kos Untuk : <?php echo $d->jenis_kost; ?><br><a href="<?php  echo base_url('maut/detail_data_rekap/') ?><?php  echo $d->id_rekap_data_kost ?>">Lihat Detail...</a>').addTo(map);
<?php   } ?>
</script>