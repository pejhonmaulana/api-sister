<?php
include 'header.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kost</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kost</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php

                require 'vendor/autoload.php';

                use GuzzleHttp\Client;

                $client = new Client([
                    'base_uri' => 'http://127.0.0.1:8000',
                    'timeout' => 5
                ]);

                $response =  $client->request('GET', '/api/kost');
                $body = $response->getBody();
                $data_body = json_decode($body);
                // var_dump($data_body); // Check the structure of $data_body


                ?>
                <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="form/add-kost.php" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-solid fa-plus"></i>
                                </span>
                                <span class="text">Tambah Kost</span>
                            </a>
                        </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kost</th>
                            <th>Jumlah Kamar</th>
                            <th>Kamar Kosong</th>
                            <th>Jenis Kost</th>
                            <th>Fasilitas</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data_body->kost as $data) { ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data->nama_kost ?></td>
                                <td><?php echo $data->jumlah_kamar ?></td>
                                <td><?php echo $data->kamar_kosong ?></td>
                                <td><?php echo $data->jenis_kost ?></td>
                                <td><?php echo $data->fasilitas ?></td>
                                <td><?php echo $data->harga ?></td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
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

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>