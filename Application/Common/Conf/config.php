<?php
/**
 * Created by PhpStorm.
 * User: 1543
 * Date: 16/9/13
 * Time: 下午2:10
 */

$common_config = 'define,db,redis,api, wechat';
$module_config = 'admin,jinr_partner,wechat'; //'huodong1,huodong2,...'
$load_ext_config = $common_config.','.$module_config;

return array(
    //'配置项'=>'配置值'
    'LOAD_EXT_CONFIG' => $load_ext_config, //配置扩展
    'DEFAULT_MODULE'  => 'Admin',          // 默认模块
    'URL_MODEL'       => 2,                // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
);
