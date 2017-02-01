<!--片段缓存-->
<?php
$duration = 10;//过期时间（duration）
//设置缓存依赖
$dependency =[
    "class"=>"yii\caching\FileDependency",
    "fileName" =>"robots.txt"
];
//设置缓存开关
//官方文档为['enabled' => Yii::$app->request->isGet]
$enabled = true;//可以使用 true=>开启 false=>关闭
?>

<!--
片段缓存的嵌套 评论被缓存在里层，同时整个评论的片段又被缓存在 外层的文章中。
外层的失效时间应该短于内层，外层的依赖条件应该低于内层，以确保最小的片段，返回的是最新的数据
-->
<?php if ($this->beginCache ("cache_outer_div",['duration' => 20]/*,["enabled" =>$enabled],["dependency"=>$dependency] 第二个参数可以设置过期时间,缓存依赖,缓存开关等*/)){  ?>
    <div id="cache_outer_div">
        <div> 这里是外嵌套</div>
        <?php if ($this->beginCache("cache_inner_div",["duration"=>10])){ ?>
            <div id="cache_inner_div">
                <div>这里是内嵌套</div>
            </div>
            <?php $this->endCache(); } ?>
    </div>
    <?php $this->endCache(); }?>

<!--http 缓存 -->
<div>
    <div><?=$new;?></div>
</div>



<!--<h1>Hello </h1>-->
<?php echo $this->render("about",array("v"=>"yy"));?>
<!--定义数据块-->
<?php $this->beginBlock('block1');?>
<h1>yu</h1>
<?php $this->endBlock();?>


