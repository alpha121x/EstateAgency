<section class="agents-grid grid">
  <div class="container">
    <div class="row">
      <?php
      // Include necessary files and configurations
      require_once "Admin/include/classes/meekrodb.2.3.class.php";
      require('Admin/db_config.php'); // Include your database configuration file

      // Fetch data from the agents table
      $agents = DB::query("SELECT * FROM agents");

      foreach ($agents as $agent) {
      ?>
        <div class="col-md-4">
          <div class="card-box-d">
            <div class="card-img-d">
              <img src="Admin/<?php echo $agent['agent_image']; ?>" alt="" class="img-d img-fluid">
            </div>
            <div class="card-overlay card-overlay-hover">
              <div class="card-header-d">
                <div class="card-title-d align-self-center">
                  <h3 class="title-d">
                    <a href="agent-single&agent_id=<?php echo $agent['agent_id']; ?>" class="link-two"><?php echo $agent['agent_name']; ?></a>
                  </h3>
                </div>
              </div>
              <div class="card-body-d">
                <p class="content-d color-text-a">
                  <?php echo $agent['agent_about']; ?>
                </p>
                <div class="info-agents color-a">
                  <p>
                    <strong>Phone: </strong> <?php echo $agent['agent_phone']; ?>
                  </p>
                  <p>
                    <strong>Email: </strong> <?php echo $agent['agent_email']; ?>
                  </p>
                </div>
              </div>
              <div class="card-footer-d">
                <div class="socials-footer d-flex justify-content-center">
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <a href="#" class="link-one">
                        <i class="bi bi-facebook" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#" class="link-one">
                        <i class="bi bi-twitter" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#" class="link-one">
                        <i class="bi bi-instagram" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#" class="link-one">
                        <i class="bi bi-linkedin" aria-hidden="true"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>

    </div>
    <div class="row">
      <div class="col-sm-12">
        <nav class="pagination-a">
          <ul class="pagination justify-content-end">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1">
                <span class="bi bi-chevron-left"></span>
              </a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item next">
              <a class="page-link" href="#">
                <span class="bi bi-chevron-right"></span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</section>