<!DOCTYPE html>
<html lang="en">

<?php
    include "koneksi.php";
    // Initialize $rowProvince to an empty array
$rowProvince = [];

// Check if the 'kode_provinsi' parameter is set
if (isset($_GET['kode_provinsi'])) {
    // Get the kode_provinsi from the query parameter
    $kode_provinsi = $_GET['kode_provinsi'];

    // Fetch province details from the database
    $query = "SELECT p.nama_provinsi, b.nama_buah, t.tahun, t.luas_panen, t.produksi, t.produktivitas
            FROM sie_2023.provinsi p
            JOIN sie_2023.produktivitas t ON p.kode_provinsi = t.kode_provinsi
            JOIN sie_2023.buah b ON t.id_buah = b.id_buah
            WHERE p.kode_provinsi = '$kode_provinsi'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Fetch the first row to get the province name
        $rowProvince = mysqli_fetch_assoc($result);
    }
} else {
    
}
?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Informasi Eksekutif Produksi Buah</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/styleGraph.css">
    
</head>

<div id="wrapper">
    <body id="page-top">
        
    <!-- Sidebar -->
    <?php include "sidebar.php";?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div class="container mt-5">
                <h3 style="font-weight: bold; color: black;">Data Provinsi</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead style="background-color: #239ae2; color: white;">
                            <tr>
                                <th>No</th>
                                <th>Nama Provinsi</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = mysqli_query($conn, 'SELECT * FROM provinsi');
                                $no = 1;

                                while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo ucwords(strtolower($data['nama_provinsi'])); ?></td>
                                    <td class="text-center align-middle">
                                        <a href="get_provinsi_detail.php?kode_provinsi=<?php echo $data['kode_provinsi']; ?>" class="btn btn-outline-primary btn-sm">Detail</a>
                                    </td>
                                </tr>
                            <?php
                                    $no++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Footer -->
    <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sistem Informasi Eksekutif - Kelompok 1</span>
                    </div>
                </div>
            </footer>
        </div>
        

    </div>

    
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Include Popper.js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/js/sb-admin-2.min.js"></script>
</body>

</html>