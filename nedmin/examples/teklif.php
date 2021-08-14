
<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$teklifsor=$db->prepare("SELECT * FROM offers order by offerValue DESC");
$teklifsor->execute();


?>

<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> Teklif Listeleme 
            <small>
           
            <?php 

if (@$_GET['durum']=="ok") {?>

<b style="color:green;">İşlem Başarılı...</b>

<?php } elseif (@$_GET['durum']=="no") {?>

<b style="color:red;">İşlem Başarısız...</b>

<?php }

?>
            </small>
          </h3> 

         
            
          <div class="clearfix"></div>

<div align="right">
  <a href="teklif-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>

</div>
</div>
<div class="x_content">


<!-- Div İçerik Başlangıç -->

<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>S.No</th>
      <th>teklif detay</th>
      <th>teklif fiyat</th>
      <th>Kullanıcı</th>
      <th>Ürün</th>
      <th>Durum</th>
      <th></th>
    </tr>
  </thead>

  <tbody>

    <?php 

    $say=0;

    while($teklifcek=$teklifsor->fetch(PDO::FETCH_ASSOC)) { $say++?>


    <tr>
     <td width="20"><?php echo $say ?></td>
     <td><?php echo $teklifcek['offerHead'] ?></td>
     <td><?php echo $teklifcek['offerValue'] ?></td>
     <td><?php 

       $kullanici_id=$teklifcek['kullanici_id'];

       $kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
       $kullanicisor->execute(array(
        'id' => $kullanici_id
        ));

       $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

       echo $kullanicicek['kullanici_adsoyad'];



       ?></td>
       <td><?php 

         $urun_id=$teklifcek['productId'];

         $urunsor=$db->prepare("SELECT * FROM products where urun_id=:id");
         $urunsor->execute(array(
          'id' =>  $urun_id
          ));

         $uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);


         echo $uruncek['productName'];



         ?></td>
         <td><center><?php 

           if ($teklifcek['teklif_onay']==0) {?>

           <a href="../netting/islem.php?offers_id=<?php echo $teklifcek['offers_id'] ?>&teklif_one=1&teklif_onay=ok"><button class="btn btn-success btn-xs">Onayla</button></a>


           <?php } elseif ($teklifcek['teklif_onay']==1) {?>


           <a href="../netting/islem.php?offers_id=<?php echo $teklifcek['offers_id'] ?>&teklif_one=0&teklif_onay=ok"><button class="btn btn-warning btn-xs">Kaldır</button></a>

           <?php } ?>


         </center></td>


         



<td><center><a href="../netting/islem.php?offers_id=<?php echo $teklifcek['offers_id']; ?>&teklifsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
</tr>



<?php  }

?>


</tbody>
</table>

              </tbody>
            </table>

          
        
        </div>
       
        </div>
      </div>
    </div>


</div>
  </div><?php include 'footer.php';?>