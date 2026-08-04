<div class="row" id="kanbanBoard">
    <!-- Journey Map Column -->
    <div class="col-lg-3">
        <div class="card-white-box">
            <h5 class="mb-2 fs-22 fw-500 text-black text-uppercase">JOURNEY MAP</h5>
            <div class="kanban-column" data-section="journey_map" style="min-height: 400px; max-height: 600px; overflow-y: auto;">
                <?php if(isset($kanban_cards['journey_map']) && count($kanban_cards['journey_map']) > 0): ?>
                    <?php foreach($kanban_cards['journey_map'] as $card): ?>
                        <?php include('kanban_card_item.php'); ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-muted text-center py-3">
                        <p class="mb-0">No cards yet. Drag cards here or add new ones.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- In Progress Column -->
    <div class="col-lg-3">
        <div class="card-white-box">
            <h5 class="mb-2 fs-22 fw-500 text-black text-uppercase">IN PROGRESS</h5>
            <div class="kanban-column" data-section="in_progress" style="min-height: 400px; max-height: 600px; overflow-y: auto;">
                <?php if(isset($kanban_cards['in_progress']) && count($kanban_cards['in_progress']) > 0): ?>
                    <?php foreach($kanban_cards['in_progress'] as $card): ?>
                        <?php include('kanban_card_item.php'); ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-muted text-center py-3">
                        <p class="mb-0">No cards yet. Drag cards here or add new ones.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Draft Phase Column -->
    <div class="col-lg-3">
        <div class="card-white-box">
            <h5 class="mb-2 fs-22 fw-500 text-black text-uppercase">draft phase</h5>
            <div class="kanban-column" data-section="draft_phase" style="min-height: 400px; max-height: 600px; overflow-y: auto;">
                <?php if(isset($kanban_cards['draft_phase']) && count($kanban_cards['draft_phase']) > 0): ?>
                    <?php foreach($kanban_cards['draft_phase'] as $card): ?>
                        <?php include('kanban_card_item.php'); ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-muted text-center py-3">
                        <p class="mb-0">No cards yet. Drag cards here or add new ones.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Completed Column -->
    <div class="col-lg-3">
        <div class="card-white-box">
            <h5 class="mb-2 fs-22 fw-500 text-black text-uppercase">completed</h5>
            <div class="kanban-column" data-section="completed" style="min-height: 400px; max-height: 600px; overflow-y: auto;">
                <?php if(isset($kanban_cards['completed']) && count($kanban_cards['completed']) > 0): ?>
                    <?php foreach($kanban_cards['completed'] as $card): ?>
                        <?php include('kanban_card_item.php'); ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-muted text-center py-3">
                        <p class="mb-0">No cards yet. Drag cards here or add new ones.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
