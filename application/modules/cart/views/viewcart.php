<!-- Preloader Start -->
<div class="preloader" id="preloader">
  <div class="la-ball-scale-multiple la-2x">
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>
<!-- Preloader End -->

<!-- Header Start -->
<?php
$this->load->view('templates/topbar/topbaruser');
?>
<!-- Header End -->

<!-- Popup Search -->
<section class="popup-search-sec">
  <div class="popup-search-overlay"></div>
  <div class="overlay-popup">
    <a href="javascript:void(0);" class="search-closer">x</a><!-- Close Popup Btn -->
    <div class="middle-search">
      <div class="popup-search-form"><!-- Search Form Start -->
        <form method="get" action="#">
          <input type="search" name="s" id="s" placeholder="Search...">
          <button type="submit"><i class="twi-search"></i></button>
        </form><!-- Search Form End -->
      </div>
    </div>
  </div>
</section>
<!-- Popup Search -->

<!-- Banner Start -->
<section class="page-banner">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <span class="round-shape"></span>
        <h2 class="banner-title">Cart</h2>
        <div class="bread-crumb"><a href="index.html">Home</a> / Cart</div>
      </div>
    </div>
  </div>
</section>
<!-- Banner End -->

<!-- Cart Section Start -->
<section class="cart-section">
  <div class="container">
    <?php
    $keranjang = $this->cart->contents();
    $jml_item = 0;
    foreach ($keranjang as $k) {
      $jml_item = $jml_item + $k['qty'];
    }
    ?>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="row">
      <div class="col-md-12">
        <?php echo form_open('cart/updatebarangcart'); ?>
        <table class="cart-table">
          <thead>
            <tr>
              <th class="product-name-thumbnail">Produk</th>
              <th class="product-price">Harga</th>
              <th class="product-quantity">Quantity</th>
              <th class="product-total">Total</th>
              <th class="product-remove">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php if ($jml_item == 0) : ?>
              <tr class="cart-item">
                <td class="product-thumbnail-title" colspan="5">
                  Tidak ada barang
                </td>
              </tr>
            <?php else : ?>
              <?php foreach ($this->cart->contents() as $items) : ?>
                <?php
                $this->load->model('produk/produk_model', 'barangModel');
                $barang = $this->barangModel->getDataProductDetail($items['id'])->row_array();
                ?>
                <tr class="cart-item">
                  <td class="product-thumbnail-title">
                    <a href="#">
                      <img src="<?php echo base_url('assets/img/barang/') .  $barang['image'] ?>" alt="">
                    </a>
                    <a class="product-name" href="#"><?php echo $items['name'] ?></a>
                  </td>
                  <td class="product-unit-price">
                    <div class="product-price clearfix">
                      <span class="price">
                        <span><span class="woocommerce-Price-currencySymbol">Rp</span> <?php echo number_format($items['price'], 0); ?></span>
                      </span>
                    </div>
                  </td>
                  <td class="product-quantity clearfix">
                    <div class="quantityd clearfix">
                      <button class="qtyBtn btnMinus"><span>-</span></button>

                      <input name="<?php echo $i ?>[qty]" value="<?php echo $items['qty'] ?>" maxlength="3" min="0" size="5" title="Qty" class="input-text qty text carqty" type="text">
                      <button class="qtyBtn btnPlus">+</button>
                    </div>
                  </td>
                  <td class="product-total">
                    <div class="product-price clearfix">
                      <span class="price">
                        <span><span class="woocommerce-Price-currencySymbol">Rp</span><?php echo number_format($items['subtotal'], 0); ?></span>
                      </span>
                    </div>
                  </td>
                  <td class="product-remove">
                    <a href="<?php echo base_url('cart/deletebarangcart/') . $items['rowid'] . '/' . $items['qty'] . '/' . $barang['id']; ?>"></a>
                  </td>
                </tr>
                <?php $i++; ?>
              <?php endforeach; ?>
            <?php endif; ?>
            <tr>
              <td colspan="6" class="actions">
                <a href="<?php echo base_url('cart/clearbarangcart'); ?>" class="button clear-cart">Clear Shopping Cart</a>
                <button type="submit" class="button update">Update Shopping Cart</button>
                <a href="<?php echo base_url('home') ?>" class="button continue-shopping">Continue Shopping</a>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <div class="col-md-6">
            <div class="coupon">

            </div>
          </div>
          <div class="col-md-6">
            <div class="cart-totals">
              <h2>Cart Totals</h2>
              <table class="shop-table">
                <tbody>
                  <tr class="cart-subtotal">
                    <!-- <th>Sub Total</th> -->
                    <td data-title="Subtotal">
                      <!-- <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rp</span> </?php echo number_format($this->cart->total(), 0); ?></span> -->
                    </td>
                  </tr>
                  <tr class="order-total">
                    <th>Grand Total</th>
                    <td data-title="Subtotal">
                      <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rp</span><?php echo number_format($this->cart->total(), 0); ?></span>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="wc-proceed-to-checkout">
                <a href="<?php echo base_url('cart/checkout'); ?>" class="checkout-button">Proceed to checkout</a>
              </div>
            </div>
          </div>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</section>
<!-- Cart Section End -->

<!-- Footer Start -->
<?php $this->load->view('templates/footer/footertextuser'); ?>
<!-- Footer Ened -->

<!-- Coryight Start -->
<section class="copyright-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 col-md-5">
        <ul class="menu-link">
          <li><a href="#">Privacy Policy</a></li> |
          <li><a href="#">Terms of Service</a></li>
        </ul>
      </div>
      <div class="col-lg-6 col-md-7">
        <div class="copys-text"><i class="twi-copyright"></i>Copyright Toko Fajar Timur</div>
      </div>
    </div>
  </div>
</section>
<!-- Coryight End -->