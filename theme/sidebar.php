 <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="<?=$setting['nama_bisnis'];?>" class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light"><?=$setting['nama_bisnis'];?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
       <div class="d-block">
          <span class="text-white mr-2"> <?=$admin['fullname'];?></span>
          <a href="logout.php"><span class="badge badge-danger">Logout</span></a>
       </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item has-treeview <?php if ($menu == "dashboard"): ?>
             menu-open
           <?php endif ?>">
            <a href="#" class="nav-link <?php if ($menu == "dashboard"): ?>
             active
           <?php endif ?>">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php" class="nav-link <?php if ($menu == "dashboard" && $menuItem == "penjualan"): ?>
                 active 
                <?php endif ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pemesanan.php" class="nav-link <?php if ($menu == "dashboard" && $menuItem == "pemesanan"): ?>
                 active 
                <?php endif ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pemesanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pelunasan.php" class="nav-link <?php if ($menu == "dashboard" && $menuItem == "pelunasan"): ?>
                  active
                <?php endif ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelunasan</p>
                </a>
              </li>
            </ul>
          </li>
          <?php if ($isAdmin): ?>
          <li class="nav-item has-treeview <?php if ($menu == "management"): ?>
            menu-open
          <?php endif ?>">
            <a href="#" class="nav-link <?php if ($menu == "management"): ?>
             active
           <?php endif ?>">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="manage_pemesanan.php" class="nav-link <?php if ($menu == "management" && $menuItem == "pemesanan_m"): ?>
                  active
                <?php endif ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Pemesanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manage_pelanggan.php" class="nav-link <?php if ($menu == "management" && $menuItem == "pelanggan"): ?>
                  active
                <?php endif ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manage_barang.php" class="nav-link <?php if ($menu == "management" && $menuItem == "barang"): ?>
                  active
                <?php endif ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manage_barang_pesanan.php" class="nav-link <?php if ($menu == "management" && $menuItem == "barang_pemesanan"): ?>
                  active
                <?php endif ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Harga Pemesanan</p>
                </a>
              </li>
            </ul>
          </li>
           <li class="nav-item has-treeview <?php if ($menu == "laporan"): ?>
             menu-open
           <?php endif ?>">
            <a href="laporan.php" class="nav-link <?php if ($menu == "laporan"): ?>
             active
           <?php endif ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="balance.php" class="nav-link <?php if ($menu == "laporan" && $menuItem == "balance"): ?>
                  active
                <?php endif ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Balance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporan_penjualan.php" class="nav-link <?php if ($menu == "laporan" && $menuItem == "penjualan_l"): ?>
                  active
                <?php endif ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporan_pemesanan.php" class="nav-link <?php if ($menu == "laporan" && $menuItem == "pemesanan_l"): ?>
                  active
                <?php endif ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pemesanan</p>
                </a>
              </li>

              <!-- <li class="nav-item">
                <a href="manage_barang.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buat Pengeluaran</p>
                </a>
              </li> -->
            </ul>

          </li>
          <?php endif ?>
          
          <li class="nav-header">Konfigurasi</li>
          <li class="nav-item">
            <a href="setting.php" class="nav-link <?php if ($menu == "setting"): ?>
              active
            <?php endif ?>">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Pengaturan
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>