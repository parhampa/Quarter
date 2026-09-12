<ul class="sidebar-menu" id="sidebarMenu">
    <li><a href="index.php"><i class="fas fa-tachometer-alt"></i> داشبورد</a></li>
    <li><a href="admin_user.php?action=show"><i class="fas fa-user-shield"></i> مدیران سیستم</a></li>
    <li><a href="member_cat.php?action=show"><i class="fas fa-layer-group"></i> دسته بندی کاربران</a></li>
    <li><a href="members.php?action=show"><i class="fas fa-users"></i> کاربران سامانه</a></li>
    <li><a href="member_groups.php?action=show"><i class="fas fa-user-friends"></i> گروه های کاربران</a></li>
    <li><a href="cat_admin.php?action=show"><i class="fas fa-user-tie"></i> مدیران گروه ها</a></li>
    <li class="divider"></li>
    <li><a href="vaz_tayid_admin.php?action=show"><i class="fas fa-check-circle"></i> تعریف وضعیت ادمین</a></li>
    <li><a href="vaz_moshtari.php?action=show"><i class="fas fa-store"></i> تعریف واحد صنفی مشتری</a></li>
    <li><a href="vaz_estelam.php?action=show"><i class="fas fa-question-circle"></i> تعریف وضعیت های استعلام</a>
    </li>
    <li><a href="vaz_task.php?action=show"><i class="fas fa-tasks"></i> تعریف وضعیت تسک ها</a></li>
    <li><a href="vaz_req_kharid.php?action=show"><i class="fas fa-tasks"></i> تعریف وضعیت درخواست خرید</a></li>
    <li><a href="vision_weight.php?action=show"><i class="fas fa-weight-hanging"></i> تعریف واحدهای اندازه گیری</a>
    </li>
    <li><a href="sell_type.php?action=show"><i class="fas fa-tags"></i> تعریف انواع فروش</a></li>
    <li><a href="place_united.php?action=show"><i class="fas fa-map-marker-alt"></i> تعریف استان ها</a></li>
    <li><a href="place_city.php?action=show"><i class="fas fa-city"></i> تعریف شهرها</a></li>
    <li class="divider"></li>
    <li><a href="customer_cat.php?action=show"><i class="fas fa-folder-open"></i> دسته بندی مشتریان</a></li>
    <li><a href="customer.php?action=show"><i class="fas fa-address-card"></i> مشتریان</a></li>
    <li class="divider"></li>
    <li><a href="kala_cat1.php?action=show"><i class="fas fa-tag"></i> دسته بندی سطح 1 محصولات</a></li>
    <li><a href="kala_cat2.php?action=show"><i class="fas fa-tags"></i> دسته بندی سطح 2 محصولات</a></li>
    <li><a href="kala.php?action=show"><i class="fas fa-box"></i> تعریف محصولات</a></li>
    <li class="divider"></li>
    <li><a href="mynote.php?action=show"><i class="fas fa-sticky-note"></i> یادداشت های من</a></li>
    <li class="divider"></li>
    <li><a href="question_member.php?action=show"><i class="fas fa-sticky-note"></i> سوالات ارزیابی پرسنل</a></li>
    <li><a href="question_customer.php?action=show"><i class="fas fa-sticky-note"></i> سوالات ارزیابی مشتریان</a>
    </li>
    <li class="divider"></li>
    <li><a href="target_weight.php?action=show"><i class="fas fa-sticky-note"></i> تعریف تارگت وزن فروش</a></li>
    <li><a href="target_price.php?action=show"><i class="fas fa-sticky-note"></i> تعریف تارگت مبلغ فروش</a></li>
    <li><a href="target_city.php?action=show"><i class="fas fa-sticky-note"></i> تعریف تارگت شهر فروش</a></li>
    <li class="divider"></li>
    <li><a href="task_cat.php?action=show"><i class="fas fa-list-ul"></i> دسته بندی وظایف</a></li>
    <li><a href="dailycal.php?action=show"><i class="fas fa-file-invoice-dollar"></i> تماس روزانه</a></li>
    <li><a href="req_kharid.php?action=show"><i class="fas fa-clipboard-list"></i>درخواست خرید</a></li>
    <li><a href="tasks.php?action=show"><i class="fas fa-clipboard-list"></i> تسک ها</a></li>
    <li><a href="peygiri.php?action=show"><i class="fas fa-search"></i> پیگیری ها</a></li>
    <li class="divider"></li>
    <li><a href="faktor.php?action=show"><i class="fas fa-file-invoice-dollar"></i> فاکتور فروش روزانه</a></li>
    <li class="divider"></li>
    <li><a href="amar_task.php"><i class="fas fa-chart-pie"></i> آمار تسک ها</a></li>
    <li><a href="amar_peygiri.php"><i class="fas fa-chart-line"></i> آمار پیگیری ها</a></li>
    <li><a href="amar_faktor.php"><i class="fas fa-chart-bar"></i> آمار فاکتور ها</a></li>
    <li class="divider"></li>
    <li><a href="report.php"><i class="fas fa-file-alt"></i> گزارشات روزانه</a></li>
</ul>
</div>
</aside>

<!-- محتوای اصلی -->
<div class="main-content">
    <header class="dashboard-header">
        <div class="header-container">
            <button class="hamburger-btn" id="hamburgerBtn"><i class="fas fa-bars"></i></button>
            <!-- فیلد جستجوی دسکتاپ (فقط در دسکتاپ نمایش داده شود) -->
            <div class="search-wrapper header-search-desktop">
                <div class="input-group search-input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="جستجو در منو..." id="desktopSearchInput">
                </div>
            </div>
            <div class="user-actions">
                <div class="dropdown notif-dropdown">
                    <div class="notification-bell dropdown-toggle" id="notificationDropdown" data-bs-toggle="dropdown"
                         aria-expanded="false">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge-dot"></span>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                        <?php
                        $sqlt = "select * from `report` order by `id` desc limit 0,4";
                        $dbt = new database();
                        $dbt->connect()->query($sqlt);
                        while ($fildt = mysqli_fetch_assoc($dbt->res)) {
                            ?>
                            <li>
                                <div class="notif-item">
                                    <div class="notif-title"><?php echo($fildt['title']); ?></div>
                                    <div class="notif-time"><?php
                                        $dt = new date_man();
                                        echo($dt->roz_pish($fildt['post_date'], date("Y-m-d")));
                                        ?></div>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="notif-footer"><a href="report.php?action=show">مشاهده بیشتر <i
                                        class="fas fa-arrow-left"></i></a></li>
                    </ul>
                </div>
                <div class="dropdown profile-dropdown">
                    <div class="user-info dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown"
                         aria-expanded="false">
                        <?php
                        $thisuser = $_SESSION['username'];
                        $sqlt = "select * from `admin_user` where `username`='$thisuser'";
                        $dbt = new database();
                        $dbt->connect()->query($sqlt);
                        $fildt = mysqli_fetch_assoc($dbt->res);
                        $avatar = mb_substr($fildt['name'], 0, 1, 'UTF-8');;
                        ?>
                        <div class="user-avatar"><span><?php echo($avatar); ?></span></div>
                        <span class="user-name"><?php echo($fildt['name'] . " " . $fildt['family']); ?></span>
                        <i class="fas fa-chevron-down" style="font-size: 10px;"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user-circle"></i> پروفایل
                                من</a></li>
                        <li><a class="dropdown-item w3-disabled" href="#"><i class="fas fa-chart-pie"></i> پیشخوان
                                اختصاصی</a></li>
                        <li><a class="dropdown-item w3-disabled" href="#"><i class="fas fa-cog"></i> تنظیمات حساب</a>
                        </li>
                        <li><a class="dropdown-item" href="security.php"><i class="fas fa-lock"></i> تغییر رمز عبور</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt"></i>
                                خروج</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="content-area">