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
                  <h1>Users</h1>
                  <span>Halaman Management User menyediakan berbagai fitur untuk mengelola data user</span>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Table Users</h5>
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
                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
                    <div class="example-container">
                      <div class="example-content">
                        <table class="table">
                          <thead class="table-dark">
                            <tr>
                              <th scope="col">No.</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Username</th>
                              <th scope="col">Email</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Status</th>
                              <th scope="col">Tanggal Dibuat</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php $no = 1; ?>
                            <?php foreach ($data_user as $user) : ?>
                              <tr>
                                <th scope="row"><?= $no; ?>.</th>
                                <td>
                                  <input type="hidden" id="id_user" name="id_user" value="<?= $user['id']; ?>">
                                  <?= $user['nama'] ?>
                                </td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['no_hp'] ?></td>
                                <td>
                                  <?php if ($user['is_active'] == 1) : ?>
                                    <p>Aktif</p>
                                  <?php else : ?>
                                    <p>Tidak Aktif</p>
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <?php
                                  $timestamp = strtotime($user['created_at']);
                                  // format tanggal dan waktu dalam bahasa Indonesia
                                  $tanggal_waktu = date('d-m-Y H:i:s', $timestamp);
                                  ?>
                                  <?= $tanggal_waktu  ?>
                                </td>
                                <td class="text-center">
                                  <button type="button" class="btn btn-sm btn-success btn-burger" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $user['id']; ?>"><i class="material-icons">edit</i></button>
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
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Add Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="row">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
          </div>
          <div class="row mt-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" required>
          </div>
          <div class="row mt-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" required>
          </div>
          <div class="row mt-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>
          <div class="row mt-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" oninput="validateInput(this)" required>
          </div>
          <div class="row mt-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" id="image" required>
          </div>
          <div class="row mt-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" name="role" id="role" aria-label="Default select example">
              <option value="1">Admin</option>
              <option value="2">Customer</option>
            </select>
          </div>
          <div class="row mt-3">
            <label for="is_active" class="form-label">User Aktif</label>
            <select class="form-select" name="is_active" id="is_active" aria-label="Default select example">
              <option value="1">Aktif</option>
              <option value="2">Tidak Aktif</option>
            </select>
          </div>
          <div class="row mt-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" name="password" id="password" required>
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
  foreach ($data_user as $user) :  ?>
    <div class="modal fade" id="modalEdit<?= $user['id'] ?>" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditLabel">Form Edit Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('user/edit_data'); ?>" method="post" id="myForm">
              <div class="row">
                <label for="nama" class="form-label">Nama</label>
                <input type="hidden" name="id_user" id="id_user" value="<?= $user['id'] ?>">
                <input type="text" class="form-control" name="nama" id="nama" value="<?= $user['nama'] ?>" required>
              </div>
              <div class="row mt-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= $user['username'] ?>" required>
              </div>
              <div class="row mt-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $user['alamat'] ?>" required>
              </div>
              <div class="row mt-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?= $user['email'] ?>" required>
              </div>
              <div class="row mt-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" oninput="validateInput(this)" value="<?= $user['no_hp'] ?>" required>
              </div>
              <div class="row mt-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" name="role" id="role" aria-label="Default select example">
                  <option value="1" <?= $selected = $user['id_role'] == 1 ? 'selected' : '' ?>>Admin</option>
                  <option value="2" <?= $selected = $user['id_role'] == 2 ? 'selected' : '' ?>>Customer</option>
                </select>
              </div>
              <div class="row mt-3">
                <label for="is_active" class="form-label">User Aktif</label>
                <select class="form-select" name="is_active" id="is_active" aria-label="Default select example">
                  <option value="1" <?= $selected = $user['is_active'] == 1 ? 'selected' : '' ?>>Aktif</option>
                  <option value="2" <?= $selected = $user['is_active'] == 2 ? 'selected' : '' ?>>Tidak Aktif</option>
                </select>
              </div>
              <div class="row mt-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" name="password" id="password">
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
    function validateInput(input) {
      // Menghapus karakter selain angka
      input.value = input.value.replace(/[^0-9]/g, '');
    }

    $(".flatpickr1").flatpickr();
  </script>

  <script>
    $("button[name='btnSubmit']").click(function(e) {
      e.preventDefault();
      let nama = $("input[name=nama]").val();
      let username = $("input[name=username]").val();
      let alamat = $("input[name=alamat]").val();
      let email = $("input[name=email]").val();
      let phone = $("input[name=phone]").val();
      let image = $("input[name=image]");
      let cek_gambar = image[0].files[0];
      let role = $("select[name=role]").val();
      let is_active = $("select[name=is_active]").val();
      let password = $("input[name=password]").val();
      console.log(nama);
      console.log(username);
      console.log(alamat);
      console.log(email);
      console.log(phone);
      console.log(image);
      console.log(role);
      console.log(is_active);
      console.log(password);

      let formData = new FormData();
      formData.append("nama", nama);
      formData.append("username", username);
      formData.append("alamat", alamat);
      formData.append("email", email);
      formData.append("phone", phone);
      formData.append("image", image[0].files[0]);
      formData.append("role", role);
      formData.append("is_active", is_active);
      formData.append("password", password);

      if (nama == undefined || nama == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom nama tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (username == undefined || username == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom username tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (email == undefined || email == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom icon tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (phone == undefined || phone == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom phone tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (email == undefined || email == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom icon tidak boleh kosong!",
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
              url: "user/insert_data/user.php",
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
    $("button[name='btnSubmitEdit']").click(function(e) {
      e.preventDefault();

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
            url: "user/edit_data/user.php",
            method: "POST",
            data: $("#myForm").serialize(),
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

  <script>
    $("button[name='btnHapusData']").click(function(e) {
      e.preventDefault();
      let id_user = $(this).closest("tr").find("#id_user").val();

      let formData = new FormData();
      formData.append("id_user", id_user);

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
            url: "user/delete_data/user.php",
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