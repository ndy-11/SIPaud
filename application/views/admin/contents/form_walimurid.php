<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Wali Murid</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('admin/walimurid') ?>">Kelola Wali Murid</a></li>
				<li class="breadcrumb-item active">Buat/Ubah Wali Murid</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Buat Data Wali Murid</h4>
					<h6 class="card-subtitle"> Data ini tidak akan bisa dihapus, maka dari itu perhatikan penulisan pada form. </h6>
					<hr>
					<form class="mt-4" method="POST">
						<div class="form-group">
							<label>Nama Wali</label>
							<input type="text" class="form-control <?= form_error('nama_wali') ? 'is-invalid' : '' ?>" name="nama_wali">
							<div class="invalid-feedback"><?= form_error('nama_wali') ?></div>
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control <?= form_error('username') ? 'is-invalid' : '' ?>" name="username">
							<div class="invalid-feedback"><?= form_error('username') ?></div>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>" name="password">
							<div class="invalid-feedback"><?= form_error('password') ?></div>
						</div>
						<div class="form-group">
							<label>Email wali</label>
							<input type="text" class="form-control <?= form_error('email_wali') ? 'is-invalid' : '' ?>" name="email_wali">
							<div class="invalid-feedback"><?= form_error('email_wali') ?></div>
						</div>
						<div class="form-group">
							<label>Nomor Handphone</label>
							<input type="number" class="form-control <?= form_error('nmr_hp') ? 'is-invalid' : '' ?>" name="no_hp">
							<div class="invalid-feedback"><?= form_error('nmr_hp') ?></div>
						</div>
						<div class="form-group">
							<label>Murid</label>
							<select class="form-control <?= form_error('murid') ? 'is-invalid' : '' ?>" name="murid" required>
								<option value="">Pilih murid</option>
								<?php foreach ($datamurid as $key => $value): ?>
								<option value="<?= $value->id_siswa; ?>"><?= $value->nama; ?></option>
								<?php endforeach ?>
							</select>
							<div class="invalid-feedback"><?= form_error('jk') ?></div>
						</div>
						
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>
