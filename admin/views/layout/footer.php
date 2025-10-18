                </div>
                <!-- Container-fluid Ends-->

                <!-- footer start-->
                <div class="container-fluid">
                    <footer class="footer">
                        <div class="row">
                            <div class="col-md-12 footer-copyright text-center">
                                <p class="mb-0">Copyright 2025 by Pollob Ahmed Sagor</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <!-- footer End-->
            </div>
            <!-- index body end -->

        </div>
        <!-- Page Body End -->
    </div>
    <!-- page-wrapper End-->

    <!-- Modal Start -->
    <div class="modal theme-modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Logging Out</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to log out?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-cancel" type="button" data-bs-dismiss="modal"
                    aria-label="Close">No</button>
                    <button class="btn btn-submit" type="submit" data-bs-dismiss="modal" aria-label="Close"><a href="login.html">Yes</a></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- latest js -->
    <script src="<?php echo  $base_url?>/assets/js/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap js -->
    <script src="<?php echo  $base_url?>/assets/js/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- feather icon js -->
    <script src="<?php echo  $base_url?>/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="<?php echo  $base_url?>/assets/js/icons/feather-icon/feather-icon.js"></script>

    <!-- scrollbar simplebar js -->
    <script src="<?php echo  $base_url?>/assets/js/scrollbar/simplebar.js"></script>
    <script src="<?php echo  $base_url?>/assets/js/scrollbar/custom.js"></script>

    <!-- Sidebar jquery -->
    <script src="<?php echo  $base_url?>/assets/js/config.js"></script>

    <!-- tooltip init js -->
    <script src="<?php echo  $base_url?>/assets/js/tooltip-init.js"></script>

     <!-- Plugins JS -->
    <script src="<?php echo  $base_url?>/assets/js/sidebar-menu.js"></script>
    <!-- Apexchar js -->
    <script src="<?php echo  $base_url?>/assets/js/chart/apex-chart/apex-chart1.js"></script>
    <script src="<?php echo  $base_url?>/assets/js/chart/apex-chart/moment.min.js"></script>
    <script src="<?php echo  $base_url?>/assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="<?php echo  $base_url?>/assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="<?php echo  $base_url?>/assets/js/chart/apex-chart/chart-custom1.js"></script>

    <!-- swiper slider -->
    <script src="<?php echo  $base_url?>/assets/js/swiper-bundle.min.js"></script>
    <script src="<?php echo  $base_url?>/assets/js/custom-swiper.js"></script>

    <!-- customizer js -->
    <script src="<?php echo  $base_url?>/assets/js/customizer.js"></script>

    <!-- ratio js -->
    <script src="<?php echo  $base_url?>/assets/js/ratio.js"></script>

    <!-- Theme js -->
    <script src="<?php echo  $base_url?>/assets/js/script.js"></script>
    <script>
        $("#checkall").change(function () {
      var checked = $(this).is(":checked");
      if (checked) {
          $(".custom-checkbox").each(function () {
              $(this).prop("checked", true);
          });
  
      } else {
          $(".custom-checkbox").each(function () {
              $(this).prop("checked", false);
          });
      }
  });
      </script>
</body>


<!-- Mirrored from themes.pixelstrap.net/zomo/landing/backend/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Sep 2025 05:59:16 GMT -->
</html>