<?php
$notes_id = $_GET["details"];
$stmt = $conn->prepare("SELECT * FROM notes WHERE id = ?");
$stmt->bind_param("i", $notes_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
    $uploaded_by = $row["uploaded_by"];
    $stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
    $stmt->bind_param("i", $uploaded_by);
    $stmt->execute();
    $uploder_result = $stmt->get_result();
    $name = $uploder_result->fetch_assoc()["name"];
}
?>

<!-- Note Details -->
<div class="container my-5">
    <?php if ($result->num_rows > 0): ?>
        <h2 class="text-center fw-bold mb-4 text-success">📝 Note Details</h2>
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden note-details">
            <div class="row g-0">
                <!-- Thumbnail -->
                <div class="col-md-5">
                    <img src="server/uploads/thumb/<?php echo $row['thumbnail']; ?>"
                        class="img-fluid h-100 w-100 object-fit-cover" alt="Notes Thumbnail">
                </div>

                <!-- Details -->
                <div class="col-md-7 bg-white">
                    <div class="card-body p-4 d-flex flex-column h-100">
                        <h2 class="card-title fw-bold text-dark mb-3"><?php echo $row['title'] ?></h2>
                        <p class="card-text text-muted mb-4" style="line-height: 1.6;">
                            <?php echo $row['description'] ?>
                        </p>

                        <!-- Publisher -->
                        <div class="mb-4">
                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                👤 Published by <?php echo $name ?>
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-auto d-flex gap-3">
                            <form action="server\common.php" method="POST">
                                <input name="note_id" type="hidden" value="<?php echo $row['id']; ?>" />
                                <button name="saved_btn" class="btn btn-outline-success rounded-pill px-4">
                                    ⭐ Save Note
                                </button>
                            </form>
                            <a href="server/uploads/zips/<?php echo $row['file_path'] ?>" download
                                class="btn btn-success rounded-pill px-4">
                                ⬇️ Download Note
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center fw-bold rounded-pill shadow-sm">
            📭 No Data Found
        </div>

    <?php endif; ?>
</div>

<!-- RECENT NOTES SECTION -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">📘 Recent Notes</h2>
        <div class="row g-4">

            <?php
            $stmt = $conn->prepare("SELECT * FROM notes ORDER BY id DESC LIMIT 6");
            $stmt->execute();
            $result = $stmt->get_result();
            ?>

            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-lg border-0 rounded-4 overflow-hidden note-card">
                            <!-- Thumbnail -->
                            <div class="ratio ratio-16x9">
                                <img src="server/uploads/thumb/<?php echo $row['thumbnail'] ?>" class="card-img-top"
                                    alt="Note Thumbnail" style="object-fit: cover;">
                            </div>

                            <!-- Content -->
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-truncate">
                                    <?php echo $row['title'] ?>
                                </h5>
                                <p class="card-text text-muted small"
                                    style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                    <?php echo $row['description'] ?>
                                </p>
                                <div class="mt-auto">
                                    <a href="?details=<?php echo $row['id'] ?>" class="btn btn-success w-100 rounded-pill">
                                        📖 Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center text-muted">No Notes Found 📭</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Custom CSS -->
<style>
    .note-details {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .note-details:hover {
        transform: translateY(-5px);
        box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.15);
    }

    .note-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .note-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.1);
    }

    .object-fit-cover {
        object-fit: cover;
    }
</style>