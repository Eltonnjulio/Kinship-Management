<?php
wp_register_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css' );
wp_enqueue_style('bootstrap');
?>

<div class="container" >
<div class="row">
    </div>
<div class="row">
    <br>
    <br>
    <div class="col-12"><a href="" type="button" class="mb-3 ml-4 btn btn-primary btn-rounded float-right">Add People</a></div>


</div>


    <br>
    <br>
<table class="table">
  <thead >
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Age</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>Otto</td>
    </tr>
   
  </tbody>
</table>
</div>
<?php 
wp_register_script( 'jQuery', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js', null, null, true );
wp_enqueue_script('jQuery');
?>