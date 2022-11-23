<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('liveedit_model');
	}
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('editview');
	}
	function load_data(){
		$data = $this->liveedit_model->load_post();
		echo json_encode($data);
	}
	function insert(){
		$data = array(
			'nama_barang' => $this->input->post('nama_barang'),
			'jumlah' => $this->input->post('jumlah'),
			'harga' => $this->input->post('harga'),
			'total' => $this->input->post('total')
		);
		$this->liveedit_model->insert($data);
	}
	function update(){
		$data = array(
			$this->input->post('table_column')=>$this->input->post('value')
		);
		$this->liveedit_model->update($data,$this->input->post('id'));
	}
	function delete(){
		$this->liveedit_model->delete($this->input->post('id'));
	}
}