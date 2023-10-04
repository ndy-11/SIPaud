<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Input Nilai</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('guru') ?>">Guru</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('guru/pengajaran') ?>">Kelola Pengajaran</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('guru/nilai/' . $pengajaran_id) ?>">Detail Pengajaran</a></li>
				<li class="breadcrumb-item active">Input Nilai</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-lg-3">
							<h3>Nama Guru : <?= $pengajaran['nama'] ?></h3>
						</div>
						<div class="col-12 col-lg-3">
							<h3>Tahun Ajaran : <?= $pengajaran['tahun_ajaran'] ?></h3>
						</div>
						<div class="col-12 col-lg-3">
							<h3>Semester : <?= $pengajaran['semester'] ?></h3>
						</div>
						<div class="col-12 col-lg-3">
							<h3>Kelas : <?= $pengajaran['kelas'] ?></h3>
						</div>
					</div>
					<hr>
					<h3>Data Siswa</h3>
					<table class="table">
						<tbody>
							<tr>
								<td>Nama Siswa</td>
								<td>:</td>
								<td><?= $siswa['nm_siswa'] ?></td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td>:</td>
								<td><?= $siswa['jenis_kelamin'] ?></td>
							</tr>
							<tr>
								<td>Tanggal Lahir</td>
								<td>:</td>
								<td><?= $siswa['tanggal_lahir'] ?></td>
							</tr>
							<tr>
								<td>Nama Wali</td>
								<td>:</td>
								<td><?= $siswa['nama'] ?></td>
							</tr>
							<tr>
								<td>Tahun Masuk</td>
								<td>:</td>
								<td><?= $siswa['tahun_masuk'] ?></td>
							</tr>
						</tbody>
					</table>
					<hr>
					<button class="btn btn-primary mb-4" onclick="inputNilai()">Form Penilaian</button>
					<!-- <form class="mt-4" method="POST"> -->
						<?php foreach ($pengajaranMapelS as $pengajaranMapel) : ?>
							<?php
							$mapel = $pengajaranMapel['mapel_id'];
							$siswas = $siswa['id_siswa'];
							$query = "SELECT *
													FROM `tb_nilai`
													JOIN `tb_pengajaran` ON `tb_pengajaran`.`id_pengajaran` = `tb_nilai`.`pengajaran_id`
													JOIN `tb_data_siswa` ON `tb_data_siswa`.`id_siswa` = `tb_nilai`.`siswa_id`
													JOIN `tb_data_mata_pelajaran` ON `tb_data_mata_pelajaran`.`id_mapel` = `tb_nilai`.`mapel_id`
													WHERE `tb_nilai`.`pengajaran_id` = $pengajaran_id
													AND `tb_nilai`.`siswa_id` = $siswas
													AND `tb_nilai`.`mapel_id` = $mapel
													GROUP BY `tb_nilai`.`siswa_id`
												";
							$nilai = $this->db->query($query)->row_array();
							?>
							<!-- <input type="hidden" name="pengajaran_id" value="<?= $pengajaran_id ?>"> -->
							<?php @$id_mapelarray .= $pengajaranMapel['id_mapel'].','; ?>
							<div class="form-group">
								<label><?= $pengajaranMapel['mata_pelajaran'] ?></label>
								<input readonly type="text" name="<?= $pengajaranMapel['id_mapel'] ?>" class="form-control <?= form_error($pengajaranMapel['id_mapel']) ? 'is-invalid' : '' ?>" value="<?= set_value($pengajaranMapel['id_mapel'], isset($nilai['nilai']) ? $nilai['nilai'] : null) ?>">
								<div class="invalid-feedback"><?= form_error($pengajaranMapel['id_mapel']) ?></div>
							</div>
						<?php endforeach ?>
					<!-- </form> -->
					<input type="hidden" name="id_ta" value="<?= $pengajaran['id_ta'] ?>">
					<input type="hidden" name="id_mapel" value="<?= $id_mapelarray; ?>">
					<input type="hidden" name="id_siswa" value="<?= $siswa['id_siswa'] ?>">
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>

<!-- Modal -->
<div class="modal fade" id="modalInputNilai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Penilaian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('guru/proses_nilai') ?>" method='POST'>
      		<input type="hidden" name="idta" id="idta">
      		<input type="hidden" name="idsiswa" id="idsiswa">
      		<input type="hidden" name="idmapel" id="idmapel">
	      <div class="modal-body">

	        <div id="loadpenilaian"></div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
	    </form>
    </div>
  </div>
</div>

<script type="text/javascript">
	function inputNilai() {
		var id_ta = $('[name="id_ta"]').val();
		var id_siswa = $('[name="id_siswa"]').val();
		var string = $('[name="id_mapel"]').val();
		var id_mapel = string.replace(/,\s*$/, '');

		$('#modalInputNilai').modal('show');
	    $.ajax({
	      url : "<?= base_url('guru/get_penilaianbyid/'); ?>",
	      type: "POST",
	      data:{id_mapel,id_siswa},
	      // dataType: "JSON",
	      success: function(result)
	      {

	      	$('[name="idta"]').val(id_ta);
			$('[name="idsiswa"]').val(id_siswa);
			$('[name="idmapel"]').val(id_mapel);
	        $('#loadpenilaian').html(result);

	      },
	      error: function (jqXHR, textStatus, errorThrown)
	      {
	        alert('Error get data from ajax');
	      }
	    });

		// alert(id_ta +' - ' +id_siswa+ ' - ' + id_mapel);
	}
</script>
