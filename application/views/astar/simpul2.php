<div class="container-fluid"> 
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h 3class="m-0 font-weight-bold">Data Simpul</h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
         <div class="row">
           <div class="col">
             <button id="ini-tambah-pembobotan" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#tambah_simpul"><i class="fa fa-plus fa-sm"></i> Tambah Data
            </button>
           </div>          
         </div>         
       
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

<form method="post" id="tambah_pembobotan_k" enctype="multipart/form-data">
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