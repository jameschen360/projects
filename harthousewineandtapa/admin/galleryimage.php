		<? include("inc/connect.php")?>
		<?		
					$target_dir = "images/gallery/";
					$target_file = mysql_real_escape_string($target_dir . basename($_FILES["fileToUpload"]["name"]));
					$title=mysql_real_escape_string($_POST["gallery_title"]);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					if(isset($_POST["gallery"])) {
						$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						if($check !== false) {
							
							$sql = "INSERT INTO gallery (url, title) VALUES ('$target_file','$title')";
							$yes = mysql_query($sql);
							$uploadOk = 1;
							echo "<meta http-equiv=\"refresh\" content=\"0; url=./gallery.php\">";
						} else {
							echo "<center><span class='alert alert-danger' role='alert'>Not a valid image</span></center>";
							$uploadOk = 0;
							echo "<meta http-equiv=\"refresh\" content=\"0; url=./gallery.php\">";
						}
					}

					// Check file size
					if ($_FILES["fileToUpload"]["size"] > 5000000) {
						echo "Sorry, your file is too large.";
						$uploadOk = 0;
						echo "<meta http-equiv=\"refresh\" content=\"0; url=./gallery.php\">";
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" && $imageFileType != "PNG" && $imageFileType != "JPEG") {
						echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$uploadOk = 0;
						echo "<meta http-equiv=\"refresh\" content=\"0; url=./gallery.php\">";
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						echo "Sorry, your file was not uploaded.";
						echo "<meta http-equiv=\"refresh\" content=\"0; url=./gallery.php\">";
					// if everything is ok, try to upload file
					} else {
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
							
							echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
							echo "<meta http-equiv=\"refresh\" content=\"0; url=./gallery.php\">";
							
							
						} else {
							echo "Sorry, there was an error uploading your file.";
							echo "<meta http-equiv=\"refresh\" content=\"0; url=./gallery.php\">";
						}
					}
					?>