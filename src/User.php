<?php

namespace yii2cmf\models\user;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $login
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Posts[] $posts
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['login', 'username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('modules\user\common', 'ID'),
            'login' => Yii::t('modules\user\common', 'Login'),
            'username' => Yii::t('modules\user\common', 'Username'),
            'auth_key' => Yii::t('modules\user\common', 'Auth Key'),
            'password_hash' => Yii::t('modules\user\common', 'Password Hash'),
            'password_reset_token' => Yii::t('modules\user\common', 'Password Reset Token'),
            'email' => Yii::t('modules\user\common', 'Email'),
            'status' => Yii::t('modules\user\common', 'Status'),
            'created_at' => Yii::t('modules\user\common', 'Created At'),
            'updated_at' => Yii::t('modules\user\common', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['post_author' => 'id']);
    }
}
