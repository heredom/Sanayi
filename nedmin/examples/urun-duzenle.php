<?php 

include 'header.php'; 


$urunsor=$db->prepare("SELECT * FROM products where urun_id=:id");
$urunsor->execute(array(
  'id' => @$_GET['urun_id']
  ));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

?>

<!-- End Navbar -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Ürun Listeleme
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
                </div>
                <div class="x_content">
                    <br />

                    <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
                    <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate
                        class="form-horizontal form-label-left">


<!-- Kategori seçme başlangıç -->
                        <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Seç<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6">

                  <?php  

                  $urun_id=$uruncek['categoryId']; 

                  $kategorisor=$db->prepare("select * from productcategories where kategori_ust=:kategori_ust order by kategori_sira");
                  $kategorisor->execute(array(
                    'kategori_ust' => 0
                    ));

                    ?>
                    <select class="select2_multiple form-control" required="" name="categoryId" >


                     <?php 

                     while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {

                       $categoryId=$kategoricek['id'];

                       ?>

                       <option <?php if ($categoryId==$urun_id) { echo "selected='select'"; } ?> value="<?php echo $kategoricek['id']; ?>"><?php echo $kategoricek['category']; ?></option>

                       <?php } ?>

                     </select>
                   </div>
                 </div>


                 <!-- kategori seçme bitiş -->

                       

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">urun Ad <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" name="productName"
                                    value="<?php echo $uruncek['productName'] ?>" required="required"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
  <!-- Ck Editör Başlangıç -->

  <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Detay <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <textarea  class="ckeditor" id="editor1" name="productDescription"><?php echo $uruncek['productDescription']; ?></textarea>
                </div>
              </div>

              <script type="text/javascript">

               CKEDITOR.replace( 'editor1',

               {

                filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

                filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',

                filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',

                filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

                filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

                filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

                forcePasteAsPlainText: true

              } 

              );

            </script>
                        
                        

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Urun Teklif Baslangıc Tarihi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="datetime" id="first-name" name="offerCreateTime" value="<?php echo $uruncek['offerCreateTime'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                  
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Urun Teklif Bitiş Tarihi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="datetime" id="first-name" name="offerFinishedTime" value="<?php echo $uruncek['offerFinishedTime'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                  
                </div>
              </div>





            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Urun Durum<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <select id="heard" class="form-control" name="urun_durum" required>




                        

                                    <!-- Kısa İf Kulllanımı 

                    <?php echo $uruncek['urun_durum'] == '1' ? 'selected=""' : ''; ?>

                  -->
                                    <option value="1" <?php echo $uruncek['urun_durum']=='1' ? 'selected=""'
                                        : '' ; ?>>Aktif</option>



                                    <option value="0" <?php if ($uruncek['urun_durum']==0) {
                                        echo 'selected=""' ; } ?>>Pasif</option>
                                    <!-- <?php 

                   if ($uruncek['urun_durum']==0) {?>


                   <option value="0">Pasif</option>
                   <option value="1">Aktif</option>


                   <?php } else {?>

                   <option value="1">Aktif</option>
                   <option value="0">Pasif</option>

                   <?php  }

                   ?> -->


                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" name="urunduzenle" class="btn btn-success">Güncelle</button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>


</div>
</div>
<?php include 'footer.php';?>