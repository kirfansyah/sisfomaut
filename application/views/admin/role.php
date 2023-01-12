<div class="container-fluid">
	<h2>Role</h2>

<div class="card shadow mb-4">
   <div class="card-header py-3">
	<div class="row">
		<div class="col-lg-8">
			<?php echo form_error('menu','<div class="alert alert-danger" role="alert">','</div>'); ?>
			<?php echo $this->session->flashdata('message'); ?>
			<div class="table-responsive">
				<!-- <a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#roleModal">Tambah role baru</a> -->
				<table id="dataTable" class="table table-hover table-bordered" >
					<thead>
						<tr>
							<th>No</th>
							<th>Role</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no=1;
						 foreach($role as $r) : ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $r['role'] ?></td>
							<td>
								<a href="<?php echo base_url('admin/roleaccess/').$r['id']; ?>" class="badge badge-warning">access</a>
								<!-- <a href="" class="badge badge-success">edit</a>
								<a href="" class="badge badge-danger">delete</a> -->
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
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="roleModalLabel">Tambah role baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin/role') ;?>" method="post">
      <div class="modal-body">
      	<div class="form-group">
      		<input class="form-control" type="text" name="role" id="role" placeholder="Role name">
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