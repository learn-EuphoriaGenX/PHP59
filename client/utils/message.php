<?php if (isset($_SESSION['error_msg']) || isset($_SESSION['success_msg'])): ?>
    <div class="position-fixed " style="right: 10px; bottom:10px">
        <div class="alert <?php echo (isset($_SESSION['error_msg']) ? 'alert-danger' : 'alert-success'); ?> alert-dismissible fade show"
            role="alert">
            <?php
            if (isset($_SESSION['error_msg'])) {
                echo '<strong>Error!</strong>' . " " . $_SESSION['error_msg'];
                session_destroy();
            }
            if (isset($_SESSION['success_msg'])) {
                echo '<strong>Success!</strong>' . $_SESSION['success_msg'];
                session_destroy();
            }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

<?php endif; ?>