<?php 

// WWW.MALASNGODING.COM === Author : Diki Alfarabi Hadi
// Model yang terstruktur. agar bisa digunakan berulang kali untuk membuat CRUD. 
// Sehingga proses pembuatan CRUD menjadi lebih cepat dan efisien.

class Chatting_model extends CI_Model{
	
	public function simpanChat()
	{
		$data = [
			'id' => $this->input->post('id'),
			'subjek' => $this->input->post('subjek'),
			'isi_pesan' => $this->input->post('isi_pesan'),
			'tgl_pesan' => date('Y-m-d')
		];
		$this->db->insert('tb_pesan', $data);
	}
	function cek_login($table,$where){
		return $this->db->get_where($table,$where);
	}
	
	// FUNGSI CRUD
	// fungsi untuk mengambil data dari database
	function get_data($table){
		return $this->db->get($table);
	}

	// fungsi untuk menginput data ke database
	function insert_data($data,$table){
		$this->db->insert($table,$data);
	}

	// fungsi untuk mengedit data
	function edit_data($where,$table){
		return $this->db->get_where($table,$where);
	}

	// fungsi untuk mengupdate atau mengubah data di database
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	// fungsi untuk menghapus data dari database
	function delete_data($where,$table){
		$this->db->delete($table,$where);
	}
	// AKHIR FUNGSI CRUD
public function getLogin($id = null)
		
	{
		if ($id === null) {
			return $this->db->get('tbl_user')->result_array();
		}else{
			return $this->db->get_where('tbl_user', ['id' => $id])->result_array();
		}
		
	}
	public function deletelogin($id)
	{
		$this->db->delete('tbl_user', ['id' => $id]);
		return $this->db->affected_rows();
	}
	public function createlogin($data)
	{
		$this->db->insert('tbl_user',$data);
		return $this->db->affected_rows();
	}
	public function updatelogin($data, $id)
	{
		$this->db->update('tbl_user', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}
	public function sakit(){
		$this->db->select('absensi.*,
							karyawan.karyawan_nama,absensi.absen_nik, sum(absen_sakit) as absen_sakit');
		$this->db->from('absensi');
		
		$this->db->join('karyawan','karyawan.karyawan_nik = absensi.absen_nik','LEFT');
		
		//endJOIN
		$this->db->group_by('absen_nik', 'desc');
		$this->db->order_by('absen_nik', 'desc');
		$query = $this->db->get();
		return $query->result();

	}		
	public function izin(){
		$this->db->select('absensi.*,
							karyawan.karyawan_nama,absensi.absen_nik, sum(absen_izin) as absen_izin');
		$this->db->from('absensi');
		
		$this->db->join('karyawan','karyawan.karyawan_nik = absensi.absen_nik','LEFT');
		
		//endJOIN
		$this->db->group_by('absen_nik', 'desc');
		$this->db->order_by('absen_nik', 'desc');
		$query = $this->db->get();
		return $query->result();

	}		
	public function alfa(){
		$this->db->select('absensi.*,
							karyawan.karyawan_nama,absensi.absen_nik, sum(absen_alfa) as absen_alfa');
		$this->db->from('absensi');
		
		$this->db->join('karyawan','karyawan.karyawan_nik = absensi.absen_nik','LEFT');
		
		//endJOIN
		$this->db->group_by('absen_nik', 'desc');
		$this->db->order_by('absen_nik', 'desc');
		$query = $this->db->get();
		return $query->result();

	}		
	public function cuti(){
		$this->db->select('absensi.*,
							karyawan.karyawan_nama,absensi.absen_nik, sum(absen_cuti) as absen_cuti');
		$this->db->from('absensi');
		
		$this->db->join('karyawan','karyawan.karyawan_nik = absensi.absen_nik','LEFT');
		
		//endJOIN
		$this->db->group_by('absen_nik', 'desc');
		$this->db->order_by('absen_nik', 'desc');
		$query = $this->db->get();
		return $query->result();

	}		
	public function hadir(){
		$this->db->select('absensi.*,
							karyawan.karyawan_nama,absensi.absen_nik, sum(absen_hadir) as absen_hadir');
		$this->db->from('absensi');
		
		$this->db->join('karyawan','karyawan.karyawan_nik = absensi.absen_nik','LEFT');
		
		//endJOIN
		$this->db->group_by('absen_nik', 'desc');
		$this->db->order_by('absen_nik', 'desc');
		$query = $this->db->get();
		return $query->result();

	}		
} 
	

?>