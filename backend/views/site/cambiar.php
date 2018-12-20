<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Usuario;

/* @var $this yii\web\View */
/* @var $model app\models\Rol */

$this->title = 'Cambiar Clave';

$this->params['breadcrumbs'][] = $this->title;
$id_usuario = Yii::$app->user->identity->id_usuario;
$this->registerJsFile('@web/js/index.js');
?>
<?= ercling\pace\PaceWidget::widget(); ?>
<h3 id='msj_principal'><?= $msg ?></h3>
<br />
<div class="cambiar-form">

    <?php $form = ActiveForm::begin(); ?>

	<center>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Actualizar' : '<i class="fa fa-save"></i> Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </center>

    <?= $form->field($model, 'id_usuario')->hiddenInput(['value' => $id_usuario])->label(false) ?>
    
    <?= $form->field($model, 'clave_actual')->textInput(['maxlength' => true, 'type' => 'password']) ?>
    
    <?= $form->field($model, 'clave')->textInput(['maxlength' => true, 'type' => 'password']) ?>

    <?= $form->field($model, 'repetir_clave')->textInput(['maxlength' => true, 'type' => 'password']) ?>

    <?php ActiveForm::end(); ?>
</div>