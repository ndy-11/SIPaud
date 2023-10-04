<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log_guru extends CI_Controller
{

	public function index()
	{
		$this->load->view('login_guru');
	}

	public function aksi()
	{

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() != false){

			// menangkap data username dan password dari halaman login
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$where = array(
				'username' => $username,
				'password' => md5($password),
				'status' => 1
			);

			$this->load->model('m_data');

			// cek kesesuaian login pada table pengguna
			$cek = $this->m_data->cek_login('tb_guru',$where)->num_rows();

			// cek jika login benar
			if($cek > 0){

				// ambil data pengguna yang melakukan login
				$data = $this->m_data->cek_login('tb_guru',$where)->row();

				// buat session untuk pengguna yang berhasil login
				$data_session = array(
					'id_guru' => $data->id_guru,
					'nama_guru' => $data->nama_guru,
					'username' => $data->username,
					'status' => 'telah_login'
				);
				$this->session->set_userdata($data_session);

				// alihkan halaman ke halaman dashboard pengguna

				redirect(base_url().'guru');
			}else{
				redirect(base_url().'log_guru?alert=gagal');
			}

		}else{
			$this->load->view('log_guru');
			
		}
	}
}
