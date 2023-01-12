<div class="container-fluid">	
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h 3class="m-0 font-weight-bold">Data Uji</h3>
	    </div>
	   <div class="card-body"> 

	   	<div class="row"> 
	     	<div class="col-6">
	     		<form method="post" id="import_form" enctype="multipart/form-data">
	     			<div class="input-group mb-3">
					  <div class="custom-file">	 				
		 				<input type="file" class="custom-file-input" name="file1" id="file1" required="" accept=".xls, .xlsx">	 		
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
	     	<div class="col-6">
				<div class="input-group mb-3">
				  <select class="form-control" id="pilih-tan">
	                <option selected="" value="">Pilih Tanaman</option>
	                <?php foreach($jenis_kos as $tnm) : ?>            
	                <option value="<?php echo $tnm->jenis_tanaman; ?>"><?php echo $tnm->jenis_tanaman; ?></option>
	                <?php endforeach; ?>     
	              </select>  
	              <select class="form-control" id="pilih-tah">
	                <option selected="" value="">Pilih Tahun</option>
	                <?php foreach($tahun as $thn) : ?>            
	                <option value="<?php echo $thn->tahun; ?>"><?php echo $thn->tahun; ?></option>
	                <?php endforeach; ?>     
	              </select> 
				  <div class="input-group-append">
				    <button class="btn btn-sm btn-outline-primary" type="button" name="mulai" id="mulai"><i class="fa fa-play"></i> Mulai</button>
				  </div>
				</div>	     		
	     	</div>	
	     </div>
 
	     <div class="row">
	     	<div class="col">
	     		<div class="table-responsive">
	     			<table class="table table-bordered" id="records2">
			          <thead>
			            <tr>
			              <th>No</th>
	                  	  <th>Wilayah</th>
			              <th>Luas Tanam (Ha)</th>
			              <th>Luas Panen (Ha)</th>
			              <th>Produktivitas</th>
			              <th>Jenis Tanaman</th>
			              <!-- <th>Tahun</th> -->
			            </tr>
			          </thead>			          
			          <tbody>			            
			          </tbody>
			        </table>			        
	     		</div>
	     	</div>
	     </div>

	     <!-- <div id="mapid" style="width: 100%; height: 400px;">
		
		</div>	 -->

	   </div>
	 </div>	 
 
	<div id="konten">
	  	
	</div>
</div>

<script>
  var map = L.map('mapid').setView([5.154999353388613, 97.19732716435323], 10);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
</script>