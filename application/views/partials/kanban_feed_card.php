<?php
/** @var object $card kanban_cards row */
$card_is_hex = preg_match('/^#[0-9A-Fa-f]{6}$/', $card->card_type ?? '');
$card_inner_class = $card_is_hex ? 'card-sm mb-3' : (htmlspecialchars($card->card_type) . ' card-sm mb-3');
$card_inner_style = $card_is_hex ? 'background-color:' . htmlspecialchars($card->card_type) . '; color:#fff; border-radius:8px; padding:12px;' : '';

$stageTs = null;
$sec = $card->section ?? '';
if ($sec === 'in_progress' && isset($card->entered_in_progress_at) && $card->entered_in_progress_at !== '') {
    $stageTs = $card->entered_in_progress_at;
} elseif ($sec === 'draft_phase' && isset($card->entered_draft_phase_at) && $card->entered_draft_phase_at !== '') {
    $stageTs = $card->entered_draft_phase_at;
} elseif ($sec === 'completed' && isset($card->entered_completed_at) && $card->entered_completed_at !== '') {
    $stageTs = $card->entered_completed_at;
}
?>
<div class="<?= $card_inner_class ?>"<?= $card_inner_style !== '' ? ' style="' . $card_inner_style . '"' : '' ?>>
    <?php if ($card->title || $card->tag): ?>
    <div class="d-flex justify-content-space mb-2">
        <?php if ($card->title): ?>
            <h6 class="mb-0 fs-14 fw-700"><?= htmlspecialchars($card->title) ?></h6>
        <?php endif; ?>
        <?php if ($card->tag): ?>
            <span class="highlight-tag"><?= htmlspecialchars($card->tag) ?></span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php if ($card->description): ?>
        <?php if ($card->description_type == 'list'): ?>
            <?php
            $list_items = json_decode($card->description, true);
            if (!is_array($list_items)) {
                $list_items = explode("\n", $card->description);
            }
            ?>
            <ul>
                <?php foreach ($list_items as $item): ?><li><?= htmlspecialchars(trim((string) $item)) ?></li><?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="mb-0 fs-12 lh-12 fw-400"><?= nl2br(htmlspecialchars($card->description)) ?></p>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ($stageTs): ?>
        <?php
            // Timestamps are stored in IST; parse as IST to avoid shifting.
            $dt = new DateTime((string) $stageTs, new DateTimeZone('Asia/Kolkata'));
        ?>
        <div class="mt-1 opacity-75 kanban-card-stage-ts" style="font-size:10px;line-height:1.3;"><?= htmlspecialchars($dt->format('d M Y, H:i')) ?> IST</div>
    <?php endif; ?>
</div>
