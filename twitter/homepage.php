<?php 
	
	session_start();

	if(isset($_SESSION['data'])){
		$user = $_SESSION['data'];
	} else {
		header("location:index.php");
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Twitter Giriş İşlemleri</title>

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<style type="text/css">
		.well {
			margin-top : 25px;
		}
	</style>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 well">
				<div class="col-md-2">
					<img src="<?php echo $user->profile_image_url; ?>" class="img-responsive img-circle">
					<a href="index.php?logout" class="">Çıkış Yap</a>
				</div>

				<div class="col-md-10">
					<div>
					<strong>Kullanıcı Tam Adı : </strong>
					<?php echo $user->name; ?>
					</div>
					<div>
					<strong>Kullanıcı Adı : </strong>
					<?php echo $user->screen_name; ?>
					</div>
				</div>

			</div>
		</div> 
	</div>

</body>
</html>