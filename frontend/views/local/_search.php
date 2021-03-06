<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LocalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="local-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_local') ?>

    <?= $form->field($model, 'CodClie') ?>

    <?= $form->field($model, 'id_ubicacion') ?>

    <?= $form->field($model, 'id_piso') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'metro') ?>

    <?php // echo $form->field($model, 'alquiler') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
