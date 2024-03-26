<div class="app-sidebar">
  <div class="logo">
    <a href="<?= base_url('dashboard'); ?>" class="logo-icon"><span class="logo-text">TOKO FAJAR</span></a>
    <div class="sidebar-user-switcher user-activity-online">
      <a href="#">
        <!-- <img src="<?= base_url('assets/images/avatars/avatar.png') ?>"> -->
        <span class="activity-indicator"></span>
        <span class="user-info-text"><?php echo $this->session->userdata('nama')  ?><br><span class="user-state-info"></span></span>
      </a>
    </div>
  </div>
  <div class="app-menu">
    <ul class="accordion-menu">
      <li class="sidebar-title">
        Apps
      </li>
      <li class="active-page">
        <a href="<?= base_url('dashboard') ?>" class="active"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
      </li>

      <li>
        <a href=""><i class="material-icons-two-tone">star</i>Management<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
        <ul class="sub-menu">
          <li>
            <a href="<?= base_url('user') ?>">User</a>
          </li>
          <li>
            <a href="<?= base_url('produk') ?>">Produk</a>
          </li>
          <li>
            <a href="<?= base_url('category') ?>">Kategori</a>
          </li>
          <li>
            <a href="#">History Pembayaran Customer</a>
          </li>
        </ul>
      </li>


    </ul>
  </div>
</div>