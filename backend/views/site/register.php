<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Pregunta;
use frontend\models\Sadepo;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Registro';
$this->registerJsFile('@web/js/index.js');
?>

<h3 id='msj_principal'><?= $msg ?></h3>
<br />

<div class="register-form">

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'id' => 'formulario',
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
    ]);
    ?>

    <center>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Crear' : '<i class="fa fa-save"></i> Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </center>

    <div class="container-fluid">
        <div class="col-md-3">
            <?= $form->field($model, 'usuario')->textInput(['maxlength' => true,'enableAjaxValidation' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'cedula')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'sexo')->dropDownList(['F' => 'Femenino', 'M' => 'Masculino']); ?>
        </div>
    </div>

    <div class="container-fluid">
        <div class="col-md-3">
            <?= $form->field($model, 'clave')->textInput(['maxlength' => true, 'type' => 'password']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'repetir_clave')->textInput(['maxlength' => true, 'type' => 'password']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>
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

        <div class="col-md-3">
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'CodUbic')->dropDownList(ArrayHelper::map(Sadepo::find()->where(['activo' => '1'])->OrderBy('Descrip')->all(), 'CodUbic', 'CodUbic', 'Descrip')); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>