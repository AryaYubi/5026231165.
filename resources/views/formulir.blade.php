
<!DOCTYPE html>
<html>
<head>
	<title>Tutorial Laravel - www.malasngoding.com</title>
</head>
<body>

	<form action="/formulir/proses" method="post">
		<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">

        <input type = "hidden" name = "NRP" value = "5026231165">

      	Nama :
		<input type="text" name="nama"> <br/> <br>
		Alamat :
		<input type="text" name="alamat"> <br/> <br>

		<input type="submit" value="Simpan">
	</form>

</body>
</html>
