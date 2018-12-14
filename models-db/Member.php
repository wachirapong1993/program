<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property int $MemberID
 * @property string $Username
 * @property string $Password
 * @property string $Name
 * @property string $Tel
 * @property string $Email
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Username', 'Password', 'Name', 'Tel', 'Email'], 'required'],
            [['Username', 'Password', 'Name', 'Tel'], 'string', 'max' => 50],
            [['Email'], 'string', 'max' => 150],
            [['Username'], 'unique'],
            [['Email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MemberID' => 'Member ID',
            'Username' => 'Username',
            'Password' => 'Password',
            'Name' => 'Name',
            'Tel' => 'Tel',
            'Email' => 'Email',
        ];
    }
}
