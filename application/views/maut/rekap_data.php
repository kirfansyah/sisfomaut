<div class="container-fluid"> 
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h 3class="m-0 font-weight-bold">Rekap Data</h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
         <div class="row">
           <div class="col">
             <button id="ini-tambah" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#tambah_data"><i class="fa fa-plus fa-sm"></i> Tambah Data
            </button>
           </div>          
         </div>        
       
        <table class="table table-bordered" id="i_rekap_data">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Kost</th>
              <th>Jenis Kost</th>
              <th>Alamat Lengkap</th>
              <th>Harga Kost</th>
              <th style="width: 100px;">Aksi</th>
            </tr>
          </thead>
          
          <tbody>
            
          </tbody>
        </table>
      </div>

    </div>
  </div>

</div>

<!-- /.container-fluid -->

<!-- Modal -->
 <form method="post" id="tambah_data_rekap" enctype="multipart/form-data">
      	<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
		          <input type="text" name="nama_kost" class="form-control" required>
		        </div>

		        <div class="form-group">
		          <label>Jenis Kost</label>
		          <select class="form-control" name="jenis_kost" required>
		            <option selected="">--Pilih Jenis Kost--</option>
		            <option>Laki-laki</option>
		            <option>Perempuan</option>
		          </select>          
		        </div>

		        <div class="form-group">
		          <label>Alamat lengkap</label>
		          <input type="text" name="alamat_lengkap" class="form-control" required>
		        </div>

		        <div class="form-group">
		          <label>Harga Kost</label>
		          <input type="text" name="harga_kost" class="form-control" required>
		        </div>

				<div class="form-group">
		          <label>Jarak ke Kampus</label>
		          <input type="text" name="rute_ke_kampus" class="form-control" required>
		        </div>

				<div class="form-group">
		          <label>Kondisi Air</label>
		           <select class="form-control" name="kondisi_air" required>
		            <option selected="">--Pilih--</option>
		            <option>Jernih</option>
		            <option>Tidak Jernih</option>
		          </select>        
		        </div>

		        <div class="form-group">
		          <label>Luas Kamar</label>
		          <input type="text" name="luas_kamar" class="form-control" required>
		        </div>

		        <div class="form-group">
		          <label>Letak Kamar Mandi</label>
		          <select class="form-control" name="letak_kamar_mandi" required>
		            <option selected="">--Pilih--</option>
		            <option>Didalam Kamar</option>
		            <option>Diluar Kamar</option>
		          </select> 
		        </div>

		        <div class="form-group">
		          <label>Dapur</label>
		          <select class="form-control" name="dapur" required>
		            <option selected="">--Pilih--</option>
		            <option>Kosong</option>
		            <option>Lengkap</option>
		            <option>Tidak Lengkap</option>
		            <option>Tidak Ada</option>
		          </select> 
		        </div>

		        <div class="form-group">
		          <label>WiFi</label>
		          <select class="form-control" name="wifi" required>
		            <option selected="">--Pilih--</option>
		            <option>Tidak ada</option>
		            <option>Tidak Lancar</option>
		            <option>Lancar</option>
		          </select> 
		        </div>

		        <div class="form-group">
		          <label>Garasi</label>
		          <select class="form-control" name="garasi" required>
		            <option selected="">--Pilih--</option>
		            <option>Kecil</option>
		            <option>Sedang</option>
		            <option>Luas</option>
		            <option>Tidak Ada</option>
		          </select> 
		        </div>

		        <div class="form-group">
		          <label>Latitude</label>
		          <input type="text" name="latitude" class="form-control" required>
		        </div>

		        <div class="form-group">
		          <label>Longitude</label>
		          <input type="text" name="longitude" class="form-control" required>
		        </div>

		        <div class="form-group">
		          <label>Narahubung</label>
		          <input type="text" name="narahubung" class="form-control" required>
		        </div>

		        <div class="form-group">
		          <label>Gambar</label>
		          <!-- <input type="text" name="gambar" class="form-control" required> -->
		          <div  class="row">
		          	<div class="col-sm-9 mb-3">
		    			<div class="custom-file">
						  <input type="file" class="custom-file-input" name="image" name="image">
						  <label class="custom-file-label" for="image">Choose file</label>
						</div>
		    		</div>
		    		<div class="col-sm-6">
		    			<img src="<?php echo base_url('assets/img/kostpict/default.jpg') ?>" class="img-thumbnail">
		    		</div>
		    		
			    	</div>
		        </div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
		        <button type="submit" id="btn-tambah-data-rekap" class="btn btn-sm btn-primary">Tambah</button>
		      </div>
		       
		    </div>
		  </div>
		</div>
 </form>

<!-- Modal Edit-->
<form method="post" id="update_data_rekap" enctype="multipart/form-data">
	<div class="modal fade" id="ubah_data_rekap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
		          <input type="text" name="nama_kost2" class="form-control" required>
		          <input type="hidden" name="id_rekap_data_kost" class="form-control" required>
		        </div>

		        <div class="form-group">
		          <label>Jenis Kost</label>
		          <select class="form-control" name="jenis_kost2" required>
		            <option selected="">--Pilih Jenis Kost--</option>
		            <option>Laki-laki</option>
		            <option>Perempuan</option>
		          </select>          
		        </div>

		        <div class="form-group">
		          <label>Alamat lengkap</label>
		          <input type="text" name="alamat_lengkap2" class="form-control" required>
		        </div>

		        <div class="form-group">
		          <label>Harga Kost</label>
		          <input type="text" name="harga_kost2" class="form-control" required>
		        </div>

				<div class="form-group">
		          <label>Jarak ke Kampus</label>
		          <input type="text" name="rute_ke_kampus2" class="form-control" required>
		        </div>

				<div class="form-group">
		          <label>Kondisi Air</label>
		           <select class="form-control" name="kondisi_air2" required>
		            <option selected="">--Pilih--</option>
		            <option>Jernih</option>
		            <option>Tidak Jernih</option>
		          </select>        
		        </div>

		        <div class="form-group">
		          <label>Luas Kamar</label>
		          <input type="text" name="luas_kamar2" class="form-control" required>
		        </div>

		        <div class="form-group">
		          <label>Letak Kamar Mandi</label>
		          <select class="form-control" name="letak_kamar_mandi2" required>
		            <option selected="">--Pilih--</option>
		            <option>Didalam Kamar</option>
		            <option>Diluar Kamar</option>
		          </select> 
		        </div>

		        <div class="form-group">
		          <label>Dapur</label>
		          <select class="form-control" name="dapur2" required>
		            <option selected="">--Pilih--</option>
		            <option>Kosong</option>
		            <option>Lengkap</option>
		            <option>Tidak Lengkap</option>
		            <option>Tidak Ada</option>
		          </select> 
		        </div>

		        <div class="form-group">
		          <label>WiFi</label>
		          <select class="form-control" name="wifi2" required>
		            <option selected="">--Pilih--</option>
		            <option>Tidak Ada</option>
		            <option>Tidak Lancar</option>
		            <option>Lancar</option>
		          </select> 
		        </div>

		        <div class="form-group">
		          <label>Garasi</label>
		          <select class="form-control" name="garasi2" required>
		            <option selected="">--Pilih--</option>
		            <option>Kecil</option>
		            <option>Sedang</option>
		            <option>Luas</option>
		            <option>Tidak Ada</option>
		          </select> 
		        </div> 

		        <div class="form-group">
		          <label>Latitude</label>
		          <input type="text" name="latitude2" class="form-control" required>
		        </div>

		        <div class="form-group">
		          <label>Longitude</label>
		          <input type="text" name="longitude2" class="form-control" required>
		        </div>

		        <div class="form-group">
		          <label>Narahubung</label>
		          <input type="text" name="narahubung2" class="form-control" required>
		        </div>

		         <div class="form-group">
		          <label>Gambar</label>
		          <!-- <input type="text" name="gambar" class="form-control" required> -->
		          <div  class="row">
		          	<div class="col-sm-9 mb-3">
		    			<div class="custom-file">
						  <input type="file" class="custom-file-input" name="image2">
						  <label class="custom-file-label" for="image2">Choose file</label>
						</div>
		    		</div>
		    		<div class="col-sm-6" id="gambar_rumah">
		    			<img src="<?php echo base_url('assets/img/kostpict/default.jpg') ?>" class="img-thumbnail">
		    		</div>
		    		
			    	</div>
		        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
        <button type="submit" id="btn-update-kasus" class="btn btn-sm btn-success">Ubah</button>
      </div>
       
    </div>
  </div>
</div> 
</form>
