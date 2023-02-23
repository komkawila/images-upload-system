<?php include "db_conn.php"; ?>
<!DOCTYPE html>
<html>
<?php
if (isset($_GET["filename"])) {
	include "db_conn.php";
	// DELETE FROM images WHERE id = 11"?
	$sql = "DELETE FROM images WHERE image_url = '" . $_GET["filename"] . "'";
	mysqli_query($conn, $sql);
	// echo $sql;
	if (unlink("uploads/" . $_GET["filename"])) {
		echo 'The file ' . $filename . ' was deleted successfully!';
	} else {
		echo 'There was a error deleting the file ' . $filename;
	}
	header("location: view.php");
	exit(0);
}
?>

<head>
	<title>View</title>
	<style>
	</style>


	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
	<div class="container">

		<table class="table">
			<thead>
				<tr>
					<th>ลำดับ</th>
					<th>รูป</th>
					<th>ชื่อไฟล์</th>
					<th>url</th>
					<th>กระทำ</th>
				</tr>
			</thead>
			<?php
			$sql = "SELECT * FROM images ORDER BY id DESC";
			$res = mysqli_query($conn,  $sql);

			if (mysqli_num_rows($res) > 0) {
				while ($images = mysqli_fetch_assoc($res)) {  ?>
					<tbody>
						<tr>
							<td><?= $images['id'] ?></td>
							<td><img src="uploads/<?= $images['image_url'] ?>" width="100" /></td>
							<td><?= $images['image_url'] ?></td>
							<td><?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
								?></td>
							<form action="view.php" method="GET">
								<td><button class="btn btn-danger mt-2" name="filename" value="<?= $images['image_url'] ?>">ลบ</button></td>
							</form>
						</tr>
					</tbody>

			<?php }
			} ?>

		</table>
	</div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>