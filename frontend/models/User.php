<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_user}}".
 *
 * @property string $id
 * @property string $login
 * @property string $password
 * @property string $email
 * @property string $nickname
 * @property string $about
 *
 * @property TblPost[] $tblPosts
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password', 'email', 'nickname'], 'required'],
            [['about'], 'string'],
            [['login'], 'string', 'max' => 40],
            [['password', 'email'], 'string', 'max' => 100],
            [['nickname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'email' => 'Email',
            'nickname' => 'Nickname',
            'about' => 'About',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblPosts()
    {
        return $this->hasMany(TblPost::className(), ['author_id' => 'id']);
    }
}
