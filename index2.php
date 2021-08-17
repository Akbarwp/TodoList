<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $kata_suci = "Hello World";
    echo $kata_suci;

    $array = [30, 'A', 9.2, "Hello World", true];
    echo $array;


    $arrays = array(
        "nama" => "Akbar",
        "Kelas" => "Web Programing"
    );
    // var_dump($arrays);
    echo $arrays['nama'];


    // If Else
    $bahasa = "Indonesia";
    if ($bahasa === "Indonesia") {
        echo "Selamat Malam";
    } elseif ($nilai === "English") {
        echo "Good Evening";
    } else {
        echo "Hello World";
    }


    // Function
    function LuasSegitiga($alas, $tinggi)
    {
        $hasil = 0.5 * $alas * $tinggi;
        return $hasil;
    }
    echo LuasSegitiga(6, 10);


    // Challange
    function kelipatan($x)
    {
        if ($x % 5 === 0 && $x % 3 === 0) {
            echo "FizzBuzz";
        } elseif ($x % 5 === 0) {
            echo "Fizz";
        } elseif ($x % 3 === 0) {
            echo "Buzz";
        } else {
            echo "Unknown";
        }
    }
    echo kelipatan(15);


    // Looping
    for ($i = 0; $i < 10; $i++) {
        echo $i . "<br>";
    }

    $j = 0;
    while ($j < 10) {
        echo $j . "<br>";
        $j++;
    }

    $k = 0;
    do {
        echo $k . "<br>";
        $k++;
    } while ($k < 10);

    $huruf = array("A", "B", "C", "D", "E");
    foreach ($huruf as $a) {
        echo "$a";
        echo "<br/>";
    }


    // Challange
    for ($x = 0; $x <= 100; $x++) {
        if ($x % 2 === 0) {
            echo "Genap" . "<br>";
        } elseif ($x % 2 === 1) {
            echo "Ganjil" . "<br>";
        }
    }


    // Get and Post
    if (isset($_POST['btn-login'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        echo "Username : " . "| Password : ";
    }
    ?>


    <!-- Get and Post (untuk Login) -->
    <form method="POST">
        <label for="">Username</label>
        <input type="text" name="username">

        <br>
        <label for="">Password</label>
        <input type="password" name="password">

        <br>
        <button name="btn-login" type="submit">Login</button>
    </form>

</body>

</html>