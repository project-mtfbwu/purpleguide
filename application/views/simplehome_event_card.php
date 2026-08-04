<?php
/**
 * Renders one event card for Simplehome tabs. Expects $ev (object or null).
 */
if (!isset($ev)) $ev = null;
if ($ev):
    $ev_sd = format_event_date($ev->s_date ?? '');
    $ev_ed = format_event_date($ev->e_date ?? '');
    $ev_img = event_image_url($ev->image1 ?? null, base_url('assets/img/tab-img.jpg'), $ev->image2 ?? null);
    $ev_who = isset($ev->who_is_it_for) ? trim($ev->who_is_it_for) : 'Final-year student? Recent grad? This session is made for you.';
    $ev_topics = !empty($ev->session_topics) ? array_filter(array_map('trim', explode("\n", $ev->session_topics))) : [];
?>
<div class="card-box-gradiant border p-4">
    <div class="card-box-gradiant-header purple-dot">
        <h5 class="mb-0"><?= nl2br(htmlspecialchars($ev->product_name ?? 'Event')) ?></h5>
    </div>
    <div class="date-box">
        <div>
            <div class="box-date-info"><span class="date"><?= htmlspecialchars($ev_sd['day'] ?? '') ?></span><span class="month"><?= htmlspecialchars($ev_sd['month'] ?? '') ?></span></div>
            <p class="mb-0 text-black fw-600 fs-12 lh-16 mt-2"><?= htmlspecialchars($ev_sd['time'] ?? '') ?></p>
        </div>
        <div>
            <div class="box-date-info"><span class="date"><?= htmlspecialchars($ev_ed['day'] ?? '') ?></span><span class="month"><?= htmlspecialchars($ev_ed['month'] ?? '') ?></span></div>
            <p class="mb-0 text-black fw-600 fs-12 lh-16 mt-2"><?= htmlspecialchars($ev_ed['time'] ?? '') ?></p>
        </div>
    </div>
    <div class="btn-content w-50">
        <h5 class="mb-0 text-black fw-400 fs-20">Who's It For?</h5>
        <p class="mb-0 fs-14 lh-18 text-black"><?= nl2br(htmlspecialchars($ev_who)) ?></p>
    </div>
    <?php if (!empty($ev_topics)): ?>
    <div class="text-content">
        <h5 class="mb-0 text-black fw-400 fs-20">Topics Covered</h5>
        <?php foreach (array_slice($ev_topics, 0, 3) as $t): ?><h6 class="mb-0 text-black fw-400 fs-15 lh-20"><?= htmlspecialchars($t) ?></h6><?php endforeach; ?>
    </div>
    <?php endif; ?>
    <div class="d-flex justify-content-space">
        <a href="<?= base_url('purpleevents/session/' . (int)$ev->id) ?>" class="sop-learn-btn bg-blue-500 mt-4 text-decoration-none text-black">Learn More</a>
    </div>
    <div class="img-left-absoulute">
        <figure class="position-relative m-0 text-center">
            <img src="<?= htmlspecialchars($ev_img) ?>" alt="" data-no-retina="" onerror="this.src='<?= base_url('assets/img/tab-img.jpg') ?>'">
        </figure>
    </div>
</div>
<?php else: ?>
<div class="card-box-gradiant border p-4">
    <div class="card-box-gradiant-header purple-dot"><h5 class="mb-0">Online study abroad plan meetup.</h5></div>
    <p class="mb-0 fs-14 text-black">New sessions coming soon. Check back or reach out to our counsellors.</p>
    <div class="img-left-absoulute"><figure class="position-relative m-0 text-center"><img src="<?= base_url('assets/img/tab-img.jpg') ?>" alt="" data-no-retina=""></figure></div>
</div>
<?php endif; ?>
