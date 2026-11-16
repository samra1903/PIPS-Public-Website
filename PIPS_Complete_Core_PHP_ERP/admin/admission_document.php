<?php
require_once __DIR__.'/../includes/init.php';
require_roles(['super_admin','principal','admin_officer']);
$id=(int)($_GET['id']??0);
$stmt=$pdo->prepare('SELECT application_no,document_file FROM admission_applications WHERE id=?');
$stmt->execute([$id]);$app=$stmt->fetch();
if(!$app||empty($app['document_file'])){http_response_code(404);exit('Document not found.');}
$base=realpath(__DIR__.'/../storage/private_admissions');
$file=realpath(__DIR__.'/../storage/private_admissions/'.$app['document_file']);
if(!$base||!$file||strpos($file,$base.DIRECTORY_SEPARATOR)!==0||!is_file($file)){http_response_code(404);exit('Document not found.');}
$ext=strtolower(pathinfo($file,PATHINFO_EXTENSION));$types=['pdf'=>'application/pdf','jpg'=>'image/jpeg','jpeg'=>'image/jpeg','png'=>'image/png'];
if(!isset($types[$ext])){http_response_code(415);exit('Unsupported document type.');}
header('X-Content-Type-Options: nosniff');header('Content-Type: '.$types[$ext]);header('Content-Length: '.filesize($file));header('Content-Disposition: attachment; filename="'.preg_replace('/[^A-Za-z0-9_-]/','_', $app['application_no']).'_document.'.$ext.'"');readfile($file);exit;
