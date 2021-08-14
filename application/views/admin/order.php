<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Product</h1>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col-md-12">
        <form class="row g-3" method="POST" action="<?php echo base_url('admin/order') ?>">
          <div class="col-auto">
            <?php
              if ($this->session->userdata('keyword_order_sess') == "") {
                echo '<input type="text" class="form-control" id="search" name="search" placeholder="Enter keyword">';
              } else {
                echo '<input type="text" class="form-control" id="search" name="search" placeholder="Enter keyword" value="'.$this->session->userdata('keyword_order_sess').'">';
              }
              
            ?>
          </div>
          <div class="col-auto">
            <input type="submit" class="btn btn-secondary" name="btn-cari" id="btn-cari" value="Cari">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="card-body">
    <?php if ($this->session->flashdata('message_success')) {?>
    <div class="alert alert-success" role="alert">
      <?php echo $this->session->flashdata('message_success'); ?>
    </div>
    <?php }?>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">TANGGAL</th>
            <th scope="col">NAMA</th>
            <th scope="col">EMAIL</th>
            <th scope="col">NO. WA</th>
            <th scope="col">ALAMAT</th>
            <th scope="col">PRODUK</th>
            <th scope="col">DELETE</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if (empty($data_order->result())) {
              echo "<tr><td colspan='7'><div class='alert alert-danger' role='alert'><center>Data Not Found</center></div></td></tr>";
            } else {
              foreach ($data_order->result() as $value) {
                echo "<tr>";
                echo "<td>".$value->created_at."</td>";
                echo "<td>".$value->nama."</td>";
                echo "<td>".$value->email."</td>";
                echo "<td>".$value->no_wa."</td>";
                echo "<td>".$value->alamat."</td>";
                echo "<td><a class='btn-product' href='#' data-produknama='".$value->nama_product."'>".$value->nama_product."</a></td>";
                echo "<td><button class='btn btn-danger btn-sm btn-delete-order' data-orderid='".$value->id_order."'>Delete</button></td>";
                echo "</tr>";
              }
            }
          ?>
        </tbody>
      </table>
      <?php 
        echo $pagination;
      ?>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_show_product" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Produk yang dipesan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <center>
              <div id="img-product-show"></div>
            </center>
          </div>
          <div class="col-md-8">
            <h3 id="title-product-show"></h3>
            <p id="harga-product-show"></p>
            <p id="deskripsi-product-show"></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_delete_order" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="<?php echo base_url('admin/order/delete') ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Order</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin ingin menghapus pesanan ini?</p>
          <input type="hidden" class="form-control" name="id_order" id="id_order">
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button class="btn btn-danger" type="submit">Delete</a>
        </div>
      </form>
    </div>
  </div>
</div>