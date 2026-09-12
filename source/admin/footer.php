</div>
</div>
</div>

<script>
    <?php
    if (isset($_GET['modal']) == false) {
    ?>
    // ========== جستجوی زنده در منوی سایدبار (هر دو فیلد دسکتاپ و موبایل) ==========
    (function () {
        const desktopSearch = document.getElementById('desktopSearchInput');
        const mobileSearch = document.getElementById('mobileSearchInput');
        const sidebarMenu = document.getElementById('sidebarMenu');
        if (!sidebarMenu) return;

        // تابع فیلتر کردن آیتم‌های منو
        function filterSidebar(term) {
            const allItems = sidebarMenu.querySelectorAll('li');
            const lowerTerm = term.trim().toLowerCase();

            // مرحله ۱: فیلتر آیتم‌های دارای لینک
            allItems.forEach(li => {
                const link = li.querySelector('a');
                if (link) {
                    const text = link.textContent.trim().toLowerCase();
                    if (lowerTerm === '' || text.includes(lowerTerm)) {
                        li.classList.remove('d-none');
                    } else {
                        li.classList.add('d-none');
                    }
                }
            });

            // مرحله ۲: مدیریت جداکننده‌ها (li.divider)
            const dividers = sidebarMenu.querySelectorAll('li.divider');
            if (lowerTerm === '') {
                dividers.forEach(div => div.classList.remove('d-none'));
                return;
            }

            dividers.forEach(div => div.classList.remove('d-none'));

            const allItemsArray = Array.from(allItems);
            const dividerIndices = [];
            allItemsArray.forEach((li, index) => {
                if (li.classList.contains('divider')) {
                    dividerIndices.push(index);
                }
            });

            for (let i = 0; i < dividerIndices.length; i++) {
                const startIdx = dividerIndices[i];
                const endIdx = (i < dividerIndices.length - 1) ? dividerIndices[i + 1] : allItemsArray.length;
                let hasVisible = false;
                for (let j = startIdx + 1; j < endIdx; j++) {
                    if (!allItemsArray[j].classList.contains('divider') && !allItemsArray[j].classList.contains('d-none')) {
                        hasVisible = true;
                        break;
                    }
                }
                if (!hasVisible) {
                    allItemsArray[startIdx].classList.add('d-none');
                }
            }

            const lastDividerIdx = dividerIndices[dividerIndices.length - 1];
            if (lastDividerIdx !== undefined) {
                let hasVisibleAfter = false;
                for (let j = lastDividerIdx + 1; j < allItemsArray.length; j++) {
                    if (!allItemsArray[j].classList.contains('divider') && !allItemsArray[j].classList.contains('d-none')) {
                        hasVisibleAfter = true;
                        break;
                    }
                }
                if (!hasVisibleAfter) {
                    allItemsArray[lastDividerIdx].classList.add('d-none');
                }
            }

            const firstDividerIdx = dividerIndices[0];
            if (firstDividerIdx !== undefined && firstDividerIdx > 0) {
                let hasVisibleBefore = false;
                for (let j = 0; j < firstDividerIdx; j++) {
                    if (!allItemsArray[j].classList.contains('divider') && !allItemsArray[j].classList.contains('d-none')) {
                        hasVisibleBefore = true;
                        break;
                    }
                }
                if (!hasVisibleBefore) {
                    allItemsArray[firstDividerIdx].classList.add('d-none');
                }
            }
        }

        // تابع همگام‌سازی جستجو بین دو فیلد
        function syncSearch(value) {
            if (desktopSearch && desktopSearch.value !== value) {
                desktopSearch.value = value;
            }
            if (mobileSearch && mobileSearch.value !== value) {
                mobileSearch.value = value;
            }
            filterSidebar(value);
        }

        // افزودن event listener به هر دو فیلد
        if (desktopSearch) {
            desktopSearch.addEventListener('input', function () {
                syncSearch(this.value);
            });
        }
        if (mobileSearch) {
            mobileSearch.addEventListener('input', function () {
                syncSearch(this.value);
            });
        }

        // اجرای اولیه برای نمایش همه آیتم‌ها
        filterSidebar('');
    })();

    // ========== مدیریت سایدبار موبایل ==========
    (function () {
        const sidebar = document.getElementById('mainSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const body = document.body;
        let isSidebarOpen = false;
        let historyStateAdded = false;

        function openSidebar() {
            if (window.innerWidth >= 992) return;
            if (isSidebarOpen) return;
            sidebar.classList.add('open');
            backdrop.classList.add('show');
            isSidebarOpen = true;
            body.classList.add('menu-open');
            if (!historyStateAdded) {
                history.pushState({sidebarOpen: true}, '');
                historyStateAdded = true;
            }
        }

        function closeSidebar() {
            if (window.innerWidth >= 992) {
                sidebar.classList.remove('open');
                backdrop.classList.remove('show');
                isSidebarOpen = false;
                body.classList.remove('menu-open');
                historyStateAdded = false;
                return;
            }
            if (!isSidebarOpen) return;
            sidebar.classList.remove('open');
            backdrop.classList.remove('show');
            isSidebarOpen = false;
            body.classList.remove('menu-open');
            if (historyStateAdded) {
                try {
                    history.replaceState(null, '', window.location.href);
                } catch (e) {
                }
                historyStateAdded = false;
            }
        }

        function toggleSidebar() {
            isSidebarOpen ? closeSidebar() : openSidebar();
        }

        function handleResize() {
            if (window.innerWidth >= 992) {
                sidebar.classList.remove('open');
                backdrop?.classList.remove('show');
                body.classList.remove('menu-open');
                isSidebarOpen = false;
                if (historyStateAdded) {
                    try {
                        history.replaceState(null, '', window.location.href);
                    } catch (e) {
                    }
                    historyStateAdded = false;
                }
            } else {
                if (isSidebarOpen && !sidebar.classList.contains('open')) {
                    sidebar.classList.add('open');
                    backdrop?.classList.add('show');
                    body.classList.add('menu-open');
                } else if (!isSidebarOpen && sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                    backdrop?.classList.remove('show');
                    body.classList.remove('menu-open');
                }
            }
        }

        backdrop?.addEventListener('click', closeSidebar);
        hamburgerBtn?.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleSidebar();
        });
        sidebar?.addEventListener('click', (e) => e.stopPropagation());
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isSidebarOpen && window.innerWidth < 992) closeSidebar();
        });
        window.addEventListener('popstate', () => {
            if (isSidebarOpen && window.innerWidth < 992) closeSidebar();
        });
        window.addEventListener('resize', handleResize);
        handleResize();
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 992 && isSidebarOpen) setTimeout(closeSidebar, 100);
            });
        });
    })();
    <?php
    }else {
    ?>
    document.getElementById('mainSidebar').style.display = "none";
    document.getElementsByClassName('dashboard-header')[0].style.display = "none";
    document.getElementsByClassName('w3-white w3-padding-large w3-margin w3-round-medium w3-right')[0].width = "100%";
    document.getElementsByClassName('w3-white w3-padding-large w3-margin w3-round-medium w3-right')[0].classList.remove("w3-margin");
    <?php
    }
    ?>
</script>
<script src="bootstrap-5.3.7-dist/js/bootstrap.bundle.js"></script>