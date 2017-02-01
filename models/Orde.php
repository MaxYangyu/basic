<?php
/**
 * Created by PhpStorm.
 * User: yangyu
 * Date: 2017/1/8
 * Time: 19:46
 */
namespace app\models;
use yii\db\ActiveRecord;
class Orde extends ActiveRecord{
       public function getCustomer(){
           $Customer = $this->hasOne(Customer::className(),["id"=>"customer_id"])->asArray()->all();//关联的字段['关联表的外键'=>'本表中的外键']
           return $Customer;
       }

}
