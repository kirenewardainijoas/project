<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-laugh-wink"></i>
				</div>
				<div class="sidebar-brand-text mx-3" >SURVEI KEPUASAN PELANGGAN </div>
			</a>
			<hr class="sidebar-divider my-0">
			<li class="nav-item <?= $aktif == 'dashboard' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('dashboard') ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>
			<hr class="sidebar-divider">

			<!-- <div class="sidebar-heading">
				Master
			</div> -->

			<li class="nav-item <?= $aktif == 'pertanyaan' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('pertanyaan') ?>">
					<i class="fas fa-fw fa-box"></i>
					<span> Pertanyaan</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'customer' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('customer') ?>">
					<i class="fas fa-fw fa-cash-register"></i>
					<span> Customer</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider">
	
			<!-- <div class="sidebar-heading">
				Transaksi
			</div> -->

			<li class="nav-item <?= $aktif == 'jawaban' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('jawaban') ?>">
					<i class="fas fa-fw fa-file-invoice"></i>
					<span>Jawaban</span></a>
			</li>

			<hr class="sidebar-divider">
			<?php if ($this->session->login['role'] == 'user'): ?>
				<!-- Heading -->
				<div class="sidebar-heading">
					Pengaturan
				</div>

				<li class="nav-item <?= $aktif == 'user' ? 'active' : '' ?>">
					<a class="nav-link" href="<?= base_url('user') ?>">
						<i class="fas fa-fw fa-users"></i>
						<span>Manajemen Pengguna</span></a>
				</li>

				<!-- <li class="nav-item <?= $aktif == 'toko' ? 'active' : '' ?>">
					<a class="nav-link" href="<?= base_url('toko') ?>">
						<i class="fas fa-fw fa-building"></i>
						<span>Profil Toko</span></a>
				</li> -->
				<!-- Divider -->
				<hr class="sidebar-divider d-none d-md-block">
			<?php endif; ?>

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>