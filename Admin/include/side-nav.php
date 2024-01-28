<?php
// Check if the user is an admin
if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
    echo '<!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
   
   <ul class="sidebar-nav" id="sidebar-nav">
   
     <li class="nav-item">
       <a class="nav-link " href="index.php">
       <i class="bi bi-journal-text"></i>
         <span>Dashboard</span>
       </a>
     </li><!-- End Dashboard Nav --> 
         <li class="nav-item">
           <a class="nav-link collapsed"  href="add-user-profile.php">
           <i class="bi bi-person-fill-add"></i>
             <span>Add Users</span>
           </a>
         </li>
         <li class="nav-item">
           <a class="nav-link collapsed"  href="users_profile.php">
           <i class="bi bi-person-fill-lock"></i>
             <span>User Profile</span>
           </a>
         </li>
         <li class="nav-item">
           <a class="nav-link collapsed"  href="admin_users.php">
           <i class="bi bi-person-fill-lock"></i>
             <span>Users</span>
           </a>
         </li>
         <li class="nav-item">
         <a class="nav-link collapsed"  href="notifications.php">
         <i class="bi bi-person-fill-lock"></i>
           <span>Notifications</span>
         </a>
       </li>
         <li class="nav-item">
           <a class="nav-link collapsed"  href="plot_listing.php">
           <i class="bi bi-person-fill-lock"></i>
             <span>Plot Listing</span>
           </a>
         </li>
         <li class="nav-item">
           <a class="nav-link collapsed"  href="add_plot_listing.php">
           <i class="bi bi-person-fill-lock"></i>
             <span>Add Plots Listing</span>
           </a>
         </li>
   </aside><!-- End Sidebar-->';
} else {
    echo'<!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
   
   <ul class="sidebar-nav" id="sidebar-nav">
   
     <li class="nav-item">
       <a class="nav-link " href="index.php">
       <i class="bi bi-journal-text"></i>
         <span>Dashboard</span>
       </a>
     </li><!-- End Dashboard Nav --> 
         <li class="nav-item">
           <a class="nav-link collapsed"  href="admin_users.php">
           <i class="bi bi-person-fill-lock"></i>
             <span>Users</span>
           </a>
         </li>
         <li class="nav-item">
         <a class="nav-link collapsed"  href="users_profile.php">
         <i class="bi bi-person-fill-lock"></i>
           <span>User Profile</span>
         </a>
       </li>
         <li class="nav-item">
           <a class="nav-link collapsed"  href="plot_listing.php">
           <i class="bi bi-person-fill-lock"></i>
             <span>Plot Lisitng</span>
           </a>
         </li>
   </aside><!-- End Sidebar-->';
}
?>

