<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap4\Html;
//use yii\bootstrap4\ActiveForm;
use app\models\Organization;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?php
                    $organization = Organization::find()->all();
                    $items = ArrayHelper::map($organization,'id','name');
                    $params = [
                        'prompt' => 'Choose organization'
                    ];
                    echo $form->field($model, 'organization_id')->dropDownList($items,$params);
                ?>
                <?= $form->field($model, 'job_title') ?>

                <?= $form->field($model, 'avatar')->fileInput() ?>
                <?= $form->field($model, 'file_custom')->fileInput() ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>



            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>