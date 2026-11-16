<?php require_once __DIR__.'/init.php'; require_login(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?=h($page_title??APP_NAME)?></title>
    <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/app.css">
</head>

<body>
    <header class="top"><a href="<?=BASE_URL?>/dashboard.php" class="brand">PIPS <small>School
                System</small></a><span><?=h($_SESSION['name']??'') ?> · <?=h($_SESSION['role']??'')?> · <a
                href="<?=BASE_URL?>/logout.php">Logout</a></span></header>
    <div class="shell">
        <nav class="side">
            <a href="<?=BASE_URL?>/dashboard.php">Dashboard</a>
            <a href="<?=BASE_URL?>/students/index.php">Students</a><a href="<?=BASE_URL?>/staff/index.php">Staff</a>
            <a href="<?=BASE_URL?>/academics/classes.php">Classes & Sections</a><a
                href="<?=BASE_URL?>/academics/subjects.php">Subjects</a>
            <a href="<?=BASE_URL?>/attendance/index.php">Student Attendance</a><a
                href="<?=BASE_URL?>/attendance/staff.php">Staff Attendance</a>
            <a href="<?=BASE_URL?>/exams/index.php">Examinations</a><a href="<?=BASE_URL?>/exams/papers.php">Question
                Papers</a><a href="<?=BASE_URL?>/exams/marks.php">Marks</a>
            <a href="<?=BASE_URL?>/fees/index.php">Fee Payments</a><a href="<?=BASE_URL?>/fees/appreciation.php">Fee
                Appreciation</a>
                <a href="<?=BASE_URL?>/admin/admissions.php">
    Admission Applications
</a>

<a href="<?=BASE_URL?>/admin/contact_messages.php">
    Contact Messages
</a>
            <a href="<?=BASE_URL?>/parents/index.php">Guardians</a><a
                href="<?=BASE_URL?>/announcements/index.php">Announcements</a>
            <a href="<?=BASE_URL?>/reports/index.php">Reports</a><a href="<?=BASE_URL?>/users/index.php">User
                Accounts</a>
            <!-- <a href="<?=BASE_URL?>/../public/index.php">Public Website</a> -->
             <a href="<?=BASE_URL?>/public/index.php">Public Website</a>

        </nav>
        <main class="main"><?php show_flash(); ?>