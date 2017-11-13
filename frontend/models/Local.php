<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ISCO_ALICUOTA".
 *
 * @property integer $id_alicuota
 * @property string $CodClie
 * @property integer $id_ubicacion
 * @property integer $id_piso
 * @property string $descripcion
 * @property string $porcentaje
 * @property integer $alquiler
 * @property integer $activo
 *
 * @property SACLIE $codClie
 * @property ISCOUBICACION $idUbicacion
 * @property ISCOPISO $idPiso
 */
class Local extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISCO_ALICUOTA';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodClie','id_ubicacion', 'id_piso', 'descripcion', 'metro'], 'required'],
            [['CodClie', 'descripcion'], 'string'],
            [['id_ubicacion', 'id_piso', 'alquiler', 'tipo_alquiler', 'activo'], 'integer'],
            [['porcentaje', 'porcentaje_alquiler'], 'number', 'max' => 100],
            [['monto_alquiler'], 'number'],
            [['metro'], 'number', 'min' => 1],
            [['CodClie'], 'exist', 'skipOnError' => true, 'targetClass' => Saclie::className(), 'targetAttribute' => ['CodClie' => 'CodClie']],
            [['id_ubicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Ubicacion::className(), 'targetAttribute' => ['id_ubicacion' => 'id_ubicacion']],
            [['id_piso'], 'exist', 'skipOnError' => true, 'targetClass' => Piso::className(), 'targetAttribute' => ['id_piso' => 'id_piso']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_alicuota' => 'Id',
            'CodClie' => 'Cliente',
            'id_ubicacion' => 'Ubicacion',
            'id_piso' => 'Piso',
            'descripcion' => 'Descripcion del Local',
            'metro' => 'Metros Cuadrados',
            'porcentaje' => 'Porcentaje',
            'alquiler' => '¿Tiene Arrendamiento?',
            'tipo_alquiler' => 'Tipo de Arrendamiento',
            'monto_alquiler' => 'Monto de Arrendamiento (o porcentaje según Cánon)',
            'porcentaje_alquiler' => 'Porcentaje de Arrendamiento mixto',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodClies()
    {
        return $this->hasOne(Saclie::className(), ['CodClie' => 'CodClie']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUbicacion()
    {
        return $this->hasOne(Ubicacion::className(), ['id_ubicacion' => 'id_ubicacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPiso()
    {
        return $this->hasOne(Piso::className(), ['id_piso' => 'id_piso']);
    }
}
