<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drive extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_drive');
        $this->load->model('m_umum');

        if(empty($this->session->userdata('loginData'))){
            redirect('dashboard');
        }
    }
	
	public function manage($id = '')
	{
        $dataUser = $this->session->userdata('loginData');
        $data['back'] = '';
        if (!empty($id)) {
            $checkDrive = $this->m_drive->isMyDrive($dataUser['userId'],$id);
            if (!empty($checkDrive)) {
                $data['back'] = $checkDrive->id_parent;
            }else{
                redirect('drive/manage');
            }
        }
        $data['dataFolder'] = $this->m_drive->getMyFolder($dataUser['userId'],$id);
        $data['dataFile'] = $this->m_drive->getMyFile($dataUser['userId'],$id);
        $data['v_content'] = "drive/manage";
        $this->load->view("layout",$data);
	}

    public function cobaLog(){
        $this->db->insert('log_file',['id'=>'']);
    }

    public function addFolder(){
        $dataUser = $this->session->userdata('loginData');
        $post = $this->input->post();
        $data = ['id_user'=>$dataUser['userId'],
                'folder_name'=>$post['folder_name'],
                'id_parent'=>(empty($post['id_folder'])?null:$post['id_folder'])];
        $return = $this->m_drive->addFolder($data);
        if ($return) {
            $this->m_umum->generatePesan("Berhasil Membuat Folder","berhasil");
            redirect('drive/manage/'.$post['id_folder']);
        }else{
            $this->m_umum->generatePesan("Gagal Membuat Folder","gagal");
            redirect('drive/manage/'.$post['id_folder']);
        }
    }

    public function renameFolder(){
        $dataUser = $this->session->userdata('loginData');
        $post = $this->input->post();
        $data = ['folder_name'=>$post['folder_name']];
        $return = $this->m_drive->updateFolder($data,['folder_id'=>$post['id_folder']]);
        if ($return) {
            $this->m_umum->generatePesan("Berhasil Mengubah Folder","berhasil");
            redirect('drive/manage/'.$post['id_parent']);
        }else{
            $this->m_umum->generatePesan("Gagal Mengubah Folder","gagal");
            redirect('drive/manage/'.$post['id_parent']);
        }
    }

    public function removeFolder($id_folder,$id_parent = ''){
        $dataUser = $this->session->userdata('loginData');
        $getFolder = $this->m_drive->getAllChild($dataUser['userId'],$id_folder);
        $getFileThisFolder = $this->m_drive->getMyFile($dataUser['userId'],$id_folder);
        foreach ($getFileThisFolder as $key => $value) {
            $result = $this->m_drive->deleteFile(['file_key'=>$value->file_key]);
            unlink(FCPATH.$value->file_name);
        }
        $this->m_drive->deleteFolder(['folder_id'=>$id_folder]);
        if (!empty($getFolder->folder_child)) {
            $folder = explode(",", $getFolder->folder_child);
            foreach ($folder as $key => $value) {
                $dataFile = $this->m_drive->getMyFile($dataUser['userId'],$value);
                $this->m_drive->deleteFolder(['folder_id'=>$value]);
                // echo json_encode($dataFile);
                foreach ($dataFile as $keyf => $valuef) {
                    $result = $this->m_drive->deleteFile(['file_key'=>$valuef->file_key]);
                    unlink(FCPATH.$valuef->file_name);
                }
            }
        }
        $this->m_umum->generatePesan("Berhasil Menghapus Folder","berhasil");
        redirect('drive/manage/'.$id_parent);
    }
		
	public function doUpload() {
        $dataUser = $this->session->userdata('loginData');
        $dataPost = $this->input->post();
        if (!empty($_FILES['file'])) {
            $post = $this->input->post();
            $getId = $this->m_drive->lastID();
            $ext           = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $realName = $_FILES['file']['name'];
            $fileCuy = md5($getId->id).$dataUser['userId'].".".$ext;
            $fileKey = md5($getId->id).$dataUser['userId'];
            $config['upload_path']   = './up001/';
            $config['allowed_types'] = '*';
            $config['file_name']     = $fileCuy;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('file')){
                // $error = 'error: '. $this->upload->display_errors();
                // echo $error;
                // die();
                // $this->m_umum->generatePesan("Gagal Mengupload File lebih dari 2MB","gagal");
                // redirect('drive/manage');
                echo json_encode(['msg'=>'gagal upload file','status'=>400]);
            }else{
                $fileCuy = "up001/".$fileCuy;
                $size = filesize(FCPATH.'/'.$fileCuy);
                $dataFile = ['file_name'=>$fileCuy,
                            'file_key'=>$fileKey,
                            'file_realname'=>$realName,
                            'file_size'=>$size,
                            'file_create'=>date('Y-m-d H:i:s'),
                            'id_user'=>$dataUser['userId'],
                            'id_folder'=>(empty($post['id_folder'])?null:$post['id_folder'])];
                $this->m_drive->addFile($dataFile);
                $this->m_drive->addLog();
                // $this->m_umum->generatePesan("Upload File Berhasil","berhasil");
                // redirect('drive/manage/'.$post['id_folder']);
                echo json_encode(['msg'=>'berhasil upload file','status'=>200]);
            }
        }else{
            echo json_encode(['msg'=>'file tidak terpilih','status'=>400]);
        }
    }

    public function removeFile($key,$id_folder='')
    {
        $dataFile = $this->m_drive->checkKey($key);
        if (empty($dataFile)) {
            redirect(base_url().'dashboard/notfound');  
        }
        $result = $this->m_drive->deleteFile(['file_key'=>$key]);
        unlink(FCPATH.$dataFile->file_name);
        if ($result) {
            $this->m_umum->generatePesan("Berhasil Menghapus File","berhasil");
            redirect('drive/manage/'.$id_folder);
        }else{
            $this->m_umum->generatePesan("Gagal Menghapus File","gagal");
            redirect('drive/manage/'.$id_folder);
        }
    }
       
}
