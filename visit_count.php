 <?php
    $cookieName = 'visit_count';

    // Check if the cookie is set
    if (isset($_COOKIE[$cookieName])) {
        // Cookie is set, no need to increment the count
        $visitCount = $_COOKIE[$cookieName];
    } else {
        // Cookie is not set, or it has expired
        $visitCount = 1;

        // Set the updated count in the cookie with an expiration time at the end of the day
        setcookie($cookieName, $visitCount, strtotime('tomorrow') - time());

        // Insert the visit count along with the current date and time into the visited_count table
        $currentDateTime = date('Y-m-d H:i:s');
        DB::insert('visited_count', ['visit_count' => $visitCount, 'visit_datetime' => $currentDateTime]);
    }

    // Now $visitCount contains the updated count
    ?>

