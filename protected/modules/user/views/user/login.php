<?php
    $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
    $this->breadcrumbs=array(
        UserModule::t("Login"),
    );
?>

<h1><?php echo UserModule::t("Login"); ?></h1>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'login-form',
    'type'=>'horizontal',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
    'htmlOptions'=>array(
        'class'=>'well',
    ),
)); ?>

<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model,'username', array('class'=>'input-medium')); ?>
<?php echo $form->passwordFieldRow($model,'password', array('class'=>'input-medium')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton',array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>'Register',
    )); ?>
</div>

<?php $this->endWidget(); ?>