<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li class="nav-devider"></li>
				<li class="nav-small-cap">Wali Murid</li>
				<li> <a class="waves-effect waves-dark" href="<?= base_url('orangtua') ?>" aria-expanded="false"><i class="icon-Home"></i><span class="hide-menu">Beranda</span></a></li>
				<li> <a class="waves-effect waves-dark" href="<?= base_url('orangtua/nilaianak/'.$cekUser['id']) ?>" aria-expanded="false"><i class="icon-Address-Book2"></i><span class="hide-menu">Nilai Anak</span></a></li>
				<li> <a class="waves-effect waves-dark" href="<?= base_url('orangtua/chatting') ?>" aria-expanded="false"><i class="icon-Email"></i><span class="hide-menu">Pesan</span></a></li>
				<li> <a class="waves-effect waves-dark" href="<?= base_url('orangtua/logout') ?>" aria-expanded="false"><i class="icon-Power-2"></i><span class="hide-menu">Keluar</span></a></li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
