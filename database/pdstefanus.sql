CREATE TABLE `password_reset_tokens`(
  `email` VARCHAR(255) NOT NULL, 
  `token` VARCHAR(255) NOT NULL, 
  `created_at` TIMESTAMP NULL
) DEFAULT CHARACTER SET utf8mb4 COLLATE 'utf8mb4_unicode_ci';
ALTER TABLE 
  `password_reset_tokens` 
ADD 
  PRIMARY KEY(`email`);
CREATE TABLE `failed_jobs`(
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `uuid` VARCHAR(255) NOT NULL, 
  `connection` TEXT NOT NULL, 
  `queue` TEXT NOT NULL, 
  `payload` LONGTEXT NOT NULL, 
  `exception` LONGTEXT NOT NULL, 
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARACTER SET utf8mb4 COLLATE 'utf8mb4_unicode_ci';
ALTER TABLE 
  `failed_jobs` 
ADD 
  UNIQUE `failed_jobs_uuid_unique`(`uuid`);
CREATE TABLE `personal_access_tokens`(
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `tokenable_type` VARCHAR(255) NOT NULL, 
  `tokenable_id` BIGINT UNSIGNED NOT NULL, 
  `name` VARCHAR(255) NOT NULL, 
  `token` VARCHAR(64) NOT NULL, 
  `abilities` TEXT NULL, 
  `last_used_at` TIMESTAMP NULL, 
  `expires_at` TIMESTAMP NULL, 
  `created_at` TIMESTAMP NULL, 
  `updated_at` TIMESTAMP NULL
) DEFAULT CHARACTER SET utf8mb4 COLLATE 'utf8mb4_unicode_ci';
ALTER TABLE 
  `personal_access_tokens` 
ADD 
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(
    `tokenable_type`, `tokenable_id`
  );
ALTER TABLE 
  `personal_access_tokens` 
ADD 
  UNIQUE `personal_access_tokens_token_unique`(`token`);
CREATE TABLE `attendance`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `user_id` INT NOT NULL, 
  `event_id` INT NOT NULL, 
  `date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, 
  `description` MEDIUMTEXT NULL, 
  `active` TINYINT(1) NOT NULL DEFAULT '1', 
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, 
  `created_by` INT NULL, 
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  `updated_by` INT NULL
) DEFAULT CHARACTER SET utf8mb4 COLLATE 'utf8mb4_unicode_ci';
ALTER TABLE 
  `attendance` 
ADD 
  INDEX `user_id`(`user_id`);
ALTER TABLE 
  `attendance` 
ADD 
  INDEX `event_id`(`event_id`);
CREATE TABLE `events`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `title` VARCHAR(255) NOT NULL, 
  `date` TIMESTAMP NOT NULL, 
  `media` VARCHAR(255) NULL, 
  `links` VARCHAR(255) NULL, 
  `address` VARCHAR(255) NULL, 
  `description` MEDIUMTEXT NULL, 
  `active` TINYINT(1) NOT NULL DEFAULT '1', 
  `order_number` INT NULL, 
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, 
  `created_by` INT NULL, 
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  `updated_by` INT NULL
) DEFAULT CHARACTER SET utf8mb4 COLLATE 'utf8mb4_unicode_ci';
CREATE TABLE `tema_pd`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `title` VARCHAR(255) NOT NULL, 
  `date` TIMESTAMP NOT NULL, 
  `media` VARCHAR(255) NULL, 
  `links` VARCHAR(255) NULL, 
  `description` MEDIUMTEXT NULL, 
  `active` TINYINT(1) NOT NULL DEFAULT '1', 
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, 
  `created_by` INT NULL, 
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  `updated_by` INT NULL
) DEFAULT CHARACTER SET utf8mb4 COLLATE 'utf8mb4_unicode_ci';
CREATE TABLE `login_history`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `user_id` INT NOT NULL, 
  `password` INT NOT NULL, 
  `status` VARCHAR(255) NOT NULL, 
  `description` MEDIUMTEXT NULL, 
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, 
  `created_by` INT NULL, 
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  `updated_by` INT NULL
) DEFAULT CHARACTER SET utf8mb4 COLLATE 'utf8mb4_unicode_ci';
ALTER TABLE 
  `login_history` 
ADD 
  INDEX `user_id`(`user_id`);
CREATE TABLE `media`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `name` VARCHAR(255) NOT NULL, 
  `url` VARCHAR(255) NOT NULL, 
  `description` MEDIUMTEXT NULL, 
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, 
  `created_by` INT NULL, 
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  `updated_by` INT NULL
) DEFAULT CHARACTER SET utf8mb4 COLLATE 'utf8mb4_unicode_ci';
CREATE TABLE `roles`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `name` VARCHAR(255) NOT NULL, 
  `image` VARCHAR(255) NULL, 
  `active` TINYINT(1) NOT NULL DEFAULT '1', 
  `description` MEDIUMTEXT NULL, 
  `begin_date` TIMESTAMP NULL, 
  `end_date` TIMESTAMP NULL, 
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, 
  `created_by` INT NULL, 
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  `updated_by` INT NULL
) DEFAULT CHARACTER SET utf8mb4 COLLATE 'utf8mb4_unicode_ci';
CREATE TABLE `songs`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `artist` VARCHAR(255) NULL, 
  `title` VARCHAR(255) NOT NULL, 
  `lyrics` VARCHAR(255) NULL, 
  `description` MEDIUMTEXT NULL, 
  `production_date` TIMESTAMP NULL, 
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, 
  `created_by` INT NULL, 
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  `updated_by` INT NULL
) DEFAULT CHARACTER SET utf8mb4 COLLATE 'utf8mb4_unicode_ci';
CREATE TABLE `users`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `role_id` INT NULL DEFAULT '1', 
  `full_name` VARCHAR(255) NOT NULL, 
  `birthdate` TIMESTAMP NOT NULL, 
  `address` VARCHAR(255) NULL, 
  `wilayah` VARCHAR(255) NULL, 
  `paroki` VARCHAR(255) NULL, 
  `social_instagram` VARCHAR(255) NULL, 
  `social_tiktok` VARCHAR(255) NULL, 
  `phone` VARCHAR(255) NOT NULL DEFAULT '0', 
  `image` VARCHAR(255) NULL, 
  `email` VARCHAR(255) NOT NULL, 
  `description` MEDIUMTEXT NULL, 
  `gender` VARCHAR(255) NULL, 
  `first_attendance` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  `last_attendance` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, 
  `total_attendance` DECIMAL(10, 0) NULL, 
  `attendance_percentage` DECIMAL(10, 0) NULL, 
  `password` VARCHAR(255) NOT NULL, 
  `active` TINYINT(1) NOT NULL DEFAULT '1', 
  `remember_token` VARCHAR(255) NOT NULL DEFAULT '', 
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, 
  `created_by` INT NULL, 
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  `updated_by` INT NULL
) DEFAULT CHARACTER SET utf8mb4 COLLATE 'utf8mb4_unicode_ci';
ALTER TABLE 
  `users` 
ADD 
  INDEX `role_id`(`role_id`);
ALTER TABLE 
  `attendance` 
ADD 
  CONSTRAINT `attendance_ibfk_1` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE 
  `attendance` 
ADD 
  CONSTRAINT `attendance_ibfk_2` FOREIGN KEY(`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE 
  `login_history` 
ADD 
  CONSTRAINT `login_history_ibfk_1` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE 
  `users` 
ADD 
  CONSTRAINT `users_ibfk_1` FOREIGN KEY(`role_id`) REFERENCES `roles`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
INSERT INTO `roles`(`name`) 
VALUES 
  ('umat'), 
  ('admin');
INSERT INTO `users`(
  `role_id`, `full_name`, `birthdate`, 
  `address`, `wilayah`, `paroki`, `social_instagram`, 
  `social_tiktok`, `phone`, `email`, 
  `first_attendance`, `last_attendance`, 
  `password`, `active`
)
VALUES 
  (
    2, 'PD Stefanus', '2023-03-24', 'Jl. Satria IV No.Blok C', 'Jelambar',
    'Kristoforus', 'pdstefanus', 'pdstefanus', 
    '087877828233', 'stefan_news@yahoo.com', 
    '2023-03-24', '2023-03-24', '$2y$10$uuQ6hqTbGi/UnLwR.rV8EutI1mVjUYpP/u1KCXqmEb0Jz1lMKGiEq', 
    true
  );
INSERT INTO `events`(
  `date`, `description`, `links`, `media`, 
  `order_number`, `title`
) 
VALUES 
  (
    '2023-03-30', 'Tim Pujian PD Stefanus adalah wadah untuk kalian yang punya kerinduan memuji & menyembah Tuhan lewat talenta bernyanyi & bermain musik. Latian Pujian diadakan setiap hari selasa pukul 7 malam. Yuk join kita untuk sama-sama bernyanyi & memuji Tuhan!', 
    'https://www.instagram.com/reel/Co6EEAphLdQ/?utm_source=ig_web_copy_link', 
    'https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/County_Dublin_-_Holmpatrick_Church_of_Ireland_Church_-_20190615195717.jpg/1200px-County_Dublin_-_Holmpatrick_Church_of_Ireland_Church_-_20190615195717.jpg', 
    1, 'Pujian'
  ), 
  (
    '2023-03-30', 'Deskripsi Kombas', 
    'https://www.instagram.com/reel/CqF_KDXgA47/?utm_source=ig_web_copy_link', 
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJRKwHTcmdDwIqcloCC076mxpFa0oP6Nizjw&usqp=CAU', 
    2, 'Dance'
  ), 
  (
    '2023-03-30', 'Tim Pujian PD Stefanus adalah wadah untuk kalian yang punya kerinduan memuji & menyembah Tuhan lewat talenta bernyanyi & bermain musik. Latian Pujian diadakan setiap hari selasa pukul 7 malam. Yuk join kita untuk sama-sama bernyanyi & memuji Tuhan!', 
    'https://www.instagram.com/reel/Cnn3ncQoJSL/?utm_source=ig_web_copy_link', 
    'https://holynamewinfield.org/images/stories/rotator/rd2022/rotator1.jpg', 
    3, 'Kombas'
  ), 
  (
    '2023-03-30', 'PD Stefanus di adakan setiap hari kamis malam pukul 19.00 WIB', 
    'https://pdstefanusgrogol.com/', 
    'https://www.imb.org/wp-content/uploads/2016/08/Local-Church.jpg', 
    4, 'PD Stefanus'
  );



INSERT INTO `tema_pd`(
  `date`, `description`, `links`, `media`, 
  `title`
) 
VALUES 
  (
    '2023-03-16', 'Deskripsi Pujian', 
    'https://www.instagram.com/p/Cpws0qXPZvC/?utm_source=ig_web_copy_link', 
    'https://i.imgur.com/Waty6k8.jpg', 
    'The Art of Giving'
  ), 
  (
    '2023-03-09', 'Deskripsi Dance', 
    'https://www.instagram.com/p/CpegnvHv3ej/?utm_source=ig_web_copy_link', 
    'https://i.imgur.com/rE3wWTe.jpg', 
    'B.R.E.A.D'
  ), 
  (
    '2023-03-02', 'Deskripsi Divergent', 
    'https://www.instagram.com/p/CpMccqdPrUu/?utm_source=ig_web_copy_link', 
    'https://i.imgur.com/SiaQ9hm.jpg', 
    'Divergent'
  );