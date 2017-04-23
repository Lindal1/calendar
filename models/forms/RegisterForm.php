<?php
/**
 * Created by PhpStorm.
 * User: lindal
 * Date: 24.04.17
 * Time: 2:46
 */

namespace app\models\forms;


use app\models\Invite;
use app\models\User;
use Yii;
use yii\base\Model;

class RegisterForm extends Model
{
    public $username;
    public $password;
    public $name;
    public $password_repeat;
    public $code;

    public function rules()
    {
        return [
            [['username', 'password', 'password_repeat', 'code', 'name'], 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            [['password', 'username'], 'string', 'min' => 6],
            ['code', 'validateCode'],
            ['username', 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'username']
        ];
    }

    public function validateCode($attr)
    {
        $invite = $this->getInvite();
        if (!$invite || $invite->invited_user_id) {
            $this->addError('code', 'Incorrect code');
            return false;
        }
        return true;
    }

    public function register()
    {
        if (!$this->validate()) {
            return false;
        }
        $user = new User([
            'username' => $this->username,
            'name' => $this->name,
            'password' => Yii::$app->getSecurity()->generatePasswordHash($this->password),
            'access_token' => Yii::$app->getSecurity()->generateRandomString(),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
        ]);
        $user->save();

        $invite = $this->getInvite();
        $invite->invited_user_id = $user->getPrimaryKey();
        $invite->save();
        Yii::$app->getUser()->login($user);
        return $user;
    }

    /**
     * @return Invite
     */
    private function getInvite()
    {
        return Invite::findOne(['code' => $this->code]);
    }
}