<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Saclie;
use app\models\Ubicacion;
use app\models\Piso;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model app\models\Local */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/local.js');
$this->registerCssFile('@web/css/general.css');
?>

<div class="local-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <label class="control-label">Cánon: </label>
    <?php
         $canon = Yii::$app->db->createCommand("SELECT top(1) canon FROM ISCO_Correl")->queryOne();
         echo "<input readonly='true' class='texto texto-ec' name='canon' id='canon' value='".$canon['canon']."'> Bs.<br /><br />" ;
    ?>
    
    <label class="control-label">Cliente</label>
    <?= Html::activeDropDownList($model, 'CodClie',
      ArrayHelper::map(Saclie::find()->where(['activo' => '1'])->OrderBy('Descrip')->all(), 'CodClie', 'Descrip'), ['class'=>'form-control','prompt'=>'Seleccione']) ?>

    <label class="control-label">Ubicación</label>
    <?= Html::activeDropDownList($model, 'id_ubicacion',
      ArrayHelper::map(Ubicacion::find()->where(['activo' => '1'])->OrderBy('nombre')->all(), 'id_ubicacion', 'nombre'), ['class'=>'form-control','prompt'=>'Seleccione']) ?>

    <label class="control-label">Piso</label>
    <?= Html::activeDropDownList($model, 'id_piso',
      ArrayHelper::map(Piso::find()->where(['activo' => '1'])->OrderBy('nombre')->all(), 'id_piso', 'nombre'), ['class'=>'form-control','prompt'=>'Seleccione']) ?>

    <?= $form->field($model, 'descripcion')->textInput() ?>

    <?= $form->field($model, 'metro')->textInput() ?>
    
    <?= $form->field($model, 'porcentaje')->hiddenInput(['value' => 0])->label(false) ?>

    <?= $form->field($model, 'alquiler')->dropDownList(['0' => 'NO', '1' => 'SI']); ?>
    
    <?= $form->field($model, 'tipo_alquiler')->dropDownList(['0' => 'Monto Fijo', '1' => 'Por Porcentaje', '2' => 'Mixto']); ?>
    
    <?= $form->field($model, 'monto_alquiler')->textInput(['onblur'=>'js:calcula_canon();']) ?>
    
    <?= $form->field($model, 'porcentaje_alquiler')->textInput(); ?>

    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
