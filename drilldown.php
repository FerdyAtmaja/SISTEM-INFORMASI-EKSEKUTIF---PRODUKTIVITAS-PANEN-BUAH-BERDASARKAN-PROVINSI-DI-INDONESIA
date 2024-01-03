<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>SIE</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/styleGraph.css">

    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

</head>

<?php
include "koneksi.php";
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php";?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid mt-5">

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar mr-1"></i> Fruit Productivity Chart
                        </div>
                        <div class="card-body">

                        <form action="" method="post" class="form-inline">
                                <div class="form-group mr-2">
                                    <label for="id_buah" class="mr-2">Select Fruit:</label>
                                    <select id="id_buah" name="id_buah" class="form-control">
                                        <?php
                                        // Fetch fruit names and id_buah values from the 'buah' table
                                        $query = "SELECT id_buah, nama_buah FROM buah";
                                        $hasil = mysqli_query($conn, $query);

                                        // Loop through the results to populate the dropdown options
                                        while ($buah = mysqli_fetch_assoc($hasil)) {
                                            echo "<option value='{$buah['id_buah']}'>{$buah['nama_buah']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group mr-2">
                                    <label for="variable" class="mr-2">Select Variable:</label>
                                    <select id="variable" name="variable" class="form-control">
                                        <!-- Add options for variables here -->
                                        <option value="luas_panen">Luas Panen</option>
                                        <option value="produksi">Produksi</option>
                                        <option value="produktivitas">Produktivitas</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Show Data" class="btn btn-primary" style="background-color: #239ae2; color: white;">
                                </div>
                            </form>

                            <!-- Chart -->
                            <div id="barchart" class="grafik"></div>

                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <<!-- Footer -->
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

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the selected id_buah from the form
        $selectedIdBuah = $_POST['id_buah'];
        $selectedVariable = $_POST['variable'];

        // Fetch the name of the selected buah
        $queryBuah = "SELECT nama_buah FROM buah WHERE id_buah = $selectedIdBuah";
        $resultBuah = mysqli_query($conn, $queryBuah);
        $buahData = mysqli_fetch_assoc($resultBuah);
        $namaBuah = $buahData['nama_buah'];
        
        $sql1 = "SELECT prv.nama_pulau, 
                SUM(prd.$selectedVariable) AS total 
        FROM provinsi prv 
        JOIN produktivitas prd ON prv.kode_provinsi = prd.kode_provinsi 
        WHERE prd.id_buah = $selectedIdBuah
        GROUP BY prv.nama_pulau;";

        $result1 = mysqli_query($conn,$sql1);

        $hasil = array();

        while ($row = mysqli_fetch_array($result1)) {
            array_push($hasil,array(
                "name"=>$row['nama_pulau'],
                "total"=>$row['total']
            ));
        }

        $sql2 = "SELECT prv.nama_provinsi AS provinsi,
                prv.nama_pulau AS pulau, 
                SUM(prd.$selectedVariable) AS total
        FROM provinsi prv 
        JOIN produktivitas prd ON prv.kode_provinsi = prd.kode_provinsi 
        WHERE prd.id_buah = $selectedIdBuah
        GROUP BY pulau, provinsi;";

        $result2 = mysqli_query($conn,$sql2);

        $hasil2 = array();

        while ($row = mysqli_fetch_array($result2)) {
            array_push($hasil2,array(
                "total2"=>$row['total'],
                "provinsi" => $row['provinsi'],
                "pulau" => $row['pulau']
            ));
        }

        $sql3 = "SELECT prv.nama_provinsi AS provinsi,
                prd.tahun AS tahun, 
                SUM(prd.$selectedVariable) AS total
        FROM provinsi prv 
        JOIN produktivitas prd ON prv.kode_provinsi = prd.kode_provinsi
        WHERE prd.id_buah = $selectedIdBuah
        GROUP BY provinsi, tahun;";

        $result3 = mysqli_query($conn,$sql3);

        $hasil3 = array();

        while ($row = mysqli_fetch_array($result3)) {
            array_push($hasil3,array(
                "total3"=>$row['total'],
                "tahun" => $row['tahun'],
                "provinsi" => $row['provinsi']
            ));
        }

        $data = json_decode(json_encode($hasil), TRUE);
        $data2 = json_decode(json_encode($hasil2), TRUE);
        $data3 = json_decode(json_encode($hasil3), TRUE);
    }
    ?>
    
    <script type="text/javascript">
    // Create the barchart
        Highcharts.chart('barchart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Data <?php echo ucfirst($selectedVariable); ?> Buah <?php echo ucfirst($namaBuah); ?> Di Setiap Daerah'
            },
            subtitle: {
                text: 'Source: Database SIE_2023'
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: '<?php echo ucfirst($selectedVariable); ?>'
                }
            
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f}'
                    }
                }
            },
        
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
            },
        
            series: [
                {
                    name: "Nama Pulau",
                    colorByPoint: true,
                    data: [
                        <?php foreach ($data as $item):?>
                        {
                            name: '<?= $item["name"]; ?>',
                            y: <?= $item["total"]; ?>,
                            drilldown: '<?= $item["name"]; ?>'
                        },
                        <?php endforeach;?>
                    ]
                }
            ],
            drilldown: {
                series: [
                    <?php foreach ($data2 as $item): ?>
                        {
                            name: '<?= $item["pulau"]; ?>',
                            id: '<?= $item["pulau"]; ?>',
                            data: [
                                <?php foreach ($data2 as $subitem): ?>
                                    <?php if ($subitem["pulau"] === $item["pulau"]): ?>
                                        {
                                            name: '<?= $subitem["provinsi"]; ?>',
                                            y: <?= $subitem["total2"]; ?>,
                                            drilldown: '<?= $subitem["provinsi"]; ?>'
                                        },
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            ]
                        },
                    <?php endforeach; ?>

                    <?php foreach ($data3 as $item): ?>
                        {
                            name: '<?= $item["provinsi"]; ?>',
                            id: '<?= $item["provinsi"]; ?>',
                            data: [
                                <?php foreach ($data3 as $subitem): ?>
                                    <?php if ($subitem["provinsi"] === $item["provinsi"]): ?>
                                        {
                                            name: '<?= $subitem["tahun"]; ?>',
                                            y: <?= $subitem["total3"]; ?>
                                        },
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            ]
                        },
                    <?php endforeach; ?>
                ]
            }
        });
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/js/sb-admin-2.min.js"></script>


</body>

</html>