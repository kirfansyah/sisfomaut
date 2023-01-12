<div class="container-fluid">
	<h2>Role</h2>

<div class="card shadow mb-4">
   <div class="card-header py-3">
	<div class="row">
		<div class="col-lg-8">
			
			<?php echo $this->session->flashdata('message'); ?>
			<div class="table-responsive">	
			<h5>Role: <?php echo $role['role']; ?></h5>		
				<table id="dataTable" class="table table-hover table-bordered" >
					<thead>
						<tr>
							<th>No</th>
							<th>Menu</th>
							<th>Akses</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no=1;
						 foreach($menu as $m) : ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $m['menu'] ?></td>
							<td>
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" id="coba" <?php echo check_access($role['id'], $m['id']);?> data-role="<?php echo $role['id']; ?>" data-menu="<?php echo $m['id']; ?>">		  
								</div>
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

