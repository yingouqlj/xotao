<?php
/**
 * 
 * 
 * @author yingouqlj|yingouqlj@gmail.com
 * @since 1.0, 2012-11-02 14:26:25
 * 
 * 说明:http://rate.taobao.com/rate.htm?spm=a1z02.1.1000291.d1000296.TSeauy&userId=49093952
 */

class rateTaobaoRate extends xoTao
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
		$resp=$this->curl("http://rate.taobao.com/rate.htm?spm=a1z02.1.1000291.d1000296.TSeauy&userId={$this->userId}");

			$a=$this->ganon($resp);
			$this->user['wangwang']=$a('span.J_WangWang', 0)->__get('data-nick');
			$this->user['buyerrate']=$a('a#J_BuyerRate', 0)->getInnerText();
		print_r($this->user);

	}
	}
