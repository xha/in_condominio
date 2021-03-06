<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PresupuestoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presupuestos';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="presupuesto-index">

    <center>
        <?= Html::a('<i class="fa fa-file"></i> Crear Presupuesto', ['create'], ['class' => 'btn btn-success']) ?>
    </center>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'CodSucu',
            //'TipoFac',
            'NumeroD',
            //'NroUnico',
            //'NroCtrol',
            // 'CodEsta',
            // 'CodUsua',
            // 'EsCorrel',
            // 'CodConv',
            // 'Signo',
            // 'FechaT',
            // 'OTipo',
            // 'ONumero',
            // 'NumeroC',
            // 'NumeroT',
            // 'NumeroR',
            // 'TipoTraE',
            // 'AutSRI',
            // 'NroEstable',
            // 'PtoEmision',
            // 'NumeroF',
            // 'NumeroNCF',
            // 'NumeroP',
            // 'NumeroE',
            // 'NumeroZ',
            // 'Moneda',
            // 'Factor',
            // 'MontoMEx',
            //'CodClie',
            // 'CodVend',
            // 'CodUbic',
            'ID3',
            'Descrip',
            // 'Direc1',
            // 'Direc2',
            // 'Direc3',
            // 'ZipCode',
            // 'Telef',
            // 'Monto',
            // 'MtoTax',
            // 'Fletes',
            // 'TGravable',
            // 'TGravable0',
            // 'TExento',
            // 'CostoPrd',
            // 'CostoSrv',
            // 'DesctoP',
            // 'RetenIVA',
            // 'FechaR',
            // 'FechaI',
            [
               'attribute' => 'FechaE',
                'format' =>  ['date', 'php:d-m-Y'],
            ],
            // 'FechaV',
            'MtoTotal',
            // 'Contado',
            // 'Credito',
            // 'CancelI',
            // 'CancelA',
            // 'CancelE',
            // 'CancelC',
            // 'CancelT',
            // 'CancelG',
            // 'CancelP',
            // 'Cambio',
            // 'MtoExtra',
            // 'ValorPtos',
            // 'Descto1',
            // 'PctAnual',
            // 'MtoInt1',
            // 'Descto2',
            // 'PctManejo',
            // 'MtoInt2',
            // 'SaldoAct',
            // 'MtoPagos',
            // 'MtoNCredito',
            // 'MtoNDebito',
            // 'MtoFinanc',
            // 'DetalChq',
            // 'TotalPrd',
            // 'TotalSrv',
            // 'OrdenC',
            // 'CodOper',
            // 'NGiros',
            // 'NMeses',
            // 'MtoComiVta',
            // 'MtoComiCob',
            // 'MtoComiVtaD',
            // 'MtoComiCobD',
            // 'Notas1',
            // 'Notas2',
            // 'Notas3',
            // 'Notas4',
            // 'Notas5',
            // 'Notas6',
            // 'Notas7',
            // 'Notas8',
            // 'Notas9',
            // 'Notas10',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {print}',
                'buttons' => [
                    'print' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, [
                                    'title' => Yii::t('app', 'Presupuesto '.$model->NumeroD),
                                    'target' => '_blank',
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = Yii::$app->urlManager->createUrl(['presupuesto/update?NumeroD='.$model->NumeroD.'&CodSucu='.$model->CodSucu.'&TipoFac='.$model->TipoFac]); // your own url generation logic
                        return $url;
                    } else {
                        $url = Yii::$app->urlManager->createUrl(['presupuesto/imprime-presupuesto?numerod='.$model->NumeroD]); // your own url generation logic
                        return $url;
                    }
                } 
            ],
        ],
    ]); ?>
</div>
