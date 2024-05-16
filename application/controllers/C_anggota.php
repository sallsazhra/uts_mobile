
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_anggota extends CI_Controller {

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
	 * @see https://codeigniter.com/usergukodee3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('anggota/index');
	}

	//Proses CRUD

	public function Insert() //Create
	{
		$data = array('nama'=>$this->input->post('nama'),
					  'telp'=>$this->input->post('telp'));
		//print_r($data);
		$this->session->set_userdata('Simpan_data','Berhasil Disimpan');
		$this->db->Insert('anggota',$data);	
		echo "<meta http-equiv='refresh' conten='0; url=".base_url()."code_igniter/index.php/C_anggota/Insert'>"; 
	}

	public function lihat(){ //Read
		$data['data']= $this->db->get('anggota')->result();
		$this->load->view('anggota/lihat', $data);
	}

	public function edit(){
		$kode = $this->uri->segment(3);
		$data ['data'] = $this->db->get_where('anggota', array('kode' => $kode))->result();
		$this->load->view('anggota/edit', $data);
	}

	public function Update(){ //Update
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$telp = $this->input->post('telp');

		//$data = array('Nama Barang'=>$nama);
		// nama hrs sama dengan nama field yg ada di tabel
		$data=array('nama'=>$nama,
					'telp'=>$telp);
		//print_r($data);

		$this->db->where('kode', $kode);
		$this->db->update('anggota',$data);
		echo "Update data berhasil";
		//echo "<meta http-equiv='refresh' content='0; url=".base_url()."code_igniter/index.php/C_anggota/Insert'>";
	}	
	
	public function Hapus(){ //Delete
		$kode = $this->uri->segment(3);
		//echo $kode;
		$this->db->where('kode',$kode) ;
		$this->db->delete('anggota');
	}		

}