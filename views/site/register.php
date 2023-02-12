<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-center">

    <h1>Регистрация</h1>

    <?php $form = ActiveForm::begin() ?>

    <div class="mt-3" style="width: 250px; margin: 0 auto; text-align: start;">
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>