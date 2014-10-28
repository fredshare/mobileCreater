<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* @desc 无线端的卖场管理 controller
* @author sharexie
* @date 2013-06-17
*
*/
class Mobile extends MY_Controller {
	/**
	*  构造函数
	*
	* 加载一些类库
	* @return null
	*/	
	function __construct(){
		parent::__construct();
		$this->load->library('parser');	
		$this->load->library('pagination');
		$this->load->model("mobile_model");
	}
	
	function index($business=1){
		//分页处理
		$page = $this->uri->segment(5) ? $this->uri->segment(5) : 1;
		$total = $this->mobile_model->get_mall_count($business);
		$perPage=10;
		$this->pagination->initialize(
			array(
				"base_url" => '/mobile/index.php/promote/mobile/index/'.$business,
				"total_rows" => $total[0]['COUNT(*)'],
				"per_page" => $perPage,
				"cur_page" => $page
			)
		);
		$pageBar = $this->pagination->create_links();
		//分页处理

		$listInfo = $this->mobile_model->get_all_mall($business,$page,$perPage);
		//print_r($listInfo);
		for ($i=0; $i < count($listInfo); $i++) { 
			if($listInfo[$i]->locker == ""){
				$listInfo[$i]->locker = "无人";
				
			}
		}
		
		$data = array(
			'list' => $listInfo,
			'pageBar' => $pageBar
			 );
		$this->parser->parse('mobile/mobileList',$data);
	}
	function search($business=1,$search=""){
		//将传递过来的字符串替换成安全字符
		$search = preg_replace('/([^\x{4e00}-\x{9fa5}a-zA-Z0-9]+)/u','',$search);
		//拿去数据库查找
		//分页处理
		$page = $this->uri->segment(6) ? $this->uri->segment(6) : 1;
		$total = $this->mobile_model->get_search_count($business,$search);
		$perPage=10;
		$this->pagination->initialize(
			array(
				"base_url" => '/index.php/mobile/mobile/search/'.$business.'/'.$search,
				"total_rows" => $total[0]['COUNT(*)'],
				"per_page" => $perPage,
				"cur_page" => $page
			)
		);
		$pageBar = $this->pagination->create_links();
		//分页处理
		if($search){
			$listInfo = $this->mobile_model->search_mall_count($business,$search,$page,$perPage);
			//print_r($listInfo);
		}else{
			$listInfo =  array(
				'0' => array(
					'id' => "", 
					'title'=> "",
					'tulr'=>"",
					'modtime'=>"",
					'uid'=>""
					)
				);
		}
		
		$data = array(
			'list' => $listInfo,
			'pageBar' => $pageBar
			 );
		$this->parser->parse('mobile/mobileList',$data);
	}
	function createMall($id=""){
		if($id){
			$mallData = $this->mobile_model->get_mall_data($id);
			$data = array(
				'title' => $mallData[0]["title"],
				'id'=>$mallData[0]["id"],
				'ontime'=>$mallData[0]["ontime"],
				'offtime'=>$mallData[0]["offtime"],
				'business'=>$mallData[0]["business"]
			 );
		}else{
			$data = array(
				'title' => "",
				'id'=>"",
				'ontime'=>"2013-06-28 00:00:00",
				'offtime'=>"2013-06-28 00:00:00",
				'business'=>"1"
			 );
		}
			
		$this->parser->parse('mobile/mobileCreate',$data);
	}
	/**
	*  卖场展示函数
	*
	* 卖场展示
	* @param 
	* @return null
	*/	
	function showMall($id=1){
		$data = $this->mobile_model->get_mall_data($id);
		if(!$data){
			$info = array(
				'uid' => $_COOKIE["userName"],
				'mallid' => '0',
				'title' => ''
			 );
			$this->mobile_model->add_mall_data($info);
		}else{
			//通过locker判断页面进入者是否有操作权限
			//if($data[0]["locker"] !== $_COOKIE["userName"]){
				//$locker = $data[0]["locker"];
			//}else{
				//$locker = "";
			//}
			$locker = "";
			$data = array(
				'data' => $data[0]["data"],
				'templateId' => $data[0]["templateid"],
				'id' => $data[0]["id"],
				'turl' => $data[0]["turl"],
				'business' => $data[0]["business"],
				'locker' => $locker
				);
		}

		$this->parser->parse('mobile/mobile',$data);
	}
	function addMall(){
		$uid = $this->input->post('uid')?$this->input->post('uid'):"";
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$business = $this->input->post('business');
		$onTime = $this->input->post('ontime');
		$offTime = $this->input->post('offtime');
		$addTime = date('Y-m-d H:i:s');
		$modTime = date('Y-m-d H:i:s');
		//post数据不能为空
		if(($title)){
			if($id){
				$data = array(
					'uid' => $uid,
					'title' => $title,
					'ontime' => $onTime,
					'offtime' => $offTime,
					'modtime' => $modTime,
					'business' => $business
				);
				$result = $this->mobile_model->update_mall_data($data,$id);
			}else{
				$data = array(
					'uid' => $uid,
					'title' => $title,
					'ontime' => $onTime,
					'offtime' => $offTime,
					'addtime' => $addTime,
					'modtime' => $modTime,
					'business' => $business,
					'data' => '{}'
				);
				$result = $this->mobile_model->add_mall_data($data);
			}				
			if($result){
				echo '<script>window.location="/mobile/index.php/mobile/index/'.$business.'"</script>';
			}else{
				echo '0,更新卖场失败.';
			}
		}else{
			echo "更新卖场失败";
		}
	}

	/*删除买场
	 * 
	 * 按照活动id删除
	 */
	function delMall(){
		$id = $this->input->post("id");
		if((int)$id){
			$result = $this->mobile_model->del_mall_data($id);
			var_dump($result);
		}
	}
	/*
	 * 获取卖场信息
	 * $id 卖场id
	 */ 
	 function getMallData($id){
	 	if($id){
	 		$data = $this->mobile_model->get_mall_data($id);
			
			if($data){
				echo '1';
			}else{
				echo '0,获取卖场信息失败.';
			}			
		} else {
			echo '2,输入id为空.';
		}
	 }
	 
	//对传入的参数进行过滤(暂时废除)
	function checkInput($value){
		try{
			if(get_magic_quotes_gpc()){  // 判断PHP是否开启转义功能,去除斜杠
				if(is_numeric($value)){
					$value = stripslashes($value);
				}
				if(is_string($value)){
					$value = "'".mysql_real_escape_string($value)."'";
				}
			}
			return $value;
		}catch(exception $e){
			return false;
		}
	}	 
	function changeMallStatus($id){
		if($id){
			$result = $this->mobile_model->set_mall_status($id);
			return $result;
		}else{
			return false;
		}
	}
	function changeLockStatus(){
		$user = $this->input->post("user");
		$id = $this->input->post("id");
		$locker = $this->input->post("locker");
		$oaname = $_COOKIE["userName"];
		//这种情况表示加锁，判断以前的locker是否等于null或者
		if($user !== 'null' && $locker !== 'null' && $locker !== $oaname){
			echo json_encode(array('ret' => 2,'msg'=> '对不起，此活动暂时被锁，请联系枷锁人再操作'));
			return;
		}
		if($user == 'null' && $locker !== 'null' && $locker !== $oaname){
			echo json_encode(array('ret' => 1,'msg'=> '对不起，此活动暂时被锁，请联系枷锁人再操作'));
			return;
		}
		$result = $this->mobile_model->change_lock_status($id,$user);
			echo json_encode(array('ret' => 0,'msg'=> $result));
			return;
	}
	function genHtml(){
		$id = $this->input->post('id');
		$html = $this->input->post('html');
		$js = $this->input->post('js');
		$css = $this->input->post('css');
		$data = $this->input->post('data');
		$templateId = $this->input->post('templateId');
		$year = date("Y", time());//年份
		//生成js文件
		$this->genData($id,$data);
		//跟新数据库，保存html和data数据
		$this->mobile_model->update_hot_data($data,$html,$js,$css,$id,$templateId);
		$templateData = $this->mobile_model->get_template($templateId);
		$template = $templateData[0]["data"];
		//生成规定格式的html代码
		$dataJsLink = '/usr/local/c2c/html/newforward/static/js/promote/mobile/'.$year.'/'.$id.'_utf8.js';
		$dataJs = file_get_contents($dataJsLink);
		$function = "<script>\r\nwindow.tempobj=". $dataJs .";\r\nwindow.mobile_mall={};\r\nwindow.mobile_mall.data={};\r\nfor (var i = 0; i < tempobj.component.length; i++) {\r\n\twindow.mobile_mall.data[tempobj.component[i].componentId]=tempobj.component[i]['data'];\r\n};\r\n</script>";
		$html1 = str_replace("{{modDiv}}",$html,$template);
		$html2 = str_replace("{{modCss}}",$css,$html1);
		$html3 = str_replace("{{modJs}}",$function.$js,$html2);
		//根据id去查询他的business，如果为彩票，发布路径不一样
		$businessId = $this->input->post("businessId");
		//echo $html3;
		if($businessId == 5){
			$turl = "http://518.qq.com/sinclude/page/mobile/".$year."/index_".$id.".shtml";
			$dir="/data/vb2c_lottery/web/static/sinclude/page/mobile/".$year;
		}else{
			$turl = "http://chong.qq.com/promote/mobile/".$year."/index_".$id.".shtml";
			$dir='/usr/local/c2c/html/newforward/chong/promote/mobile/'.$year;
		}
		//更新turl	
		$this->mobile_model->update_hot_turl($id,$turl);
		$this->mkdirs($dir);
		$result=file_put_contents($dir.'/index_'.$id.'.shtml',$html3);
		$ret = array(
			'ret' => 1,
			'turl'=> $turl 
			);
		echo json_encode($ret);
	}

	//生成卖场数据文件
	function genData($id,$data){
		$year = date("Y", time());//年份
		$dir = "/usr/local/c2c/html/newforward/static/js/promote/mobile/".$year;
		$this->mkdirs($dir);
		$result=file_put_contents($dir.'/'.$id.'_utf8.js',$data);
		$result=file_put_contents($dir.'/'.$id.'_gbk.js',iconv("UTF-8", "GB2312//IGNORE", $data));
	}

	//creates directory tree recursively
	function mkdirs($path, $mode = 0777)  
	{ 
		$dirs = explode('/',$path); 
		$pos = strrpos($path, "."); 
		if ($pos === false) { 
			$subamount=0; 
		} 
		else { 
			$subamount=1; 
		} 			
		for($c=0;$c < count($dirs) - $subamount; $c++) { 
			$thispath=""; 
			for($cc=0; $cc <= $c; $cc++) { 
				$thispath.=$dirs[$cc].'/'; 
			} 
			if(!file_exists($thispath)) { 
				mkdir($thispath,$mode); 
				@chmod($thispath,0777);
			} 
		} 
	}
	public function pubFile(){
		$id = $this->input->post("id");
		$templateId = $this->input->post("templateId");
		if(!$id){
			return ;
		}
		//根据id去查询他的business，如果为彩票，发布路径不一样
		$info = $this->mobile_model->get_mall_data($id);
		$businessId = $info[0]["business"];

		$files=array();
		$year = date("Y", time());//年份
		if($businessId == 5){
			$files[]="/vb2c_lottery/web/static/sinclude/page/mobile/".$year."/index_".$id.".shtml";
		}else{
			$files[]='/usr/local/c2c/html/newforward/chong/promote/mobile/'.$year.'/index_'.$id.'.shtml';
		}
		$this->changeMallStatus($id);
		echo $this->EOS($files,'移动端卖场活动页面发布:'.$id,1,4,1);
	}

	public function EOS($files,$desc,$begin,$end,$exec){
		require_once("class.HttpClient.php");
		$client = new HttpClient('eos3.paipaioa.com');
	    // 定时发布时无法获取$_SESSION['userName']，所以允许用户传入参数——"执行者"
	    if(!isset($_COOKIE['userName'])){
	    	return '请先登录oa系统再进行发布操作！';
	    }
	    $exeuser = $_COOKIE['userName'] ? $_COOKIE['userName'] : '';
		
		$arrHost =array(1=>"dev",2=>"beta",3=>"gamma",4=>"idc");
		$eosInfo=array(	
						'exeuser'=>	$exeuser,		
						'benv' 	=> $arrHost[$begin],
						'eenv' 	=> $arrHost[$end],
						'files'	=> implode(",",$files),
						'isexec'=> $exec,   //是否执行:"true"|"false"
						'subject'=>$desc);
		$msg=$client->post('/api/APIAction_PageAddMission.xhtml',$eosInfo);
		if (!$msg) {
			die('同步出错，错误如下: '.$client->getError());
		}
		//返回json格式：
		//{"retCode":"100","retId":"0","retMessage":"系统未知错误"}
		$pageContents = $client->getContent();
		$returnMsg = explode(",",$pageContents);
		$retId = explode(":",$returnMsg[1]);
		$errorMsg = explode(":",$returnMsg[2]);
		if ($retId[1] >0){
			return $exec==0?'发布任务创建成功，请登录Eos执行。':'发布成功。';
		}else{
			return '发布任务创建失败，错误信息如下：'.$errorMsg[1];
		}
	}
	 


}