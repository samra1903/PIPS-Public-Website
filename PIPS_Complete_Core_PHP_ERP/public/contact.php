<?php
require_once __DIR__.'/_bootstrap.php'; $pageTitle='Contact Us'; $errors=[];$sent=false;
if($_SERVER['REQUEST_METHOD']==='POST'){try{check_csrf();$name=trim($_POST['name']??'');$email=trim($_POST['email']??'');$phone=trim($_POST['phone']??'');$subject=trim($_POST['subject']??'');$message=trim($_POST['message']??'');if($name===''||mb_strlen($name)>150)$errors[]='Enter your name.';if($email!==''&&!filter_var($email,FILTER_VALIDATE_EMAIL))$errors[]='Enter a valid email.';if($phone===''||mb_strlen($phone)>30)$errors[]='Enter your contact number.';if($subject===''||mb_strlen($subject)>180)$errors[]='Enter a subject.';if($message===''||mb_strlen($message)>5000)$errors[]='Enter a message (maximum 5000 characters).';if(!$errors){$s=$pdo->prepare('INSERT INTO contact_messages(name,email,phone,subject,message) VALUES(?,?,?,?,?)');$s->execute([$name,$email?:null,$phone,$subject,$message]);$sent=true;$_POST=[];}}catch(Throwable $e){$errors[]='Your message could not be saved. Please try again or contact the school office.';}}
require __DIR__.'/partials/header.php'; ?>
<main>
    <section class="page-hero">
        <div class="container">
            <div class="breadcrumbs"><a href="<?= BASE_URL ?>/public/index.php">Home</a> / Contact</div><span
                class="eyebrow">We are here to help</span>
            <h1>Contact PIPS</h1>
            <p>Send an enquiry to the school office. Please add verified campus contact details before the website goes
                live.</p>
        </div>
    </section>
    <section class="section">
        <div class="container split">
            <div>
                <h2>Get in touch</h2>
                <p>For admissions, class availability, school timings, fee information or general enquiries, please use
                    the form or contact the school office through its officially verified channels.</p>
                <div class="feature-panel">
                    <h3>School contact details</h3>
                    <p><b>Address:</b> Add official campus address</p>
                    <p><b>Phone:</b> Add official phone number</p>
                    <p><b>Email:</b> Add official school email</p>
                    <p class="help">These are placeholders, not verified contact details.</p>
                </div>
            </div>
            <div class="form-shell">
                <h2>Send an enquiry</h2><?php if($sent): ?><div class="notice">Thank you. Your message has been
                    submitted to the school system.</div><?php endif; ?><?php foreach($errors as $e): ?><div
                    class="notice error"><?= h($e) ?></div><?php endforeach; ?><form method="post"><input type="hidden"
                        name="csrf" value="<?= h(csrf()) ?>">
                    <div class="form-grid">
                        <div class="field"><label>Your name *</label><input name="name" required maxlength="150"
                                value="<?= h($_POST['name']??'') ?>"></div>
                        <div class="field"><label>Phone *</label><input name="phone" required maxlength="30"
                                value="<?= h($_POST['phone']??'') ?>"></div>
                        <div class="field full"><label>Email</label><input type="email" name="email"
                                value="<?= h($_POST['email']??'') ?>"></div>
                        <div class="field full"><label>Subject *</label><input name="subject" required maxlength="180"
                                value="<?= h($_POST['subject']??'') ?>"></div>
                        <div class="field full"><label>Message *</label><textarea name="message" required
                                maxlength="5000"><?= h($_POST['message']??'') ?></textarea></div>
                        <div class="field full"><button class="btn">Send enquiry</button></div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__.'/partials/footer.php'; ?>