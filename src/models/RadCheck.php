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
        return '{{%RadCheck}}';
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

    /**
     * @param bool $insert
     *
     * @return $this
     */
    public function beforeSave($insert)
    {
        // convert datetime to timestamp for MDL, but only for 'Expiration' attrib.
        if ($this->getAttribute('attribute') == 'Expiration') {
            $this->setAttribute('value', strtotime($this->getAttribute('value')) );
        }

        return $this;
    }

    /**
     * @return $this
     */
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
     * @param string $username
     * @param string $field
     * @param string $orderDir
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    private static function getExpiration(string $username, string $field = 'expiration', string $orderDir = 'DESC')
    {
        return self::find()
            ->select('value')
            ->andWhere('username like "'.$username.'%"')
            ->andWhere(['attribute' => $field])
            ->orderBy('value '.$orderDir)
            ->one();
    }

    /**
     * @param string $username
     * @param string $format
     *
     * @return string
     */
    public static function getHumanReadableExpiration(string $username, string $format = 'Y-m-d H:i:s')
    {
        $returnData = self::getExpiration($username);

        // is the expiration() return > the timestamp of now
        if ($returnData > time()) {
            $nowDT      = new \DateTime();
            $intervalDT = $nowDT->diff( new \DateTime(date($format, $returnData)) );

            $dayDiff  = $intervalDT->format('%a');
            $hourDiff = $intervalDT->format('%h');

            if ($dayDiff) {
                return 'Expires in '.$dayDiff.' day'.($dayDiff < 1 ?: 's').' on '.date('F d, Y', $returnData);
            } elseif ($hourDiff) {
                return 'Expires in '.$hourDiff.' hour'.($hourDiff < 1 ?: 's');
            }

        };

        return  'EXPIRED';
    }
}
