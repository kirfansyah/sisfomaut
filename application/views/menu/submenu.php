<div class="container-fluid">
	<h2>Menu Management</h2>

<div class="card shadow mb-4">
   <div class="card-header py-3">
	<div class="row">
		<div class="col-lg-12">
			<?php if(validation_errors()) : ?>
				<div class="alert alert-danger" role="alert">
					<?php echo validation_errors(); ?>
				</div>
			<?php endif; ?>
			<?php echo form_error('menu','<div class="alert alert-danger" role="alert">','</div>'); ?>
			<?php echo $this->session->flashdata('message'); ?>
			<div class="table-responsive">
				<a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#submenuexampleModal">Tambah submenu baru</a>
				<table id="dataTable" class="table table-hover table-bordered" >
					<thead>
						<tr>
							<th>No</th>
							<th>Title</th>
							<th>Menu</th>
							<th>Url</th>
							<th>Icon</th>
							<th>Active</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no=1;
						 foreach($subMenu as $sm) : ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $sm['title'] ?></td>
							<td><?php echo $sm['menu'] ?></td>
							<td><?php echo $sm['url'] ?></td>
							<td><?php echo $sm['icon'] ?></td>
							<td><?php echo $sm['is_active'] ?></td>
							<td>
								<a href="" class="badge badge-success">edit</a>
								<a href="" class="badge badge-danger">delete</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="submenuexampleModal" tabindex="-1" role="dialog" aria-labelledby="submenuexampleModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="submenuexampleModal">Tambah Menu Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('menu/submenu') ;?>" method="post">
      <div class="modal-body">
      	<div class="form-group">
      		<input class="form-control" type="text" name="title" id="title" placeholder="Nama menu">
      	</div>
      	<div class="form-group">
      		<select name="menu_id" id="menu_id" class="form-control">
      			<option>--Select Menu--</option>
      			<?php foreach($menu as $m) : ?>
      			<option value="<?php echo $m['id']; ?>"><?php echo $m['menu']; ?></option>
      			<?php endforeach; ?>
      		</select>
      	</div> 
      	<div class="form-group">
      		<input class="form-control" type="text" name="url" id="url" placeholder="Submenu Url">
      	</div> 
      	<div class="form-group">
      		<input class="form-control" type="text" name="icon" id="icon" placeholder="Submenu Icon">
      	</div>
      	<div class="form-group">
      		<div class="input-group mb-3">
			  <div class="input-group-prepend">
			    <div class="input-group-text">
			      <input type="checkbox" checked="" value="1" name="is_active" id="is_active" aria-label="Checkbox for following text input">
			    </div>
			  </div>
			  <input type="text" class="form-control" aria-label="Text input with checkbox" readonly="" placeholder="Active ?">		  
			</div>
      	</div>      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div> 