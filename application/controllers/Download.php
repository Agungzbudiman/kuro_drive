<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('m_drive');
        $this->load->model('m_umum');
    }
	public function file($key = '')
	{
		$dataFile = $this->m_drive->checkKey($key);
		if (empty($dataFile)) {
            redirect(base_url().'dashboard/notfound');  
		}
        $ext           = pathinfo(FCPATH.$dataFile->file_name, PATHINFO_EXTENSION);
		$data['is_video'] = (strpos(mimeContent($ext), 'video') !== false?true:false);
		$data['is_image'] = (strpos(mimeContent($ext), 'image') !== false?true:false);
		$data['dataFile'] = $dataFile;
        $data['v_content'] = "download/file";
        $this->load->view("layout",$data);
	}
	public function do($key = '')
	{
		$dataFile = $this->m_drive->checkKey($key);
		if (empty($dataFile)) {
            redirect(base_url().'dashboard/notfound');  
		}
        $ext           = pathinfo(FCPATH.$dataFile->file_name, PATHINFO_EXTENSION);
        $contentType = mimeContent($ext);
		$filename = FCPATH.$dataFile->file_name;
		header("Content-disposition: attachment; filename=".$dataFile->file_realname.""); 
		header('Content-type: '.$contentType);
		readfile($filename); 
	}

	public function readfile($key = '')
	{
		$dataFile = $this->m_drive->checkKey($key);
		if (empty($dataFile)) {
            redirect(base_url().'dashboard/notfound');  
		}
        $ext           = pathinfo(FCPATH.$dataFile->file_name, PATHINFO_EXTENSION);
        $contentType = mimeContent($ext);
		$filename = FCPATH.$dataFile->file_name;
		header('Content-Type: '.$contentType); #Optional if you'll only load it from other pages
		header('Accept-Ranges: bytes');
		header('Content-Length:'.filesize($filename));
		readfile($filename);
	}

}
