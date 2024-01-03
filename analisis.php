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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="css/styleGraph.css">


    <style>
    .green-text {
        color: green;
    }

    .red-text {
        color: red;
    }
    </style>
</head>

<?php
include "koneksi.php";
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper mt-4" class="d-flex flex-column">
        
            <!-- Main Content -->
            <div id="content">
                <main>
                    <div class="container mt-5">
                        <div class="row mb-2">
                        <div class ="col-8">
                        <h3 style="font-weight: bold; color: black; ">Analisis What If</h3>
                        <h6>Anda dapat melakukan analisis tahunan dari total panen buah di Indonesia</h6>
                        </div>
                            <!-- Start Main Card 1 -->
                            <div id="mainCard1" class="col-md-12 mb-4">
            
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Start SubCard 1-1 -->
                                            <div class="col-6">
                                                <div class="card mb-3">
                                                    <div class="card-header" style="font-weight: bold;">
                                                        Data Produksi Buah
                                                    </div>
                                                    <div class="card-body">
                                                        <form id="bookingForm1" action="#" method=""
                                                            class="needs-validation" novalidate autocomplete="off">
                                                            <div class="form-group">
                                                                <label for="inputYear">Tahun</label>
                                                                <select class="form-control" id="inputYear"
                                                                    name="inputYear" required>
                                                                    <option value="" disabled selected>--Pilih Tahun--
                                                                    </option>
                                                                    <?php
                                                                    $yearQuery = mysqli_query($conn, "SELECT DISTINCT tahun FROM produktivitas group by tahun order by tahun");
                                                                    while ($yearOptions = mysqli_fetch_array($yearQuery)) {
                                                                    ?>
                                                                    <option value="<?php echo $yearOptions['tahun'] ?>">
                                                                        <?php echo $yearOptions['tahun'] ?></option>
                                                                    <?php } ?>
                                                                </select>

                                                                <!-- Container to update dynamically -->
                                                                <div id="dynamicContent">
                                                                    <hr />
                                                                    <label for="inputTM1">Luas Panen (Hektar):  
                                                                    </label><span id="luasPanen"></span>
                                                                </div>

                                                                <!-- jQuery AJAX to update content -->
                                                                <script>
                                                                $(document).ready(function() {
                                                                    $("#inputYear").change(function() {
                                                                        // Get the selected year
                                                                        var selectedYear = $(this)
                                                                            .val();

                                                                        // Make AJAX request
                                                                        $.ajax({
                                                                            type: "POST",
                                                                            url: "hitung/luasPanen.php", // Update with your server-side script
                                                                            data: {
                                                                                selectedYear: selectedYear
                                                                            },
                                                                            success: function(
                                                                                data) {
                                                                                // Update the content dynamically
                                                                                $("#luasPanen")
                                                                                    .text(
                                                                                        data
                                                                                    );
                                                                            }
                                                                        });
                                                                    });
                                                                });
                                                                </script>

                                                                <div id="dynamicContent">
                                                                    <hr />
                                                                    <label for="inputTBM1">Produktivitas
                                                                        (Kuintal/Hektar):
                                                                    </label><span id="produktivitas"></span>
                                                                </div>

                                                                <!-- jQuery AJAX to update content -->
                                                                <script>
                                                                $(document).ready(function() {
                                                                    $("#inputYear").change(function() {
                                                                        // Get the selected year
                                                                        var selectedYear = $(this)
                                                                            .val();

                                                                        // Make AJAX request
                                                                        $.ajax({
                                                                            type: "POST",
                                                                            url: "hitung/produktivitas.php", // Update with your server-side script
                                                                            data: {
                                                                                selectedYear: selectedYear
                                                                            },
                                                                            success: function(
                                                                                data) {
                                                                                // Update the content dynamically
                                                                                $("#produktivitas")
                                                                                    .text(
                                                                                        data
                                                                                    );
                                                                            }
                                                                        });
                                                                    });
                                                                });
                                                                </script>

                                                                <div id="dynamicContent">
                                                                    <hr />
                                                                    <label for="inputTR1">Produksi (Kuintal):
                                                                    </label><span id="produksi"></span>
                                                                </div>

                                                                <!-- jQuery AJAX to update content -->
                                                                <script>
                                                                $(document).ready(function() {
                                                                    $("#inputYear").change(function() {
                                                                        // Get the selected year
                                                                        var selectedYear = $(this)
                                                                            .val();

                                                                        // Make AJAX request
                                                                        $.ajax({
                                                                            type: "POST",
                                                                            url: "hitung/produksi.php", // Update with your server-side script
                                                                            data: {
                                                                                selectedYear: selectedYear
                                                                            },
                                                                            success: function(
                                                                                data) {
                                                                                // Update the content dynamically
                                                                                $("#produksi")
                                                                                    .text(
                                                                                        data
                                                                                    );
                                                                            }
                                                                        });
                                                                    });
                                                                });
                                                                </script>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End SubCard 1-1 -->

                                            <!-- Start SubCard 1-2 -->
                                            <div class="col-6">
                                                <div class="card mb-3">
                                                    <div class="card-header" style="font-weight: bold;">
                                                        Masukkan Data yang Akan Dianalisis
                                                    </div>
                                                    <div class="card-body">
                                                        <form id="bookingForm2" action="#" method=""
                                                            class="needs-validation" novalidate autocomplete="off">
                                                            <div class="form-group">
                                                                <label for="ifVariables">Variabel</label>
                                                                <select class="form-control" id="ifVariables"
                                                                    name="ifVariables" required>
                                                                    <option value="" disabled selected>--Pilih Variabel
                                                                        yang
                                                                        Akan Diubah--</option>
                                                                    <option value="variablesLP">Luas Panen (Hektar)
                                                                    </option>
                                                                    <option value="variablesPV">Produktivitas
                                                                        (Kuintal/Hektar)</option>
                                                                    <option value="variablesPD">Produksi (Kuintal)
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <hr />

                                                            <!-- Additional Fields for SubCard 2-2 -->
                                                            <label for="variablesValue">Nilai</label>
                                                            <input type="text" class="form-control" id="variablesValue"
                                                                name="variablesValue" placeholder="Masukkan Nilai"
                                                                required />

                                                            <!-- Button for SubCard 2-2 -->
                                                            <div class="d-flex justify-content-end mt-2">
                                                                <button type="button" class="btn btn-warning"
                                                                    id="clearButton">Clear</button>
                                                                <button type="button" class="btn btn-primary ml-2"
                                                                    id="submitMainCard1" style="background-color: #239ae2; color: white;">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End SubCard 1-2 -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Main Card 1 -->

                            <!-- Start Main Card 2 -->
                            <div id="mainCard2" class="col-md-12">
                                <div class="card">
                                    <div class="card-header" style="text-align: center; font-weight: bold;">
                                        Hasil Analisis
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Start SubCard 2-1 -->
                                            <div class="col-6">
                                                <div class="card mb-3">
                                                    <div class="card-header" style="font-weight: bold;"
                                                        id="subCard1Header">
                                                        Header sub card 1
                                                    </div>
                                                    <div class="card-body">
                                                        <label for="luas_panen1" class="luas_panen1">Luas Panen (Hektar)
                                                            :
                                                        </label><span id="luas_panen1"></span>
                                                        <hr />
                                                        <label for="produktivitas1" class="produktivitas1">Produktivitas
                                                            (Kuintal/Hektar) : </label><span id="produktivitas1"></span>
                                                        <hr />
                                                        <label for="produksi1" class="produksi1">Produksi (Kuintal) :
                                                        </label><span id="produksi1"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End SubCard 2-1 -->

                                            <!-- Start SubCard 2-2 -->
                                            <div class="col-6">
                                                <div class="card mb-3">
                                                    <div class="card-header" style="font-weight: bold;"
                                                        id="subCard2Header">
                                                        Header sub card 2
                                                    </div>
                                                    <div class="card-body">
                                                        <label for="luas_panen2" class="luas_panen2">Luas Panen (Hektar)
                                                            :
                                                        </label><span id="luas_panen2"></span>
                                                        <hr />
                                                        <label for="produktivitas2" class="produktivitas2">Produktivitas
                                                            (Kuintal/Hektar) : </label><span id="produktivitas2"></span>
                                                        <hr />
                                                        <label for="produksi2" class="produksi2">Produksi (Kuintal) :
                                                        </label><span id="produksi2"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End SubCard 2-2 -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Main Card 2 -->
                        </div>
                    </div>
                </main>


            </div>
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

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>


    <!-- Custom scripts for all pages-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/js/sb-admin-2.min.js">
    </script>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <?php
    $queryTahun = "SELECT prd.tahun AS tahun, 
                    SUM(prd.produksi) AS produksi, 
                    SUM(prd.luas_panen) AS luas_lahan, 
                    SUM(prd.produktivitas) AS produktivitas 
    FROM produktivitas prd 
    GROUP BY prd.tahun";

    $resultTahun = mysqli_query($conn, $queryTahun);

    $tahun = array();

    while ($row = mysqli_fetch_array($resultTahun)) {
        array_push($tahun, array(
            "tahun" => $row['tahun'],
            "produksi" => $row['produksi'],
            "luas_lahan" => $row['luas_lahan'],
            "produktivitas" => $row['produktivitas']
        ));
    }

    $data = json_decode(json_encode($tahun), TRUE);
    ?>

    <script>
    $(document).ready(function() {
        // Hide Main Card 2 initially

        $("#inputYear").change(function() {
            // Get the selected year
            var selectedYear = $(this).val();
            console.log("Selected Year:", selectedYear); // Log the selected year for debugging

            // Make AJAX request
            $.ajax({
                type: "POST",
                url: "hitung/luasPanen.php",
                data: {
                    selectedYear: selectedYear
                },
                success: function(data) {
                    // Log the data received for debugging
                    console.log("Data received:", data);

                    // Update the content dynamically
                    $("#luasPanen").text(data);
                }
            });

            // Make AJAX request for Produktivitas
            $.ajax({
                type: "POST",
                url: "hitung/produktivitas.php",
                data: {
                    selectedYear: selectedYear
                },
                success: function(data) {
                    // Log the data received for debugging
                    console.log("Data received for Produktivitas:", data);

                    // Update the content dynamically
                    $("#produktivitas").text(data);
                }
            });

            // Make AJAX request for Produksi
            $.ajax({
                type: "POST",
                url: "hitung/produksi.php",
                data: {
                    selectedYear: selectedYear
                },
                success: function(data) {
                    // Log the data received for debugging
                    console.log("Data received for Produksi:", data);

                    // Update the content dynamically
                    $("#produksi").text(data);
                }
            });
        });

        function updateSubmitButtonState() {
            var selectedYear = $("#inputYear").val();
            var selectedVariable = $("#ifVariables").val();
            var inputValue = $("#variablesValue").val().trim();

            // Enable or disable the submit button based on conditions
            $("#submitMainCard1").prop("disabled", !(selectedYear && selectedVariable && inputValue));
        }

        $("#mainCard2").hide();

        // Disable the submit button initially
        $("#submitMainCard1").prop("disabled", true);

        // Clear button click event
        $("#clearButton").click(function() {
            // Hide Main Card 2
            $("#mainCard2").hide();

            // Clear and disable the input field
            $("#variablesValue").val("");
            $("#submitMainCard1").prop("disabled", true);

            // Reset headers or handle other cases
            $("#subCard1Header, #subCard2Header").text("Default Header");
        });

        // Submit button click event in Main Card 1
        $("#submitMainCard1").click(function() {
            // Get the selected option
            var selectedOption = $("#ifVariables").val();

            // Show Main Card 2
            $("#mainCard2").show();

            // Execute different AJAX requests based on the selected option
            switch (selectedOption) {
                case "variablesLP":
                    executeAjax("hitung/calcPDIfLP.php", "produktivitas1", "luas_panen1",
                        "produksi1");
                    executeAjax("hitung/calcPVIfLP.php", "produktivitas2", "luas_panen2",
                        "produksi2");
                    break;
                case "variablesPV":
                    executeAjax("hitung/calcPDIfPV.php", "produktivitas1", "luas_panen1",
                        "produksi1");
                    executeAjax("hitung/calcLPIfPV.php", "produktivitas2", "luas_panen2",
                        "produksi2");
                    break;
                case "variablesPD":
                    executeAjax("hitung/calcPVIfPD.php", "produktivitas1", "luas_panen1",
                        "produksi1");
                    executeAjax("hitung/calcLPIfPD.php", "produktivitas2", "luas_panen2",
                        "produksi2");
                    break;

                    // Add more cases if needed

                default:
                    console.log("Invalid option selected");
                    break;
            }
        });

        // Function to execute AJAX request
        function executeAjax(url, prodviId, luasId, prodsiId) {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    selectedYear: $("#inputYear").val(),
                    variablesValue: $("#variablesValue").val()
                },
                dataType: 'json',
                success: function(data) {
                    // Update the content dynamically
                    $("#" + prodviId).text(data.produktivitas);
                    $("#" + luasId).text(data.luas_panen);
                    $("#" + prodsiId).text(data.produksi);
                }
            });
        }

        // Listen for changes in the input field
        $("#variablesValue").on("input", function() {
            // Remove non-numeric characters from the input value
            var numericValue = $(this).val().replace(/[^0-9]/g, '');

            // Update the input value with only numbers
            $(this).val(numericValue);

            // Enable or disable the submit button based on whether the input field has a value
            $("#submitMainCard1").prop("disabled", numericValue.trim() === "");

            updateSubmitButtonState();
        });

        // Handle the selection change
        $("#ifVariables").change(function() {
            var selectedOption = $(this).val();

            // Remove existing classes
            $(".luas_panen1, .produksi1, .produktivitas1, .luas_panen2, .produksi2, .produktivitas2")
                .removeClass("green-text red-text");

            // Use switch case to update subcard headers based on the selected option
            switch (selectedOption) {
                case "variablesLP":
                    $("#subCard1Header").text("Jika Produktivitas Tetap");
                    $(".luas_panen1").addClass("green-text");
                    $(".produksi1").addClass("red-text");
                    $("#subCard2Header").text("Jika Produksi Tetap");
                    $(".luas_panen2").addClass("green-text");
                    $(".produktivitas2").addClass("red-text");
                    break;
                case "variablesPV":
                    $("#subCard1Header").text("Jika Luas Panen Tetap");
                    $(".produktivitas1").addClass("green-text");
                    $(".produksi1").addClass("red-text");
                    $("#subCard2Header").text("Jika Produksi Tetap");
                    $(".produktivitas2").addClass("green-text");
                    $(".luas_panen2").addClass("red-text");
                    break;
                case "variablesPD":
                    $("#subCard1Header").text("Jika Luas Panen Tetap");
                    $(".produksi1").addClass("green-text");
                    $(".produktivitas1").addClass("red-text");
                    $("#subCard2Header").text("Jika Produktivitas Tetap");
                    $(".produksi2").addClass("green-text");
                    $(".luas_panen2").addClass("red-text");
                    break;
                default:
                    // Reset headers or handle other cases
                    $("#subCard1Header, #subCard2Header").text("Default Header");
                    break;
            }

            updateSubmitButtonState();
        });
    });
    </script>


    <link rel="stylesheet" href="style.css">

</body>

</html>