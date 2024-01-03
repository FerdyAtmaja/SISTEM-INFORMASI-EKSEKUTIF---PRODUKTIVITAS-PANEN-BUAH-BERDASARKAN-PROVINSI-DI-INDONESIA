<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bwabwawbawbabbwabwa</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/styleGraph.css">



</head>

<div id="wrapper">

        <!-- Sidebar -->
<?php include "koneksi.php";
        
    // Get the kode_provinsi from the query parameter
    $kode_provinsi = $_GET['kode_provinsi'];

    // Fetch province details from the database
    $query = "SELECT p.nama_provinsi, b.nama_buah, t.tahun, t.luas_panen, t.produksi, t.produktivitas
            FROM sie_2023.provinsi p
            JOIN sie_2023.produktivitas t ON p.kode_provinsi = t.kode_provinsi
            JOIN sie_2023.buah b ON t.id_buah = b.id_buah
            WHERE p.kode_provinsi = '$kode_provinsi'
            ORDER BY b.nama_buah ";

    $result = mysqli_query($conn, $query);

    if ($result) {
    
        $rowProvince = mysqli_fetch_assoc($result);
?>

<body id="page-top">
        <!-- Sidebar -->
        <?php include "sidebar.php";?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column mx-auto p-3h">

            <!-- Main Content -->
            
                <div class="container mt-5">
                <div class="row mb-2">
                        <!-- Column for H1 heading -->
                        <div class="col-10 col-mb-2">
                            <h3 style="font-weight: bold; color: black;">Produksi Buah Provinsi <?php echo ucwords(strtolower($rowProvince['nama_provinsi'])); ?></h3>
                            <h6>Berikut adalah data buah yang diproduksi pada provinsi ini</h6>
                        </div>

                        <!-- Column for Back button -->
                        <div class="col-2 col-md-2">
                            <a href="index.php" class="text-secondary">
                                <i class="fas fa-arrow-left col-2"></i> Data Provinsi
                            </a>
                        </div>
                    </div>
                    <!-- Detailed table content ... -->
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                    <thead>
                            <tr style="background-color: #239ae2; color: white;">
                                <th>No.</th>
                                <th>Buah Diproduksi</th>
                                <th>Tahun</th>
                                <th>Luas Panen (ha)</th>
                                <th>Produksi (Kwintal)</th>
                                <th>Produktivitas (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $counter = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo $row['nama_buah']; ?></td>
                                    <td><?php echo $row['tahun']; ?></td>
                                    <td><?php echo $row['luas_panen']; ?></td>
                                    <td><?php echo $row['produksi']; ?></td>
                                    <td><?php echo $row['produktivitas']; ?></td>
                                </tr>
                            <?php
                            $counter++;
                        } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            

            <?php
            } else {
                // Handle the error if the query fails
                echo "Error: " . mysqli_error($conn);
            }
            ?>

        
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sistem Informasi Eksekutif - Kelompok 1</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    <!-- End of Page Wrapper -->

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

    <script>
        $(document).ready(function () {
            $('#detailedTable').DataTable();
        });
    </script>

</body>

</html>
