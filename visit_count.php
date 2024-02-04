 <?php
   include("Admin/db_config.php");
   $cookieName = 'visit_count';
   
   // Check if the cookie is set
   if (isset($_COOKIE[$cookieName])) {
       // Cookie is set, no need to increment the count
       $visitCount = $_COOKIE[$cookieName];
   } else {
       // Cookie is not set, or it has expired
       $visitCount = 1;
   
       // Check if the user has already visited on the current day
       $currentDate = date('Y-m-d');
       $existingVisit = DB::queryFirstField("SELECT visit_count FROM visited_count WHERE visit_datetime >= %s AND visit_datetime < %s", $currentDate . ' 00:00:00', $currentDate . ' 23:59:59');
   
       if (!$existingVisit) {
           // Set the updated count in the cookie with an expiration time at the end of the day
           setcookie($cookieName, $visitCount, strtotime('tomorrow') - time());
   
           // Insert the visit count along with the current date and time into the visited_count table
           $currentDateTime = date('Y-m-d H:i:s');
           DB::insert('visited_count', ['visit_count' => $visitCount, 'visit_datetime' => $currentDateTime]);
       }
   }
   
   // Now $visitCount contains the updated count
   
    ?>

