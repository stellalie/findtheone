<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
$this->breadcrumbs=array(
	UserModule::t("Registration"),
);
?>

<h1><?php echo UserModule::t("Registration"); ?></h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'registration-form',
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
<?php echo $form->passwordFieldRow($model,'verifyPassword', array('class'=>'input-medium')); ?>
<?php echo $form->textFieldRow($model,'email', array('class'=>'input-medium')); ?>

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

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton',array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Register',
        )); ?>
    </div>

<?php $this->endWidget(); ?>