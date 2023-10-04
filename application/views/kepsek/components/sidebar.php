<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li class="nav-devider"></li>
				<li class="nav-small-cap">kepsek</li>
				<li> <a class="waves-effect waves-dark" href="<?= base_url('kepsek') ?>" aria-expanded="false"><i class="icon-Home"></i><span class="hide-menu">Beranda</span></a></li>
				<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="icon-Big-Data"></i><span class="hide-menu">Modul Data</span></a>
					<ul aria-expanded="false" class="collapse">
						
						<li><a href="<?= base_url('kepsek/guru') ?>">Guru</a></li>
						<li><a href="<?= base_url('kepsek/siswa') ?>">Murid</a></li>
						<li><a href="<?= base_url('kepsek/mata_pelajaran') ?>">Aspek Perkembangan</a></li>
						<li><a href="<?= base_url('kepsek/tahun_ajaran') ?>">Tahun Ajaran</a></li>
					</ul>
				</li>
				
				<li> <a class="waves-effect waves-dark" href="<?= base_url('kepsek/pengajaran') ?>" aria-expanded="false"><i class="icon-Address-Book2"></i><span class="hide-menu">Laporan Nilai</span></a></li>
				<li> <a class="waves-effect waves-dark" href="<?= base_url('kepsek/grafik') ?>" aria-expanded="false"><i class="fa fa-chart-line"></i><span class="hide-menu">Grafik</span></a></li>
				<!-- <li> <a class="waves-effect waves-dark" href="<?= base_url('kepsek/profil') ?>" aria-expanded="false"><i class="icon-User"></i><span class="hide-menu">Profil</span></a></li> -->
				<li> <a class="waves-effect waves-dark" href="<?= base_url('login/logout') ?>" aria-expanded="false"><i class="icon-Power-2"></i><span class="hide-menu">Keluar</span></a></li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
