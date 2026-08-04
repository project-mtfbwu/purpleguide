   <?php $current = strtolower($this->uri->segment(1) ?? ''); ?>

<style>
    .pgs-login-popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.35);
        z-index: 999999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 18px;
    }

    .pgs-login-popup-overlay.show {
        display: flex;
    }

    .pgs-login-popup-box {
        width: 100%;
        max-width: 340px;
        background: #ffffff;
        border-radius: 18px;
        padding: 24px 22px 20px;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.22);
        text-align: center;
        position: relative;
        animation: pgsLoginPopupIn 0.2s ease-out;
    }

    .pgs-login-popup-close {
        position: absolute;
        top: 10px;
        right: 12px;
        border: 0;
        background: transparent;
        font-size: 24px;
        line-height: 1;
        color: #444;
        cursor: pointer;
        padding: 0;
    }

    .pgs-login-popup-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin: 0 auto 12px;
        background: #FFDE7F;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #111;
        font-size: 24px;
    }

    .pgs-login-popup-box h4 {
        margin: 0 0 8px;
        font-size: 20px;
        font-weight: 700;
        color: #111;
    }

    .pgs-login-popup-box p {
        margin: 0 0 18px;
        font-size: 14px;
        line-height: 1.5;
        color: #555;
    }

    .pgs-login-popup-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 125px;
        height: 42px;
        border-radius: 12px;
        background: #111;
        color: #ffffff !important;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        padding: 0 18px;
    }

    .pgs-login-popup-btn:hover {
        color: #ffffff !important;
        text-decoration: none;
    }

    @keyframes pgsLoginPopupIn {
        from {
            opacity: 0;
            transform: translateY(12px) scale(0.98);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    #close_Btn {
        transition: transform 0.2s ease;
        cursor: pointer;
    }

    .arrow-box.sidebar-box.active #close_Btn {
        transform: rotate(180deg);
    }
</style>

   
     <div class="overlay" id="overlay" onclick="closeDrawer()"></div>

<div class="pgs-login-popup-overlay" id="pgsLoginPopup" onclick="closeLoginRequiredPopup(event)">
    <div class="pgs-login-popup-box" role="dialog" aria-modal="true" aria-labelledby="pgsLoginPopupTitle">
        <button type="button" class="pgs-login-popup-close" onclick="closeLoginRequiredPopup(event)" aria-label="Close">&times;</button>
        <div class="pgs-login-popup-icon">
            <i class="bi bi-lock-fill"></i>
        </div>
        <h4 id="pgsLoginPopupTitle">Login Required</h4>
        <p>Please login to access this option.</p>
        <a href="<?= base_url('Login') ?>" class="pgs-login-popup-btn">Login Now</a>
    </div>
</div>

     
    <section class="pt-1 pb-0 mobile-frame-sidebar">
        <div class="container-fluid px-4">
             <div class="arrow-box sidebar-box" id="sidebar">
                        <div class="d-flex justify-content-space align-items-start">
                            <h5 class="pt-13 text-black fs-48 fnt-family text-start">
                                Welcome <br />
                                <?php 
                                // Get user name from session or database
                                $user_name = $this->session->userdata('name');
                                if(empty($user_name)) {
                                    $user_id = $this->session->userdata('user_id');
                                    if($user_id) {
                                        $this->load->database();
                                        $user_data = $this->db->where('id', $user_id)->get('users')->row();
                                        $user_name = isset($user_data->name) && !empty($user_data->name) ? $user_data->name : 'User';
                                    } else {
                                        $user_name = 'User';
                                    }
                                }
                                echo htmlspecialchars($user_name);
                                ?>
                            </h5>
                            <img src="<?= base_url('assets/img/sidebar-arrow.png')?>" id="close_Btn" class="flot-arrow-sidebar" />
                            <!--<i class="bi bi-arrow-right-square-fill" id="close_Btn"></i>-->
                        </div>
                        
                        <?php if($this->session->userdata('logged_in')): ?>
                        <ul class="ml-0">
                            <li>
                                <a href="<?= base_url('studentresources')?>">
                                    <span class="fit-icon-sidebar"><img src="<?= base_url('assets/img/loading-icon.png')?>" /></span>
                                    #datesDeadlines
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('Feed_track_progress')?>">
                                    <span class="fit-icon-sidebar"><img src="<?= base_url('assets/img/loading-icon.png')?>" /></span>
                                    Track Your Progress
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('purpleboard')?>">
                                    <span class="fit-icon-sidebar"><img src="<?= base_url('assets/img/loading-icon.png')?>" /></span>
                                    #purpleboard
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('upload_your_doc')?>">
                                    <span class="fit-icon-sidebar"><img src="<?= base_url('assets/img/upload-icon.png')?>" /></span>
                                    Upload Your Docs
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('finance')?>">
                                    <span class="fit-icon-sidebar"><img src="<?= base_url('assets/img/finance-icon.png')?>" /></span>
                                    #purpleFinance Hub
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('scholarship')?>">
                                    <span class="fit-icon-sidebar"><img src="<?= base_url('assets/img/scholar-icon.png')?>" /></span>
                                    #purpleScholarship Hub
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('cvreadyprogram')?>">
                                    <span class="fit-icon-sidebar"><img src="<?= base_url('assets/img/cvready-icon.png')?>" /></span>
                                    CV-Ready Programs
                                </a>
                            </li>
                        </ul>
                        
                         <?php else: ?>
                         <ul class="ml-0">
                            <li>
                                <a href="<?= base_url('studentresources')?>">
                                    <span class="fit-icon-sidebar"><img src="<?= base_url('assets/img/loading-icon.png')?>" /></span>
                                    #datesDeadlines
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('Feed_track_progress')?>">
                                    <span class="fit-icon-sidebar"><img src="<?= base_url('assets/img/loading-icon.png')?>" /></span>
                                    Track Your Progress
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" onclick="showLoginRequiredPopup(event)">
                                    <span class="fit-icon-sidebar"><img src="<?= base_url('assets/img/loading-icon.png')?>" /></span>
                                    #purpleboard
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('upload_your_doc')?>">
                                    <span class="fit-icon-sidebar"><img src="<?= base_url('assets/img/upload-icon.png')?>" /></span>
                                    Upload Your Docs
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('finance')?>">
                                    <span class="fit-icon-sidebar"><img src="<?= base_url('assets/img/finance-icon.png')?>" /></span>
                                    #purpleFinance Hub
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('scholarship')?>">
                                    <span class="fit-icon-sidebar"><img src="<?= base_url('assets/img/scholar-icon.png')?>" /></span>
                                    #purpleScholarship Hub
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('cvreadyprogram')?>">
                                    <span class="fit-icon-sidebar"><img src="<?= base_url('assets/img/cvready-icon.png')?>" /></span>
                                    CV-Ready Programs
                                </a>
                            </li>
                        </ul>
                          <?php endif; ?>
                          
				    
                       
                        <div class="d-flex justify-content-space mt-30">
                             <?php if($this->session->userdata('logged_in')): ?>
                            <a href="<?= base_url('Home/user_profile') ?>" class="text-black fs-20">
                                <img src="<?= base_url('assets/img/profile-icon.png')?>" class="d-block mb-10">
                                Profile
                            </a>
                            <?php else: ?>
                            <a href="javascript:void(0)" onclick="showLoginRequiredPopup(event)" class="text-black fs-20">
                                <img src="<?= base_url('assets/img/profile-icon.png')?>" class="d-block mb-10">
                                Profile
                            </a>
                            <?php endif; ?>
                            
                             <?php if($this->session->userdata('logged_in')): ?>
                            <a href="<?= base_url('saved')?>" class="text-black fs-20">
                                <img src="<?= base_url('assets/img/heart-icon.png')?>" class="d-block mb-10">
                                Saved List
                            </a>
                            <?php else: ?>
                             <a href="javascript:void(0)" onclick="showLoginRequiredPopup(event)" class="text-black fs-20">
                                <img src="<?= base_url('assets/img/heart-icon.png')?>" class="d-block mb-10">
                                Saved List
                            </a>
                            <?php endif; ?>
                            
                            <?php if($this->session->userdata('logged_in')): ?>
                            <a href="<?= base_url('Login/logout')?>" class="text-black fs-20">
                                <img src="<?= base_url('assets/img/logout.png')?>" class="d-block">
                                Logout
                            </a>
                            <?php else: ?>
                            <a href="<?= base_url('Login')?>" class="text-black fs-20">
                                <img src="<?= base_url('assets/img/logout.png')?>" class="d-block">
                                Login
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>



            <div class="row g-4" style="align-items: flex-start; justify-content: space-evenly;">
                <div class="col-xl-1 col-lg-1">
                    <div class="arrow-box" id="toggleBtn">

                        <i class="bi bi-arrow-right-square-fill"></i>
                    </div>
                </div>
                
                <div class="avatar-box w-12">
                        <div class="avatar-img">
                            <?php 
                            $user_id = $this->session->userdata('user_id');
                            $user_avatar = '';
                            if($user_id) {
                                $this->load->database();
                                $user_data = $this->db->where('id', $user_id)->get('users')->row();
                                if(isset($user_data->image1) && !empty($user_data->image1)) {
                                    $user_avatar = base_url('assets/images/'.$user_data->image1);
                                }
                            }
                            // Use gender-neutral avatar icon if no user image
                            if(!empty($user_avatar)) {
                                $avatar_src = $user_avatar;
                            } else {
                                $avatar_src = base_url('assets/img/default-avatar.png');
                            }
                            ?>
                            <img src="<?= $avatar_src ?>" alt="Avatar" data-no-retina="" 
                                 onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\'%3E%3Ccircle cx=\'50\' cy=\'50\' r=\'45\' fill=\'%23e0e0e0\'/%3E%3Ccircle cx=\'50\' cy=\'35\' r=\'12\' fill=\'%23999\'/%3E%3Cpath d=\'M 20 75 Q 20 60 50 60 Q 80 60 80 75 L 80 85 Q 80 90 75 90 L 25 90 Q 20 90 20 85 Z\' fill=\'%23999\'/%3E%3C/svg%3E';">
                        </div>
                        <div class="avatar-info">
                            <h5 class="mb-0">Hello <span>👋</span></h5>
                            <h4 class="mb-0">
                                <?php 
                                // Get user name from session or database
                                $user_name = $this->session->userdata('name');
                                if(empty($user_name)) {
                                    $user_id = $this->session->userdata('user_id');
                                    if($user_id) {
                                        $this->load->database();
                                        $user_data = $this->db->where('id', $user_id)->get('users')->row();
                                        $user_name = isset($user_data->name) && !empty($user_data->name) ? $user_data->name : 'Aspirant';
                                    } else {
                                        $user_name = 'Aspirant';
                                    }
                                }
                                echo htmlspecialchars($user_name);
                                ?>
                            </h4>
                        </div>
                    </div>
                 
		         <!--show the only studentResource Page-->
				 <div class="col-xl-5 mt-0 col-lg-5 d-flex align-items-center mobile-tags-scrolling">
					<?php if (strpos($_SERVER['REQUEST_URI'], '/studentresources') !== false) { ?>
                    <div class="horizontel-tabs">
                        <div class="scroll-arrow left" id="leftArrow">
                            <img src="./assets/img/arrow-left.png" alt="Left" />
                        </div>
                        <ul class="p-0 m-0" id="tabList">
                            <li>Deadlines & Updates</li>
                            <li>Key facts to explore</li>
                            <li>Key facts to explore</li>
                            <li>#PurpleEvents</li>
                            <li>Progress Stats</li>
                            <li>Progress Stats</li>
                            <li>Progress Stats</li>
                            <li>Progress Stats</li>
                        </ul>
                        <div class="scroll-arrow right" id="rightArrow">
                            <img src="./assets/img/arrow-left.png" alt="Right" />
                        </div>
                    </div>
					<?php } ?>
                </div>

                    <!--<div class="horizontel-tabs">-->
                    <!--    <div class="scroll-arrow left" id="leftArrow">-->
                    <!--        <img src="./assets/img/arrow-left.png" alt="Left" />-->
                    <!--    </div>-->
                    <!--    <ul class="p-0 m-0" id="tabList">-->
                    <!--        <li>Deadlines & Updates</li>-->
                    <!--        <li>Key facts to explore</li>-->
                    <!--        <li>Key facts to explore</li>-->
                    <!--        <li>#PurpleEvents</li>-->
                    <!--        <li>Progress Stats</li>-->
                    <!--        <li>Progress Stats</li>-->
                    <!--        <li>Progress Stats</li>-->
                    <!--        <li>Progress Stats</li>-->
                    <!--    </ul>-->
                    <!--    <div class="scroll-arrow right" id="rightArrow">-->
                    <!--        <img src="./assets/img/arrow-left.png" alt="Right" />-->
                    <!--    </div>-->
                    <!--</div>-->
                <div class="col-xl-4 justify-content-end col-lg-4 d-flex gap-7 mobile-none" style="width: 37%;">
                        <div class="d-flex align-items-start gap-3">
                        <?php
                        // Lazy-load current univMeet config when sidebar is rendered
                        if (!isset($univmeet)) {
                            $CI =& get_instance();
                            $CI->load->model('Univmeet_model');
                            $univmeet = $CI->Univmeet_model->get_current();
                        }
                        $univmeet_url = !empty($univmeet['course_id'])
                            ? base_url('Programsfull/program/' . (int) $univmeet['course_id'])
                            : base_url('Programsfull');
                        ?>
                        <a href="<?= $univmeet_url ?>" class="date-box" style="text-decoration:none;cursor:pointer;display:flex;align-items:center;gap:8px;background:#f0f4ff;border-radius:10px;padding:8px 12px;">
                            <h5 style="white-space:nowrap;">#univMeet</h5>
                            <div class="box-date-info" style="display:flex;flex-direction:column;align-items:center;background:#ddeeff;border-radius:8px;padding:6px 12px;min-width:54px;">
                                <span class="date" style="font-size:26px;     margin-bottom: -5px;font-weight:700;color:#d0021b;line-height:1;white-space:nowrap;display:block;">
                                    <?= isset($univmeet['slot1_date']) ? html_escape($univmeet['slot1_date']) : '31' ?>
                                </span>
                                <span class="month" style="white-space:nowrap;">
                                    <?= isset($univmeet['slot1_month']) ? html_escape($univmeet['slot1_month']) : 'Dec 25' ?>
                                </span>
                            </div>
                            <div class="box-date-info" style="display:flex;flex-direction:column;align-items:center;background:#ddeeff;border-radius:8px;padding:6px 12px;min-width:54px;">
                                <span class="date" style="font-size:26px;     margin-bottom: -5px; font-weight:700;color:#d0021b;line-height:1;white-space:nowrap;display:block;">
                                    <?= isset($univmeet['slot2_date']) ? html_escape($univmeet['slot2_date']) : '31' ?>
                                </span>
                                <span class="month" style="white-space:nowrap;">
                                    <?= isset($univmeet['slot2_month']) ? html_escape($univmeet['slot2_month']) : 'Dec 25' ?>
                                </span>
                            </div>
                        </a>
                        <div class="search-box">
                            <div class="input-group">
                                <span><i class="bi bi-search"></i></span>
                                <input
                                    type="search"
                                    class="search-control"
                                    placeholder="Search programs & eventsâ€¦"
                                    data-autocomplete-endpoint="<?= base_url('Search/autocomplete') ?>">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

       </div>
    </section>
    
    
    
      <!-- Drawer -->
          <div class="drawer" id="drawer">
           <div class="d-flex d-flex d-flex-space justify-content-space">
            <div>
                <a href="https://purpleguide.study/">
                   <img src="https://purpleguide.study/assets/img/white-logo.png" data-no-retina="" style="width: 120px;">
                </a>
            </div>
            <div class="d-flex d-flex d-flex-space justify-content-space">
                <!--<button type="button" class="btn-search-mobile">-->
                <!--    <span><i class="bi bi-search"></i></span>-->
                <!--</button>-->
               <button type="button" class="btn-toggle-mobile text-end" onclick="closeDrawer()" style="width : 84px">
               <img src="https://cdn.vectorstock.com/i/500p/77/41/close-button-with-rounded-squares-vector-4527741.jpg" 
               style="width: 35px; margin-bottom: 10px;" />
                </button>
            </div>
        </div>

           <ul class="header-tab-top d-block">
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

    <!-- #purplePremium with dropdown -->
    <li class="mb-2" id="mobilePpWrapper">
        <a href="javascript:void(0)" 
           class="tab-button text-black <?= ($current == 'purplepremiumhome') ? 'active-tab' : '' ?>" 
           style="padding: 4px; display:inline-flex; align-items:center; gap:4px;"
           onclick="toggleMobilePP()">
            #purplePremium
            <span id="mobilePpArrow" style="font-size:11px; transition:transform 0.2s;">▼</span>
        </a>

        <ul id="mobilePpDropdown" style="
            display: none;
            list-style: none;
             padding: 6px 0;
            margin: 0;
            width: 85%;
            margin-bottom : 10px;
            background: #FFDE7F;
            border-radius: 10px;
            border: 0.5px solid #e0d200;">
            <li><a href="<?= base_url('purplepremiumhome') ?>" class="pp-mobile-link">OVERVIEW</a></li>
            <li><a href="<?= base_url('Purplenonmedical') ?>"     class="pp-mobile-link">STEM</a></li>
            <li><a href="<?= base_url('Purplenonmedical') ?>"      class="pp-mobile-link">MBA</a></li>
            <li><a href="<?= base_url('purpleusme') ?>"    class="pp-mobile-link">USMLE</a></li>
            <li><a href="<?= base_url('Purpleplab') ?>"     class="pp-mobile-link">PLAB</a></li>
            <li><a href="<?= base_url('purpleamc') ?>"      class="pp-mobile-link">AMC</a></li>
            <li><a href="<?= base_url('Purplenonmedical') ?>"    class="pp-mobile-link">OTHER PATHS</a></li>
        </ul>
    </li>

    <li class="mb-2">
        <a href="<?= base_url('cvreadyprogram') ?>" 
           class="tab-button text-black <?= ($current == 'cvreadyprogram') ? 'active-tab' : '' ?>" 
           style="padding: 4px;">#cvReadyPrograms</a>
    </li>
    <li class="mb-2">
        <a href="<?= base_url('Usmlerotation') ?>" 
           class="tab-button text-black <?= ($current == 'usmlerotation') ? 'active-tab' : '' ?>" 
           style="padding: 4px;">#USMLERotation</a>
    </li>
    <li class="mb-2" id="mobileExploreWrapper">
    <a href="javascript:void(0)"
       class="tab-button text-black <?= ($current == 'explorecountries') ? 'active-tab' : '' ?>"
       style="padding:4px; display:inline-flex; align-items:center; gap:4px;"
       onclick="toggleMobileExplore()">

        #exploreCountries
        <span id="mobileExploreArrow" style="font-size:11px; transition:transform .2s;">▼</span>
    </a>

    <ul id="mobileExploreDropdown" style="
        display:none;
        list-style:none;
        padding:6px 0;
        margin:0;
        width:85%;
        margin-bottom:10px;
        background:#FFDE7F;
        border-radius:10px;
        border:0.5px solid #e0d200;">

        <li>
            <a href="<?= base_url('countriesusa') ?>" class="pp-mobile-link">
                USA
            </a>
        </li>

        <li>
            <a href="<?= base_url('countriesuk') ?>" class="pp-mobile-link">
                UK
            </a>
        </li>

        <li>
            <a href="<?= base_url('countriesaus') ?>" class="pp-mobile-link">
                AUSTRALIA
            </a>
        </li>

        <li>
            <a href="<?= base_url('countriesgermany') ?>" class="pp-mobile-link">
                GERMANY
            </a>
        </li>

        <li>
            <a href="<?= base_url('explorecountries') ?>" class="pp-mobile-link">
                FULL COUNTRY LIST
            </a>
        </li>

    </ul>
</li>
</ul>
                    </div>
          </div>
          
          

<script>
    function showLoginRequiredPopup(event) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        var popup = document.getElementById('pgsLoginPopup');
        if (popup) {
            popup.classList.add('show');
        }
    }

    function closeLoginRequiredPopup(event) {
        if (event && event.target && event.target.id !== 'pgsLoginPopup' && !event.target.classList.contains('pgs-login-popup-close')) {
            return;
        }
        var popup = document.getElementById('pgsLoginPopup');
        if (popup) {
            popup.classList.remove('show');
        }
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            var popup = document.getElementById('pgsLoginPopup');
            if (popup) {
                popup.classList.remove('show');
            }
        }
    });
</script>

          <script>
              function toggleMobilePP() {
    const menu   = document.getElementById('mobilePpDropdown');
    const arrow  = document.getElementById('mobilePpArrow');
    const isOpen = menu.style.display === 'block';

    menu.style.display  = isOpen ? 'none' : 'block';
    arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
}
          </script>

<script>
function toggleMobileExplore() {
    const menu = document.getElementById('mobileExploreDropdown');
    const arrow = document.getElementById('mobileExploreArrow');

    const isOpen = menu.style.display === 'block';

    menu.style.display = isOpen ? 'none' : 'block';
    arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
}
</script>
    
    
    