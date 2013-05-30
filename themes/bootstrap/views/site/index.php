<?php
/* @var $this SiteController */
/* @var $model RegistrationForm */
/* @var $form TbActiveForm */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>CHtml::encode(Yii::app()->name),
)); ?>
    <p>Feeling "ronery"? Find your match here!</p>
<?php $this->endWidget(); ?>

<?php if(Yii::app()->user->isGuest) { ?>
    <div class="row">
        <div class="span5">
            <?php $this->widget('application.modules.user.widgets.LoginWidget'); ?>
        </div>
        <div class="span5">
            <p>Not yet registered?</p>
            <?php echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?>
        </div>
    </div>
<?php } ?>
