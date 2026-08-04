 </div>
        <!-- END wrapper -->

        
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="mdi mdi-close"></i>
                </a>
                <h4 class="font-17 m-0 text-white">Theme Customizer</h4>
            </div>
            <div class="slimscroll-menu">
        
                <div class="p-4">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, layout, etc.
                    </div>
                    <div class="mb-2">
                        <img src="<?php echo base_url();?>assets\images\layouts\light.png" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked="">
                        <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
                    </div>
            
                    <div class="mb-2">
                        <img src="<?php echo base_url();?>assets\images\layouts\dark.png" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsstyle="assets/css/bootstrap-dark.min.css" data-appstyle="assets/css/app-dark.min.css">
                        <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
            
                    <div class="mb-2">
                        <img src="<?php echo base_url();?>assets\images\layouts\rtl.png" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-5">
                        <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appstyle="assets/css/app-rtl.min.css">
                        <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>

                </div>
            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        

        <!-- jQuery (required for DataTables and existing functionality) -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        
        <!-- Bootstrap 5 JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        
        <!-- Vendor js (keeping for sidebar compatibility) -->
        <script src="<?php echo base_url();?>assets\js\vendor.min.js"></script>

        <!-- DataTables Bootstrap 5 -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url();?>assets\js\app.min.js"></script>

        <!-- Idle logout modal -->
        <div class="modal fade" id="idleTimeoutModal" tabindex="-1" aria-labelledby="idleTimeoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="idleTimeoutModalLabel">You’re about to be logged out</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        You’ve been idle. You’ll be logged out in <strong><span id="idleTimeoutCountdown">60</span>s</strong> unless you continue.
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-outline-secondary" href="<?= base_url('Users/logout') ?>">Logout now</a>
                        <button type="button" class="btn btn-primary" id="idleTimeoutContinueBtn">Continue session</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bootstrap 5 compatibility script for Bootstrap 4 attributes -->
        <script>
            // Convert Bootstrap 4 data-toggle to Bootstrap 5 data-bs-toggle
            document.addEventListener('DOMContentLoaded', function() {
                // Convert data-toggle to data-bs-toggle
                document.querySelectorAll('[data-toggle]').forEach(function(el) {
                    var toggle = el.getAttribute('data-toggle');
                    el.removeAttribute('data-toggle');
                    el.setAttribute('data-bs-toggle', toggle);
                });
                
                // Convert data-target to data-bs-target
                document.querySelectorAll('[data-target]').forEach(function(el) {
                    var target = el.getAttribute('data-target');
                    el.removeAttribute('data-target');
                    el.setAttribute('data-bs-target', target);
                });
                
                // Convert data-dismiss to data-bs-dismiss
                document.querySelectorAll('[data-dismiss]').forEach(function(el) {
                    var dismiss = el.getAttribute('data-dismiss');
                    el.removeAttribute('data-dismiss');
                    el.setAttribute('data-bs-dismiss', dismiss);
                });
                
                // Sidebar Toggle Functionality
                const sidebarToggle = document.getElementById('sidebar-toggle');
                const leftSideMenu = document.getElementById('left-side-menu');
                const body = document.body;
                
                if(sidebarToggle) {
                    sidebarToggle.addEventListener('click', function() {
                        body.classList.toggle('sidebar-collapsed');
                        // Save state to localStorage
                        localStorage.setItem('sidebarCollapsed', body.classList.contains('sidebar-collapsed'));
                    });
                }
                
                // Restore sidebar state from localStorage
                if(localStorage.getItem('sidebarCollapsed') === 'true') {
                    body.classList.add('sidebar-collapsed');
                }
                
                // Mobile sidebar toggle
                if(window.innerWidth <= 992) {
                    if(sidebarToggle) {
                        sidebarToggle.addEventListener('click', function() {
                            leftSideMenu.classList.toggle('show');
                        });
                    }
                    
                    // Close sidebar when clicking outside on mobile
                    document.addEventListener('click', function(e) {
                        if(window.innerWidth <= 992 && 
                           !leftSideMenu.contains(e.target) && 
                           !sidebarToggle.contains(e.target) &&
                           leftSideMenu.classList.contains('show')) {
                            leftSideMenu.classList.remove('show');
                        }
                    });
                }
                
                // Handle window resize
                window.addEventListener('resize', function() {
                    if(window.innerWidth > 992) {
                        leftSideMenu.classList.remove('show');
                    }
                });
                
                // Handle user dropdown arrow rotation
                const userDropdown = document.getElementById('userDropdown');
                if(userDropdown) {
                    userDropdown.addEventListener('show.bs.dropdown', function() {
                        this.setAttribute('aria-expanded', 'true');
                    });
                    userDropdown.addEventListener('hide.bs.dropdown', function() {
                        this.setAttribute('aria-expanded', 'false');
                    });
                }
                
                // Set active menu item based on current URL
                const currentUrl = window.location.href;
                const menuLinks = document.querySelectorAll('#sidebar-menu a');
                
                menuLinks.forEach(function(link) {
                    const href = link.getAttribute('href');
                    if(href && currentUrl.includes(href) && href !== 'javascript: void(0);') {
                        link.classList.add('active');
                        // Also mark parent as active if it's a submenu item
                        const parentLi = link.closest('li');
                        if(parentLi && parentLi.parentElement.classList.contains('nav-second-level')) {
                            const parentMenu = parentLi.parentElement.previousElementSibling;
                            if(parentMenu) {
                                parentMenu.classList.add('active');
                                parentMenu.closest('li').classList.add('mm-active');
                            }
                        } else {
                            parentLi.classList.add('active');
                        }
                    }
                });
                
                // Smooth submenu toggle
                document.querySelectorAll('#sidebar-menu > li > a').forEach(function(link) {
                    const parentLi = link.closest('li');
                    const submenu = parentLi.querySelector('.nav-second-level');
                    
                    if(submenu) {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            
                            const isActive = parentLi.classList.contains('mm-active');
                            
                            // Close all other submenus smoothly
                            document.querySelectorAll('#sidebar-menu > li').forEach(function(li) {
                                if(li !== parentLi && li.classList.contains('mm-active')) {
                                    const otherSubmenu = li.querySelector('.nav-second-level');
                                    if(otherSubmenu) {
                                        otherSubmenu.style.maxHeight = '0';
                                        otherSubmenu.style.opacity = '0';
                                        setTimeout(function() {
                                            li.classList.remove('mm-active');
                                        }, 150);
                                    }
                                }
                            });
                            
                            // Toggle current submenu smoothly
                            if(isActive) {
                                submenu.style.maxHeight = '0';
                                submenu.style.opacity = '0';
                                setTimeout(function() {
                                    parentLi.classList.remove('mm-active');
                                }, 150);
                            } else {
                                parentLi.classList.add('mm-active');
                                // Force reflow for smooth animation
                                submenu.offsetHeight;
                                submenu.style.maxHeight = submenu.scrollHeight + 'px';
                                submenu.style.opacity = '1';
                            }
                        });
                    }
                });
                
                // Prevent MetisMenu from interfering (if loaded)
                if(typeof MetisMenu !== 'undefined') {
                    // Disable MetisMenu auto-initialization
                    window.MetisMenu = undefined;
                }
            });
        </script>

        <script>
            (function () {
                // 1 hour idle logout with 60s warning
                var IDLE_TIMEOUT_MS = 60 * 60 * 1000;
                var WARNING_MS = 60 * 1000;
                var STORAGE_KEY = 'pgs_admin_last_activity_ms';
                var logoutUrl = <?= json_encode(base_url('Users/logout')) ?>;

                // A fresh page load IS activity: the server just validated the
                // session to render this page. Always start the idle clock from
                // now. Adopting a stale timestamp left in localStorage by a
                // previous session is what bounced a just-logged-in admin
                // straight back to the login page ~1s after reaching the
                // dashboard. Cross-tab keep-alive still works via the newer-only
                // 'storage' listener below.
                var lastActivity = Date.now();
                try {
                    localStorage.setItem(STORAGE_KEY, String(lastActivity));
                } catch (e) {
                    // localStorage might be blocked; fallback to in-memory only
                }

                var modalEl = document.getElementById('idleTimeoutModal');
                var countdownEl = document.getElementById('idleTimeoutCountdown');
                var continueBtn = document.getElementById('idleTimeoutContinueBtn');
                if (!modalEl || !countdownEl || !continueBtn || typeof bootstrap === 'undefined') return;

                var modal = new bootstrap.Modal(modalEl, { backdrop: 'static', keyboard: false });
                var modalShown = false;
                var countdownTimer = null;

                function setLastActivity(ts) {
                    lastActivity = ts;
                    try { localStorage.setItem(STORAGE_KEY, String(ts)); } catch (e) {}
                }

                function onActivity() {
                    if (modalShown) return; // don’t auto-dismiss warning due to background events
                    setLastActivity(Date.now());
                }

                function stopCountdown() {
                    if (countdownTimer) {
                        clearInterval(countdownTimer);
                        countdownTimer = null;
                    }
                }

                function startCountdown(remainingMs) {
                    stopCountdown();
                    var endAt = Date.now() + remainingMs;
                    function tick() {
                        var msLeft = endAt - Date.now();
                        if (msLeft <= 0) {
                            window.location.href = logoutUrl;
                            return;
                        }
                        countdownEl.textContent = String(Math.ceil(msLeft / 1000));
                    }
                    tick();
                    countdownTimer = setInterval(tick, 250);
                }

                function showWarning(remainingMs) {
                    if (modalShown) return;
                    modalShown = true;
                    modal.show();
                    startCountdown(remainingMs);
                }

                function hideWarning() {
                    if (!modalShown) return;
                    modalShown = false;
                    stopCountdown();
                    modal.hide();
                }

                continueBtn.addEventListener('click', function () {
                    hideWarning();
                    setLastActivity(Date.now());
                    // best-effort keep-alive; ignore errors
                    try { fetch(window.location.href, { method: 'HEAD', credentials: 'same-origin', cache: 'no-store' }); } catch (e) {}
                });

                // Track activity (mouse/keyboard/touch/scroll)
                ['mousemove', 'mousedown', 'keydown', 'touchstart', 'scroll'].forEach(function (evt) {
                    window.addEventListener(evt, onActivity, { passive: true });
                });

                // Cross-tab sync
                window.addEventListener('storage', function (e) {
                    if (e && e.key === STORAGE_KEY && e.newValue) {
                        var ts = parseInt(e.newValue, 10);
                        if (!Number.isNaN(ts) && ts > lastActivity) lastActivity = ts;
                    }
                });

                // Main loop
                setInterval(function () {
                    var idleMs = Date.now() - lastActivity;
                    if (idleMs >= IDLE_TIMEOUT_MS) {
                        window.location.href = logoutUrl;
                        return;
                    }
                    var remainingMs = IDLE_TIMEOUT_MS - idleMs;
                    if (remainingMs <= WARNING_MS) showWarning(remainingMs);
                }, 1000);
            })();
        </script>

    </body>

</html>