<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Detail Aspek Peekembangan</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">Detail Kelola Aspek Perkembangan</li>
			</ol>
		</div>
		<!-- <div class="col-md-7 align-self-center text-right d-none d-md-block">
			<a href="<?= base_url('admin/add_mata_pelajaran') ?>" class="btn btn-info">
				Buat Baru
			</a>
		</div> -->
	</div>
	<div class="row">
		<div class="col-12">
			<!-- table responsive -->
			<div class="card ribbon-wrapper">
				<div class="ribbon ribbon-bookmark ribbon-default">Detail Aspek Perkembangan</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="all-table" data-all="all" class="table display table-bordered table-striped no-wrap">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Mata Pelajaran</th>
									<th>Mata Pelajaran</th>
									<th>Sub Mata Pelajaran</th>
									<th>Pertanyaan</th>
									<!-- <th></th> -->
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($aspek_pekembangan as $ap) : ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $ap->kode_mapel; ?></td>
										<td><?= $ap->mata_pelajaran; ?></td>
										<td><?= $ap->sub_mapel; ?></td>
										<td><?= $ap->pertanyaan_penilaian; ?></td>
										<!-- <td><a href="<?= base_url('admin/lihat_detail_aspek/') ?>" class="btn btn-secondary btn-sm">Lihat Detail</a></td>
										<td><a href="<?= base_url('admin/update_mata_pelajaran/') ?>" class="btn btn-secondary btn-sm">Ubah</a></td> -->
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
