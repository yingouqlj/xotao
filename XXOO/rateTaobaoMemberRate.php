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

class rateTaobaoMemberRate extends xoTao
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
		exit("JSON暂未解决");
		$resp=$this->curl("http://rate.taobao.com/member_rate.htm?content=1&result=&from=rate&user_id={$this->userId}&identity=1&rater=1&direction=0&callback=shop_rate_list");
$resp=iconv('GBK','UTF-8',$resp);
echo $resp;

		$respObject = json_deocde(trim($resp),TRUE);

	}
	}
