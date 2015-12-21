<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 28.09.15
 * Time: 20:19
 */

namespace frontend\models;

//use common\models\User;
use Yii;
use yii\base\Model;
use yii\db;
use yii\db\Connection;
use yii\db\ActiveRecord;




class TaskForm extends Model
{
    public $summary;
    public $creation_date;
    public $due_date;
    public $is_urgent;
    public $is_archived;

    public function rules()
    {
        return [
            // summary is a required field
            ['summary', 'required'],
            // rememberMe must be a boolean value
            ['is_urgent', 'boolean'],
        ];
    }


    /**
     * Add task to DB
     * @return bool
     */
    public function addTask()
    {
        if($this->validate()){
            $task = new Task();
            $task->summary = $this->summary;
            $task->creation_date = (new \DateTime())->format('Y-m-d H:i:s');
            //$task->due_date = (new \DateTime($this->due_date))->format('Y-m-d H:i:s');
//            if($this->due_date)
//            {
                $task->due_date = $this->due_date;
            //}
            if($this->is_urgent == 1) //Checkbox rememberMe
            {
                $task->is_urgent = 1;
            }
            $task->save();
            return true;
        }
        return false;
    }

    /**
     * Displays all tasks from DB
     * @return array|db\ActiveRecord[]
     */
    // не пригодилась функция
//    public function displayAllTasks()
//    {
//        $resultsAllByDate = Task::find()
//            ->select(['id','summary','creation_date','due_date','is_urgent','is_done','is_archived'])
//            ->orderBy('creation_date')
//            ->all();
//
//        return $resultsAllByDate;
//     // или можно $query = Task::find()->where(['is_archived' => 0]);
//    }

    // не пригодилась функция
//    public function countTasks()
//    {
//        $db = Yii::$app->db;
//        $countTasks = $db
//            ->createCommand('SELECT count(`id`) FROM `task` WHERE `is_archived`=0')
//            ->execute();
//        return $countTasks;
//    }

    public function markAsDone($id)
    {
        $db = Yii::$app->db;
        $archived_note = $db
            ->createCommand('UPDATE `task` SET `is_done`=1 WHERE `id`=:id')
            ->bindValue(':id', $id)
            ->execute();
    }

    public function markAsUrgent($id)
    {
        $db = Yii::$app->db;
        $archived_note = $db
            ->createCommand('UPDATE `task` SET `is_urgent`=1 WHERE `id`=:id')
            ->bindValue(':id', $id)
            ->execute();
    }

    public function markAsNotUrgent($id)
    {
        $db = Yii::$app->db;
        $notArchivedNote = $db
            ->createCommand('UPDATE `task` SET `is_urgent`=0 WHERE `id`=:id')
            ->bindValue(':id', $id)
            ->execute();
    }


    public function archiveNote($id)
    {
        $archived_note = Task::findOne($id);
        $archived_note->is_archived = 1;
        $archived_note->update(); // работает и с $archived_note->save(); но STORM тоже ругается немного - выдает warning


//        variant 2 (рабочий!) подготовленный запрос
//        $db = Yii::$app->db;
//        $archived_note = $db
//            ->createCommand('UPDATE `task` SET `is_archived`=1 WHERE `id`=:id')
//            ->bindValue(':id', $id)
//            ->execute();

//        //var3, (рабочий!) то же самое как вариант 2, но не подготовленный запрос
//        $db = Yii::$app->db;
//        $archived_note = $db
//            ->createCommand('UPDATE `task` SET `is_archived`=1 WHERE `id`='.$id)
//            ->execute();

        //var4 -  тут что-то "не дожал"
        //$db = Yii::$app->db;
        //$archived_note = $db
            //->createCommand()
            //->update('task', ['is_archived' => 1])
            //->where(['id'=>$id])
            //->execute();

    }

}