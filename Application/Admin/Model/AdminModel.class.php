<?php
/**
 * Created by PhpStorm.
 * User: 1543
 * Date: 16/9/18
 * Time: 下午23:56:
 */

namespace Admin\Model;

use Common\Base\BaseModel;

class AdminModel extends BaseModel
{
    
    const SESSION_KEY_ADMIN_AUTH = 'admin_auth';
    
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 2;
    
    const TYPE_ROOT = 0;
    const TYPE_MANAGER = 1;
    const TYPE_USER = 2;

    protected $_auto = array(
        array('c_time', 'gmt_time', self::MODEL_INSERT, 'function'),
        array('password', 'encrypt', self::MODEL_INSERT, 'callback'),
        array('u_time', 'gmt_time', self::MODEL_BOTH, 'function'),
    );

    public function encrypt($password)
    {
        $password_key = C('ADMIN.PASSWORD_KEY');
        return $password === '' ? false : md5(sha1($password) . $password_key);
    }
}