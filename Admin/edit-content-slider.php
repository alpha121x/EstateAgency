<?php
require("auth.php");

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    include("db_config.php");
    require_once("include/classes/meekrodb.2.3.class.php");

    // Retrieve property details by ID
    $property = DB::queryFirstRow("SELECT * FROM home_content_slider WHERE id=%i", $property_id);

    if (!$property) {
        // Handle the case where no property is found with the given ID
        echo "Property not found.";
        exit;
    }

    // Handle the form submission for updating property details
    if (isset($_POST['update-content'])) {

        // Check if 'plot_image' key exists in the $_FILES array
        if (isset($_FILES['plot_image'])) {
            // File Upload
            $uploadsFolder = 'uploads/';
            $property_image = $uploadsFolder . basename($_FILES['plot_image']['name']);

            // Debugging: Display file details
            echo "File Name: " . $_FILES['plot_image']['name'] . "<br>";
            echo "File Size: " . $_FILES['plot_image']['size'] . "<br>";
            echo "Temp File: " . $_FILES['plot_image']['tmp_name'] . "<br>";

            // Check if a new image was provided and update the file path accordingly
            if ($_FILES['plot_image']['size'] > 0) {
                // Remove the existing image file
                $existingImage = DB::queryFirstField("SELECT property_image FROM home_content_slider WHERE id=%i", $property_id);
                if ($existingImage) {
                    unlink($existingImage);
                }

                // Upload the new image
                $uploadSuccess = move_uploaded_file($_FILES['plot_image']['tmp_name'], $property_image);

                if (!$uploadSuccess) {
                    echo "Error uploading file.";
                    exit;
                }
            } else {
                // If no new image provided, retain the existing image path
                $property_image = DB::queryFirstField("SELECT property_image FROM home_content_slider WHERE id=%i", $property_id);
            }
        } else {
            // If 'plot_image' key is not set in $_FILES, handle accordingly (e.g., set $property_image to the existing path)
            $property_image = DB::queryFirstField("SELECT property_image FROM home_content_slider WHERE id=%i", $property_id);
        }



        // Extract data from the form
        $updated_property = [
            'property_num' => htmlspecialchars($_POST['plot_num']),
            'bidding_days' => htmlspecialchars($_POST['bidding_days']),
            'property_title' => htmlspecialchars($_POST['plot_title']),
            'property_location' => htmlspecialchars($_POST['plot_location']),
            'property_price' => htmlspecialchars($_POST['plot_price']),
            'property_status' => htmlspecialchars($_POST['plot_status']),
            'property_image' => $property_image,
            // Add more fields as needed
        ];

        // Update the property details in the database
        DB::update('home_content_slider', $updated_property, 'id=%i', $property_id);

        // Redirect to the property listing page after update
        header("Location: home-content-listing.php");
        exit;
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Edit Property</title>
        <?php include("include/linked-files.php") ?>
    </head>

    <body>

        <?php include("include/header-nav.php") ?>

        <?php include("include/side-nav.php") ?>

        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Edit Property</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="property-listing.php">Property Listing</a></li>
                        <li class="breadcrumb-item">Edit Property</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Edit Property</h5>
                                <!-- Form for updating property details -->
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="inputPropertyNum" class="col-sm-2 col-form-label">Property Number</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" placeholder="Enter Property Number" required name="plot_num" value="<?php echo $property['property_num']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputBiddingDays" class="col-sm-2 col-form-label">Bidding Days</label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" placeholder="Enter Bidding Days" name="bidding_days" value="<?php echo $property['bidding_days']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="plotStatus" class="col-sm-2 col-form-label">Property Status</label>
                                        <div class="col-sm-6">
                                            <select class="form-select" required name="plot_status">
                                                <option value="1" <?php echo ($property['property_status'] == 1) ? 'selected' : ''; ?>>For Sale</option>
                                                <option value="2" <?php echo ($property['property_status'] == 2) ? 'selected' : ''; ?>>For Rent</option>
                                                <option value="3" <?php echo ($property['property_status'] == 3) ? 'selected' : ''; ?>>Sold</option>
                                                <option value="4" <?php echo ($property['property_status'] == 4) ? 'selected' : ''; ?>>Under Contract</option>
                                                <option value="5" <?php echo ($property['property_status'] == 5) ? 'selected' : ''; ?>>Reserved</option>
                                                <option value="6" <?php echo ($property['property_status'] == 6) ? 'selected' : ''; ?>>Development in Progress</option>
                                                <option value="7" <?php echo ($property['property_status'] == 7) ? 'selected' : ''; ?>>Not Available</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPropertyPrice" class="col-sm-2 col-form-label">Property Price</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" required placeholder="Enter Property Price" name="plot_price" value="<?php echo $property['property_price']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPropertyTitle" class="col-sm-2 col-form-label">Property Title</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" required placeholder="Enter Property Title.." name="plot_title" value="<?php echo $property['property_title']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPropertyLocation" class="col-sm-2 col-form-label">Property Location</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" required placeholder="Enter Property Location.." name="plot_location" value="<?php echo $property['property_location']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPropertyImage" class="col-sm-2 col-form-label">Add Image</label>
                                        <div class="col-sm-6">
                                            <input type="file" required class="form-control" name="plot_image">
                                            <?php if ($property['property_image']) : ?>
                                                <img src="<?php echo $property['property_image']; ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary" name="update-content"><i class='bx bx-save'></i> Save Changes</button>
                                    </div>
                                </form>
                                <!-- End Form for updating property details -->
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
<?php
} else {
    // Handle the case where no ID is provided in the URL
    echo "Property ID not specified.";
}
?>