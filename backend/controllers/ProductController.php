<?php

namespace backend\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use app\models\ProcessRelation;
use app\models\Process;
use app\models\Spec;
use app\models\Trace;
use app\models\Employee;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */

    public function actionView($id)
    {

        $post_request = Yii::$app->request->post();
        if($post_request) {
            $src_product_id = $post_request["src_product_id"];
            $quantity = $post_request["quantity"];
            $process_id = $post_request["process_id"];
            $product = Product::find()->where("id=".$src_product_id)->one(); 
            $product["quantity"] = $product["quantity"] - $quantity;
            $product["in_process"] = 1;
            $product->save(false);

            return $this->redirect(['create',"process_id" => $process_id,"src_product_id" => $src_product_id]);
        }
        $model = $this->findModel($id);
        $spec = Spec::find()->where("id=".$model["spec_id"])->one(); 

        $process_id = 1;
        $trace = Trace::find()->where("dest_product_id=".$model["id"])->one();

        if($trace) {
            $process_id = $trace["process_id"];

        }
        $processRelations = ProcessRelation::find()->where("parent_process_id=".$process_id)->all(); 
        $nextProcesses = [];   

        foreach($processRelations as $item) {
            $processId = $item["process_id"];


            $process = Process::find()->where("id=".$processId)->one(); 
            $processName = $process["name"];

            $nextProcesses[] = [
                "id" => $processId,
                "name" => $processName
            ];
        }      
        return $this->render('view', [
            'model' => $model,
            'quantity' => $model["quantity"],
            'spec_name' => $spec["name"],
            'src_product_id' => $model["id"],
            'nextProcesses' => $nextProcesses
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $request = Yii::$app->request;

        $src_product_id = $request->get('src_product_id');

        if(!$src_product_id) {
            $src_product_id = 0;
        }

        $process_id=$request->get('process_id');
        if(!$process_id) {
            $process_id = 1;
        }
        $process = Process::find()->where("id=".$process_id)->one();
        $process_name = $process["name"]; 
        $quantity = $request->get('quantity');
        if($quantity) {
            $model->quantity = $quantity;
        }

        $employees = Employee::find()->all();
        $employeeIds = [];
        $employeeNames = [];
        foreach($employees as $item) {
            $employeeIds[] = $item["id"];
            $employeeNames[] = $item["name"];
        }

        $post_request = Yii::$app->request->post();
        if ($model->load($post_request) && $model->save()) {
            $dest_product_id = $model->id;
            $src_product_id = $post_request["src_product_id"];
            $employee_id = $post_request["employee"];
            $hours = $post_request["hours"];

            $trace = new Trace();
            if($src_product_id) {
                $trace["src_product_id"] = $src_product_id;
            }
            
            $trace["dest_product_id"] = $dest_product_id;
            $trace["employee_id"] = $employee_id;
            $trace["process_id"] = $process_id;
            $trace["hours"] = $hours;
            $trace->save(false);
            if (isset($post_request['next_product'])) {
                 return $this->redirect(Yii::$app->request->referrer);
            }
            else {
                $srcProduct = Product::find()->where("id=".$src_product_id)->one(); 
                $srcProduct["in_process"] = 0;
                $srcProduct->save(false);
                return $this->redirect(['index']);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
                'process_name' => $process_name,
                'employeeIds' => $employeeIds,
                'employeeNames' => $employeeNames,
                'src_product_id' => $src_product_id
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
