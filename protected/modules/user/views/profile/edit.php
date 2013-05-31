<?php
    $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
    $this->breadcrumbs=array(
        UserModule::t("Profile")=>array('profile'),
        UserModule::t("Edit"),
    );
    $this->menu=array(
        ((UserModule::isAdmin())?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')):array()),
        ((UserModule::isAdmin())?array('label'=>UserModule::t('List User'), 'url'=>array('/user')):array()),
        array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile')),
        array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
        array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
    );
?>
<h1><?php echo UserModule::t('Edit profile'); ?></h1>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>



<h1><?php echo UserModule::t("Change Password"); ?></h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'edit-profile-form',
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
<?php
// TODO: not yet bootstrapped (only if i have a spare time)
$profileFields=$profile->getFields();
if ($profileFields) {
    foreach($profileFields as $field) {
        if ($widgetEdit = $field->widgetEdit($profile)) { ?>
            <div class="control-group">
                <div class="control-label"><?php echo $form->labelEx($profile,$field->varname); ?></div>
                <div class="controls"><?php echo $widgetEdit; ?></div>
            </div>
        <?php
        } elseif ($field->range) {
            echo $form->dropDownListRow($profile,$field->varname,Profile::range($field->range));
        } elseif ($field->field_type=="TEXT") {
            echo$form->textAreaRow($profile,$field->varname,array('class'=>'input-medium'));
        } else {
            echo $form->textFieldRow($profile,$field->varname,array('class'=>'input-medium'));            }
        echo $form->error($profile,$field->varname);
    }
}
?>
<?php echo $form->passwordFieldRow($model,'username', array('class'=>'input-medium')); ?>
<?php echo $form->passwordFieldRow($model,'email', array('class'=>'input-medium')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton',array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>'Save',
    )); ?>
</div>

<?php $this->endWidget(); ?>