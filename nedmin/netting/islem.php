<?php
ob_start();

session_start();

include 'baglan.php';
include '../examples/fonksiyon.php';

if(isset($_POST['admingiris'])){

   $kullanici_mail= $_POST['kullanici_mail'];
  $kullanici_password=($_POST['kullanici_password']);
  $kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_password=:password and kullanici_yetki=:yetki");
  $kullanicisor->execute(array(
      'mail' => $kullanici_mail,
      'password' => $kullanici_password,
      'yetki' => 5
      ));

  $say=$kullanicisor->rowCount();

  if ($say==1) {
              
      $_SESSION['kullanici_mail']=$kullanici_mail;
      header("Location:../examples/index.php");
      exit;

  } else {

      header("Location:../examples/login.php?durum=no");
      exit;
  }
  
}

if (isset($_POST['kullanicikaydet'])) {

	
	echo $kullanici_adsoyad=htmlspecialchars($_POST['kullanici_adsoyad']); echo "<br>";
	echo $kullanici_mail=htmlspecialchars($_POST['kullanici_mail']); echo "<br>";

	echo $kullanici_passwordone=$_POST['kullanici_passwordone']; echo "<br>";
	echo $kullanici_passwordtwo=$_POST['kullanici_passwordtwo']; echo "<br>";


	if ($kullanici_passwordone==$kullanici_passwordtwo) {


		if (strlen($kullanici_passwordone>=6)) {


// Başlangıç

			$kullanicisor=$db->prepare("select * from kullanici where kullanici_mail=:mail");
			$kullanicisor->execute(array(
				'mail' => $kullanici_mail
				));

			//dönen satır sayısını belirtir
			$say=$kullanicisor->rowCount();



			if ($say==0) {

				//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				$password=md5($kullanici_passwordone);

				$kullanici_yetki=1;

			//Kullanıcı kayıt işlemi yapılıyor...
				$kullanicikaydet=$db->prepare("INSERT INTO kullanici SET
					kullanici_adsoyad=:kullanici_adsoyad,
					kullanici_mail=:kullanici_mail,
					kullanici_password=:kullanici_password,
					kullanici_yetki=:kullanici_yetki
					");
				$insert=$kullanicikaydet->execute(array(
					'kullanici_adsoyad' => $kullanici_adsoyad,
					'kullanici_mail' => $kullanici_mail,
					'kullanici_password' => $password,
					'kullanici_yetki' => $kullanici_yetki
					));

				if ($insert) {


					header("Location:../../index.php?durum=loginbasarili");


				//Header("Location:../production/genel-ayarlar.php?durum=ok");

				} else {


					header("Location:../../register.php?durum=basarisiz");
				}

			} else {

				header("Location:../../register.php?durum=mukerrerkayit");



			}




		// Bitiş



		} else {


			header("Location:../../register.php?durum=eksiksifre");


		}



	} else {



		header("Location:../../register.php?durum=farklisifre");
	}
	


}
if (isset($_POST['kullanicigiris'])) {

    
	
	echo $kullanici_mail=htmlspecialchars($_POST['kullanici_mail']); 
	echo $kullanici_password=md5($_POST['kullanici_password']); 



	$kullanicisor=$db->prepare("select * from kullanici where kullanici_mail=:mail and kullanici_yetki=:yetki and kullanici_password=:password and kullanici_durum=:durum");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'yetki' => 1,
		'password' => $kullanici_password,
		'durum' => 1
		));


	$say=$kullanicisor->rowCount();



	if ($say==1) {

		echo $_SESSION['userkullanici_mail']=$kullanici_mail;

		header("Location:../../");
		exit;
		




	} else {


		header("Location:../../?durum=basarisizgiris");

	}


}




if(isset($_POST['genelayarkaydet'])){
    $ayarkaydet=$db->prepare("UPDATE ayar SET
    
    ayar_title=:ayar_title,
    ayar_description=:ayar_description,
    ayar_keywords=:ayar_keywords,
    ayar_author=:ayar_author
    WHERE  ayar_id=0");

    $update=$ayarkaydet->execute(array(

        'ayar_title'=>$_POST['ayar_title'],
        'ayar_description'=> $_POST['ayar_description'],
        'ayar_keywords'=> $_POST['ayar_keywords'] ,
        'ayar_author'=>$_POST['ayar_author']

    ));


    if($update){
       header("Location:../examples/ayarlar.php ? durum=ok");
    }
    else {
        header("Location:../examples/ayarlar.php ? durum=no");
    }
}

if (isset($_POST['kullaniciduzenle'])) {

	$kullanici_id=$_POST['kullanici_id'];

	$ayarkaydet=$db->prepare("UPDATE kullanici SET
		kullanici_tc=:kullanici_tc,
		kullanici_adsoyad=:kullanici_adsoyad,
		kullanici_durum=:kullanici_durum
		WHERE kullanici_id={$_POST['kullanici_id']}");

	$update=$ayarkaydet->execute(array(
		'kullanici_tc' => $_POST['kullanici_tc'],
		'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
		'kullanici_durum' => $_POST['kullanici_durum']
		));


	if ($update) {

		Header("Location:../examples/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=ok");

	} else {

		Header("Location:../examples/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
	}

}
if (@$_GET['kullanicisil']=="ok") {

	$sil=$db->prepare("DELETE from kullanici where kullanici_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['kullanici_id']
		));


	if ($kontrol) {


		header("location:../examples/kullanici.php?sil=ok");


	} else {

		header("location:../examples/kullanici.php?sil=no");

	}


}
if (isset($_POST['menuduzenle'])) {

	$menu_id=$_POST['menu_id'];

	$menu_seourl=seo($_POST['menu_ad']);

	
	$ayarkaydet=$db->prepare("UPDATE menu SET
		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_url=:menu_url,
		menu_sira=:menu_sira,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum
		WHERE menu_id={$_POST['menu_id']}");

	$update=$ayarkaydet->execute(array(
		'menu_ad' => $_POST['menu_ad'],
		'menu_detay' => $_POST['menu_detay'],
		'menu_url' => $_POST['menu_url'],
		'menu_sira' => $_POST['menu_sira'],
		'menu_seourl' => $menu_seourl,
		'menu_durum' => $_POST['menu_durum']
		));


	if ($update) {

		Header("Location:../examples/menu-duzenle.php?menu_id=$menu_id&durum=ok");

	} else {

		Header("Location:../examples/menu-duzenle.php?menu_id=$menu_id&durum=no");
	}

}
if (isset($_POST['kategoriduzenle'])) {

	$id=$_POST['id'];
	$kategori_seourl=seo($_POST['category']);

	
	$kaydet=$db->prepare("UPDATE productcategories SET
		category=:ad,
		kategori_durum=:kategori_durum,	
		kategori_seourl=:seourl,
		kategori_sira=:sira
		WHERE id={$_POST['id']}");
	$update=$kaydet->execute(array(
		'ad' => $_POST['category'],
		'kategori_durum' => $_POST['kategori_durum'],
		'seourl' => $kategori_seourl,
		'sira' => $_POST['kategori_sira']		
		));

	if ($update) {

		Header("Location:../examples/kategori-duzenle.php?durum=ok&id=$id");

	} else {

		Header("Location:../examples/kategori-duzenle.php?durum=no&id=$id");
	}

}
if (isset($_POST['kategoriekle'])) {

	$kategori_seourl=seo($_POST['category']);

	$kaydet=$db->prepare("INSERT INTO productcategories SET
		category=:ad,
		kategori_durum=:kategori_durum,	
		kategori_seourl=:seourl,
		kategori_sira=:sira
		");
	$insert=$kaydet->execute(array(
		'ad' => $_POST['category'],
		'kategori_durum' => $_POST['kategori_durum'],
		'seourl' => $kategori_seourl,
		'sira' => $_POST['kategori_sira']		
		));

	if ($insert) {

		Header("Location:../examples/kategori.php?durum=ok");

	} else {

		Header("Location:../examples/kategori.php?durum=no");
	}

}



if (@$_GET['kategorisil']=="ok") {
	
	$sil=$db->prepare("DELETE from productcategories where id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['id']
		));

	if ($kontrol) {

		Header("Location:../examples/kategori.php?durum=ok");

	} else {

		Header("Location:../examples/kategori.php?durum=no");
	}

}
if (@$_GET['urunsil']=="ok") {
	
	$sil=$db->prepare("DELETE from products where id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['id']
		));

	if ($kontrol) {

		Header("Location:../examples/urun.php?durum=ok");

	} else {

		Header("Location:../examples/urun.php?durum=no");
	}

}
if (isset($_POST['urunduzenle'])) {

	$urun_id=$_POST['urun_id'];
	$urun_seourl=seo($_POST['productName']);

	$kaydet=$db->prepare("UPDATE products SET
		categoryId=:categoryId,
		productName=:productName,
		productDescription=:productDescription,
		offerCreateTime=:offerCreateTime,
		offerFinishedTime=:offerFinishedTime,
		urun_durum=:urun_durum,
		urun_seourl=:seourl		
		WHERE urun_id={$_POST['urun_id']}");
	$update=$kaydet->execute(array(
		'categoryId' => $_POST['categoryId'],
		'productName' => $_POST['productName'],
		'productDescription' => $_POST['productDescription'],
		'offerCreateTime' => $_POST['offerCreateTime'],
		'offerFinishedTime' => $_POST['offerFinishedTime'],
		'urun_durum' => $_POST['urun_durum'],
		'seourl' => $urun_seourl
			
		));

	if ($update) {

		Header("Location:../examples/urun-duzenle.php?durum=ok&urun_id=$urun_id");

	} else {

		Header("Location:../examples/urun-duzenle.php?durum=no&urun_id=$urun_id");
	}

}
if (isset($_POST['urunekle'])) {

	$urun_seourl=seo($_POST['productName']);

	$kaydet=$db->prepare("INSERT INTO products SET
		categoryId=:categoryId,
		productName=:productName,
		productDescription=:productDescription,
		offerCreateTime=:offerCreateTime,
		offerFinishedTime=:offerFinishedTime,
		urun_durum=:urun_durum,
		urun_seourl=:seourl		
		");
	$insert=$kaydet->execute(array(
		'categoryId' => $_POST['categoryId'],
		'productName' => $_POST['productName'],
		'productDescription' => $_POST['productDescription'],
		'offerCreateTime' => $_POST['offerCreateTime'],
		'offerFinishedTime' => $_POST['offerFinishedTime'],
		'urun_durum' => $_POST['urun_durum'],
		'seourl' => $urun_seourl
			
		));

	if ($insert) {

		Header("Location:../examples/urun.php?durum=ok");

	} else {

		Header("Location:../examples/urun.php?durum=no");
	}

}
if (@$_GET['urunsil']=="ok") {
	
	$sil=$db->prepare("DELETE from products where urun_id=:urun_id");
	$kontrol=$sil->execute(array(
		'urun_id' => $_GET['urun_id']
		));

	if ($kontrol) {

		Header("Location:../examples/urun.php?durum=ok");

	} else {

		Header("Location:../examples/urun.php?durum=no");
	}

}
if (isset($_POST['teklifkaydet'])) {


	$gelen_url=$_POST['gelen_url'];

	$ayarekle=$db->prepare("INSERT INTO offers SET
	
		offerHead=:offerHead,
		offerValue=:offerValue,
		kullanici_id=:kullanici_id,
		productId=:productId
		
		");

	$insert=$ayarekle->execute(array(
		
		'offerHead' => $_POST['offerHead'],
		'offerValue' => $_POST['offerValue'],
		'kullanici_id' => $_POST['kullanici_id'],
		'productId' => $_POST['productId']
		
		
		));


	if ($insert) {

		Header("Location:$gelen_url?durum=ok");

	} else {

		Header("Location:$gelen_url?durum=no");
	}

}
if (@$_GET['teklif_onay']=="ok") {

	
	$duzenle=$db->prepare("UPDATE offers SET
		
		teklif_onay=:teklif_onay
		
		WHERE offers_id={$_GET['offers_id']}");
	
	$update=$duzenle->execute(array(

		'teklif_onay' => $_GET['teklif_one']
		));



	if ($update) {

		

		Header("Location:../examples/teklif.php?durum=ok");

	} else {

		Header("Location:../examples/teklif.php?durum=no");
	}

}
if (@$_GET['teklifsil']=="ok") {
	
	$sil=$db->prepare("DELETE from offers where offers_id=:offers_id");
	$kontrol=$sil->execute(array(
		'offers_id' => $_GET['offers_id']
		));

	if ($kontrol) {

		
		Header("Location:../examples/teklif.php?durum=ok");

	} else {

		Header("Location:../examples/teklif.php?durum=no");
	}

}
if(isset($_POST['urunfotosil'])) {

	$urun_id=$_POST['urun_id'];


	echo $checklist = $_POST['urunfotosec'];

	
	foreach($checklist as $list) {

		$sil=$db->prepare("DELETE from urunfoto where urunfoto_id=:urunfoto_id");
		$kontrol=$sil->execute(array(
			'urunfoto_id' => $list
			));
	}

	if ($kontrol) {

		Header("Location:../examples/urun-galeri.php?urun_id=$urun_id&durum=ok");

	} else {

		Header("Location:../examples/urun-galeri.php?urun_id=$urun_id&durum=no");
	}


} 




?>
