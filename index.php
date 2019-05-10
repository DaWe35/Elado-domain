<?php

	/* CONFIG */
	$ownerMail = '';
	$fromMail = '';
	$domain = '';

?>

<!DOCTYPE html>
<html lang="en" >

<head>
	<meta charset="UTF-8">
	<title><?= $domain ?> - eladó domain</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<div class="video-background">
		<div class="video-foreground">
			<iframe src="https://www.youtube.com/embed/F5fgvvoHXBA?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&mute=1&controls=0" frameborder="0" allowfullscreen></iframe>
		</div>
	</div>

<div id="vidtop-content">
<div class="vid-info">
		<h1><?= $domain ?> - eladó domain</h1>
			<?php 
			if (!isset($_POST['action'])) {			/* display the contact form */ ?> 
				<p>
					<form  action="" method="POST" enctype="multipart/form-data"> 
						<input type="hidden" name="action" value="submit"> 
						Név:<br>
						<input name="name" type="text"><br> 
						Email:<br>
						<input name="email" type="email"><br>
						Üzenet:<br>
						<textarea name="message" ></textarea><br> 
						<input type="submit"/> 
					</form>
				</p> <?php 
			} else {			/* send the submitted data */ 
				$name = ($_POST['name']) ? $_POST['name'] : ''; 
				$email = ($_POST['email']) ? $_POST['email'] : ''; 
				$message = ($_POST['message']) ? $_POST['message'] : ''; 
				$message = 'FROM: '.$email.'
					'.$message;
				if (($name=="")||($email=="")||($message=="")) {
					echo "Kérlek az összes kötelező mezőt töltsd ki <a href=\"\">az űrlapon</a>."; 
				} else {
					$headers = 'From: '.$name.'<'.$fromMail.'>' . "\r\n" .
					'Reply-To: '.$name.'<'.$email.'>' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
					$subject = $domain." kapcsolat"; 
					$mailsent = mail($ownerMail, $subject, $message, $headers); 
					if ($mailsent) {
						echo "<p>Üzenet elküldve, hamarosan válaszolunk a megadott email címedre!</p>"; 
					} else {
						echo '<p style="color: red;">Az üzenet elküldése sikertelen, kérjük vegye fel a kapcsolatot a '.$ownerMail.' címen!</p>'; 
					}
				}
			}
			?>
	</div>
</div>

</body>
</html>
