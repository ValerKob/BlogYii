<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'MyPost';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-center">

    <h1>Создать Пост</h1>

    <?php $form = ActiveForm::begin() ?>

    <div class="mt-3" style="width: 250px; margin: 0 auto; text-align: start;">
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'content')->textarea() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>

    <br><br><br><br><br><br><br><br><br>
    <h1>Мой посты</h1>

    <div class="row">
        <?php
        foreach ($rows as $row) {
            if ($row->id_user === Yii::$app->user->id) {
                echo '
                <div class="col-12 col-sm-6 col-md-4 d-flex justify-content-center">
                <div class="card" style="width: 18rem; display: block; border: 0px;">
                    <div class="card-body d-flex flex-column justify-content-between" style="
                    border: var(--bs-card-border-width) solid var(--bs-card-border-color);
                    border-radius: 15px;">
                        <div>
                            <h5 class="card-title">' . $row['name'] . '</h5>
                            <p class="card-text">' . $row['content'] . '</p>
                        </div>
                        <div>
                        <div class="d-flex justify-content-between mt-3" style="color: #8e8e8e;">
                            <div class="card-title text-start"> Дата: <b style="color: #000;">' . $row['date_post'] . '</b></div>
                            <div class="card-title text-end"> Автор:  <b style="color: #000;">' . $row['username_user'] . '</b></div>
                        </div>
                            <div>
                            ' ?>
                <a href="<?= Yii::$app->urlManager->createUrl(['site/deletepost', 'id' => $row->id]) ?>" class="btn btn-danger me-5">Удалить</a>
                <a href="<?= Yii::$app->urlManager->createUrl(['site/updatepost', 'id' => $row->id]) ?>" class="btn btn-primary">Именить</a>
        <?php echo ' 
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            }
        }
        ?>
    </div>
</div>