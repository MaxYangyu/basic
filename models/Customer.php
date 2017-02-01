<?php
/**
 * Created by PhpStorm.
 * User: yangyu
 * Date: 2017/1/8
 * Time: 19:46
 */
namespace app\models;
use yii\db\ActiveRecord;
class Customer extends ActiveRecord{
    //帮助顾客获取订单信息
    public function getOrde(){
        $orde = $this->hasMany(Orde::className(),["customer_id"=>"id"])->asArray()->all();//关联的字段['关联表的外键'=>'本表中的外键']
        return $orde;

    }


}