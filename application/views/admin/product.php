<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Product</h1>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col-md-6">
        <form class="row g-3" method="POST" action="<?php echo base_url('admin/product') ?>">
          <div class="col-auto">
            <?php
              if ($this->session->userdata('keyword_sess') == "") {
                echo '<input type="text" class="form-control" id="search" name="search" placeholder="Enter keyword">';
              } else {
                echo '<input type="text" class="form-control" id="search" name="search" placeholder="Enter keyword" value="'.$this->session->userdata('keyword_sess').'">';
              }
              
            ?>
          </div>
          <div class="col-auto">
            <input type="submit" class="btn btn-secondary" name="btn-cari" id="btn-cari" value="Cari">
          </div>
        </form>
      </div>
      <div class="col-md-6">
        <a class="btn btn-primary btn-add" href="#" data-toggle="modal" data-target="#modal_add">+ Add New</a>
        <div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form method="POST" action="<?php echo base_url('admin/product/save') ?>">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="text" class="form-control" name="harga" id="harga" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5"></textarea>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input class="form-control" type="file" id="gambar" name="gambar">
                    <input type='hidden' name='gambar_value' id='gambar_value' value=''>
                  </div>
                  <div class="mb-3 image-area" id="image_result"></div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <button class="btn btn-primary" type="submit">Save</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body">
    <?php if ($this->session->flashdata('message_success')) {?>
    <div class="alert alert-success" role="alert">
      <?php echo $this->session->flashdata('message_success'); ?>
    </div>
    <?php }?>
    <?php if ($this->session->flashdata('message_error')) {?>
    <div class="alert alert-danger" role="alert">
      <strong>Gagal menyimpan data! </strong><?php echo $this->session->flashdata('message_error'); ?>
    </div>
    <?php }?>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th scope="col" style="width: 10%;">NAMA</th>
            <th scope="col" style="width: 15%;">HARGA</th>
            <th scope="col" style="width: 50%;">DESKRIPSI</th>
            <th scope="col" style="width: 10%;">GAMBAR</th>
            <th scope="col" style="width: 15%;">AKSI</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if (empty($data_product->result())) {
              echo "<tr><td colspan='6'><div class='alert alert-danger' role='alert'><center>Data Not Found</center></div></td></tr>";
            } else {
              foreach ($data_product->result() as $value) {
                echo "<tr>";
                echo "<td>".$value->nama_product."</td>";
                echo "<td>Rp. ".number_format($value->harga_product,0,"",".")."</td>";
                echo "<td>".$value->deskripsi_product."</td>";
                echo "<td><img src='".base_url().$value->image_product."' class='card-img-top' alt='Image Product'></td>";
                echo "<td><button class='btn btn-warning btn-sm btn-edit' data-produkid='".$value->id_product."'>Edit</button> <button class='btn btn-danger btn-sm btn-delete' data-produkid='".$value->id_product."' data-produkimg='".$value->image_product."'>Delete</button></td>";
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
<div class="modal fade" id="modal_delete" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="<?php echo base_url('admin/product/delete') ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin ingin menghapus produk ini?</p>
          <input type="hidden" class="form-control" name="id_product" id="id_product">
          <input type="hidden" class="form-control" name="img_product" id="img_product">
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button class="btn btn-danger" type="submit">Delete</a>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_edit" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="<?php echo base_url('admin/product/update') ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="id_product_edit" id="id_product_edit" required>
          <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama_edit" id="nama_edit" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="text" class="form-control" name="harga_edit" id="harga_edit" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi_edit" id="deskripsi_edit" rows="5"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input class="form-control" type="file" id="gambar_edit" name="gambar_edit">
            <input type='hidden' name='gambar_value_edit' id='gambar_value_edit' value=''>
          </div>
          <div class="mb-3 image-area" id="image_result_edit"></div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="submit">Save</a>
        </div>
      </form>
    </div>
  </div>
</div>