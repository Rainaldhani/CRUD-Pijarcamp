<?php
$server = "localhost";
$user   = "root";
$password = "";
$db     = "pijarcamp";

// Create Connection
$conn = new mysqli($server,$user,$password,$db);

$id            = "";
$nama_produk   = "";
$keterangan    = "";
$harga         = "";
$jumlah        = "";

$errormsg ="";
$successmsg = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //GET method: Show the data of the buyer

    if (!isset($_GET["id"])) {
        header("location: index.php");
        exit;
    }

    $id = $_GET["id"];

    // read the row of the selected buyer from database table
    $sql = "SELECT * FROM produk WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: index.php");
        exit;
    }

    $nama_produk   = $row["nama_produk"];
    $keterangan    = $row["keterangan"];
    $harga         = $row["harga"];
    $jumlah        = $row["jumlah"];
}

else {
    //POST method: Update the data of the buyer
    $id             = $_POST["id"];
    $nama_produk    = $_POST["nama_produk"];
    $keterangan     = $_POST["keterangan"];
    $harga          = $_POST["harga"];
    $jumlah         = $_POST["jumlah"];

    do{
        if (empty($id)|| empty($nama_produk)|| empty($keterangan)|| empty($harga)|| empty($jumlah)){
            $errormsg="ALL THE FIELDS ARE REQUIRED";
            break;
        } 

        $sql = "UPDATE produk " .
                "SET nama_produk = '$nama_produk', keterangan= '$keterangan', harga= '$harga', jumlah= '$jumlah' " .
                "WHERE id = $id";

            $result = $conn->query($sql);

            if (!$result){
                $errormsg = "Invalid query: " . $conn->error;
                break;
            }

            $successmsg ="DONE";
            header("location: index.php");
            exit;

    }  while(false);
}
    
?>
<!DOCTYPE HTML>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
crossorigin="anonymous">
<script src= "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buat Produk Baru</title>

</head>
<body>
    <div class="container my-5">
        <h2>Produk Baru</h2>
        <?php
        if (!empty($errormsg)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errormsg</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <input type="hidden" name= "id" value="<?php echo $id;?>">
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama Produk</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="nama_produk" value="<?php echo $nama_produk;?>">
                </div> 
            </div>

            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Keterangan</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="keterangan" value="<?php echo $keterangan;?>">
                </div> 
            </div>

            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Harga</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="harga" value="<?php echo $harga;?>">
                </div> 
            </div>

            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Jumlah</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="jumlah" value="<?php echo $jumlah;?>">
                </div> 
            </div>

            <?php
            if (!empty($successmsg)){
                echo "
                <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successmsg</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
                <div class="col-sm-3 d-grid">
                    <a href="index.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div> 
            </div>
        </form>
    </div>
</body>
</html>