<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $customer_id
 * @property string|null $customer_name
 * @property string|null $zip_code
 * @property string|null $city
 * @property string|null $province
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_name','zip_code','city','province'], 'required'],
            [['customer_name', 'city', 'province'], 'string', 'max' => 100],
            [['zip_code'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'customer_name' => 'Customer Name',
            'zip_code' => 'Zip Code',
            'city' => 'City',
            'province' => 'Province',
        ];
    }
}
