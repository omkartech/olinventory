

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Orders</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Orders</li>
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
            <h3 class="box-title">Add Order</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('orders/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="gross_amount" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') ?></label>
                </div>
                <!-- <div class="form-group">
                  <label for="gross_amount" class="col-sm-12 control-label">Date: <?php echo date('h:i a') ?></label>
                </div> -->

                <div class="col-md-4 col-xs-12 pull pull-left">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Name</label>
                    <div class="col-sm-7">
                      <select class="form-control select_group" id="vendor" name="vendor[]" style="width:100%;" required>
                        <option value=""></option>
                        <?php foreach ($vendor as $k => $v): ?>
                          <option value="<?php echo $v['vendor_id'] ?>"><?php echo $v['vendor_name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>

                  <!-- <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Address</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Enter Customer Address" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Phone</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Customer Phone" autocomplete="off">
                    </div>
                  </div> -->
                </div>
                
                
                <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:20%">Product</th>
                      <th style="width:15%">Color</th>
                      <th style="width:15%">Size</th>
                      <th style="width:10%">Uom</th>
                      <th style="width:10%">Rate</th>
                      <th style="width:10%">Qty</th>
                      <th style="width:20%">Amount</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                       <td>
                        <select class="form-control select_group product" data-row-id="1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                            <option value=""></option>
                            <?php foreach ($products as $k => $v): ?>
                              <option value="<?php echo $v['product_id'] ?>"><?php echo $v['product_name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                        <td id="colorData_1">
                        <select class="form-control select_group product" data-row-id="1" id="color_1" name="color[]" style="width:100%;" required>
                            <option value=""></option>
                           
                          </select>
                        </td>
                        <td id="sizeData_1">
                        <select class="form-control select_group product" data-row-id="1" id="color_1" name="color[]" style="width:100%;" required>
                            <option value=""></option>
                           
                          </select>
                        </td>
                        <td id="uomData_1">
                        <select class="form-control select_group product" data-row-id="1" id="color_1" name="color[]" style="width:100%;" required>
                            <option value=""></option>
                           
                          </select>
                        </td>
                        <td>
                          <input type="text" name="rate[]" id="rate_1" class="form-control" autocomplete="off">
                        </td>
                        <td><input type="number" min="0" max="10" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td>
                          <input type="text" name="amount[]" id="amount_1" value="0" class="form-control" disabled autocomplete="off">
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>

                <br /> <br/>

                 <div class="col-md-6 col-xs-12 pull pull-right">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" value="0" id="gross_amount" name="gross_amount" disabled autocomplete="off">
                    </div>
                  </div>
                </div>

                <!-- <div class="col-md-6 col-xs-12 pull pull-right">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" autocomplete="off">
                    </div>
                  </div>
                  <?php if($is_service_enabled == true): ?>
                  <div class="form-group">
                    <label for="service_charge" class="col-sm-5 control-label">S-Charge <?php echo $company_data['service_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="service_charge" name="service_charge" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php if($is_vat_enabled == true): ?>
                  <div class="form-group">
                    <label for="vat_charge" class="col-sm-5 control-label">Vat <?php echo $company_data['vat_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Discount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off">
                    </div>
                  </div>

                </div> -->
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <!-- <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off"> -->
                <button type="button" class="btn btn-primary" id="createOrder">Create Order</button>
                <a href="<?php echo base_url('orders/') ?>" class="btn btn-warning">Back</a>
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
  var base_url = "<?php echo base_url(); ?>";
  var products = <?php echo json_encode($products)?>;
  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainOrdersNav").addClass('active');
    $("#addOrderNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
  
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(products, function(index, value) {
                          html += '<option value="'+value.product_id+'">'+value.product_name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+
                    '<td id="colorData_'+row_id+'">'+ 
                    '<select class="form-control select_group product" style="width:100%;">'+
                        '<option value=""></option></select>'+ 
                    '<td id="sizeData_'+row_id+'">'+ 
                    '<select class="form-control select_group product" style="width:100%;">'+
                        '<option value=""></option></select>'+ 
                    '<td id="uomData_'+row_id+'">'+ 
                    '<select class="form-control select_group product" style="width:100%;">'+
                        '<option value=""></option></select>'+ 
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="amount[]" value="0" id="amount_'+row_id+'" class="form-control" disabled></td>'+
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $(".product").select2();

      return false;
    });

  }); // /document

  function getTotal(row = null) {
    if(row) {
      var total = Number($("#rate_"+row).val()) * Number($("#qty_"+row).val());
      total = total.toFixed(2);
      $("#amount_"+row).val(total);
      var length = $('table tbody tr').length;

      var totalAmount = 0;
      for (var i = 1; i <= length; i++) {
        if($("#amount_"+i)){

          totalAmount = parseFloat(totalAmount) + parseFloat($("#amount_"+i).val());
        }
      };
      $("#gross_amount").val(totalAmount.toFixed(2));
      
      
      //subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }

  // get the product information from the server
  function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    
      $.ajax({
        url: base_url + 'invoice/getColor/'+product_id,
        type: 'get',
        dataType: 'json',
        success:function(response) {
          var html = '<select class="form-control select_group color" data-row-id="'+row_id+'" id="color_'+row_id+'" name="color[]" style="width:100%;" required>'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.color_id+'">'+value.color_name+'</option>';             
                        });
                        
                      html += '</select>';
              $("#colorData_"+row_id).html(html);
        } // /success
      }); 
  }

  $(document).on('change', '.color', function(){
    var row_id = $(this).attr('data-row-id');    
    var color_id = $("#color_"+row_id).val();    
    var product_id = $("#product_"+row_id).val();
    
    $.ajax({
      url: base_url + 'invoice/getSize/'+color_id+'/'+product_id,
      type: 'get',
      dataType: 'json',
      success:function(response) {
         var html = '<select class="form-control select_group size" data-row-id="'+row_id+'" id="size_'+row_id+'" name="size[]" style="width:100%;" required>'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.size_id+'">'+value.size_name+'</option>';             
                        });
                        
                      html += '</select>';
        $("#sizeData_"+row_id).html(html);
       
      } // /success
    });
  })

  $(document).on('change', '.size', function(){
    var row_id = $(this).attr('data-row-id');    
    var size_id = $("#size_"+row_id).val();    
    var color_id = $("#color_"+row_id).val();    
    var product_id = $("#product_"+row_id).val();
    
    $.ajax({
      url: base_url + 'invoice/getUom/'+size_id+'/'+color_id+'/'+product_id,
      type: 'get',
      dataType: 'json',
      success:function(response) {
         var html = '<select class="form-control select_group uom" data-row-id="'+row_id+'" id="uom_'+row_id+'" name="uom[]" style="width:100%;" required>'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                           html += '<option value="'+value.uom_id+'">'+value.uom_name+'</option>';                    
                        });
                        
                      html += '</select>';
        $("#uomData_"+row_id).html(html);
       
      } // /success
    });
  })


  $(document).on('click', '#createOrder', function(){
    var length = $('table tbody tr').length;
    var order = [];
    for (var i = 1; i <= length; i++) {
      if($('#product_'+i)){
        order.push({
          "product_id" : $('#product_'+i).val(),
          "color_id" : $('#color_'+i).val(),
          "size_id" : $('#size_'+i).val(),
          "uom_id" : $('#uom_'+i).val(),
          "rate" : $('#rate_'+i).val(),
          "qty" : $('#qty_'+i).val(),
        })
      }
    };

    var vendor_id = $('#vendor').val();

    
    $.ajax({
      url: base_url + 'invoice/generate/'+vendor_id,
      type: 'post',
      data: {data : order},
      dataType: 'json',
      success:function(response) {
         location.href = base_url+"orders";
      } // /success
    });
  })

  // calculate the total amount of the order
  /*function subAmount() {
    var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>;
    var vat_charge = <?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value']:0; ?>;

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);

    // vat
    var vat = (Number($("#gross_amount").val())/100) * vat_charge;
    vat = vat.toFixed(2);
    $("#vat_charge").val(vat);
    $("#vat_charge_value").val(vat);

    // service
    var service = (Number($("#gross_amount").val())/100) * service_charge;
    service = service.toFixed(2);
    $("#service_charge").val(service);
    $("#service_charge_value").val(service);
    
    // total amount
    var totalAmount = (Number(totalSubAmount) + Number(vat) + Number(service));
    totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    var discount = $("#discount").val();
    if(discount) {
      var grandTotal = Number(totalAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
      $("#net_amount_value").val(grandTotal);
    } else {
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);
      
    } // /else discount 

  }*/ // /sub total amount

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>