<?php
/**
 * Created by PhpStorm.
 * User: luka-chen
 * Date: 16/9/13
 * Time: 下午2:10
 */
return array(
    'JINRPARTNER' => array(
        'BONUS'=>array( //利率配比
            "1" => array ( //等级为1 的  三层计算比例
                array(1, 0.6, 0.4)
            ),
            "2" => array ( //等级为2 的  三层计算比例
                array(1.1, 0.7, 0.5)
            ),
            "3" => array (//等级为3的  三层计算比例
                array(1.2, 0.8, 0.6)
            ),
        ),
        'LEVEL'=>array( //等级配置
            '0'=>'0-5000',
            '1'=>'5000-20000',
            '2'=>'20000-50000',
            '3'=>'50000-',
        )
    )
);