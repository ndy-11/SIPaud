<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Pengajaran</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('admin/siswa') ?>">Kelola Pengajaran</a></li>
				<li class="breadcrumb-item active">Buat/Ubah Data</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Buat Data</h4>
					<h6 class="card-subtitle"> Data ini tidak akan bisa dihapus, maka dari itu perhatikan penulisan pada form. </h6>
					<hr>
					<form class="mt-4" method="POST" action="<?= base_url('admin/save_pengajaran'); ?>">
						<div class="form-group">
							<label>Nama Guru</label>
							<select class="form-control" name="guru_id">
								<option value="">Pilih Guru</option>
								<?php foreach ($dataguru as $key => $value): ?>
									<option value="<?= $value->id; ?>"><?= $value->nama; ?></option>
								<?php endforeach ?>
							</select>
							<div class="invalid-feedback"><?= form_error('id_guru') ?></div>
						</div>
						<div class="form-group">
							<label>Tahun Ajaran</label>
							<select class="form-control" name="ta_id">
								<option value="">Pilih </option>
								<?php foreach ($datata as $key => $value): ?>
									<option value="<?= $value->id_ta; ?>"><?= $value->tahun_ajaran; ?>/<?= $value->semester; ?></option>
								<?php endforeach ?>
							</select>
							<div class="invalid-feedback"><?= form_error('id_ortu') ?></div>
						</div>
						<div class="form-group">
							<label>Kelas</label>
							<input type="text" class="form-control" name="kelas">
							<div class="invalid-feedback"><?= form_error('nilai') ?></div>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>
