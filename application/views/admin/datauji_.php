<!-- Begin Page Content -->
<div class="container-fluid"> 
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h 3class="m-0 font-weight-bold">Data Uji</h3>
    </div>
    <div class="card-body"> 

     <div class="row"> 
     	<div class="col-6">
     		<form method="post" id="import_form" enctype="multipart/form-data">
	 			<div class="custom-file">	 				
	 				<input type="file" class="custom-file-input" name="file1" id="file1" required="" accept=".xls, .xlsx">	 		
	 				<label class="custom-file-label" for="file1">Pilih File Excel</label>		
	 			</div>

	 			<button type="submit" name="import" class="btn btn-sm btn-primary mt-2 mb-2"><i class="fa fa-file-import"></i>  Import</button>
	 			<button type="button" id="mulai" name="mulai" class="btn btn-sm btn-primary mt-2 mb-2"><i class="fa fa-play"></i>  Mulai</button>				
	 			
     		</form>     		
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


  <div id="konten">
  	<!-- <div class="card shadow mb-4">
  		<div class="card-body">
  		<p>HALAL</p>
	  </div>
	 </div>	
	 <div class="card shadow mb-4">
  		<div class="card-body">
  		<p>\begin{bmatrix}a & b \\c & d \end{bmatrix}</p>
	  </div>
	 </div>	 -->
  </div>
  

<!-- /.container-fluid
