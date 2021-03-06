<?php

namespace frontend_api\models;

use Yii;
use yii\db\Query;

class BetModel extends \yii\base\Model {

    /**
     * **********************************************************
     *  根据play_id获取gameplay   @author ruizuo qiyongsheng    *
     * **********************************************************
     */
    public static function getGameplayById($where) {
        return (new \yii\db\Query)
                        ->select('gameplay')
                        ->from(\Yii::$app->manage_db->tablePrefix . 'fc_games_set')
                        ->where($where)
                        ->scalar(\Yii::$app->manage_db);
    }


    /**
     * **********************************************************
     *  查询代理名称           @author ruizuo qiyongsheng    *
     * **********************************************************
     */
    public static function getAgentInfo($id) {
        return (new \yii\db\Query)
                        ->select('login_user,money')
                        ->from(\Yii::$app->db->tablePrefix . 'user_agent')
                        ->where(['id' => $id])
                        ->one(\Yii::$app->db);
    }

    /**
     * **********************************************************
     *  更改用户金额            @author ruizuo qiyongsheng    *
     * **********************************************************
     */
    public static function updateUserMoney($set, $where) {
        return Yii::$app->db
                        ->createCommand()
                        ->update(\Yii::$app->db->tablePrefix . 'user', $set, $where)
                        ->execute();
    }

    /**
     * **********************************************************
     *  更改代理金额            @author ruizuo qiyongsheng    *
     * **********************************************************
     */
    public static function updateAgentMoney($set, $where) {
        return Yii::$app->db
                        ->createCommand()
                        ->update(\Yii::$app->db->tablePrefix . 'user_agent', $set, $where)
                        ->execute();
    }

    /**
     * **********************************************************
     *  批量插入注单           @author ruizuo qiyongsheng    *
     * **********************************************************
     */
    public static function insertBet($field, $insert) {
        return Yii::$app->db
                        ->createCommand()
                        ->batchInsert(\Yii::$app->db->tablePrefix . 'bet_record', $field, $insert)
                        ->execute();
    }
    /**
      ***********************************************************
      *  原生sql                 @author ruizuo qiyongsheng    *
      ***********************************************************
    */
    public static function insert($sql){
        return \Yii::$app->db
                ->createCommand($sql)
                ->execute();
    }

    /**
     * **********************************************************
     *  插入会员现金纪录           @author ruizuo qiyongsheng    *
     * **********************************************************
     */
    public static function insertCashRecord($tab, $data) {
        return Yii::$app->db
                        ->createCommand()
                        ->Insert(\Yii::$app->db->tablePrefix . $tab, $data)
                        ->execute();
    }

    /**
     * **********************************************************
     *  钱包模式下注失败纪录         @author ruizuo qiyongsheng    *
     * **********************************************************
     */
    public static function insertErrorCashRecord($data) {
        return Yii::$app->manage_db
                        ->createCommand()
                        ->Insert(\Yii::$app->manage_db->tablePrefix . 'wallet_error', $data)
                        ->execute();
    }

    /**
     * **********************************************************
     *  会员注单查询           @author ruizuo qiyongsheng    *
     * **********************************************************
     */
    public static function getUserBetsCount($where) {
        return (new \yii\db\Query)
                        ->select('count(*)')
                        ->from(\Yii::$app->db->tablePrefix . 'bet_record')
                        ->where($where)
                        ->scalar(\Yii::$app->db);
    }
    /**
     * **********************************************************
     *  会员注单查询           @author ruizuo qiyongsheng    *
     * **********************************************************
     */
    public static function getUserBets($where,$limit = 100) {
        return (new \yii\db\Query)
                        ->select('*')
                        ->from(\Yii::$app->db->tablePrefix . 'bet_record')
                        ->where($where)
                        ->limit($limit)
                        ->all(\Yii::$app->db);
    }
    /**
      ***********************************************************
      *  注单写入mongo数据库           @author ruizuo qiyongsheng    *
      ***********************************************************
    */
    public static function insertMongoBets($data){
        return Yii::$app->mongodb
                ->getCollection('bets')
                ->batchInsert($data);
    }
        
}
