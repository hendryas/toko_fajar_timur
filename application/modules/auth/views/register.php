 <!-- Login Register Section Start -->
 <section class="login-section">
   <div class="container">
     <div class="row">
       <div class="col-lg-6 col-md-6">
         <h3 class="sec-title">Register account now</h3>
         <p class="sec-desc">
           Please fill in the column below
         </p>
         <div class="register-form">
           <form action="<?php echo base_url('auth/register/registration') ?>" method="post">
             <div class="row">
               <div class="col-lg-6">
                 <input type="text" name="nama" placeholder="Your Name" required>
               </div>
               <div class="col-lg-6">
                 <input type="text" name="username" placeholder="User Name" required>
               </div>
               <div class="col-lg-6">
                 <input type="number" name="no_hp" placeholder="Phone" required>
               </div>
               <div class="col-lg-6">
                 <input type="email" name="email" placeholder="Email" required>
               </div>
               <div class="col-lg-6">
                 <input type="password" name="password" placeholder="Password" required>
               </div>
               <div class="col-lg-6">
                 <input type="password" name="retype-password" placeholder="Re Password" required>
               </div>
             </div>
             <div class="keep-log-regi">
               <small>Already have an account? Click link Login below</small>
               <br>
               <br>
               <br>
               <a href="<?php echo base_url('forgotpassword') ?>">Login</a>
             </div>

             <input type="submit" name="submit" value="register">
           </form>
         </div>
         <div class="social-log-regi">
           <!-- <h5>OR Register WITH</h5>
           <a href="#"><i class="twi-facebook-f"></i></a>
           <a href="#"><i class="twi-twitter"></i></a>
           <a href="#"><i class="twi-google-plus-g"></i></a>
           <a href="#"><i class="twi-instagram"></i></a> -->
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- Login Register Section End -->