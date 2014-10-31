<h4><a href="<?php echo site_url().'/users/'; ?>">Back To Users Page</a></h4>
<h2>User: <?php echo $user->displayInfo('name'); ?></h2>
<h3>List of Bugs</h3>
<?php
if(sizeof($bugs)>0){
    ?>
    <table style="border: 1 solid red; padding: 2px 8px; width: 60%;">
        <thead>
        <tr style="text-align: left;">
            <th>Title</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <tbody>
        <?php
        foreach($bugs as $bug){
            ?>
            <tr>
                <td>
                    <?php echo $bug->displayInfo('title'); ?>
                </td>
                <td>
                    <?php echo $bug->displayInfo('status')->displayInfo('name'); ?>
                </td>
                <td>
                    <a href="<?php echo site_url().'/bugs/edit/'.$bug->displayInfo('id'); ?>">Edit</a>
                    <a href="<?php echo site_url().'/bugs/show_json/'.$bug->displayInfo('id'); ?>">JSON</a>
                    <a href="<?php echo site_url().'/bugs/delete/'.$bug->displayInfo('id'); ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
<?php
}else{
    echo "No bugs found.";
}
?>

<br/>
<hr>
<br/>

<h3>Create New Bug</h3>
<?php echo form_open('bugs/create/'.$user->displayInfo('id')); ?>
    <table>
        <tr>
            <td><label>Enter Title:</label></td>
            <td><?php echo form_input('title', '', 'id = "title"'); ?></td>
        </tr>
        <tr>
            <td><label>Enter Description:</label></td>
            <td><?php echo form_textarea('description', '', 'id = "description"'); ?></td>
        </tr>
        <tr>
            <td colspan="2"><?php echo form_submit('submit', 'Create New Bug')?></td>
        </tr>
    </table>
<?php echo form_close(); ?>

