<?php
require_once __DIR__.'/_bootstrap.php';
$pageTitle='Online Admissions';
$errors=[]; $success=''; $applicationNo='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  try {
    check_csrf();
    $student=trim($_POST['student_name']??''); $dob=trim($_POST['date_of_birth']??''); $gender=trim($_POST['gender']??'');
    $class=trim($_POST['applying_class']??''); $guardian=trim($_POST['guardian_name']??''); $phone=trim($_POST['phone']??'');
    $email=trim($_POST['email']??''); $address=trim($_POST['address']??''); $previous=trim($_POST['previous_school']??'');
    if($student===''||mb_strlen($student)>150) $errors[]='Enter the student name (maximum 150 characters).';
    if($dob===''||!preg_match('/^\d{4}-\d{2}-\d{2}$/',$dob)||strtotime($dob)===false) $errors[]='Enter a valid date of birth.';
    if(!in_array($gender,['Male','Female','Other'],true)) $errors[]='Select a gender.';
    if($class==='') $errors[]='Select the class for which you are applying.';
    if($guardian===''||mb_strlen($guardian)>150) $errors[]='Enter the parent/guardian name.';
    if($phone===''||mb_strlen($phone)>30) $errors[]='Enter a valid contact number.';
    if($email!==''&&!filter_var($email,FILTER_VALIDATE_EMAIL)) $errors[]='Enter a valid email address.';
    if($address==='') $errors[]='Enter your residential address.';
    if(empty($_POST['consent'])) $errors[]='Please confirm that the information is correct.';
    $docName=null;
    if(!$errors && !empty($_FILES['document']['name'])){
      $file=$_FILES['document'];
      if($file['error']!==UPLOAD_ERR_OK||$file['size']>5*1024*1024) throw new RuntimeException('Document upload failed. Maximum file size is 5 MB.');
      $finfo=new finfo(FILEINFO_MIME_TYPE); $mime=$finfo->file($file['tmp_name']);
      $allowed=['application/pdf'=>'pdf','image/jpeg'=>'jpg','image/png'=>'png'];
      if(!isset($allowed[$mime])) throw new RuntimeException('Only PDF, JPG and PNG documents are accepted.');
      $docName=bin2hex(random_bytes(18)).'.'.$allowed[$mime];
      $privateDir=dirname(__DIR__).'/storage/private_admissions';
      if(!is_dir($privateDir)&&!mkdir($privateDir,0750,true)) throw new RuntimeException('Unable to prepare secure document storage.');
      if(!move_uploaded_file($file['tmp_name'],$privateDir.'/'.$docName)) throw new RuntimeException('Could not save the uploaded document.');
    }
    if(!$errors){
      $applicationNo='PIPS-'.date('ym').'-'.strtoupper(bin2hex(random_bytes(3)));
      $stmt=$pdo->prepare('INSERT INTO admission_applications (application_no,student_name,date_of_birth,gender,applying_class,guardian_name,phone,email,address,previous_school,document_file,status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
      $stmt->execute([$applicationNo,$student,$dob,$gender,$class,$guardian,$phone,$email?:null,$address,$previous?:null,$docName,'pending']);
      $success='Your application has been submitted. Keep your application number safe.';
      $_POST=[];
    }
  } catch(Throwable $e){$errors[]=$e instanceof PDOException?'We could not save your application. Please check the database setup and try again.':$e->getMessage();}
}
require __DIR__.'/partials/header.php';
?>
<main>
    <section class="page-hero">
        <div class="container">
            <div class="breadcrumbs"><a href="<?= BASE_URL ?>/public/index.php">Home</a> / Admissions</div><span
                class="eyebrow">Start your journey</span>
            <h1>Online admission application</h1>
            <p>Complete the form below. The school office will review your application and contact you using the details
                provided.</p>
        </div>
    </section>
    <section class="section section-soft">
        <div class="container">
            <div class="form-shell">
                <h2>Student application form</h2>
                <p>Fields marked with <span class="required">*</span> are required. Submitting this form is an
                    application, not a confirmed admission.</p>
                <?php if($success): ?><div class="notice"><?= h($success) ?><br><strong>Application No:
                        <?= h($applicationNo) ?></strong></div><?php endif; ?>
                <?php foreach($errors as $err): ?><div class="notice error"><?= h($err) ?></div><?php endforeach; ?>
                <form method="post" enctype="multipart/form-data"><input type="hidden" name="csrf"
                        value="<?= h(csrf()) ?>">
                    <div class="form-grid">
                        <div class="field"><label>Student full name <span class="required">*</span></label><input
                                name="student_name" maxlength="150" required
                                value="<?= h($_POST['student_name']??'') ?>"></div>
                        <div class="field"><label>Date of birth <span class="required">*</span></label><input
                                type="date" name="date_of_birth" required value="<?= h($_POST['date_of_birth']??'') ?>">
                        </div>
                        <div class="field"><label>Gender <span class="required">*</span></label><select name="gender"
                                required>
                                <option value="">Select</option><?php foreach(['Male','Female','Other'] as $g): ?>
                                <option <?= (($_POST['gender']??'')===$g?'selected':'') ?>><?= h($g) ?></option>
                                <?php endforeach; ?>
                            </select></div>
                        <div class="field"><label>Applying for class <span class="required">*</span></label><select
                                name="applying_class" required>
                                <option value="">Select class</option>
                                <?php foreach(['Playgroup','Nursery','Prep','Kindergarten','Grade 1','Grade 2','Grade 3','Grade 4','Grade 5','Grade 6','Grade 7','Grade 8','Grade 9','Grade 10','Other'] as $c): ?>
                                <option <?= (($_POST['applying_class']??'')===$c?'selected':'') ?>><?= h($c) ?></option>
                                <?php endforeach; ?>
                            </select><span class="help">Confirm available grades with the school office.</span></div>
                        <div class="field"><label>Parent / guardian full name <span
                                    class="required">*</span></label><input name="guardian_name" maxlength="150"
                                required value="<?= h($_POST['guardian_name']??'') ?>"></div>
                        <div class="field"><label>Contact number <span class="required">*</span></label><input
                                name="phone" maxlength="30" required value="<?= h($_POST['phone']??'') ?>"
                                placeholder="03XXXXXXXXX"></div>
                        <div class="field"><label>Email address</label><input type="email" name="email" maxlength="190"
                                value="<?= h($_POST['email']??'') ?>"></div>
                        <div class="field"><label>Previous school</label><input name="previous_school" maxlength="180"
                                value="<?= h($_POST['previous_school']??'') ?>"></div>
                        <div class="field full"><label>Residential address <span
                                    class="required">*</span></label><textarea name="address"
                                required><?= h($_POST['address']??'') ?></textarea></div>
                        <div class="field full"><label>Supporting document (optional)</label><input type="file"
                                name="document" accept=".pdf,.jpg,.jpeg,.png"><span class="help">PDF, JPG or PNG;
                                maximum 5 MB. Uploads are stored privately for authorized staff review.</span></div>
                        <div class="field full"><label
                                style="display:flex;gap:10px;align-items:flex-start;font-weight:500"><input
                                    type="checkbox" name="consent" value="1" required style="width:auto;margin-top:5px">
                                I confirm that the information provided is accurate and understand that this is an
                                application only, subject to school review.</label></div>
                        <div class="field full"><button class="btn" type="submit">Submit admission application
                                →</button></div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__.'/partials/footer.php'; ?>