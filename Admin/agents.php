<?php require("auth.php") ?>

<head>

    <title>Agents</title>

    <?php include("include/linked-files.php") ?>

</head>

<body>

    <?php include("include/header-nav.php") ?>

    <?php include("include/side-nav.php") ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Agents</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Agents</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Agents</h5>
                            <p>View All</p>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table table-bordered" style="background-color: white;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include("db_config.php");

                                        // Select all users from the admin_users table
                                        $agents = DB::query("SELECT * FROM agents");

                                        if ($agents) {
                                            $index = 1;
                                            foreach ($agents as $agent) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $index; ?></td>
                                                    <td><?php echo $agent['agent_name']; ?></td>
                                                    <td><?php echo $agent['agent_email']; ?></td>
                                                    <td><?php echo $agent['agent_phone']; ?></td>
                                                    <td  class="text-center">
                                                        <a href="edit-agents?agent_id=<?php echo $agent['agent_id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                        <?php
                                                $index++;
                                            }
                                        }
                                        ?>
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
