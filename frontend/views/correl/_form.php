<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Ccomercial;
/* @var $this yii\web\View */
/* @var $model frontend\models\Correl */
/* @var $form yii\widgets\ActiveForm */
$CodUbic = Yii::$app->user->identity->CodUbic;
$rol = Yii::$app->user->identity->id_rol;
?>
<?= ercling\pace\PaceWidget::widget(); ?>
<div class="correl-form">

    <?php $form = ActiveForm::begin(); ?>

    <center>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Crear' : '<i class="fa fa-save"></i> Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </center>

    <?= $form->field($model, 'canon')->textInput() ?>

    <?php 
    	if ($rol==3) {
    		echo $form->field($model, 'CodVend')->dropDownList(ArrayHelper::map(CComercial::find()->where(['Activo' => 1])->OrderBy('Descrip')->all(), 
        		'CodVend', 'Descrip', 'Descrip'), ['prompt' => 'Seleccione']); 
    	} else {
    		echo $form->field($model, 'CodVend')->dropDownList(ArrayHelper::map(CComercial::find()->where(['Activo' => 1, 'DescOrder' => $CodUbic])->OrderBy('Descrip')->all(), 
        		'CodVend', 'Descrip', 'Descrip'), ['prompt' => 'Seleccione']); 
    	}
    ?>

  	<?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    $(document).ajaxStart(function() { Pace.restart(); });
</script>