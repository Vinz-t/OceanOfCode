    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-info">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 text-bold" href="index.html">
            <!-- Logo -->
            <img src="./img/lopez-logo.png" style="max-width: 40px; height: auto; margin-right: 5px;" />
            <b>Tenant Panel</b>
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-lg order-1 order-lg-0 me-4 me-lg-0 text-white" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
             &nbsp;
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#" id="logoutLink">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">Signing Out</h5>
        </div>
        <div class="modal-body">
            Are you sure you want to sign out?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirmSignOut">Sign Out</button>
        </div>
        </div>
    </div>
    </div>

    <script>
        document.getElementById('logoutLink').addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior

            // Close the dropdown manually
            const dropdown = new bootstrap.Dropdown(document.querySelector('.dropdown-toggle'));
            dropdown.hide(); // This will close the dropdown immediately

            // Open the modal
            const logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
            logoutModal.show();
        });

        // Confirm sign-out when user clicks "Sign Out" in the modal
        document.getElementById('confirmSignOut').addEventListener('click', function () {
            // Send request to logout.php to destroy session
            fetch('logout.php')
            .then(response => response.text())
            .then(() => {
                // Redirect to login page (index.php) after logout
                window.location.href = 'index.php';
            });
        });
    </script>

