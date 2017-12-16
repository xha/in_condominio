<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Sadepo;

/* @var $this yii\web\View */
/* @var $model frontend\models\Ccomercial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ccomercial-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <center class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </center>

    <?= $form->field($model, 'CodVend')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'Descrip')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'Direc1')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'Direc2')->textInput(['maxlength' => 60]) ?>

    <div class="col-md-4">
        <?= $form->field($model, 'Telef')->textInput(['maxlength' => 15]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'Movil')->textInput(['maxlength' => 15]) ?>
    </div>
    
    <div class="col-md-4">
        <?= $form->field($model, 'Email')->textInput(['maxlength' => 60]) ?>
    </div>
    
    <div class="col-md-4">
        <?= $form->field($model, 'Activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>
    </div>
    
    <?= $form->field($model, 'DescOrder')->hiddenInput(['value'=>Yii::$app->user->identity->CodUbic])->label(false); ?>
    <?= $form->field($model, 'Clase')->hiddenInput(['value'=>'SERIE'])->label(false); ?>
    <?= $form->field($model, 'TipoID3')->hiddenInput(['value'=>0])->label(false); ?>
    <?= $form->field($model, 'TipoID')->hiddenInput(['value'=>0])->label(false); ?>
    <?= $form->field($model, 'ID3')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'FechaUV')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'FechaUC')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'EsComiPV')->hiddenInput(['value'=>0])->label(false); ?>
    <?= $form->field($model, 'EsComiTV')->hiddenInput(['value'=>0])->label(false); ?>
    <?= $form->field($model, 'EsComiTC')->hiddenInput(['value'=>0])->label(false); ?>
    <?= $form->field($model, 'EsComiTU')->hiddenInput(['value'=>0])->label(false); ?>
    <?= $form->field($model, 'EsComiDT')->hiddenInput(['value'=>0])->label(false); ?>
    <?= $form->field($model, 'EsComiUT')->hiddenInput(['value'=>0])->label(false); ?>
    <?= $form->field($model, 'EsComiTM')->hiddenInput(['value'=>1])->label(false); ?>

    <?php ActiveForm::end(); ?>

</div>
