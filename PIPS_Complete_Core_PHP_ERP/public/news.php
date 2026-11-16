<?php require_once __DIR__.'/_bootstrap.php'; $pageTitle='News & Announcements'; $items=[]; try{$q=$pdo->prepare("SELECT title,message,publish_date FROM announcements WHERE publish_date<=CURDATE() AND audience IN ('all','students','parents') ORDER BY publish_date DESC LIMIT 30");$q->execute();$items=$q->fetchAll();}catch(Throwable $e){} require __DIR__.'/partials/header.php'; ?>
<main>
    <section class="page-hero">
        <div class="container">
            <div class="breadcrumbs"><a href="<?= BASE_URL ?>/public/index.php">Home</a> / News</div><span
                class="eyebrow">Stay informed</span>
            <h1>News & announcements</h1>
            <p>Updates published by the school for its community.</p>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="news-list"><?php if(!$items): ?><div class="empty">There are no public announcements at the
                    moment. Please check again later.</div><?php else: foreach($items as $item): ?><article
                    class="news-item">
                    <div class="news-date"><?= h(date('d M Y',strtotime($item['publish_date']))) ?></div>
                    <h3><?= h($item['title']) ?></h3>
                    <p><?= nl2br(h($item['message'])) ?></p>
                </article><?php endforeach; endif; ?></div>
        </div>
    </section>
</main>
<?php require __DIR__.'/partials/footer.php'; ?>