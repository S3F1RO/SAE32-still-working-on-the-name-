<?php

	// Foreach file
	$html = "";
	foreach ($_FILES["files"]["error"] as $key => $error) {
		if ($error == UPLOAD_ERR_OK) {
			// Get client filename
		  $clientFilename = $_FILES["files"]["name"][$key];
			$html .= "<p>File $clientFilename uploaded</p>";

			// Save uploaded file to disk
			move_uploaded_file($_FILES["files"]["tmp_name"][$key], "uploads/$clientFilename");
		}
	}

	// Data ajax to client
	$data = array("html"=>"$html");
	echo json_encode($data);
	
?>
