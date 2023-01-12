<!-- Begin Page Content -->

<div class="container-fluid"> 
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h 3class="m-0 font-weight-bold">Graph</h3>
    </div>
    <div class="card-body">

       <div class="card-body">      
        <div class="row" id="mapcontainer2">
          <div id="mapku" style="width: 100%; height: 400px;">
        </div>
      </div>
  
     </div>
    </div>
  </div>

  <div class="card shadow mb-4">    
    <div class="card-body">

             
        <div class="row">
          <div class="card-body">
            <div class="table-responsive">
               <div class="row">
                 <div class="col">
                   <button id="ini-tambah" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#tambah_graph"><i class="fa fa-plus fa-sm"></i> Tambah Data
                  </button>
                 </div>          
               </div>        
             
              <table class="table table-bordered" id="i_graph">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Graph Awal</th>
                    <th>Graph Akhir</th>
                    <th>Jarak (Km)</th>
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
    </div>
  </div>
</div>
</div>

<form method="post" id="tambah_data_graph" enctype="multipart/form-data">
        <div class="modal fade" id="tambah_graph" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <label>Graph Awal</label>
              <select class="form-control" name="graphAwal" required>
                <option selected="">--Pilih--</option>
                <?php foreach ($posts as $post) :  ?>
                <option value="<?php echo $post->sLatitude ?>,<?php echo $post->sLongitude ?>,<?php echo $post->id_simpul ?>"><?php echo $post->nama_simpul ?></option>
                <?php endforeach; ?>
              </select>          
            </div>

            <div class="form-group">
              <label>Graph Akhir</label>
              <select class="form-control" name="graphAkhir" required>
                <option selected="">--Pilih--</option>
                <?php foreach ($posts as $post) :  ?>
                <option value="<?php echo $post->sLatitude ?>,<?php echo $post->sLongitude ?>,<?php echo $post->id_simpul ?>"><?php echo $post->nama_simpul ?></option>
                <?php endforeach; ?>
              </select>          
            </div>            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" id="btn-tambah-data-graph" class="btn btn-sm btn-primary">Tambah</button>
          </div>
           
        </div>
      </div>
    </div>
 </form>



<script type="text/javascript">

  
  

</script>