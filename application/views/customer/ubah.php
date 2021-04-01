<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('customer') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('customer') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('customer/proses_ubah/' . $customer->id_customer) ?>" id="form-tambah" method="POST">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="id_customer"><strong>ID Customer</strong></label>
												<input type="text" name="id_customer" placeholder="Masukkan ID Customer" autocomplete="off" class="form-control" required value="<?= $customer->id_customer ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="nama"><strong>Nama Customer</strong></label>
												<input type="text" name="nama" placeholder="Masukkan Nama Customer" autocomplete="off" class="form-control" required value="<?= $customer->nama ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="alamat"><strong>Alamat</strong></label>
												<input type="text" name="alamat" placeholder="Masukkan Alamat" autocomplete="off" class="form-control" required value="<?= $customer->alamat ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="email"><strong>Email</strong></label>
												<input type="text" name="email" placeholder="Masukkan Email" autocomplete="off" class="form-control" required value="<?= $customer->email ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="password"><strong>Password</strong></label>
												<input type="text" name="password" placeholder="Masukkan Password" autocomplete="off" class="form-control" required value="<?= $customer->password ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="no_telp"><strong>No.Telephone</strong></label>
												<input type="text" name="no_telp" placeholder="Masukkan No.Telephone" autocomplete="off" class="form-control" required value="<?= $customer->no_telp ?>">
											</div>
										</div>
										<hr>
										<div class="form-group">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
											<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
</body>

</html>