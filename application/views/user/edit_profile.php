<div class="container-fluid">
	<h3>Edit Profile</h3>
   <div class="card shadow mb-4">
   <div class="card-header py-3">	
	<div class="row">
		<div class="col-lg-6">
			<?php echo form_open_multipart('user/edit_profile'); ?> 
				<div class="form-group row">
				    <label for="email" class="col-sm-2 col-form-label">Email</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="email" name="email" readonly="" value="<?php echo $user['email']; ?>">
				    </div>
				  </div> 

				  <div class="form-group row">
				    <label for="name" class="col-sm-2 col-form-label">Nama</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" >
				      <?php echo form_error('name', '<small class="text-danger pl-3">','</small>'); ?>
				    </div>
				  </div>

				  <div class="form-group row">
				    <div class="col-sm-2">Picture</div>
				    <div class="col-sm-10">
				    	<div  class="row">
				    		<div class="col-sm-3">
				    			<img src="<?php echo base_url('assets/img/profile/').$user['image'];  ?>" class="img-thumbnail">
				    		</div>
				    		<div class="col-sm-9">
				    			<div class="custom-file">
								  <input type="file" class="custom-file-input" id="image" name="image">
								  <label class="custom-file-label" for="image">Choose file</label>
								</div>
				    		</div>
				    	</div>
				    </div>
				    
				  </div>

				  <div class="form-group row">
				  	<div class="col-sm-2"></div>
				  	<div class="col-sm-10">
				  		<button type="submit" class="btn btn-outline-primary">Edit</button>
				  	</div>
				  </div>
				
			</form>
		</div>
	</div>
</div>
</div>
</div>