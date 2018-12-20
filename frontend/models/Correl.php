<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISCO_Correl".
 *
 * @property integer $id_correl
 * @property string $canon
 */
class Correl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISCO_Correl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['canon','CodVend'], 'required'],
            ['canon', 'number'],
            ['CodVend', 'string'],
            [['activo'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_correl' => 'Id',
            'canon' => 'Canon',
            'CodVend' => 'Centro Comercial',
            'activo' => 'Activo',
        ];
    }
}
