<!--  write code for shwoing posts in a data table -->
 <?php
include('db_config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Posts</title>
  <?php include("include/linked-files.php") ?>
</head>

<body>

    <?php include("include/header-nav.php") ?>

    <?php include("include/side-nav.php") ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Posts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Posts</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Posts</h5>
                            <p>View All</p>

                            <!-- Table with stripped rows -->
                                <table class="table table-bordered" style="background-color: white;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include("db_config.php");

                                        $posts = DB::query("SELECT * FROM posts ORDER BY date_posted DESC");

                                        if ($posts) {
                                            $index = 1;
                                            foreach ($posts as $post) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $index; ?></td>
                                                    <td><?php echo $post['post_title']; ?></td>
                                                    <td><?php echo $post['post_category']; ?></td>
                                                    <td><?php echo $post['date_posted']; ?></td>
                                                    <td  class="text-center">
                                                        <a href="edit-posts?post_id=<?php echo $post['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                        <a href="delete-post?post_id=<?php echo $post['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                        <?php
                                                $index++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>

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
