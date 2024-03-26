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
                  <h1>Kategori</h1>
                  <span>Halaman Management Kategori menyediakan berbagai fitur untuk mengelola data kategori</span>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Table Kategori</h5>
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
                              <th scope="col">Kategori</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php $no = 1; ?>
                            <?php foreach ($data_category as $category) : ?>
                              <tr>
                                <th scope="row"><?= $no; ?>.</th>
                                <td>
                                  <input type="hidden" id="id_kategori" name="id_kategori" value="<?= $category['id']; ?>">
                                  <?= $category['kategori'] ?>
                                </td>
                                <td class="text-center">
                                  <button type="button" class="btn btn-sm btn-success btn-burger" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $category['id']; ?>"><i class="material-icons">edit</i></button>
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
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" required>
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
  foreach ($data_category as $category) :  ?>
    <div class="modal fade" id="modalEdit<?= $category['id'] ?>" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditLabel">Form Edit Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('category/edit_data'); ?>" method="post" enctype="multipart/form-data" id="myForm">
              <div class="row">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="hidden" name="id_kategori" id="id_kategori" value="<?= $category['id'] ?>">
                <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" value="<?= $category['kategori'] ?>" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <script>
    $("button[name='btnSubmit']").click(function(e) {
      e.preventDefault();
      let nama_kategori = $("input[name=nama_kategori]").val();

      let formData = new FormData();
      formData.append("nama_kategori", nama_kategori);

      if (nama_kategori == undefined || nama_kategori == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom nama kategori tidak boleh kosong!",
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
              url: "category/insert_data/category.php",
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
      let id_kategori = $(this).closest("tr").find("#id_kategori").val();

      let formData = new FormData();
      formData.append("id_kategori", id_kategori);

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
            url: "category/delete_data/category.php",
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