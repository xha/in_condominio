<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Accion;

/* @var $this yii\web\View */
/* @var $model app\models\Accion */
/* @var $form yii\widgets\ActiveForm */
?>
<?= ercling\pace\PaceWidget::widget(); ?>
<div class="accion-form">

    <?php $form = ActiveForm::begin(); ?>

    <center>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Crear' : '<i class="fa fa-save"></i> Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </center>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nivel')->dropDownList(['1' => 1, '2' => 2, '3' => 3, '4' => 4], ['onchange'=>'js:buscar_padre()']); ?>

    <?= $form->field($model, 'id_padre')->dropDownList(ArrayHelper::map(Accion::find()->where(['Nivel' => 0])->OrderBy('descripcion')->all(), 
        'id_accion', 'descripcion'), ['prompt' => 'Seleccione']); ?>

    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    $(document).ajaxStart(function() { Pace.restart(); });
    function buscar_padre() {
        var id_padre = $('#accion-id_padre')[0];
        var nivel = $('#accion-nivel').val();
        id_padre.length = 0;
        id_padre[0] = new Option("Seleccione","","","");
        Pace.restart();
        $.getJSON('../accion/buscar-padre', {nivel : nivel-1},function(data){
            if (data!="") {
                for (var i=0; i < data.length; i++) {
                    id_padre[i+1] = new Option(data[i].alias,data[i].id_accion,"","");
                }
            }
        });
    }
</script>
