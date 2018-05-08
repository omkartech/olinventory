

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Stock</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Stock</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Edit Stock</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('gst/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="product">Product</label>
                  <?php $product_data = $inventory_data['product_id']; ?>
                  <select class="form-control select_group" id="product_id" name="product_id" disabled>
                    <?php foreach ($product as $k => $v): ?>
                      <option value="<?php echo $v['product_id']; ?>"<?php if($v['product_id'] == $product_data) { echo 'selected="selected"'; } ?>><?php echo $v['product_name']; ?></option>
                    <?php endforeach ?>
                  </select>
                  <input type="hidden" name="product_id" value="<?php echo $v['product_id'];?>" />
                </div>  

                <div class="form-group">
                  <label for="size">Size</label>
                  <?php $size_data = $inventory_data['size_id']; ?>
                  <select class="form-control select_group" id="size_id" name="size_id" disabled>
                    <?php foreach ($size as $k => $v): ?>
                      <option value="<?php echo $v['size_id']; ?>"<?php if($v['size_id'] == $size_data) { echo 'selected="selected"'; } ?>><?php echo $v['size_name']; ?></option>
                    <?php endforeach ?>
                  </select>
                  <input type="hidden" name="size_id" value="<?php echo $v['size_id'];?>" />
                </div>

                <div class="form-group">
                  <label for="color">Color</label>
                  <?php $color_data = $inventory_data['color_id']; ?>
                  <select class="form-control select_group" id="color_id" name="color_id" disabled>
                    <?php foreach ($color as $k => $v): ?>
                       <option value="<?php echo $v['color_id']; ?>"<?php if($v['color_id'] == $color_data) { echo 'selected="selected"'; } ?>><?php echo $v['color_name']; ?></option>
                    <?php endforeach ?>
                  </select>
                  <input type="hidden" name="color_id" value="<?php echo $v['color_id'];?>" />
                </div>

                <div class="form-group">
                  <label for="uom">UOM</label>
                  <?php $uom_data = $inventory_data['uom_id']; ?>
                  <select class="form-control select_group" id="uom_id" name="uom_id" disabled>
                    <?php foreach ($uom as $k => $v): ?>
                      <option value="<?php echo $v['uom_id']; ?>"<?php if($v['uom_id'] == $uom_data) { echo 'selected="selected"'; } ?>><?php echo $v['uom_name']; ?></option>
                    <?php endforeach ?>
                  </select>
                  <input type="hidden" name="uom_id" value="<?php echo $v['uom_id'];?>" />
                </div>

                <div class="form-group">
                  <label for="stock">Current Stock</label>
                  <input type="text" class="form-control" id="stock" name="stock" placeholder="Enter Stock to be added" value="<?php echo $inventory_data['stock']; ?>" autocomplete="off" disabled/>
                  <input type="hidden" name="stock" value="<?php echo $inventory_data['stock'];?>" />
                </div>

                <div class="form-group">
                  <label for="stock">New Stock</label>
                  <input type="text" class="form-control" id="new_stock" name="new_stock" placeholder="Enter New Stock to be added" value="0" autocomplete="off"/>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('users/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
