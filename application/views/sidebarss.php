<section class="pt-1 pb-5">
        <div class="container-fluid px-4">
            <div class="row g-0 align-items-start">
                <div class="col-xl-9 col-lg-9 d-flex gap-7">
                    <div class="arrow-box sidebar-box" id="sidebar">
                        <div class="d-flex justify-content-space align-items-start">
                            <h5 class="pt-5 text-black fs-45 fnt-family text-start">
                                Welcome <br />
                                rajeev s malhotra
                            </h5>
                            <i class="bi bi-arrow-right-square-fill" id="close_Btn"></i>
                        </div>
                        <ul class="ml-0">
                            <li>
                                <a href="">
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
                        <div class="d-flex align-items-center gap-3 plr-5 mt-3">
                            <a href="#" class="text-black fs-20">
                                <img src="<?= base_url('assets/img/profile-icon.png')?>" class="d-block">
                                Profile
                            </a>
                            <a href="<?= base_url('saved')?>" class="text-black fs-20">
                                <img src="<?= base_url('assets/img/heart-icon.png')?>" class="d-block">
                                Saved List
                            </a>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <a href="<?= base_url('Login/logout')?>" class="text-black fs-20">
                                <img src="<?= base_url('assets/img/logout.png')?>" class="d-block">
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="arrow-box" id="toggleBtn">
                        <i class="bi bi-arrow-right-square-fill"></i>
                    </div>

                    <div class="horizontel-tabs">
                        <ul class="p-0 m-0">
                            <li>Deadlines & Updates</li>
                            <li>Key facts to explore</li>
                            <li>Key facts to explore</li>
                            <li>#PurpleEvents</li>
                            <li>Progress Stats</li>
                            <li>Progress Stats</li>
                            <li>Progress Stats</li>
                            <li>Progress Stats</li>
                        </ul>
                    </div>

                </div>

                <div class="col-xl-3 justify-content-end col-lg-3 d-flex gap-7">
                    <div>
                        <div class="search-box ">
                            <div class="input-group w-100">
                                <span><i class="bi bi-search"></i></span>
                                <input
                                    type="search"
                                    class="search-control"
                                    placeholder="Search programs & events…"
                                    data-autocomplete-endpoint="<?= base_url('Search/autocomplete') ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>