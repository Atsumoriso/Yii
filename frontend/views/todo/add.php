<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Add';
$this->params['breadcrumbs'][] = $this->title;

/** @var $this yii\web\View */
/** @var $taskForm frontend\models\TaskForm */
?>


<h1>Add a task</h1>

<?php $form = ActiveForm::begin([
    'id' => 'add-task-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>

    <?= $form->field($taskForm, 'summary') ?>

    <?= $form->field($taskForm, 'due_date') ?>

    <?= $form->field($taskForm, 'is_urgent')->checkbox([
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ]) ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
