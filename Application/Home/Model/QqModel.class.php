<?php
namespace Home\Model;
use Think\Model;

class QqModel extends Model {

	public function __construct() {
		parent::__construct();
		$this->host = $_SERVER['HTTP_HOST'];
	}

	public function getBackurl() {
		return urlencode( "http://{$this->host}/Login/qqLogin" );
	}

	public function getLoginurl() {
		$qq_state = md5(uniqid(rand(), TRUE));
		$_SESSION['qq_state'] = $qq_state;
		$url = $this->getBackurl();
		$qqurl = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=101374694&redirect_uri={$url}&scope=get_user_info&state={$qq_state}";
		return $qqurl;
	}

}