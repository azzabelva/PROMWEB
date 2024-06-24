<?php
include("koneksi.php");

if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $kontak = $_POST['kontak'];
    $email = $_POST['email'];

    $sql = "SELECT * FROM customer WHERE usn_customer = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result_user = mysqli_stmt_get_result($stmt);
    $count_user = mysqli_num_rows($result_user);

    $sql = "SELECT * FROM customer WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result_email = mysqli_stmt_get_result($stmt);
    $count_email = mysqli_num_rows($result_email);

    if($count_user == 0 && $count_email == 0){
        $sql = "INSERT INTO customer (nama_customer, usn_customer, pass_customer, kontak, email) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $nama, $username, $password, $kontak, $email);
        mysqli_stmt_execute($stmt);

        echo '<script>alert("Successfully signed up");</script>';
        echo '<script>window.location.href="indexcopy.php";</script>';
        exit;
    } else {
        if($count_user > 0){
            echo '<script>alert("Username already exists");</script>';
        }
        if($count_email > 0){
            echo '<script>alert("Email already exists");</script>';
        }
        echo '<script>window.location.href="indexcopy.php";</script>';
        exit;
    }
}
?>


<?php
include("koneksi.php");
if(isset($_POST['submit'])){
    $nama = $_POST['nama_customer'];
    $username = $_POST['usn_customer'];
    $password = $_POST['pass_customer'];
    $kontak = $_POST['kontak'];
    $email = $_POST['email'];
    $repaswsword = $_POST['repeat_password'];
    $query = mysqli_query($conn, "SELECT * FROM customer WHERE usn_customer = '$username' or email = '$email'");
    if(mysqli_num_rows($query)>0){
        echo 
        "<script> alert('Username or Email Has Already Exist'); </script>";
    }
    else{
        if($password == $repaswsword){
            $query = "INSERT INTO customer VALUES ('', '$name', $username', '$password', '$kontak', '$email')";
            mysqli_query($conn, $query);
            echo
            "<script> alert('Registration Successful') </script>";
        }
        else{
            echo
            "<script> alert('Password Doesn't Match') </script>";
        }
    }
}
?>