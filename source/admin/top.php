<script>
    function openModal(url, onClose) {
        url = url + "?modal=1";
        // شناسه یکتا برای این مودال
        const modalId = 'modal-' + Date.now();

        // ---------- ساخت backdrop ----------
        const backdrop = document.createElement('div');
        backdrop.id = modalId + '-backdrop';
        backdrop.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(128, 128, 128, 0.5);   /* خاکستری با شفافیت */
        z-index: 1040;
    `;

        // ---------- ساخت مودال ----------
        const modal = document.createElement('div');
        modal.id = modalId;
        modal.style.cssText = `
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1050;
        width: 60%;
        height: 70%;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0,0,0,0.4);
        /* کلاس‌های اختیاری بوت‌استرپ (در صورت وجود) */
        class: "modal-dialog modal-content";
    `;

        // ---------- استایل واکنش‌گرا با media query ----------
        const styleTag = document.createElement('style');
        styleTag.textContent = `
        @media (max-width: 768px) {
            #${modalId} {
                width: 90% !important;
                height: 90% !important;
            }
        }
    `;
        document.head.appendChild(styleTag);

        // ---------- iframe ----------
        const iframe = document.createElement('iframe');
        iframe.src = url;
        iframe.style.cssText = `
        width: 100%;
        height: 100%;
        border: none;
        display: block;
    `;
        iframe.setAttribute('allow', 'fullscreen');

        // ---------- دکمه بستن (ضربدر گنده) ----------
        const closeBtn = document.createElement('button');
        closeBtn.innerHTML = '&times;';
        closeBtn.style.cssText = `
        position: absolute;
        top: 12px;
        right: 20px;
        font-size: 3rem;
        font-weight: 700;
        line-height: 1;
        background: transparent;
        border: none;
        color: #333;
        cursor: pointer;
        z-index: 1060;
        padding: 0 8px;
        transition: transform 0.2s;
    `;
        closeBtn.onmouseover = () => closeBtn.style.transform = 'scale(1.2)';
        closeBtn.onmouseout = () => closeBtn.style.transform = 'scale(1)';
        closeBtn.setAttribute('aria-label', 'بستن مودال');

        // ---------- چیدمان المان‌ها ----------
        modal.appendChild(iframe);
        modal.appendChild(closeBtn);
        document.body.appendChild(backdrop);
        document.body.appendChild(modal);

        // ---------- تابع بستن مودال ----------
        function closeModal() {
            // حذف المان‌ها از DOM
            if (document.body.contains(backdrop)) document.body.removeChild(backdrop);
            if (document.body.contains(modal)) document.body.removeChild(modal);
            if (styleTag.parentNode) styleTag.parentNode.removeChild(styleTag);

            // اجرای تابع callback (در صورت وجود)
            if (typeof onClose === 'function') onClose();
        }

        // فقط کلیک روی دکمه ضربدر مودال را می‌بندد
        closeBtn.addEventListener('click', closeModal);

        // (اختیاری) جلوگیری از بسته شدن با کلید Escape در صورت تمایل
        // window.addEventListener('keydown', function handler(e) {
        //     if (e.key === 'Escape') {
        //         closeModal();
        //         window.removeEventListener('keydown', handler);
        //     }
        // });

        // برگرداندن id مودال (در صورت نیاز)
        return modalId;
    }

    var item_name = "";
    var param_name = "";
    var param_val = "";
    var selector_id = "";

    function load_items() {
        placeid = "plcsender";
        input.name = param_name;
        input.id = param_name;
        input.type = "hidden";
        input.values = param_val;
        input.classes = "snddata";
        makeinput();

        postobj.post_url = item_name + ".php";
        postobj.send_type = "post";
        postobj.after_success = function (data) {
            document.getElementById(selector_id).innerHTML = data;
        }
        res_obj_postdata("snddata");
    }
</script>
<div class="admin-wrapper">
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- سایدبار سمت راست -->
    <aside class="sidebar" id="mainSidebar">
        <div class="sidebar-inner">
            <div class="text-center mb-3 mt-2">
                <i class="fas fa-chalkboard-user fs-1" style="color:#7aa9e2;"></i>
                <h5 class="fw-semibold mt-2" style="color:#eef2ff">پنل مدیریت</h5>
            </div>
            <!-- فیلد جستجوی مخصوص موبایل (در بالای منو) -->
            <div class="sidebar-search-mobile" id="sidebarSearchMobile">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="جستجو در منو..." id="mobileSearchInput">
                </div>
            </div>