<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ChatForm;
use app\models\Chat;
use app\models\User;
use yii\web\JqueryAsset;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        $query = Chat::find();
        $messages = $query->orderBy(['date' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $this->view->registerJsFile(Yii::getAlias('@web/js/socket.js'), ['depends' => JqueryAsset::className()]); 
        return $this->render('index', [
            'messages'      => $messages
        ]);
    }
    
    /**
     * Displays chat.
     *
     * @return string
     */
    public function actionChat()
    {
        return $this->render('chat');
    }
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            /*
            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'access_token',
                'value' => Yii::$app->user->identity->access_token
            ]));       
             * 
             */     
            return $this->goBack();
        }
        if ($model->load(Yii::$app->request->post()) && !$model->login()) {
            
            $userNew = new User;
            $userNew->username = $model->username;
            $userNew->password = md5($model->password);
            $userNew->role = 1;
            $userNew->status = 0;
            $userNew->avatar_path = '/images/';
            $userNew->avatar_filename = 'vihodnie.gif';
            $userNew->auth_key = substr(md5(time()), 0, 5);
            $userNew->access_token = substr(md5(time()), 0, 12);
            $userNew->save();
            $model->load(Yii::$app->request->post());
            $model->login();
            $this->actionLogin();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
//        Yii::$app->response->cookies->remove('access_token');
        return $this->goHome();
    }
}
