		<? include("inc/connect.php")?>
		<?		
					$target_dir = "images/menu/";
					$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					if(isset($_POST["menu"])) {
						$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						if($check !== true) {
							
							$sql = "UPDATE menu SET pdf4='$target_file' WHERE id=1";
							$yes = mysql_query($sql);
							$uploadOk = 1;
							echo "<meta http-equiv=\"refresh\" content=\"0; url=./menu.php\">";
						} else {
							echo "<center><span class='alert alert-danger' role='alert'>Not a PDF</span></center>";
							$uploadOk = 0;
							echo "<meta http-equiv=\"refresh\" content=\"0; url=./menu.php\">";
						}
					}

					// Check file size
					if ($_FILES["fileToUpload"]["size"] > 50000000000) {
						echo "Sorry, your file is too large.";
						$uploadOk = 0;
						echo "<meta http-equiv=\"refresh\" content=\"0; url=./menu.php\">";
					}
					// Allow certain file formats
					if($imageFileType != "pdf" && $imageFileType != "PDF") {
						echo "ONLY PDF files are allowed.";
						$uploadOk = 0;
						echo "<meta http-equiv=\"refresh\" content=\"0; url=./menu.php\">";
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						echo "Sorry, your file was not uploaded.";
						echo "<meta http-equiv=\"refresh\" content=\"0; url=./menu.php\">";
					// if everything is ok, try to upload file
					} else {
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
							
							echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
							echo "<meta http-equiv=\"refresh\" content=\"0; url=./menu.php\">";
							
							
						} else {
							echo "Sorry, there was an error uploading your file.";
							echo "<meta http-equiv=\"refresh\" content=\"0; url=./menu.php\">";
						}
					}
					?>