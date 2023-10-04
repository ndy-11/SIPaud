<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Nilai Anak</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('guru') ?>">Guru</a></li>
				<li class="breadcrumb-item active">Nilai Anak</li>
			</ol>
		</div>
		<div class="col-md-7 align-self-center text-right d-none d-md-block">
			<!-- <a href="<?= base_url('guru/add_pengajaran') ?>" class="btn btn-info">
				Buat Pengajaran
			</a> -->
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<!-- table responsive -->
			<div class="card ribbon-wrapper">
				<div class="ribbon ribbon-bookmark ribbon-default">Data Nilai Anak</div>
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
									<th>Nama Wali</th>
									<th>Nama Siswa</th>
									<th>Aspek Perkembangan</th>
									<th>Nilai</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($nilai as $n) : ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $n['nama'] ?></td>
										<td><?= $n['nm_siswa'] ?></td>
										<td><?= $n['mata_pelajaran'] ?></td>
										<td><?= $n['nilai'] ?></td>
										
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-body">
					<div class="col-lg-12">
                        <div class="panel panel-border panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Data Perkembangan Anak</h3> 
                            </div>
                            <div class="panel-body">
                                <canvas id="myChart4" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"> </canvas> 
                            </div>
                        </div>
                    </div>
				</div>
			</div>

		</div>

	</div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript">
    var ctx = document.getElementById('myChart4').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php foreach ($datagrafik as $key => $dg) {
        	echo '"'.$dg->mata_pelajaran.'",';
        } ?>],
        datasets: [{
            label: 'Nilai',
            backgroundColor     : [
      'rgb(255, 99, 132)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(201, 203, 207)',
      'rgb(54, 162, 235)'
    ],
              borderColor         : 'rgba(60,141,188,0.8)',
              pointRadius          : false,
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [<?php foreach ($datagrafik as $key => $dg) {
        	echo $dg->nilai.',';
        } ?>]
        }]
    },
});
 
  </script>
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
	<script type="text/javascript" src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/chartjs/Chart.js"></script>
