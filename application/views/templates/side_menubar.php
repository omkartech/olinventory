<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <?php //if($user_permission): ?>
          <?php //if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
<!--             <li class="treeview" id="mainUserNav">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>Users</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php //if(in_array('createUser', $user_permission)): ?>
              <li id="createUserNav"><a href="<?php echo base_url('users/create') ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
              <?php //endif; ?>

              <?php //if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
              <li id="manageUserNav"><a href="<?php echo base_url('users') ?>"><i class="fa fa-circle-o"></i> Manage Users</a></li>
            <?php //endif; ?>
            </ul>
          </li> -->
          <?php //endif; ?>

          <li class="treeview" id="mainOrdersNav">
              <a href="#">
                <i class="fa fa-dollar"></i>
                <span>Orders</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php //if(in_array('createOrder', $user_permission)): ?>
                  <li id="addOrderNav"><a href="<?php echo base_url('orders/create') ?>"><i class="fa fa-circle-o"></i> Add Order</a></li>
                <?php //endif; ?>
                <?php //if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                <li id="manageOrdersNav"><a href="<?php echo base_url('orders') ?>"><i class="fa fa-circle-o"></i> Manage Orders</a></li>
                <?php //endif; ?>
              </ul>
            </li>

          <?php //if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
          <!--   <li class="treeview" id="mainGroupNav">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Groups</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php //if(in_array('createGroup', $user_permission)): ?>
                  <li id="addGroupNav"><a href="<?php echo base_url('groups/create') ?>"><i class="fa fa-circle-o"></i> Add Group</a></li>
                <?php //endif; ?>
                <?php //if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li id="manageGroupNav"><a href="<?php echo base_url('groups') ?>"><i class="fa fa-circle-o"></i> Manage Groups</a></li>
                <?php //endif; ?>
              </ul>
            </li> -->
          <?php //endif; ?>


          <?php //if(in_array('createBrand', $user_permission) || in_array('updateBrand', $user_permission) || in_array('viewBrand', $user_permission) || in_array('deleteBrand', $user_permission)): ?>
            <!-- <li id="brandNav">
              <a href="<?php echo base_url('brands/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>Brands</span>
              </a>
            </li> -->
          <?php //endif; ?>

          <?php //if(in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
            <!-- <li id="categoryNav">
              <a href="<?php echo base_url('category/') ?>">
                <i class="fa fa-files-o"></i> <span>Category</span>
              </a>
            </li> -->
          <?php //endif; ?>

          <?php //if(in_array('createVendor', $user_permission) || in_array('updateVendor', $user_permission) || in_array('viewVendor', $user_permission) || in_array('deleteVendor', $user_permission)): ?>
            <li id="vendorNav">
              <a href="<?php echo base_url('vendor/') ?>">
                <i class="fa fa-files-o"></i> <span>Vendor</span>
              </a>
            </li>
          <?php //endif; ?>

            <li id="vendorNav">
              <a href="<?php echo base_url('uom/') ?>">
                <i class="fa fa-files-o"></i> <span>Unit Of Measurement</span>
              </a>
            </li>

            <li id="productsNav">
              <a href="<?php echo base_url('products/') ?>">
                <i class="fa fa-files-o"></i> <span>Products</span>
              </a>
            </li>

            <li id="colorNav">
              <a href="<?php echo base_url('color/') ?>">
                <i class="fa fa-files-o"></i> <span>Color</span>
              </a>
            </li>

            <li id="sizeNav">
              <a href="<?php echo base_url('size/') ?>">
                <i class="fa fa-files-o"></i> <span>Size</span>
              </a>
            </li>

            <li class="treeview" id="mainGstNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Vendor GST Account</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li id="addGstNav"><a href="<?php echo base_url('gst/create') ?>"><i class="fa fa-circle-o"></i> Add Vendor GST</a></li>
                <li id="manageGstNav"><a href="<?php echo base_url('gst') ?>"><i class="fa fa-circle-o"></i> Manage Vendor GST</a></li>
              </ul>
            </li>

            <li class="treeview" id="mainInventoryNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Inventory</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li id="addInventoryNav"><a href="<?php echo base_url('inventory/create') ?>"><i class="fa fa-circle-o"></i> Add Stock</a></li>
                <li id="manageInventoryNav"><a href="<?php echo base_url('inventory') ?>"><i class="fa fa-circle-o"></i> Manage Stock</a></li>
              </ul>
            </li>

          <?php //if(in_array('createStore', $user_permission) || in_array('updateStore', $user_permission) || in_array('viewStore', $user_permission) || in_array('deleteStore', $user_permission)): ?>
            <!-- <li id="storeNav">
              <a href="<?php echo base_url('stores/') ?>">
                <i class="fa fa-files-o"></i> <span>Stores</span>
              </a>
            </li> -->
          <?php //endif; ?>

          <?php //if(in_array('createAttribute', $user_permission) || in_array('updateAttribute', $user_permission) || in_array('viewAttribute', $user_permission) || in_array('deleteAttribute', $user_permission)): ?>
          <!-- <li id="attributeNav">
            <a href="<?php echo base_url('attributes/') ?>">
              <i class="fa fa-files-o"></i> <span>Attributes</span>
            </a>
          </li> -->
          <?php //endif; ?>

          <?php //if(in_array('createOrder', $user_permission) || in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
           <!--  <li class="treeview" id="mainOrdersNav">
              <a href="#">
                <i class="fa fa-dollar"></i>
                <span>Orders</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php //if(in_array('createOrder', $user_permission)): ?>
                  <li id="addOrderNav"><a href="<?php echo base_url('orders/create') ?>"><i class="fa fa-circle-o"></i> Add Order</a></li>
                <?php //endif; ?>
                <?php //if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                <li id="manageOrdersNav"><a href="<?php echo base_url('orders') ?>"><i class="fa fa-circle-o"></i> Manage Orders</a></li>
                <?php //endif; ?>
              </ul>
            </li> -->
          <?php //endif; ?>

          <?php //if(in_array('viewReports', $user_permission)): ?>
           <!--  <li id="reportNav">
              <a href="<?php echo base_url('reports/') ?>">
                <i class="glyphicon glyphicon-stats"></i> <span>Reports</span>
              </a>
            </li> -->
          <?php //endif; ?>


          <?php //if(in_array('updateCompany', $user_permission)): ?>
            <!-- <li id="companyNav"><a href="<?php echo base_url('company/') ?>"><i class="fa fa-files-o"></i> <span>Company</span></a></li> -->
          <?php //endif; ?>

        

        <!-- <li class="header">Settings</li> -->

        <?php //if(in_array('viewProfile', $user_permission)): ?>
          <li><a href="<?php echo base_url('users/profile/') ?>"><i class="fa fa-user-o"></i> <span>Profile</span></a></li>
        <?php //endif; ?>
        <?php //if(in_array('updateSetting', $user_permission)): ?>
          <li><a href="<?php echo base_url('users/setting/') ?>"><i class="fa fa-wrench"></i> <span>Setting</span></a></li>
        <?php //endif; ?>

        <?php //endif; ?>
        <!-- user permission info -->
        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span>Logout</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>