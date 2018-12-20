<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Usuario;
use backend\models\Rol;
use frontend\models\Sadepo;

/* @var $this yii\web\View */
/* @var $model app\models\Rol */

$this->title = 'Activar usuario';

$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/general.js');
?>
<?= ercling\pace\PaceWidget::widget(); ?>
<h3 id='msj_principal'><?= $msg ?></h3>
<br />

<div class="activar-form">

	<?php $form = ActiveForm::begin(); ?>

    <center>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Crear' : '<i class="fa fa-save"></i> Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </center>   

    <label>Usuario</label><br /><br />
    <?= $form->field($model, 'usuario')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
            'clientOptions' => [
                'source' => $data,
                'minLength'=>'3', 
            ],
            'class'=>'form-control',
        ]) 
    ?>

    <?= $form->field($model, 'id_rol')->dropDownList(ArrayHelper::map(Rol::find()->where(['activo' => '1'])->OrderBy('descripcion')->all(), 'id_rol', 'descripcion')); ?>
    
    <?= $form->field($model, 'CodUbic')->dropDownList(ArrayHelper::map(Sadepo::find()->where(['activo' => '1'])->OrderBy('Descrip')->all(), 'CodUbic', 'Descrip', 'CodUbic')); ?>


    <?= $form->field($model, 'reseteo')->checkbox(); ?><br /><br />

    <?= $form->field($model, 'activado')->checkbox(); ?><br /><br />

    <?php ActiveForm::end(); ?>
    
    <table class="table table-striped table-bordered table-hover tables" id="listado_detalle"></table>
</div>
<script type="text/javascript">
    $(document).ajaxStart(function() { Pace.restart(); });
    $(function() {
        buscar_usuarios();
    });
    
    function titulo_usuario() {
        var arreglo = new Array();
            arreglo[0] = 'Usuario';
            arreglo[1] = 'Cédula';
            arreglo[2] = 'Nombre';
            arreglo[3] = 'Ubicación';
            arreglo[4] = 'Rol';
            arreglo[5] = 'Estatus';

        var tabla = $('#listado_detalle')[0];
        tabla.innerHTML = "";

        var cuerpo_inicio = document.createElement('thead');
        cuerpo_inicio.appendChild(add_filas(arreglo, 'th','','',5));
        tabla.appendChild(cuerpo_inicio);
    }
    
    function buscar_usuarios() {
        var tabla = trae('listado_detalle');
        var i;
        
        tabla.innerHTML = "";
        $.getJSON('../site/busca-usuarios',{},function(data){
            var campos = Array();
            if (data!="") {
                titulo_usuario();
                var cuerpo_inicio = document.createElement('tbody');
                for (i = 0; i < data.length; i++) {
                    campos.length = 0;
                    campos.push(data[i].usuario);
                    campos.push(data[i].cedula);
                    campos.push(data[i].nombre);
                    campos.push(data[i].ubicacion);
                    campos.push(data[i].rol);
                    campos.push(data[i].activo);

                    cuerpo_inicio.appendChild(add_filas(campos, 'td','','5',5));
                }
                tabla.appendChild(cuerpo_inicio);
            }
        });
    }
</script>