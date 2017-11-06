<?php
require './aws/aws-autoloader.php';
	
	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;
	// AWS Info
	$bucketName = 'springbankdelivery';
	$IAM_KEY = 'AKIAIT5NPGFJHJIYRBXA';
	$IAM_SECRET = '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';
	// Connect to AWS
	try {
		// You may need to change the region. It will say in the URL when the bucket is open
		// and on creation.
		$s3 = S3Client::factory(
			array(
				'credentials' => array(
					'key' => $IAM_KEY,
					'secret' => $IAM_SECRET
				),
				'version' => 'latest',
				'region'  => 'us-east-2'
			)
		);
	} catch (Exception $e) {
		// We use a die, so if this fails. It stops here. Typically this is a REST call so this would
		// return a json object.
		die("Error: " . $e->getMessage());
	}
	
    $productFolder = 'images/product/';
	$keyName =  $productFolder . basename($_FILES["fileToUpload"]['name']);
	$pathInS3 = 'https://s3.us-east-2.amazonaws.com/' . $bucketName . '/' . $keyName;
	// Add it to S3
	try {
		// Uploaded:
		$file = $_FILES["fileToUpload"]['tmp_name'];
		$s3->putObject(
			array(
				'Bucket'=> $bucketName,
				'Key' =>  $keyName,
				'SourceFile' => $file

                
			)
		);
	} catch (S3Exception $e) {
		die('Error:' . $e->getMessage());
	} catch (Exception $e) {
		die('Error:' . $e->getMessage());
    }
    
    // insert in to mysqli database for image path

	echo basename($_FILES["fileToUpload"]['name']);

?>