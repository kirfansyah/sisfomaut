<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post" action="<?php echo base_url('insert/add') ?>">	
	<label>Id Wilayah</label>
	<input type="text" name="id_wilayah[]">
	<input type="text" name="id_wilayah[]">
	<input type="text" name="id_wilayah[]"><br>

	<label>Nama Wilayah</label>
	<input type="text" name="nama_wilayah[]">
	<input type="text" name="nama_wilayah[]">
	<input type="text" name="nama_wilayah[]"><br>

	<label>Tahun</label>
	<input type="text" name="tahun[]">
	<input type="text" name="tahun[]">
	<input type="text" name="tahun[]"><br>

	<label>1</label>
	<input type="text" name="dat1[]">
	<input type="text" name="dat1[]">
	<input type="text" name="dat1[]"><br>

	<label>2</label>
	<input type="text" name="dat2[]">
	<input type="text" name="dat2[]">
	<input type="text" name="dat2[]"><br>

	<label>3</label>
	<input type="text" name="dat3[]">
	<input type="text" name="dat3[]">
	<input type="text" name="dat3[]"><br>

	<label>4</label>
	<input type="text" name="dat4[]">
	<input type="text" name="dat4[]">
	<input type="text" name="dat4[]"><br>
	<button type="submit">Save</button>
</form>
</body>
</html>