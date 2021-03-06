<?php

namespace frontend_api\controllers;

use Yii;
use frontend_api\models\CommonModel;
use common\helpers\Helper;

class Controller extends \common\controllers\Controller {

    //默认布局文件为main.html
    public $layout = 'main.html';
    //用户信息
    public $user;

    public function beforeAction($action) {
        // 指定允许其他域名访问  
        header('Access-Control-Allow-Origin:*');

        $this->checkUser();

        return parent::beforeAction($action);
    }

    public function checkUser() {
        $isMobile = Helper::isMobile();
        if ($isMobile) {
            $client = 2;
        } else {
            $client = 1;
        }

        $post = Yii::$app->request->post();
        /* if (!isset($post['token'])) {
          $data = [
          'ErrorCode' => 10000,
          'ErrorMsg' => 'params error(empty token)!'
          ];
          echo json_encode($data);
          }

          $token = $post['token']; */
        if (!isset($post['token']) || empty($post['token']) || $post['token'] == '8c6ef8bba0848b70df59ceabed04f415') {
            $user = [
                'uid'       => 1,
                'uname'     => 'daizi',
                'agent_id'  => 3082,
                'ua_id'     => 3077,
                'sh_id'     => 3076,
                'line_id'   => 'aaa',
                'client'    => $client,
                'is_shiwan' => 1, //是否试玩
            ];
        } else {
            $redis = Yii::$app->redis;
            $user_json = $redis->hget('userOnLine_front', $post['token']);

            //取不到用户信息
            if (empty($user_json)) {

                //请重新登录
                echo json_encode(['ErrorCode' => 10000, 'ErrorMsg' => 'please login again']);
                die;
            }

            //更新在线时间
            $user_arr = json_decode($user_json, true);
            $user_arr['time'] = time();
            $redis->hset('userOnLine_front', $post['token'], json_encode($user_arr, true));

            $user = json_decode($user_json, true);
            $user['client'] = $client;
        }

        $user['is_wallet'] = false;//是否钱包模式
        $user = (object) $user;
        //var_dump($user);die;
        $this->user = $user;

        $maintain = $this->game_is_maintain(1, $this->user->client, $this->user->line_id);
        if ($maintain['return'] == 2) {
            echo json_encode(['ErrorCode' => 10001, 'ErrorMsg' => 'sites maintenance : ' . $maintain['remark'], 'Data' => $maintain]);
            die;
        }
    }

    //我喜欢的彩种(公共方法不要瞎改)
    public function getMyLovesFc() {
        $uid = $this->user->uid;
        $agent_id = $this->user->agent_id;
        $line_id = $this->user->line_id;
        $redis = Yii::$app->redis;
        //我喜欢的
        $redis_key = 'loveFcType_' . $agent_id . '_' . $uid;
        $redis_data = $redis->get($redis_key);
        if (!empty($redis_data)) {
            $like_data = json_decode($redis_data, true);
        } else {
            $where = [
                'uid' => $uid,
                'agent_id' => $agent_id,
                'line_id' => $line_id
            ];
            $like_data = CommonModel::getMyLoveFcTypes($where);
            if (!empty($like_data)) {
                $redis->set($redis_key, json_encode($like_data));
            }
        }
        return $like_data;
    }

    /*
     * 根据彩种类型获取赔率
     * 
     * my_line_odds 
     * my_agent_odds 
     * my_fc_games_type
     * 
     */

    public function getOddsByFcType($fc_type, $pankou = 'A', $gameplay = '') {
        $line_id = $this->user->line_id;
        $sh_id = $this->user->sh_id;
        $ua_id = $this->user->ua_id;
        $agent_id = $this->user->agent_id;
        $uid = $this->user->uid;

        $redis = Yii::$app->redis;
        //获取代理赔率
        $odds_key = 'fc_odds_' . $line_id . '_agent_id_' . $agent_id . $pankou;
        $odds = $redis->hget($odds_key, $fc_type);
        if (empty($odds)) {
            //获取初始赔率
            $init_key = 'init_fc_odds_' . $pankou;
            $init_odds = $redis->hget($init_key, $fc_type);
            if (empty($init_odds)) {
                $init_odds = CommonModel::getInitOddsByFcType($fc_type, $pankou);
                $redis->hset($init_key, $fc_type, json_encode($init_odds, true));
            } else {
                $init_odds = json_decode($init_odds, true);
            }
            //代理赔率
            $at_odds = CommonModel::getAgentOddsByFcType($fc_type, $agent_id, $pankou);
            //获取总代赔率
            $ua_odds = CommonModel::getUaOddsByFcType($fc_type, $ua_id, $pankou);
            //获取股东赔率
            $sh_odds = CommonModel::getShOddsByFcType($fc_type, $sh_id, $pankou);
            //获取线路赔率
            $line_odds = CommonModel::getLineOddsByFcType($fc_type, $line_id, $pankou);
            //合并之后的赔率
            $odds = $this->reGroup($at_odds, $ua_odds, $sh_odds, $line_odds, $init_odds, 'remark'); //remark是唯一，合并的依据

            $redis->hset($odds_key, $fc_type, json_encode($odds, true));
        } else {
            $odds = json_decode($odds, true);
        }
        if (($fc_type == 'liuhecai' || $fc_type == 'jsliuhecai') && $gameplay && $odds) {
            $odds = $this->getLiuhecaiOdds($odds, $gameplay);
        }
        //处理成前台需要(按玩法顺序依次排列)
        $return = [];
        foreach ($odds as $k => $v) {
            $v['id'] = $k;
            $return[] = $v;
        }
        return $return;
    }

    //重组设置赔率、限额和初始赔率、限额
    public function reGroup($at, $ua, $sh, $line, $init, $column) {
        if (!empty($at)) {
            $temp_key = array_column($at, $column);
            $at = array_combine($temp_key, $at);
        }
        if (!empty($ua)) {
            $temp_key = array_column($ua, $column);
            $ua = array_combine($temp_key, $ua);
        }
        if (!empty($sh)) {
            $temp_key = array_column($sh, $column);
            $sh = array_combine($temp_key, $sh);
        }
        if (!empty($line)) {
            $temp_key = array_column($line, $column);
            $line = array_combine($temp_key, $line);
        }
        if (!empty($init)) {
            $temp_key = array_column($init, $column);
            $init = array_combine($temp_key, $init);
        }
        $init_result = array_merge($init, $line, $sh, $ua, $at);
        $init_result = array_values($init_result);
        return $init_result;
    }

    //获取六合彩单玩法赔率
    public function getLiuhecaiOdds($odds, $gameplay) {
        $arr = array();
        foreach ($odds as $val) {
            if ($gameplay == $val['gameplay']) {
                $arr[] = $val;
            }
        }
        return $arr;
    }

    /*
     * 根据彩种类型获取限额
     * 
     * my_line_limit_set
     * my_agent_limit_set
     * my_fc_games_set
     * 
     */

    public function getLimitByFcType($fc_type, $pankou = 'A') {
        $line_id = $this->user->line_id;
        $sh_id = $this->user->sh_id;
        $ua_id = $this->user->ua_id;
        $agent_id = $this->user->agent_id;
        $uid = $this->user->uid;
        $redis = Yii::$app->redis;
        //获取代理限额
        $limit_key = 'fc_limit_' . $line_id . '_agent_id_' . $agent_id . $pankou;
        $limit = $redis->hget($limit_key, $fc_type);
        if (empty($limit)) {
            //获取初始限额
            $init_key = 'init_fc_limit';
            $init_limit = $redis->hget($init_key, $fc_type);
            if (empty($init_limit)) {
                $init_limit = CommonModel::getInitLimitByFcType($fc_type);
                $redis->hset($init_key, $fc_type, json_encode($init_limit, true));
            } else {
                $init_limit = json_decode($init_limit, true);
            }
            //代理限额
            $at_limit = CommonModel::getAgentLimitByFcType($fc_type, $agent_id);
            //获取总代限额
            $ua_limit = CommonModel::getUaLimitByFcType($fc_type, $ua_id);
            //获取股东限额
            $sh_limit = CommonModel::getShLimitByFcType($fc_type, $sh_id);
            //获取线路限额
            $line_limit = CommonModel::getLineLimitByFcType($fc_type, $line_id);
            //合并之后的限额
            $limit = $this->reGroup($at_limit, $ua_limit, $sh_limit, $line_limit, $init_limit, 'gameplay'); //gameplay是唯一，合并的依据
            $redis->hset($limit_key, $fc_type, json_encode($limit, true));
        } else {
            $limit = json_decode($limit, true);
        }
        //处理数据
        $return = [];
        foreach ($limit as $k => $v) {
            if (isset($v['gameplay'])) {
                $return[$v['gameplay']] = $v;
            }
        }
        return $return;
    }

}
