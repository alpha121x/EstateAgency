<?php
include('db_config.php');
// get the post id from the url
$id = $_GET['agent_id'];
// get the post category from the database
$agent = DB::queryFirstRow("SELECT * FROM agents WHERE agent_id=%i", $id);
?>

<head>
  <title>Edit Agents</title>
  <?php include("include/linked-files.php") ?>
</head>

<body>

  
  <?php include("include/header-nav.php") ?>  
 
  <?php include("include/side-nav.php") ?> 

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Posts</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Edit Agents</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Form</h5>

              <!-- Horizontal Form -->
              <form method="post" action="fire-update-querries" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="inputusername"  class="col-sm-2 col-form-label">Agent Name</label>
                  <div class="col-sm-6">
                    <input type="hidden" value="<?php echo $agent['agent_id'] ?>"  name="edit_agent_id">
                    <input type="text" value="<?php echo $agent['agent_name'] ?>" class="form-control" placeholder="Enter Name" name="agent_name">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Agent About</label>
                  <div class="col-sm-6">
                    <textarea name="agent_about" class="form-control" placeholder="Enter content" cols="30" rows="10"><?php echo $agent['agent_about'] ?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Phone</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $agent['agent_phone'] ?>" placeholder="Enter Phone" name="agent_phone">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-6">
                    <input type="email" class="form-control" value="<?php echo $agent['agent_email'] ?>" placeholder="Enter Email" name="agent_email">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputimage" class="col-sm-2 col-form-label">Add Agent Image</label>
                  <div class="col-sm-6">
                    <input type="file" class="form-control" name="agent_image">
                    <?php if ($agent['agent_image']) : ?>
                      <img src="<?php echo $agent['agent_image']; ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                    <?php endif; ?>  
                  </div>
                </div>
                   
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="update-agent"><i class='bx bx-upload'></i> Add</button>
                </div>
                <br>
              </form><!-- End Horizontal Form -->

            </div>
          </div>

      

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include("include/footer.php") ?> 

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php include("include/script-files.php") ?>

</body>
































