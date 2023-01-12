<div class="container-fluid"> 
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h 3class="m-0 font-weight-bold">Bobot</h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
         <!-- <div class="row">
           <div class="col">
             <button id="ini-tambah-pembobotan" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#tambah_data_bobot"><i class="fa fa-plus fa-sm"></i> Tambah Data
            </button>
           </div>          
         </div> -->         
       
        <table class="table table-bordered" id="i_bobot">
          <thead>
            <tr>
              <th>No</th>
              <th>Kriteria</th>
              <th>Bobot</th>   
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

<form method="post" id="tambah_bobot" enctype="multipart/form-data">
<div class="modal fade" id="tambah_data_bobot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <label>Kriteria Kost</label>              
              <input type="text" id="kriteria_kost" name="kriteria_kost" class="form-control" required>              
            </div>

            <div class="form-group">
              <label>Bobot</label>
              <input type="number" id="bobot" name="bobot" class="form-control" required >     
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

<form method="post" id="update_bobot" enctype="multipart/form-data">
<div class="modal fade" id="ubah_data_bobot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <label>Kriteria Kost</label>              
              <input type="text" id="kriteria_kost" name="kriteria_kost2" class="form-control" readonly="" required>              
              <input type="hidden" id="id_bobot_k" name="id_bobot_k" class="form-control" required>              
            </div>

            <div class="form-group">
              <label>Bobot</label>
              <input type="number" id="bobot" name="bobot2" class="form-control" required >     
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