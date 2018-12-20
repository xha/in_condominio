<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Local */

$this->title = 'Crear Local';
$this->params['breadcrumbs'][] = ['label' => 'Locales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="local-create">

    <?= $this->render('_form', [
        'model' => $model,
        'canon' => $canon,
    ]) ?>

</div>
