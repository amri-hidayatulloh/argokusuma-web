
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Language Options

CREATE TABLE `ak_language_options` (
  `keylang` char(8) NOT NULL,
  `label` varchar(55) NOT NULL,
  `flag_image` varchar(55) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `ak_language_options` (`keylang`, `label`, `flag_image`, `is_active`, `modified_date`) VALUES
('en', 'English', 'en.png', 1, '2021-01-27 14:01:09'),
('id', 'Indonesia', 'id.jpg', 1, '2021-01-27 14:01:09');

ALTER TABLE `ak_language_options`
  ADD PRIMARY KEY (`keylang`);
COMMIT;

UPDATE `ak_options` SET `multiple_langs` = 1 WHERE `field_type` IN ('text','longtext');


-- Suggestion Table

CREATE TABLE `ak_suggest_submission` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `suggestion` text NOT NULL,
  `ip_address` varchar(32) NOT NULL,
  `user_agent` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `ak_suggest_submission`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ak_suggest_submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

-- Customer Care 

ALTER TABLE `ak_teams` ADD `group_type` VARCHAR(11) NOT NULL DEFAULT 'team' AFTER `id`;

CREATE TABLE `ak_consultation_contact` (
  `id` int(11) NOT NULL,
  `channel_type` varchar(32) NOT NULL,
  `channel_value` varchar(100) NOT NULL,
  `label` varchar(100) NOT NULL,
  `initial_text` text NOT NULL,
  `lang_available` varchar(32) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `ak_consultation_contact`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ak_consultation_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

-- Jobs

CREATE TABLE `ak_jobs` (
  `id` int(11) NOT NULL,
  `job_position` varchar(155) NOT NULL,
  `description` text NOT NULL,
  `requirement` text NOT NULL,
  `location` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `ak_jobs`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ak_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

-- Pricing


CREATE TABLE `ak_pricings` (
  `id` int(11) NOT NULL,
  `pricing_name` varchar(255) NOT NULL,
  `slug` varchar(155) NOT NULL,
  `description` text NOT NULL,
  `payment_term` text NOT NULL,
  `thumbnail_image` varchar(100) NOT NULL,
  `cover_image` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `ak_pricing_feature` (
  `id` int(11) NOT NULL,
  `pricing_id` int(11) NOT NULL,
  `caption` varchar(155) NOT NULL,
  `key_heading_label` varchar(100) NOT NULL,
  `value_heading_label` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `ak_pricing_feature_table` (
  `id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `key_value` text NOT NULL,
  `value_value` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `ak_pricings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ak_pricing_feature`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ak_pricing_feature_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ak_pricings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ak_pricing_feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ak_pricing_feature_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

-- Others

UPDATE `ak_options` SET `field_type` = 'toggle' WHERE `field_type` = 'tickbox';

INSERT INTO `ak_options` (`option_key`, `option_value`, `option_group`, `field_type`, `caption`, `multiple_langs`, `language_options`, `desclimer`, `editable`, `multiple_assets`) VALUES
('search-placeholder', 'a:2:{s:2:\"id\";s:4:\"Cari\";s:2:\"en\";s:6:\"Search\";}', 'blog', 'text', 'Search Placeholder', 1, '', '', 1, 0),
('write-comment', 'a:2:{s:2:\"id\";s:19:\"Tinggalkan Komentar\";s:2:\"en\";s:15:\"Write a Comment\";}', 'blog', 'text', 'Write Comment', 1, '', '', 1, 0),
('comment', 'a:2:{s:2:\"id\";s:8:\"Komentar\";s:2:\"en\";s:7:\"Comment\";}', 'blog', 'text', 'Comment', 1, '', '', 1, 0),
('comment-desclimer', 'a:2:{s:2:\"id\";s:78:\"Alamat E-Mail Anda tidak akan ditampilkan. Bagian wajib diisi telah ditandai *\";s:2:\"en\";s:69:\"Your email address will not be published. Required field are marked *\";}', 'blog', 'text', 'Comment Desclimer', 1, '', '', 1, 0),
('categories', 'a:2:{s:2:\"id\";s:8:\"Kategori\";s:2:\"en\";s:10:\"Categories\";}', 'blog', 'text', 'Categories', 1, '', '', 1, 0),
('popular', 'a:2:{s:2:\"id\";s:20:\"Postingan Terpopuler\";s:2:\"en\";s:13:\"Popular Posts\";}', 'blog', 'text', 'Popular', 1, '', '', 1, 0),
('comment-keep-info', 'a:2:{s:2:\"id\";s:66:\"Simpan informasi saya di perangkat ini untuk penggunaan berikutnya\";s:2:\"en\";s:58:\"Save my information in this browser for the future comment\";}', 'blog', 'longtext', 'Comment Keep Info', 1, '', '', 1, 0),
('post-comment', 'a:2:{s:2:\"id\";s:14:\"Kirim Komentar\";s:2:\"en\";s:12:\"Post Comment\";}', 'blog', 'text', 'Post Comment', 1, '', '', 1, 0),
('read-more', 'a:2:{s:2:\"id\";s:16:\"Lihat Selebihnya\";s:2:\"en\";s:9:\"Read More\";}', 'blog', 'text', 'Read More', 1, '', '', 1, 0),
('load-more', 'a:2:{s:2:\"id\";s:17:\"Muat lebih banyak\";s:2:\"en\";s:9:\"Load more\";}', 'blog', 'text', 'Load More', 1, '', '', 1, 0),
('home-menu-text', 'a:2:{s:2:\"id\";s:7:\"Beranda\";s:2:\"en\";s:4:\"Home\";}', 'menubar', 'text', 'Home Menu Text', 1, '', '', 1, 0),
('home-menu-visibility', '1', 'menubar', 'toggle', 'Home Menu Visibility', 0, '', '', 1, 0),
('about-menu-text', 'a:2:{s:2:\"id\";s:12:\"Tentang Kami\";s:2:\"en\";s:8:\"About Us\";}', 'menubar', 'text', 'About Menu Text', 1, '', '', 1, 0),
('about-menu-visibility', '1', 'menubar', 'toggle', 'About Menu Visibility', 0, '', '', 1, 0),
('portfolio-menu-text', 'a:2:{s:2:\"id\";s:9:\"Portfolio\";s:2:\"en\";s:9:\"Portfolio\";}', 'menubar', 'text', 'Portfolio Menu Text', 1, '', '', 1, 0),
('portfolio-menu-visibility', '1', 'menubar', 'toggle', 'Portfolio Menu Visibility', 0, '', '', 1, 0),
('contact-menu-text', 'a:2:{s:2:\"id\";s:11:\"Kontak Kami\";s:2:\"en\";s:10:\"Contact Us\";}', 'menubar', 'text', 'Contact Menu Text', 1, '', '', 1, 0),
('contact-menu-visibility', '1', 'menubar', 'toggle', 'Contact Menu Visibility', 0, '', '', 1, 0),
('blog-menu-text', 'a:2:{s:2:\"id\";s:4:\"Blog\";s:2:\"en\";s:4:\"Blog\";}', 'menubar', 'text', 'Blog Menu Text', 1, '', '', 1, 0),
('blog-menu-visibility', '1', 'menubar', 'toggle', 'Blog Menu Visibility', 0, '', '', 1, 0),
('service-menu-text', 'a:2:{s:2:\"id\";s:12:\"Layanan Kami\";s:2:\"en\";s:10:\"What We Do\";}', 'menubar', 'text', 'Service Menu Text', 1, '', '', 1, 0),
('service-menu-visibility', '1', 'menubar', 'toggle', 'Service Menu Visibility', 0, '', '', 1, 0),
('information-menu-text', 'a:2:{s:2:\"id\";s:9:\"Informasi\";s:2:\"en\";s:11:\"Information\";}', 'menubar', 'text', 'Information Menu Text', 1, '', '', 1, 0),
('information-menu-visibility', '1', 'menubar', 'toggle', 'Information Menu Visibility', 0, '', '', 1, 0),
('pricing-menu-text', 'a:2:{s:2:\"id\";s:5:\"Harga\";s:2:\"en\";s:7:\"Pricing\";}', 'menubar', 'text', 'Pricing Menu Text', 1, '', '', 1, 0),
('pricing-menu-visibility', '1', 'menubar', 'toggle', 'Pricing Menu Visibility', 0, '', '', 1, 0),
('job-menu-text', 'a:2:{s:2:\"id\";s:14:\"Lowongan Kerja\";s:2:\"en\";s:11:\"Job Vacancy\";}', 'menubar', 'text', 'Job Vacancy Menu Text', 1, '', '', 1, 0),
('job-menu-visibility', '1', 'menubar', 'toggle', 'Job Vacancy Menu Visibility', 0, '', '', 1, 0),
('suggestion-menu-text', 'a:2:{s:2:\"id\";s:16:\"Kritik dan Saran\";s:2:\"en\";s:11:\"Suggestions\";}', 'menubar', 'text', 'Suggestion Menu Text', 1, '', '', 1, 0),
('suggestion-menu-visibility', '1', 'menubar', 'toggle', 'Suggestion Menu Visibility', 0, '', '', 1, 0),
('consultation-menu-text', 'a:2:{s:2:\"id\";s:10:\"Konsultasi\";s:2:\"en\";s:12:\"Consultation\";}', 'menubar', 'text', 'Consultation Menu Text', 1, '', '', 1, 0),
('consultation-menu-visibility', '1', 'menubar', 'toggle', 'Consultation Menu Visibility', 0, '', '', 1, 0),
('get-in-touch', 'a:2:{s:2:\"id\";s:21:\"Terhubung dengan Kami\";s:2:\"en\";s:12:\"Get In Touch\";}', 'contact', 'text', 'Get In Touch', 1, '', '', 1, 0),
('contact-us', 'a:2:{s:2:\"id\";s:11:\"Kontak Kami\";s:2:\"en\";s:10:\"Contact Us\";}', 'contact', 'text', 'Contact Us', 1, '', '', 1, 0),
('location', 'a:2:{s:2:\"id\";s:6:\"Lokasi\";s:2:\"en\";s:8:\"Location\";}', 'contact', 'text', 'Location', 1, '', '', 1, 0),
('leave-comment', 'a:2:{s:2:\"id\";s:16:\"Tinggalkan Pesan\";s:2:\"en\";s:13:\"Leave Message\";}', 'contact', 'text', 'Leave Comment', 1, '', '', 1, 0),
('job-sub-title', 'a:2:{s:2:\"id\";s:18:\"Lowongan Pekerjaan\";s:2:\"en\";s:11:\"Job Vacancy\";}', 'job', 'text', 'Job Sub Title', 1, '', '', 1, 0),
('job-title', 'a:2:{s:2:\"id\";s:5:\"Karir\";s:2:\"en\";s:6:\"Career\";}', 'job', 'text', 'Job Title', 1, '', '', 1, 0),
('job-vacancy', 'a:2:{s:2:\"id\";s:18:\"Lowongan Pekerjaan\";s:2:\"en\";s:11:\"Job Vacancy\";}', 'job', 'text', 'Job Vacancy', 1, '', '', 1, 0),
('job-available', 'a:2:{s:2:\"id\";s:17:\"Lowongan Tersedia\";s:2:\"en\";s:13:\"Job Available\";}', 'job', 'text', 'Job Available', 1, '', '', 1, 0),
('job-apply', 'a:2:{s:2:\"id\";s:13:\"Kirim Lamaran\";s:2:\"en\";s:9:\"Apply Job\";}', 'job', 'text', 'Job Apply', 1, '', '', 1, 0),
('job-description', 'a:2:{s:2:\"id\";s:16:\"Deskripsi Posisi\";s:2:\"en\";s:15:\"Job Description\";}', 'job', 'text', 'Job Description', 1, '', '', 1, 0),
('job-requirement', 'a:2:{s:2:\"id\";s:9:\"Kebutuhan\";s:2:\"en\";s:11:\"Requirement\";}', 'job', 'text', 'Job Requirement', 1, '', '', 1, 0),
('pricing-cover', 'aboutcover.png', 'pricing', 'image', 'Pricing Us Cover', 0, '', '', 1, 0),
('pricing-title', 'a:2:{s:2:\"id\";s:12:\"Daftar Harga\";s:2:\"en\";s:7:\"Pricing\";}', 'pricing', 'text', 'Pricing Title', 1, '', '', 1, 0),
('pricing-sub-title', 'a:2:{s:2:\"id\";s:15:\"Informasi Harga\";s:2:\"en\";s:19:\"Pricing Information\";}', 'pricing', 'text', 'Pricing Sub Title', 1, '', '', 1, 0),
('pricing-highlight-title', 'a:2:{s:2:\"id\";s:26:\"Harga &amp; Prosedur Jasa \";s:2:\"en\";s:21:\"Price &amp; Procedure\";}', 'pricing', 'text', 'Pricing Highlight Title', 1, '', '', 1, 0),
('pricing-highlight-body', 'a:2:{s:2:\"id\";s:141:\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent a nunc ac massa malesuada rhoncus ut vel eros. Phasellus vel congue velit. \";s:2:\"en\";s:141:\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent a nunc ac massa malesuada rhoncus ut vel eros. Phasellus vel congue velit. \";}', 'pricing', 'text', 'Pricing Highlight Body', 1, '', '', 1, 0),
('other-pricing', 'a:2:{s:2:\"id\";s:13:\"Harga Lainnya\";s:2:\"en\";s:13:\"Other Pricing\";}', 'pricing', 'text', 'Other Pricing', 1, '', '', 1, 0),
('pricing-term', 'a:2:{s:2:\"id\";s:17:\"Termin Pembayaran\";s:2:\"en\";s:12:\"Payment Term\";}', 'pricing', 'text', 'Pricing Term', 1, '', '', 1, 0),
('suggestion-sub-heading', 'a:2:{s:2:\"id\";s:11:\"Lorem Ipsum\";s:2:\"en\";s:11:\"Lorem Ipsum\";}', 'suggestions', 'text', 'Suggestion Sub Heading', 1, '', '', 1, 0),
('suggestion-heading', 'a:2:{s:2:\"id\";s:16:\"Kritik dan Saran\";s:2:\"en\";s:11:\"Suggestions\";}', 'suggestions', 'text', 'Suggestion Heading', 1, '', '', 1, 0),
('consult-title', 'a:2:{s:2:\"id\";s:9:\"Informasi\";s:2:\"en\";s:11:\"Information\";}', 'consultation', 'text', 'Consult Title', 1, '', '', 1, 0),
('consult-sub-title', 'a:2:{s:2:\"id\";s:10:\"Konsultasi\";s:2:\"en\";s:12:\"Consultation\";}', 'consultation', 'text', 'Consult Sub Title', 1, '', '', 1, 0),
('consult-teams-heading', 'a:2:{s:2:\"id\";s:17:\"Layanan Pelanggan\";s:2:\"en\";s:13:\"Customer Care\";}', 'consultation', 'text', 'Consult Teams Heading', 1, '', '', 1, 0),
('consult-contact-heading', 'a:2:{s:2:\"id\";s:14:\"Kontak Kami Di\";s:2:\"en\";s:13:\"Contact Us On\";}', 'consultation', 'text', 'Consult Contact Heading', 1, '', '', 1, 0);

