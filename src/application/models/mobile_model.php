<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* mobile mall Model Class
* 
* @author sharexie
*/
class Mobile_model extends CI_Model{
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
	
	//新增卖场和热区数据
	function add_mall_data($data){
		if(!$data){
			return false;
		}
		
		try{
			$this->db->insert('mobile_mall_config', $data);
			$getSqlDataId = "select last_insert_id()";
			$dataId = $this->db->query($getSqlDataId)->result_array();
			return $dataId[0]['last_insert_id()'];
		}catch(exception $e){
			return false;
		}
	}
	
	//删除卖场
	function del_mall_data($id){
		try{
			$result = $this->db->query('update mobile_mall_config set status = 0 where id='.$id);
			return $result;
		}catch(exception $e){
			return false;
		}
		
	}
	//更新卖场数据
	function update_mall_data($data, $dataId){
		try{
			$this->db->where('id', $dataId);
			$this->db->update('mobile_mall_config', $data);
			return true;
		}catch(exception $e){
			return false;
		}
	}
	
	//修改卖场热区数据
	function update_hot_data($data,$html='',$js='',$css='',$dataId,$templateId=1){
		try{
			$this->db->where('id', $dataId);
			$this->db->update('mobile_mall_config', array('data'=>$data,'templateId'=>$templateId,'html'=>$html,'js'=>$js,'css'=>$css));
			return true;
		}catch(exception $e){
			return false;
		}
	}
	
	//修改卖场热区数据turl 
	function update_hot_turl($id,$turl){
		try{
			$this->db->where('id', $id);
			$this->db->update('mobile_mall_config', array('turl'=>$turl));
			return true;
		}catch(exception $e){
			return false;
		}
	}
	function get_all_mall($type,$page=1,$size=10){
		$cfg=$type==0?'':' where business="'.$type.'"';
		$sql = "select * from mobile_mall_config".$cfg." and status > 0 order by modtime desc limit ".($page*$size-$size).",".$size;
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	function search_mall_count($business,$search,$page=1,$size=10){
		$sql = "select * from mobile_mall_config where business=$business and status>0 and (title like '%$search%' or id like '%$search%' or uid like '%$search%' or locker like '%$search%') order by modtime desc limit ".($page*$size-$size).",".$size;
		$query = $this->db->query($sql)->result_array();
		return $query;
	}

	function get_search_count($business,$search){
		$sql = "select COUNT(*) from mobile_mall_config where business=$business and status>0 and (title like '%$search%' or id like '%$search%' or uid like '%$search%' or locker like '%$search%') order by modtime desc";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}

	function get_mall_count($type){
		$cfg=$type==0?'':' where business="'.$type.'"';
		$sql = "select COUNT(*) from mobile_mall_config".$cfg." and status >0";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
	
	//删除热区数据
	function delete_hot_data($id){
		try{
			$this->db->where('id', $id);
			$this->db->update('mobile_mall_config', array('data'=>''));
			return true;
		}catch(exception $e){
			return false;
		}
	}

	//获取卖场信息 
	function get_mall_data($id){
		if($id){
			$sql = "select * from mobile_mall_config where id =".$id;
			$query = $this->db->query($sql)->result_array();
			return $query;
		}else{
			return false;
		}
	}
	
	function get_mall_data_by_app($app){
		if($app){
			$sql = "select * from mobile_mall_config where mallid ='".$app."'";
			$query = $this->db->query($sql)->result_array();
			return $query;
		}else{
			return false;
		}
	}
	function get_template($id){
		if($id){
			$sql = "select * from mobile_mall_template where id ='".$id."'";
			$query = $this->db->query($sql)->result_array();
			return $query;
		}else{
			return false;
		}
	}
	//跟新status状态
	function set_mall_status($id){
		if($id){
			$sql = "update mobile_mall_config set status = 2 where id=".$id;
			$query = $this->db->query($sql);
			return $query;
		}else{
			return false;
		}
	}

	//枷锁卖场
	function change_lock_status($id,$user=''){
		if($id){	
			if($user == 'null'){
				$sql = "update mobile_mall_config set locker = '' where id = ".$id;
			}else{
				$sql = "update mobile_mall_config set locker = '$user' where id = ".$id;
			}
			$query = $this->db->query($sql);
			return $query;
		}else{
			return false;
		}
	}
	
}
