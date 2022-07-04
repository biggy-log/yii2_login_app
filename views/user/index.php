<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
                        [
                'label' => 'Avatar',
                'attribute' => 'avatar_path',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(Yii::getAlias('@web').'/uploads/'.$data['avatar_path'],['width' => '70px']);
                },
            ],
            //'created_at',
            //'updated_at',
            'username',
            //'organization_id',
            [
                'label' => 'Organization',
                'attribute' => 'organization_id',
                'format' => 'raw',
                'value' => function($data){
                    return $data->getOrganization()->one()->name;
                }
            ],
            'job_title',
            //'file',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            //'status',
            [
                'label' => 'File',
                'attribute' => 'file_path',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data['file_path']) {
                        return Html::a($data['file_path'], ['site/download', 'file' => $data['file_path']]);
                    } else {
						return "";
					}
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'header'=>"Actions",
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return '';
                    },
                    'view' => function ($url, $model, $key) {
                        return '';
                    },
                ],
            ],
        ],
    ]); ?>


</div>
