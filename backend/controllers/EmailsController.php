<?php

namespace backend\controllers;

use Yii;
use backend\models\Emails;
use backend\models\EmailsSearch;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmailsController implements the CRUD actions for Emails model.
 */
class EmailsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Emails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Emails model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Emails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Emails();

        if ($model->load(Yii::$app->request->post())) {

            //upload attachment
            $model->attachment = UploadedFile::getInstance($model, 'attachment');

            //configure attachment
            if ($model->attachment)
            {
                $time = time();
                $model->attachment->saveAs('attachments/'.$time.'.'.$model->attachment->extension);
                $model->attachment = 'attachments/'.$time.'.'.$model->attachment->extension;
            }

            //set ready for sending email
            if ($model->attachment) 
            {
                $value = Yii::$app->mailer->compose()
                ->setFrom(['afiqsyaf36@gmail.com' => 'Admin'])
                ->setTo($model->receiver_email)
                ->setSubject($model->subject)
                ->setHtmlBody($model->content)
                ->attach($model->attachment)
                ->send();
            // print_r($model->getErrors());die();
            // echo "<pre>";
            // print_r($model->attachment);
            // echo "</pre>";die();
            }
            else 
            {
                $value = Yii::$app->mailer->compose()
                ->setFrom(['afiqsyaf36@gmail.com' => 'Afiq Syafiq'])
                ->setTo($model->receiver_email)
                ->setSubject($model->subject)
                ->setHtmlBody($model->content)
                ->send();
            }
            
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Emails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Emails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Emails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Emails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Emails::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
