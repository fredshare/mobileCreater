<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* mobile mall Model Class
* 
* @author sharexie
*/
class Template_model extends CI_Model{
	/**
	* // 构造函数
	*
	* 加载一些类库
	* @return null
	*/
	function __construct(){
		parent::__construct();
		$this->load->database('mobile');
		$this->db->query("SET NAMES utf8");
	}	
	function get_template($id){
		if($id){
			$sql = "select * from mobile_mall_template where id ='".$id."'";
			$query = $this->db->query($sql)->result_array();
			return $query;
		}
	}
	function get_all_template(){
		$sql = "select id,name,uid,modtime from mobile_mall_template";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}

	function update_template_data($id,$data){
		try{
			$this->db->where('id', $id);
			$this->db->update('mobile_mall_template', $data);
			return true;
		}catch(exception $e){
			return false;
		}
	}
	function add_template_data($data){
		try{
			$this->db->insert('mobile_mall_template', $data);
			$getSqlDataId = "select last_insert_id()";
			$dataId = $this->db->query($getSqlDataId)->result_array();
			return $dataId[0]['last_insert_id()'];
		}catch(exception $e){
			return false;
		}
	}
}
