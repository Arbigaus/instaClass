<?php 
	session_start();

	$redirect_uri = "http://localhost/insta";

	if(isset($_POST['client_id']) && !empty($_POST['client_id']) && !isset($_GET['code'])){
		$_SESSION['client_id'] = $_POST['client_id'];
		$client_id = $_POST['client_id'];

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
		
		// ecit directly the result
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
					    <input type="text" class="form-control" id="client_id" name="client_id" placeholder="Insira Client ID">
					  </div>
					  <div class="form-group">
					    <label for="client_secret">Client Secret</label>
					    <input type="text" class="form-control" id="client_secret" name="client_secret" placeholder="Insira Client Secret">
					  </div>
					  <button type="submit" class="btn btn-primary">Enviar</button>
					</form>
				</div>
			</div>
		</div>
		<?php else: ?>
			<div class="container">
				<div class="row text-center justify-content-center">
					<h1>Classe Instagram</h1>
				</div>
				<div class="row justify-content-center text-center">
					<div class="col col-md-8">
						<span>
						  <p>Abaixo a classe gerada, para usar basta chamar Instagram->getPhotos</p>
						  <p>O Access Toekn gerado é: <strong><?php echo $access_token ?></strong></p>
						</span>
					</div>
				</div>
				<div class="row">
					<div class="col alert alert-primary" role="alert">
					<code style="margin-left: -100">
			      class Instagram extends Model {

							public static function getPhotos(){
								$access_token = <?php echo $access_token; ?>;
								
								$username = 'usuario';
								$user_search = self::rudr_instagram_api_curl_connect("https://api.instagram.com/v1/users/search?q=usuario&access_token=<?php echo $access_token; ?>);
								// $user_search is an array of objects of all found users
								// we need only the object of the most relevant user - $user_search->data[0]
								// $user_search->data[0]->id - User ID
								// $user_search->data[0]->first_name - User First name
								// $user_search->data[0]->last_name - User Last name
								// $user_search->data[0]->profile_picture - User Profile Picture URL
								// $user_search->data[0]->username - Username
								 
								$user_id = $user_search->data[0]->id; // or use string 'self' to get your own media

								$return = self::rudr_instagram_api_curl_connect("https://api.instagram.com/v1/users/usuario/media/recent?access_token=" . <?php echo $access_token; ?>);
								 
								// var_dump( $return ); // if you want to display everything the function returns
								
								$returndata = array_slice( $return->data, 0, 3 );
								
								return $returndata;	
							}

								protected static function rudr_instagram_api_curl_connect( $api_url ){
								$connection_c = curl_init(); // initializing
								curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
								curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
								curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
								$json_return = curl_exec( $connection_c ); // connect and get json data
								curl_close( $connection_c ); // close connection
								return json_decode( $json_return ); // decode and return

							}

						}
			    </code>
			    </div>
				</div>
			</div>

		
	<?php endif; ?>
	


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>


</html>