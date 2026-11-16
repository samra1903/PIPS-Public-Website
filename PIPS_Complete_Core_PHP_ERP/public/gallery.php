<?php require_once __DIR__.'/_bootstrap.php'; $pageTitle='Gallery'; require __DIR__.'/partials/header.php'; ?>
<main>
    <section class="page-hero">
        <div class="container">
            <div class="breadcrumbs"><a href="<?= BASE_URL ?>/public/index.php">Home</a> / Gallery</div><span
                class="eyebrow">Life at PIPS</span>
            <h1>School gallery</h1>
            <p>A space for sharing school activities, events and learning moments.</p>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="notice info">These are design placeholders. Replace them with approved photographs of your
                actual campus and activities before publishing.</div>
            <div class="gallery-grid">
                <div class="gallery-tile">Learning & Classrooms</div>
                <div class="gallery-tile">Student Activities</div>
                <div class="gallery-tile">Creative Projects</div>
                <div class="gallery-tile">Sports & Fitness</div>
                <div class="gallery-tile">School Events</div>
                <div class="gallery-tile">Community Moments</div>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__.'/partials/footer.php'; ?>