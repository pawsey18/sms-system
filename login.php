<?php include "includes/header.php";
include 'includes/dbFunctions.php';
include "includes/dbConnection.php";
$pageTitle = "Login page";


?>

<h1><?php echo $pageTitle ?></h1>

<?php

// If it was a post request and if the username and email are not empty
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    // capture the post entries and store in variable
    $password = $_POST['password'];
    $username = $_POST['username'];

    $sql = "select id, username, password from login where username = ? and password = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $stmt->bind_result($id, $username, $password);
        $result = $stmt->fetch();
    }
    if ($result) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        echo "welcome back", $_SESSION['username'];
        $stmt->close();
    } else {
?>
        <h3>Invalid username or password</h3>
    <?php
    }
} else {
    ?>
    <main>
        <div class='row'>
            <div class='col-6'>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control id=" username" placeholder="enter username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control id=" password" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-primary">Log me in</button>
                </form>
            </div>
        </div>
    </main>
<?php
}
?>