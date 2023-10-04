<?php
defined('BASEPATH') or exit('No direct script access allowed');
// memanggil autoload library phpoffice
require('./application/third_party/phpoffice/vendor/autoload.php');

// Memanggil namespace class yang berada di library phpoffice
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kepsek extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Load Model
		// Parameter pertama load file model, Parameter kedua adalah nama alias dari model parameter pertama
		$this->load->model('Guru_model', 'guru_m');
		$this->load->model('Walimurid_model', 'wali_m');
		$this->load->model('Siswa_model', 'siswa_m');
		$this->load->model('MataPelajaran_model', 'mapel_m');
		$this->load->model('M_data', 'm_data');
		$this->load->model('TahunAjaran_model', 'ta_m');
		$this->load->model('Pengajaran_model', 'pengajaran_m');
		is_logged_not_in(); // Jika sudah login, lalu mengakses halaman login maka tidak akan bisa dan akan d alihkan ke halaman kepsek
	}
	public function index()
	{
		$data = [
			'judul' => 'kepsek | Home',
			'viewUtama' => 'kepsek/contents/index',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
		];
		$this->load->view('kepsek/layouts/wrapperIndex', $data);
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
				'judul' => 'kepsek | Tambah Pengajaran',
				'viewUtama' => 'kepsek/contents/profil',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('kepsek/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->guru_m->ubahProfil();
			$this->session->set_flashdata('success', 'Profil berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('kepsek/profil'); // redirect ke halaman profil
		}
	}
	public function guru()
	{
		$data = [
			'judul' => 'kepsek | Kelola Guru',
			'viewUtama' => 'kepsek/contents/guru',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'guruS' => $this->db->get_where('tb_autentikasi', ['role' => 'guru'])->result_array()
		];
		$this->load->view('kepsek/layouts/wrapperData', $data);
	}
	public function add_guru()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_dash|max_length[25]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[25]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required|numeric|max_length[20]');
		$this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan', 'required|max_length[25]');
		$this->form_validation->set_rules('agama', 'Agama', 'required|max_length[25]');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|numeric|max_length[13]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[100]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman guru
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'kepsek',
				'viewUtama' => 'kepsek/contents/form_guru',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('kepsek/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->guru_m->simpanGuru(); // Insert data guru
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('kepsek/guru'); // redirect ke halaman guru
		}
	}
	public function grafik()
	{
		$data = [
			'judul' => 'Grafik Nilai',
			'viewUtama' => 'kepsek/contents/grafik',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'datagrafik' => $this->db->query("select a.mata_pelajaran,sum(nilai) as nilai from tb_data_mata_pelajaran a
				left join tb_penilaian_aspek_perkembangan b
				on b.id_mapel = a.id_mapel
				group by a.mata_pelajaran ")->result()
		];
		$this->load->view('kepsek/layouts/wrapperData', $data);
	}
	public function siswa()
	{
		$data = [
			'judul' => 'kepsek | Kelola Siswa',
			'viewUtama' => 'kepsek/contents/siswa',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'siswaS' => $this->db->get('tb_data_siswa')->result_array()
		];
		$this->load->view('kepsek/layouts/wrapperData', $data);
	}
	public function add_siswa()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[25]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('nama_wali', 'Nama Wali', 'required|max_length[13]');
		$this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'required|max_length[4]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman siswa
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'kepsek',
				'viewUtama' => 'kepsek/contents/form_siswa',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('kepsek/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->siswa_m->simpanSiswa(); // Insert data siswa
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('kepsek/siswa'); // redirect ke halaman siswa
		}
	}
	public function update_siswa($id_siswa)
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[25]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('nama_wali', 'Nama Wali', 'required|max_length[13]');
		$this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'required|max_length[4]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman siswa
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'kepsek',
				'viewUtama' => 'kepsek/contents/form_siswa',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
				'siswa' => $this->db->get_where('tb_data_siswa', ['id_siswa' => $id_siswa])->row_array()
			];
			$this->load->view('kepsek/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->siswa_m->ubahSiswa($id_siswa); // Insert data siswa
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('kepsek/siswa'); // redirect ke halaman siswa
		}
	}
	public function mata_pelajaran()
	{
		$data = [
			'judul' => 'kepsek | Kelola Mata Pelajaran',
			'viewUtama' => 'kepsek/contents/mata_pelajaran',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'mataPelajaranS' => $this->db->get('tb_data_mata_pelajaran')->result_array()
		];
		$this->load->view('kepsek/layouts/wrapperData', $data);
	}
	public function add_mata_pelajaran()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('kode_mapel', 'Kode Mata Pelajaran', 'required|max_length[10]|is_unique[tb_data_mata_pelajaran.kode_mapel]');
		$this->form_validation->set_rules('mata_pelajaran', 'Mata Pelajaran', 'required|max_length[25]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman mata_pelajaran
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'kepsek',
				'viewUtama' => 'kepsek/contents/form_mata_pelajaran',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('kepsek/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->mapel_m->simpanMataPelajaran(); // Insert data mata_pelajaran
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('kepsek/mata_pelajaran'); // redirect ke halaman mata_pelajaran
		}
	}
	public function update_mata_pelajaran($id_mapel)
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('kode_mapel', 'Kode Mata Pelajaran', 'required|max_length[10]');
		$this->form_validation->set_rules('mata_pelajaran', 'Mata Pelajaran', 'required|max_length[25]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman mata_pelajaran
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'kepsek',
				'viewUtama' => 'kepsek/contents/form_mata_pelajaran',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
				'mata_pelajaran' => $this->db->get_where('tb_data_mata_pelajaran', ['id_mapel' => $id_mapel])->row_array()
			];
			$this->load->view('kepsek/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->mapel_m->ubahMataPelajaran($id_mapel); // Insert data mata_pelajaran
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('kepsek/mata_pelajaran'); // redirect ke halaman mata_pelajaran
		}
	}
	public function tahun_ajaran()
	{
		$data = [
			'judul' => 'kepsek | Kelola Tahun Ajaran',
			'viewUtama' => 'kepsek/contents/tahun_ajaran',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'tahunAjaranS' => $this->db->get('tb_data_tahun_ajaran')->result_array()
		];
		$this->load->view('kepsek/layouts/wrapperData', $data);
	}
	public function add_tahun_ajaran()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required|max_length[15]');
		$this->form_validation->set_rules('semester', 'Semester', 'required|numeric|max_length[5]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman tahun_ajaran
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'kepsek',
				'viewUtama' => 'kepsek/contents/form_tahun_ajaran',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('kepsek/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->ta_m->simpanTahunAjaran(); // Insert data tahun_ajaran
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('kepsek/tahun_ajaran'); // redirect ke halaman tahun_ajaran
		}
	}
	public function update_tahun_ajaran($id_ta)
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required|max_length[15]');
		$this->form_validation->set_rules('semester', 'Semester', 'required|numeric|max_length[5]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman tahun_ajaran
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'kepsek',
				'viewUtama' => 'kepsek/contents/form_tahun_ajaran',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
				'tahun_ajaran' => $this->db->get_where('tb_data_tahun_ajaran', ['id_ta' => $id_ta])->row_array()
			];
			$this->load->view('kepsek/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->ta_m->ubahTahunAjaran($id_ta); // Insert data tahun_ajaran
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('kepsek/tahun_ajaran'); // redirect ke halaman tahun_ajaran
		}
	}
	public function pengajaran()
	{
		$data = [
			'judul' => 'kepsek | Pengajaran',
			'viewUtama' => 'kepsek/contents/pengajaran',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'pengajaranS' => $this->pengajaran_m->getPengajaran()->result_array()
		];
		$this->load->view('kepsek/layouts/wrapperData', $data);
	}
	public function lihat_nilai($pengajaran_id)
	{
		$data = [
			'judul' => 'kepsek | Nilai',
			'viewUtama' => 'kepsek/contents/lihat_nilai',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'pengajaran' => $this->pengajaran_m->getPengajaran($pengajaran_id)->row_array(),
			'pengajaranMapelS' => $this->pengajaran_m->getPengajaranMapel($pengajaran_id),
			'pengajaranSiswaS' => $this->pengajaran_m->getPengajaranSiswa($pengajaran_id),
			'lihat_nilai' => $this->pengajaran_m->lihatNilai($pengajaran_id),
			'pengajaran_id' => $pengajaran_id
		];
		$this->load->view('kepsek/layouts/wrapperData', $data);
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
				$queryAs = "SELECT SUM(nilai) as jumlah, AVG(nilai) as total
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
				$queryJml = "SELECT SUM(nilai) as jumlah
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
				$queryJml = "SELECT AVG(nilai) as rata
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
	public function user()
	{
		$data = [
			'judul' => 'Kepsek | User',
			'viewUtama' => 'kepsek/contents/user',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'dataUser' => $this->db->query("select * from tb_autentikasi")->result(),
		];
		$this->load->view('kepsek/layouts/wrapperIndex', $data);
	}
	
}
