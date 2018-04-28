

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Inventory</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Inventory</li>
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
            <h3 class="box-title">Add Inventory</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('inventory/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="product">Product</label>
                  <select class="form-control select_group" id="product_id" name="product_id">
                    <?php foreach ($product as $k => $v): ?>
                      <option value="<?php echo $v['product_id']; ?>"><?php echo $v['product_name']; ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="size">Size</label>
                  <select class="form-control select_group" id="size_id" name="size_id">
                    <?php foreach ($size as $k => $v): ?>
                      <option value="<?php echo $v['size_id'].'|'.$v['size_name']; ?>"><?php echo $v['size_name']; ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="color">Color</label>
                  <select class="form-control select_group" id="color_id" name="color_id">
                    <?php foreach ($color as $k => $v): ?>
                      <option value="<?php echo $v['color_id'].'|'.$v['color_name']; ?>"><?php echo $v['color_name']; ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="uom">UOM</label>
                  <select class="form-control select_group" id="uom_id" name="uom_id">
                    <?php foreach ($uom as $k => $v): ?>
                      <option value="<?php echo $v['uom_id'].'|'.$v['uom_name']; ?>"><?php echo $v['uom_name']; ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="stock">Stock</label>
                  <input type="text" class="form-control" id="stock" name="stock" placeholder="Enter Stock to be added" autocomplete="off" />
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('inventory/') ?>" class="btn btn-warning">Back</a>
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

<script type="text/javascript">
  $(document).ready(function() {
    $(".select_group").select2();
  })
</script>