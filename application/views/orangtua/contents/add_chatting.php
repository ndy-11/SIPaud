<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Chatting</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('guru') ?>">Guru</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('guru/chatting') ?>">Kelola Chatting</a></li>
				<li class="breadcrumb-item active">Buat Chatting</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Buat Chatting</h4>
					<h6 class="card-subtitle"> Data ini tidak akan bisa dihapus, maka dari itu perhatikan penulisan pada form. </h6>
					<hr>
					<form  method="POST" class="mt-4">
						
						<div class="form-group">
							<label>Orang Tua</label>
							<select class="form-control <?= form_error('id') ? 'is-invalid' : '' ?>" name="id" readonly>
								
									<?php foreach($user as $u){ ?>
										<option <?php if($u['id'] == $_SESSION['id']){echo "selected='selected'";} ?> value="<?php echo $u['id'] ?>"><?php echo $u['nama']; ?></option>
									<?php } ?>
							</select>
							<div class="invalid-feedback"><?= form_error('id') ?></div>
						</div>
						<div class="form-group">
							<label>Subjek</label>
							<input type="text" class="form-control" name="subjek">
						</div>
						<div class="form-group">
							<label>Isi Pesan</label>
							<textarea class="form-control" name="isi_pesan" rows="5"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>
