<?php
function h($v): string { return htmlspecialchars((string)($v??''),ENT_QUOTES,'UTF-8'); }
function logged_in(): bool { return !empty($_SESSION['user_id']); }
function require_login(): void { if(!logged_in()){header('Location: '.BASE_URL.'/login.php');exit;} }
function require_roles(array $roles): void { require_login(); if(!in_array($_SESSION['role']??'', $roles, true)){http_response_code(403);exit('Access denied.');} }
function csrf(): string { if(empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function check_csrf(): void { if(!hash_equals($_SESSION['csrf']??'',$_POST['csrf']??'')){http_response_code(419);exit('Invalid form token. Refresh and try again.');} }
function flash(string $msg, string $type='success'): void { $_SESSION['flash']=['msg'=>$msg,'type'=>$type]; }
function show_flash(): void { if(!empty($_SESSION['flash'])) { $f=$_SESSION['flash']; echo '<div class="notice '.h($f['type']).'">'.h($f['msg']).'</div>'; unset($_SESSION['flash']); } }
function go(string $path): never { header('Location: '.BASE_URL.'/'.$path); exit; }
function upload_file(string $field, array $allowed, int $max=5242880): ?string {
 if(empty($_FILES[$field]['name'])) return null;
 if($_FILES[$field]['error']!==UPLOAD_ERR_OK || $_FILES[$field]['size']>$max) throw new RuntimeException('File upload failed or file is too large.');
 $finfo=new finfo(FILEINFO_MIME_TYPE); $mime=$finfo->file($_FILES[$field]['tmp_name']);
 if(!isset($allowed[$mime])) throw new RuntimeException('Unsupported file type.');
 $ext=$allowed[$mime]; $name=bin2hex(random_bytes(16)).'.'.$ext;
 $dir=UPLOAD_DIR;
 if(!is_dir($dir)) mkdir($dir,0750,true);
 if(!move_uploaded_file($_FILES[$field]['tmp_name'],$dir.'/'.$name)) throw new RuntimeException('Could not save uploaded file.');
 return $name;
}
