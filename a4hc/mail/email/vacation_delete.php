<?
$message = '<html>
	<head>
		<meta name="viewport" content="width=device-width">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<style>
			* {
				font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
				font-size: 100%;
				line-height: 1.6em;
				margin: 0;
				padding: 0;
			}

			img {
				max-width: 600px;
				width: 100%;
			}

			body {
				-webkit-font-smoothing: antialiased;
				height: 100%;
				-webkit-text-size-adjust: none;
				width: 100% !important;
			}

			a {
				color: #348eda;
			}

			.btn-primary {
				Margin-bottom: 10px;
				width: auto !important;
			}

			.btn-primary td {
				background-color: #62cb31;
				border-radius: 3px;
				font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
				font-size: 14px;
				text-align: center;
				vertical-align: top;
			}

			.btn-primary td a {
				background-color: #62cb31;
				border: solid 1px #62cb31;
				border-radius: 3px;
				border-width: 4px 20px;
				display: inline-block;
				color: #ffffff;
				cursor: pointer;
				font-weight: bold;
				line-height: 2;
				text-decoration: none;
			}

			.last {
				margin-bottom: 0;
			}

			.first {
				margin-top: 0;
			}

			.padding {
				padding: 10px 0;
			}

			table.body-wrap {
				padding: 20px;
				width: 100%;
			}

			table.body-wrap .container {
				border: 1px solid #e4e5e7;
			}

			table.footer-wrap {
				clear: both !important;
				width: 100%;
			}

			.footer-wrap .container p {
				color: #666666;
				font-size: 12px;

			}

			table.footer-wrap a {
				color: #999999;
			}

			h1,
			h2,
			h3 {
				color: #111111;
				font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
				font-weight: 200;
				line-height: 1.2em;
				margin: 40px 0 10px;
			}

			h1 {
				font-size: 36px;
			}
			h2 {
				font-size: 28px;
			}
			h3 {
				font-size: 22px;
			}

			p,
			ul,
			ol {
				font-size: 14px;
				font-weight: normal;
				margin-bottom: 10px;
			}

			ul li,
			ol li {
				margin-left: 5px;
				list-style-position: inside;
			}

			/* ---------------------------------------------------
				RESPONSIVENESS
			------------------------------------------------------ */

			/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
			.container {
				clear: both !important;
				display: block !important;
				Margin: 0 auto !important;
				max-width: 600px !important;
			}

			/* Set the padding on the td rather than the div for Outlook compatibility */
			.body-wrap .container {
				padding: 40px;
			}

			/* This should also be a block element, so that it will fill 100% of the .container */
			.content {
				display: block;
				margin: 0 auto;
				max-width: 600px;
			}

			/* Let\'s make sure tables in the content area are 100% wide */
			.content table {
				width: 100%;
			}

		</style>
	</head>

	<body bgcolor="#f7f9fa">

	<table class="body-wrap" bgcolor="#f7f9fa">
		<tr>
			<td></td>
			<td class="container" bgcolor="#FFFFFF">

				<div class="content">
					<table>
						<tr>
						<img alt="My Image" src="'.$logo.'" />
						</tr>
						<tr>
							<td>
								<strong>Hi '.$supervisor_name.',</strong>
								
								<p>'.$user_name.' has deleted vacation request <b>'.$vacation_generated_id.'</b> and no longer require your action.</p>
								<p>This is an automated message.</p>
							</td>
						</tr>
					</table>
				</div>

			</td>
			<td></td>
		</tr>
	</table>
	<table class="footer-wrap">
		<tr>
			<td></td>
			<td class="container">

				<div class="content">
					<table>
						<tr>
							<td align="center">
								<p>This email is monitored and regulated by A4HC, and is meant to be used for internal transmissions only. If you have recieved this email by accident, please let A4HC administrator know as soon as possible!<br/>Copyright 2017 Action For Healthy Communities
								</p>
							</td>
						</tr>
					</table>
				</div>

			</td>
			<td></td>
		</tr>
	</table>
	</body>
	</html>';
	$mail = new PHPMailer(); // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465;// or 587
	$mail->IsHTML(true);
	$mail->Username = $auto_email;
	$mail->Password = $auto_pwd;
	$mail->SetFrom($auto_email, "Action For Healthy Communities");
	$mail->Subject = 'Vacation Request Deletion Notice: '.$vacation_generated_id;
	$mail->Body = $message;
	$mail->AddAddress($supervisor_username);

	 if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	 } else {
		echo "Message has been sent";
	 }
?>		 