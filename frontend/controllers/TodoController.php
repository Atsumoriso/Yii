<?php
namespace frontend\controllers;

use Yii;
use frontend\models\TaskForm;
use frontend\models\Task;
use yii\web\Controller;
use yii\web\Response;
//use yii\helpers\Url;
use yii\data\Pagination;

/**
 * Todo controller
 */
class TodoController extends Controller
{

    /**
     * Displays all tasks
     * @return string
     */
//    public function actionList()
//    {
//        $taskForm = new TaskForm();
//        $viewAll = $taskForm->displayAllTasks();
//
//        return $this->render('list', [
//                'name' => 'My list',
//                'taskForm' => $viewAll,]
//        );
//    }



    public function actionList()
    {
        $query = Task::find()->where(['is_archived' => 0]);
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 10]);

        $tasks = $query->orderBy('is_done asc, is_urgent desc, creation_date desc')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('list', [
            'name' => 'My list',
            'tasks' => $tasks,
            'pages' => $pages,]
    );

    }

    /**
     * Adds new task
     * @return string
     */
    public function actionAdd()
    {
        $taskForm = new TaskForm();
        if ($taskForm->load(Yii::$app->request->post()) && $taskForm->addTask())
        {
            Yii::$app->session->setFlash('taskCreated');
            $this->redirect(
                Yii::$app->getUrlManager()->createUrl('todo/list')
            );
        }
        else
        {
            return $this->render('add', [
                'taskForm' => $taskForm,
            ]);
        }


    }

    /**
     * Receives GET parameter, archives it and redirects to all tasks lists
     * @return Response
     */
    public function actionArchive()
    {
        $id =Yii::$app->request->get('id');
        $taskForm = new taskForm();
        $archiveOneNote = $taskForm->archiveNote($id);
        Yii::$app->session->setFlash('taskArchived');
        $this->redirect(
        Yii::$app->getUrlManager()->createUrl('/todo/list')
        );
        //echo Url::to(['todo/list']);
    }

    /**
     * Receives GET parameter, marks it as Done and redirects to all tasks lists
     * @return Response
     */
    public function actionDone()
    {
        $id =Yii::$app->request->get('id');
        $taskForm = new taskForm();
        $markAsDone = $taskForm->markAsDone($id);
        Yii::$app->session->setFlash('taskUpdated');
        $this->redirect(
            Yii::$app->getUrlManager()->createUrl('/todo/list')
        );
    }

    /**
     * Receives GET parameter, marks it as Urgent and redirects to all tasks lists
     * @return Response
     */
    public function actionUrgent()
    {
        $id =Yii::$app->request->get('id');
        $taskForm = new taskForm();
        $markAsDone = $taskForm->markAsUrgent($id);
        Yii::$app->session->setFlash('taskUpdated');
        $this->redirect(
            Yii::$app->getUrlManager()->createUrl('todo/list')
        );
    }

    /**
     * Receives GET parameter, marks it as Urgent and redirects to all tasks lists
     * @return Response
     */
    public function actionNoturgent()
    {
        $id =Yii::$app->request->get('id');
        $taskForm = new taskForm();
        $markAsDone = $taskForm->markAsNotUrgent($id);
        Yii::$app->session->setFlash('taskUpdated');
        $this->redirect(
            Yii::$app->getUrlManager()->createUrl('todo/list')
        );
    }




}
