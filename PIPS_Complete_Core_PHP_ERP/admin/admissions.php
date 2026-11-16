<?php
require_once __DIR__.'/../includes/init.php';
require_roles(['super_admin','principal','admin_officer']);
if($_SERVER['REQUEST_METHOD']==='POST'){check_csrf();$id=(int)($_POST['id']??0);$status=$_POST['status']??'';if($id>0&&in_array($status,['pending','under_review','documents_required','approved','rejected','enrolled'],true)){$s=$pdo->prepare('UPDATE admission_applications SET status=?, reviewed_by=?, reviewed_at=NOW() WHERE id=?');$s->execute([$status,(int)$_SESSION['user_id'],$id]);flash('Admission application status updated.');}go('admin/admissions.php');}
$rows=$pdo->query('SELECT a.*,u.full_name AS reviewer FROM admission_applications a LEFT JOIN users u ON u.id=a.reviewed_by ORDER BY a.created_at DESC')->fetchAll();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admission Applications</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/app.css">
</head>

<body><?php require __DIR__.'/../includes/header.php'; ?><main class="main">
        <section class="panel">
            <h1>Online Admission Applications</h1>
            <p>Review applications submitted through the public PIPS website.</p><?php show_flash(); ?><div
                style="overflow:auto">
                <table>
                    <thead>
                        <tr>
                            <th>Application</th>
                            <th>Student</th>
                            <th>Class</th>
                            <th>Guardian</th>
                            <th>Contact</th>
                            <th>Submitted</th>
                            <th>Status</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody><?php foreach($rows as $r): ?><tr>
                            <td><?= h($r['application_no']) ?></td>
                            <td><?= h($r['student_name']) ?><br><small><?= h($r['gender']) ?> ·
                                    <?= h($r['date_of_birth']) ?></small></td>
                            <td><?= h($r['applying_class']) ?></td>
                            <td><?= h($r['guardian_name']) ?></td>
                            <td><?= h($r['phone']) ?><br><?= h($r['email']) ?></td>
                            <td><?= h($r['created_at']) ?></td>
                            <td><?= h($r['status']) ?></td>
                            <td>
                                <form method="post"><input type="hidden" name="csrf" value="<?= h(csrf()) ?>"><input
                                        type="hidden" name="id" value="<?= (int)$r['id'] ?>"><select
                                        name="status"><?php foreach(['pending','under_review','documents_required','approved','rejected','enrolled'] as $st): ?>
                                        <option value="<?= h($st) ?>" <?= $r['status']===$st?'selected':'' ?>>
                                            <?= h(ucwords(str_replace('_',' ',$st))) ?></option>
                                        <?php endforeach; ?></select><button class="btn"
                                        style="margin-top:5px">Save</button></form>
                                <?php if($r['document_file']): ?><br><a
                                    href="<?= BASE_URL ?>/admin/admission_document.php?id=<?= (int)$r['id'] ?>">Download
                                    document</a><?php endif; ?>
                            </td>
                        </tr><?php endforeach; ?><?php if(!$rows): ?><tr>
                            <td colspan="8">No applications received yet.</td>
                        </tr><?php endif; ?></tbody>
                </table>
            </div>
        </section>
    </main><?php require __DIR__.'/../includes/footer.php'; ?></body>

</html>