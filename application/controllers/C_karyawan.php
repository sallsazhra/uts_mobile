
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_karyawan extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('karyawan/index');
	}

	public function Insert()
	{
		$data = array('nama_karyawan'=>$this->input->post('nama_karyawan'),
					  'telp'=>$this->input->post('telp'),
					  'alamat'=>$this->input->post('alamat'));
		//print_r($data);
		$this->session->set_userdata('Simpan_data','Berhasil Disimpan');
		$this->db->Insert('karyawan',$data);
		echo "<meta http-equiv='refresh' conten='0; url=".base_url()."code_igniter/index.php/C_karyawan/Insert'>"; 
	}

	public function lihat(){
		$data['data']= $this->db->get('karyawan')->result();
		$this->load->view('karyawan/lihat', $data);
	}

	public function edit(){
		$kode = $this->uri->segment(3);
		$data ['data'] = $this->db->get_where('karyawan', array('kode' => $kode))->result();
		$this->load->view('karyawan/edit', $data);
	}

	public function Update(){
		$kode = $this->input->post('kode');
		$nama_karyawan = $this->input->post('nama_karyawan');
		$telp = $this->input->post('telp');
		$alamat = $this->input->post('alamat'); //Kurang Alamat e

		//$data = array('Nama Barang'=>$nama_karyawan);
		// nama_karyawan hrs sama dengan nama field yg ada di tabel
		$data=array('nama_karyawan'=>$nama_karyawan,
					'telp'=>$telp,
					'alamat'=>$alamat);
		//print_r($data);

		$this->db->where('kode', $kode);
		$this->db->update('karyawan',$data);
		echo "Update data berhasil";
		//echo "<meta http-equiv='refresh' content='0; url=".base_url()."code_igniter/index.php/C_karyawan/Insert'>";
	}	
	
	public function Hapus(){
		$kode = $this->uri->segment(3);
		//echo $kode;
		$this->db->where('kode',$kode) ;
		$this->db->delete('karyawan');
	}
}