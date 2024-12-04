 <!-- Menu -->

 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
     <div class="app-brand demo">
         <a href="<?= site_url('dashboard'); ?>" class="app-brand-link">
             <img src="<?php echo base_url('asset/LOGO.png') ?>" width="50" height="50" alt="Logo" class="logo-img img-fluid">
             <h4 class="menu-text fw-bolder ms-2 mt-3">DASHBOARD ADMIN</h4>
         </a>
         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
             <i class="bx bx-chevron-left bx-sm align-middle"></i>
         </a>
     </div>

     <div class="menu-inner-shadow"></div>

     <ul class="menu-inner py-1">
         <!-- Dashboard -->
         <li class="menu-item">
             <a href="<?= site_url('dashboard') ?>" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-home-circle"></i>
                 <div data-i18n="Analytics">Dashboard</div>
             </a>
         </li>

         <li class="menu-header small text-uppercase">
             <span class="menu-header-text">Transaksi</span>
         </li>
         <li class="menu-item">

             <a href="<?= site_url('riwayat') ?>" class="menu-link">
                 <i class='menu-icon bx bx-transfer-alt'></i>
                 <div data-i18n="Analytics">Peminjaman</div>
             </a>
             <!-- <ul class="menu-sub">
                 <li class="menu-item ">
                     <a href="<?= site_url('peminjaman') ?>" class="menu-link">
                         <div data-i18n="Without menu">Peminjaman</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="<?= site_url('riwayat') ?>" class="menu-link">
                         <div data-i18n="Container">Riwayat Peminjaman</div>
                     </a>
                 </li>
             </ul> -->
         </li>
         <li class="menu-item">
             <a href="<?= site_url('riwayatkembali') ?>" class="menu-link">
                 <i class='menu-icon bx bx-check'></i>
                 <div data-i18n="Layouts">Pengembalian</div>
             </a>
             <!-- <ul class="menu-sub">
                 <li class="menu-item ">
                     <a href="<?= site_url('Pengembalian') ?>" class="menu-link">
                         <div data-i18n="Without menu">Pengembalian</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="<?= site_url('riwayatkembali') ?>" class="menu-link">
                         <div data-i18n="Container">Riwayat Pengembalian</div>
                     </a>
                 </li>
             </ul> -->
         </li>

         <li class="menu-item">
             <a href="<?= site_url('denda') ?>" class="menu-link">
                 <i class='menu-icon bx bx-wallet'></i>
                 <div data-i18n="Layouts">Denda</div>
             </a>
             <!-- <ul class="menu-sub">
                 <li class="menu-item ">
                     <a href="<?= site_url('denda') ?>" class="menu-link">
                         <div data-i18n="Without menu">Daftar Denda</div>
                     </a>

                 </li>
             </ul> -->
         </li>

         <li class="menu-header small text-uppercase">
             <span class="menu-header-text">Data</span>
         </li>

         <li class="menu-item">
             <a href="<?= site_url('siswa') ?>" class="menu-link">
                 <i class='menu-icon bx bx-user'></i>
                 <div data-i18n="Layouts">Anggota</div>
             </a>
         </li>
         <li class="menu-item">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class='menu-icon bx bx-book'></i>
                 <div data-i18n="Layouts">Buku</div>
             </a>
             <ul class="menu-sub">
                 <li class="menu-item">
                     <a href="<?= site_url('buku') ?>" class="menu-link">
                         <div data-i18n="Container">Data buku</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="<?= site_url('kategori') ?>" class="menu-link">
                         <div data-i18n="Without menu">Kategori buku</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="<?= site_url('rak') ?>" class="menu-link">
                         <div data-i18n="Container">Rak buku</div>
                     </a>
                 </li>
             </ul>
         </li>

         <li class="menu-header small text-uppercase">
             <span class="menu-header-text">Laporan</span>
         </li>
         <li class="menu-item">
             <a href="<?= site_url('laporan') ?>" class="menu-link">
                 <i class='menu-icon bx bx-dock-bottom'></i>
                 <div data-i18n="Layouts">Laporan Admin</div>
             </a>

         </li>

         



     </ul>
 </aside>
 <!-- / Menu -->