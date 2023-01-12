<?php foreach ($detail as $det ) {
  $lat = $det->latitude;
  $long = $det->longitude;
} ?>
<!-- Begin Page Content -->
<div class="container-fluid"> 
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h 3class="m-0 font-weight-bold">Detail</h3>
    </div>
    <div class="card-body">

      <div class="card shadow mb-4">
          <div class="row">
              <div id="mapid" style="width: 100%; height: 400px;">
            </div>
          </div>
          
     </div>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="row">        
        <center>
          <table style="margin-left: 300px;"> 
            <?php foreach ($detail as $key ) : ?>
            <tr>
              <td>
                <center>
                  <font size="5"><?php echo $key->nama_kost ?></font>
                </center>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <hr class="garis1">
              </td>       
            </tr>
         </table>
         <table style="margin-left: 300px">
           <tr>
             <th style="width: 300px; height: 200px;">
              <?php if ($key->gambar){ ?>
              <img src="<?php echo base_url('assets/img/kostpict/').$key->gambar; ?>" class="img-thumbnail">
            <?php }else{ ?>
              <img src="<?php echo base_url('assets/img/kostpict/default.jpg')?>" class="img-thumbnail">
            <?php } ?>
            </th>
           </tr>
         </table>
          <table class="table2">
            <tr>
              <td>
                <br><br><br>
                <table align="left" width="630" style="margin-left: 30px;">
                 
                          <tr>
                            <th align="left" style="width: 100px;">Jenis Kost</th>
                            <th style="width: 20px;">:</th>
                            <th align="left"><?php echo $key->jenis_kost; ?></th>
                          </tr>
                          <tr>
                            <th align="left">Alamat Lengkap</th>
                            <th>:</th>
                            <th align="left"><?php echo $key->alamat_lengkap; ?></th>
                          </tr>
                          <tr>
                            <th align="left">Harga Kost</th>
                            <th>:</th>
                            <th align="left">Rp. <?php echo rupiah($key->harga_kost); ?> / Tahun</th>
                          </tr>
                          <tr>
                            <th align="left">Jarak Ke Kampus</th>
                            <th>:</th>
                            <th align="left"><?php echo $key->rute_ke_kampus; ?></th>
                          </tr>
                          <tr>
                            <th align="left">Kondisi Air</th>
                            <th>:</th>
                            <th align="left"><?php echo $key->kondisi_air; ?></th>
                          </tr>
                          <tr>
                            <th align="left">Luas Kamar</th>
                            <th>:</th>
                            <th align="left"><?php echo $key->luas_kamar; ?></th>
                          </tr>
                          <tr>
                            <th align="left">Letak Kamar Mandi</th>
                            <th>:</th>
                            <th align="left"><?php echo $key->letak_kamar_mandi; ?></th>
                          </tr>
                          <tr>
                            <th align="left">Dapur</th>
                            <th>:</th>
                            <th align="left"><?php echo $key->dapur; ?></th>
                          </tr> 
                          <tr>
                            <th align="left">WiFi</th>
                            <th>:</th>
                            <th align="left"><?php echo $key->wifi; ?></th>
                          </tr>
                          <tr>
                            <th align="left">Garasi</th>
                            <th>:</th>
                            <th align="left"><?php echo $key->garasi; ?></th>
                          </tr>
                          <tr>
                            <th align="left">Latitude</th>
                            <th>:</th>
                            <th align="left"><?php echo $key->latitude; ?></th>
                          </tr>
                          <tr>
                            <th align="left">Longitude</th>
                            <th>:</th>
                            <th align="left"><?php echo $key->longitude; ?></th>
                          </tr>
                          <tr>
                            <th align="left">Narahubung</th>
                            <th>:</th>
                            <th align="left"><?php echo $key->narahubung; ?></th>
                          </tr>
                          
                        
                </table>
              </td>
            </tr>
          </table>
          <?php endforeach; ?>
        </center>
      </div>
    </div>
  </div>

</div>

<!-- <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h 3class="m-0 font-weight-bold">Detail</h3>
    </div>
    <div class="card-body">
      <div class="card shadow mb-4">
          <div class="row">
               <table>
              <?php foreach ($detail as $key ) : ?>
              
              <th>
                <td><?php echo $key->nama_kost ?></td>
              </th>
            <?php endforeach; ?>
            </table>
          </div>
          
     </div>
  </div>
</div> -->



<script type="text/javascript">
      // var mapku = L.map('mapid').setView([<?php  $lat ?>, <?php  $long ?>], 20);
      var mapku = L.map('mapid').setView([5.154999353388613, 97.19732716435323], 10);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(mapku);

      var greenIcon = L.icon({
          iconUrl: 'http://localhost/regresi/leaf-green.png',
          shadowUrl: 'http://localhost/regresi/leaf-shadow.png',

          iconSize:     [38, 95], // size of the icon
          shadowSize:   [50, 64], // size of the shadow
          iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
          shadowAnchor: [4, 62],  // the same for the shadow
          popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
      });

  L.marker([<?php echo $lat ?>, <?php echo $long ?>]).addTo(mapku);
</script>
<?php var_dump($lat); ?>