<?php
require_once __DIR__.'/includes/init.php';require_login();$page_title='Dashboard';
$counts=[
 'Active students'=>(int)$pdo->query("SELECT COUNT(*) FROM students WHERE status='active'")->fetchColumn(),
 'Active staff'=>(int)$pdo->query("SELECT COUNT(*) FROM staff WHERE status='active'")->fetchColumn(),
 'Today attendance'=>(int)$pdo->query("SELECT COUNT(*) FROM student_attendance WHERE attendance_date=CURDATE()")->fetchColumn(),
 'Fee payments today'=>(float)$pdo->query("SELECT COALESCE(SUM(amount),0) FROM fee_payments WHERE paid_on=CURDATE()")->fetchColumn()
];require __DIR__.'/includes/header.php';?>
<h1>School Dashboard</h1><div class="stats"><?php foreach($counts as $k=>$v):?><div class="stat"><?=h($k)?><div class="num"><?=is_float($v)?number_format($v,2):$v?></div></div><?php endforeach;?></div>
<div class="panel"><h2>Welcome to PIPS ERP</h2><p>Manage student records, staff, academics, attendance, examinations, fees and communication from one place.</p><p class="muted">Before using real school data, configure individual accounts and role permissions, backup procedures and privacy controls.</p></div>
<?php require __DIR__.'/includes/footer.php';?>