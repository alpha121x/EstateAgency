<?php
 require_once "Admin/include/classes/meekrodb.2.3.class.php";
 require('Admin/db_config.php'); // Make sure you include your database configuration file

// Assuming your URL is like: http://example.com/property-detail.php?id=123
$property_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch data from the database based on the provided property ID
$property = DB::queryFirstRow("SELECT * FROM plot_listing WHERE plot_id = %i", $property_id);

// Check if the property exists
if ($property) {
?>
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single"><?php echo $property['plot_title']; ?></h1>
                        <span class="color-text-a"><?php echo $property['plot_location']; ?></span>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="property-grid.html">Properties</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?php echo $property['plot_title']; ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
<?php
} else {
    // Display a message or redirect if the property with the provided ID is not found
    echo "Property not found.";
}
?>
