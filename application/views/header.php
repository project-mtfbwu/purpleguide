<?php
// Load the notification helper here rather than relying on autoload, so this
// view works no matter which order the files are deployed in. Every call below
// is still guarded, so a missing helper costs the section chip, not the page.
if (!function_exists('notification_section_label') && file_exists(APPPATH . 'helpers/notification_helper.php')) {
    require_once APPPATH . 'helpers/notification_helper.php';
}
$current = strtolower($this->uri->segment(1) ?? '');
$topbar_marquee = null;
$notification_count = 0;
$header_notifications = [];
if ($this->session->userdata('logged_in')
    && $this->session->userdata('user_id')
    && $this->db->table_exists('student_notifications')) {
    $header_notification_user_id = (int) $this->session->userdata('user_id');
    $notification_count = (int) $this->db
        ->where('user_id', $header_notification_user_id)
        ->where('is_read', 0)
        ->count_all_results('student_notifications');
    $header_notifications = $this->db
        ->where('user_id', $header_notification_user_id)
        ->order_by('created_at', 'DESC')
        ->limit(8)
        ->get('student_notifications')
        ->result();
}
if ($this->db->table_exists('marquee_tbl')
    && $this->db->field_exists('marquee_text', 'marquee_tbl')
    && $this->db->field_exists('marquee_link', 'marquee_tbl')
    && $this->db->field_exists('block_status', 'marquee_tbl')) {
    $topbar_marquee = $this->db
        ->where('block_status', 0)
        ->where('marquee_text !=', '')
        ->order_by('id', 'ASC')
        ->get('marquee_tbl')
        ->row();
}
?>
<div id="pgs-toast-container" aria-live="polite"></div>
<style>
    #pgs-toast-container {
        position: fixed;
        top: 16px;
        right: 16px;
        z-index: 99999;
        display: flex;
        flex-direction: column;
        gap: 8px;
        pointer-events: none;
    }

    .pgs-toast {
        pointer-events: auto;
        padding: 12px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        font-size: 14px;
        max-width: 320px;
        animation: pgs-toast-in 0.25s ease;
    }

    .pgs-toast-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .pgs-toast-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    @keyframes pgs-toast-in {
        from {
            opacity: 0;
            transform: translateX(100%);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>
<style>
    .dropdown-wrapper {
        position: relative;
        display: inline-block;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        background: #FFDE7F;
        border-radius: 10px;
        border: 0.5px solid #e0d200;
        min-width: 170px;
        z-index: 100;
        padding: 6px 0;
    }

    .dropdown-menu.open {
        display: block;
    }

    .dropdown-menu a {
        display: block;
        padding: 0px 20px;
        font-size: 13.5px;
        font-weight: 500;
        color: #000000d6;
        text-align: center;
        text-decoration: none;
    }

    .pp-mobile-link {
        display: block;
        padding: 2px 20px;
        font-size: 13px;
        font-weight: 500;
        color: black;
        text-align: center;
        text-decoration: none;
    }

    .pp-mobile-link:hover {
        background: #FFF176;
        color: #3a3700;
    }

    .dropdown-menu a:hover {
        background: #FFF176;
    }

    .explore-wrapper {
        position: relative;
        display: inline-block;
    }

    .explore-dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 6px);
        left: 50%;
        transform: translateX(-50%);
        background: #ffffff;
        border-radius: 6px;
        border: 1px solid #d5d5d5;
        min-width: 150px;
        z-index: 100;
        padding: 5px 0;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.10);
    }

    .explore-dropdown-menu.open {
        display: block;
    }

    .explore-dropdown-menu a {
        display: block;
        padding: 4px 18px;
        font-size: 13px;
        font-weight: 600;
        color: #212529;
        text-align: center;
        text-decoration: none;
        line-height: 20px;
    }

    .explore-dropdown-menu a:hover {
        background: #f3f3f3;
        color: #000;
    }

    .header-notification-wrapper {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: auto;
        height: auto;
        margin: 0 4px;
        padding: 0;
        background: transparent;
        border: 0;
        text-decoration: none;
        color: #111;
        line-height: 1;
        vertical-align: middle;
    }

    .header-notification-wrapper:hover {
        color: #111;
        text-decoration: none;
    }

    .header-notification-wrapper i {
        font-size: 23px;
        line-height: 1;
        display: block;
    }

    .header-notification-badge {
        position: absolute;
        top: -7px;
        right: -9px;
        min-width: 16px;
        height: 16px;
        padding: 0 4px;
        border-radius: 999px;
        background: #e60023;
        color: #fff;
        font-size: 10px;
        line-height: 16px;
        font-weight: 700;
        text-align: center;
        border: 1px solid #fff;
    }

    .header-notification-badge.is-empty {
        display: none;
    }
    .site-notification-dropdown {
        position: relative;
        display: inline-flex;
        align-items: center;
    }

    .site-notification-menu {
    display: none;
    position: absolute;
    right: 0;
    top: 55px;
    width: 580px;
    max-height: 500px;
    overflow-y: auto;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 8px 30px rgb(0 0 0 / 10%);
    border: 1px solid #e8e8e8;
    z-index: 9999;
    }

    .site-notification-menu.open {
        display: block;
    }

    .site-notification-menu.mobile-menu {
        top: calc(100% + 10px);
        right: -58px;
    }

    .site-notification-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 12px 14px;
        border-bottom: 1px solid #eeeeee;
        font-size: 18px;
        font-weight: 600;
        color: #111111;
    }

    .site-notification-clear {
        color: #e60023;
        font-size: 16px;
        font-weight: 400;
        line-height: 14px;
        text-decoration: none;
        white-space: nowrap;
    }

    .site-notification-clear:hover {
        color: #b0001b;
        text-decoration: none;
    }

    .site-notification-empty {
        padding: 18px 14px;
        color: #666666;
        font-size: 13px;
        line-height: 18px;
    }

    .site-notification-item {
        position: relative;
        display: block;
        border-bottom: 1px solid #f0f0f0;
        background: #ffffff;
    }

    .site-notification-item:hover {
        background: #dad6d642;
    }

    .site-notification-item.is-unread {
        background: #fff9df;
    }

    .site-notification-link {
        display: block;
            padding: 3px 20px 10px 9px;
        color: #111111;
        text-decoration: none;
    }

    .site-notification-link:hover {
        color: #111111;
        text-decoration: none;
    }

    .site-notification-delete {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        color: #777777;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 800;
        line-height: 20px;
        text-decoration: none;
    }

    .site-notification-delete:hover {
        background: #eeeeee;
        color: #e60023;
        text-decoration: none;
    }

    .site-notification-title {
        display: block;
        font-size: 14px;
        font-weight: 600;
        line-height: 17px;
        margin-bottom: 4px;
    }

    .site-notification-message {
        display: block;
        font-size: 12px;
        color: #3b3b3b;
        line-height: 16px;
    }

    .site-notification-time {
        display: block;
        margin-top: 5px;
        font-size: 11px;
        color: #777777;
        line-height: 14px;
    }

    .mobile-notification-wrapper {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .mobile-notification-wrapper i {
        font-size: 22px;
        line-height: 1;
        color: #111;
    }

    .mobile-notification-wrapper .header-notification-badge {
        top: -6px;
        right: -6px;
    }

    .topbar-content {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        max-width: calc(100% - 24px);
    }

    .topbar a {
        color: inherit;
        text-decoration: none;
    }

    .topbar img {
        flex: 0 0 auto;
        width: 30px;
        height: 30px;
        object-fit: contain;
    }

    @media (max-width: 767px) {
        .topbar {
            min-height: 48px;
            padding: 0 10px;
        }

        .topbar h5 {
            font-size: 12px;
            line-height: 16px;
        }
    }
	/* Notification Bell */
.header-notification-wrapper,
.mobile-notification-wrapper{
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width:42px;
    height:42px;
    border-radius:50%;
    background:#fff;
    transition:.25s;
    cursor:pointer;
}

.header-notification-wrapper:hover,
.mobile-notification-wrapper:hover{
    background:#f2f2f2;
}

.header-notification-wrapper i,
.mobile-notification-wrapper i{
    font-size:22px;
    color:#111;
}

/* Badge */
.header-notification-badge{
    position:absolute;
    top:2px;
    right:2px;
    min-width:18px;
    height:18px;
    border-radius:50px;
    background:#cc0000;
    color:#fff;
    font-size:10px;
    font-weight:700;
    display:flex;
    align-items:center;
    justify-content:center;
    border:2px solid #fff;
    padding:0 4px;
    line-height:1;
}

.header-notification-badge.is-empty{
    display:none;
}

/* Dropdown */
.site-notification-menu{
    display:none;
    position:absolute;
    right:0;
    top:55px;
    width:580px;
    max-height:500px;
    overflow-y:auto;
    background:#fff;
    border-radius:14px;
    box-shadow:0 8px 30px rgba(0,0,0,.18);
    border:1px solid #e8e8e8;
    z-index:9999;
}

.site-notification-menu.open{
    display:block;
}

.site-notification-heading{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 18px;
    border-bottom: 1px solid #eee;
    font-size: 19px;
    font-weight: 400;
    background: #fff;
    position: sticky;
    top: 0;
    z-index: 5;
    letter-spacing: 0.2px;
}

/* Notification Item */
.site-notification-item{
    position:relative;
    display:flex;
    align-items:flex-start;
    padding:14px 16px;
    transition:.2s;
    border-bottom:0px solid #f4f4f4;
    background:#fff;
}

.site-notification-item:hover{
    background:#f9f9f9;
}

.site-notification-item.is-unread{
    background:#e8f0fe;
}

/* Avatar */
.site-notification-item::before{
    content: "\f18a";
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: #ececec;
    flex-shrink: 0;
    margin-right: 3px;
    font-size: 20px;
    align-items: center;
    justify-content: center;
    display: flex;
}

/* Link */
.site-notification-link{
    flex:1;
    text-decoration:none;
    color:#111;
    padding-right:30px;
}

.site-notification-link:hover{
    text-decoration:none;
    color:#111;
}

/* Names the dashboard section an update came from, above the title. */
.site-notification-section{
    display: inline-block;
    margin-bottom: 4px;
    padding: 2px 8px;
    border-radius: 10px;
    background: #f1ecff;
    color: #5b3fd1;
    font-size: 11px;
    font-weight: 700;
    line-height: 15px;
    letter-spacing: .3px;
    text-align: start;
    text-transform: uppercase;
}

.site-notification-title{
    display: block;
    font-size: 18px;
    font-weight: 400;
    margin-bottom: 0px;
    text-align: start;
}

.site-notification-message{
display: block;
    font-size: 16px;
    color: #555;
    line-height: 20px;
    text-align: start;
    margin-top: 4px;
}

.site-notification-time{
    display:block;
    margin-top:6px;
    font-size:12px;
    color:#888;
}

/* Delete Button */
.site-notification-delete{
position: absolute;
    right: 14px;
    top: 16px;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: #666;
    font-size: 23px;
    text-decoration: none;
    font-weight: 400;
    transition: .2s;
}

.site-notification-delete:hover{
    background:#f1f1f1;
    color:#d93025;
}

/* Scrollbar */
.site-notification-menu::-webkit-scrollbar{
    width:6px;
}

.site-notification-menu::-webkit-scrollbar-thumb{
    background:#cfcfcf;
    border-radius:10px;
}
		@media (max-width: 767px) {
		.site-notification-dropdown {
    position: static;
		}
		.site-notification-menu.mobile-menu {
			top: calc(100% + 0px);
			right: 0;
			width: 96%;
			left: 0;
			margin: auto;
		}
	}
</style>
<script>
    (function() {
        <?php if ($this->session->flashdata('error')) { ?>
            var msg = <?php echo json_encode($this->session->flashdata('error')); ?>;
            var c = document.getElementById('pgs-toast-container');
            if (c) {
                var t = document.createElement('div');
                t.className = 'pgs-toast pgs-toast-error';
                t.textContent = msg;
                c.appendChild(t);
                setTimeout(function() {
                    t.remove();
                }, 5000);
            }
        <?php } ?>
        <?php if ($this->session->flashdata('success')) { ?>
            var msg = <?php echo json_encode($this->session->flashdata('success')); ?>;
            var c = document.getElementById('pgs-toast-container');
            if (c) {
                var t = document.createElement('div');
                t.className = 'pgs-toast pgs-toast-success';
                t.textContent = msg;
                c.appendChild(t);
                setTimeout(function() {
                    t.remove();
                }, 5000);
            }
        <?php } ?>
    })();
</script>

<script>
    function togglePP() {
        document.getElementById('ppDropdown').classList.toggle('open');
    }

    function toggleExploreCountries() {
        document.getElementById('exploreCountriesDropdown').classList.toggle('open');
    }

    function toggleNotifications(menuId, event) {
        if (event) {
            event.stopPropagation();
        }
        var menu = document.getElementById(menuId);
        if (!menu) return;
        document.querySelectorAll('.site-notification-menu.open').forEach(function(openMenu) {
            if (openMenu !== menu) openMenu.classList.remove('open');
        });
        menu.classList.toggle('open');
    }
    document.addEventListener('click', function(e) {
        var ppWrapper = document.getElementById('ppWrapper');
        var ppDropdown = document.getElementById('ppDropdown');
        var exploreWrapper = document.getElementById('exploreCountriesWrapper');
        var exploreDropdown = document.getElementById('exploreCountriesDropdown');

        if (ppWrapper && ppDropdown && !ppWrapper.contains(e.target)) {
            ppDropdown.classList.remove('open');
        }

        if (exploreWrapper && exploreDropdown && !exploreWrapper.contains(e.target)) {
            exploreDropdown.classList.remove('open');
        }

        document.querySelectorAll('.site-notification-dropdown').forEach(function(wrapper) {
            if (!wrapper.contains(e.target)) {
                var menu = wrapper.querySelector('.site-notification-menu');
                if (menu) menu.classList.remove('open');
            }
        });
    });
</script>

<header>
    <!--start navigation -->
    <?php if (!empty($topbar_marquee) && !empty($topbar_marquee->marquee_text)) { ?>
    <div class="topbar">
        <div class="topbar-content"
            data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
            <img src="<?= base_url('assets/img/watch.png') ?>" alt="">
            <h5>
                <?php if (!empty($topbar_marquee->marquee_link)) { ?>
                    <a href="<?= htmlspecialchars($topbar_marquee->marquee_link, ENT_QUOTES, 'UTF-8') ?>">
                        <?= htmlspecialchars($topbar_marquee->marquee_text, ENT_QUOTES, 'UTF-8') ?>
                    </a>
                <?php } else { ?>
                    <?= htmlspecialchars($topbar_marquee->marquee_text, ENT_QUOTES, 'UTF-8') ?>
                <?php } ?>
            </h5>
        </div>
    </div>
    <?php } ?>

    <div class="mobile-none">
        <nav class="navbar navbar-expand-lg header-light header-transparent bg-transparent disable-fixed">
            <div class="container-fluid">
                <div class="col-lg-8 align-items-center">
                    <div class="me-lg-0 me-auto">
                        <a class="navbar-brand" href="<?= base_url('/') ?>">
                            <img src="<?= base_url('assets/img/logo.png') ?>" data-at2x="<?= base_url('assets/img/logo.png') ?>" alt="" class="default-logo">
                            <img src="<?= base_url('assets/img/logo.png') ?>" data-at2x="<?= base_url('assets/img/logo.png') ?>" alt="" class="alt-logo">
                            <img src="<?= base_url('assets/img/logo.png') ?>" data-at2x="<?= base_url('assets/img/logo.png') ?>" alt="" class="mobile-logo">
                        </a>
                    </div>

                    <div class="col-auto menu-order position-static">
                        <ul class="header-tab-top">
                            <li>
                                <?php if ($this->session->userdata('logged_in')): ?>
                                    <?php
                                    $segment1 = strtolower($this->uri->segment(1) ?? '');
                                    $segment2 = strtolower($this->uri->segment(2) ?? '');
                                    ?>

                                    <a href="<?= base_url('Home/user_dashboard') ?>" style="padding: 2px 5px;"
                                       class="tab-button text-black <?= ($segment1 == 'home' && in_array($segment2, ['user_dashboard', 'defaultdashboard'])) ? 'active-tab' : '' ?>">
                                       #feed
                                    </a>
                                <?php else: ?>
                                    <?php
                                    $segment1 = strtolower($this->uri->segment(1) ?? '');
                                    $segment2 = strtolower($this->uri->segment(2) ?? '');
                                    ?>

                                    <a href="<?= base_url('Home/defaultdashboard') ?>" style="padding: 2px 5px;"
                                       class="tab-button text-black <?= ($segment1 == 'home' && in_array($segment2, ['defaultdashboard', 'defaultdashboard'])) ? 'active-tab' : '' ?>">
                                       #feed
                                    </a>
                                <?php endif; ?>
                            </li>

                            <li class="dropdown-wrapper" id="ppWrapper">
                                <a href="javascript:void(0)" onclick="togglePP()"
                                    class="tab-button text-black <?= ($current == 'purplepremiumhome') ? 'active-tab' : '' ?>"
                                    style="padding: 4px;">
                                    #purplePremium
                                </a>

                                <div class="dropdown-menu" id="ppDropdown">
                                    <a href="<?= base_url('home/purplepremium_overview') ?>">OVERVIEW</a>
                                    <a href="<?= base_url('Purplenonmedical') ?>">STEM</a>
                                    <a href="<?= base_url('Purplenonmedical') ?>">MBA</a>
                                    <a href="<?= base_url('purpleusme') ?>">USMLE</a>
                                    <a href="<?= base_url('Purpleplab') ?>">PLAB</a>
                                    <a href="<?= base_url('purpleamc') ?>">AMC</a>
                                    <a href="<?= base_url('Purplenonmedical') ?>">OTHER PATHS</a>
                                </div>
                            </li>

                            <li>
                                <a href="<?= base_url('cvreadyprogram') ?>"
                                    class="tab-button text-black <?= ($current == 'cvreadyprogram') ? 'active-tab' : '' ?>"
                                    style="padding: 4px;">#cvReadyPrograms</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-auto col-lg-4 text-end flex-grid"
                    data-anime='{ "translateZ": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <a href="<?= base_url('Usmlerotation') ?>" class="btn btn-trapsparent text-decoration-none">#USMLERotation</a>

                    <div class="explore-wrapper" id="exploreCountriesWrapper">
                        <a href="javascript:void(0)" onclick="toggleExploreCountries()" class="btn btn-trapsparent text-decoration-none <?= ($current == 'explorecountries') ? 'active-tab' : '' ?>">#exploreCountries</a>

                        <div class="explore-dropdown-menu" id="exploreCountriesDropdown">
                            <a href="<?= base_url('countriesusa') ?>">USA</a>
                            <a href="<?= base_url('countriesuk') ?>">UK</a>
                            <a href="<?= base_url('countriesaus') ?>">AUSTRALIA</a>
                            <a href="<?= base_url('countriesgermany') ?>">GERMANY</a>
                            <a href="<?= base_url('explorecountries') ?>">FULL COUNTRY LIST</a>
                        </div>
                    </div>

                    <div class="site-notification-dropdown">
                        <a href="javascript:void(0)" onclick="toggleNotifications('siteNotificationMenuDesktop', event)" class="header-notification-wrapper" aria-label="Notifications" title="Notifications">
                            <i class="bi bi-bell"></i>
                            <span class="header-notification-badge <?= ((int)$notification_count > 0) ? '' : 'is-empty' ?>">
                                <?= ((int)$notification_count > 99) ? '99+' : (int)$notification_count ?>
                            </span>
                        </a>
                        <div class="site-notification-menu" id="siteNotificationMenuDesktop">
                            <div class="site-notification-heading">
                                <span>Notifications</span>
                                <?php if (!empty($header_notifications)): ?>
                                    <a href="<?= base_url('Notifications/clear_all') ?>" class="site-notification-clear">Clear all</a>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($header_notifications)): ?>
                                <?php foreach ($header_notifications as $notification): ?>
                                    <div class="site-notification-item bi bi-bell <?= ((int) $notification->is_read === 0) ? 'is-unread' : '' ?>">
                                        <a href="<?= base_url('Notifications/open/' . (int) $notification->id) ?>" class="site-notification-link">
                                            <?php $notification_section = function_exists('notification_section_label') ? notification_section_label($notification) : ''; ?>
                                            <?php if ($notification_section !== ''): ?>
                                                <span class="site-notification-section"><?= htmlspecialchars($notification_section, ENT_QUOTES, 'UTF-8') ?></span>
                                            <?php endif; ?>
                                            <span class="site-notification-title"><?= htmlspecialchars($notification->title, ENT_QUOTES, 'UTF-8') ?></span>
                                            <span class="site-notification-message"><?= htmlspecialchars($notification->message, ENT_QUOTES, 'UTF-8') ?></span>
                                           <!-- <?php if (!empty($notification->created_at)): ?>
                                                <span class="site-notification-time"><?= date('M j, g:i A', strtotime($notification->created_at)) ?></span>
                                            <?php endif; ?> -->
                                        </a>
                                        <a href="<?= base_url('Notifications/delete/' . (int) $notification->id) ?>" class="site-notification-delete" title="Delete notification" aria-label="Delete notification">&times;</a>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="site-notification-empty">No notifications yet.</div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ($this->session->userdata('logged_in')): ?>
                        <a href="<?= base_url('Login/logout') ?>" class="btn btn-login">Logout</a>
                    <?php else: ?>
                        <a href="<?= base_url('Login') ?>" class="btn btn-login">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>

    <div class="mobile-block mobile-header">
        <div class="d-flex d-flex d-flex-space justify-content-space">
            <div>
                <a href="<?= base_url('/') ?>">
                    <img src="<?= base_url('assets/img/white-logo.png') ?>">
                </a>
            </div>

            <div class="d-flex d-flex d-flex-space justify-content-space">
                <!--<button type="button" class="btn-search-mobile">-->
                <!--    <span><i class="bi bi-search"></i></span>-->
                <!--</button>-->

                <div class="site-notification-dropdown">
                    <button type="button" class="btn-toggle-mobile mobile-notification-wrapper" onclick="toggleNotifications('siteNotificationMenuMobile', event)" aria-label="Notifications" title="Notifications">
                        <i class="bi bi-bell"></i>
                        <span class="header-notification-badge <?= ((int)$notification_count > 0) ? '' : 'is-empty' ?>">
                            <?= ((int)$notification_count > 99) ? '99+' : (int)$notification_count ?>
                        </span>
                    </button>
                    <div class="site-notification-menu mobile-menu" id="siteNotificationMenuMobile">
                        <div class="site-notification-heading">
                                <span>Notifications</span>
                                <?php if (!empty($header_notifications)): ?>
                                    <a href="<?= base_url('Notifications/clear_all') ?>" class="site-notification-clear">Clear all</a>
                                <?php endif; ?>
                            </div>
                        <?php if (!empty($header_notifications)): ?>
                            <?php foreach ($header_notifications as $notification): ?>
                                <div class="site-notification-item <?= ((int) $notification->is_read === 0) ? 'is-unread' : '' ?>">
                                        <a href="<?= base_url('Notifications/open/' . (int) $notification->id) ?>" class="site-notification-link">
                                            <?php $notification_section = function_exists('notification_section_label') ? notification_section_label($notification) : ''; ?>
                                            <?php if ($notification_section !== ''): ?>
                                                <span class="site-notification-section"><?= htmlspecialchars($notification_section, ENT_QUOTES, 'UTF-8') ?></span>
                                            <?php endif; ?>
                                            <span class="site-notification-title"><?= htmlspecialchars($notification->title, ENT_QUOTES, 'UTF-8') ?></span>
                                            <span class="site-notification-message"><?= htmlspecialchars($notification->message, ENT_QUOTES, 'UTF-8') ?></span>
                                            <?php if (!empty($notification->created_at)): ?>
                                                <span class="site-notification-time"><?= date('M j, g:i A', strtotime($notification->created_at)) ?></span>
                                            <?php endif; ?>
                                        </a>
                                        <a href="<?= base_url('Notifications/delete/' . (int) $notification->id) ?>" class="site-notification-delete" title="Delete notification" aria-label="Delete notification">&times;</a>
                                    </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="site-notification-empty">No notifications yet.</div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($this->session->userdata('logged_in')): ?>
                    <a href="<?= base_url('/Login/logout') ?>" class="btn btn-login">Logout</a>
                <?php else: ?>
                    <a href="<?= base_url('/Login') ?>" class="btn btn-login">Login</a>
                <?php endif; ?>

                <button type="button" class="btn-toggle-mobile" onclick="openDrawer()">
                    <img src="<?= base_url('assets/img/toggle-lines.png') ?>">
                </button>
            </div>
        </div>
    </div>

    <!-- end navigation -->
</header>