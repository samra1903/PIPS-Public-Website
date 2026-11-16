<?php require_once __DIR__.'/_bootstrap.php'; $pageTitle='Academics'; require __DIR__.'/partials/header.php'; ?>
<main>
    <section class="page-hero">
        <div class="container">
            <div class="breadcrumbs"><a href="<?= BASE_URL ?>/public/index.php">Home</a> / Academics</div><span
                class="eyebrow">Learning & development</span>
            <h1>Academic programmes</h1>
            <p>A purposeful learning journey built around knowledge, skills and character.</p>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="section-head">
                <h2>Learning at every stage</h2>
                <p>Our programme information should be aligned with the grades, curriculum and subjects officially
                    offered at your campus. Please contact the school office to confirm current class availability.</p>
            </div>
            <div class="cards">
                <article class="card">
                    <div class="card-icon">01</div>
                    <h3>Early Learning</h3>
                    <p>Building curiosity, communication, early literacy, numeracy and social skills through
                        age-appropriate learning.</p>
                </article>
                <article class="card">
                    <div class="card-icon">02</div>
                    <h3>Primary Learning</h3>
                    <p>Strengthening foundational concepts, independent thinking, reading, writing and problem-solving
                        skills.</p>
                </article>
                <article class="card">
                    <div class="card-icon">03</div>
                    <h3>Middle & Secondary</h3>
                    <p>Developing subject understanding, analytical thinking, study habits and preparation for further
                        learning.</p>
                </article>
            </div>
        </div>
    </section>
    <section class="section section-soft">
        <div class="container split">
            <div>
                <h2>Beyond academic subjects</h2>
                <p>Learning also includes communication, teamwork, creativity, digital awareness, healthy habits and
                    responsible citizenship.</p>
            </div>
            <div class="feature-panel">
                <h3>Academic information</h3>
                <p>For the current curriculum, subject list, class timings, assessment schedule and available grades,
                    please contact the school office.</p><a class="btn"
                    href="<?= BASE_URL ?>/public/contact.php">Contact the school</a>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__.'/partials/footer.php'; ?>