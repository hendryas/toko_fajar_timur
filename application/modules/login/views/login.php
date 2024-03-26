   <!-- Login Register Section Start -->
   <section class="login-section">
     <div class="container">
       <div class="row">
         <div class="col-lg-6 col-md-6">
           <h3 class="sec-title">Login your account</h3>
           <p class="sec-desc">
             To continue shopping, please log in with your account. If you don't have an account yet, you can click link Register in below.
           </p>
           <?php echo $this->session->flashdata('message'); ?>
           <div class="login-form">
             <form action="<?php echo base_url('login/loginuser') ?>" method="post">
               <input type="text" name="username" placeholder="User Name" required>
               <input type="password" name="password" placeholder="Your Password" required>
               <div class="keep-log-regi">
                 <!-- <input type="radio" id="login" name="login" value="keep-login"> -->
                 <!-- <label for="login">Keep me logged in</label> -->
                 <a href="<?php echo base_url('forgotpassword') ?>">Forgot your password?</a>
                 <a href="<?php echo base_url('auth/register') ?>">Register</a>
               </div>
               <input type="submit" name="submit" value="login">
             </form>
           </div>
           <div class="social-log-regi">

           </div>
         </div>
       </div>
     </div>
   </section>
   <!-- Login Register Section End -->