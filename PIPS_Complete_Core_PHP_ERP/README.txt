PIPS SCHOOL SYSTEM - CORE PHP OFFLINE PROJECT

INSTALLATION
1. Extract this folder to C:\xampp\htdocs\PIPS_Complete_Core_PHP_ERP
2. Start Apache and MySQL in XAMPP.
3. Open http://localhost/phpmyadmin
4. Import database/schema.sql (it creates database pips_school_erp).
5. Open config/database.php. Default XAMPP username is root and password blank. Change if yours differs.
6. Visit http://localhost/PIPS_Complete_Core_PHP_ERP/setup_admin.php
7. Create first administrator with strong password (12+ chars).
8. DELETE setup_admin.php immediately.
9. Visit http://localhost/PIPS_Complete_Core_PHP_ERP/login.php
10. Login.

MODULES PROVIDED
Public landing page; login/logout; dashboard; student records; staff records; classes/sections; subjects; student attendance; staff attendance; exams; question-paper PDF archive; marks; fee payments; fee-appreciation monthly records; guardian records; announcements; basic reports; user account creation.

NOTES / LIMITATIONS
This is a functional learning/MVP foundation, not a fully production-certified school ERP.
- CRUD pages currently add/list records; edit/delete workflows and audit trails still need implementation.
- Parent/student login portal, detailed fee invoices/dues, report-card PDF, timetables, homework, leave, salary/payroll, SMS/email, biometric/QR attendance and advanced analytics are not implemented yet.
- Confirm PIPS's fee-appreciation eligibility policy before entering rules/marks. This tool records manually approved values; it does not automatically decide.
- Paper files are stored in storage/uploads and access is denied by .htaccess on Apache. For production, move uploads outside web root and implement authorized download controller.
- Test on dummy data. Do not upload actual student records until role permissions, backups, audit logging, privacy controls and full validation have been reviewed.
- Set PHP upload_max_filesize/post_max_size appropriately for PDF upload. Use HTTPS on any public server.
- This package uses local CSS and no CDN; no internet needed after XAMPP/PHP is installed.
