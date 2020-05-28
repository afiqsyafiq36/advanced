<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Locations;
use PHPUnit\Util\Log\JSON;

/* @var $this yii\web\View */
/* @var $model backend\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip_code')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Locations::find()->all(), 'location_id','zip_code'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Zip Code...', 'id' => 'zipCode'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        ]);
    ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'id' => 'fcity']) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true, 'id' => 'fprovince']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
$this->registerJS(<<<JS
    //js code here
    $('#zipCode').change(function(){
        var zipCode = $(this).val();
        // alert(zipCode);
        $.get('index.php?r=locations/get-city-province', {'zipId':zipCode}, function(data) {
            var data = $.parseJSON(data);
            $('#fcity').attr('value',data.city);
            $('#fprovince').attr('value',data.province);
        });
    });
JS
);?>
