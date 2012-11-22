<?php
/**
 * 
 * 
 * @author yingouqlj@gmail.com
 * @since 1.0, 2012-11-02 14:26:25
 * @link http://github.com/yingouqlj/xotao
 */

class xoTao{
	public $curlString=array();
	private $curl_option=array(
		'proxy'=>array(
				'proxyType'=>false,// 关闭为false 可选 HTTP,SOCKS5 
				'proxyHost'=>'127.0.0.1', //代理的主机地址
				'proxyPort'=>8087,    //代理主机的端口
				'proxyAuth'=>false,   //代理是否要身份认证(HTTP方式时)
				'proxyAuthType'=>'BASIC',  //认证的方式.可选择 BASIC 或 NTLM 方式
				'proxyAuthUser'=>'',  //认证的用户名
				'proxyAuthPwd'=>'', //认证的密码
		),
		'useragent'=>'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/536.11 (KHTML, like Gecko) Ubuntu/12.04 Chromium/20.0.1132.47 Chrome/20.0.1132.47 Safari/536.11 xoTao',		
		'useCookies'=>true,
			);
		public function curl($url, $postFields = null) //函数来自TopClient,扩展了下
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, $this->curl_option['useragent']);
		if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) { 		//https 请求
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		}
		if($this->curl_option['proxy']['proxyType'])
		{
			$proxyType = $this->curl_option['proxy']['proxyType']=='HTTP' ? CURLPROXY_HTTP : CURLPROXY_SOCKS5;
			curl_setopt($ch, CURLOPT_PROXYTYPE, $proxyType);
			curl_setopt($ch, CURLOPT_PROXY, $this->curl_option['proxy']['proxyHost']);
			curl_setopt($ch, CURLOPT_PROXYPORT, $this->curl_option['proxy']['proxyPort']);
			if($this->curl_option['proxy']['proxyAuth'])
			{
				$proxyAuthType = $this->curl_option['proxy']['proxyAuthType']=='BASIC' ? CURLAUTH_BASIC : CURLAUTH_NTLM;
				curl_setopt($ch, CURLOPT_PROXYAUTH, $proxyAuthType);
				$user = "[{$this->curl_option['proxy']['proxyAuthUser']}]:[{$this->curl_option['proxy']['proxyAuthPwd']}]";
				curl_setopt($ch, CURLOPT_PROXYUSERPWD, $user);
			}
		}
		if($this->curl_option['useCookies'])
		{
			$cookfile = tempnam(sys_get_temp_dir(),'xotao');
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookfile);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookfile);
		}
		if (is_array($postFields) && 0 < count($postFields))
		{
			$postBodyString = "";
			$postMultipart = false;
			foreach ($postFields as $k => $v)
			{
				if("@" != substr($v, 0, 1))//判断是不是文件上传
				{
					$postBodyString .= "$k=" . urlencode($v) . "&"; 
				}
				else//文件上传用multipart/form-data，否则用www-form-urlencoded
				{
					$postMultipart = true;
				}
			}
			unset($k, $v);
			curl_setopt($ch, CURLOPT_POST, true);
			if ($postMultipart)
			{
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
			}
			else
			{
				curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
			}
		}
		$reponse = curl_exec($ch);
		
		if (curl_errno($ch))
		{
			throw new Exception(curl_error($ch),0);
		}
		else
		{
			$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if (200 !== $httpStatusCode)
			{
				throw new Exception($reponse,$httpStatusCode);
			}
		}
		curl_close($ch);
		return $reponse;
	}
	public function ganon($str, $return_root = true)
	{
		include 'XXOO/ganon.php';
		$a = new HTML_Parser_HTML5($str);
		return (($return_root) ? $a->root : $a);
		}



	public function simpleHtml($str, $lowercase=true, $forceTagsClosed=true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN=true, $defaultBRText=DEFAULT_BR_TEXT, $defaultSpanText=DEFAULT_SPAN_TEXT)
	{
		include 'XXOO/simple_html_dom.php';
		$dom = new simple_html_dom(null, $lowercase, $forceTagsClosed, $target_charset, $stripRN, $defaultBRText, $defaultSpanText);
		if (empty($str) || strlen($str) > MAX_FILE_SIZE)
		{
			$dom->clear();
			return false;
		}
		$dom->load($str, $lowercase, $stripRN);
		return $dom;
	}
	
	

	
}
