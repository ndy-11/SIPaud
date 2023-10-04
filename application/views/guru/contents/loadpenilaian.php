<h5>AGAMA DAN MORAL</h5>
<?php if (empty($data_am)) {
	echo '<p class="text-danger" >Mata Pelajaran ini tidak dipilih</p>';
}else{ ?>
<?php $no= 1; foreach ($data_am as $key => $dtam): ?>
<div class="form-group">
	<label><?= $no++ .'. '. $dtam->pertanyaan_penilaian; ?></label><br>
	<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" id="baik<?= $dtam->idp; ?>" name="idp<?= $dtam->idp; ?>" class="custom-control-input" value="100" required>
	  <label class="custom-control-label" for="baik<?= $dtam->idp; ?>">Baik</label>
	</div>
	<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" id="cukup<?= $dtam->idp; ?>" name="idp<?= $dtam->idp; ?>" class="custom-control-input" value="90" required>
	  <label class="custom-control-label" for="cukup<?= $dtam->idp; ?>">Cukup</label>
	</div>
	<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" id="perludilatih<?= $dtam->idp; ?>" name="idp<?= $dtam->idp; ?>" class="custom-control-input" value="80" required>
	  <label class="custom-control-label" for="perludilatih<?= $dtam->idp; ?>">Perlu Dilatih</label>
	</div>
</div>
<?php endforeach ?>
<?php } ?>
<h5>FISIK MOTORIK</h5>
<?php if (empty($data_fm)) {
	echo '<p class="text-danger" >Mata Pelajaran ini tidak dipilih</p>';
}else{ ?>
<?php $no= 1; foreach ($data_fm as $key => $dtfm): ?>
<div class="form-group">
	<label><?= $no++ .'. '. $dtfm->pertanyaan_penilaian; ?></label><br>
	<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" id="baik<?= $dtfm->idp; ?>" name="idp<?= $dtfm->idp; ?>" class="custom-control-input" value="100" required>
	  <label class="custom-control-label" for="baik<?= $dtfm->idp; ?>">Baik</label>
	</div>
	<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" id="cukup<?= $dtfm->idp; ?>" name="idp<?= $dtfm->idp; ?>" class="custom-control-input" value="90" required>
	  <label class="custom-control-label" for="cukup<?= $dtfm->idp; ?>">Cukup</label>
	</div>
	<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" id="perludilatih<?= $dtfm->idp; ?>" name="idp<?= $dtfm->idp; ?>" class="custom-control-input" value="80" required>
	  <label class="custom-control-label" for="perludilatih<?= $dtfm->idp; ?>">Perlu Dilatih</label>
	</div>
</div>
<?php endforeach ?>
<?php } ?>
<h5>KOGNITIF</h5>
<?php if (empty($data_k)) {
	echo '<p class="text-danger" >Mata Pelajaran ini tidak dipilih</p>';
}else{ ?>
<?php $no= 1; foreach ($data_k as $key => $dtk): ?>
<div class="form-group">
	<label><?= $no++ .'. '. $dtk->pertanyaan_penilaian; ?></label><br>
	<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" id="baik<?= $dtk->idp; ?>" name="idp<?= $dtk->idp; ?>" class="custom-control-input" value="100" required>
	  <label class="custom-control-label" for="baik<?= $dtk->idp; ?>">Baik</label>
	</div>
	<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" id="cukup<?= $dtk->idp; ?>" name="idp<?= $dtk->idp; ?>" class="custom-control-input" value="90" required>
	  <label class="custom-control-label" for="cukup<?= $dtk->idp; ?>">Cukup</label>
	</div>
	<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" id="perludilatih<?= $dtk->idp; ?>" name="idp<?= $dtk->idp; ?>" class="custom-control-input" value="80" required>
	  <label class="custom-control-label" for="perludilatih<?= $dtk->idp; ?>">Perlu Dilatih</label>
	</div>
</div>
<?php endforeach ?>
<?php } ?>
<h5>BAHASA</h5>
<?php if (empty($data_b)) {
	echo '<p class="text-danger" >Mata Pelajaran ini tidak dipilih</p>';
}else{ ?>
<?php $no= 1; foreach ($data_b as $key => $dtb): ?>
<div class="form-group">
	<label><?= $no++ .'. '. $dtb->pertanyaan_penilaian; ?></label><br>
	<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" id="baik<?= $dtb->idp; ?>" name="idp<?= $dtb->idp; ?>" class="custom-control-input" value="100" required>
	  <label class="custom-control-label" for="baik<?= $dtb->idp; ?>">Baik</label>
	</div>
	<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" id="cukup<?= $dtb->idp; ?>" name="idp<?= $dtb->idp; ?>" class="custom-control-input" value="90" required>
	  <label class="custom-control-label" for="cukup<?= $dtb->idp; ?>">Cukup</label>
	</div>
	<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" id="perludilatih<?= $dtb->idp; ?>" name="idp<?= $dtb->idp; ?>" class="custom-control-input" value="80" required>
	  <label class="custom-control-label" for="perludilatih<?= $dtb->idp; ?>">Perlu Dilatih</label>
	</div>
</div>
<?php endforeach ?>
<?php } ?>