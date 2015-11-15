<?php

namespace backend\modules\FreeRadius\models;

use Yii;

/**
 * This is the model class for table "radcheck".
 *
 * @property integer $id
 * @property string $username
 * @property string $attribute
 * @property string $op
 * @property string $value
 */
class Radcheck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'radcheck';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'attribute', 'op', 'value'], 'required'],
            [['username', 'attribute', 'value'], 'string', 'max' => 32],
            [['op'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attribute' => 'Attribute',
            'id'        => 'ID',
            'op'        => 'Operation',
            'username'  => 'Primary Email',
            'value'     => 'Value',
        ];
    }

    /* convert the datetime<->timestamp between saving and displaying */

    public function beforeSave($insert)
    {
        // convert datetime to timestamp for MDL, but only for 'Expiration' attrib.
        if ($this->getAttribute('attribute') == 'Expiration') {
            $this->setAttribute('value', strtotime($this->getAttribute('value')) );
        }

        return $this;
    }

    public function afterFind()
    {
        // convert timestamp to datetime for CNTL/VW, but only for 'Expiration' attrib.
        if ($this->getAttribute('attribute') == 'Expiration') {
            $this->setAttribute('value', date('Y-m-d H:i:s', $this->getAttribute('value')));
        }

        return $this;
    }
}
