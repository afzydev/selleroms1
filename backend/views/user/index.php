<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\AutoComplete;
use common\models\User;
use yii\helpers\ArrayHelper;
use common\extensions\CommonHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
       $user_status = array('1'=>'Active','0'=>'Deactive'); 
       $users = User::find()->select(['value' => "concat(`firstname`)", 'label' => "concat(`firstname`)",'value' => "concat(`lastname`)", 'label' => "concat(`lastname`)"])->asArray()->all();
    ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute' => 'firstname',
              'filter' => AutoComplete::widget([
                    'model'=>$searchModel, 
                    'attribute' => 'firstname',
                    'clientOptions' => 
                    [
                        'source' => $users,          
                    ],
                    'options' => array('class' => 'form-control')
                ]) 
            ],
            [
              'attribute' => 'lastname',
              'filter' => AutoComplete::widget([
                    'model'=>$searchModel, 
                    'attribute' => 'lastname',
                    'clientOptions' => 
                    [
                        'source' => $users,          
                    ],
                    'options' => array('class' => 'form-control')
                ]) 
            ],
             'email:email',
            [
                'attribute' => 'active',
                'value' => function ($model) use ($user_status){
                    return $user_status[$model['active']];
                },
                'filter' => $user_status       
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
