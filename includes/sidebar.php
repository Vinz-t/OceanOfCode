<div id="layoutSidenav_nav">

    <nav class="sb-sidenav accordion bg-info" id="sidenavAccordion">
        <div style="height: 1px; background-color: white;"></div>
        <div class="sb-sidenav-menu">
            
            <div class="nav text-white">
                
                <div class="sb-sidenav-menu-heading"><b>Core</b></div>

                <a class="nav-link text-white hover-highlight" href="welcome.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                            
                <!-- <a class="nav-link text-white hover-highlight" href="profile.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Profile
                </a> -->

                <!-- Main link that toggles submenu -->
                <a class="nav-link text-white hover-highlight collapsed" href="#" 
                data-bs-toggle="collapse" 
                data-bs-target="#collapseApartment" 
                aria-expanded="false" 
                aria-controls="collapseApartment">
                    <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                    Apartment Unit
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <!-- Submenu -->
                <div class="collapse" id="collapseApartment">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link text-white hover-highlight" href="Apartmentplace1.php">Bulacan</a>
                        <a class="nav-link text-white hover-highlight" href="Apartmentplace2.php">Valenzuela</a>
                    </nav>
                </div>

                <!-- <a class="nav-link text-white hover-highlight" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                    Apartment Unit
                </a> -->

                <!-- <a class="nav-link text-white hover-highlight" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-city"></i></div>
                    Commercial Space
                </a> -->

                <!-- Main link that toggles submenu -->
                <a class="nav-link text-white hover-highlight collapsed" href="#" 
                data-bs-toggle="collapse" 
                data-bs-target="#collapsecommercial" 
                aria-expanded="false" 
                aria-controls="collapsecommercial">
                    <div class="sb-nav-link-icon"><i class="fas fa-city"></i></div>
                    Commercial Space
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <!-- Submenu -->
                <div class="collapse" id="collapsecommercial">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link text-white hover-highlight" href="Commercialplace1.php">Bulacan</a>
                        <a class="nav-link text-white hover-highlight" href="Commercialplace2.php">Valenzuela</a>
                    </nav>
                </div>

                <a class="nav-link text-white hover-highlight" href="myrental.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    My Rentals
                </a>

                <a class="nav-link text-white hover-highlight" href="leasing.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                    List Condition
                </a>

                <a class="nav-link text-white hover-highlight" href="messages.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
                    Messages
                </a>

                <!-- <a class="nav-link text-white hover-highlight" href="change-password.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
                   Change Password
                </a> -->

                <!-- <a class="nav-link text-white hover-highlight" href="logout.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                    Signout
                </a> -->
                <!-- <a class="nav-link text-white hover-highlight" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                    Signout
                </a> -->
            </div>
        </div>       
    </nav>
</div>

<style>
    .hover-highlight:hover {
        background-color: #007bff; /* Bootstrap's primary color */
    }
</style>