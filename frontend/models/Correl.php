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
            [['canon'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_correl' => 'Id Correl',
            'canon' => 'Canon',
        ];
    }
}
