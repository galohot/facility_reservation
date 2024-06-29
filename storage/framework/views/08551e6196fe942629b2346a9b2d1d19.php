<?php
$uker = Auth::user()->ukerMaster->nama_unit_kerja_eselon_2;
?>

<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
      <div class="flex-row-reverse text-center row align-items-center">
        
        <div class="col-lg-auto me-lg-auto">
          <ul class="mb-0 list-inline list-inline-dots">
            <li class="list-inline-item">Logged in as <?php echo e($uker); ?></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views\layouts\navigation\footer.blade.php ENDPATH**/ ?>