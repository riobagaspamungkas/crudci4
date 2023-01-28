<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Form Tambah</title>
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<style>
    .navbar {
      background-color: #FFB266;
      width: 100%;
    }
    .main {
      padding-top: 40px;
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
	<div class="card main">
		<div class="card-body">
			<div class="row">
				<h1 style="text-align: center;">Input Form Data</h1>
				<form method="post" enctype="multipart/form-data" action="<?= base_url()?>/tambah_data">
					<?= csrf_field() ?>
					<div class="row mb-3">
						<label class="col-sm-2 col-form-label">Kode Barang</label>
						<div class="col-sm-10">
							<input type="text" name="kode_barang" class="form-control" placeholder="Masukkan Kode Barang" required>
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-sm-2 col-form-label">Nama Barang</label>
						<div class="col-sm-10">
							<input type="text" name="nama_barang" class="form-control" placeholder="Masukkan Nama Barang" required>
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-sm-2 col-form-label">Jumlah Barang</label>
						<div class="col-sm-10">
							<input type="number" name="jumlah_barang" class="form-control" placeholder="Masukkan Jumlah Barang" required>
						</div>
					</div>
			  		<div class="row mb-3">
						<label class="col-sm-2 col-form-label">Harga Barang</label>
						<div class="col-sm-10">
							<input type="number" name="harga_barang" class="form-control" placeholder="Masukkan Harga Barang" required>
						</div>
					</div>
			  		<div class="row mb-3">
						<label class="col-sm-2 col-form-label">Gambar</label>
						<div class="col-sm-10">
							<input type="file" name="userfile" accept="image/png, image/gif, image/jpeg" class="form-control" title="Choose a image please">
						</div>
					</div>
					<button type="submit" class="btn btn-primary">Simpan</button>
					<a href="<?= base_url()?>" class="btn btn-light"><i class="fa fa-arrow-circle-left"></i>Kembali</a>
				</form>
			</div>
		</div>
	</div>
	<script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>