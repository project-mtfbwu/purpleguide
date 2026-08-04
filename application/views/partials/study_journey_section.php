<?php
$study_journey_options = isset($study_journey_options) ? $study_journey_options : [
    'youare' => ['Parent', 'Student', 'Mentor'],
    'medical1' => ['USMLE', 'AMC', 'PLAB'],
    'masters' => ['MBA', 'STEM', 'Law', 'CSE', 'Others'],
    'undergrad' => ['Business', 'STEM', 'Law', 'Others'],
    'medical2' => ['Specialities', 'Physiotherapy', 'Nursing', 'Others'],
    'country' => ['Done a bit', 'I am doing as a group', 'I am starting my journey'],
    'medicalpath' => ['1st or 2nd Year', '3rd to Final Year', 'Internship', 'Working', 'Others'],
    'masterpath' => ['Studying', 'Graduated', 'Working', 'Others'],
    'undergradpath' => ['12th', '11th', '10th or less'],
    'plan' => ['2025', '2026', '2027', 'Guide me in choosing my intake schedule'],
    'countries' => ['USA', 'UK', 'CANADA', 'AUSTRALIA', 'NEW ZEALAND', 'EUROPE', 'Not sure yet - need help deciding'],
];
?>
<section class="pt-15 half-section overlap-height position-relative step-progress-mobile">
    <div class="w-969px m-auto overlap-gap-section p-0 d-flex align-items-center">
        <div class="col-lg-4">
            <figure class="step-progress-img m-0 text-center">
                <img src="./assets/img/step.png" alt="" class="border-radius-6px">
            </figure>
        </div>
        <div class="position-relative bg-gray w-667px  bg-very-light-green xl-p-4 md-p-50px sm-p-30px border-radius-10px pl-6-pt-6 ">
            <div class="mb-10px">
            </div>
            <div class="">
                <h2 class="mb-1 bg-text-step text-black fs-34">
                    Not Sure Where to Begin?
                </h2>
                <h4 class="mb-4 text-black fs-38 lh-22 fw-400 bg-text-step-1 mb-2 mt-2 mobile-fs-20">
                    Start Your Study Abroad Journey Here!
                </h4>
                <p class="text-black fs-17 lh-22 text-center mobile-fs-14 mobile-text-start">
                    A few quick questions so we know where you stand — and from there, our mentors will
                    guide
                    you step by step.
                </p>
                <form id="studyJourneyForm" action="<?= site_url('Home/submit_study_journey') ?>" method="post">
                    <div class="card-stps que-step-header">
                        <div>
                            <span class="fs-19 lh-25 text-black" id="step-counter">Step 1 of 4</span>
                            <div class="que-progress">
                                <div class="que-progress-bar" id="progress-bar"></div>
                            </div>
                        </div>

                        <div class="step step-1">
                            <h3 class="que-yellow-label">You are a <span class="req">*</span></h3>
                            <?php foreach ($study_journey_options['youare'] as $option): ?>
                                <label><input type="radio" name="youare" value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                            <?php endforeach; ?>

                            <h3 class="que-yellow-label mb-4">Pick your stream <span class="req">*</span></h3>
                            <div class="que-path-section">
                                <div class="questions" style="justify-content: space-between;gap: 0px;">
                                    <div>
                                        <h4>Medical Path</h4>
                                        <?php foreach ($study_journey_options['medical1'] as $option): ?>
                                            <label><input type="radio" name="stream" data-stream-group="medical1" value="medical1|<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                        <?php endforeach; ?>
                                    </div>

                                    <div>
                                        <h4>Masters Path</h4>
                                        <?php foreach ($study_journey_options['masters'] as $option): ?>
                                            <label><input type="radio" name="stream" data-stream-group="masters" value="masters|<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                        <?php endforeach; ?>
                                    </div>

                                    <div>
                                        <h4>Undergrad Path</h4>
                                        <?php foreach ($study_journey_options['undergrad'] as $option): ?>
                                            <label><input type="radio" name="stream" data-stream-group="undergrad" value="undergrad|<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                    <div>
                                        <h4>Medical Path 2</h4>
                                        <?php foreach ($study_journey_options['medical2'] as $option): ?>
                                            <label><input type="radio" name="stream" data-stream-group="medical2" value="medical2|<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn-next" onclick="nextStep()" style="border-radius : 10px;">Next</button>
                            </div>
                        </div>

                        <div class="step step-2 hidden">
                            <h3 class="que-yellow-label">What step of your journey are you currently in?
                                <span class="req">*</span>
                            </h3>
                            <?php foreach ($study_journey_options['country'] as $option): ?>
                                <label><input type="radio" name="country" value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                            <?php endforeach; ?>

                            <h3 class="que-yellow-label">Level of your study <span class="req">*</span></h3>
                            <div class="que-path-section">
                                <div class="questions">
                                    <div>
                                        <h4>Medical Path</h4>
                                        <?php foreach ($study_journey_options['medicalpath'] as $option): ?>
                                            <label><input type="radio" name="study_level" data-study-level-group="medicalpath" value="medicalpath|<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                    <div>
                                        <h4>Masters Path</h4>
                                        <?php foreach ($study_journey_options['masterpath'] as $option): ?>
                                            <label><input type="radio" name="study_level" data-study-level-group="masterpath" value="masterpath|<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                    <div>
                                        <h4>Undergrad Path</h4>
                                        <?php foreach ($study_journey_options['undergradpath'] as $option): ?>
                                            <label><input type="radio" name="study_level" data-study-level-group="undergradpath" value="undergradpath|<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn-back" onclick="goBack()">Back</button>
                                <button type="button" class="btn-next" onclick="nextStep()" style="border-radius : 10px;">Next</button>
                            </div>
                        </div>

                        <div class="step step-3 hidden">
                            <div>
                                <h3 class="que-yellow-label">Which intake year are you aiming for? <span class="req">*</span></h3>
                                <?php foreach ($study_journey_options['plan'] as $option): ?>
                                    <label><input type="radio" name="plan" value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                <?php endforeach; ?>
                            </div>
                            <div>
                                <h3 class="que-yellow-label" style="height : auto !important;">Which countries are you considering?<span
                                        class="fs-15 fw-400 d-block" style="margin-top: -8px;">(for masters and
                                        undergrad path)</span></h3>
                                <?php foreach ($study_journey_options['countries'] as $option): ?>
                                    <label><input type="radio" name="countries" value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                <?php endforeach; ?>
                            </div>
                            <div>
                                <button type="button" class="btn-back" onclick="goBack()">Back</button>
                                <button type="button" class="btn-next" onclick="nextStep()" style="border-radius : 10px;">Next</button>
                            </div>
                        </div>

                        <div class="step step-4 hidden">
                            <div class="mb-2">
                                <h3 class="que-yellow-label">Your Name <span class="req">*</span></h3>
                                <input class="form-control py-2 px-3" type="text" name="name" id="journeyName" maxlength="120" autocomplete="name">
                            </div>
                            <div class="mb-2">
                                <h3 class="que-yellow-label">Email <span class="req">*</span></h3>
                                <input class="form-control py-2 px-3" type="email" name="email" id="journeyEmail" maxlength="180" autocomplete="email">
                            </div>
                            <div class="mb-2">
                                <h3 class="que-yellow-label">Phone No. <span class="req">*</span></h3>
                                <input class="form-control py-2 px-3" type="number" name="number" id="journeyPhone" placeholder="" min="0" autocomplete="tel">
                            </div>
                            <div>
                                <!--<button class="btn-back" onclick="goBack()">Back</button>-->
                                <button type="button" class="btn-next" id="studyJourneySubmitBtn" onclick="finishForm()">Submit</button>
                            </div>
                        </div>
                        
                        <figure class="step-progress-img progress-small m-0 text-center desktop-none">
                                <img src="./assets/img/step.png" alt="" class="border-radius-6px" data-no-retina="">
                            </figure>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
