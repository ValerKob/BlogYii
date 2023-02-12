<?php

namespace app\models;

use Yii;
use yii\base\Model;


class AddPost extends Model
{
    public $id_user;
    public $username_user;
    public $name;
    public $content;
    public $date_post;


    public function rules()
    {
        return [
            [['id_user', 'username_user', 'name', 'content'], 'required', 'message' => 'Заполните поле...'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_user' => 'ID пользоателя',
            'username_user' => 'Имя пользователя',
            'name' => 'Название поста',
            'content' => 'Содержание поста',
            'date_post' => 'Время создание поста',
        ];
    }
}
