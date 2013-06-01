<?php
$this->breadcrumbs=array(
    UserModule::t("Find Your Match"),
);
if(UserModule::isAdmin()) {
    $this->layout='//layouts/column1';
    // leave menu empty for now
    $this->menu=array();
}
?>

<h1>Find your Match</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(
            'name' => 'Name',
            'type'=>'raw',
            'value' => 'CHtml::link(CHtml::encode($data->profile->first_name." ".$data->profile->last_name),array("match/view","id"=>$data->id))',
        ),
        array(
            'name' => 'City',
            'type'=>'raw',
            'value' => '$data->profile->city',
        ),
        array(
            'name' => 'State',
            'type'=>'raw',
            'value' => '$data->profile->state',
        ),
        array(
            'name' => 'Postcode',
            'type'=>'raw',
            'value' => '$data->profile->state',
        ),
        array(
            'name' => 'Age',
            'type'=>'raw',
            'value' => '$data->profile->dob',
        ),
        array(
            'name' => '% Match',
            'type'=>'raw',
            'value' => '',
        ),
    ),
)); ?>
