<h4><a href="<?php echo site_url().'/bugs/index/'.$bug->displayInfo('user')->displayInfo('id'); ?>">Back To Bug Page</a></h4>
<h3>Edit Bug Details</h3>
<?php echo form_open('bugs/update/'.$bug->displayInfo('id')); ?>
    <table>
        <tr>
            <td><label>Title:</label></td>
            <td><?php echo form_input('title', $bug->displayInfo('title'), 'id = "title"'); ?></td>
        </tr>
        <tr>
            <td><label>Description:</label></td>
            <td><?php echo form_textarea('description', $bug->displayInfo('description'), 'id = "description"'); ?></td>
        </tr>
        <tr>
            <td><label>Status:</label></td>
            <td>
                <?php
                    echo form_dropdown('status', Entity\Status::serialize($statuses), $bug->displayInfo('status')->displayInfo('id'));
                ?>
            </td>
        </tr>
        <tr>
            <td><label>Owner:</label></td>
            <td>
                <?php
                    echo form_dropdown('user', Entity\User::serialize($users), $bug->displayInfo('user')->displayInfo('id'));
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"><?php echo form_submit('submit', 'Update Bug Details')?></td>
        </tr>
    </table>
<?php echo form_close(); ?>