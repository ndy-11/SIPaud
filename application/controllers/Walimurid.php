<?php
defined('BASEPATH') or exit('No direct script access allowed');
// memanggil autoload library phpoffice
require('./application/third_party/phpoffice/vendor/autoload.php');

// Memanggil namespace class yang berada di library phpoffice
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Walimurid extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Load Model
		// Parameter pertama load file model, Parameter kedua adalah nama alias dari model parameter pertama
		$this->load->model('Walimurid_model', 'wali_m');
		$this->load->model('Pengajaran_model', 'pengajaran_m');
		$this->load->model('Chatting_model', 'chatting_m');
		if($this->session->userdata('status')!="telah_login"){
			redirect(base_url().'login_guru?alert=belum_login');
		}
	}
	public function index()
	{
		$data = [
			'judul' => 'Wali Murid | Home',
			'viewUtama' => 'walimurid/contents/index',
			'cekUser' => $this->db->get_where('tb_walimurid', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
		];
		$this->load->view('walimurid/layouts/wrapperIndex', $data);
	}
	public function profil()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[25]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required|numeric|max_length[20]');
		$this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan', 'required|max_length[25]');
		$this->form_validation->set_rules('agama', 'Agama', 'required|max_length[25]');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|numeric|max_length[13]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'min_length[5]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman profil
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Guru | Tambah Pengajaran',
				'viewUtama' => 'guru/contents/profil',
				'cekUser' => $this->db->get_where('tb_guru', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('guru/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->guru_m->ubahProfil();
			$this->session->set_flashdata('success', 'Profil berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('guru/profil'); // redirect ke halaman profil
		}
	}
	
	// public function nilaianak($pengajaran_id = 1)
	// {
	// 	$data = [
	// 		'judul' => 'Nilai Anak',
	// 		'viewUtama' => 'walimurid/contents/lihat_nilai',
	// 		'cekUser' => $this->db->get_where('tb_walimurid', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
	// 		'pengajaran' => $this->pengajaran_m->getPengajaran($pengajaran_id)->row_array(),
	// 		'pengajaranMapelS' => $this->pengajaran_m->getPengajaranMapel($pengajaran_id),
	// 		'pengajaranSiswaS' => $this->pengajaran_m->getPengajaranSiswa($pengajaran_id),
	// 		'lihat_nilai' => $this->pengajaran_m->lihatNilai($pengajaran_id),
	// 		'pengajaran_id' => $pengajaran_id
	// 	];
	// 	$this->load->view('walimurid/layouts/wrapperData', $data);
	// }
	public function grafik()
	{
		$username = $this->session->userdata('username');
		$data = [
			'judul' => 'Grafik Nilai',
			'viewUtama' => 'walimurid/contents/grafik',
			'cekUser' => $this->db->get_where('tb_walimurid', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'datagrafik' => $this->db->query("select b.nama,d.mata_pelajaran,c.nilai from tb_walimurid a inner join tb_data_siswa b on b.id_siswa = a.id_siswa left join tb_nilai c on c.siswa_id = b.id_siswa left join tb_data_mata_pelajaran d on d.id_mapel = c.mapel_id where username = '$username' ")->result()
		];
		$this->load->view('walimurid/layouts/wrapperData', $data);
	}
	public function excel($pengajaran_id)
	{
		$pengajaran =  $this->pengajaran_m->getPengajaran($pengajaran_id)->row_array();
		$pengajaranMapelS = $this->pengajaran_m->getPengajaranMapel($pengajaran_id);
		$pengajaranSiswaS = $this->pengajaran_m->getPengajaranSiswa($pengajaran_id);
		// Ini Instance untuk export Excel
		$excel = new Spreadsheet();

		$excel->getProperties()->setCreator('Muhammad Alfansa Yazib')
			->setLastModifiedBy('Muhammad Alfansa Yazib')
			->setTitle('PAUD FLAMBOYAN')
			->setSubject("DAFTAR HASIL TES BELAJAR PAUD FLAMBOYAN")
			->setCategory("Daftar Nilai");

		$excel->setActiveSheetIndex(0)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'Nama Murid');

		$no = 67;
		foreach ($pengajaranMapelS as $pengajaranMapel) {
			$excel->setActiveSheetIndex(0)
				->setCellValue(chr($no++) . '1', $pengajaranMapel['mata_pelajaran']);
		}
		$excel->setActiveSheetIndex(0)
			->setCellValue(chr($no++) . '1', 'Jumlah')
			->setCellValue(chr($no++) . '1', 'Nilai');
		$column = 2;
		$urutan = 1;
		$noB = 67;
		if (is_array($pengajaranSiswaS)) {
			foreach ($pengajaranSiswaS as $pengajaranSiswa) {
				$siswa = $pengajaranSiswa['siswa_id'];
				$excel->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $urutan++)
					->setCellValue('B' . $column, $pengajaranSiswa['nama']);
				foreach ($pengajaranMapelS as $pengajaranMapel) {
					$mapel = $pengajaranMapel['mapel_id'];
					$query = "SELECT *
								FROM `tb_nilai`
								JOIN `tb_pengajaran` ON `tb_pengajaran`.`id_pengajaran` = `tb_nilai`.`pengajaran_id`
								JOIN `tb_data_siswa` ON `tb_data_siswa`.`id_siswa` = `tb_nilai`.`siswa_id`
								JOIN `tb_data_mata_pelajaran` ON `tb_data_mata_pelajaran`.`id_mapel` = `tb_nilai`.`mapel_id`
								WHERE `tb_nilai`.`pengajaran_id` = $pengajaran_id
								AND `tb_nilai`.`siswa_id` = $siswa
								AND `tb_nilai`.`mapel_id` = $mapel
								GROUP BY `tb_nilai`.`siswa_id`
							";
					$nilai = $this->db->query($query)->row_array();
					$excel->setActiveSheetIndex(0)
						->setCellValue(chr($noB++) . $column, $nilai['nilai']);
				}
				$queryAs = "SELECT *,SUM(nilai) as jumlah, AVG(nilai) as total
								FROM `tb_nilai`
								JOIN `tb_pengajaran` ON `tb_pengajaran`.`id_pengajaran` = `tb_nilai`.`pengajaran_id`
								JOIN `tb_data_siswa` ON `tb_data_siswa`.`id_siswa` = `tb_nilai`.`siswa_id`
								JOIN `tb_data_mata_pelajaran` ON `tb_data_mata_pelajaran`.`id_mapel` = `tb_nilai`.`mapel_id`
								WHERE `tb_nilai`.`pengajaran_id` = $pengajaran_id
								AND `tb_nilai`.`siswa_id` = $siswa
								GROUP BY `tb_nilai`.`siswa_id`
							";
				$cariTotal = $this->db->query($queryAs)->row_array();
				$excel->setActiveSheetIndex(0)
					->setCellValue(chr($noB++) . $column, $cariTotal['jumlah'])
					->setCellValue(chr($noB++) . $column, round($cariTotal['total'], 1));
				$noB = 67;
				$column++;
			}

			$excel->setActiveSheetIndex(0)
				->setCellValue('A' . $column, 'Jumlah');
			foreach ($pengajaranMapelS as $pengajaranMapel) {
				$mapel = $pengajaranMapel['mapel_id'];
				$queryJml = "SELECT *,SUM(nilai) as jumlah
							FROM `tb_nilai`
							JOIN `tb_pengajaran` ON `tb_pengajaran`.`id_pengajaran` = `tb_nilai`.`pengajaran_id`
							JOIN `tb_data_mata_pelajaran` ON `tb_data_mata_pelajaran`.`id_mapel` = `tb_nilai`.`mapel_id`
							WHERE `tb_nilai`.`pengajaran_id` = $pengajaran_id
							AND `tb_nilai`.`mapel_id` = $mapel
							GROUP BY `tb_nilai`.`mapel_id`
					";
				$cariS = $this->db->query($queryJml)->result_array();
				foreach ($cariS as $cari) {
					$excel->setActiveSheetIndex(0)
						->setCellValue(chr($noB++) . $column, $cari['jumlah']);
				}
			}
			$noB = 67;
			$excel->setActiveSheetIndex(0)
				->setCellValue('A' . ($column + 1), 'Rata-Rata Kelas');
			foreach ($pengajaranMapelS as $pengajaranMapel) {
				$mapel = $pengajaranMapel['mapel_id'];
				$queryJml = "SELECT *,AVG(nilai) as rata
							FROM `tb_nilai`
							JOIN `tb_pengajaran` ON `tb_pengajaran`.`id_pengajaran` = `tb_nilai`.`pengajaran_id`
							JOIN `tb_data_mata_pelajaran` ON `tb_data_mata_pelajaran`.`id_mapel` = `tb_nilai`.`mapel_id`
							WHERE `tb_nilai`.`pengajaran_id` = $pengajaran_id
							AND `tb_nilai`.`mapel_id` = $mapel
							GROUP BY `tb_nilai`.`mapel_id`
					";
				$cariR = $this->db->query($queryJml)->result_array();
				foreach ($cariR as $cari) {
					$excel->setActiveSheetIndex(0)
						->setCellValue(chr($noB++) . ($column + 1), round($cari['rata'], 1));
				}
			}
			$noB = 67;
			$excel->setActiveSheetIndex(0)
				->setCellValue('A' . ($column + 3), 'DAFTAR HASIL TES BELAJAR DINIYYAH TARBIYYATUL FALAH TUGU');
			$excel->setActiveSheetIndex(0)
				->setCellValue('A' . ($column + 4), 'SEMESTER ' . $pengajaran['semester'] . ' TAHUN AJARAN ' . $pengajaran['tahun_ajaran']);
			$excel->setActiveSheetIndex(0)
				->setCellValue('A' . ($column + 5), 'KELAS ' . $pengajaran['kelas']);
		}
		$writer = new Xlsx($excel);
		$fileName = bin2hex(random_bytes(12));

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
		exit;
	}
	public function chatting()
	{
		$data = [
			'judul' => 'Guru | chatting',
			'viewUtama' => 'guru/contents/chatting',
			'cekUser' => $this->db->get_where('tb_guru', ['username' => $this->session->userdata('username')])->row_array(), 
			// cek user yang login berdasarkan session username,
			'chatting' => $this->db->query("select * from tb_pesan,tb_autentikasi,tb_guru where tb_pesan.id=tb_autentikasi.id and tb_pesan.id_guru=tb_guru.id_guru and tb_pesan.id_guru='$_SESSION[id_guru]' and tb_pesan.status_pesan='masuk' ")->result_array()

		];
		$this->load->view('guru/layouts/wrapperData', $data);
	}
	public function balas_chatting()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('isi_pesan','isi_pesan','required');
		$this->form_validation->set_rules('subjek','subjek','required');
		$this->form_validation->set_rules('id','id','required');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman chatting
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Guru',
				'viewUtama' => 'guru/contents/add_chatting',
				'cekUser' => $this->db->get_where('tb_guru', ['username' => $this->session->userdata('username')])->row_array(),
				'user' => $this->db->query("select * from tb_guru where role='orangtua' ")->result_array()
			];
			$this->load->view('guru/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->chatting_m->simpanChat(); // Insert data chatting
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('guru/chatting'); // redirect ke halaman chatting
		}
	}
	public function out_chatting()
	{
		$data = [
			'judul' => 'Guru | chatting',
			'viewUtama' => 'guru/contents/out_chatting',
			'cekUser' => $this->db->get_where('tb_guru', ['username' => $this->session->userdata('username')])->row_array(), 
			// cek user yang login berdasarkan session username,
			'chatting' => $this->db->query("select * from tb_pesan,tb_autentikasi,tb_guru where tb_pesan.id=tb_autentikasi.id and tb_pesan.id_guru=tb_guru.id_guru and tb_pesan.id_guru='$_SESSION[id_guru]' and tb_pesan.status_pesan='keluar' ")->result_array()

		];
		$this->load->view('guru/layouts/wrapperData', $data);
	}
	public function keluar()
	{
		$this->session->sess_destroy();
		redirect('log_guru?alert=logout');
	}
}
