<?php
session_start();
if (isset($_SESSION['username']) || isset($_SESSION['role'])) {
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    if ($role != 'Innovator') {
        echo "<script>window.location.href='../../../index.php';</script>";
        exit();
    }
} else {
    // header("Location: ../../../index.php");
    echo "<script>window.location.href='../../../index.php';</script>";
    exit();
}

include '../dbconnection.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
</head>

<body class="bg-dark text-white">
    <?php include '../Innovator/innovator-nav.php'; ?>

    <div class="container">

        <h1 class="text-center">Welcome to the Innovator Forum</h1>
        <p class="text-center">A space for sharing success stories, seeking collaborators, and exchanging insights into
            the innovation process.</p>
            <div>
                <a href="./submit-form.php" class="btn btn-success">Create your story</a>
            </div>

        <!-- Display Posts -->
        <div class="section mt-5">
            <h2>Success Stories</h2>
            <p>Read about the latest success stories from our community. Be inspired by the journeys and achievements of
                fellow innovators.</p>
            <?php
            $sql = "SELECT * FROM posts WHERE category='SuccessStories'";
            $result = mysqli_query($connection, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // echo "<div class='post'>";
                    echo "<div class='card bg-dark text-white border-1 border-white p-3'>";
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p>" . $row['content'] . "</p>";
                    echo "<small>Posted by: <a class='text-white' href='../Innovator/view-profile.php?userName=" . $row['userName'] . "'>".$row['userName']."</a></small>";
                    echo "<small>Posted on: " . (isset($row['created_at']) ? date('F j, Y', strtotime($row['created_at'])) : date('F j, Y')) . "</small>";
                    echo "<small>Posted at: <span id='post-time'>" . date('h:i A', time()) . "</span></small>";
                    echo "</div>";
                    // echo "</div>";
                }
            } else {
                echo "No posts found";
            }

            ?>
        </div>

        <div class="section mt-5">
            <h2>Collaboration Opportunities</h2>
            <p>Looking for collaborators on your next big project? Connect with other innovators who share your vision.
            </p>
            <?php
            $sql = "SELECT * FROM posts WHERE category='CollaborationOpportunities';";
            $result = mysqli_query($connection, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // echo "<div class='post'>";
                    echo "<div class='card bg-dark text-white border-1 border-white p-3'>";
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p>" . $row['content'] . "</p>";
                    echo "<small>Posted by: <a class='text-white' href='../Innovator/view-profile.php?userName=" . $row['userName'] . "'>".$row['userName']."</a></small>";
                    echo "<small>Posted on: " . (isset($row['created_at']) ? date('F j, Y', strtotime($row['created_at'])) : date('F j, Y')) . "</small>";
                    echo "<small>Posted at: <span id='post-time'>" . date('h:i A', time()) . "</span></small>";
                    echo "</div>";
                    // echo "</div>";
                }
            } else {
                echo "No posts found";
            } 

            ?>
        </div>

        <div class="section mt-5">
            <h2>Insights and Tips</h2>
            <p>Discover valuable insights and tips from experienced innovators. Learn best practices, avoid common
                pitfalls, and stay ahead in the innovation landscape.</p>
            <?php
            $sql = "SELECT * FROM posts WHERE category='InsightsandTips';";
            $result = mysqli_query($connection, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                     // echo "<div class='post'>";
                     echo "<div class='card bg-dark text-white border-1 border-white p-3'>";
                     echo "<h3>" . $row['title'] . "</h3>";
                     echo "<p>" . $row['content'] . "</p>";
                     echo "<small>Posted by: <a class='text-white' href='../Innovator/view-profile.php?userName=" . $row['userName'] . "'>".$row['userName']."</a></small>";
                     echo "<small>Posted on: " . (isset($row['created_at']) ? date('F j, Y', strtotime($row['created_at'])) : date('F j, Y')) . "</small>";
                     echo "<small>Posted at: <span id='post-time'>" . date('h:i A', time()) . "</span></small>";
                     echo "</div>";
                     // echo "</div>";
                }
            } else {
                echo "No posts found";
            }

            ?>
        </div> 


        <div class="section mt-5">
            <h2>Skills and Qualifications</h2>
            <p>Looking for collaborators on your next big project? Connect with other innovators who share your vision.
            </p>
            <?php
            $sql = "SELECT * FROM posts WHERE category='SkillsandQualifications'";
            $result = mysqli_query($connection, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // echo "<div class='post'>";
                    echo "<div class='card bg-dark text-white border-1 border-white p-3'>";
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p>" . $row['content'] . "</p>";
                    echo "<small>Posted by: <a class='text-white' href='../Innovator/view-profile.php?userName=" . $row['userName'] . "'>".$row['userName']."</a></small>";
                    echo "<small>Posted on: " . (isset($row['created_at']) ? date('F j, Y', strtotime($row['created_at'])) : date('F j, Y')) . "</small>";
                    echo "<small>Posted at: <span id='post-time'>" . date('h:i A', time()) . "</span></small>";
                    echo "</div>";
                    // echo "</div>";
                }
            } else {
                echo "No posts found";
            }

            ?>
        </div>

        <div class="section mt-5">
            <h2>Personal Branding</h2>
            <p>Looking for collaborators on your next big project? Connect with other innovators who share your vision.
            </p>
            <?php
            $sql = "SELECT * FROM posts WHERE category='PersonalBranding'";
            $result = mysqli_query($connection, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // echo "<div class='post'>";
                    echo "<div class='card bg-dark text-white border-3 border-white p-3'>";
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p>" . $row['content'] . "</p>";
                    echo "<small>Posted by: <a class='text-white' href='../Innovator/view-profile.php?userName=" . $row['userName'] . "'>".$row['userName']."</a></small>";
                    echo "<small>Posted on: " . (isset($row['created_at']) ? date('F j, Y', strtotime($row['created_at'])) : date('F j, Y')) . "</small>";
                    echo "<small>Posted at: <span id='post-time'>" . date('h:i A', time()) . "</span></small>";
                    echo "</div>";
                    // echo "</div>";
                }
            } else {
                echo "No posts found";
            }

            ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




    </div>
    </div>


    <div id="footer">
        <?php include '../footer.php' ?>
    </div>


</body>



</html