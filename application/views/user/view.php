<h3>List of Users</h3>
<?php
    if(sizeof($users)>0){
?>
    <table style="border: 1 solid red; padding: 2px 8px; width: 60%;">
        <thead>
            <tr style="text-align: left;">
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
                <th>Bugs</th>
            </tr>
        <tbody>
            <?php
                foreach($users as $user){
            ?>
                    <tr>
                        <td>
                            <?php echo $user->displayInfo('name'); ?>
                        </td>
                        <td>
                            <?php echo $user->displayInfo('email'); ?>
                        </td>
                        <td>
                            <a href="<?php echo site_url().'/users/edit/'.$user->displayInfo('id'); ?>">Edit</a>
                            <a href="<?php echo site_url().'/users/show_json/'.$user->displayInfo('id'); ?>">JSON</a>
                            <a href="<?php echo site_url().'/users/delete/'.$user->displayInfo('id'); ?>">Delete</a>
                        </td>
                        <td>
                            <a href="<?php echo site_url().'/bugs/index/'.$user->displayInfo('id'); ?>">View Bugs</a>
                        </td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
<?php
    }else{
        echo "No users found.";
    }
?>

<br/>
<hr>
<br/>

<h3>Create New User</h3>
    <?php echo form_open('users/create'); ?>
        <table>
            <tr>
                <td><label>Enter Name:</label></td>
                <td><?php echo form_input('name'); ?></td>
            </tr>
            <tr>
                <td><label>Enter Username:</label></td>
                <td><?php echo form_input('username'); ?></td>
            </tr>
            <tr>
                <td><label>Enter Password:</label></td>
                <td><?php echo form_password('password'); ?></td>
            </tr>
            <tr>
                <td><label>Enter Email:</label></td>
                <td><?php echo form_input('email'); ?></td>
            </tr>
            <tr>
                <td colspan="2"><?php echo form_submit('submit', 'Create New User')?></td>
            </tr>
        </table>
    <?php echo form_close(); ?>

