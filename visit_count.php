 <?php
    $cookieName = 'visit_count';
    $cookieDateName = 'visit_date';
    
    // Check if the cookie is set
    if (isset($_COOKIE[$cookieName]) && isset($_COOKIE[$cookieDateName])) {
        $storedDate = $_COOKIE[$cookieDateName];
    
        // Check if the stored date is the same as the current date
        if ($storedDate === date('Y-m-d')) {
            // Cookie is set, and it's the same day, no need to increment the count
            $visitCount = $_COOKIE[$cookieName];
        } else {
            // Cookie is set, but it's a new day; reset the count
            $visitCount = 1;
    
            // Update the stored date in the cookie
            setcookie($cookieDateName, date('Y-m-d'), strtotime('tomorrow') - time());
    
            // Set the updated count in the cookie with an expiration time at the end of the day
            setcookie($cookieName, $visitCount, strtotime('tomorrow') - time());
    
            // Insert the visit count along with the current date and time into the visited_count table
            $currentDateTime = date('Y-m-d H:i:s');
            DB::insert('visited_count', ['visit_count' => $visitCount, 'visit_datetime' => $currentDateTime]);
        }
    } else {
        // Cookie is not set or has expired
        $visitCount = 1;
    
        // Set the updated count and date in the cookies with an expiration time at the end of the day
        setcookie($cookieDateName, date('Y-m-d'), strtotime('tomorrow') - time());
        setcookie($cookieName, $visitCount, strtotime('tomorrow') - time());
    
        // Insert the visit count along with the current date and time into the visited_count table
        $currentDateTime = date('Y-m-d H:i:s');
        DB::insert('visited_count', ['visit_count' => $visitCount, 'visit_datetime' => $currentDateTime]);
    }
     // Now $visitCount contains the updated count
    ?>

