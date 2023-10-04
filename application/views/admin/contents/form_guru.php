<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Guru</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('admin/guru') ?>">Kelola Guru</a></li>
				<li class="breadcrumb-item active">Buat/Ubah Guru</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Buat Data Guru</h4>
					<h6 class="card-subtitle"> Data ini tidak akan bisa dihapus, maka dari itu perhatikan penulisan pada form. </h6>
					<hr>
					<form class="mt-4" method="POST" action="<?= base_url('admin/save_guru'); ?>">
						<div class="form-group">
							<label>Nama</label>
							<input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" name="nama">
							<div class="invalid-feedback"><?= form_error('nama') ?></div>
						</div>
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<select class="form-control <?= form_error('jenis_kelamin') ? 'is-invalid' : '' ?>" name="jenis_kelamin">
								<option value="">Pilih Jenis Kelamin</option>
								<option value="Laki-laki">Laki-laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
							<div class="invalid-feedback"><?= form_error('jenis_kelamin') ?></div>
						</div>
						<div class="form-group">
							<label>Tanggal Lahir</label>
							<input type="date" class="form-control <?= form_error('tanggal_lahir') ? 'is-invalid' : '' ?>" name="tanggal_lahir">
							<div class="invalid-feedback"><?= form_error('tanggal_lahir') ?></div>
						</div>
						<div class="form-group">
							<label>Agama</label>
							<input type="text" class="form-control <?= form_error('agama') ? 'is-invalid' : '' ?>" name="agama">
							<div class="invalid-feedback"><?= form_error('agama') ?></div>
						</div>
						<div class="form-group">
							<label>No HP</label>
							<input type="text" class="form-control <?= form_error('no_hp') ? 'is-invalid' : '' ?>" name="no_hp">
							<div class="invalid-feedback"><?= form_error('no_hp') ?></div>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input type="text" class="form-control <?= form_error('alamat') ? 'is-invalid' : '' ?>" name="alamat">
							<div class="invalid-feedback"><?= form_error('alamat') ?></div>
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
							<label>NIP</label>
							<input type="text" class="form-control <?= form_error('nip') ? 'is-invalid' : '' ?>" name="nip">
							<div class="invalid-feedback"><?= form_error('nip') ?></div>
						</div>
						<div class="form-group">
							<label>Pendidikan Terakhir</label>
							<input type="text" class="form-control <?= form_error('pendidikan_terakhir') ? 'is-invalid' : '' ?>" name="pendidikan_terakhir">
							<div class="invalid-feedback"><?= form_error('pendidikan_terakhir') ?></div>
						</div>
						
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>
