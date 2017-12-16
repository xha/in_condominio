<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CcomercialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ccomercial-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CodVend') ?>

    <?= $form->field($model, 'Descrip') ?>

    <?= $form->field($model, 'TipoID3') ?>

    <?= $form->field($model, 'TipoID') ?>

    <?= $form->field($model, 'ID3') ?>

    <?php // echo $form->field($model, 'DescOrder') ?>

    <?php // echo $form->field($model, 'Clase') ?>

    <?php // echo $form->field($model, 'Direc1') ?>

    <?php // echo $form->field($model, 'Direc2') ?>

    <?php // echo $form->field($model, 'Telef') ?>

    <?php // echo $form->field($model, 'Movil') ?>

    <?php // echo $form->field($model, 'Email') ?>

    <?php // echo $form->field($model, 'FechaUV') ?>

    <?php // echo $form->field($model, 'FechaUC') ?>

    <?php // echo $form->field($model, 'EsComiPV') ?>

    <?php // echo $form->field($model, 'EsComiTV') ?>

    <?php // echo $form->field($model, 'EsComiTC') ?>

    <?php // echo $form->field($model, 'EsComiTU') ?>

    <?php // echo $form->field($model, 'EsComiDT') ?>

    <?php // echo $form->field($model, 'EsComiUT') ?>

    <?php // echo $form->field($model, 'EsComiTM') ?>

    <?php // echo $form->field($model, 'Activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
