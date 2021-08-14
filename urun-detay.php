<?php 

include 'header.php'; 


$urunsor=$db->prepare("SELECT * FROM products where urun_id=:urun_id");
$urunsor->execute(array(
	'urun_id' => $_GET['urun_id']
	));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

echo$say=$urunsor->rowCount();

if ($say==0) {
	
	header("Location:index.php?durum=oynasma");
	exit;
}
?>

<head>
<?php 

if (@$_GET['durum']=="ok") {?>

<script type="text/javascript">
	alert("Teklifiniz Başarıyla Eklendi");
</script>

<?php }
?>
	
	<!-- fancy Style -->
	<link rel="stylesheet" type="text/css" href="js\product\jquery.fancybox.css?v=2.1.5" media="screen">
</head>
<div class="container">
	
	<div class="clearfix"></div>
	<div class="lines"></div>
</div>

<div class="container">
	<div class="row">

	</div>
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title"><?php echo $uruncek['productName'] ?></div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="dt-img">
						<div class="detpricetag"><div class="inner"> Teklif </div></div>
						<a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
					</div>
					<div class="thumb-img">
						<a class="fancybox" href="images\sample-4.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-4.jpg" alt="" class="img-responsive"></a>
					</div>
					<div class="thumb-img">
						<a class="fancybox" href="images\sample-5.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-5.jpg" alt="" class="img-responsive"></a>
					</div>
					<div class="thumb-img">
						<a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
					</div>
				</div>
				<div class="col-md-6 det-desc">
					<div class="productdata">
						<div class="infospan">Ürün Kodu <span><?php echo $uruncek['urun_id']; ?></span></div>
						<div class="">Ürün Teklif Başlangıç: <br><span ><?php echo $uruncek['offerCreateTime']; ?></span></div>
                        <div class="">Ürün Teklif Bitiş: <br><span ><?php echo $uruncek['offerFinishedTime']; ?></span></div>




						<div class="clearfix"></div>
						<hr>

						<div class="form-group">
							<label for="qty" class="col-sm-2 control-label">Adet</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" value="1" name="urun_adet">
							</div>
							<div class="col-sm-4">
								<button class="btn btn-default btn-red btn-sm"><span class="addchart">Teklif Ver</span></button>
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="sharing">
							<div class="share-bt">
								<div class="addthis_toolbox addthis_default_style ">
									<a class="addthis_counter addthis_pill_style"></a>
								</div>
								<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f0d0827271d1c3b"></script>
								<div class="clearfix"></div>
							</div>


							
						</div>



					</div>
				</div>
			</div>

			<div class="tab-review">
				<ul id="myTab" class="nav nav-tabs shop-tab">
					<li class="active"><a href="#desc" data-toggle="tab">Açıklama</a></li>

<?php

$kullanici_id=$kullanicicek['kullanici_id'];
$productId=$uruncek['urun_id'];
$teklifsor=$db->prepare("SELECT * FROM offers where  productId=:productId");
$teklifsor->execute(array(
    
    'productId'=> $productId

    ));
   


?>

                    
					<li class=""><a href="#rev" data-toggle="tab">Teklifler (<?php echo $teklifsor->rowCount();?>) </a></li>
					
				</ul>
				<div id="myTabContent" class="tab-content shop-tab-ct">
					<div class="tab-pane fade active in" id="desc">
						<p>
							<?php echo $uruncek['productDescription'] ?>
							
						</p>
					</div>
					<div class="tab-pane fade" id="rev">
						
                    <?php 
						


                           while ($teklifcek=$teklifsor->fetch(PDO::FETCH_ASSOC)) {

                            $tkullanici_id=$teklifcek['kullanici_id'];
                            $tkullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
                            $tkullanicisor->execute(array(
                              'id' => $tkullanici_id
                              ));
                            
                            $tkullanicicek=$tkullanicisor->fetch(PDO::FETCH_ASSOC);
                            
                               
                               
                               ?>
                          
						<!-- Yorumları Dökeceğiz -->
						<p class="dash">
							<span><?php echo $tkullanicicek['kullanici_adsoyad']   ?><br></span> <?php echo $teklifcek['offerCreateTime']   ?><br><br>
							<?php echo $teklifcek['offerHead']   ?>
							<?php echo $teklifcek['offerValue']   ?>
						</p>

                        <?php } ?>

						<!-- Yorumları Dökeceğiz -->


						<h4>Teklif Açıklaması</h4>

						<?php if (isset($_SESSION['userkullanici_mail'])) {?>

						<form action="nedmin/netting/islem.php" method="POST" role="form">
							
							<div class="form-group">
								<textarea name="offerHead" class="form-control" placeholder="Lütfen teklifizle ilgili açıklamayı buraya yazınız..." id="text"></textarea>
                                
							</div>
                            <h4>Teklif Fiyatını Girin</h4>
                            <input type="text"pattern="\d*" id="first-name" name="offerValue"
                                     required="required"
                                    class="form-control col-md-7 col-xs-12">
							<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
                            <input type="hidden" name="gelen_url" value="<?php 
										echo "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'].""; 

										?>">

										<input type="hidden" name="productId" value="<?php echo $uruncek['urun_id']
										
										?>">
							<button type="submit" name="teklifkaydet" class="btn btn-default btn-red btn-sm">Teklifi Gönder</button>
						</form>

						<?php } else {?>

						Teklif yapabilmek için <a style="color:red" href="register">kayıt</a> olmalı yada üyemizseniz giriş yapmalısınız...

						<?php } ?>

						

					</div>

					


				</div>
			</div>

			<div id="title-bg">
				<div class="title">Benzer Ürünler</div>
			</div>
			<div class="row prdct"><!--Products-->
				

				<?php 

				$kategori_id=$uruncek['categoryId'];

				$urunaltsor=$db->prepare("SELECT * FROM products where categoryId=:kategori_id order by  rand() limit 3");
				$urunaltsor->execute(array(
					'kategori_id' => $kategori_id
					));

				while($urunaltcek=$urunaltsor->fetch(PDO::FETCH_ASSOC)) {
					
					?>

					<div class="col-md-4">
						<div class="productwrap">
							<div class="pr-img">
								<div class="hot"></div>
								<a href="urun-<?=seo($urunaltcek["productName"]).'-'.$urunaltcek["urun_id"]?>"><img src="images\sample-3.jpg" alt="" class="img-responsive"></a>
								<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice"> TL</span></div></div>
							</div>
							<span class="smalltitle"><a href="product.htm"><?php echo $urunaltcek['productName'] ?></a></span>
							<span class="smalldesc">Ürün Kodu.: <?php echo $urunaltcek['urun_id'] ?></span>
						</div>
					</div>

					<?php } ?>


				</div><!--Products-->
				<div class="spacer"></div>
			</div><!--Main content-->


			<?php include 'sidebar.php' ?>
		</div>
	</div>

	<?php include 'footer.php' ?>
