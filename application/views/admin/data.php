<!-- Begin Page Content -->
<div class="container-fluid"> 
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h 3class="m-0 font-weight-bold">Data</h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
         <div class="row"> 
          <div class="col-6">
            <form method="post" id="import_data" enctype="multipart/form-data">
              <div class="input-group mb-3">
                <div class="custom-file">         
                  <input type="file" class="custom-file-input" name="file" id="file" required="" accept=".xls, .xlsx">      
                  <label class="custom-file-label" for="file1">Pilih File Excel</label>   
                </div>
                <div class="input-group-append">
                  <button type="submit" name="import" class="btn btn-sm btn-primary"><i class="fa fa-file-import"></i>  Import</button> 
                  
                </div>
              </div>  
            </form>         
          </div>
         </div>

         <div class="row">
           <div class="col">
             <button id="ini-tambah" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#tambah_data"><i class="fa fa-plus fa-sm"></i> Tambah Data
            </button>

            <button id="kosong" name="kosong" type="button" class="btn btn-sm btn-danger mb-2"><i class="fa fa-trash fa-sm"></i> Kosongkan Data
            </button>
           </div>          
         </div>
        

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <select class="form-control" id="pilih-tanaman">
                <option selected="" value="">Pilih Tanaman</option>
                <?php foreach($tanaman as $tnm) : ?>            
                <option value="<?php echo $tnm->jenis_tanaman; ?>"><?php echo $tnm->jenis_tanaman; ?></option>
                <?php endforeach; ?>                
              </select>                    
            </div>        
          </div>
        </div> 
        
        <div id="flash"></div>
        <table class="table table-bordered" id="records">
          <thead>
            <tr>
              <th>No</th>
              <th>Wilayah</th>
              <th>Luas Tanam (Ha)</th>
              <th>Luas Panen (Ha)</th>
              <th>Produktivitas</th>
              <th>Produksi</th>
              <th>Tahun</th>
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
          <label>Wilayah</label>
          <input type="text" name="nama_wilayah" class="form-control">
        </div>

        <div class="form-group">
          <label>Kode Wilayah</label>
          <input type="text" name="kode_wilayah" class="form-control">
        </div>

        <div class="form-group">
          <label>Luas Tanam (Ha)</label>
          <input type="text" name="luas_tanam" class="form-control">
        </div>

        <div class="form-group">
          <label>Luas Panen (Ha)</label>
          <input type="text" name="luas_panen" class="form-control">
        </div>

        <div class="form-group">
          <label>Produktivitas</label>
          <input type="text" name="produktivitas" class="form-control">
        </div>

        <div class="form-group">
          <label>Produksi</label>
          <input type="text" name="produksi" class="form-control">
        </div>

        <div class="form-group">
          <label>Tahun</label>          
          <input type="text" name="tahun" class="form-control">
        </div>    

        <div class="form-group">
          <label>Jenis Tanaman</label>          
          <input type="text" name="jenis_tanaman" class="form-control">
        </div> 
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" id="btn-tambah" class="btn btn-sm btn-primary">Tambah</button>
      </div>
       
    </div>
  </div>
</div>
<!-- Modal Edit-->
<div class="modal fade" id="ubah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <label>Wilayah</label>
          <input type="text" name="nama_wilayah2" class="form-control">
          <input type="hidden" name="id_wilayah2" value="" class="form-control">
        </div>

        <div class="form-group">
          <label>Kode Wilayah</label>
          <input type="text" name="kode_wilayah2" class="form-control">
        </div>

        <div class="form-group">
          <label>Luas Tanam (Ha)</label>
          <input type="text" name="luas_tanam2" class="form-control">
        </div>

        <div class="form-group">
          <label>Luas Panen (Ha)</label>
          <input type="text" name="luas_panen2" class="form-control">
        </div>

        <div class="form-group">
          <label>Produktivitas</label>
          <input type="text" name="produktivitas2" class="form-control">
        </div>

        <div class="form-group">
          <label>Produksi</label>
          <input type="text" name="produksi2" class="form-control">
        </div>

        <div class="form-group">
          <label>Tahun</label>          
          <input type="text" name="tahun2" class="form-control">
        </div>

         <div class="form-group">
          <label>Jenis Tanaman</label>          
          <input type="text" name="jenis_tanaman2" class="form-control">
        </div>    
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" id="btn-ubah" class="btn btn-sm btn-success">Ubah</button>
      </div>
       
    </div>
  </div>
</div> 
<script>
  var map = L.map('mapid').setView([5.154999353388613, 97.19732716435323], 10);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
</script>