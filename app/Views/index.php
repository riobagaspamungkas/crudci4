<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <style>
    .navbar {
      background-color: #FFB266;
      color: white;
    }
    .text-white {
      font-color: white;
    }
    .main {
      padding-top: 20px;
    }
  </style>
</head>
<body>
  <nav class="navbar fixed-top navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="<?= base_url() ?>">E-Barang</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="<?= base_url() ?>">Home</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container border main">
    <div class="row">
      <div class="col-12 py-5">
        <h2 class="card-title" style="text-align: center;">Daftar data Barang</h2>
        <a href="<?= base_url(); ?>/barang/add" class="btn btn-secondary"><em class="mdi mdi-plus"></em> Tambah </a>
        <br><br>
        <table class="table table-striped table-bordered table-list">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Jumlah</th>
              <th>Harga</th>
              <th>Gambar</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($getdata as $row){
              echo "<tr>";
              echo "<td>$no</td>";
              echo "<td>".$row['kode_barang']."</td>";
              echo "<td>".$row['nama_barang']."</td>";
              echo "<td>".$row['jumlah_barang']."</td>";
              echo "<td>".$row['harga_barang']."</td>";
              // echo "<td>".$row['gambar']."</td>";
              ?>
              <td align="center">
                <?php
                if ($row['gambar'] == '') {
                  echo "-";
                } else { ?>
                  <img src="assets/images/<?=$row['gambar']?>" style="width: 100px;">
                <?php }
                ?>
              </td>
              <td align="center">
              <a href="<?= base_url().'/barang/edit_data/'.$row['kode_barang']?>" class="btn btn-primary">Edit</a>
              <a href="#" data-bs-toggle='modal' data-bs-target='#konfirmasi_hapus<?= $row['kode_barang']; ?>' class="btn btn-danger">Hapus</a>
              </td>
              </tr><?php
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- modal delete untuk konfirmasi delete -->
  <?php 
  foreach ($getdata as $rowdata) {?>
  <div class="modal fade" id="konfirmasi_hapus<?= $rowdata['kode_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <form method="post" action="<?= base_url().'/hapus_data'?>">
            <b>Anda yakin ingin menghapus data ini ?<?= $rowdata['nama_barang']; ?></b><br><br>
            <input type="hidden" name="kode_barang" value="<?= $rowdata['kode_barang']; ?>">
            <button type="submit" class="btn btn-danger btn-ok">Hapus</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  <script src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    //konfirmasi modal delete data pegawai
    $(document).ready(function() {
        $('#konfirmasi_hapus').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
  </script>
</body>
</html>