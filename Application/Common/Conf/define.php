<?php
/**
 * Created by PhpStorm.
 * User: 1543
 * Date: 16/9/21
 * Time: 上午10:12
 */

define('YEAR_COUNT', 365);//一年按多少天算 add by 1289
//-----------Logic和service、api 的return码----------
define('JR_SUCCESS', 1000); //成功
define('JR_ERROR', 1001);   //失败
define('JR_LOCATION', 1002); //跳转
//-----------ApiCall return 码----------
define('JR_EXCEPTION_ERROR', 10001);   //捕获异常类的失败
