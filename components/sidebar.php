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

            <!-- buku saya -->
            <a href="my-book.php" class="linkAktif">
                <li id="panel" <?php if($currentPage === 'my-book') echo 'class="aktif" style="border-left: 5px solid #306bff;"' ?>>
                    <div>
                        <span><i class="fas fa-book-reader"></i></span>
                        <span style="margin-left: 4px">Buku Saya</span>
                    </div>
                </li>
            </a>
            <!-- buku saya -->

            <!-- profile -->
            <a href="profile.php" class="linkAktif">
                <li id="panel" <?php if($currentPage === 'profile') echo 'class="aktif" style="border-left: 5px solid #306bff;"' ?>>
                    <div>
                        <span><i class="fa fa-user"></i></span>
                        <span style="margin-left: 4px">Profile saya</span>
                    </div>
                </li>
            </a>
            <!-- profile -->

            <!-- account -->
            <a href="account.php" class="linkAktif">
                <li id="panel" <?php if($currentPage === 'account') echo 'class="aktif" style="border-left: 5px solid #306bff;"' ?>>
                    <div>
                        <span><i class="fas fa-cog"></i></span>
                        <span style="margin-left: 4px">Pengaturan akun</span>
                    </div>
                </li>
            </a>
            <!-- account -->

        </ul>
    </nav>
</div>