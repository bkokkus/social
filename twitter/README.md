# php - twitter with login 

	php kodlama ile twitter üzerinden kullanıcı bilgilerini alıp işleyeceğiz.

# kurulum ve kullanım

	eğer bu projeyi bu şekilde alıp kullanmak isterseniz. 
	Twitter geliştirme portalı üzerinden bir uygulama oluşturmanız gerekmetedir.
	Bkz. : https://developer.twitter.com

	Bu uygulamayı oluşturduktan sonra ;

	twitter_process.php dosyasının en başında bulunan : 

	define("CONSUMER_KEY", "value");
	define("CONSUMER_SECRET","value");
	define("OAUTH_CALLBACK","value");

	kısımları oluşturduğunuz uygulama ile gelen veriler ile value kısımlarını doldurmalısınız.


# OAtuh ve Twitter API dahil edildi.
	
	lib klasörü altında dahil edilen api dosyalarına erişebilirsiniz.	

# index dosyası

	sistede bir kullanıcı oturumu yoksa twitter_process.php dosyasını çağırır.

# twitter_process dosyası

	index dosyasına kanalize olduktan sonra. 
	Giriş yapma butonunun tetiklenmesi ile ilgili twitter işlemlerini başlatır.
	Her şey yolunda giderse kullanıcı bilgileri bir session ile aktarılır.
	Sayfa homepage.php ye yönlendirilir.

	Not: kodlama ile ilgili tüm detay ve açıklamalar kodlama dosyalarında mevcuttur.
