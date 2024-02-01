<section class="section-agents section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Best Agents</h2>
              </div>
              <div class="title-link">
                <a href="agents-grid">All Agents
                  <span class="bi bi-chevron-right"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
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
                    <a href="#" class="link-two"><?php echo $agent['agent_name']; ?></a>
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
      </div>
    </section>