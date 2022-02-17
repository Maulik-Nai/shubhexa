<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- FOOTER START -->
<footer class="site-footer footer-light" >

    <!-- FOOTER NEWSLETTER START -->
    <div class="footer-top-newsletter">
        <div class="container">
            <div class="sf-news-letter">
                <span>Subscribe Our Newsletter</span>
                <form>
                    <div class="form-group sf-news-l-form">
                        <input type="text" class="form-control" placeholder="Enter Your Email">
                        <button type="submit" class="sf-sb-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- FOOTER BLOCKES START -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <!-- Footer col 1-->
                <div class="col-lg-3 col-md-6 col-sm-6  m-b30">
                    <div class="sf-site-link sf-widget-link">
                        <h4 class="sf-f-title">Site Links</h4>
                        <ul>
                            <li><a href="blog-grid.html">Blog</a></li>
                            <li><a href="contact-us.html">Contact Us</a></li>
                            <li><a href="job-grid.html">Jobs</a></li>
                            <li><a href="all-categories.html">Categories</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Footer col 2-->
                <div class="col-lg-3 col-md-6 col-sm-6  m-b30">
                    <div class="sf-site-link sf-widget-cities">
                        <h4 class="sf-f-title">Popular Cities</h4>
                        <ul>
                            <li><a href="all-categories.html">Ballston Lake</a></li>
                            <li><a href="all-categories.html">Batumi</a></li>
                            <li><a href="all-categories.html">Brooklyn</a></li>
                            <li><a href="all-categories.html">Cambridge</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Footer col 1-->
                <div class="col-lg-3 col-md-6 col-sm-6  m-b30">
                    <div class="sf-site-link sf-widget-categories">
                        <h4 class="sf-f-title">Categories</h4>
                        <ul>
                            <li><a href="categories-detail.html">Car Service</a></li>
                            <li><a href="categories-detail.html">House Cleaning</a></li>
                            <li><a href="categories-detail.html">Transport</a></li>
                            <li><a href="categories-detail.html">Yoga Classes</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Footer col 1-->
                <div class="col-lg-3 col-md-6 col-sm-6  m-b30">
                    <div class="sf-site-link sf-widget-contact">
                        <h4 class="sf-f-title">Contact Info</h4>
                        <ul>
                            <li>India</li>
                            <li>+41 232 525 5257</li>
                            <li>+41 856 525 5369</li>
                            <li>hello@Servicefinder.com</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- FOOTER COPYRIGHT -->
    <div class="footer-bottom">
        <div class="container">
            <div class="sf-footer-bottom-section">
                <div class="sf-f-logo"><a href="javascript:void(0);"><img src="<?=asset_path('web/')?>images/logo-light.png" alt=""></a></div>
            	<div class="sf-f-copyright">
                	<span>Copyright <?=date('Y')?> | Shubhexa. All Rights Reserved</span>
                </div>

                <div class="sf-f-social">
                    <ul class="socila-box">
                        <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

</footer>
<!-- FOOTER END -->

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>

</div>



<!-- Login Sign Up Modal -->
<div class="modal fade" id="login-signup-model">
<div class="modal-dialog">
<div class="modal-content">
    <button type="button" class="close aon-login-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="modal-body">

        <div class="sf-custom-tabs sf-custom-new aon-logon-sign-area p-3">

            <!--Tabs-->
            <ul class="nav nav-tabs nav-table-cell">
                <li><a data-toggle="tab" href="#Upcoming" class="active">Login</a></li>
                <li><a data-toggle="tab" href="#Past">Sign up</a></li>
            </ul>
            <!--Tabs Content-->
            <div class="tab-content">

                <!--Login Form-->
                <div id="Upcoming" class="tab-pane active">
                    <div class="sf-tabs-content">
                        <form class="aon-login-form">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="aon-inputicon-box">
                                            <input class="form-control sf-form-control" name="company_name" type="text" placeholder="User Name">
                                            <i class="aon-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="aon-inputicon-box">
                                            <input class="form-control sf-form-control" name="company_name" type="password" placeholder="Password">
                                            <i class="aon-input-icon fa fa-lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group d-flex aon-login-option justify-content-between">
                                        <div class="aon-login-opleft">
                                             <div class="checkbox sf-radio-checkbox">
                                                <input id="td2_2" name="abc" value="five" type="checkbox">
                                                <label for="td2_2">Keep me logged</label>
                                            </div>
                                        </div>
                                        <div class="aon-login-opright">
                                            <a href="#">Forget Password</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="site-button w-100">Submit <i class="feather-arrow-right"></i> </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                <!--Sign up Form-->
                <div id="Past" class="tab-pane">
                    <div class="sf-tabs-content">
                        <form class="aon-login-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="aon-inputicon-box">
                                            <input class="form-control sf-form-control" name="First_Name" type="text" placeholder="First Name">
                                            <i class="aon-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="aon-inputicon-box">
                                            <input class="form-control sf-form-control" name="company_name" type="password" placeholder="Last Name">
                                            <i class="aon-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="aon-inputicon-box">
                                            <input class="form-control sf-form-control" name="Phone" type="password" placeholder="Phone">
                                            <i class="aon-input-icon fa fa-phone"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="aon-inputicon-box">
                                            <input class="form-control sf-form-control" name="email" type="password" placeholder="Email">
                                            <i class="aon-input-icon fa fa-envelope-o"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="aon-inputicon-box">
                                            <input class="form-control sf-form-control" name="password" type="password" placeholder="Password">
                                            <i class="aon-input-icon fa fa-lock"></i>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="aon-inputicon-box">
                                            <input class="form-control sf-form-control" name="password" type="password" placeholder="Confirm Password">
                                            <i class="aon-input-icon fa fa-lock"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group sign-term-con">
                                        <div class="checkbox sf-radio-checkbox">
                                            <input id="td33" name="abc" value="five" type="checkbox">
                                            <label for="td33">I've read and agree with your <a href="#">Privacy Policy</a> and <a href="#">Terms & Conditions</a> </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="site-button w-100">Submit <i class="feather-arrow-right"></i> </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
</div>
</div>
<!-- Login Sign Up Modal -->


<!-- JAVASCRIPT  FILES ========================================= -->
<script src="<?=asset_path('web/')?>js/jquery-3.6.0.min.js"></script><!-- JQUERY.MIN JS -->
<script src="<?=asset_path('web/')?>js/popper.min.js"></script><!-- POPPER.MIN JS -->
<script src="<?=asset_path('web/')?>js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="<?=asset_path('web/')?>js/bootstrap-select.min.js"></script><!-- BOOTSTRAP SELECT -->
<script src="<?=asset_path('web/')?>js/jquery.bootstrap-touchspin.js"></script><!-- FORM JS -->
<script src="<?=asset_path('web/')?>js/magnific-popup.min.js"></script><!-- MAGNIFIC-POPUP JS -->
<script src="<?=asset_path('web/')?>js/waypoints.min.js"></script><!-- WAYPOINTS JS -->
<script src="<?=asset_path('web/')?>js/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="<?=asset_path('web/')?>js/waypoints-sticky.min.js"></script><!-- STICKY HEADER -->
<script src="<?=asset_path('web/')?>js/isotope.pkgd.min.js"></script><!-- MASONRY  -->

<script src="<?=asset_path('web/')?>js/owl.carousel.min.js"></script><!-- OWL  SLIDER  -->
<script src="<?=asset_path('web/')?>js/slick.min.js"></script><!-- OWL  SLIDER  -->

<script src="<?=asset_path('web/')?>js/theia-sticky-sidebar.js"></script><!-- STICKY SIDEBAR  -->
<script src="<?=asset_path('web/')?>js/m-custom-scrollbar.min.js"></script><!-- my account left panel scroller -->
<script src="js/dropzone.js"></script><!-- Images upload -->

<script src="<?=asset_path('web/')?>js/bootstrap4-toggle.min.js"></script>
<script src="<?=asset_path('web/')?>js/jquery.dataTables.min.js"></script>
<script src="<?=asset_path('web/')?>js/dataTables.bootstrap4.min.js"></script>

<script src="<?=asset_path('web/')?>js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
<script src="<?=asset_path('web/')?>js/lc_lightbox.lite.js" ></script><!-- IMAGE POPUP -->
<script src="<?=asset_path('web/')?>js/bootstrap-slider.min.js"></script><!-- Form js -->


</body>

</html>
