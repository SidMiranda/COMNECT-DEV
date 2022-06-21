<?php 
//require_once(getenv('tilevu')); 
//require_once($path_admin_include."loadInfo.php");
session_start()
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <?php require_once("include/head.php")?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            <?php require("include/side-bar.php")?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                    <?php require("include/top-bar.php")?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Exemplos de codigos para integração com TEF Scope</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary disabled shadow-sm">
                            <i class="fas fa-upload fa-sm text-white-50"></i> Report a bug</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col">
                            <?php
                                include_once("content/codigo.php");
                            ?>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <?php include("include/footer.php")?>
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
    
    
    <!-- scripts -->
        <?php require_once("include/scripts.php")?>

       
</body>

</html>
