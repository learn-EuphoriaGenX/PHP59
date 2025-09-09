<!-- POPULAR NOTES SECTION -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">📘 Popular Notes</h2>
        <div class="row g-4">

            <?php
            $stmt = $conn->prepare("SELECT * FROM notes");
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
                                        Read More
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
    .note-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .note-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
    }
</style>