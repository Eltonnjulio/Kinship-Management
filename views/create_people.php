<?php
wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css');
wp_enqueue_style('bootstrap');
?>

<form id="create_form" action="" method="post">

    <div class="form-group">
        <label for="recipient-name" class="control-label">Name:</label>
        <input type="text" name="name" class="form-control" id="name">
    </div>
    <div class="form-group">
        <label for="recipient-name" class="control-label">Age:</label>
        <input type="number" class="form-control" name="age" id="age">
    </div>
    <div class="form-group">
        <input type="submit" class="form-control">
    </div>
</form>


<?php
wp_register_script('jQuery', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js', null, null, true);
wp_enqueue_script('jQuery');
?>