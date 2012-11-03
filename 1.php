<?php
	ini_set('display_errors','On');
	error_reporting('E_ALL');
include 'xxooTao.php';
include 'XXOO/amTaobaoRateList.php';
$a=new amTaobaoRateList;
$a->setNumIid(12618009654);
$a->exec();
/* 
* 
*
include 'XXOO/rateTaobaoRate.php';
$a=new rateTaobaoRate;
$a->setUserId(49093952);
$a->exec();
* 
*/
include 'XXOO/rateTaobaoMemberRate.php';
$a=new rateTaobaoMemberRate;
$a->setUserId(53309297);
$a->exec();
?>
