<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Saclie;
use app\models\Ubicacion;
use app\models\Piso;
use frontend\models\Ccomercial;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model app\models\Local */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/local.js');
$this->registerCssFile('@web/css/general.css');
?>
<?= ercling\pace\PaceWidget::widget(); ?>
<div class="local-form">

    <?php $form = ActiveForm::begin(); ?>

    <center>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Crear' : '<i class="fa fa-save"></i> Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </center>

    <div class="row">
        <label class="control-label">Canon:</label>
        <input id='canon' name='canon' value="<?= $canon ?>" class="texto texto-ec" readonly />
    </div>
    
    <?= $form->field($model, 'CodClie')->dropDownList(ArrayHelper::map(Saclie::find()->where(['Activo' => '1'])->OrderBy('Descrip')->all(), 'CodClie', 'Descrip'), ['prompt'=>'Seleccione']); ?>

    <?= $form->field($model, 'CodVend')->dropDownList(ArrayHelper::map(Ccomercial::find()->where(['Activo' => '1'])->OrderBy('Descrip')->all(), 'CodVend', 'Descrip'), ['prompt'=>'Seleccione', 'onchange'=>'js:busca_canon();']); ?>

    <?= $form->field($model, 'id_ubicacion')->dropDownList(ArrayHelper::map(Ubicacion::find()->where(['activo' => '1'])->OrderBy('nombre')->all(), 'id_ubicacion', 'nombre'), ['prompt'=>'Seleccione']); ?>

    <?= $form->field($model, 'id_piso')->dropDownList(ArrayHelper::map(Piso::find()->where(['activo' => '1'])->OrderBy('nombre')->all(), 'id_piso', 'nombre'), ['prompt'=>'Seleccione']); ?>

    <?= $form->field($model, 'descripcion')->textInput() ?>

    <?= $form->field($model, 'metro')->textInput() ?>
    
    <?= $form->field($model, 'porcentaje_alicuota')->hiddenInput(['value' => 0])->label(false) ?>

    <?= $form->field($model, 'monto_alicuota')->hiddenInput(['value' => 0])->label(false) ?>

    <?= $form->field($model, 'alquiler')->dropDownList(['0' => 'NO', '1' => 'SI']); ?>
    
    <?= $form->field($model, 'tipo_alquiler')->dropDownList(['0' => 'Monto Fijo', '1' => 'Por Porcentaje', '2' => 'Mixto']); ?>
    
    <?= $form->field($model, 'monto_alquiler')->textInput(['onblur'=>'js:calcula_canon();']) ?>
    
    <?= $form->field($model, 'porcentaje_alquiler')->textInput(); ?>

    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <?php ActiveForm::end(); ?>

</div>
