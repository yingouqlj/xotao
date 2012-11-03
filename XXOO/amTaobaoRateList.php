<?php
/**
 * 
 * 
 * @author yingouqlj|yingouqlj@gmail.com
 * @since 1.0, 2012-11-02 14:26:25
 * 
 * 说明:通过手机触屏版AJAX返回的数据http://a.m.taobao.com/ajax/rate_list.do?item_id={}&rateRs=1&p=1&ps=10
 */

class amTaobaoRateList extends xxooTao
{
	/** 
	 * 商品的数字id
	 **/
	private $numIid;
	
	/** 
	 * 当前页
	 **/
	private $pageNo=1;
	
	/** 
	 * 每页显示的条数，允许值：5、10、20、40
	 **/
	private $pageSize=10;
	
	/** 
	 * 商品所属的卖家nick
	 **/

	
	
		public function setNumIid($numIid)
	{
		$this->numIid = $numIid;
	}
	
	public function setPageNo($page)
	{
		$this->pageNo=$page;
		}
		
	public function setPageSize($size)
	{
		$this->pageSize=$size;
		}
		
	public function setRateRs()
	{
		
		}
				
	public function exec(){
		$resp=$this->curl("http://a.m.taobao.com/ajax/rate_list.do?item_id={$this->numIid}&rateRs=1&p={$this->pageNo}&ps={$this->pageSize}");

			$respObject = json_decode($resp,TRUE);
			print_r($respObject);	
			
		
	}
	}
