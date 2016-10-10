<?php
/**
 * Created by PhpStorm.
 * User: 1543
 * Date: 16/9/13
 * Time: 上午01:10
 */

namespace Admin\Model;

use Common\Base\BaseModel;

class RoleModel extends BaseModel
{
    
    protected $_auto = array(
        array('c_time', 'gmt_time', self::MODEL_INSERT, 'function'),
        array('u_time', 'gmt_time', self::MODEL_BOTH, 'function'),
    );
    
}