<?php
require_once __DIR__.'/../includes/init.php';require_login();$page_title='Subjects';$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){check_csrf();$data=[];$data['subject_code']=trim($_POST['subject_code']??'');$data['subject_name']=trim($_POST['subject_name']??'');$data['class_name']=trim($_POST['class_name']??'');
 try{$q=$pdo->prepare("INSERT INTO subjects (subject_code,subject_name,class_name) VALUES (?,?,?)");$q->execute([$data['subject_code'],$data['subject_name'],$data['class_name']]);flash('Subjects record saved.');go('subjects/index.php');}catch(Throwable $e){$error='Unable to save record. Check required fields and duplicate values.';}
}
$rows=$pdo->query("SELECT id,subject_code,subject_name,class_name FROM subjects ORDER BY id DESC LIMIT 500")->fetchAll();
require __DIR__.'/../includes/header.php';?>
<h1>Subjects</h1><?php if($error):?><div class="notice error"><?=h($error)?></div><?php endif;?>
<div class="panel"><h2>Add new record</h2><form method="post"><input type="hidden" name="csrf" value="<?=h(csrf())?>"><div class="formgrid"><div><label>Subject code</label><input type="text" name="subject_code" required></div><div><label>Subject name</label><input type="text" name="subject_name" required></div><div><label>Class</label><input type="text" name="class_name" required></div></div><button>Save record</button></form></div>
<div class="panel"><h2>Records</h2><div class="tablewrap"><table><tr><th>Subject code</th><th>Subject name</th><th>Class</th></tr><?php foreach($rows as $r):?><tr><td><?=h($r["subject_code"])?></td><td><?=h($r["subject_name"])?></td><td><?=h($r["class_name"])?></td></tr><?php endforeach;?><?php if(!$rows):?><tr><td colspan="3">No records found.</td></tr><?php endif;?></table></div></div>
<?php require __DIR__.'/../includes/footer.php';?>