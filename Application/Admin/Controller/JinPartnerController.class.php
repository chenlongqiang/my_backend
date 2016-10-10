<?php
/**
 * Created by PhpStorm.
 * User: 1543
 * Date: 16/9/20
 * Time: 上午01:15
 */
namespace Admin\Controller;

class JinPartnerController extends BaseController {

    const EVENT_KEY='GAME_TYPE_XIAN_JIN_HUO_DONG';

    /*
     * 红包审核列表
     */
    public function redList()
    {
        //配置1（获得资格）2（已激活）3（现金已获得）4（活动中断）5(已过期)
        $config = array(
            'page_size' => 20,
            'status' => array(
                '6' => '待审核',
                '3' => '现金已获得',
                '1' => '获得资格',
                '2' => '已激活',
                '4' => '活动中断',
                '5' => '已过期',
            )
        );
        $where = array('event_key'=>array('eq',self::EVENT_KEY));
        $page = I('get.p',1,'intval');

        $result = D('JinrPartner/CashDetail')->getList($where, $page,$config['page_size'], 'id desc');
        $this->assign('page', get_page($result['count'], $config['page_size']));
        $this->assign('list', $result['list']);
        $this->assign('config', $config);
        $this->display('red_list');
    }

    public function updateStatus()
    {
        $id = I('get.id',0,'intval');
        if (!$id) $this->error('操作失败,无效id');
        $r = D('Common/Yield')->BonusHandle($id);
        if ($r) $this->success('操作成功!', U('JinPartner/redList'));
        else $this->error('操作失败');
    }
}