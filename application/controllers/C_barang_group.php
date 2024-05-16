
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_barang_group extends CI_Controller {

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
		$this->load->view('barang_group/form');
	}

	public function Insert()
	{
		$data = array('nama_barang'=>$this->input->post('nama_barang'));
		//print_r($data);
		$this->session->set_userdata('Simpan_data','Berhasil Disimpan');
		$this->db->Insert('barang_group',$data);
		echo "<meta http-equiv='refresh' conten='0; url=".base_url()."code_igniter/index.php/C_barang_group/Insert'>"; 
	}

	public function lihat(){
		$data['data']= $this->db->get('barang_group')->result();
		$this->load->view('barang_group/lihat', $data);
	}

	public function edit(){
		$id_group = $this->uri->segment(3);
		$data ['data'] = $this->db->get_where('barang_group', array('id_group' => $id_group))->result();
		$this->load->view('barang_group/edit', $data);
	}

	public function Update(){
		$id_group = $this->input->post('id_group');
		$nama_barang = $this->input->post('nama_barang');
		//$data = array('Nama Barang'=>$Nama);
		// Nama hrs sama dengan nama field yg ada di tabel
		$data=array('nama_barang'=>$nama_barang);
		//print_r($data);

		$this->db->where('id_group', $id_group);
		$this->db->update('barang_group',$data);
		echo "Update data berhasil";
		//echo "<meta http-equiv='refresh' content='0; url=".base_url()."code_igniter/index.php/C_barang_group/Insert'>";
	}	
	
	public function Hapus(){
		$id_group = $this->uri->segment(3);
		//echo $id_group;
		$this->db->where('id_group',$id_group) ;
		$this->db->delete('barang_group');
	}		
	
}