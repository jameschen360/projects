 <?php
    $content=file_get_contents("https://openexchangerates.org/api/latest.json?app_id=2e7f2ef59a1a4a4bb735cf4330f63530");  // add your url which contains json file
    $json = json_decode($content, true);


    $json = $json['rates'];
   // var_export($json);

	echo $json['CNY'];

  ?>