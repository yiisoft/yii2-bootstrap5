<?php

declare(strict_types=1);
/**
 * @package yii2-bootstrap5
 * @author Simon Karlen <simi.albi@outlook.com>
 */

namespace yiiunit\extensions\bootstrap5\data;

use yii\base\Model;

class User extends Model
{
    public $id;
    public $firstName;
    public $lastName;
    public $username;
    public $password;

    public function rules()
    {
        return [
            ['id', 'integer'],
            [['firstName', 'lastName'], 'string'],
            [
                'username',
                'string',
                'min' => 4,
            ],
            [
                'password',
                'string',
                'min' => 8,
                'max' => '20',
            ],
            [['username', 'password'], 'required'],
        ];
    }

    public function attributeHints()
    {
        return [
            'username' => 'Your username must be at least 4 characters long',
            'password' => 'Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.',
        ];
    }
}
