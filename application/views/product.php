<div class="row">
  <?php
    foreach ($data_product as $value) {
      echo '<div class="col-md-3">
              <div class="card konten-product">
                <center><img src="'.base_url().$value->image_product.'" class="card-img-top img-prodct" alt="Image Product"></center>
                <div class="card-body">
                  <center>
                    <h5 class="card-title"><b>'.$value->nama_product.'</b></h5>
                    <p class="card-text"><b>Rp. '.number_format($value->harga_product,0,"",".").'</b></p>
                    <p class="card-text txt-deskripsi"><b>'.$value->deskripsi_product.'</b></p>
                    <button href="#" class="btn btn-light beli" data-produkid="'.$value->id_product.'">Beli</button>
                  </center>
                </div>
              </div>
            </div>';
    }
  ?>
</div>
<div class="modal fade" id="modal-beli">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="<?php echo base_url('product/order') ?>">
        <div class="modal-header">
          <h5 class="modal-title"><b>Input Data Anda</b></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" id="id_product" name="id_product">
          <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label class="form-label">No. WA</label>
            <input type="text" class="form-control" id="no_wa" name="no_wa" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" id="alamat" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-secondary">Beli</button>
        </div>
      </form>
    </div>
  </div>
</div>