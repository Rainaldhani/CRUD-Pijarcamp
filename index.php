<!DOCTYPE HTML>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
crossorigin="anonymous">

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produk</title>

</head>
<body>
    <div class="container my-5">
        <h2>List Produk</h2>
        <a class="btn btn-primary" href="create.php" role="button"> Produk Baru</a>
        <br>
        <table class="table"> 
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Keterangan</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Action</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            $server   = "localhost";
            $user     = "root";
            $password = "";
            $db       = "pijarcamp";

            // Create Connection
            $conn = new mysqli($server,$user,$password,$db);

            // Check Connection
            if ($conn->connect_error) {
                die("connection failed: " . $conn->connect_error);
            }

            // read all row from database table
            $sql = "SELECT * FROM produk";
            $result = $conn->query($sql);

            if (!$result){
                die("Invalid query: " . $conn->error);
            }

            // read data of each row
            while($row = $result->fetch_assoc()){
                echo "
                <tr>
                <td>$row[id]</td>
                <td>$row[nama_produk]</td>
                <td>$row[keterangan]</td>
                <td>$row[harga]</td>
                <td>$row[jumlah]</td>
                <td>
                    <a href='edit.php?id=$row[id]' class='btn btn-primary btn-sm'>Edit</a>
                    <a onClick=\" javascript:return confirm('Confirm Delete'); \" href='delete.php?id=$row[id]' class='btn btn-danger btn-sm'>Delete</a>
                </td>
            </tr>
            ";
            }
            ?>
            
        </tbody>


        </table>
</body>
</html>
