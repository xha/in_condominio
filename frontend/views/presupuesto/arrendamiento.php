<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Ccomercial;

//use yii\jui\Tabs;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presupuesto */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/arrendamiento.js');
$this->registerCssFile('@web/css/general.css');
$id_usuario = Yii::$app->user->identity->id_usuario;
$this->title = 'Procesar Arrendamientos';
$this->params['breadcrumbs'][] = ['label' => 'Arrendamientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$CodUbic = Yii::$app->user->identity->CodUbic;
$rol = Yii::$app->user->identity->id_rol;
?>
<?= ercling\pace\PaceWidget::widget(); ?>
<div class="procesar-form">
    <div class="form-group">
        <?php $form = ActiveForm::begin(); ?>
        <?php 
            if ($rol==3) {
                echo $form->field($model, 'CodVend')->dropDownList(ArrayHelper::map(CComercial::find()->where(['Activo' => 1])->OrderBy('Descrip')->all(), 
                    'CodVend', 'Descrip', 'Descrip'), ['prompt' => 'Seleccione', 'class' => 'texto texto-medio']); 
            } else {
                echo $form->field($model, 'CodVend')->dropDownList(ArrayHelper::map(CComercial::find()->where(['Activo' => 1, 'DescOrder' => $CodUbic])->OrderBy('Descrip')->all(), 
                    'CodVend', 'Descrip', 'Descrip'), ['prompt' => 'Seleccione', 'class' => 'texto texto-medio']); 
            }
        ?>
        <input type="hidden" id='id_usuario' value="<?php echo $id_usuario; ?>" />
        <b style='float: left; padding: 5px'>Mes: </b>
        <select id='mes' name='mes' class='texto texto-corto'>
            <option value="Enero">Enero</option>
            <option value="Febrero">Febrero</option>
            <option value="Marzo">Marzo</option>
            <option value="Abril">Abril</option>
            <option value="Mayo">Mayo</option>
            <option value="Junio">Junio</option>
            <option value="Julio">Julio</option>
            <option value="Agosto">Agosto</option>
            <option value="Septiembre">Septiembre</option>
            <option value="Octubre">Octubre</option>
            <option value="Noviembre">Noviembre</option>
            <option value="Diciembre">Diciembre</option>
        </select>
        <?php ActiveForm::end(); ?>
        <button id='btn_enviar' class='btn btn-success' onclick="procesar_arrendamiento();">Generar Presupuestos de Arrendamientos</button>
        <img id="imag" src="../../../img/preloader.gif" />
    </div>
    <br />
    <h3 id='msj_principal'></h3>
<style>
    #imag {
        float: left;
        visibility: hidden;
    }
</style>