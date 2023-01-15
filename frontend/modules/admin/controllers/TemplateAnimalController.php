<?php

namespace app\modules\admin\controllers;

use common\models\Animaltype;
use common\models\Regulations;
use common\models\SampleTypes;
use common\models\TamplateAnimal;
use common\models\search\TamplateAnimalSearch;
use common\models\TemplateAnimalRegulations;
use common\models\TemplateAnimalTypes;
use common\models\TemplateSamples;
use common\models\TemplateUnit;
use common\models\TemplateUnitType;
use Yii;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TemplateAnimalController implements the CRUD actions for TamplateAnimal model.
 */
class TemplateAnimalController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all TamplateAnimal models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TamplateAnimalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TamplateAnimal model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TamplateAnimal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TamplateAnimal();
        $model->creator_id = Yii::$app->user->id;
        $model->consent_id = Yii::$app->user->id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if($model->unit->type_id == 2){
                    $model->min = "$model->true";
                    $model->max = "$model->true1";
                }elseif($model->unit->type_id == 5){
                    $model->min = "$model->mm_1";
                    $model->max = "$model->mm_2";
                }
                $model->save();
                if(array_key_exists('regulations',$this->request->post('TamplateAnimal'))){
                    foreach ($this->request->post('TamplateAnimal')['regulations'] as $reg) {
                        $relation = new TemplateAnimalRegulations();
                        $relation->regulation_id = $reg;
                        $relation->template_id = $model->id;
                        $relation->state_id = $model->state_id;
                        $relation->save();
                    }
                }

                if(array_key_exists('animals',$this->request->post('TamplateAnimal'))){

                    foreach ($this->request->post('TamplateAnimal')['animals'] as $reg) {
                        $relation = new TemplateAnimalTypes();
                        $relation->type_id = $reg;
                        $relation->template_id = $model->id;
                        $relation->save();
                    }
                }

                if(array_key_exists('types',$this->request->post('TamplateAnimal'))){
                    foreach ($this->request->post('TamplateAnimal')['types'] as $reg) {
                        $relation = new TemplateSamples();
                        $relation->type_id = $reg;
                        $relation->template_id = $model->id;
                        $relation->save();
                    }
                }


                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TamplateAnimal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->unit->type_id == 2){$model->true = $model->min; $model->true1 = $model->max;}
        if ($this->request->isPost && $model->load($this->request->post())) {
            if($model->unit->type_id == 2){
                $model->min = "$model->true";
                $model->max = "$model->true1";
            }
            $model->save();
            if(array_key_exists('regulations',$this->request->post('TamplateAnimal'))){
                foreach ($this->request->post('TamplateAnimal')['regulations'] as $reg) {
                    $relation = new TemplateAnimalRegulations();
                    $relation->regulation_id = $reg;
                    $relation->template_id = $model->id;
                    $relation->state_id = $model->state_id;
                    $relation->save();
                }
            }

            if(array_key_exists('animals',$this->request->post('TamplateAnimal'))){

                foreach ($this->request->post('TamplateAnimal')['animals'] as $reg) {
                    $relation = new TemplateAnimalTypes();
                    $relation->type_id = $reg;
                    $relation->template_id = $model->id;
                    $relation->save();
                }
            }

            if(array_key_exists('types',$this->request->post('TamplateAnimal'))){
                foreach ($this->request->post('TamplateAnimal')['types'] as $reg) {
                    $relation = new TemplateSamples();
                    $relation->type_id = $reg;
                    $relation->template_id = $model->id;
                    $relation->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDeleteregulation($template_id, $regulation_id){
        if($model = TemplateAnimalRegulations::findOne(['template_id'=>$template_id,'regulation_id'=>$regulation_id])){
            $model->delete();
            Yii::$app->session->setFlash('success','Element muvoffaqiyatli o`chirildi');
        }else{
            Yii::$app->session->setFlash('error','Elementni o`chirishda xatolik');
        }

        return $this->redirect(['view','id'=>$template_id]);
    }

    public function actionCreateregulation($template_id){
        $model = new TemplateAnimalRegulations();
        $model->template_id = $template_id;
        if($model->load($this->request->post())){
            if( $model->save()){
                Yii::$app->session->setFlash('success','Ma`lumot saqlandi');
            }else{
                Yii::$app->session->setFlash('success','Ma`lumotni saqlashda xatolik');
            }
            return $this->redirect(['view','id'=>$template_id]);
        }
        $regs = Regulations::find()->where('id not in (select regulation_id from template_animal_regulations where template_id = '.$template_id.')')->all();
        return $this->renderAjax('createregulation',['model'=>$model,'regs'=>$regs]);
    }


    public function actionDeletesample($template_id, $regulation_id){
        if($model = TemplateSamples::findOne(['template_id'=>$template_id,'type_id'=>$regulation_id])){
            $model->delete();
            Yii::$app->session->setFlash('success','Element muvoffaqiyatli o`chirildi');
        }else{
            Yii::$app->session->setFlash('error','Elementni o`chirishda xatolik');
        }

        return $this->redirect(['view','id'=>$template_id]);
    }

    public function actionCreatesample($template_id){
        $model = new TemplateSamples();
        $model->template_id = $template_id;
        if($model->load($this->request->post())){
            if( $model->save()){
                Yii::$app->session->setFlash('success','Ma`lumot saqlandi');
            }else{
                Yii::$app->session->setFlash('success','Ma`lumotni saqlashda xatolik');
            }
            return $this->redirect(['view','id'=>$template_id]);
        }
        $regs = SampleTypes::find()->where('id not in (select type_id from template_samples where template_id = '.$template_id.')')->all();
        return $this->renderAjax('createsample',['model'=>$model,'regs'=>$regs]);
    }


    public function actionDeleteanimal($template_id, $regulation_id){
        if($model = TemplateAnimalTypes::findOne(['template_id'=>$template_id,'type_id'=>$regulation_id])){
            $model->delete();
            Yii::$app->session->setFlash('success','Element muvoffaqiyatli o`chirildi');
        }else{
            Yii::$app->session->setFlash('error','Elementni o`chirishda xatolik');
        }

        return $this->redirect(['view','id'=>$template_id]);
    }

    public function actionCreateanimal($template_id){
        $model = new TemplateAnimalTypes();
        $model->template_id = $template_id;
        if($model->load($this->request->post())){
            if( $model->save()){
                Yii::$app->session->setFlash('success','Ma`lumot saqlandi');
            }else{
                Yii::$app->session->setFlash('success','Ma`lumotni saqlashda xatolik');
            }
            return $this->redirect(['view','id'=>$template_id]);
        }
        $regs = Animaltype::find()->where('id not in (select type_id from template_animal_types where template_id = '.$template_id.')')->all();
        return $this->renderAjax('createanimal',['model'=>$model,'regs'=>$regs]);
    }


    /**
     * Deletes an existing TamplateAnimal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TamplateAnimal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TamplateAnimal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TamplateAnimal::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionGettype($id){
        return TemplateUnit::findOne($id)->type_id;
    }
}
