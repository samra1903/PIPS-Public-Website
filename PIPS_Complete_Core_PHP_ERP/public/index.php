<?php require_once __DIR__.'/_bootstrap.php'; $pageTitle='Welcome'; require __DIR__.'/partials/header.php'; ?>
<main>
    <section class="hero">
        <div class="container hero-grid">
            <div><span class="eyebrow">A place to learn and grow</span>
                <h1>Building knowledge. <span style="color:#168f9b">Shaping character.</span></h1>
                <p>At PIPS School System, we believe education is a partnership between students, parents and teachers.
                    We aim to create a supportive environment for learning, confidence, responsibility and personal
                    development.</p>
                <div class="actions"><a class="btn btn-gold" href="<?= BASE_URL ?>/public/admissions.php">Apply for
                        Admission →</a><a class="btn btn-outline" href="<?= BASE_URL ?>/public/about.php">Discover
                        PIPS</a></div>
            </div>
            <div class="hero-art">
                <div class="art-card"><strong>Every learner matters.</strong><span>Learning, character building and
                        personal development.</span></div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="section-head center"><span class="eyebrow">The PIPS approach</span>
                <h2>Education beyond the classroom</h2>
                <p>We focus on the academic and personal development of every learner through a positive and purposeful
                    school experience.</p>
            </div>
            <div class="cards">
                <article class="card">
                    <div class="card-icon">✦</div>
                    <h3>Academic Growth</h3>
                    <p>Structured learning, clear goals and continuous development help learners build strong
                        foundations.</p>
                </article>
                <article class="card">
                    <div class="card-icon">◎</div>
                    <h3>Character & Values</h3>
                    <p>Respect, responsibility, honesty and kindness are important parts of a supportive learning
                        community.</p>
                </article>
                <article class="card">
                    <div class="card-icon">⌁</div>
                    <h3>Personal Development</h3>
                    <p>Opportunities to develop confidence, communication, creativity and collaboration.</p>
                </article>
            </div>
        </div>
    </section>
    <section class="section section-soft">
        <div class="container split">
            <div><span class="eyebrow">Learning journey</span>
                <h2>Helping students become confident learners</h2>
                <p>Every student brings unique strengths, interests and ambitions. Our aim is to encourage curiosity,
                    effort and a sense of responsibility throughout the learning journey.</p><a class="btn"
                    href="<?= BASE_URL ?>/public/academics.php">Explore academics</a>
            </div>
            <div class="feature-panel">
                <h3>Our learning priorities</h3>
                <ul>
                    <li>Supportive and respectful learning environment</li>
                    <li>Strong foundational knowledge and skills</li>
                    <li>Positive communication between school and families</li>
                    <li>Balanced academic and personal growth</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="cta">
                <div>
                    <h2>Take the next step with PIPS</h2>
                    <p>Explore the admission process or contact the school office for guidance.</p>
                </div><a class="btn btn-gold" href="<?= BASE_URL ?>/public/admissions.php">Online Admission Application
                    →</a>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__.'/partials/footer.php'; ?>