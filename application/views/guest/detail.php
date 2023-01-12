<?php foreach ($data as $key) {
  $gambar = $key->gambar;
  $nama_kost = $key->nama_kost;
} ?>
<div class="container-fluid"> 
  <!-- DataTales Example -->
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h5 class="m-0 font-weight-bold"><?php echo $nama_kost; ?></h5>
        </div>
        <div class="card-body">
          <?php if($gambar!=''){ ?>
            <img style="width: 100%; height: 400px;" src="<?php echo base_url('assets/img/kostpict/').$gambar ?>" class="card-img-top" alt="">
          <?php }else{ ?>
            <img style="width: 100%; height: 400px;" src="https://source.unsplash.com/630x360?villa" class="card-img-top" alt="">
          <?php } ?>     
        </div>
      </div>
    </div>    
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card shadow mb-4">        
        <div class="card-body">
          <div class="table-responsive">
            <?php foreach ($data as $key) : ?>
            <table class="table2">
            <tr>
              <td>
                <br>
                <table align="left" width="630" style="margin-left: 30px;">
                 
                          <tr>
                            <th align="left" style="width: 150px;">Jenis Kost</th>
                            <th style="width: 20px;">:</th>
                            <th align="left"><?php echo $key->jenis_kost; ?></th>
                          </tr>
                          <tr>
                            <th align="left">Alamat Lengkap</th>
                            <th>:</th>
                            <th style="width: 400px;" align="left"><div class="form-group">
                                    <?php echo $key->alamat_lengkap; ?>
                                  </div></th>
                          </tr>
                          <tr>
                            <th align="left">Harga Kost</th>
                            <th>:</th>
                            <th align="left"><div class="badge badge-success">Rp. <?php echo rupiah($key->harga_kost); ?> / Tahun</div></th>
                          </tr>
                          <tr>
                            <th align="left">Jarak Ke Kampus</th>
                            <th>:</th>
                            <th align="left"><div class="badge badge-warning"><?php echo $key->rute_ke_kampus; ?></div> Km</th>
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
                            <th align="left">Narahubung</th>
                            <th>:</th>
                            <th align="left"><?php echo $key->narahubung; ?></th>
                          </tr>
                          
                        
                </table>
              </td>
            </tr>
          </table>
          
          </div>
          
              
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card shadow mb-4">        
        <div class="card-body">
          <button style="width: 100%;" class="btn btn-sm btn-primary mb-2" id="cari"><i class="fa fa-search"></i> Cari rute</button>
          <input type="hidden" name="" id="latitude" value="<?php echo $key->latitude; ?>">
          <input type="hidden" name="" id="longitude" value="<?php echo $key->longitude; ?>">
          <input type="hidden" name="" id="id_rekap_data_kost" value="<?php echo $key->id_rekap_data_kost; ?>">
           <div id="mapcontainer3"> 
              <div id="maprute" style="width: 100%; height: 400px;">           
            </div>
          </div>              
        </div>
      </div>
    </div>
  </div>
  

</div>
<?php endforeach; ?>
