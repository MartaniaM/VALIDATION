<?php
include_once("koneksi.php");
$result = mysqli_query($con, "SELECT * FROM mahasiswa");
?>

<html>
    <head>
        <style>
        .error {color: #FF0000;}
        .table {
            border : 1pt solid black;
            border-spacing: 0px;
        }
        .row td{
            border : 0.8pt solid black;
            padding: 4px;
        }
 
        </style>
    </head>
 
    <body>
        <?php
        // define variables and set to empty values
            $namaErr = $genderErr = $emailErr = $websiteErr = "";
            $nama = $gender = $email = $website = $comment = "";
     
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (empty($_POST["nama"])) {
                    $namaErr = "Nama harus diisi";
                }
                else {
                    $nama = test_input($_POST["nama"]);
                }

                if (empty($_POST["email"])) {
                    $emailErr = "Email harus diisi";
                }
                else {
                    $email = test_input($_POST["email"]);
                    // check if e-mail address is well-formed
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $emailErr = "Email tidak sesuai format";
                    }
                }

                if (empty($_POST["website"])) {
                    $website = "";
                }
                else {
                    $website = test_input($_POST["website"]);
                }

                if (empty($_POST["comment"])) {
                    $comment = "";
                }
                else {
                    $comment = test_input($_POST["comment"]);
                }

                if (empty($_POST["gender"])) {
                    $genderErr = "Gender harus dipilih";
                }
                else {
                    $gender = test_input($_POST["gender"]);
                } 
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>

        <h2>Posting Komentar </h2>
        <p><span class = "error">* Harus Diisi.</span></p>

        <form method = "post" action = "<?php
        echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <table>
                <tr>
                    <td>Nama:</td>
                    <td><input type = "text" name = "nama">
                        <span class = "error">* <?php echo $namaErr;?></span>
                    </td>
                </tr>

                <tr>
                    <td>E-mail: </td>
                    <td><input type = "text" name = "email">
                        <span class = "error">* <?php echo $emailErr;?></span>
                    </td>
                </tr>

                <tr>
                    <td>Website:</td>
                    <td> <input type = "text" name = "website">
                        <span class = "error"><?php echo $websiteErr;?></span>
                    </td>
                </tr>
             
                <tr>
                    <td>Comment:</td>
                    <td> <textarea name = "comment" rows = "5" cols = "40"></textarea></td>
                </tr>
             
                <tr>
                    <td>Gender:</td>
                    <td>
                        <input type = "radio" name = "gender" value = "L">Laki-Laki
                        <input type = "radio" name = "gender" value = "P">Perempuan
                        <span class = "error">* <?php echo $genderErr;?></span>
                    </td>
                </tr>

                

                <td>
                    <input type = "Submit" name = "Submit" value = "Submit"> 
                </td>
            </table>
    </form>

        <?php
        // Check If form submitted, insert form data into users table.
        if(isset($_POST['Submit'])) {
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $website = $_POST['website'];
            $comment = $_POST['comment'];
            $gender = $_POST['gender'];
     
            // include database connection file
            include_once("koneksi.php");
            // Insert user data into table
            $result = mysqli_query($con, "INSERT INTO mahasiswa(nama,email,website,comment,gender) 
            VALUES('$nama','$email','$website','$comment','$gender')");
            // Show message when user added

            echo "Data berhasil disimpan. <a href='lihat.php'>View website</a>";

        }
        ?>           
    </body>
</html>