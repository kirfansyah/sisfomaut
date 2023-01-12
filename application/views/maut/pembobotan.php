<div class="container-fluid"> 
  <!-- DataTales Example -->
  <div class="row">
    <div class="col-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h 3class="m-0 font-weight-bold">Pembobotan Alternatif</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kriteria</th>
                  <th>Pembobotan</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                  <td>1</td>
                  <td>Harga Kost</td>
                  <td>
                      2 Jt - 2.5 Jt = 3 <br>
                      2.6 Jt - 3 Jt = 2.625 <br>
                      3.1 Jt - 3.5 Jt = 2.25 <br>
                      3.6 Jt - 4 Jt = 1.875 <br>
                      4.1 Jt - 4.5 Jt = 1.5 <br>
                      4.6 Jt - 5 Jt = 1.125 <br>
                      5.1 Jt - 5.5 Jt = 0.75 <br>
                      Diatas 5.6 Jt = 0.375 <br>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Lokasi Kost Ke kampus</td>
                  <td>
                      0.6 Km - 1 Km = 3 <br>
                      1.1 Km - 1.5 Km = 2.5 <br>
                      1.6 Km - 2 Km = 2 <br>
                      2.1 Km - 2.5 Km = 1.5 <br>
                      2.6 Km - 3 Km = 1 <br>
                      Diatas 3 Km = 0.5 <br>

                  </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Kondisi Air</td>
                  <td>
                      Jernih = 3 <br>
                      Tidak Jernih = 1
                  </td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Luas Kamar</td>
                  <td>
                      4 x 4 = 3 <br>
                      3.5 x 3.5 = 2.625 <br>
                      3 x 4 = 2.25 <br>
                      3 x 3.5 = 1.875 <br>
                      3 x 3 = 1.5 <br>
                      2.5 x 3 = 1.125 <br>
                      2.5 x 2.5 = 0.75 <br>
                      2 x 3 = 0.375 <br>
                  </td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Letak Kamar mandi</td>
                  <td>
                      Dalam = 3 <br>
                      Luar = 1
                  </td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Dapur</td>
                  <td>
                      Peralatan Dapur Lengkap = 3 <br>
                      Peralatan Dapur Tidak Lengkap = 2 <br>
                      Dapur Kosong = 1 <br>
                      Tidak Ada Dapur = 0
                  </td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>Akses Internet (WiFi)</td>
                  <td>
                     Jaringan Lancar = 3 <br>
                      Jaringan Tidak Lancar = 1 <br>
                      Tidak Ada = 0
                  </td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>Garasi</td>
                  <td>
                    Luas = 3 <br>
                    Sedang = 2 <br>
                    Kecil = 1 <br>
                    Tidak Ada = 0
                  </td>
                </tr>
                </tbody>
                
              
            </table>        
          </div>  
        </div>
      </div>
    </div>

    <div class="col-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h 3class="m-0 font-weight-bold">Pembobotan Alternatif</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
             <div class="row">
               <div class="col">
                 <button id="ini-tambah-pembobotan" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#tambah_data_pembobotan"><i class="fa fa-plus fa-sm"></i> Tambah Data
                </button>
               </div>          
             </div>         
           
            <table class="table table-bordered" id="i_pembobotan_k">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kost</th>
                  <th>Jenis Kost</th>             
                  <th>Harga Kost</th>
                  <th>Jarak Ke Kampus</th>
                  <th>Kondisi Air</th>
                  <th>Luas Kamar</th>
                  <th>Letak Kamar Mandi</th>
                  <th>Dapur</th>
                  <th>Wifi</th>
                  <th>Garasi</th>
                  <th style="width: 50px;">Aksi</th>
                </tr>
              </thead>
              
              <tbody>
                
              </tbody>
            </table>
          </div>   
        </div>
      </div>
    </div>
    </div>
  </div>
  

<form method="post" id="tambah_pembobotan_k" enctype="multipart/form-data">
<div class="modal fade" id="tambah_data_pembobotan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <label>Nama Kost</label>
              <select class="form-control" name="nama_kost3" id="nama_kost3" required>
                <option selected="">--Pilih--</option>
              <?php foreach($pembobotan as $p) :?>
                <option value="<?php echo $p->id_rekap_data_kost ?>"><?php echo $p->nama_kost?></option>
              <?php endforeach; ?>
              </select>
              <input type="hidden" id="id_rekap_data_kost" name="id_rekap_data_kost4" class="form-control" required>
              <input type="hidden" id="nama_kost4" name="nama_kost4" class="form-control" required>
              
            </div>

            <div class="form-group">
              <label>Jenis Kost</label>
              <input type="text" id="jenis_kost4" name="jenis_kost4" class="form-control" required readonly="">     
            </div>
            
            <div class="form-group">
              <label>Harga Kost</label>
              <input type="number" name="harga_kost4" class="form-control" required>
            </div>

        <div class="form-group">
              <label>Jarak ke Kampus</label>
              <input type="number" name="rute_ke_kampus4" class="form-control" required>
            </div>

        <div class="form-group">
              <label>Kondisi Air</label>
              <input type="number" name="kondisi_air4" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Luas Kamar</label>
              <input type="number" name="luas_kamar4" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Letak Kamar Mandi</label>
              <input type="number" name="letak_kamar_mandi4" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Dapur</label>
              <input type="number" name="dapur4" class="form-control" required>              
            </div>

            <div class="form-group">
              <label>WiFi</label>
              <input type="number" name="wifi4" class="form-control" required> 
            </div>

            <div class="form-group">
              <label>Garasi</label>
              <input type="number" name="garasi4" class="form-control" required>
              </select> 
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

<form method="post" id="update_pembobotan_k" enctype="multipart/form-data">
<div class="modal fade" id="ubah_data_pembobotan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <label>Nama Kost</label>              
              <input type="hidden" id="id_rekap_data_kost" name="id_rekap_data_kost5" class="form-control" required>
              <input type="text" id="nama_kost5" name="nama_kost5" class="form-control" readonly="" required>
              <input type="hidden" id="id_pembobotan5" name="id_pembobotan5" class="form-control" readonly="" required>
              
            </div>

            <div class="form-group">
              <label>Jenis Kost</label>
              <input type="text" id="jenis_kost5" name="jenis_kost5" class="form-control" required readonly="">     
            </div>
            
            <div class="form-group">
              <label>Harga Kost</label>
              <input type="number" name="harga_kost5" class="form-control" required>
            </div>

        <div class="form-group">
              <label>Jarak ke Kampus</label>
              <input type="number" name="rute_ke_kampus5" class="form-control" required>
            </div>

        <div class="form-group">
              <label>Kondisi Air</label>
              <input type="number" name="kondisi_air5" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Luas Kamar</label>
              <input type="number" name="luas_kamar5" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Letak Kamar Mandi</label>
              <input type="number" name="letak_kamar_mandi5" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Dapur</label>
              <input type="number" name="dapur5" class="form-control" required>              
            </div>

            <div class="form-group">
              <label>WiFi</label>
              <input type="number" name="wifi5" class="form-control" required> 
            </div>

            <div class="form-group">
              <label>Garasi</label>
              <input type="number" name="garasi5" class="form-control" required>
              </select> 
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-primary">Update</button>
          </div>
           
        </div>
      </div>
    </div>
</form>