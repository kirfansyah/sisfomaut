<!-- Begin Page Content -->
<div class="container-fluid">     
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h 3 class="m-0 font-weight-bold">Cari Rute</h3>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card-body">
            <div class="form-group">
              <label>Titik Awal</label>
              <select class="form-control" name="titik_awal" id="titik_awal" required>
                <option selected="" value="">--Pilih--</option>
                <?php foreach ($posts as $post) :  ?>
                <option value="<?php echo $post->id_simpul ?>"><?php echo $post->nama_simpul ?></option>
                <?php endforeach; ?>
              </select>          
            </div>

            <div class="form-group">
              <label>Titik Akhir</label>
              <select class="form-control" name="titik_akhir" id="titik_akhir" required>
                <option selected="" value="">--Pilih--</option>
                <?php foreach ($posts as $post) :  ?>
                <option value="<?php echo $post->id_simpul ?>"><?php echo $post->nama_simpul ?></option>
                <?php endforeach; ?>
              </select>          
            </div>
             <button type="button" id="cari" class="btn btn-sm btn-primary">Cari</button>  
          </div>
        </div>
        <div class="col-md-6">
          <div class="card-body">
            <div id="mapcontainer3"> 
              <div id="maprute" style="width: 100%; height: 400px;">           
            </div>
            </div>            
        </div> 
        </div>
      </div>
  </div>       
</div>