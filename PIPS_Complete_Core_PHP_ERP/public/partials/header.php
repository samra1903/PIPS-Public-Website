<?php
$pageTitle = $pageTitle ?? 'PIPS School System';
$currentPage = basename($_SERVER['PHP_SELF'] ?? 'index.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PIPS School System — learning, character building and personal development.">
    <title><?= h($pageTitle) ?> | PIPS School System</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/public.css">
</head>

<body>
    <div class="topbar">
        <div class="container topbar-inner"><span>Welcome to PIPS School System</span><span>Admissions & general
                enquiries: contact the school office</span></div>
    </div>
    <header class="site-header">
        <div class="container nav-wrap">
            <a class="logo" href="<?= BASE_URL ?>/public/index.php"><span
                    class="logo-mark">P</span><span><b>PIPS</b><small>School System</small></span></a>
            <button class="menu-toggle" type="button" aria-label="Toggle navigation" aria-expanded="false"
                onclick="document.querySelector('.nav-links').classList.toggle('open');this.setAttribute('aria-expanded',this.getAttribute('aria-expanded')==='true'?'false':'true')">☰</button>
            <nav class="nav-links" aria-label="Main navigation">
                <a class="<?= $currentPage==='index.php'?'active':'' ?>"
                    href="<?= BASE_URL ?>/public/index.php">Home</a>
                <a class="<?= $currentPage==='about.php'?'active':'' ?>"
                    href="<?= BASE_URL ?>/public/about.php">About</a>
                <a class="<?= $currentPage==='academics.php'?'active':'' ?>"
                    href="<?= BASE_URL ?>/public/academics.php">Academics</a>
                <a class="<?= $currentPage==='admissions.php'?'active':'' ?>"
                    href="<?= BASE_URL ?>/public/admissions.php">Admissions</a>
                <a class="<?= $currentPage==='news.php'?'active':'' ?>" href="<?= BASE_URL ?>/public/news.php">News</a>
                <a class="<?= $currentPage==='gallery.php'?'active':'' ?>"
                    href="<?= BASE_URL ?>/public/gallery.php">Gallery</a>
                <a class="<?= $currentPage==='contact.php'?'active':'' ?>"
                    href="<?= BASE_URL ?>/public/contact.php">Contact</a>
                    <a href="<?= BASE_URL ?>/public/assignment.php">Assignment</a>
                <a class="nav-login" href="<?= BASE_URL ?>/login.php">Staff Login</a>
            </nav>
        </div>
    </header>