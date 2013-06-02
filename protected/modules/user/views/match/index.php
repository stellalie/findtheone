<?php
$this->breadcrumbs=array(
    UserModule::t("Find Your Match"),
);
if(UserModule::isAdmin()) {
    $this->layout='//layouts/column1';
}
?>

<h1>Find your Match</h1>

    <div class="grid-view">
        <table class="items table table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>State</th>
                    <th>Age</th>
                    <th>Similiarity Score</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($similiarPeople as $id => $score) { ?>
                    <tr>
                        <td><?php echo CHtml::link(CHtml::encode(UserModule::user($id)->profile->first_name." ".UserModule::user($id)->profile->last_name),array("match/view","id"=>$id)) ?></td>
                        <td><?php echo UserModule::user($id)->profile->state; ?></td>
                        <td><?php echo $this->calculateAge(UserModule::user($id)->profile->dob); ?></td>
                        <td><?php echo $score; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>



