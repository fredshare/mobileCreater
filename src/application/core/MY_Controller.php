<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

//接口控制
//require_once APPPATH . 'libraries/platform/web_stub_cntl.php';

class MY_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();		
    }
	protected $content = '';
	protected $data = array();
	
	// 组合输出
	protected function view($type = 'html') {
		// 可选 $type = html | json
		if($type == 'html'){
			$this->parser->parse($this->content, $this->data);
		}else if($type == 'json'){
			$template = $this->parser->parse($this->content, $this->data, true);
			//这是为了兼容json的输出
			$template = str_replace(array(',]',',}'), array(']', '}'));
			$this->output->append_output($template);
		}
	}
}

