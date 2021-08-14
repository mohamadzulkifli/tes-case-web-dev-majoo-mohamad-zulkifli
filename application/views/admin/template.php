<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin </title>
  <link href="<?php echo base_url() ?>assets/plugins/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/admin.css" rel="stylesheet">
</head>
<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin/dashboard') ?>">
        <div class="sidebar-brand-text mx-3">Admin Majoo</div>
      </a>
      <hr class="sidebar-divider">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('admin/dashboard') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('admin/product') ?>">
          <i class="fas fa-fw fa-box"></i>
          <span>Product</span></a>
      </li>
      <hr class="sidebar-divider">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('admin/order') ?>">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Order</span> 
          <?php
            if ($order->total != '0') {
              echo '<span class="badge bg-danger rounded-pill position-absolute notif">'.$order->total.'</span>';
            }
          ?></a>
      </li>
      <hr class="sidebar-divider d-none d-md-block">
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
                <img class="img-profile rounded-circle" src="<?php echo base_url() ?>assets/images/user.jpg">
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <div class="container-fluid">
          <?php $this->load->view($template) ?>
        </div>
      </div>
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>2019 &copy; PT. Majoo Teknologi Indonesia</span>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah anda yakin ingin keluar?.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url('admin/login/logout') ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jquery-easing/jquery.easing.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/admin.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.btn-delete').click(function(){
      var produk_id    = $(this).data("produkid");
      var produk_img    = $(this).data("produkimg");
      $('#id_product').val(produk_id);
      $('#img_product').val(produk_img);
      $('#modal_delete').modal('show');
    });

    $('.btn-delete-order').click(function(){
      var order_id    = $(this).data("orderid");
      $('#id_order').val(order_id);
      $('#modal_delete_order').modal('show');
    });

    $('.btn-edit').click(function(){
      var produk_id    = $(this).data("produkid");
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('admin/product/get_product_by_id')?>",
        dataType : "JSON",
        data : {product_id:produk_id},
        success: function(data){
          $('#id_product_edit').val(produk_id);
          $('#nama_edit').val(data.nama_product);
          $('#harga_edit').val(data.harga_product);
          $('#deskripsi_edit').val(data.deskripsi_product);
          $('#gambar_value_edit').val(data.image_product);
          $('#image_result_edit').html('');
          $('#image_result_edit').append("<img src='<?php echo base_url() ?>"+data.image_product+"' alt='Gambar'><a class='remove-image delete_image_edit' href='#' data='"+data.image_product+"' style='display: inline;'>&#215;</a>");
          $('#modal_edit').modal('show');
        }
      });
      return false;
    });

    $('.btn-product').click(function(){
      var produk_nama    = $(this).data("produknama");
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('admin/order/get_product_by_name')?>",
        dataType : "JSON",
        data : {product_nama:produk_nama},
        success: function(data){
          $('#img-product-show').html('');
          $('#title-product-show').html('');
          $('#harga-product-show').html('');
          $('#deskripsi-product-show').html('');
          $('#img-product-show').append("<img src='<?php echo base_url() ?>"+data.image_product+"' alt='Gambar'>");
          $('#title-product-show').append("<b>"+data.nama_product+"</b>");
          $('#harga-product-show').append("Rp. "+number_format(data.harga_product));
          $('#deskripsi-product-show').append(data.deskripsi_product);
          $('#modal_show_product').modal('show');
        }
      });
      return false;
    });
  });
  $('#gambar').change(function(e){
    var file = e.target.files ||e.dataTransfer.files;
    if(!file.length)
      return;
    upload_gambar(file[0]);
  });

  function upload_gambar(file){
    var formData = new FormData();                      
    formData.append("gambar",file);
    $.ajax({
      url: "<?php echo base_url('admin/product/upload') ?>",
      method: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json', 
      beforeSend: function(  ) {
        $('#image_result').html('<img src="<?php echo base_url() ?>assets/images/loading.gif">');
      }
    })
    .done(function( response ) {
      $('#image_result').html('');
      if (response.error == false) {
        $('#image_result').append("<img src='<?php echo base_url() ?>"+response.message+"' alt='Gambar'><a class='remove-image delete_image' href='#' data='"+response.message+"' style='display: inline;'>&#215;</a>");
        $('#gambar_value').val(response.message);
        $('#gambar').replaceWith( $('#gambar').val('').clone( true ) );
      }else{
        $('#image_result').html('');
        $('#image_result').append('<div class="alert alert-danger fade show" role="alert"><strong>'+response.message+'</strong></div>');
      }
    });
  }

  $('body').on('click','.delete_image',function(e){
    var that = $(this);
    var image = $(this).attr('data');
    $.ajax({
      url: "<?php echo base_url('admin/product/delete_image') ?>",
      method: "POST",
      data: {'gambar':image},
      dataType: 'json', 
      beforeSend: function(  ) {
        $('#image_result').html('<img src="<?php echo base_url() ?>assets/images/loading.gif">');
      }
    })
    .done(function( response ) {
      $('#image_result').html('');
      if (response.error == false) {
        that.parent('.alert').remove();
        console.log(response.message);
        $('#image_result').html('');
        $('#gambar_value').val("");
      }else{
        $('#image_result').html('');
        $('#image_result').append('<div class="alert alert-danger fade show" role="alert"><strong>'+response.message+'</strong></div>');
      }
    });
    e.preventDefault();
  });

  $('#gambar_edit').change(function(e){
    var file = e.target.files ||e.dataTransfer.files;
    if(!file.length)
      return;
    upload_gambar_edit(file[0]);
  });

  function upload_gambar_edit(file){
    var formData = new FormData();                      
    formData.append("gambar",file);
    $.ajax({
      url: "<?php echo base_url('admin/product/upload') ?>",
      method: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json', 
      beforeSend: function(  ) {
        $('#image_result_edit').html('<img src="<?php echo base_url() ?>assets/images/loading.gif">');
      }
    })
    .done(function( response ) {
      $('#image_result_edit').html('');
      if (response.error == false) {
        $('#image_result_edit').append("<img src='<?php echo base_url() ?>"+response.message+"' alt='Gambar'><a class='remove-image delete_image_edit' href='#' data='"+response.message+"' style='display: inline;'>&#215;</a>");
        $('#gambar_value_edit').val(response.message);
        $('#gambar_edit').replaceWith( $('#gambar_edit').val('').clone( true ) );
      }else{
        $('#image_result_edit').html('');
        $('#image_result_edit').append('<div class="alert alert-danger fade show" role="alert"><strong>'+response.message+'</strong></div>');
      }
    });
  }

  $('body').on('click','.delete_image_edit',function(e){
    var that = $(this);
    var image = $(this).attr('data');
    $.ajax({
      url: "<?php echo base_url('admin/product/delete_image') ?>",
      method: "POST",
      data: {'gambar':image},
      dataType: 'json', 
      beforeSend: function(  ) {
        $('#image_result_edit').html('<img src="<?php echo base_url() ?>assets/images/loading.gif">');
      }
    })
    .done(function( response ) {
      $('#image_result_edit').html('');
      if (response.error == false) {
        that.parent('.alert').remove();
        console.log(response.message);
        $('#image_result_edit').html('');
        $('#gambar_value_edit').val("");
      }else{
        $('#image_result_edit').html('');
        $('#image_result_edit').append('<div class="alert alert-danger fade show" role="alert"><strong>'+response.message+'</strong></div>');
      }
    });
    e.preventDefault();
  });

  function number_format (number, decimals, decPoint, thousandsSep) { 
     number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
     var n = !isFinite(+number) ? 0 : +number
     var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
     var sep = (typeof thousandsSep === 'undefined') ? '.' : thousandsSep
     var dec = (typeof decPoint === 'undefined') ? ',' : decPoint
     var s = ''

     var toFixedFix = function (n, prec) {
      var k = Math.pow(10, prec)
      return '' + (Math.round(n * k) / k)
      .toFixed(prec)
    }

   // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
   s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
   if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || ''
    s[1] += new Array(prec - s[1].length + 1).join('0')
  }

  return s.join(dec)
  }
</script>
</html>