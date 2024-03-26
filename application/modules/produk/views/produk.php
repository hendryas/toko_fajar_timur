<body>
  <div class="app align-content-stretch d-flex flex-wrap">

    <?= $this->load->view('templates/leftbar/leftbar'); ?>

    <div class="app-container">
      <div class="search">
        <form>
          <input class="form-control" type="text" placeholder="Type here..." aria-label="Search">
        </form>
        <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
      </div>

      <?= $this->load->view('templates/topbar/topbar'); ?>

      <div class="app-content">
        <div class="content-wrapper">
          <div class="container-fluid">
            <div class="row">
              <div class="col">
                <div class="page-description">
                  <h1>Produk</h1>
                  <span>Halaman Management Produk menyediakan berbagai fitur untuk mengelola data produk</span>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Table Produk</h5>
                  </div>
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <div class="col-md-4"></div>
                  </div>

                  <div class="card-body">
                    <p class="card-description"></p>
                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
                    <div class="example-container">
                      <div class="example-content">
                        <table class="table">
                          <thead class="table-dark">
                            <tr>
                              <th scope="col">No.</th>
                              <th scope="col">Gambar Produk</th>
                              <th scope="col">Produk</th>
                              <th scope="col">Harga</th>
                              <th scope="col">Stok</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php $no = 1; ?>
                            <?php foreach ($data_produk as $produk) : ?>
                              <tr>
                                <th scope="row"><?= $no; ?>.</th>
                                <td>
                                  <img id="preview_logo" src="<?= base_url('assets/img/barang/' . $produk['image']) ?>" width="200">
                                </td>
                                <td>
                                  <input type="hidden" id="id" name="id" value="<?= $produk['id']; ?>">
                                  <?= $produk['nama_barang'] ?>
                                </td>
                                <td>
                                  <?= $produk['harga'] ?>
                                </td>
                                <td>
                                  <?= $produk['stok'] ?>
                                </td>
                                <td class="text-center">
                                  <button type="button" class="btn btn-sm btn-success btn-burger" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $produk['id']; ?>"><i class="material-icons">edit</i></button>
                                  <button type="button" name="btnHapusData" class="btn btn-sm btn-danger btn-burger"><i class="material-icons">delete_outline</i></button>
                                </td>
                              </tr>
                              <?php $no++; ?>
                            <?php endforeach; ?>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>

  <!-- Add Modal -->
  <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Form Add Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="row">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="kategori" id="kategori" class="form-select" aria-label="Default select example">
              <option value="">-- Pilih --</option>
              <?php foreach ($data_category as $category) : ?>
                <option value="<?= $category['id'] ?>"><?= $category['kategori'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="row mt-2">
            <label for="nama_barang" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" required>
          </div>
          <div class="row mt-2">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" name="harga" id="harga" required>
          </div>
          <div class="row mt-2">
            <label for="berat" class="form-label">Berat</label>
            <input type="number" class="form-control" name="berat" id="berat" required>
          </div>
          <div class="row mt-2">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <div class="form-floating">
              <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="deskripsi" style="height: 100px"></textarea>
              <label for="floatingTextarea2">Deskripsi</label>
            </div>
          </div>
          <div class="row mt-2">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" name="stok" id="stok" required>
          </div>
          <div class="row mt-2">
            <label for="image" class="form-label">Gambar Produk</label>
            <input type="file" class="form-control" name="image" id="image" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" name="btnSubmit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <?php
  foreach ($data_produk as $produk) :  ?>
    <div class="modal fade" id="modalEdit<?= $produk['id'] ?>" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tambahModalLabel">Form Edit Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?php echo base_url('produk/edit_data') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <input type="text" class="form-control" name="id" id="id" value="<?php echo $produk['id'] ?>" hidden>
              <div class="row">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-select" aria-label="Default select example">
                  <option value="">-- Pilih --</option>
                  <?php foreach ($data_category as $category) : ?>
                    <option value="<?= $category['id'] ?>" <?php echo $category['id'] == $produk['id_kategori'] ? 'selected' : '' ?>><?= $category['kategori'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="row mt-2">
                <label for="nama_barang" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="<?php echo $produk['nama_barang'] ?>" required>
              </div>
              <div class="row mt-2">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga" id="harga" value="<?php echo $produk['harga'] ?>" required>
              </div>
              <div class="row mt-2">
                <label for="berat" class="form-label">Berat</label>
                <input type="number" class="form-control" name="berat" id="berat" value="<?php echo $produk['berat'] ?>" required>
              </div>
              <div class="row mt-2">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <div class="form-floating">
                  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="deskripsi" style="height: 100px"><?php echo $produk['deskripsi'] ?></textarea>
                  <label for="floatingTextarea2">Deskripsi</label>
                </div>
              </div>
              <div class="row mt-2">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" name="stok" id="stok" value="<?php echo $produk['stok']; ?>" required>
              </div>
              <div class="row mt-2">
                <label for="image" class="form-label">Gambar Produk</label>
                <input type="file" class="form-control" name="image" id="image">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="btnEdit" class="btn btn-primary">Edit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <script>
    $("button[name='btnSubmit']").click(function(e) {
      e.preventDefault();
      let kategori = $("select[name=kategori]").val();
      let nama_barang = $("input[name=nama_barang]").val();
      let harga = $("input[name=harga]").val();
      let berat = $("input[name=berat]").val();
      let deskripsi = $("textarea[name=deskripsi]").val();
      let stok = $("input[name=stok]").val();
      let image = $("input[name=image]");
      let cek_gambar = image[0].files[0];

      console.log(kategori);
      console.log(nama_barang);
      console.log(harga);
      console.log(berat);
      console.log(deskripsi);
      console.log(stok);

      let formData = new FormData();
      formData.append("kategori", kategori);
      formData.append("nama_barang", nama_barang);
      formData.append("harga", harga);
      formData.append("berat", berat);
      formData.append("deskripsi", deskripsi);
      formData.append("stok", stok);
      formData.append("image", image[0].files[0]);

      if (nama_barang == undefined || nama_barang == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom nama barang tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (kategori == undefined || kategori == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom kategori tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (harga == undefined || harga == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom harga tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (berat == undefined || berat == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom berat tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (deskripsi == undefined || deskripsi == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom deskripsi tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (stok == undefined || stok == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom stok tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else {
        Swal.fire({
          title: "Apakah Anda Yakin?",
          text: "Ingin Menyimpan Data!",
          icon: "question",
          showCancelButton: true,
          confirmButtonColor: "#19A87E",
          cancelButtonColor: "#ff3d60",
          confirmButtonText: "Ya, Lanjutkan!",
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "produk/insert_data/produk.php",
              method: "POST",
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              beforeSend: () => {
                $.LoadingOverlay("show");
              },
              complete: () => {
                $.LoadingOverlay("hide");
              },
              success: (response) => {
                let obj = JSON.parse(response);
                if (obj.status == "OK") {
                  Swal.fire("Sukses!", obj.message, "success").then(() => {
                    window.location.reload();
                  });
                } else {
                  Swal.fire("Oops!", obj.message, "error");
                }
              },
            });
          }
        });
      }
    });
  </script>

  <script>
    $("button[name='btnHapusData']").click(function(e) {
      e.preventDefault();
      let id = $(this).closest("tr").find("#id").val();

      let formData = new FormData();
      formData.append("id", id);

      Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Ingin Menghapus Data Ini!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#19A87E",
        cancelButtonColor: "#ff3d60",
        confirmButtonText: "Ya, Lanjutkan!",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "produk/delete_data/produk.php",
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: () => {
              $.LoadingOverlay("show");
            },
            complete: () => {
              $.LoadingOverlay("hide");
            },
            success: (response) => {
              let obj = JSON.parse(response);
              if (obj.status == "OK") {
                Swal.fire("Sukses!", obj.message, "success").then(() => {
                  window.location.reload();
                });
              } else {
                Swal.fire("Oops!", obj.message, "error");
              }
            },
          });
        }
      });
    });
  </script>