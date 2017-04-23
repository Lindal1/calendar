<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $date_start
 * @property string $date_end
 * @property string $description
 * @property string $color
 * @property integer $status
 *
 * @property User $user
 */
class Event extends \yii\db\ActiveRecord
{

    const STATUS_NEW = 1;
    const STATUS_IN_PROCESS = 2;
    const STATUS_FINISHED = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_NEW],
            [['user_id', 'name', 'date_start', 'status'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['date_start', 'date_end'], 'safe'],
            [['description'], 'string'],
            [['name', 'color'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'description' => 'Description',
            'color' => 'Color',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
