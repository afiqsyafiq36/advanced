<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BranchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Create Branches', ['value' => Url::to(['branches/create']), 'title' => 'Branches', 'class' => 'btn btn-success', 'id' => 'modalButton2']) ?>
        <?= Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value' => Url::to(['branches/create']), 'title' => 'Branches', 'class' => 'showModalButton btn btn-success']); ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    //modal popup windows for form DoingITeasychannel
        Modal::begin([
            'headerOptions' => ['id' => 'modalHeader2'],
            // 'header' => '<h4>Branches</h4>',
            'id' => 'modal2',
            'size' => 'modal-lg',
        ]);
        echo "<div id='modalContent2'></div>";
        Modal::end();
    ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => 
            function($model) {
                if ($model->branch_status == 'inactive')
                {
                    return ['class' => 'danger'];
                }
                else 
                {
                    return ['class' => 'success'];
                }
            },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                //add filter grid column for column/attribute relation
                'attribute' => 'companies_company_id',
                'value' => 'companiesCompany.company_name',
            ],
            'branch_name',
            'branch_address',
            'branch_created_date',
            'branch_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
