<?php
/**
 * Created by PhpStorm.
 * User: 1543
 * Date: 16/9/22
 * Time: 下午3:15
 */

namespace Common\Base;

class ApiZZCallService
{
    public static function post($path, $data)
    {
        try {
            $data_encrypt = self::encryption($data);
            $url = self::buildUrl($path);
            $result = self::sendPost($url, $data_encrypt);
            $result = self::decryption($result);
            if ($result['code'] == JR_SUCCESS) {
                return self::response($result['data']);
            } else {
                $result['code'] = empty($result['code']) ? JR_ERROR : $result['code'];
                return self::responseError($result['code'], $result['msg']);
            }
        } catch (\Exception $e) {
            return self::responseError(JR_EXCEPTION_ERROR, $e->getMessage());
        }
    }
    
    private static function buildUrl($path)
    {
        $domain = 'http://jrdev32.jingyubank.com/';
        return $domain.$path;
    }
    
    private static function responseError($code, $msg = '')
    {
        return self::response('', $code, $msg);
    }

    private static function response($data, $code = JR_SUCCESS, $msg = '')
    {
        return array(
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        );
    }

    /**
     * 加密
     * $param 明文(字符串or数组)
     * @author 629
     */
    private static function encryption($param) {
        if(!$param){
            return false;
        }
        //加密
        $Crypt = new CryptService(C('API.SECRET_KEY_HB'), C('API.SECRET_MODEL_HB'));
        $m_str = $Crypt->encrypt(json_encode($param));
        if($m_str){
            return array(
                'cipher' => $m_str
            );
        }else{
            return false;
        }
    }

    private static function decryption($param)
    {
        if (!$param) {
            return false;
        }
        //解密
        $m_result = json_decode(trim($param, chr(239) . chr(187) . chr(191)), true);   //从主站那边传值过来经常有bom，非常坑爹
        $Crypt = new CryptService(C('API.SECRET_KEY_HB'), C('API.SECRET_MODEL_HB'));
        $result = json_decode($Crypt->decrypt($m_result['cipher']), true);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 发送post请求
     * @param $url
     * @param array $data
     * @return bool 失败返回false
     */
    private static function sendPost($url, $data = array()) {
        if (empty($url)) {
            return false;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
//        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);    //注意，毫秒超时一定要设置这个  
//        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 200);  //超时毫秒，cURL 7.16.2中被加入。从PHP 5.2.3起可使用  
        
        ob_start();
        curl_exec($ch);
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
}
