<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{

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
