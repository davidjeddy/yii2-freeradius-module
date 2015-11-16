<?php

namespace davidjeddy\freeradius\models;

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
class RadCheck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%radcheck}}';
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

    /* custom methods */

    /**
     * [getExpiration description]
     * 
     * @author David J Eddy
     * @todo   Better way of doing the 'LIKE' logic? - DJE - 2015-11-15
     * @since  2015-11-15 [<description>]
     * @param  string $username
     * @return mixed
     */
    private static function getExpiration($username, $field = 'expiration', $orderDir = 'DESC')
    {
        $returnData = self::find()
            ->select('value')
            ->andWhere('username like "'.$username.'%"')
            ->andWhere(['attribute' => $field])
            ->orderBy('value '.$orderDir)
            ->one();

        return (isset($returnData->value) ? $returnData->value : false);
    }

    /**
     * [getHumanReadableExpiration description]
     *
     * @author David J Eddy
     * @since  2015-11-16
     * @param  string $username [description]
     * @return string
     */
    public static function getHumanReadableExpiration($username, $format = 'Y-m-d H:i:s')
    {
        $returnData = self::getExpiration($username);

        // is the expiration() return > the timestamp of now
        if ($returnData > time()) {
            $nowDT      = new \DateTime();
            $intervalDT = $nowDT->diff( new \DateTime(date($format, $returnData)) );

            $dayDiff  = $intervalDT->format('%a');
            $hourDiff = $intervalDT->format('%h');

            if ($dayDiff) {
                return 'Expires in '.$dayDiff.' day'.($dayDiff < 1 ?: 's').' on '.date('F t, Y', $returnData); 
            } elseif ($hourDiff) {
                return 'Expires in '.$hourDiff.' hour'.($hourDiff < 1 ?: 's');
            }

        } else {
            return  'EXPIRED';
        }

        return false;
    }
}
