<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<p>Pembelian telah berhasil dilakukan, tunggu tim kami akan segera menghubungi anda untuk melakukan proses pembayaran dan pengiriman product. Berikut ini adalah order detil Anda:</p>
				<table class="table table-bordered">
			        <thead>
			          <tr>
			            <th scope="col">TANGGAL</th>
			            <th scope="col">NAMA</th>
			            <th scope="col">EMAIL</th>
			            <th scope="col">NO. WA</th>
			            <th scope="col">ALAMAT</th>
			          </tr>
			        </thead>
			        <tbody>
			        	<tr>
			        		<td><?php echo $data_order_detil->created_at ?></td>
			        		<td><?php echo $data_order_detil->nama ?></td>
			        		<td><?php echo $data_order_detil->email ?></td>
			        		<td><?php echo $data_order_detil->no_wa ?></td>
			        		<td><?php echo $data_order_detil->alamat ?></td>
			        	</tr>
			        </tbody>
			    </table>
			    <br>
			    <div class="row">
			    	<div class="col-md-3">
			    		<center>
			    		<img src="<?php echo base_url().$data_order_detil->image_product ?>">
			    		</center>
			    	</div>
			    	<div class="col-md-9">
			    		<h3><b><?php echo $data_order_detil->nama_product ?></b></h3>
			    		<p>Rp. <?php echo number_format($data_order_detil->harga_product,0,"",".")?></p>
			    		<p><?php echo $data_order_detil->deskripsi_product ?></p>
			    	</div>
			    </div>
			</div>
		</div>
	</div>
</div>