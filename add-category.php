<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once "classes/Category.php";

  $category = new Category();

  if ($_SERVER['REQUEST_METHOD']=="POST") {
    
    
    if (!empty($_POST['category_name']) && !empty($_POST['category_status'])) {

      $addNewCategory = $category->add_new_category($_POST);
    }
    else{
      $addNewCategory =$meassage = "Category Name And Status Fiels Must Not Be Empty!!";
    }
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
            <?php if(in_array('createCategory', $userPermission) || in_array('updateCategory', $userPermission) || in_array('viewCategory', $userPermission) || in_array('deleteCategory', $userPermission)): ?>
            <a href="manage-category.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Manage Category</a>
            <?php endif; ?>
            <br><br>
            <div class="card card-primary">
              <?php if(isset($addNewCategory)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $addNewCategory; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Add New Vechile Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action='' method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" class="form-control" name="category_name" placeholder="Enter User Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Status</label>
                    <select class="form-control" name="category_status">
                      <option>Select Category Status</option>
                      <option value="1">Active</option>
                      <option value="0">Deactive</option>
                    </select>
                  </div> 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="add_category" class="btn btn-primary float-right">Add New Category</button>
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