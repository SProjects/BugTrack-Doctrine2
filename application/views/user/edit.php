<h4><a href="<?php echo site_url().'/users/'; ?>">Back To Users Page</a></h4>
<h3>Edit User Details</h3>
<?php echo form_open('users/update/'.$user->displayInfo('id')); ?>
    <table>
        <tr>
            <td><label>Enter Name:</label></td>
            <td><?php echo form_input('name', $user->displayInfo('name'), 'id = "name"'); ?></td>
        </tr>
        <tr>
            <td><label>Enter Username:</label></td>
            <td><?php echo form_input('username', $user->displayInfo('username'), 'id = "username"'); ?></td>
        </tr>
        <tr>
            <td><label>Enter Email:</label></td>
            <td><?php echo form_input('email', $user->displayInfo('email'), 'id = "email"'); ?></td>
        </tr>
        <tr>
            <td colspan="2"><?php echo form_submit('submit', 'Update User Details')?></td>
        </tr>
    </table>
<?php echo form_close(); ?>