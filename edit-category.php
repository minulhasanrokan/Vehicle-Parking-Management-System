<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once "classes/Category.php";

  $category = new Category();

  if(isset($_GET['category-id'])){

    $categoryId  = $_GET['category-id'];

    if ($_SERVER['REQUEST_METHOD']=="POST") {
    
      if (!empty($_POST['category_name']) && !empty($_POST['category_status'])) {

        $updateCategory = $category->update_category($_POST,$categoryId);
      }
      else{
        $updateCategory =$meassage = "Category Name And Status Fiels Must Not Be Empty!!";
      }
    }

    $categoryData = $category->get_single_category_data($categoryId);
  }


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
            <!-- general form elements -->
            <?php if(in_array('createCategory', $userPermission)): ?>
            <a href="add-category.php" class="btn btn-primary"> <i class="fa fa-plus"></i> ADD Category</a>
            <?php endif; ?>
            <?php if(in_array('createCategory', $userPermission) || in_array('updateCategory', $userPermission) || in_array('viewCategory', $userPermission) || in_array('deleteCategory', $userPermission)): ?>
            <a href="manage-category.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Manage Category</a>
            <?php endif; ?>
            <br><br>
            <div class="card card-primary">
              <?php if(isset($updateCategory)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $updateCategory; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Add New Vechile Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
                if(isset($categoryData)){

                  while($category =mysqli_fetch_assoc($categoryData)){
              ?>
              <form action='' method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" class="form-control" name="category_name" value="<?php echo $category['vechile_category_name'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Status</label>
                    <select class="form-control" name="category_status">
                      <option>Select Category Status</option>
                      <option
                      <?php
                        if($category['vechile_category_status']==1){
                          echo "selected";
                        }
                      ?>
                      value="1">Active</option>
                      <option
                      <?php
                        if($category['vechile_category_status']==0){
                          echo "selected";
                        }
                      ?>
                      value="0">Deactive</option>
                    </select>
                  </div> 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="update_category" class="btn btn-primary float-right">Add New Category</button>
                </div>
              </form>
              <?php
                   }
                }
              ?>
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