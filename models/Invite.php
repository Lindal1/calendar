<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invite".
 *
 * @property integer $id
 * @property integer $created_by
 * @property integer $invited_user_id
 * @property string $code
 *
 * @property User $createdBy
 * @property User $invitedUser
 */
class Invite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['code', 'default', 'value' => Yii::$app->getSecurity()->generateRandomString(15)],
            [['created_by', 'code'], 'required'],
            [['created_by', 'invited_user_id'], 'integer'],
            [['code'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['invited_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['invited_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_by' => 'Created By',
            'invited_user_id' => 'Invited User ID',
            'code' => 'Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'invited_user_id']);
    }
}
