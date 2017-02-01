<?php
/**
 * Created by PhpStorm.
 * User: yangyu
 * Date: 2016/12/14
 * Time: 20:05
 */
namespace app\controllers;
use yii\web\Controller;
use yii\web\Cookie;
use app\models\Test;
use app\models\Customer;
use app\models\Orde;
class HelloController extends  Controller{
    //布局文件
    // public  $layout = "comment";

    //页面缓存
    //页面缓存位于控制器 最上方
    //由yii\filters\PageCache 类提供支持
    //behaviors 先于actionIndex 执行
    /*  public function behaviors()
      {                               //如同片段缓存一样 可以设置缓存依赖等参数
          return [[
              'class' => 'yii\filters\PageCache',
              'only' =>["index"],    //多个控制器时 缓存的选择
              "duration" => 20,
              'dependency' => [
                  'class' => "yii\caching\FileDependency",
                  "fileName" => "robots.txt"

              ],

          ]];
      }
    */

    //Http的缓存 设置
    //Last-Modified 头使用时间戳标明页面自上次客户端缓存后是否被修改过
    //“Entity Tag”（实体标签，简称 ETag）使用一个哈希值表示页面内容。如果页面 被修改过，哈希值也会随之改变。
    public function behaviors()
    {
        return[ [
            'class' => 'yii\filters\HttpCache',
            "lastModified" =>function(){
                filemtime("hw.txt");
                //return 1432817596;
            },
            "etagSeed" =>function(){
                $file = fopen("hw.txt","r");
                $tittle = fgets($file);
                fclose($file);
                return $tittle;
                //return "etagseed89";

            }

        ]];

    }

    public function actionIndex(){
        /* $request = \YII::$app ->request;
        echo $request ->get('id',20);
        echo $request->post('name',333);
        if ($request->isGet){
           echo 'this is get method !';
        }
        echo $request->userIp;
        echo 'Hello World';
    */
        //响应
        /*$res = \YII::$app->response ;
          $res ->statusCode = '404';//状态码
          $res ->headers ->add('pragma','no-cache');//增加http头部
          $res ->headers ->set('pragma','max-age=5');//修改http头部
          $res ->headers ->remove('pragma');//删除
          //跳转
          $res -> headers ->add('location','http://www.qidian.com');
          $this ->redirect("http://www.qidian.com",302);//yii内置函数
          //文件下载
          $res ->headers ->add('content-disposition','attachment;filename="a.jpg"');
          $res ->sendFile('./robots.txt');//yii内置函数
        */

        //session处理
        //$session = \YII::$app ->session;
        //$session ->open();
        /*if ($session ->isActive){
            echo 'session is active';
        }
        */
        //$session ->set('user','杨宇');//写入数据
        //echo $session ->get('user');//输出数据
        //$session ->remove('user');//删除数据
        //$session['user'] = '杨宇';//写入数据
        //unset($session['user']);//删除数据

        //cookies
        /*
        $cookies = \YII::$app ->response ->cookies;
        $cookies ->add(new \yii\web\Cookie(["name" => "user","value" =>"yangyu",]));// 在要发送的响应中添加一个新的cookie
        $cookies->remove("user");// 删除一个cookie
        unset($cookies["user"]);// 等同于上方删除代码
        */
        //Cookies 请求
        //$cookie = \yii::$app->request->cookies;
        //$language = $cookie->getValue("_csrf","20");// 获取名为 "user" cookie 的值，如果不存在，返回默认值"20"
        //echo $language;

        //引入view视图文件
        /*  $World ="World<script>alert(5)</script>";
          $data = array();
          $data["view_World"] = $World;
          return $this->renderPartial("index",$data);
        */

        //  return $this->render("index");//index 放入content

//查询数据
        // $sql ="select * from test  ";
        //$results = Test::findBySql($sql)->all();//findBySql 为继承的Test中的ActiveRecord方法
        //yii内置函数
        //id=1
        //$results = Test::find()->where(["id"=>1])->all();

        //id>0
        //$results = Test::find()->where([">","id",0])->all();

        //id>=1&id<=2
        //$results = Test::find()->where(["between","id",1,2])->all();

        //title like "%title%"
        //$results = Test::find()->where(["like","tittle","tittle1"])->all();

        //查询结果转化为数组
        // $results = Test::find()->where(["like","tittle","tittle"])->asArray()->all();
        // print_r(($results));
        //批量查询
        /*  foreach (Test::find()->batch(2) as $tests){
              print_r(count($tests));
          }
        */

        //删除数据
        // $results = Test::find()->where(["id"=>1])->all();
        //$results[0]->delete();
        ////Test::deleteAll("id>:id",array(":id"=>0));//占位符功能,不传参数 ，删除所有数据 ，传参数 按条件删除

        //添加数据 在数据表模型中添加 rules() 方法，利用验证器组件  对添加字段的内容进行验证。
        // 在action 中给字段赋值之后， 调用validate()验证添加的规则 ; 以及  hasErrors() 判断是否出现错误
        /* $test = new Test;
        $test->id = 4;
        $test->tittle = "tittle4";
        $test->validate();//调用validate()验证添加的规则
        if ($test->hasErrors()){    // hasErrors() 判断是否出现错误
            echo "data is error";
            die();
        }
        $test ->save();
        */

        //修改数据
        /* $test = Test::find()->where(["id"=>4])->one();
         $test->tittle ="tittle4";
         $test->save();
        */

        //根据顾客查询他的订单的信息
        // $customer = Customer::find()->where(["name"=>"zhangsan"])->one();
        //  $orde = $customer->hasMany(Orde::className(),["customer_id"=>"id"])->asArray()->all();//app\models\Orde可以改成Orde::className()
        //  $orde = $customer->getOrde();
        // $orde =$customer->orde;
        // print_r($orde);
        // unset($customer->orde);//清除关联查询结果缓存

        //根据订单查询顾客
        /* $orde = orde::find()->where(["id"=>"1"])->one();
           $customer = $orde->Customer;
           print_r($customer);
         */

        //获取缓存组件
        //  $cache = \Yii::$app->cache;

        /*//缓存的增删改查
        //将指定数据存放到缓存中
        $cache->add("key1","hello world");
        $cache->add("key2","YY")
        //将一项数据指定一个键，存放到缓存中
        $cache->set("key1","ok");
        //通过一个键，删除缓存中对应的值
        $cache->delete("key1");
        //删除缓存中的所有数据
        $cache->flush();
        //通过一个指定的键（key）从缓存中取回一项数据
        $data = $cache->get("key1");
        print_r($data);
        */

        //缓存数据有效期设置
        //add新增不覆盖，set不论有没有，直接覆盖；
        //  $cache->add("key","hello",15);
        //  $cache->set("key","hello world",15);
        //  echo $cache->get("key");

        //文件依赖
        /*   $dependency = new \yii\caching\FileDependency(['fileName' => 'robots.txt']);//文件缓存 如果文件的最后修改时间发生变化，则依赖改变。
           $cache->add("key5","hello world ",30,$dependency);
           var_dump($cache->get("key5"));
        */

        //php的依赖
        //如果指定的 PHP 表达式执行结果发生变化，则依赖改变。
        /*  $dependency = new \yii\caching\ExpressionDependency(
            ["expression"=>'\YII::$app->request->get("name")']  //expression 为php代码依赖
        );
        $cache->add("key6","hello  world",30,$dependency);
        var_dump($cache->get("key6"));
     */

        //SQL 的依赖
        /*   $dependency = new  \yii\caching\DbDependency(
               ["sql"=>'SELECT count(*) FROM yii.orde']
           );
           $cache->add("db_key","hello world",30,$dependency );
           var_dump($cache->get("db_key"));
        */


        //片段缓存
        // return $this->renderPartial("index");//在View中index中写beginCache endCache 方法 进行缓存

        //http 缓存
        $content =file_get_contents("hw.txt");
        return $this->renderPartial("index",["new"=>$content]);



    }
}
