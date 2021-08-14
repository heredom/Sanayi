<?php 

include 'header.php'; 


$kategorisor=$db->prepare("SELECT * FROM productcategories where id=:id");
$kategorisor->execute(array(
  'id' => @$_GET['id']
  ));

$kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);

?>

<!-- End Navbar -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> kategori Listeleme
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Ad <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" name="category"
                                    placeholder="Kategori Adını Giriniz" required="required"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
 
                        
                        

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Sıra <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kategori_sira" placeholder="Sira Giriniz" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>





            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Durum<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <select id="heard" class="form-control" name="kategori_durum" required>


                                    <option value="1" >Aktif</option>



                                    <option value="0" >Pasif</option>
                                    

                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $kategoricek['id'] ?>">

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" name="kategoriekle" class="btn btn-success">Kaydet</button>
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