<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Laporan</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">laporan</li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<!-- table responsive -->
			<div class="card ribbon-wrapper">
				<div class="ribbon ribbon-bookmark ribbon-default">Laporan</div>
				<div class="card-body">
					<form method="POST" action="<?= base_url('admin/lihat_laporan'); ?>">
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label>Tahun Ajaran</label>
									<select class="form-control" name="tahun_ajaran" required>
										<option value="" disabled selected>Pilih Tahun Ajaran</option>
										<?php foreach ($tahunAjaran as $key => $ta): ?>
											<option value="<?= $ta->id_ta; ?>"><?= $ta->tahun_ajaran.' (Semester '.$ta->semester.')'; ?></option>
										<?php endforeach ?>
									</select></div>
								</div>
								<div class="col-6">
								<div class="form-group">
									<label>Guru</label>
									<select class="form-control" name="id_guru" required>
										<option value="" disabled selected>Pilih Guru</option>
										<?php foreach ($dataGuru as $key => $dg): ?>
											<option value="<?= $dg->id; ?>"><?= $dg->nama; ?></option>
										<?php endforeach ?>
									</select></div>
								</div>
							</div>
								<button type="submit" class="btn btn-info">Submit</button>
						</div>
					</form>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
