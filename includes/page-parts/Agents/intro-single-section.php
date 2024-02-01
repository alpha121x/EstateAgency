<?php
include('Admin/db_config.php');

// get the agent id from the URL
$id = $_GET['agent_id'];

// get the agent details from the database
$agent = DB::queryFirstRow("SELECT * FROM agents WHERE agent_id=%i", $id);
?>

<section class="intro-single">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-8">
        <div class="title-single-box">
          <h1 class="title-single"><?php echo $agent['agent_name']; ?></h1>
          <span class="color-text-a">Agent Details</span>
        </div>
      </div>
      <div class="col-md-12 col-lg-4">
        <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="#">Agents</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              <?php echo $agent['agent_name']; ?>
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>
