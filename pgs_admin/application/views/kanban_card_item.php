<?php
$is_hex_color = preg_match('/^#[0-9A-Fa-f]{6}$/', $card->card_type ?? '');
$inner_class = 'card-sm mb-3';
$inner_style = '';
if ($is_hex_color) {
    // Frontend cards use .card-sm for radius/padding/shadow; only set background color here.
    $inner_style = 'background-color:' . htmlspecialchars($card->card_type) . ';';
} else {
    $inner_class = htmlspecialchars($card->card_type) . ' ' . $inner_class;
}
?>
<div class="kanban-card mb-3" data-card-id="<?= $card->id ?>" draggable="true" style="cursor: move; position: relative;">
    <div class="<?= $inner_class ?>" data-card-type="<?= htmlspecialchars($card->card_type ?? '') ?>"<?= $inner_style ? ' style="' . $inner_style . '"' : '' ?>>
        <?php if($card->title || $card->tag): ?>
        <div class="d-flex justify-content-space mb-2">
            <?php if($card->title): ?>
                <h6 class="mb-0 fs-14 fw-700"><?= htmlspecialchars($card->title) ?></h6>
            <?php endif; ?>
            <?php if($card->tag): ?>
                <span class="highlight-tag"><?= htmlspecialchars($card->tag) ?></span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <?php if($card->description): ?>
            <?php if($card->description_type == 'list'): ?>
                <?php 
                $list_items = json_decode($card->description, true);
                if(!is_array($list_items)) {
                    $list_items = explode("\n", $card->description);
                }
                ?>
                <ul>
                    <?php foreach($list_items as $item): ?>
                        <li><?= htmlspecialchars(trim($item)) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="mb-0 fs-12 lh-12 fw-400"><?= nl2br(htmlspecialchars($card->description)) ?></p>
            <?php endif; ?>
        <?php endif; ?>
        <?php
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
        <?php if ($stageTs): ?>
            <?php
                // Timestamps are stored in IST; parse as IST to avoid shifting.
                $dt = new DateTime((string) $stageTs, new DateTimeZone('Asia/Kolkata'));
            ?>
            <div class="kanban-card-stage-ts text-muted mt-1" style="font-size: 10px; line-height: 1.3; opacity: 0.9;"><?= htmlspecialchars($dt->format('d M Y, H:i')) ?> IST</div>
        <?php endif; ?>
    </div>
    
    <!-- Admin Actions - Floating overlay -->
    <div class="card-actions" style="position: absolute; top: 5px; right: 5px; display: none; z-index: 10;">
        <button type="button" class="btn btn-xs btn-primary edit-kanban-card" data-card-id="<?= $card->id ?>" style="padding: 2px 6px; font-size: 11px;">
            <i class="mdi mdi-pencil"></i>
        </button>
        <button type="button" class="btn btn-xs btn-danger delete-kanban-card" data-card-id="<?= $card->id ?>" style="padding: 2px 6px; font-size: 11px;">
            <i class="mdi mdi-delete"></i>
        </button>
    </div>
</div>
