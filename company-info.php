<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once "classes/Currency.php";
  

  $currency = new Currency();

  if ($_SERVER['REQUEST_METHOD']=="POST") {

      $conpanyInfo = $company->company_info($_POST, $_FILES);
  }

  $company = $company->get_company_info();

  $company = mysqli_fetch_array($company);

  $currencies = $currency->currency_data();
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <?php if(isset($conpanyInfo)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $conpanyInfo; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Company Info</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action='' method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Company Name</label>
                    <input type="text" class="form-control" name="company_name" value="<?php echo $company['company_name'];?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Company Address</label>
                    <input type="text" class="form-control" name="company_address" value="<?php echo $company['company_address'];?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Company Mobile</label>
                    <input type="text" class="form-control" name="company_mobile" value="<?php echo $company['company_mobile'];?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Company Email</label>
                    <input type="text" class="form-control" name="company_email" value="<?php echo $company['company_email'];?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Company Website</label>
                    <input type="text" class="form-control" name="company_website" value="<?php echo $company['company_website'];?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Company Facebook</label>
                    <input type="text" class="form-control" name="company_facebook" value="<?php echo $company['company_facebook'];?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Company Youtube</label>
                    <input style="padding-bottom: 10px;" type="text" class="form-control" name="company_youtube" value="<?php echo $company['company_youtube'];?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Company Message</label>
                    <textarea class="form-control" name="company_message"><?php echo $company['company_message'];?></textarea> 
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Company Currency</label>
                    <select class="form-control" name="company_currency">
                      <option>Select Company Currency</option>
                      <?php
                        foreach($currencies as $k => $v){
                      ?>
                      <option <?php if($company['company_currency']==$k){echo "selected";}?> value="<?php echo $k;?>"><?php echo $k;?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Company Logo</label>
                    <img style="width:60px;" src="uploads/<?php echo $company['company_logo'];?>">
                    <input type="file" class="form-control" name="company_logo">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="company_info" class="btn btn-primary float-right">Update Company Info</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php
  include_once "inc/footer.php";
?>