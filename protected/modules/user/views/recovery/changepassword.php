<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Change Password"),
);
?>

<h1><?php echo UserModule::t("Change Password"); ?></h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'recovery-form',
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
<?php echo $form->passwordFieldRow($model,'password', array('class'=>'input-medium')); ?>
<?php echo $form->passwordFieldRow($model,'verifyPassword', array('class'=>'input-medium')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton',array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>'Save',
    )); ?>
</div>

<?php $this->endWidget(); ?>