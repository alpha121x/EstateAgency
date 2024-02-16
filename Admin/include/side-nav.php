<!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
   
   <ul class="sidebar-nav" id="sidebar-nav">
   
     <li class="nav-item">
       <a class="nav-link " href="index">
       <i class="bi bi-journal-text"></i>
         <span>Dashboard</span>
       </a>
     </li><!-- End Dashboard Nav --> 
     <li class="nav-item">
    <?php
    if ($_SESSION['user_type'] == 'admin') {
    ?>
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-people-fill"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
                <a href="add-user-profile">
                    <i class="bi bi-circle-fill text-primary"></i><span>Add Users</span>
                </a>
            </li>
            <li>
                <a href="users_profile">
                    <i class="bi bi-circle-fill text-primary"></i><span>User Profile</span>
                </a>
            </li>
            <li>
                <a href="admin_users">
                    <i class="bi bi-circle-fill text-primary"></i><span>Users</span>
                </a>
            </li>
        </ul>
    <?php
    }
    ?>
</li>


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#posts-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-file-post-fill"></i><span>Posts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="posts-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="add-posts">
            <i class="bi bi-circle-fill text-primary"></i></i><span>Add Posts</span>
            </a>
          </li>
          <li>
            <a href="posts">
              <i class="bi bi-circle-fill text-primary"></i><span>Posts</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#plots-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-houses-fill"></i><span>Plots</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="plots-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="add_plot_listing">
            <i class="bi bi-circle-fill text-primary"></i></i><span>Add Plots</span>
            </a>
          </li>
          <li>
            <a  href="plot_listing">
              <i class="bi bi-circle-fill text-primary"></i><span>Plots Listing</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#reports-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-file-earmark-text-fill"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="reports-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="bid-report">
            <i class="bi bi-circle-fill text-primary"></i></i><span>Bids Monthly Report </span>
            </a>
          </li>
          <li>
            <a href="plot-report-monthly">
            <i class="bi bi-circle-fill text-primary"></i></i><span>Plots Bid Monthly Report</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
    <?php
    if ($_SESSION['user_type'] == 'admin') {
    ?>
        <a class="nav-link collapsed" data-bs-target="#agents-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-person-vcard-fill"></i><span>Agents</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="agents-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="agents">
            <i class="bi bi-circle-fill text-primary"></i></i><span>Agents</span>
            </a>
          </li>
          <li>
            <a  href="add-agents">
              <i class="bi bi-circle-fill text-primary"></i><span>Add Agents</span>
            </a>
          </li>
        </ul>
    <?php
    }
    ?>
</li>
   </aside><!-- End Sidebar-->