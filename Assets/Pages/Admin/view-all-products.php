<?php

require_once "../Classes/Administrator.php";
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    if ($role != 'Admin') {
        echo "<script>window.location.href='../../../sign-in.php';</script>";
        exit();
    }
} else {
    // header("Location: ../../../index.php");
    echo "<script>window.location.href='../../../sign-in.php';</script>";
    exit();
}
include '../dbconnection.php';
require_once "../Classes/Administrator.php";
$admin = new Administrator(null, null);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS - Manage Products</title>
</head>

<body class="bg-dark text-white">

    <?php include 'admin-nav.php'; ?>

    <div class="container">
        <div class="card mt-4 border-white border-3 bg-dark text-white">
            <div class="card-body">
                <h2 class="text-center">Product Approval List</h2>
                <!-- <div class="mt-3">
                    <form method="GET">
                        <div class="mb-3">
                            <div class="row">

                                <div class="col-lg-11 mb-2">
                                    <input type="text" name="keyword" id="keyword" class="form-control"
                                        placeholder="Product Name">
                                </div>
                                <div class="col-lg-1 mb-2">
                                    <button type="submit" class="btn btn-primary text-center d-block">Filter</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div> -->
                <div class="mt-3 table-responsive">
                    <form action="" method="get">
                        <select name="filter" id="filter" class="form-select mb-3" onchange="this.form.submit()">
                            <option value="">-- Status --</option>
                            <option value="All">All</option>
                            <option value="Pending">Pending</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Approved">Approved</option>
                        </select>
                    </form>
                    <table class="table table-bordered table-hover table-dark table-lg bg-dark">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <!-- <th>Task Description</th> -->
                                <th>Username</th>
                                <!-- <th>Task Deadline</th> -->
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['filter'])) {
                                switch ($_GET['filter']) {
                                    case "All":
                                        $sql = "SELECT * FROM items ORDER BY 
                                    CASE 
                                        WHEN status = 'Pending' THEN 1 
                                        WHEN status = 'Rejected' THEN 2 
                                        -- WHEN status = 'Approved' THEN 3 
                                        ELSE 4 
                                    END, prodID ASC";
                                        break;
                                    case "Pending":
                                        $sql = "SELECT * FROM items WHERE status = 'Pending' ORDER BY 
                                    CASE 
                                        WHEN status = 'Pending' THEN 1 
                                        WHEN status = 'Rejected' THEN 2 
                                        -- WHEN status = 'Approved' THEN 3 
                                        ELSE 4 
                                    END, prodID ASC";
                                        break;
                                    case "Approved":
                                        $sql = "SELECT * FROM items WHERE status = 'Approved' ORDER BY 
                                    CASE 
                                        WHEN status = 'Pending' THEN 1 
                                        WHEN status = 'Rejected' THEN 2 
                                        -- WHEN status = 'Approved' THEN 3 
                                        ELSE 4 
                                    END, prodID ASC";
                                        break;
                                    case "Rejected":
                                        $sql = "SELECT * FROM items WHERE status = 'Rejected' ORDER BY 
                                    CASE 
                                        WHEN status = 'Pending' THEN 1 
                                        WHEN status = 'Rejected' THEN 2 
                                        -- WHEN status = 'Approved' THEN 3 
                                        ELSE 4 
                                    END, prodID ASC";
                                        break;
                                }
                            } else {
                                $sql = "SELECT * FROM items ORDER BY 
                                    CASE 
                                        WHEN status = 'Pending' THEN 1 
                                        WHEN status = 'Rejected' THEN 2 
                                        -- WHEN status = 'Approved' THEN 3 
                                        ELSE 4 
                                    END, prodID ASC";
                            }
                            $result = $admin->sqlExecutor($connection, $sql);
                            if ($result != null) {
                                // $result = mysqli_query($connection, $sql);
                                // if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['prodId'] . "</td>";
                                    echo "<td>" . $row['prodName'] . "</td>";
                                    echo "<td>" . $row['prodPrice'] . "</td>";
                                    echo "<td>" . $row['userName'] . "</td>";
                                    // echo "<tdෆ>" . $row['discription'] . "</tdෆ>";
                                    if ($row['status'] == "Approved") {
                                        echo "<td class='bg-success'>" . $row['status'] . "</td>";
                                    } else if ($row['status'] == "Pending") {
                                        echo "<td class='bg-warning'>" . $row['status'] . "</td>";
                                    } else if ($row['status'] == "Rejected") {
                                        echo "<td class='bg-danger'>" . $row['status'] . "</td>";
                                    }
                                    // echo "<td>" . $row['status'] . "</td>";
                                    // echo "<td>" . $row['tdeadline'] . "</td>";                                    
                                    echo "<td><a href='../Supplier/view-prod.php?prodId=" . $row['prodId'] . "' class='btn btn-primary'>View</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td class='text-center' colspan='10'>No Products Found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include '../footer.php'; ?>

</html>