<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/7
 * Time: 20:31
 */
namespace app\modules\models;
use yii\db\ActiveRecord;

class Admin extends ActiveRecord{
    public static function tableName()
    {
        return "{{%admin}}";
    }
}