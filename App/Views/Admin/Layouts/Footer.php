<?php

namespace App\Views\Admin\Layouts;

use App\Views\BaseView;

class Footer extends BaseView
{
        public static function render($data = null)
        {

?>

                <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                        <span>copyright &copy; <script>
                                                        document.write(new Date().getFullYear());
                                                </script> -
                                                <b><a href="/" target="_blank">Caycanhvahoa</a></b>
                                        </span>
                                </div>
                        </div>
                </footer>
                <!-- Footer -->
                </div>
                </div>

                <!-- Scroll to top -->
                <a class="scroll-to-top rounded" href="#page-top">
                        <i class="fas fa-angle-up"></i>
                </a>

                <script src="/public/assets/admin/vendor/jquery/jquery.min.js"></script>
                <script src="/public/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="/public/assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
                <script src="/public/assets/admin/js/ruang-admin.min.js"></script>
                <script src="/public/assets/admin/vendor/chart.js/Chart.min.js"></script>
                <script src="/public/assets/admin/js/demo/chart-area-demo.js"></script>
                <script src="/public/assets/admin/js/createInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
                </body>

                </html>

<?php
        }
}

?>