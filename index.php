<?php 
	session_start();

	require_once('Instagram.php');

	$redirect_uri = "http://localhost/insta";

	if(isset($_POST['client_id']) && !empty($_POST['client_id']) && !isset($_GET['code'])){
		$_SESSION['client_id'] = $_POST['client_id'];
		$_SESSION['insta_user'] = $_POST['insta_user'];

		$_SESSION['client_secret'] = $_POST['client_secret'];
		

		$instaUrl = 'https://www.instagram.com/oauth/authorize/?client_id='.$_POST['client_id'].'&redirect_uri='.$redirect_uri.'&response_type=code&scope=&scope=basic+public_content+follower_list+comments+relationships+likes';

		header("Location: ".$instaUrl);
		
	}elseif(isset($_GET['code']) && !empty($_SESSION['client_secret'])){

		$uri = 'https://api.instagram.com/oauth/access_token'; 
		$data = [
			'client_id' => $_SESSION['client_id'], 
			'client_secret' => $_SESSION['client_secret'], 
			'grant_type' => 'authorization_code', 
			'redirect_uri' => $redirect_uri, 
			'code' => $_GET['code']
		];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $uri); // uri
		curl_setopt($ch, CURLOPT_POST, true); // POST
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // POST DATA
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // RETURN RESULT true
		curl_setopt($ch, CURLOPT_HEADER, 0); // RETURN HEADER false
		curl_setopt($ch, CURLOPT_NOBODY, 0); // NO RETURN BODY false / we need the body to return
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // VERIFY SSL HOST false
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // VERIFY SSL PEER false
		$result = json_decode(curl_exec($ch)); // execute curl
		echo '<pre>'; // preformatted view

		$access_token = $result->access_token;
		
		if(!empty($access_token)){
			$Insta = new Instagram;
			$Insta::setToken($access_token);
			$Insta::setUsername($_SESSION['insta_user']);
			$Insta::setNumerPhotos(3);

			$insta_result = $Insta::getPhotos();
		}
	}



 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Inta AT Generator</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>
<body>
	<?php if(!isset($access_token)): ?>
		<div class="container">
			<div class="row text-center justify-content-center">
				<h1>Insta Access Token Generator</h1>
			</div>
			<div class="row justify-content-center text-center">
				<div class="col col-md-6">
					<span>
					  <p>Registre um novo cliente na área <a href="https://www.instagram.com/developer/">Developer</a>  do Instagram definindo a URI como <strong>http://localhost/insta</strong></p>
					  <p>Insira abaixo o Client ID e o Client Secret do seu Client</p>
					</span>
					</div>
			</div>
			<div class="row justify-content-center">
				<div class="col col-md-6">
					<form method="POST">
					  <div class="form-group">
					    <label for="client_id">Client ID</label>
					    <input type="text" class="form-control" id="client_id" name="client_id" placeholder="Insira Client ID" required >
					  </div>
					  <div class="form-group">
					    <label for="client_secret">Client Secret</label>
					    <input type="text" class="form-control" id="client_secret" name="client_secret" placeholder="Insira Client Secret" required >
					  </div>
					  <div class="form-group">
					    <label for="insta_user">Usuário do Instagram</label>
					    <input type="text" class="form-control" id="insta_user" name="insta_user" placeholder="Insira o usuário do Instagram" required >
					  </div>
					  <button type="submit" class="btn btn-primary">Enviar</button>
					</form>
				</div>
			</div>
		</div>
		<?php else: ?>
			<div class="container">

				<div class="row text-center justify-content-center">
				<h1>Insta Access Token Generator</h1>
				</div>
				<div class="row">
					<div class="col col-md-6">
						<span>
						  <p>Seu Access Token é: <strong><?php echo $access_token; ?></strong></p>
						  <p>Chame a Classe conforme abaixo:</p>
						  <code>
						  	<?php 
						  		highlight_string('
										$Insta = new Instagram;
										$Insta::setToken('.$access_token.');
										$Insta::setUsername('.$_SESSION["insta_user"].');
										// Definir quantas imagens serão buscadas:
										$Insta::setNumerPhotos(3);

										$insta_result = $Insta::getPhotos();
						  		')

						  	 ?>
						  </code>
						</span>
						</div>
				</div>

				<div class="row">
				<?php foreach ($insta_result as $pic): ?>				
				<div class="card col" style="width: 18rem;">
					<a href="<?php echo $pic->link; ?>">
				  <img class="card-img-top" src="<?php echo $pic->images->standard_resolution->url; ?>" alt="Card image cap"></a>
				  <div class="card-body">
				  	<?php if(!empty($pic->caption)): ?>
				    <p class="card-text"><?php echo $pic->caption->text; ?></p>
				    <?php endif; ?>
				  </div>
				</div>
				
				<?php endforeach; ?>
			</div>
		</div>

		
	<?php endif; ?>
	


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>


</html>