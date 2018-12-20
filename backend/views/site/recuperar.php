<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Pregunta;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Recuperar Usuario';
$this->registerJsFile('@web/js/index.js');
?>
<?= ercling\pace\PaceWidget::widget(); ?>
<h3 id='msj_principal'><?= $msg ?></h3>
<br />

<div class="recuperar-form">

    <?php $form = ActiveForm::begin(); ?>

    <center>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Actualizar' : '<i class="fa fa-save"></i> Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </center>

    <div class="container-fluid">
        <div class="col-md-3">
            <?= $form->field($model, 'usuario')->textInput(['maxlength' => true,'enableAjaxValidation' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'clave')->textInput(['maxlength' => true, 'type' => 'password']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'repetir_clave')->textInput(['maxlength' => true, 'type' => 'password']) ?>
        </div>
    </div>
    <div class="container-fluid">
        <div class="col-md-3">
            <label class="control-label">Pregunta</label>
            <?= Html::activeDropDownList($model, 'id_pregunta',
              ArrayHelper::map(Pregunta::find()->where(['activo' => '1'])->OrderBy('descripcion')->all(), 'id_pregunta', 'descripcion'), ['class'=>'form-control']) ?>

            <br />
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'respuesta_seguridad')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>