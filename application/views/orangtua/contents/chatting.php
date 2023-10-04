<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Kelola Pesan Masuk</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('orangtua') ?>">OrangTua</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('orangtua/chatting') ?>">Kelola Pesan Masuk</a></li>
				<li class="breadcrumb-item active">Kelola Pesan Masuk</li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<!-- table responsive -->
			<div class="card ribbon-wrapper">
				<div class="ribbon ribbon-bookmark ribbon-default">Kelola Data Pesan Masuk Anda</div>
				<div class="card-body">
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
					<div class="row">
						<div class="col-12 col-lg-12">
							<a href="<?php echo base_url().'orangtua/balas_chatting'; ?>"><button class="btn btn-info" style="margin-left: 30px;"><i class="fa fa-plus"></i> Mulai Chat</button></a>
							 <a href="<?php echo base_url().'orangtua/out_chatting'; ?>"><button class="btn btn-warning" style="margin-left: 30px;"><i class="fa fa-plus"></i> History Pesan Keluar</button></a> 
							<hr>
							<div class="table-responsive">
								<table id="all-table" class="table display table-bordered table-striped no-wrap">
									<thead>
										<tr>
											<th>No</th>
											<th>Kepada</th>
											<th>Tanggal Pesan</th>
											<th>Subjek Pesan</th>
											<th>Isi Pesan</th>
											<th style="text-align:center"></th>
										</tr>
									</thead>
									<tbody>
										<?php if (empty($chatting)) : ?>
											<tr id="alert-data">
												<td colspan="6">
													<div class="alert alert-danger" role="alert">
														Belum ada data chatting
													</div>
												</td>
											</tr>
										<?php else : ?>
											<?php $no = 1;
											foreach ($chatting as $c) : ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $c['nama'] ?></td>
													<td><?= $c['tgl_pesan'] ?></td>
													<td><?= $c['subjek'] ?></td>
													<td><?= $c['isi_pesan'] ?></td>
													<td><a href="<?php echo base_url().'orangtua/balas_chatting/'.$c['id']; ?>"><button class="btn btn-success" style="margin-left: 30px;"><i class="fa fa-comment"></i> Balas Pesan</button></a></td>
												</tr>
											<?php endforeach ?>
										<?php endif ?>
									</tbody>
								</table>
							</div>
						</div>
						
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
			"columnDefs": [{
				"targets": [-1],
				"orderable": false
			}]
		})
		$('#my-table').DataTable({
			"autoWidth": false,
			"responsive": true,
			"columnDefs": [{
				"targets": [-1],
				"orderable": false
			}]
		})
	});
</script>
