<?php

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	include "db_conn.php";

	echo "<pre>";
	print_r($_FILES['my_image']);
	echo "</pre>";

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];

	if ($error === 0) {
		if ($img_size > 125000 * 8) {
			// if ($img_size > 125000) {
			$em = "Sorry, your file is too large.";
			header("Location: index.php?error=$em");
		} else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png");

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
				$img_upload_path = 'uploads/' . $new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				$sql = "INSERT INTO images(image_url) 
				        VALUES('$new_img_name')";
				mysqli_query($conn, $sql);

				$token = "xiabaCrqpUYR4Z7iQ3GJ1YCDKea7AwRgCvtG4GjJNRO"; // LINE Token
				//Message
				$mymessage = "\nเรื่อง: แจ้งเตือน 😀\n"; //Set new line with '\n'
				$mymessage .= "จาก: 🖥 ระบบฝากไฟล์ 🖥\n";
				$mymessage .= "รายละเอียด: มีการฝากไฟล์เพิ่มเข้ามาในระบบ";
				$mymessage .= "ชื่อไฟล์: " . $new_img_name;
				$imageFile = new CURLFILE(str_replace("upload.php","uploads/" . $new_img_name,$_SERVER['SCRIPT_FILENAME'])); // Local Image file Path
				// $imageFile ='uploads/' . $new_img_name; // Local Image file Path
				$sticker_package_id = '2';  // Package ID sticker
				$sticker_id = '34';    // ID sticker
				$data = array(
					'message' => $mymessage,
					'imageFile' => $imageFile
				);
				$chOne = curl_init();
				curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
				curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($chOne, CURLOPT_POST, 1);
				curl_setopt($chOne, CURLOPT_POSTFIELDS, $data);
				curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
				$headers = array('Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer ' . $token,);
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($chOne);
				//Check error
				if (curl_error($chOne)) {
					echo 'error:' . curl_error($chOne);
				} else {
					$result_ = json_decode($result, true);
					echo "status : " . $result_['status'];
					echo "message : " . $result_['message'];
					echo str_replace("upload.php","uploads/" . $new_img_name,$_SERVER['SCRIPT_FILENAME']);
				}
				//Close connection
				curl_close($chOne);

				header("Location: view.php");
			} else {
				$em = "You can't upload files of this type";
				header("Location: index.php?error=$em");
			}
		}
	} else {
		$em = "unknown error occurred!";
		header("Location: index.php?error=$em");
	}
} else {
	header("Location: index.php");
}
