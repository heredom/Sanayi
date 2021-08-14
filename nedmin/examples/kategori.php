
<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$kategorisor=$db->prepare("SELECT * FROM productcategories order by kategori_sira ASC");
$kategorisor->execute();


?>

<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> Kategori Listeleme 
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
              <a href="kategori-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>

            </div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>kategori Ad</th>
                  
                  <th>kategori Sira</th>
                  <th>kategori Durum</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php 

                while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {?>


                <tr>
                  <td><?php echo $kategoricek['category'] ?></td>
                 
                  <td><?php echo $kategoricek['kategori_sira'] ?></td>
                  <td><?php 
                  
                  
                  if($kategoricek['kategori_durum']==1){?>

                 <button class="btn btn-success btn-xs">Aktif</button>        
                 <?php } else{?>
                    <button class="btn btn-danger btn-xs">Pasif</button>

                 <?php }  ?>
                  
                
                </td>





                  
                  <td><center><a href="kategori-duzenle.php?id=<?php echo $kategoricek['id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  <td><center><a href="../netting/islem.php?id=<?php echo $kategoricek['id']; ?>&kategorisil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
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