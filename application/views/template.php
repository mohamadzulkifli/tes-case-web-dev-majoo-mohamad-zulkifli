<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Majoo Teknologi Indonesia</title>
  	<style type="text/css">
  		.navbar-default {
  			background-color: #333333;
  			border-color: #E7E7E7;
  		}
  		.navbar-default .navbar-brand {
  			color: #ffffff;
  		}
  		.navbar-default .navbar-brand:hover,
  		.navbar-default .navbar-brand:focus {
  			color: #e0e0e0;
  		}
  		.navbar-default .navbar-nav > li > a {
  			color: #777;
  		}
  		.navbar-default .navbar-nav > li > a:hover,
  		.navbar-default .navbar-nav > li > a:focus {
  			color: #333;
  		}
  		.navbar-default .navbar-nav > .active > a,
  		.navbar-default .navbar-nav > .active > a:hover,
  		.navbar-default .navbar-nav > .active > a:focus {
  			color: #555;
  			background-color: #E7E7E7;
  		}
  		.navbar-default .navbar-nav > .open > a,
  		.navbar-default .navbar-nav > .open > a:hover,
  		.navbar-default .navbar-nav > .open > a:focus {
  			color: #555;
  			background-color: #D5D5D5;
  		}
  		.navbar-default .navbar-nav > .dropdown > a .caret {
  			border-top-color: #777;
  			border-bottom-color: #777;
  		}
  		.navbar-default .navbar-nav > .dropdown > a:hover .caret,
  		.navbar-default .navbar-nav > .dropdown > a:focus .caret {
  			border-top-color: #333;
  			border-bottom-color: #333;
  		}
  		.navbar-default .navbar-nav > .open > a .caret,
  		.navbar-default .navbar-nav > .open > a:hover .caret,
  		.navbar-default .navbar-nav > .open > a:focus .caret {
  			border-top-color: #555;
  			border-bottom-color: #555;
  		}
  		.navbar-default .navbar-toggle {
  			border-color: #DDD;
  		}
  		.navbar-default .navbar-toggle:hover,
  		.navbar-default .navbar-toggle:focus {
  			background-color: #DDD;
  		}
  		.navbar-default .navbar-toggle .icon-bar {
  			background-color: #CCC;
  		}
  		@media (max-width: 767px) {
  			.navbar-default .navbar-nav .open .dropdown-menu > li > a {
  				color: #777;
  			}
  			.navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
  			.navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
  				color: #333;
  			}
  		}
	  	.product{
	  		margin-top: 3%;
	  	}
	  	.konten-product{ 
	  		margin-bottom:10%;
	  	}
	  	.txt-deskripsi{
	  		height:250px;
	  	}
	  	.beli{
	  		margin-top: 10%;
	  	}
	  	footer{
	  		margin-top: 1%;
	  		border-top: 3px solid #333333;
	  	}
	  	.text-footer{
	  		text-align: center;
	  		padding : 10px;
	  	}
	  	.btn-light{
	  		border: 1px solid #333333;
	  	}
	  	.img-prodct{
	  		width: 296 px;
	  		height: 180px;
	  	}
  	</style>
  </head>
  <body>
  	<nav class="navbar navbar-expand-lg navbar-default">
  		<div class="container-fluid">
  		<a class="navbar-brand" href="<?php echo base_url() ?>">Majoo Teknologi Indonesia</a>
  		</div>
  	</nav>
  	<div class="container-fluid product">
  		<?php $this->load->view($template); ?>
  	</div>
  	<footer>
  		<p class="text-footer">2019 &copy; PT. Majoo Teknologi Indonesia</p>
  	</footer>
  	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
	        $('.beli').click(function(){
	            var produk_id    = $(this).data("produkid");
	            $('#id_product').val(produk_id);
	            $('#modal-beli').modal('show');
	        });
	    });
    </script>
  </body>
</html>