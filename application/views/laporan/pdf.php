<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<style type="text/css">
	hr.garis1 {
  	border: 1px solid;
	}
	table tr td{
		font-size: 13px;
	}
	table tr .text{
		text-align: right;
		font-size: 13px;
	}

	table .last {
		border-collapse: collapse;
	}
	/*design table 1*/
	.table1 {
	    font-family: sans-serif;
	    color: #232323;
	    border-collapse: collapse;
	}
	 
	.table1 {
	    border: 1px solid #999;
	    padding: 6px;
	    text-align: center;
	}
	</style>
</head>

<body>
	<center>
		<table width="520"> 
			<tr>
				<td>
					<center>
						<img src="logo.jpg" width="90" height="90">
					</center>					
				</td>
				<td width="80%">
					<center>
						<font size="5">LAPORAN HASIL PERAMALAN TANAMAN</font><br>
						<font size="5">PALAWIJA MENGGUNAKAN METODE</font><br>
						<font size="5">REGRESI LINIER BERGANDA</font>
					</center>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<hr class="garis1">
				</td>				
			</tr>
		</table>
		<table  width="520">
			<tr>
				<td class="text">Lhokseumawe, <?php echo date('d/M/Y') ?></td>
			</tr>
		</table>
		<br>
		<table class="table1"  width="520">
			<tr class="table1">
				<th class="table1">No</th>
				<th class="table1">Wilayah</th>
				<th class="table1">Luas Tanam (Ha)</th>
				<th class="table1">Luas Panen (Ha)</th>
				<th class="table1">Produktivitas</th>
				<th class="table1">Produksi</th>
			</tr>
			<?php 
			$i=1;
			foreach ($data_panen as $key) :?>
				<tr class="table1">
					<td class="table1"><?php echo $i++; ?></td>
					<td class="table1"><?php echo $key->nama_wilayah ?></td>
					<td class="table1"><?php echo $key->x1 ?></td>
					<td class="table1"><?php echo $key->x2 ?></td>
					<td class="table1"><?php echo $key->x3 ?></td>
					<td class="table1"><?php echo round($key->y,2) ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
		<br><br>
		<table align="center" width="600">
			<tr>
				<td width="60%"></td>
				<td class="text2"><center>Petugas,</center> <br><br><br><br> <center><?php echo $user['name']; ?></center></td>
			</tr>
		</table>
	</center>
	
</body>
</html>