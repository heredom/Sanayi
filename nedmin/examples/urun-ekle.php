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

                       

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">urun Ad <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" name="productName"
                                    placeholder="Ürün Adını Giriniz" required="required"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
  <!-- Ck Editör Başlangıç -->

  <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Detay <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <textarea  class="ckeditor" id="editor1" name="productDescription"></textarea>
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
                  <input type="date" id="first-name" name="offerCreateTime"placeholder="Ürün Teklif Başlangıc Tarihini Giriniz" required="required" class="form-control col-md-7 col-xs-12">
                  
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Urun Teklif Bitiş Tarihi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="date" id="first-name" name="offerFinishedTime" placeholder="Ürün Teklif Başlangıc Tarihini Giriniz" required="required" class="form-control col-md-7 col-xs-12">
                  
                </div>
              </div>





            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Urun Durum<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <select id="heard" class="form-control" name="urun_durum" required>

                                    <option value="1">Aktif</option>



                                    <option value="0" >Pasif</option>
                                   


                                </select>
                            </div>
                        </div>
                        

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" name="urunekle" class="btn btn-success">Kaydet</button>
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