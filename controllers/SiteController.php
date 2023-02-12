<?php

namespace app\controllers;

use app\models\AddPost;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Product;
use app\models\Register;
use app\models\User;
use PhpParser\Node\Expr\PreDec;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $rows = Product::find()->all();
        return $this->render('index', compact('rows'));
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
            return $this->goBack();
        }

        $model->password = '';
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

        return $this->goHome();
    }

    // Register
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Register();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new User();

            $user->username = $model->username;
            $user->password = Yii::$app->security->generatePasswordHash($model->password);

            if ($user->save()) {
                Yii::$app->user->login($user);
                return $this->goHome();
            }
        }
        return $this->render('register', compact('model'));
    }

    // Product
    public function actionProduct()
    {
        $rows = Product::find()->all();
        return $this->render('index', compact('rows'));
    }

    // MyPost
    public function actionMypost()
    {
        $model = new AddPost();
        $rows = Product::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->id_user = Yii::$app->user->id;
            $model->username_user = Yii::$app->user->identity->username;
            $model->date_post = date("Y-m-d H:i:s");

            $product = new Product();
            $product->id_user = $model->id_user;
            $product->username_user = $model->username_user;
            $product->name = $model->name;
            $product->content = $model->content;
            $product->date_post = $model->date_post;

            if ($product->save()) {
                $rows = Product::find()->all();
                $model1 = new AddPost();
                $model = $model1;
                return $this->redirect(['mypost', compact('model', 'rows')]);
            }
        }

        return $this->render('mypost', compact('model', 'rows'));
    }

    // DeletePost
    public function actionDeletepost($id)
    {
        $deleteRows = Product::findOne($id);
        if ($deleteRows) $deleteRows->delete();

        $rows = Product::find()->all();
        $model = new AddPost();
        return $this->redirect(['mypost', compact('model', 'rows')]);
    }

    // UpdatePost   
    public function actionUpdatepost($id)
    {
        $modelOne = Product::findOne($id);
        $model = new AddPost();

        if ($model->load(Yii::$app->request->post())) {
            $modelOne->name = $model->name;
            $modelOne->content = $model->content;

            $modelOne->save();
            $rows = Product::find()->all();
            $model1 = new AddPost();
            $model = $model1;
            return $this->redirect(['mypost', compact('model', 'rows')]);
        }

        $model->name = $modelOne->name;
        $model->content = $modelOne->content;

        return $this->render('updatepost', compact('model'));
    }
}
