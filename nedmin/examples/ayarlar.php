<?php include 'header.php';?>
<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> 
            Ayarlar 
            <small>
            <?php 

          if(@$_GET['durum']=="ok"){?>

           <b style="color:green;">İşlem Başarılı...</b>

           <?php }
           elseif(@$_GET['durum']=="no") {?>

            <b style="color:red;">İşlem Başarısız...</b>

         <?php }

             ?>
            </small>
           
          
          
        </h3>
        </div>
        <div class="card-body">
          <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Baslıgı <span
                  class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ayar_title" value="<?php echo $ayarcek['ayar_title']?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Açıklaması <span
                  class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ayar_description" value="<?php echo $ayarcek['ayar_description']?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Anahtarkelime <span
                  class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ayar_keywords"value="<?php echo $ayarcek['ayar_keywords']?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Author <span
                  class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ayar_author"value="<?php echo $ayarcek['ayar_author']?>"    >
              </div>
            </div>
            

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                <button name="genelayarkaydet" type="submit" class="btn btn-success">Güncelle</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>


</div>
  </div><?php include 'footer.php';?>