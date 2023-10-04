<?php
defined('BASEPATH') or exit('No direct script access allowed');
// memanggil autoload library phpoffice
require('./application/third_party/phpoffice/vendor/autoload.php');

// Memanggil namespace class yang berada di library phpoffice
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller
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
		is_logged_not_in(); // Jika sudah login, lalu mengakses halaman login maka tidak akan bisa dan akan d alihkan ke halaman admin
	}
	public function index()
	{
		$data = [
			'judul' => 'Admin | Home',
			'viewUtama' => 'admin/contents/index',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
		];
		$this->load->view('admin/layouts/wrapperIndex', $data);
	}
	public function user()
	{
		$data = [
			'judul' => 'Admin | User',
			'viewUtama' => 'admin/contents/user',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'dataUser' => $this->db->query("select * from tb_autentikasi")->result(),
		];
		$this->load->view('admin/layouts/wrapperIndex', $data);
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
				'judul' => 'Admin | Tambah Pengajaran',
				'viewUtama' => 'admin/contents/profil',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->guru_m->ubahProfil();
			$this->session->set_flashdata('success', 'Profil berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/profil'); // redirect ke halaman profil
		}
	}
	public function grafik()
	{
		$data = [
			'judul' => 'Grafik Nilai',
			'viewUtama' => 'admin/contents/grafik',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'datagrafik' => $this->db->query("select a.mata_pelajaran,sum(nilai) as nilai from tb_data_mata_pelajaran a
				left join tb_penilaian_aspek_perkembangan b
				on b.id_mapel = a.id_mapel
				group by a.mata_pelajaran ")->result()
		];
		$this->load->view('admin/layouts/wrapperData', $data);
	}
	public function guru()
	{
		$data = [
			'judul' => 'Admin | Kelola Guru',
			'viewUtama' => 'admin/contents/guru',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'dataguru' => $this->db->query("select * from tb_autentikasi where role = 'guru'")->result()
		];
		$this->load->view('admin/layouts/wrapperData', $data);
	}
	public function walimurid()
	{
		$data = [
			'judul' => 'Admin | Wali Murid',
			'viewUtama' => 'admin/contents/walimurid',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'waliS' => $this->db->get_where('tb_walimurid')->result_array()
		];
		$this->load->view('admin/layouts/wrapperData', $data);
	}
	public function add_guru()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_dash|max_length[25]');
		$this->form_validation->set_rules('nama_guru', 'Nama', 'required|max_length[25]');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('pend_terakhir', 'Pendidikan', 'required|max_length[25]');
		$this->form_validation->set_rules('nmr_hp', 'No Handphone', 'required|numeric|max_length[13]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[100]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman guru
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_guru',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->guru_m->simpanGuru(); // Insert data guru
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/user'); // redirect ke halaman guru
		}
	}
	public function add_user()
	{
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_user',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
	}
	public function save_user()
	{
			$data = [
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'role' => $this->input->post('role'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'nip' => $this->input->post('nip'),
				'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
				'agama' => $this->input->post('agama'),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
				'created_at' => date('Y-m-d H:i:s')
			];

			$this->db->insert('tb_autentikasi', $data);
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/user'); // redirect ke halaman guru
	}
	public function save_pengajaran()
	{
			$data = [
				'guru_id' => $this->input->post('guru_id'),
				'ta_id' => $this->input->post('ta_id'),
				'kelas' => $this->input->post('kelas')
			];
			$this->db->insert('tb_pengajaran', $data);
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/pengajaran'); // redirect ke halaman guru
	}
	public function save_guru()
	{
			$data = [
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'role' => 'guru',
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'nip' => $this->input->post('nip'),
				'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
				'agama' => $this->input->post('agama'),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
				'created_at' => date('Y-m-d H:i:s')
			];

			$this->db->insert('tb_autentikasi', $data);
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/guru'); // redirect ke halaman guru
	}
	public function update_user($id)
	{
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_ubah_user',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
				'dataUser' => $this->db->query("select * from tb_autentikasi where id = '$id' ")->row_array()
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
	}
	public function save_ubah_user()
	{
			$data = [
				'nama' => $this->input->post('nama'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'agama' => $this->input->post('agama'),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
				'updated_at' => date('Y-m-d H:i:s')
			];
			$this->db->where('id', $this->input->post('user_id'));
			$this->db->update('tb_autentikasi', $data);
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/user'); // redirect ke halaman guru
	}
	public function save_ubah_guru()
	{
			$data = [
				'nama' => $this->input->post('nama'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
				'agama' => $this->input->post('agama'),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
				'updated_at' => date('Y-m-d H:i:s')
			];
			$this->db->where('id', $this->input->post('user_id'));
			$this->db->update('tb_autentikasi', $data);
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/guru'); // redirect ke halaman guru
	}
	public function save_murid()
	{
			$data = [
				'nm_siswa' => $this->input->post('nm_siswa'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'id_ortu' => $this->input->post('id_ortu'),
				'tahun_masuk' => $this->input->post('tahun_masuk'),
				'created_at' => date("Y-m-d H:i:s")
			];
			$this->db->insert('tb_data_siswa', $data);
			$this->session->set_flashdata('success', 'Data berhasil ditambah.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/siswa'); // redirect ke halaman guru
	}
	public function save_ubah_murid()
	{
			$data = [
				'nm_siswa' => $this->input->post('nm_siswa'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'id_ortu' => $this->input->post('id_ortu'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'tahun_masuk' => $this->input->post('tahun_masuk'),
				'updated_at' => date("Y-m-d H:i:s")
			];
			$this->db->where('id_siswa', $this->input->post('id_siswa'));
			$this->db->update('tb_data_siswa', $data);
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/siswa'); // redirect ke halaman guru
	}
	public function add_walimurid()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_dash|max_length[25]');
		$this->form_validation->set_rules('nama_wali', 'Nama', 'required|max_length[25]');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|numeric|max_length[13]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman guru
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_walimurid',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
				'datamurid' => $this->db->query("select * from tb_data_siswa")->result()
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->wali_m->simpanWalimurid(); // Insert data guru
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/walimurid'); // redirect ke halaman guru
		}
	}
	public function update_guru($id_guru)
	{
		$data = [
			'judul' => 'Admin',
			'viewUtama' => 'admin/contents/form_guru',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			'guru' => $this->db->get_where('tb_autentikasi', ['id' => $id_guru])->row_array()
		];
		$this->load->view('admin/layouts/wrapperForm', $data);
	}
	public function hapus($id_pengajaran)
	{
		$this->db->delete('tb_pengajaran', ['id_pengajaran' => $id_pengajaran]);
		$this->session->set_flashdata('success', 'Pengajaran berhasil dihapus.'); // Membuat pesan notif jika insert data berhasil
		redirect('admin/pengajaran'); // redirect ke halaman pengajaran
	}
	public function hapus_mata_pelajaran($id_mapel)
	{
		$where = array(
			'id_mapel' => $id_mapel
		);

		$this->m_data->delete_data($where,'tb_data_mata_pelajaran');

		redirect(base_url().'admin/mata_pelajaran');
	}
	public function hapus_user($id)
	{
		$where = array(
			'id' => $id
		);

		$this->m_data->delete_data($where,'tb_autentikasi');

		redirect(base_url().'admin/user');
	}
	public function hapus_tahun_ajaran($id_ta)
	{
		$where = array(
			'id_ta' => $id_ta
		);

		$this->m_data->delete_data($where,'tb_data_tahun_ajaran');

		redirect(base_url().'admin/tahun_ajaran');
	}
	public function hapus_pengajaran($id_pengajaran)
	{
		$where = array(
			'id_pengajaran' => $id_pengajaran
		);

		$this->m_data->delete_data($where,'tb_pengajaran');

		redirect(base_url().'admin/tahun_ajaran');
	}
	public function hapus_guru($id_guru)
	{
		$where = array(
			'id_guru' => $id_guru
		);

		$this->guru_m->delete_data($where,'tb_guru');

		redirect(base_url().'admin/guru');
	}
	public function pesan()
	{
		$data = [
			'judul' => 'Admin | Kelola Pesan',
			'viewUtama' => 'admin/contents/pesan',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'dataPesan' => $this->db->query('select * from tb_pesan a left join tb_autentikasi b on b.id = a.id_guru')->result_array()
		];
		$this->load->view('admin/layouts/wrapperData', $data);
	}
	public function siswa()
	{
		$data = [
			'judul' => 'Admin | Kelola Siswa',
			'viewUtama' => 'admin/contents/siswa',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'siswaS' => $this->db->query('select a.*,b.id,b.nama as nama_ortu from tb_data_siswa a left join  tb_autentikasi b on b.id = a.id_ortu')->result_array()
		];
		$this->load->view('admin/layouts/wrapperData', $data);
	}
	public function hapus_siswa($id)
	{
		$where = array(
			'id_siswa' => $id
		);

		$this->m_data->delete_data($where,'tb_data_siswa');

		redirect(base_url('admin/siswa'));
	}
	public function add_siswa()
	{
		$data = [
			'judul' => 'Admin',
			'viewUtama' => 'admin/contents/form_siswa',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			'datawalis' => $this->db->get_where('tb_autentikasi', ['role' => 'orangtua'])->result()
		];
		$this->load->view('admin/layouts/wrapperForm', $data);
	}
	public function update_siswa($id_siswa)
	{
		$data = [
			'judul' => 'Admin',
			'viewUtama' => 'admin/contents/form_ubah_siswa',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			'siswa' => $this->db->get_where('tb_data_siswa', ['id_siswa' => $id_siswa])->row_array(),
			'datawalis' => $this->db->get_where('tb_autentikasi', ['role' => 'orangtua'])->result()
		];
		$this->load->view('admin/layouts/wrapperForm', $data);
	}
	public function mata_pelajaran()
	{
		$data = [
			'judul' => 'Admin | Kelola Aspek Perkembangan',
			'viewUtama' => 'admin/contents/mata_pelajaran',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'mataPelajaranS' => $this->db->get('tb_data_mata_pelajaran')->result_array()
		];
		$this->load->view('admin/layouts/wrapperData', $data);
	}
	public function mapel($pengajaran_id)
	{
		$data = [
			'judul' => 'Admin | Mata Pelajaran',
			'viewUtama' => 'guru/contents/mapel',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'mata_pelajaranS' => $this->db->get('tb_data_mata_pelajaran')->result_array(),
			'pengajaranMapelS' => $this->pengajaran_m->getPengajaranMapel($pengajaran_id),
			'pengajaran_id' => $pengajaran_id
		];
		$this->load->view('guru/layouts/wrapperData', $data);
	}
	public function siswa_guru($pengajaran_id)
	{
		$data = [
			'judul' => 'Admin | Input Siswa',
			'viewUtama' => 'guru/contents/siswa',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'siswaS' => $this->db->get('tb_data_siswa')->result_array(),
			'pengajaranSiswaS' => $this->pengajaran_m->getPengajaranSiswa($pengajaran_id),
			'pengajaran_id' => $pengajaran_id
		];
		$this->load->view('guru/layouts/wrapperData', $data);
	}
	public function add_mapel($mapel_id)
	{
		$pengajaran_id = $this->input->post('pengajaran_id');

		if ($this->pengajaran_m->simpanPengajaranMapel($mapel_id) == false) { // Insert data pengajaran
			$this->session->set_flashdata('error', 'Mata pelajaran sudah dimasukkan'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/mapel/' . $pengajaran_id); // redirect ke halaman pengajaran
		}
		$this->session->set_flashdata('success', 'Mata pelajaran berhasil dibuat'); // Membuat pesan notif jika insert data berhasil
		redirect('admin/mapel/' . $pengajaran_id); // redirect ke halaman pengajaran
	}
	public function remove_mapel($mapel_id)
	{
		$pengajaran_id = $this->input->post('pengajaran_id');

		$this->pengajaran_m->hapusPengajaranMapel($mapel_id); // Delete data pengajaran
		$this->session->set_flashdata('success', 'Mata pelajaran berhasil dihapus'); // Membuat pesan notif jika delete data berhasil
		redirect('admin/mapel/' . $pengajaran_id); // redirect ke halaman pengajaran
	}
	public function add_mata_pelajaran()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('kode_mapel', 'Kode Mata Pelajaran', 'required|max_length[10]|is_unique[tb_data_mata_pelajaran.kode_mapel]');
		$this->form_validation->set_rules('mata_pelajaran', 'Mata Pelajaran', 'required|max_length[25]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman mata_pelajaran
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_mata_pelajaran',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->mapel_m->simpanMataPelajaran(); // Insert data mata_pelajaran
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/mata_pelajaran'); // redirect ke halaman mata_pelajaran
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
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_mata_pelajaran',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
				'mata_pelajaran' => $this->db->get_where('tb_data_mata_pelajaran', ['id_mapel' => $id_mapel])->row_array()
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->mapel_m->ubahMataPelajaran($id_mapel); // Insert data mata_pelajaran
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/mata_pelajaran'); // redirect ke halaman mata_pelajaran
		}
	}
	public function tahun_ajaran()
	{
		$data = [
			'judul' => 'Admin | Kelola Tahun Ajaran',
			'viewUtama' => 'admin/contents/tahun_ajaran',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'tahunAjaranS' => $this->db->get('tb_data_tahun_ajaran')->result_array()
		];
		$this->load->view('admin/layouts/wrapperData', $data);
	}
	public function add_tahun_ajaran()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required|max_length[15]');
		$this->form_validation->set_rules('semester', 'Semester', 'required|numeric|max_length[5]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman tahun_ajaran
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_tahun_ajaran',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->ta_m->simpanTahunAjaran(); // Insert data tahun_ajaran
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/tahun_ajaran'); // redirect ke halaman tahun_ajaran
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
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_tahun_ajaran',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
				'tahun_ajaran' => $this->db->get_where('tb_data_tahun_ajaran', ['id_ta' => $id_ta])->row_array()
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->ta_m->ubahTahunAjaran($id_ta); // Insert data tahun_ajaran
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/tahun_ajaran'); // redirect ke halaman tahun_ajaran
		}
	}
	public function pengajaran()
	{
		$data = [
			'judul' => 'Admin | Pengajaran',
			'viewUtama' => 'admin/contents/pengajaran',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'pengajaranS' => $this->pengajaran_m->getPengajaran()->result_array()
		];
		$this->load->view('admin/layouts/wrapperData', $data);
	}
	public function add_pengajaran()
	{
		$data = [
			'judul' => 'Admin',
			'viewUtama' => 'admin/contents/form_pengajaran',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			'dataguru' => $this->db->get_where('tb_autentikasi', ['role' => 'guru'])->result(),
			'datata' => $this->db->get_where('tb_data_tahun_ajaran')->result(),
			'datasiswa' => $this->db->get_where('tb_data_siswa')->result(),
			'datamapel' => $this->db->get_where('tb_data_mata_pelajaran')->result()
		];
		$this->load->view('admin/layouts/wrapperForm', $data);
	}
	public function lihat_nilai($pengajaran_id)
	{
		$data = [
			'judul' => 'Admin | Nilai',
			'viewUtama' => 'admin/contents/lihat_nilai',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'pengajaran' => $this->pengajaran_m->getPengajaran($pengajaran_id)->row_array(),
			'pengajaranMapelS' => $this->pengajaran_m->getPengajaranMapel($pengajaran_id),
			'pengajaranSiswaS' => $this->pengajaran_m->getPengajaranSiswa($pengajaran_id),
			'lihat_nilai' => $this->pengajaran_m->lihatNilai($pengajaran_id),
			'pengajaran_id' => $pengajaran_id
		];
		$this->load->view('admin/layouts/wrapperData', $data);
	}
	public function laporan()
	{
		$data = [
			'judul' => 'Admin | Laporan',
			'viewUtama' => 'admin/contents/laporan',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'tahunAjaran' => $this->db->query("select * from tb_data_tahun_ajaran")->result(),
			'dataGuru' => $this->db->query("select id,nama from tb_autentikasi where role = 'guru' ")->result()
		];
		$this->load->view('admin/layouts/wrapperIndex', $data);
	}
	public function lihat_laporan()
	{
		$id_ta = $this->input->post("tahun_ajaran");
		$id_guru = $this->input->post("id_guru");
		$semester = $this->db->query("select * from tb_data_tahun_ajaran where id_ta = '$id_ta' ")->row_array();
		$datapengajaran = $this->db->query("select * from tb_pengajaran a inner join tb_data_tahun_ajaran b on b.id_ta = a.ta_id where a.guru_id = '$id_guru' and a.ta_id = '$id_ta' ")->row_array();

		if ($datapengajaran == null) {
			$id_pengajaran = 0;
			$kelas = '';
		}else{
			$id_pengajaran = $datapengajaran['id_pengajaran'];
			$kelas = $datapengajaran['kelas'];
		}

		$data = [
			'judul' => 'Admin | Lihat Laporan',
			'viewUtama' => 'admin/contents/lihat_laporan',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'semester' => $semester,
			'kelas' => $kelas,
			'pengajaranMapelS' => $this->pengajaran_m->getPengajaranMapel($id_pengajaran),
			'pengajaranSiswaS' => $this->pengajaran_m->getPengajaranSiswa($id_pengajaran),
			'lihat_nilai' => $this->pengajaran_m->lihatNilai($id_pengajaran),
			'pengajaran_id' => $id_pengajaran
		];
		$this->load->view('admin/layouts/wrapperData', $data);
	}
	public function lihat_detail_aspek($id)
	{

		$data = [
			'judul' => 'Admin | Detail Aspek Perkembangan',
			'viewUtama' => 'admin/contents/aspek_pekembangan',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'aspek_pekembangan' => $this->db->query("select a.mata_pelajaran,a.kode_mapel,b.sub_mapel,b.pertanyaan_penilaian from tb_data_mata_pelajaran a left join tb_aspek_perkembangan b on b.kode_mapel = a.id_mapel where a.id_mapel = '$id' ")->result()
		];
		$this->load->view('admin/layouts/wrapperData', $data);
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
	
}
