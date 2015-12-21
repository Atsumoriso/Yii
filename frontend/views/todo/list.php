<?php

/**
 * @var $this yii\web\View
 * @var $name string
 * @var $tasks frontend\models\Task[]
 */
//use Yii;
//use yii\helpers\Html;
use yii\helpers\Url;
//use yii\bootstrap\ActiveForm;
//use frontend\models\Task;
//use frontend\models\TaskForm;
use frontend\controllers;
use yii\widgets\LinkPager;

?>

<h1>Todo List — <?= $name ?></h1>
<?php if (Yii::$app->session->hasFlash('taskCreated')): ?>
    <p class="alert alert-success">The task has been created!</p>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('taskUpdated')): ?>
    <p class="alert alert-success">The task has been updated successfully.</p>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('taskArchived')): ?>
    <p class="alert alert-success">The task has been archived.</p>
<?php endif; ?>

<div>
<!-- Sort by
    <select id="tasklist-sort-options">
        <option value="name">name</option>
        <option value="priority">priority</option>
    </select> -->
    <table class="">
        <tr>
            <col width="160">
            <col width="160">
            <col width="40">
            <col width="350">
            <col width="50">
            <col width="80">
            <col width="50">

            <th>Creation date</th>
            <th align="center">Due date</th>
            <th></th> <!--empty cell , in this column goes exclamation mark for urgent task-->
            <th>Summary</th>
        </tr>
        <tr>

        <?php foreach($tasks as $task):?>
            <!--display only if task is not archived-->
            <?php if ($task->is_archived == 0): ?>
                <td><?= $task->creation_date ?></td>
                <td><?= $task->due_date ?></td>

                <!--if task is done-->
                <?php if ($task->is_done == 1): ?>
                    <td></td> <!--empty cell to display nice-->
                    <td class="task-done">
                    <img title="Done!" src="../img/check_mark.png"
                             height="20" width="20" align="absmiddle">
                    <del><?php echo " ".$task->summary; ?></del>
                    </td>
                    <td></td> <!--empty cell to display nice-->
                    <td></td> <!--empty cell to display nice-->
                <?php endif; ?>

                    <!--if task is not done-->
                <?php if ($task->is_done == 0): ?>

                    <?php if ($task->is_urgent == 1): ?>
                        <td>
                            <img title="Urgent!" src="../img/exclamation_mark.jpg" height="20" width="20" align="absmiddle">
                        </td>
                        <td class="task-name"><?php echo $task->summary ?></td>
                        <td><a title="Mark as done" href="<?= Url::to(['todo/done', 'id' => $task->id]) ?>">Done</a></td>
                        <td><a title="Mark as NOT Urgent" href="<?= Url::to(['todo/noturgent', 'id' => $task->id]) ?>">Not urgent</a></td>
                    <?php else: ?>
                        <td></td>
                        <td class="task-name"><?php echo $task->summary ?></td>
                        <td><a title="Mark as done" href="<?= Url::to(['todo/done', 'id' => $task->id]) ?>">Done</a></td>
                        <td><a title="Mark as Urgent" href="<?= Url::to(['todo/urgent', 'id' => $task->id]) ?>">Urgent</a></td>
                    <?php endif; ?>
                <?php endif; ?>
                <!--displays in any case-->
                <td><a title="Archive note" href="<?= Url::to(['todo/archive', 'id' => $task->id]) ?>">Archive</a></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>

</table>

    <?php
    // display pagination
    echo LinkPager::widget([
    'pagination' => $pages,
    ]);
    //var_dump($pages);
?>
</div>


