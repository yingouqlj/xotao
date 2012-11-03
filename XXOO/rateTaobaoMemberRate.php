<?php
/**
 * 
 * 
 * @author yingouqlj|yingouqlj@gmail.com
 * @since 1.0, 2012-11-02 14:26:25
 * 
 * 说明:http://rate.taobao.com/rate.htm?spm=a1z02.1.1000291.d1000296.TSeauy&userId=49093952
 * 
 * content:1
result:
from:rate
user_id:49093952
identity:1
rater:1
direction:0
callback:shop_rate_list
* 
* 
 */

class rateTaobaoMemberRate extends xxooTao
{
	/** 
	 * 用户的数字id
	 **/
	private $userId;
	
	private $user;
	
		public function setUserId($userId)
	{
		$this->userId = $userId;
	}
	
				
	public function exec(){
		$resp=$this->curl("http://rate.taobao.com/member_rate.htm?content=1&result=&from=rate&user_id={$this->userId}&identity=1&rater=1&direction=0&callback=shop_rate_list");
//echo trim($resp);
//$resp=trim($resp);
//$resp=str_replace('shop_rate_list(','',$resp);
//$resp=substr($resp,0,-1);
//echo $resp;
		$respObject = $this->_json_decode(trim($resp),TRUE);
			var_dump($respObject);	
	}
	}
