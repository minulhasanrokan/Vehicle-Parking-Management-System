<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="assets/img/car-parking.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Dashboard</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <?php if(in_array('createUser', $userPermission) || in_array('updateUser', $userPermission) || in_array('viewUser', $userPermission) || in_array('deleteUser', $userPermission)): ?>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Users
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if(in_array('createUser', $userPermission)): ?>
            <li class="nav-item">
              <a href="add-user.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add User</p>
              </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('updateUser', $userPermission) || in_array('viewUser', $userPermission) || in_array('deleteUser', $userPermission)): ?>
            <li class="nav-item">
              <a href="manage-user.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Users</p>
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>


        <?php if(in_array('createGroup', $userPermission) || in_array('updateGroup', $userPermission) || in_array('viewGroup', $userPermission) || in_array('deleteGroup', $userPermission)): ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Groups
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if(in_array('createGroup', $userPermission)): ?>
            <li class="nav-item">
              <a href="add-group.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Group</p>
              </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('updateGroup', $userPermission) || in_array('viewGroup', $userPermission) || in_array('deleteGroup', $userPermission)): ?>
            <li class="nav-item">
              <a href="manage-group.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Groups</p>
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>

        <?php if(in_array('createCategory', $userPermission) || in_array('updateCategory', $userPermission) || in_array('viewCategory', $userPermission) || in_array('deleteCategory', $userPermission)): ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Category
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if(in_array('createCategory', $userPermission)): ?>
            <li class="nav-item">
              <a href="add-category.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Category</p>
              </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('updateCategory', $userPermission) || in_array('viewCategory', $userPermission) || in_array('deleteCategory', $userPermission)): ?>
            <li class="nav-item">
              <a href="manage-category.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Category</p>
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>


        <?php if(in_array('createRates', $userPermission) || in_array('updateRates', $userPermission) || in_array('viewRates', $userPermission) || in_array('deleteRates', $userPermission)): ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Parking Rate
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if(in_array('createRates', $userPermission)): ?>
            <li class="nav-item">
              <a href="add-rate.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Parking Rate</p>
              </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('updateRates', $userPermission) || in_array('viewRates', $userPermission) || in_array('deleteRates', $userPermission)): ?>
            <li class="nav-item">
              <a href="manage-rate.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Parking Rate</p>
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>


        <?php if(in_array('createSlots', $userPermission) || in_array('updateSlots', $userPermission) || in_array('viewSlots', $userPermission) || in_array('deleteSlots', $userPermission)): ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Parking Slot
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if(in_array('createSlots', $userPermission)): ?>
            <li class="nav-item">
              <a href="add-slot.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Parking Slot</p>
              </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('updateSlots', $userPermission) || in_array('viewSlots', $userPermission) || in_array('deleteSlots', $userPermission)): ?>
            <li class="nav-item">
              <a href="manage-slot.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Parking Slot</p>
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>


        <?php if(in_array('createParking', $userPermission) || in_array('updateParking', $userPermission) || in_array('viewParking', $userPermission) || in_array('deleteParking', $userPermission)): ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Parking
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if(in_array('createParking', $userPermission)): ?>
            <li class="nav-item">
              <a href="add-parking.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Parking</p>
              </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('updateParking', $userPermission) || in_array('viewParking', $userPermission) || in_array('deleteParking', $userPermission)): ?>
            <li class="nav-item">
              <a href="manage-parking.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Parking</p>
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>


        <?php if(in_array('viewReports', $userPermission)): ?>
        <li class="nav-item">
          <a href="report.php" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Reports
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
        </li>
        <?php endif; ?>

         <?php if(in_array('updateCompany', $userPermission)): ?>
        <li class="nav-item">
          <a href="company-info.php" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Company Info
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
        </li>
        <?php endif; ?>




        <li class="nav-item">
          <a href="?status=logout" class="nav-link">
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <p>
               Sign Out
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>