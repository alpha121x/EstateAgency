<?php require("auth.php") ?>
<?php include("db_config.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Bid Winners Emails</title>

  <?php include("include/linked-files.php") ?>

</head>

<body>

  <?php include("include/header-nav.php") ?>

  <?php include("include/side-nav.php") ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Bid Winners Emails</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Bid Winners Emails</li>
          <li class="breadcrumb-item active">Bid Winners Emailsiew All</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Bid Winners Emails</h5>
              <p>View All</p>

              <!-- Table with stripped rows -->
              <div class="table-responsive">
                <table class="table table-bordered" style="background-color: white;">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Plots</th>
                      <th scope="col">Bidding Winner</th>
                      <th scope="col">Email</th>
                      <th scope="col">Status</th>
                      <th scope="col" class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    
                    </tr>

                  </tbody>
                </table>
              </div>
              <!-- End Table with stripped rows -->

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

</html>