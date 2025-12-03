<?php

// Foreach file
foreach ($_FILES["files"]["error"] as $key => $error) {
	if ($error == UPLOAD_ERR_OK) {
		// Get client filename
	  $clientFilename = $_FILES["files"]["name"][$key];

		// Save uploaded file to disk
		move_uploaded_file($_FILES["files"]["tmp_name"][$key], "uploads/$clientFilename");

		// Msg
		echo "<p>File $clientFilename has been uploaded</p>";
	}
}

?>
