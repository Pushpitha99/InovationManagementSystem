<?php
require_once "../Classes/User.php";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    if ($role != 'Supplier') {
        echo "<script>window.location.href='../../../sign-in.php';</script>";
        exit();
    }
} else {

    echo "<script>window.location.href='../../../sign-in.php';</script>";
    exit();
}
require_once __DIR__ . '/../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();

// Database connection
$connection = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$user = new User($username,"");
$profilePic = $user->getProfilePicture($connection);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- End of Bootstrap -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- End of Font Awesome -->
    <title>Supplier-nav</title>
</head>

<body class="text-center">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-center">
        <div class="container">
            <a class="navbar-brand" href="./supplier-dashboard.php"><img src="../../img/LogoWhite.png" style="width:50px;height:50px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../Supplier/Supplier-dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Innovator/aboutUs.php">About Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Product Management
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../Supplier/addproduct.php">Add Product</a>
                            </li>
                            <li><a class="dropdown-item" href="../Supplier/edit-product.php">Edit Product</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../Supplier/delete-prod.php">Delete Product</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link me-2 mt-3" href="../Supplier/store.php">
                            <i class="fas fa-store" style="color: #ffffff;"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 mt-3" href="../Forum/forum.php">
                        <img src="../../img/Forum1.png" alt="" style="width:30px; height:auto; filter: brightness(0) invert(1);">
                        </a>
                    </li>
                    <li class="nav-item dropdown mt-2">
                        <a class="" href="../Innovator/view-profile.php?userName=<?php echo $username ?>">
                            <img src="<?php echo $profilePic ?>" alt="Profile" class="rounded-circle me-2" style="width:50px;height:50px;">
                        </a>
                    </li>
                    <li class="nav-item dropdown mt-3">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span><?php echo $username; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="../Admin/profile.php">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="../Admin/resetpassword.php">Reset Password</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" onclick="logout()">Logout</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>
    <hr class="text-white border-3">

    <script>
        function logout() {
            fetch('../logout.php')
                .then(response => {
                    if (response.ok) {
                        window.location.href = '../../../index.php';
                    } else {
                        console.error('Logout failed');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

</body>

</html>