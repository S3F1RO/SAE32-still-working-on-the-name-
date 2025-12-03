<?php

	// File from client (ajax)
	$clientFilename = NULL;
	if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
		$clientFilename = $_FILES["file"]["name"];
	}

	// Data from client (ajax)
	$data1 = NULL;
	if (preg_match("/^.{0,50}$/", $_POST['data1'])) {
		$data1 = $_POST['data1'];
	}
	$data2 = NULL;
	if (preg_match("/^.{0,50}$/", $_POST['data2'])) {
		$data2 = $_POST['data2'];
	}


	// Delete previously uploaded files
	foreach (glob("uploads/*") as $previouslyUploadedFilename) {
		unlink("$previouslyUploadedFilename");
	}

	// Save uploaded file
	$newFilename = "$data1-$data2-$clientFilename";
	$success = move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/$newFilename");

	// Data ajax to client
	$data = array("success"=>"$success");
	echo json_encode($data);

?>
