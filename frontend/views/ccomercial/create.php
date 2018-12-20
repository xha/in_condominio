<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Ccomercial */

$this->title = 'Crear Centro Comercial';
$this->params['breadcrumbs'][] = ['label' => 'Centro Comercial', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ccomercial-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
