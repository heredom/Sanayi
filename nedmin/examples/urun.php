
<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$urunsor=$db->prepare("SELECT * FROM products order by categoryId ASC");
$urunsor->execute();


?>

<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> Ürün Listeleme 
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
              <a href="urun-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>

            </div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>urun Ad</th>
                  <th>urun kategori</th>
                  <th>urun Aciklama</th>
                  <th>urun önce Çikar</th>
                  <th>Resim İşlemleri</th>
                  <th>urun teklif başlangıc tarihi</th>
                  <th>urun teklif bitiş tarihi</th>
                  <th>Ürün Durum</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php 

                while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {?>


                <tr>
                  <td><?php echo $uruncek['productName'] ?></td>
                  <td><?php echo $uruncek['categoryId'] ?></td>
                  <td><?php echo $uruncek['productDescription'] ?></td>
                  <td><center><?php echo $uruncek['urun_onecikar'] ?></center></td>
                  <td><center><a href="urun-galeri.php?urun_id=<?php echo $uruncek['urun_id'] ?>"><button class="btn btn-success btn-xs">Resim İşlemleri</button></a></center></td>
                  <td><?php echo $uruncek['offerCreateTime'] ?></td>
                  <td><?php echo $uruncek['offerFinishedTime'] ?></td>
                  
                  
                  <td><?php 
                  
                  
                  
                  if($uruncek['urun_durum']==1){?>

                 <button class="btn btn-success btn-xs">Aktif</button>        
                 <?php } else{?>
                    <button class="btn btn-danger btn-xs">Pasif</button>

                 <?php }  ?>
                  
                
                </td>





                  
                  <td><center><a href="urun-duzenle.php?urun_id=<?php echo $uruncek['urun_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  <td><center><a href="../netting/islem.php?urun_id=<?php echo $uruncek['urun_id']; ?>&urunsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
                </tr>

                <?php  }
                ?>


              </tbody>
            </table>

          
        
        </div>
       
        </div>
      </div>
    </div>


</div>
  </div><?php include 'footer.php';?>