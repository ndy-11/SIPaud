<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orangtua_model extends CI_Model
{
	public function simpanOrangtua()
	{
		$data = [
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('tanggal_lahir')),
			'role' => 'orangtua',
			'nama' => $this->input->post('nama'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'nip' => $this->input->post('nip'),
			'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
			'agama' => $this->input->post('agama'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('tb_autentikasi', $data);
	}
	public function ubahProfil()
	{
		$cekUser = $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array();
		$data = [
			'password' => $this->input->post('password') == null ? $cekUser['password'] : md5($this->input->post('password')),
			'nama' => $this->input->post('nama'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'nip' => $this->input->post('nip'),
			'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
			'agama' => $this->input->post('agama'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->where('id', $this->session->userdata('id'));
		$this->db->update('tb_autentikasi', $data);
	}
	function Jum_mahasiswa_perjurusan()
    {
        $this->db->group_by('tb_data_siswa.nama');
        $this->db->select('tb_data_siswa.nama');
        $this->db->select("count(*) as tb_nilai.nilai");
        return $this->db->query("select * from tb_nilai,tb_pengajaran,tb_data_siswa,tb_data_mata_pelajaran where tb_nilai.pengajaran_id=tb_pengajaran.id_pengajaran and tb_nilai.siswa_id=tb_data_siswa.id_siswa and tb_nilai.mapel_id=tb_data_mata_pelajaran.id_mapel ")
          ->result();
    }
}
