@php
$uker = Auth::user()->ukerMaster->nama_unit_kerja_eselon_2;
@endphp

<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
      <div class="flex-row-reverse text-center row align-items-center">
        {{-- <div class="col-lg-auto ms-lg-auto">
          <ul class="mb-0 list-inline list-inline-dots">
            <li class="list-inline-item"><a href="www.kemlu.go.id" target="_blank" class="link-secondary" rel="noopener">Kementerian Luar Negeri</a></li>
          </ul>
        </div> --}}
        <div class="col-lg-auto me-lg-auto">
          <ul class="mb-0 list-inline list-inline-dots">
            <li class="list-inline-item">Logged in as {{ $uker }}</li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
