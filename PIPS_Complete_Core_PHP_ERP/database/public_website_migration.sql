USE pips_school_erp;
-- Additive migration: does not drop, rename, or modify existing ERP tables.
CREATE TABLE IF NOT EXISTS admission_applications (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 application_no VARCHAR(40) NOT NULL UNIQUE,
 student_name VARCHAR(150) NOT NULL,
 date_of_birth DATE NOT NULL,
 gender ENUM('Male','Female','Other') NOT NULL,
 applying_class VARCHAR(80) NOT NULL,
 guardian_name VARCHAR(150) NOT NULL,
 phone VARCHAR(30) NOT NULL,
 email VARCHAR(190) NULL,
 address TEXT NOT NULL,
 previous_school VARCHAR(180) NULL,
 document_file VARCHAR(255) NULL,
 status ENUM('pending','under_review','documents_required','approved','rejected','enrolled') NOT NULL DEFAULT 'pending',
 reviewed_by INT UNSIGNED NULL,
 reviewed_at DATETIME NULL,
 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 INDEX idx_admission_status_created(status,created_at),
 CONSTRAINT fk_admission_reviewer FOREIGN KEY(reviewed_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS contact_messages (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(150) NOT NULL,
 email VARCHAR(190) NULL,
 phone VARCHAR(30) NOT NULL,
 subject VARCHAR(180) NOT NULL,
 message TEXT NOT NULL,
 status ENUM('new','read','closed') NOT NULL DEFAULT 'new',
 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 INDEX idx_contact_status_created(status,created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
