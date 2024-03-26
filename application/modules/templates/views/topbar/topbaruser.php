<?php
$keranjang = $this->cart->contents();
$jml_item = 0;
foreach ($keranjang as $k) {
  $jml_item = $jml_item + $k['qty'];
}
?>
<header class="header-01 fix-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-2 col-md-2">
        <div class="logo">
          <a href="index.html">
            <!-- <img src="assets/images/logo.png" alt="Goru" /> -->
          </a>
        </div>
      </div>
      <div class="col-lg-6 col-md-6">
        <nav class="mainmenu mobile-menu">
          <div class="mobile-btn">
            <a href="javascript: void(0);"><span>Menu</span><i class="twi-bars"></i></a>
          </div>
          <ul>
            <li class="active menu-item-has-children">
              <a href="<?php echo base_url('home') ?>">Home</a>
            </li>
            <li class="menu-item-has-children">
              <a href="#shop">Shop</a>
            </li>
            <li><a href="#contact-address">Contact</a></li>
          </ul>
        </nav>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="header-cogs">
          <a class="search search-toggles" href="javascript:void(0);"><i class="twi-search"></i></a>
          <?php if ($this->session->userdata('id_role') == true) : ?>
            <a class="user-login" href="<?php echo base_url('auth/logout') ?>"><i class="twi-user-circle"></i><span>Logout</span></a>
          <?php else : ?>
            <a class="user-login" href="<?php echo base_url('login') ?>"><i class="twi-user-circle"></i><span>Account</span></a>
          <?php endif; ?>

          <?php if ($jml_item == 0) : ?>
            <a class="carts" href="javascript:void(0);"><span>0</span><img src="<?php echo base_url('assets/assets_user/images/cart.png') ?>" alt=""></a>
          <?php else : ?>
            <a class="carts" href="<?php echo base_url('cart/viewcart') ?>"><span><?php echo $jml_item ?></span><img src="<?php echo base_url('assets/assets_user/images/cart.png') ?>" alt=""></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</header>