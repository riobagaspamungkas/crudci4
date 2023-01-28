<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

class Barang extends BaseController
{
    public function index()
    {
        $data = [
            'getdata' => $this->BarangModel->findAll(),
        ];
        return view('index',$data);
    }

    public function tambah_data()
	{
        return view('form_tambah');
	}

    public function t_data()
    {
        $kode_barang = $_POST['kode_barang'];
        $cek_barang = $this->BarangModel->cekdata("barang","kode_barang",$kode_barang);
        if ($cek_barang > 0) {
            echo "<script>
            alert('Data Ganda');
            window.location.href='/';
            </script>";
        }else{
            $validationRule = [
                'userfile' => [
                    'label' => 'Image File',
                    'rules' => [
                        'uploaded[userfile]',
                        'is_image[userfile]',
                        'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                        'max_size[userfile,1000]',
                        'max_dims[userfile,1024,768]',
                    ],
                ],
            ];
            if (! $this->validate($validationRule)) {
            	$kosong = NULL;
                if ($this->BarangModel->tambahbarang($kosong)) {
                    echo "<script>
                    alert('Data berhasil ditambah');
                    window.location.href='/';
                    </script>";
                }else{
                    echo "<script>
                    alert('Data error');
                    window.location.href='barang/add';
                    </script>";
                }
            }
            $img = $this->request->getFile('userfile');
            if ($img->isValid() && ! $img->hasMoved()) {
            	$newName = $img->getRandomName();
                $img->move(ROOTPATH . 'public/assets/images', $newName);
                /*$filepath = WRITEPATH . 'uploads' . $img->store('images');
                $data = ['uploaded_fileinfo' => new File($filepath)];*/
                if ($this->BarangModel->tambahbarang($newName)) {
                    echo "<script>
                    alert('Data berhasil ditambah');
                    window.location.href='/';
                    </script>";
                }else{
                    echo "<script>
                    alert('Data error');
                    window.location.href='barang/add';
                    </script>";
                }
            }
            echo "<script>
            alert('Data error');
            window.location.href='barang/add';
            </script>";
        }
    }

    public function edit_data($id)
	{
		$data = [
            'getdata' => $this->BarangModel->getByField('barang','kode_barang',$id),
        ];
        return view('form_edit',$data);
	}

	public function e_data()
    {
        $getid = $_POST['getid'];
        $kode_barang = $_POST['kode_barang'];
        $cek_barang = $this->BarangModel->cekvalidasi("barang","kode_barang",$kode_barang,$getid);
        if ($cek_barang > 0) {
            echo "<script>
            alert('Data Ganda');
            window.location.href='/';
            </script>";
        }else{
        	$cek_gambar = $this->BarangModel->getByField('barang','kode_barang',$getid);
        	$getuserFile = $cek_gambar['gambar'];
            $foto = ", gambar='".$cek_gambar['gambar']."'";
            $validationRule = [
                'userfile' => [
                    'label' => 'Image File',
                    'rules' => [
                        'uploaded[userfile]',
                        'is_image[userfile]',
                        'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                        'max_size[userfile,1000]',
                        'max_dims[userfile,1024,768]',
                    ],
                ],
            ];
            if (! $this->validate($validationRule)) {
                if ($this->BarangModel->editbarang($foto)) {
                    echo "<script>
                    alert('Data berhasil diubah tanpa ubah foto');
                    window.location.href='/';
                    </script>";
                }else{
                    echo "<script>
                    alert('Data error');
                    window.location.href='barang/edit_data/$getid';
                    </script>";
                }
            }
            $img = $this->request->getFile('userfile');
            if ($img->isValid() && ! $img->hasMoved()) {
            	$newName = $img->getRandomName();
                $img->move(ROOTPATH . 'public/assets/images', $newName);
                $foto2 = ", gambar='".$newName."'";
                /*$filepath = WRITEPATH . 'uploads' . $img->store('images');
                $data = ['uploaded_fileinfo' => new File($filepath)];*/
                if ($this->BarangModel->editbarang($foto2)) {
                	unlink('assets/images/'.$getuserFile);
                    echo "<script>
                    alert('Data berhasil diubah dgn ubah foto');
                    window.location.href='/';
                    </script>";
                }else{
                    echo "<script>
                    alert('Data error');
                    window.location.href='add';
                    </script>";
                }
            }
            echo "<script>
            alert('Data error');
            window.location.href='add';
            </script>";
        }
    }

    public function hapus_data()
	{
		$kode_barang = $_POST['kode_barang'];
        if( $this->BarangModel->hapus_barang($kode_barang) > 0 ) {
            echo "<script>
            alert('Data berhasil dihapus');
            window.location.href='/';
			</script>";
        } else {
            echo "<script>
			alert('Data error');
			window.location.href='/';
			</script>";
        }
    }

	// proses tambah data dengan validasi dan tanpa gambar
	public function t_data_validasi()
    {
        $validation = \Config\Services::validation();

        $data = array(
            'kode_barang'     => $this->request->getPost('kode_barang'),
            'nama_barang'   => $this->request->getPost('nama_barang'),
            'jumlah_barang'   => $this->request->getPost('jumlah_barang'),
            'harga_barang'   => $this->request->getPost('harga_barang'),
        );

        if($validation->run($data, 'barang') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('add'));
        } else {
        	//cek data ganda
        	$kode_barang = $_POST['kode_barang'];
        	$cek_barang = $this->BarangModel->cekdata("barang","kode_barang",$kode_barang);
        	if ($cek_barang > 0) {
        		echo "<script>
	            alert('Data Ganda');
	            window.location.href='/';
	            </script>";
	        } else {
	            if($this->BarangModel->tambah_barang($data)) {
	                echo "<script>
                    alert('Data berhasil ditambah');
                    window.location.href='/';
                    </script>";
	            } else {
	            	echo "<script>
                    alert('Data error');
                    window.location.href='/barang/add';
                    </script>";
	            }
	        }
        }
    }

	// proses tambah data tanpa validasi dan tanpa gambar
	public function t_data_nofoto()
    {
        $kode_barang = $_POST['kode_barang'];
    	$cek_barang = $this->BarangModel->cekdata("barang","kode_barang",$kode_barang);
    	if ($cek_barang > 0) {
    		echo "<script>
            alert('Data Ganda');
            window.location.href='/';
            </script>";
        } else {
            if($this->BarangModel->tambah_barang($kode_barang)) {
                echo "<script>
                alert('Data berhasil ditambah');
                window.location.href='/';
                </script>";
            } else {
            	echo "<script>
                alert('Data error');
                window.location.href='/barang/add';
                </script>";
            }
        }
    }
}