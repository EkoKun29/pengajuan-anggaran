 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('admin_super.dashboard') }}">
          <i class="bi bi-houses"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      {{-- <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('kios.index') }}">
              <i class="bi bi-square-half"></i>
              <span>Kios</span>
          </a>
      </li><!-- End Kios Nav --> --}}

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clipboard"></i><span>Pengajuan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin_super.ASanggaran.index') }}">
              <i class="bi bi-circle"></i><span>Input Pengajuan</span>
            </a>
          </li>
          <li>
            <a href="{{ route('riwayat-pengajuan.index') }}">
              <i class="bi bi-circle"></i><span>Riwayat Pengajuan</span>
            </a>
          </li>
        </ul>
      </li><!-- End Barcode -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#audit-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clipboard-check"></i><span>Status Pengajuan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="audit-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          {{-- <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Input Barcode</span>
            </a>
          </li>
          <li> --}}
            <a href="{{ route('direktur.pengajuan.index') }}">
              <i class="bi bi-circle"></i><span>Status Pengajuan</span>
            </href=>
          </li>
        </ul>
      </li><!-- End Barcode -->

      
      {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Pembelian</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('pembelian.create') }}">
              <i class="bi bi-circle"></i><span>Input Pembelian</span>
            </a>
          </li>
          <li>
            <a href="{{ route('pembelian.index') }}">
              <i class="bi bi-circle"></i><span>Daftar Pembelian</span>
            </a>
          </li>
        </ul>
      </li><!-- End Pembelian Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Harga Jual</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route ('hargajual.index') }}">
              <i class="bi bi-circle"></i><span>Lihat Harga Jual</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#penj-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Penjualan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="penj-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('penjualan.create') }}">
              <i class="bi bi-circle"></i><span>Input Penjualan</span>
            </a>
          </li>
          <li>
            <a href="{{ route('penjualan.index') }}">
              <i class="bi bi-circle"></i><span>Daftar Penjualan</span>
            </a>
          </li>
        </ul>
      </li><!-- End Penjualan Nav --> --}}
      
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin_super.user.index') }}">
                <i class="bi bi-person"></i>
                <span>User</span>
            </a>
        </li>
        <!-- End akun user Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('divisions.import.view') }}">
                <i class="bi bi-person"></i>
                <span>Import Data Excel</span>
            </a>
        </li>
        <!-- End akun user Nav -->

    </ul>

  </aside><!-- End Sidebar-->