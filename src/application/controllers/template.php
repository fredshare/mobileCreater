<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* @desc 无线端的模版管理 controller
* @author sharexie
* @date 2013-07-23
*
*/
class Template extends MY_Controller {
	/**
	*  构造函数
	*
	* 加载一些类库
	* @return null
	*/	
	function __construct(){
		parent::__construct();
		$this->load->library('parser');	
		$this->load->model("template_model");
	}
	
	function getTemplateHtml(){
		$id = $this->input->post("templateId");
		$listInfo = $this->template_model->get_template($id);
		echo $listInfo[0]["data"];
	}
	function templateList($type=1){
		if($type==1){
			$listInfo = $this->template_model->get_all_template();
			$data = array('list' => $listInfo );
			$this->parser->parse('template/templateList',$data);
		}else{
			$listInfo = $this->template_model->get_all_template();
			print_r(json_encode($listInfo));
		}		
	}
	function updateTemplate($id=""){
		if($id){
			$templateData = $this->template_model->get_template($id);
			$data = array(
				'name' => $templateData[0]["name"],
				'id'=>$templateData[0]["id"],
				'data'=>$templateData[0]["data"],
				'businessid'=>$templateData[0]["businessid"]
			 );
		}else{
			$data = array(
				'name' => "",
				'id'=>"",
				'data'=>"",
				'businessid'=>""
			 );
		}
			
		$this->parser->parse('template/templateUpdate',$data);
	}
	function saveTemplate(){
		$id = $this->input->post("id");
		$uid = $this->input->post("uid");
		$name = $this->input->post("name");
		$data = $this->input->post("data");
		$addTime = date('Y-m-d H:i:s');
		$modTime = date('Y-m-d H:i:s');
		//post数据不能为空		
		if($id){
			$data = array(
				'uid' => $uid,
				'id' => $id,
				'data' => $data,
				'name' => $name,
				'modtime' => $addTime
			);
			$result = $this->template_model->update_template_data($id,$data);
		}else{
			$data = array(
				'uid' => $uid,
				'name' => $name,
				'data' => $data,
				'addtime' => $addTime,
				'modtime' => $modTime
			);
			$result = $this->template_model->add_template_data($data);
		}
		if($result){
			echo json_encode(array(
				'ret' => 1,
				'msg' => "保存成功"
				 ));
		}else{
			echo json_encode(array(
				'ret' => 0, 
				'msg' => "保存失败"
				));
		}
		
	}
}