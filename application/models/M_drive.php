<?php

class M_drive extends CI_Model {
    function getMyFile($user_id,$id_folder){
        $this->db->where(['id_user'=>$user_id,'id_folder'=>(empty($id_folder)?null:$id_folder)]);
        $this->db->from('tbl_file');
        return $this->db->get()->result();
	}
    function getMyFolder($user_id,$id_folder){
        $this->db->where(['id_user'=>$user_id,'id_parent'=>(empty($id_folder)?null:$id_folder)]);
        $this->db->from('tbl_folder');
        return $this->db->get()->result();
    }
    function isMyDrive($user_id,$id_folder){
        $this->db->where(['id_user'=>$user_id,'folder_id'=>$id_folder]);
        $this->db->from('tbl_folder');
        return $this->db->get()->row();
    }
    function lastID()
    {
        return $this->db->query("select * from log_file order by id desc limit 1")->row();
    }
    function getAllChild($user_id,$id_folder){
        $id_folder = (empty($id_folder)?null:$id_folder);
        return $this->db->query("SELECT GROUP_CONCAT(lv SEPARATOR ',') as folder_child FROM (
                                SELECT @pv:=(SELECT GROUP_CONCAT(folder_id SEPARATOR ',') FROM tbl_folder WHERE id_parent IN (@pv) and id_user = '".$user_id."') AS lv FROM tbl_folder
                                JOIN
                                (SELECT @pv:='".$id_folder."')tmp
                                WHERE id_parent IN (@pv)) a;")->row();
    }
    function addFile($data)
    {
        return $this->db->insert('tbl_file',$data);
    }
    function deleteFile($where)
    {
        return $this->db->delete('tbl_file',$where);
    }
    function addFolder($data)
    {
        return $this->db->insert('tbl_folder',$data);
    }
    function updateFolder($data,$id)
    {
        return $this->db->update('tbl_folder',$data,$id);
    }
    function deleteFolder($where)
    {
        return $this->db->delete('tbl_folder',$where);
    }
    function addLog()
    {
        return $this->db->insert('log_file',['id'=>'']);
    }
    function checkKey($key)
    {
        $this->db->where(['file_key'=>$key]);
        $this->db->from('tbl_file');
        return $this->db->get()->row();
    }
}
?>