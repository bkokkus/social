<?php 

/* 
* 1. Bölüm Tanımlamalar
*/

require_once('lib/OAuth.php');
require_once('lib/twitteroauth.php');

define("CONSUMER_KEY", "value");
define("CONSUMER_SECRET","value");
define("OAUTH_CALLBACK","value");

session_start();

/* 
* #1. Bölüm Tanımlamalar
*/


/* 
* 2. İşlemler
*/
	#2.1 Kontrol :logout -> çıkış işlemi yapıldı mı yapılmadı mı?
	
		//kullanıcı var mı yok kontrol edilecek ?
		//Eğer sistemde kullanıcı yoksa yeniden giriş yapılacak!
		//Token oluşturlan bir login url si oluşturulmuş olacak.
		//Başarılı dönüş alınıpmış verilerin alınması için oauth token isimli indis kontrolü
		
		//get metodunda logout var mı?
		if(isset($_GET['logout'])){
			//logout varsa session ı boşalt ve sayfasyı yönlendir.
			session_unset();
			header("location:index.php");
		}
		

	#2.2 Kontrol : User session -> session user var mı yok mu?

		//eğer kullanıcı aktif değilse login url üretme işlemini gerçekleştir. 
		if(!isset($_SESSION["user"]) && !isset($_GET['oauth_token'])){

			//oauth tokenli login url si oluşturma
			$connection = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET);
			$request_token = $connection->getRequestToken(OAUTH_CALLBACK);

			//eğer request_token oluştuysa
			if($request_token){
				$token = $request_token["oauth_token"];

				//buradaki session kullanıcı bilgilerini almak için kullanıcaz eğer varsa
				$_SESSION["request_token"] = $token;
				$_SESSION["request_token_secret"] = $request_token["oauth_token_secret"];

				$login_url = $connection->getAuthorizeURL($token);
			}
		}	

	#2.3 Kontrol : Callback -> sesion user da varsa callback var mı ? yok mu ?

		//Eğer kullanıcı login işlemi için talepte bulunduysa
		//olumlu dönüş halinde kullanıcılarının bilgilerinin alındığı kısım

		if(isset($_GET["oauth_token"])){

			//accessToken oluşturmak için oluşturduğumuz connection nesnesi
			$connection = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET, $_SESSION["request_token"], $_SESSION["request_token_secret"]);

			$access_token = $connection->getAccessToken($_REQUEST["oauth_verifier"]);

			if($access_token){
				$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

				$params = array (
					"include_entities" => "false"
				);

				//kişinin twitter tarafından onaylı verilerini çek 
				$data = $connection->get("account/verify_credentials", $params);

				if($data){
					$_SESSION["data"] = $data;
					header("location:homepage.php");
				}
			}

		}

/* 
* #2. İşlemler
*/


/* 
* 3. Front-End
*/

	if(isset($login_url) && !isset($_SESSION["data"])){
		echo "<a class='btn btn-primary btn-sm' href='$login_url'>Login with twitter</a> ";
	} 

/* 
* #3. Front-End
*/
	