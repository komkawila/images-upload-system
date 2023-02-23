<!DOCTYPE html>
<html>

<head>
	<title>Image Upload Using PHP</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<style>
		/* body {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			min-height: 100vh;
		} */
	</style>
</head>

<body>

	<nav class="navbar navbar-dark bg-dark ">
		<div class="container">
			<a class="navbar-brand" href="index.php">
				<img src="assets/pkbit_logo1.png" alt="" width="50" height="50">
			</a>
			<a class="navbar-brand" href="view.php">View</a>
		</div>
	</nav>

	<div class="container mt-4 text-center">
		<?php if (isset($_GET['error'])) : ?>
			<div class="alert alert-danger" role="alert">
				<p><?php echo $_GET['error']; ?></p>
			</div>
		<?php endif ?>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<label for="formFile" class="form-label">กรุณาเลือกไฟล์</label>
				<input class="form-control" type="file" name="my_image">
				<!-- <input type="submit" name="submit" value="Upload"> -->
				<button name="submit" value="Upload" class="btn btn-primary mt-2">อัพโหลดรูปภาพ</button>
			</div>
		</form>

		<!-- <form action="upload.php" method="post" enctype="multipart/form-data">

			<input type="file" name="my_image">

			<input type="submit" name="submit" value="Upload">

		</form> -->
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>