<?php
$uri = explode('/', $_SERVER['REQUEST_URI']);
$url = "http://" . $_SERVER['HTTP_HOST'] . '/' . $uri[1] . '/' . $uri[2];
?>
</div>
</div>
</div>
<!-- content-wrapper ends -->
<!-- partial:../template/partials/_footer.html -->
<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.
            Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin
                template</a> from BootstrapDash.
            All rights reserved.</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made
            with <i class="ti-heart text-danger ml-1"></i></span>
    </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="<?= $url . '/' ?>/template/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?= $url . '/' ?>/template/vendors/typeahead.js/typeahead.bundle.min.js"></script>
<script src="<?= $url . '/' ?>/template/vendors/select2/select2.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?= $url . '/' ?>/template/js/off-canvas.js"></script>
<script src="<?= $url . '/' ?>/template/js/hoverable-collapse.js"></script>
<script src="<?= $url . '/' ?>/template/js/template.js"></script>
<script src="<?= $url . '/' ?>/template/js/settings.js"></script>
<script src="<?= $url . '/' ?>/template/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?= $url . '/' ?>/template/js/file-upload.js"></script>
<script src="<?= $url . '/' ?>/template/js/typeahead.js"></script>
<script src="<?= $url . '/' ?>/template/js/select2.js"></script>
<!-- End custom js for this page-->
</body>

</html>