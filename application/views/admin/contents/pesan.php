<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Pesan</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">Kelola Pesan</li>
			</ol>
		</div>
		<!-- <div class="col-md-7 align-self-center text-right d-none d-md-block">
			<a href="<?= base_url('admin/add_siswa') ?>" class="btn btn-info">
				Buat Baru
			</a>
		</div> -->
	</div>
	<div class="row">
		<div class="col-12">
			<!-- table responsive -->
			<div class="card ribbon-wrapper">
				<div class="ribbon ribbon-bookmark ribbon-default">Data Siswa</div>
				<div class="card-body">
					<div class="table-responsive">
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
						<?php endif; ?>
						<table id="all-table" data-all="all" class="table display table-bordered table-striped no-wrap">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal Pesan</th>
									<th>Subjek</th>
									<th>Isi Pesan</th>
									<th>Nama</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($dataPesan as $pesan) : ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $pesan['tgl_pesan'] ?></td>
										<td><?= $pesan['subjek'] ?></td>
										<td><?= $pesan['isi_pesan'] ?></td>
										<td><?= $pesan['nama'] ?></td>
										<!-- <td><a href="<?= base_url('admin/update_siswa/' . $siswa['id_siswa']) ?>" class="btn btn-secondary btn-sm">Ubah</a></td> -->
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/jquery/jquery.min.js"></script>
<script>
	$(function() {
		$('#all-table').DataTable({
			"autoWidth": false,
			"responsive": true,
		})
	});
</script>
