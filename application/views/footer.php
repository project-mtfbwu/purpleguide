
    <!-- Footer -->
<div class="footer-bg">
    <section class="footer">
        <div class="flot-img">
            <img src="<?= base_url('assets/img/top.png')?>" />
        </div>
        <!-- <footer> -->
        <div class="container pt-5 pb-8">
            <div class="row justify-content-center">
                <div class="col-lg-2">
                    <div class="card-bg-pruple text-center w-210px">
                        <h4 class="mb-0 fs-20 lh-full mt-7">Currently studying? Become a mentor <br/> and help students.</h4>
                        <button type="button" class="btn btn-join" onclick="return window.joinPremiumOpen();">Join The Team!</button>
                    </div>
                </div>
                <div class="col-lg-5 offset-1">
                    <div class="yellow-bg">
                        General Enquiries  
                    </div>
					
                    <div class="d-flex gap-2 fs-20 text-white mt-2 mb-2">
                        <img src="<?= base_url('assets/img/mail.png')?>" width="25px"> hello@purpleguide.study
                    </div>
                    <div class="yellow-bg mt-3">
                        General Enquiries
                    </div>
                    <div class="d-flex gap-2 fs-20 text-white mt-2 mb-3">
                        <img src="<?= base_url('assets/img/mail.png')?>" width="25px"> connect@purpleguide.study
                    </div>
                    <div class="social-flex mt-5 mb-3 d-flex align-items-center gap-3">
                        <img src="<?= base_url('assets/img/right.png')?>" />
                        <h6 class="mb-0 text-white fs-20">Our Socials</h6>
                        <div class="social-img d-flex align-items-center gap-3">
                            <a href="#">
								
                                <img src="<?= base_url('assets/img/instagram.png')?>">
                            </a>
                            <a href="#">
                                <img src="<?= base_url('assets/img/facebook.png')?>">
                            </a>
                            <a href="#">
                                <img src="<?= base_url('assets/img/threads.png')?>">
                            </a>
                            <a href="#">
                                <img src="<?= base_url('assets/img/youtube.png')?>">
                            </a>
                            <a href="#">
                                <img src="<?= base_url('assets/img/linkdln.png')?>">
                            </a>
                        </div>
                        <img src="<?= base_url('assets/img/left.png')?>" />
                    </div>
                    
					
                    <div class="terms-content mt-6">
                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Privacy Policy</a>
                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Terms & Conditions</a>
                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Refund Policy</a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="fs-14 lh-full mb-5 text-white">
                        <span class="fs-15"> For</span><br />
                        Feedback, <br /> Escalations <br /> & Complaints
                    </div>
                    <div class="d-flex gap-2 fs-20 text-white mt-2 align-items-start">
                        <img src="<?= base_url('assets/img/mail.png')?>" width="25px">
                        <div>
                            <span class="" style="white-space:nowrap;">hey@purpleguide.study</span>
                            <p class="fs-14 fw-400 mb-0 mt-4 lh-full">We’re a project-first team, and we try to sort out
                                complaints within 7 business days.
                                Good vibes or tough love: your feedback actually helps us level up.</p>
                            <p class="fs-14 fw-400 mb-0 mt-4 lh-full">All emails sent to this address will stay
                                anonymous—unless we spot any signs of misuse or suspicious activity.</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- </footer> -->
    </section>

    <section class="copyrght">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-center">
                        <h4 class="w-20 text-white">#PGS</h4>
                        <div class="d-flex align-items-center gap-4">
                            <h4 class="text-white fs-24  fw-700 lh-28 cursor-pointer" onclick="return window.REFRppOpenModal();">(For Mentors) Help Students Choose <br/>
                                Smarter – Earn with Our Referral Program</h4>
                            <a href="<?= base_url('unitieup') ?>" class="text-white fw-700 fs-24 lh-28">(For Universities) Give Your Students a <br/>
                                Global Edge – Partner with #PGS</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
</div>

    <!-- ═══ MODAL OVERLAY (hidden by default) ═══ -->
    <div id="joinPremiumModal" class="mobile-applicant pgs-modal premium-modal-overlay" style="display: none;" onclick="if(event.target===this){window.applicatModalCloseModal();}">
      <div class="premium-modal-container purple-modal d-flex">
        <!-- LEFT PANEL -->
        <div class="panel-left">
             <button class="close-btn desktop-none" id="closeBtn" aria-label="Close" onclick="return window.joinCloseModal();">✕</button>
          <div class="brand-row">
            <div class="brand-title">#PGS</div>
            <div class="heart-badge">
                  <img src="<?= base_url('assets/img/heart.gif') ?>" />
            </div>
          </div>
          <div class="sub-label fnt-family">INVESTOR ACCESS</div>
          <p class="tagline lh-18ppx">Interested in investing or partnering with #PGS?</p>
    
          <div class="boost-wrap">
            <div class="mobile-none" style="margin : 0  0 0 auto">
             <img src="<?= base_url('assets/img/arrow-modal.png') ?>" style="width: 95px;margin-left: -10px;" />
              <span class="w-full d-block fs-16 text-white lh-18">get the <br/>boost <br/> your <br/> deserves</span>
            </div>
            <div class="mb-4">
                <img src="<?= base_url('assets/img/bump.png') ?>" />
            </div>
            <div class="desktop-none">
                <p class="mb-0 fs-14 lh-20 fw-400 text-white">get the boost your <br/> PREP deserves</p>
            </div>
          </div>
        </div>
    
        <!-- RIGHT PANEL -->
        <div class="panel-right">
          <button class="close-btn mobile-none" id="closeBtn" aria-label="Close" onclick="return window.joinCloseModal();">✕</button>
    
          <div id="formContent">
            <div class="field-group">
                <div class="field">
                            <input type="text" id="nameInput" placeholder="Enter Name *" autocomplete="name" requried>
                        </div>
                        <div class="field">
                            <input type="email" id="emailInput" placeholder="Email *" autocomplete="email" requried>
                        </div>
                        <div class="field">
                            <input type="tel" id="phoneInput" placeholder="Phone (Whatsapp number preffered)" autocomplete="tel">
                        </div>
            </div>
    
           
           <div>
                        <p class="section-label mb-2">What are you planning to study?</p>
                        <div class="d-flex gap-3">
                             <select id="selectOption" class="modal-btn-pgs">
                                 <option value="1">Retail investor</option>
                                 <option value="2">Retail investor - 1</option>
                             </select>
                            <label for="selectOption">
                                <img src="<?= base_url('assets/img/arrow-btn.png') ?>" style="width : 26px; height :26px" />
                            </label>

                        </div>
                    </div>
           <div>
                        <p class="section-label mb-2">Pre-seed round open. Want in?</p>
                        <div class="d-flex gap-3">
                             <select id="selectOption" class="modal-btn-pgs">
                                 <option value="1">Yes, actively exploring</option>
                                 <option value="2">Yes, actively exploring</option>
                             </select>
                            <label for="selectOption">
                                <img src="<?= base_url('assets/img/arrow-btn.png') ?>" style="width : 26px; height :26px" />
                            </label>

                        </div>
                    </div>

            
    
            <div class="divider"></div>
    
            <div class="cta-row mt-5">
              <button class="cta-btn" id="ctaBtn" onclick="if(event.target === this){ window.joinPremiumOpen2(); } else { window.applicatModalCloseModal2(); }">
                lets connect
                <span class="arrow">←</span>
              </button>
            </div>
          </div>
    
          <!-- SUCCESS STATE -->
          <div class="success-msg" id="successMsg">
            <div class="checkmark">🎉</div>
            <h3>You're all set!</h3>
            <p>Your personalised checklist is on its way.<br>Check your inbox soon.</p>
          </div>
        </div>
        </div>
      </div>
    </div>
    

    <div id="joinPremiumModal2" class="pgs-modal premium-modal-overlay new" style="display: none; background : transparent" onclick="if(event.target===this){window.applicatModalCloseModal2();}">
      <div class="premium-modal-container purple-modal d-flex bg-white pgs-modal-2" style="border-radius: 20px !important">
      <button class="close-btn" id="closeBtn" aria-label="Close" onclick="return window.joinCloseModal2();">✕</button>
      
       <div class="text-center">
           <h5 class="fw-700 fs-48 text-black"><img src="<?= base_url('assets/img/check-12.png') ?>" style="width : 50px" />you’re in</h5>
          <img src="<?= base_url('assets/img/okk.png') ?>" class="w-50%" />
          <h5 class="fw-400 fs-24 fnt-family text-black">lets get things moving.</h5>
       </div>
       <div class="w-180px">
                <p class="fs-13 fw-400 mb-5 text-black lh-15">
                If you’re coming in as a serious investor, drop us a message from your business email so we can take this forward directly.
                </p>
                <p class="fs-13 fw-400 mb-5 text-black lh-15">
					If you’re investing as retail, we’ll send you a <b>quick form</b> to get started.
                </p>
       </div>
       <div>
            <!-- <img src="<?= base_url('assets/img/heart.gif') ?>" style="width: 50px;border-radius: 10px;margin: 0 0 0 auto;display: block;" /> -->
            <div style="background : #150035" class="p-3 mt-4">
             <p class="fs-13 lh-15 text-white mb-4">direct email?</p>
            <input type="text" class="modal-email-1" value="investors@purpleguide.study" readonly style="    font-size: 15px !important;
    padding: 0px !important;">
             </div>
             <p class="mb-0 fs-12 lh-14 mt-3 text-black">(<b>Anjay</b> gets this email directly)</p>
       </div>
      </div>
    </div>


    <!---->
      <div id="REFRapplicantPremiumModal" class="mobile-applicant pgs-modal pgs-modalamc premium-modal-overlay" style="display: none;" onclick="if(event.target===this){window.applicatModalCloseModal();}">
        <div class="premium-modal-container purple-modal d-flex">
            <!-- LEFT PANEL -->
            <div class="panel-left">
                <button class="close-btn desktop-none" id="closeBtn" aria-label="Close" onclick="return window.REFRapplicatCloseModal();">✕</button>
                <div class="brand-row">
                    <div class="brand-title">#PGS</div>
                    <div class="heart-badge">
                        <img src="<?= base_url('assets/img/heart.gif') ?>" />
                    </div>
                </div>
                <div class="sub-label fnt-family">REFERRAL ACCESS </div>
                <p class="tagline lh-18ppx">Lets do some projects</p>

                <div class="boost-wrap">
                    <div class="mobile-none" style="margin : 0  0 0 auto">
                        <img src="<?= base_url('assets/img/arrow-modal.png') ?>" style="width: 95px;margin-left: -10px;" />
                        <span class="w-full d-block fs-16 text-white lh-18">get the <br />boost <br /> your <br /> deserves</span>
                    </div>
                    <div class="mb-4">
                        <img src="<?= base_url('assets/img/bump.png') ?>" />
                    </div>
                    <div class="desktop-none">
                        <p class="mb-0 fs-14 lh-20 fw-400 text-white">get the boost your <br /> PREP deserves</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT PANEL -->
            <div class="panel-right">
                <button class="close-btn mobile-none" id="closeBtn" aria-label="Close" onclick="return window.REFRapplicatCloseModal();">✕</button>

                <div id="formContent">
                    <div class="field-group">
                        <div class="field">
                            <input type="text" id="nameInput" placeholder="Enter Name" autocomplete="name">
                        </div>
                        <div class="field">
                            <input type="email" id="emailInput" placeholder="Email" autocomplete="email">
                        </div>
                        <div class="field">
                            <input type="tel" id="phoneInput" placeholder="Phone (Whatsapp number preffered)" autocomplete="tel">
                        </div>
                    </div>
                    
                    
                     <div>
                        <p class="section-label mb-2">What describes you best?</p>
                        <div class="d-flex gap-3">
                             <select id="selectOption" class="modal-btn-pgs">
                                 <option value="1">Reshare Webinars</option>
                                 <option value="2">Reshare Webinars - 1</option>
                             </select>
                            <label for="selectOption">
                                <img src="<?= base_url('assets/img/arrow-btn.png') ?>" style="width : 26px; height :26px" />
                            </label>

                        </div>
                    </div>


                    <div class="cta-row mt-5">
                        <button class="cta-btn" id="ctaBtn">
                            i need to join
                            <span class="arrow">←</span>
                        </button>
                    </div>
                </div>

                <!-- SUCCESS STATE -->
                <div class="success-msg" id="successMsg">
                    <div class="checkmark">🎉</div>
                    <h3>You're all set!</h3>
                    <p>Your personalised checklist is on its way.<br>Check your inbox soon.</p>
                </div>
            </div>
        </div>
    </div>
    </div>
    

    <div id="REFRapplicantPremiumModal2" class="pgs-modal premium-modal-overlay modal-pgsamc-2" style="display: none" onclick="if(event.target===this){window.REFRapplicatCloseModal2();}">
        <div class="premium-modal-container purple-modal d-flex bg-white pgs-modal-2" style="border-radius: 20px !important">
            <button class="close-btn" id="closeBtn" aria-label="Close" onclick="return window.REFRapplicatCloseModal2();">✕</button>

            <div class="text-center">
                <h5 class="fw-700 fs-48 text-black"><img src="<?= base_url('assets/img/check-12.png') ?>" style="width : 50px" />Hi future team member</h5>
                <img src="<?= base_url('assets/img/okk.png') ?>" class="w-50%" />
                <h5 class="fw-400 fs-24 fnt-family text-black">we will connect with you soon</h5>
            </div>
          
        </div>
    </div>


    
    

   <style>
    /* Premium Modal Styles */
	  	  @media (max-width: 756px) {
    #joinPremiumModal2.pgs-modal.new .premium-modal-container {
        display: flex !important;
        text-align: center;
        height: 100vh !important;
        max-height: 100vh !important;
        flex-wrap: wrap;
        padding-top: 57px !important;
        padding-bottom: 42px !important;
    }
}
    .premium-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 10000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .premium-modal-container {
        background: #fff;
        padding: 50px 40px;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        position: relative;
        max-width: 650px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        animation: modalFadeIn 0.3s ease;
    }

    @keyframes modalFadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }

    .premium-modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 40px;
        height: 40px;
        font-size: 30px;
        line-height: 30px;
        color: #000;
        background: transparent;
        border: none;
        cursor: pointer;
        z-index: 10001;
        text-align: center;
        padding: 0;
        transition: color 0.3s;
    }
    .premium-modal-close:hover { color: #2489FF; }

    .premium-modal-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 25px;
        border-bottom: 2px solid #f0f0f0;
    }

    .premium-modal-body { margin-bottom: 35px; }

    .premium-features-box {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 8px;
        margin-top: 25px;
    }

    .premium-feature-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }
    .premium-feature-item:last-child { margin-bottom: 0; }

    .premium-feature-icon {
        width: 28px;
        height: 28px;
        background: #2489FF;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 16px;
        flex-shrink: 0;
    }

    .premium-modal-footer {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }

    .btn-premium-cancel {
        padding: 14px 35px;
        background: transparent;
        color: #6c757d;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        font-weight: 600;
        font-family: inherit;
        transition: all 0.3s ease;
    }
    .btn-premium-cancel:hover { background: #f8f9fa; border-color: #adb5bd; }

    .btn-premium-apply {
        padding: 14px 35px;
        background: #2489FF;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        font-weight: 700;
        font-family: inherit;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(36, 137, 255, 0.3);
    }
    .btn-premium-apply:hover {
        background: #1a7ae6;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(36, 137, 255, 0.4);
    }
    .btn-premium-apply:disabled {
        background: #adb5bd;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    @media (max-width: 768px) {
        .premium-modal-container { padding: 35px 25px; }
        .premium-modal-footer { flex-direction: column; }
        .btn-premium-cancel, .btn-premium-apply { width: 100%; }
    }
    </style>

    <script>
        // PurplePremium modal/apply logic (single source of truth for this page).
        window.joinPremiumOpen = function () {
            var el = document.getElementById('joinPremiumModal');
            if (!el) return false;
            el.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            return false;
        };
        window.joinCloseModal = function () {
            var el = document.getElementById('joinPremiumModal');
            if (!el) return false;
            el.style.display = 'none';
            document.body.style.overflow = '';
            return false;
        };
    </script>
    
    <script>
        // PurplePremium modal/apply logic (single source of truth for this page).
        window.joinPremiumOpen2 = function () {
            var el = document.getElementById('joinPremiumModal2');
            if (!el) return false;
            el.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            return false;
        };
        window.joinCloseModal2 = function () {
            var el = document.getElementById('joinPremiumModal2');
            if (!el) return false;
            el.style.display = 'none';
            document.body.style.overflow = '';
            return false;
        };
    </script>
    <!-- end section -->


    <!-- start scroll progress -->
<div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
</div>
    <!-- end scroll progress -->
    <!-- javascript libraries -->
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/vendors.min.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/main.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/pgs-autocomplete.js')?>"></script>

    <!-- Modal form submission -->
    <style>
    #pgs-toast {
        position: fixed;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%) translateY(20px);
        min-width: 260px;
        max-width: 90vw;
        padding: 14px 22px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 500;
        color: #fff;
        z-index: 99999;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease, transform 0.3s ease;
        text-align: center;
    }
    #pgs-toast.show {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
        pointer-events: auto;
    }
    #pgs-toast.toast-error   { background: #e74c3c; }
    #pgs-toast.toast-success { background: #27ae60; }
    </style>

    <div id="pgs-toast"></div>

    <script>
    (function () {
        var SUBMIT_URL = '<?= base_url("Modal_submissions/submit") ?>';
        var _toastTimer = null;

        function showToast(msg, type) {
            var t = document.getElementById('pgs-toast');
            if (!t) return;
            clearTimeout(_toastTimer);
            t.textContent = msg;
            t.className = 'show toast-' + type;
            _toastTimer = setTimeout(function () {
                t.className = '';
            }, 3500);
        }

        function validateEmail(val) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
        }

        // Returns false if validation fails (also shows toast), true if OK
        function collectAndSubmit(modalId, modalType, onSuccess) {
            var $modal = document.getElementById(modalId);
            if (!$modal) return true;

            var name  = (($modal.querySelector('#nameInput')  || {}).value || '').trim();
            var email = (($modal.querySelector('#emailInput') || {}).value || '').trim();
            var phone = (($modal.querySelector('#phoneInput') || {}).value || '').trim();

            if (!name) {
                showToast('Please enter your name.', 'error');
                var inp = $modal.querySelector('#nameInput');
                if (inp) inp.focus();
                return false;
            }
            if (!email || !validateEmail(email)) {
                showToast('Please enter a valid email address.', 'error');
                var inp = $modal.querySelector('#emailInput');
                if (inp) inp.focus();
                return false;
            }

            // Collect checked toggle labels
            var checklistItems = [];
            var rows = $modal.querySelectorAll('.toggle-list .toggle-row');
            rows.forEach(function (row) {
                var cb = row.querySelector('input[type="checkbox"]');
                if (cb && cb.checked) {
                    var spans = row.querySelectorAll('span');
                    var label = spans[spans.length - 1] ? spans[spans.length - 1].textContent.trim() : '';
                    if (label) checklistItems.push(label);
                }
            });

            // planning_to_study: select or button
            var planningToStudy = '';
            var selects = $modal.querySelectorAll('select.modal-btn-pgs');
            var btns    = $modal.querySelectorAll('button.modal-btn-pgs');
            if (selects.length > 0) {
                planningToStudy = selects[0].options[selects[0].selectedIndex].text;
            } else if (btns.length > 0) {
                planningToStudy = btns[0].textContent.replace(/\s+/g, ' ').trim();
            }

            // preseed round (investor modal second select)
            var preseedRound = '';
            if (selects.length > 1) {
                preseedRound = selects[1].options[selects[1].selectedIndex].text;
            }

            var params = 'modal_type=' + encodeURIComponent(modalType)
                + '&name='              + encodeURIComponent(name)
                + '&email='             + encodeURIComponent(email)
                + '&phone='             + encodeURIComponent(phone)
                + '&planning_to_study=' + encodeURIComponent(planningToStudy)
                + '&preseed_round='     + encodeURIComponent(preseedRound)
                + '&source_page='       + encodeURIComponent(window.location.pathname);

            checklistItems.forEach(function (item) {
                params += '&checklist_items[]=' + encodeURIComponent(item);
            });

            var xhr = new XMLHttpRequest();
            xhr.open('POST', SUBMIT_URL, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                try {
                    var res = JSON.parse(xhr.responseText);
                    if (res.success) {
                        showToast('Submitted successfully! 🎉', 'success');
                        if (typeof onSuccess === 'function') onSuccess();
                    } else {
                        showToast(res.message || 'Submission failed. Please try again.', 'error');
                    }
                } catch (err) {
                    showToast('Something went wrong. Please try again.', 'error');
                }
            };
            xhr.onerror = function () {
                showToast('Network error. Please check your connection.', 'error');
            };
            xhr.send(params);
            return true;
        }

        // applicantPremiumModal — GET MY CHECKLIST
        document.addEventListener('click', function (e) {
            var btn = e.target.closest('#applicantPremiumModal .cta-btn');
            if (!btn) return;
            var hasInlineOnclick = !!btn.getAttribute('onclick');
            var valid = collectAndSubmit('applicantPremiumModal', 'applicant', function () {
                // Close modal1, open modal2 (confirmation screen)
                if (typeof window.applicatCloseModal === 'function') window.applicatCloseModal();
                if (typeof window.applicantPremiumOpen2 === 'function') window.applicantPremiumOpen2();
            });
            // Block inline onclick from firing if validation failed
            if (!valid && hasInlineOnclick) {
                e.stopImmediatePropagation();
                e.preventDefault();
            }
        }, true);

        // joinPremiumModal — LETS CONNECT
        document.addEventListener('click', function (e) {
            var btn = e.target.closest('#joinPremiumModal .cta-btn');
            if (!btn) return;
            var valid = collectAndSubmit('joinPremiumModal', 'investor');
            if (!valid) {
                e.stopImmediatePropagation();
                e.preventDefault();
            }
        }, true);

        // SCHOapplicantPremiumModal — scholarship page modal
        document.addEventListener('click', function (e) {
            var btn = e.target.closest('#SCHOapplicantPremiumModal .cta-btn');
            if (!btn) return;
            var valid = collectAndSubmit('SCHOapplicantPremiumModal', 'applicant', function () {
                if (typeof window.SCHOapplicatCloseModal === 'function') window.SCHOapplicatCloseModal();
                if (typeof window.SCHOapplicantPremiumOpen2 === 'function') window.SCHOapplicantPremiumOpen2();
            });
            if (!valid) {
                e.stopImmediatePropagation();
                e.preventDefault();
            }
        }, true);

        // REFRapplicantPremiumModal — referral program modal
        document.addEventListener('click', function (e) {
            var btn = e.target.closest('#REFRapplicantPremiumModal .cta-btn');
            if (!btn) return;
            e.stopImmediatePropagation();
            e.preventDefault();
            collectAndSubmit('REFRapplicantPremiumModal', 'applicant', function () {
                if (typeof window.REFRapplicatCloseModal === 'function') window.REFRapplicatCloseModal();
                if (typeof window.REFRapplicantPremiumOpen2 === 'function') window.REFRapplicantPremiumOpen2();
            });
        }, true);
    })();
    </script>

   <script>
        const drawer = document.getElementById("drawer");
        const overlay = document.getElementById("overlay");
    
        function openDrawer() {
          drawer.classList.add("active");
          overlay.classList.add("active");
        }
    
        function closeDrawer() {
          drawer.classList.remove("active");
          overlay.classList.remove("active");
        }
      </script>
      
      
   <script>
    // PurplePremium modal/apply logic (single source of truth for this page).
    window.REFRppOpenModal = function() {
        var el = document.getElementById('REFRapplicantPremiumModal');
        if (!el) return false;
        el.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        return false;
    };
    window.REFRapplicatCloseModal = function() {
        var el = document.getElementById('REFRapplicantPremiumModal');
        if (!el) return false;
        el.style.display = 'none';
        document.body.style.overflow = '';
        return false;
    };
</script>

<script>
    // PurplePremium modal/apply logic (single source of truth for this page).
    window.REFRapplicantPremiumOpen2 = function() {
        var el = document.getElementById('REFRapplicantPremiumModal2');
        if (!el) return false;
        el.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        return false;
    };
    window.REFRapplicatCloseModal2 = function() {
        var el = document.getElementById('REFRapplicantPremiumModal2');
        if (!el) return false;
        el.style.display = 'none';
        document.body.style.overflow = '';
        return false;
    };
</script> 
     
      
    