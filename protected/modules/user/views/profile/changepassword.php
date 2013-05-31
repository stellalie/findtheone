<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");
$this->breadcrumbs=array(
	UserModule::t("Profile") => array('/user/profile'),
	UserModule::t("Change Password"),
);
$this->menu=array(
    ((UserModule::isAdmin())?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')):array()),
    ((UserModule::isAdmin())?array('label'=>UserModule::t('List User'), 'url'=>array('/user')):array()),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile')),
    array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
);
?>
<h1><?php echo UserModule::t("Change password"); ?></h1>



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
<?php echo $form->passwordFieldRow($model,'oldPassword', array('class'=>'input-medium')); ?>
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