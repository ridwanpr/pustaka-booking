 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:void(0)">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-book"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Pustaka Booking</div>
     </a>

     <?php if ($user['role_id'] == 1) : ?>
         <li class="nav-item">
             <a class="nav-link" href="<?= base_url('admin'); ?>">
                 <i class="fas fa-fw fa-tachometer-alt"></i>
                 <span>Dashboard</span></a>
         </li>

         <hr class="sidebar-divider">
         <div class="sidebar-heading">
             Master Data
         </div>

         <!-- Nav Item - Dashboard -->
         <li class="nav-item">
             <a class="nav-link" href="<?= base_url('kategori'); ?>">
                 <i class="fas fa-fw fa-book-open"></i>
                 <span>Kategori Buku</span></a>
         </li>

         <li class="nav-item">
             <a class="nav-link" href="<?= base_url('buku'); ?>">
                 <i class="fas fa-fw fa-book"></i>
                 <span>Daftar Buku</span></a>
         </li>

         <li class="nav-item">
             <a class="nav-link" href="<?= base_url('member'); ?>">
                 <i class="fas fa-fw fa-user"></i>
                 <span>Daftar Anggota</span></a>
         </li>

     <?php else : ?>
         <li class="nav-item">
             <a class="nav-link" href="<?= base_url('user'); ?>">
                 <i class="fas fa-fw fa-user"></i>
                 <span>Profil</span></a>
         </li>
     <?php endif; ?>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">
     <div class="sidebar-heading">
         Transaksi
     </div>

     <li class="nav-item">
         <a class="nav-link" href="<?= base_url('pinjam'); ?>">
             <i class="fas fa-fw fa-shopping-cart"></i>
             <span>Data Peminjaman</span></a>
     </li>

     <li class="nav-item">
         <a class="nav-link" href="<?= base_url('pinjam/daftarBooking'); ?>">
             <i class="fas fa-fw fa-table"></i>
             <span>Data Booking</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">
     <div class="sidebar-heading">
         Laporan
     </div>

     <li class="nav-item">
         <a class="nav-link" href="<?= base_url('laporan/laporan_buku'); ?>">
             <i class="fas fa-fw fa-print"></i>
             <span>Laporan Data Buku</span></a>
     </li>

     <li class="nav-item">
         <a class="nav-link" href="<?= base_url('laporanAnggota/laporan_anggota'); ?>">
             <i class="fas fa-fw fa-print"></i>
             <span>Laporan Data Anggota</span></a>
     </li>

     <li class="nav-item">
         <a class="nav-link" href="">
             <i class="fas fa-fw fa-print"></i>
             <span>Laporan Data Peminjaman</span></a>
     </li>

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline mt-3">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->