<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
	<div class="row">
		<div class="col text-center">
			<h3 class="h3 text-dark"><?= $title ?></h3>
			<!-- <h4 class="h4 text-dark "><strong><?= $perusahaan->nama_perusahaan ?></strong></h4> -->
		</div>
	</div>
	<hr>
	<!-- <div class="row">
		<div class="col-md-4">
			<table class="table table-borderless">
				<tr>
					<td><strong>ID Customer</strong></td>
					<td>:</td>
					<td><?= $data_survei->id_customer?></td>
				</tr>
				<tr>
					<td><strong>Tanggal</strong></td>
					<td>:</td>
					<td><?= $data_survei->tanggal ?> - <?= $data_survei->jam_masuk ?></td>
				</tr>
			</table>
		</div>
	</div> -->
	<hr>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<td><strong>ID Survei</strong></td>
						<td><strong>ID Customer </strong></td>
						<td><strong>ID Pertanyaan</strong></td>
						<td><strong>ID Jawaban</strong></td>
						<!-- <td><strong>Tanggal</strong></td> -->
					</tr>
				</thead>
				<tbody>
					<?php foreach ($all_survei as $data_survei): ?>
						<tr>
							<td><?= $data_survei->id_survei ?></td>
							<td><?= $data_survei->id_customer ?></td>
							<td><?= $data_survei->id_pertanyaan?></td>
							<td><?= $data_survei->id_jawaban ?></td>
							<!-- <td>Rp <?= number_format($data_survei->sub_total, 0, ',', '.') ?></td> -->
						</tr>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" align="right"><strong>Total : </strong></td>
						<td>Rp <?= number_format($jawaban->total, 0, ',', '.') ?></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</body>
</html>