<div class="sidebar">
    <nav>
        <ul>
            <li>
                <img src="../assets/img/profile.png" class="img-fluid profile" width="55px">
                <h4 class="admin float-right"><?= substr($user['username'], 0, 6) ?></h4>
                <div class="online" style="margin-right: 48px">
                    <p class="float-right ontext">Online</p>
                    <div class="on float-right"></div>
                </div>
            </li>

            <!-- dashboard -->
            <a href="home.php" class="linkAktif">
                <li id="panel" <?php if($currentPage === 'home') echo 'class="aktif" style="border-left: 5px solid #306bff;"' ?>>
                    <div>
                        <span><i class="fa fa-book"></i></span>
                        <span style="margin-left: 4px">Data Buku</span>
                    </div>
                </li>
            </a>
            <!-- dashboard -->

            <!-- Tambah buku -->
            <a href="add-book.php" class="linkAktif">
                <li id="panel" <?php if($currentPage === 'add-book') echo 'class="aktif" style="border-left: 5px solid #306bff;"' ?>>
                    <div>
                        <span><i class="fas fa-plus-square"></i></span>
                        <span style="margin-left: 4px">Tambah Buku</span>
                    </div>
                </li>
            </a>
            <!-- Tambah buku-->

            <!-- Data mahasiswa -->
            <a href="data-mahasiswa.php" class="linkAktif">
                <li id="panel" <?php if($currentPage === 'data-mahasiswa') echo 'class="aktif" style="border-left: 5px solid #306bff;"' ?>>
                    <div>
                        <span><i class="fa fa-user-graduate"></i></span>
                        <span style="margin-left: 4px">Data Mahasiswa</span>
                    </div>
                </li>
            </a>
            <!-- Data mahasiswa -->

        </ul>
    </nav>
</div>