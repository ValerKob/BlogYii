<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'UpdatePost';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-center">

    <h1>Изменить Пост</h1>

    <?php $form = ActiveForm::begin() ?>

    <div class="mt-3" style="width: 250px; margin: 0 auto; text-align: start;">
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'content')->textarea() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>