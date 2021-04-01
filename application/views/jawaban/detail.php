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
			<div id="content" data-url="<?= base_url('jawaban') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('jawaban/export_detail/' . $jawaban->id_jawaban) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
							<a href="<?= base_url('jawaban') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('success') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php elseif ($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('error') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif ?>
					<div class="card shadow">
						<div class="card-header"><strong>Detail Survei - Jawaban <?= $jawaban->id_jawaban ?></strong></div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<table class="table table-borderless">
										<tr>
											<td><strong>ID Jawaban</strong></td>
											<td>:</td>
											<td><?= $jawaban->id_jawaban ?></td>
										</tr>
										<tr>
											<td><strong>ID Pertanyaan</strong></td>
											<td>:</td>
											<td><?= $jawaban->id_pertanyaan ?></td>
										</tr>
										<tr>
											<td><strong>Jawaban</strong></td>
											<td>:</td>
											<td><?= $jawaban->jawaban ?></td>
										</tr>
										<!-- <tr>
											<td><strong>Tanggal</strong></td>
											<td>:</td>
											<td><?= $jawaban->tanggal ?> - <?= $jawaban->tanggal ?></td>
										</tr> -->
									</table>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<td><strong>ID Survei</strong></td>
												<td><strong>ID Customer</strong></td>
												<td><strong>ID Pertanyaan</strong></td>
												<td><strong>ID Jawaban</strong></td>
												<td><strong>Tanggal</strong></td>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($all_survei as $data_survei) : ?>
												<tr>
													<td><?= $data_survei->id_survei ?></td>
													<td><?= $data_survei->id_customer ?></td>
													<td><?= $data_survei->id_pertanyaan ?></td>
													<td><?= $data_survei->id_jawaban ?></td>
													<td><?= $data_survei->tanggal ?> <?= strtoupper($data_survei->times) ?></td>

												</tr>
											<?php endforeach ?>
										</tbody>
										<!-- <tfoot>
										<tr>
											<td colspan="4" align="right"><strong>Total : </strong></td>
											<td>Rp <?= number_format($jawaban->total, 0, ',', '.') ?></td>
										</tr>
									</tfoot> -->
									</table>
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
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>

</html>