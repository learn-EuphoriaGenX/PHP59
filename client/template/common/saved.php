<div class="container my-5">
    <h1 class="mb-4 text-success fw-bold text-center">⭐ Saved Notes</h1>

    <?php
    $user_id = $_SESSION["id"];
    $stmt = $conn->prepare("SELECT * FROM saved_notes WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
            $stmt2 = $conn->prepare("SELECT * FROM notes WHERE id = ?");
            $stmt2->bind_param("i", $row['note_id']);
            $stmt2->execute();
            $noteResult = $stmt2->get_result();
            $in_row = $noteResult->fetch_assoc();
            ?>
            <!-- Saved Note Item -->
            <div class="card mb-3 shadow-sm rounded-3 overflow-hidden">
                <div class="row g-0 align-items-center">

                    <!-- Thumbnail -->
                    <div class="col-md-2 text-center bg-light">
                        <img src="server/uploads/thumb/<?php echo $in_row['thumbnail'] ?>" class="img-fluid rounded-start p-2"
                            alt="Notes Thumbnail" style="max-height:120px; object-fit:cover;">
                    </div>

                    <!-- Title & Description -->
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark mb-1">
                                <?php echo $in_row['title'] ?>
                            </h5>
                            <p class="card-text text-muted small"
                                style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                <?php echo $in_row['description'] ?>
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-3 text-center p-3">
                        <a href="?details=<?php echo $in_row['id'] ?>" class="btn btn-success w-75 mb-2 rounded-pill">
                            👁️ View
                        </a>
                        <button class="btn btn-outline-danger w-75 rounded-pill">
                            ❌ Remove
                        </button>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
    else: ?>
        <!-- Empty State -->
        <div class="text-center my-5">
            <div class="card border-0 shadow-sm p-5 d-inline-block">
                <h4 class="text-muted mb-2">📭 No Saved Notes</h4>
                <p class="small text-secondary">Start saving notes to find them here!</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Custom CSS -->
<style>
    .card:hover {
        transform: translateY(-3px);
        transition: all 0.2s ease-in-out;
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    }
</style>