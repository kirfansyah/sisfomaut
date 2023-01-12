<div class="container-fluid">
  <div class="card shadow mb-4">            
    <div class="card-body">
      <div class="row">
        <div class="col">
          <center><img style="height: 100px; width: 100px;" src="<?php echo base_url('assets/img/logo.jpg') ?>"></center>
        </div>
      </div>
       <div class="row mt-3">
        <div class="col-md-12 col-xl-12">
          <center><h2>
            <?php
            echo strtoupper("Sistem Informasi geografis pemetaan dalam pemilihan tempat kost di sekitar Universitas Malikussaleh menggunakan metode MAUT dan Algoritma Astar");
            ?></h2>
        </div>
      </div>
      
    </div>
  </div>
  <div class="card shadow mb-4">            
    <div class="card-body">
        <div class="row">
          <div id="mapid" style="width: 100%; height: 210px;">
        </div>
      </div>
  </div>
</div></div>
<script type="text/javascript">
  var map = L.map('mapid').setView([5.154999353388613, 97.19732716435323], 10);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
</script>

