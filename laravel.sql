-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 03:42 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `availabilities`
--

CREATE TABLE `availabilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `counselor_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `availabilities`
--

INSERT INTO `availabilities` (`id`, `counselor_id`, `date`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(8, 32, '2023-05-30', '08:00:00', '17:00:00', '2023-05-29 05:03:18', '2023-05-29 05:03:18');

-- --------------------------------------------------------

--
-- Table structure for table `callslips`
--

CREATE TABLE `callslips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `counselor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending for counseling',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `callslips`
--

INSERT INTO `callslips` (`id`, `student_id`, `instructor_id`, `counselor_id`, `date`, `time`, `status`, `created_at`, `updated_at`) VALUES
(25, 34, 33, 32, '2023-05-30', '08:00:00', 'pending for counseling', '2023-05-29 23:40:02', '2023-05-29 23:40:02');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `abbreviation` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `created_at`, `updated_at`, `abbreviation`, `department_id`) VALUES
(14, 'Bachelor of Science in Computer Science', '2023-05-25 22:02:50', '2023-05-25 22:02:50', 'BSCS', 7);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `abbreviation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `created_at`, `updated_at`, `abbreviation`) VALUES
(7, 'College of Technology and Allied Sciences', '2023-05-25 21:58:31', '2023-05-25 21:58:31', 'CTAS');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_07_005740_create_referrals_table', 1),
(6, '2023_03_07_010733_create_reasons_table', 1),
(7, '2023_03_13_224011_create_callslips_table', 1),
(8, '2023_03_14_220651_add_counselor_id_to_referrals_table', 1),
(9, '2023_03_17_181109_create_departments_table', 1),
(10, '2023_03_17_181453_add_column_to_table--table=departments', 1),
(11, '2023_03_19_042909_create_courses_table', 1),
(12, '2023_03_19_064642_add_abbreviation_to_courses', 1),
(13, '2023_03_21_123658_create_admins_table', 1),
(14, '2023_04_04_124541_create_jobs_table', 1),
(15, '2023_04_06_133323_create_notifications_table', 1),
(16, '2023_04_10_023102_add_counselor_id_to_callslips_table', 1),
(17, '2023_04_13_215443_add_new_column_to_users_table', 1),
(18, '2023_04_21_123739_add_status_to_referrals_table', 1),
(19, '2023_04_28_115327_add_new_column_to_referrals_table', 1),
(20, '2023_04_30_102817_modify_status_enum_in_referrals_table', 1),
(21, '2023_04_30_111158_add_profile_image_to_users_table', 1),
(22, '2023_04_30_202706_add_department_id_to_courses_table', 1),
(23, '2023_05_03_110239_add_contact_to_users_table', 1),
(24, '2023_05_04_090419_create_events_table', 1),
(25, '2023_05_11_230816_create_availabilities_table', 1),
(26, '2023_05_15_204634_create_notes_table', 2),
(27, '2023_05_17_155036_modify_status_enum_in_callslips_table', 3),
(28, '2023_05_23_052157_modify_status_enum_in_callslips_table', 4),
(29, '2023_05_25_145742_modify_instructor_id_in_referrals_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `callslip_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0215a167-a29d-406c-8f40-1e3b5c7c02d2', 'App\\Notifications\\ReferralNotification', 'App\\Models\\User', 9, '{\"data\":\"You have a new referral\"}', NULL, '2023-05-16 11:31:23', '2023-05-16 11:31:23'),
('060a2b97-5dba-40ff-b4fe-d8bc61ff7c17', 'App\\Notifications\\CallslipNotification', 'App\\Models\\User', 5, '{\"data\":\"You have a new appointment\"}', NULL, '2023-05-15 14:34:59', '2023-05-15 14:34:59'),
('0867e600-72da-47d1-b6ae-3607aa9c7669', 'App\\Notifications\\ReferredNotification', 'App\\Models\\User', 26, '{\"data\":\"You have been referred for counseling\"}', NULL, '2023-05-25 04:57:22', '2023-05-25 04:57:22'),
('0d734568-76f9-40dd-a4f0-60d6f4d0e355', 'App\\Notifications\\ReferralApproved', 'App\\Models\\User', 33, '{\"data\":\"Your referral has been approved\",\"referral_id\":null}', '2023-05-29 23:42:08', '2023-05-29 23:40:19', '2023-05-29 23:42:08'),
('24b89f27-f5a7-4292-9fcb-e9c37825150a', 'App\\Notifications\\CallslipNotification', 'App\\Models\\User', 27, '{\"data\":\"You have a new appointment\"}', '2023-05-25 05:54:43', '2023-05-25 05:54:03', '2023-05-25 05:54:43'),
('2e99ce17-a82b-4ec5-a760-9933bf267659', 'App\\Notifications\\ReferralNotification', 'App\\Models\\User', 29, '{\"data\":\"You have a new referral\"}', '2023-05-28 15:08:11', '2023-05-28 15:07:56', '2023-05-28 15:08:11'),
('2f6bdbfb-eb47-4a83-a99f-62d19fc1f40a', 'App\\Notifications\\ReferralNotification', 'App\\Models\\User', 8, '{\"data\":\"You have a new referral\"}', NULL, '2023-05-16 11:20:49', '2023-05-16 11:20:49'),
('30950c64-fd74-4dd2-9fa9-ef6c903978aa', 'App\\Notifications\\CallslipNotification', 'App\\Models\\User', 22, '{\"data\":\"You have a new appointment\"}', '2023-05-18 01:25:06', '2023-05-18 01:24:48', '2023-05-18 01:25:06'),
('4069fcb8-5374-4ae5-ad68-a5f973ddd98e', 'App\\Notifications\\ReferredNotification', 'App\\Models\\User', 23, '{\"data\":\"You have been referred for counseling\"}', '2023-05-18 01:26:20', '2023-05-18 01:21:02', '2023-05-18 01:26:20'),
('49178edd-bfa9-45d3-b170-c48d0692921c', 'App\\Notifications\\CallslipNotification', 'App\\Models\\User', 34, '{\"data\":\"You have a new appointment\"}', '2023-05-29 23:45:49', '2023-05-29 23:40:05', '2023-05-29 23:45:49'),
('58c5cee9-b0fe-4c4d-9466-f053d0a516b4', 'App\\Notifications\\ReferredNotification', 'App\\Models\\User', 34, '{\"data\":\"You have been referred for counseling\"}', NULL, '2023-05-30 14:13:46', '2023-05-30 14:13:46'),
('6da0bb57-ee40-4465-9320-a2f7a0d7a8ca', 'App\\Notifications\\CallslipNotification', 'App\\Models\\User', 5, '{\"data\":\"You have a new appointment\"}', NULL, '2023-05-15 13:06:36', '2023-05-15 13:06:36'),
('780e079a-3b65-4915-8df9-d54171aa0701', 'App\\Notifications\\CallslipNotification', 'App\\Models\\User', 5, '{\"data\":\"You have a new appointment\"}', NULL, '2023-05-15 14:17:59', '2023-05-15 14:17:59'),
('842cdbc4-b57e-4d00-bcb3-fe086aeebb47', 'App\\Notifications\\ReferralNotification', 'App\\Models\\User', 8, '{\"data\":\"You have a new referral\"}', NULL, '2023-05-16 11:27:08', '2023-05-16 11:27:08'),
('867a8d47-5927-455a-aea1-db3ac315404c', 'App\\Notifications\\ReferralNotification', 'App\\Models\\User', 10, '{\"data\":\"You have a new referral\"}', NULL, '2023-05-16 11:35:47', '2023-05-16 11:35:47'),
('8751d796-323f-49d2-92c1-7c856840ca36', 'App\\Notifications\\ReferralApproved', 'App\\Models\\User', 30, '{\"data\":\"Your referral has been approved\",\"referral_id\":null}', NULL, '2023-05-28 15:20:38', '2023-05-28 15:20:38'),
('931e68ee-7746-4366-bcbf-e5b02a41d13e', 'App\\Notifications\\ReferredNotification', 'App\\Models\\User', 24, '{\"data\":\"You have been referred for counseling\"}', NULL, '2023-05-18 01:22:41', '2023-05-18 01:22:41'),
('9a46b515-e0a1-491a-9a23-68c547284bc2', 'App\\Notifications\\ReferredNotification', 'App\\Models\\User', 21, '{\"data\":\"You have been referred for counseling\"}', '2023-05-18 01:37:40', '2023-05-18 01:33:37', '2023-05-18 01:37:40'),
('9a8b065c-d041-496a-b498-0eedff37d40c', 'App\\Notifications\\ReferralNotification', 'App\\Models\\User', 11, '{\"data\":\"You have a new referral\"}', NULL, '2023-05-16 11:38:16', '2023-05-16 11:38:16'),
('a1e6ac9d-7d31-41ac-bef4-17145df4743a', 'App\\Notifications\\ReferralNotification', 'App\\Models\\User', 32, '{\"data\":\"You have a new referral\"}', '2023-05-29 23:39:36', '2023-05-29 23:37:58', '2023-05-29 23:39:36'),
('a971d0d7-337d-49a9-a0d8-6a3cdafe5234', 'App\\Notifications\\CallslipNotification', 'App\\Models\\User', 23, '{\"data\":\"You have a new appointment\"}', '2023-05-18 01:27:12', '2023-05-18 01:26:54', '2023-05-18 01:27:12'),
('b36c3da9-919f-4497-a315-af5b77f3cd5e', 'App\\Notifications\\ReferralNotification', 'App\\Models\\User', 32, '{\"data\":\"You have a new referral\"}', '2023-05-30 14:13:59', '2023-05-30 14:13:42', '2023-05-30 14:13:59'),
('b4f8efee-d041-47e5-8fc2-b314e9346cbb', 'App\\Notifications\\CallslipNotification', 'App\\Models\\User', 5, '{\"data\":\"You have a new appointment\"}', NULL, '2023-05-15 13:28:55', '2023-05-15 13:28:55'),
('b5cf3d43-b23a-481f-ae8b-8fa1ae3786f3', 'App\\Notifications\\ReferralApproved', 'App\\Models\\User', 30, '{\"data\":\"Your referral has been approved\",\"referral_id\":null}', '2023-05-28 15:19:42', '2023-05-28 15:08:31', '2023-05-28 15:19:42'),
('b5f24149-4785-407e-a6f8-f866ee776609', 'App\\Notifications\\ReferralNotification', 'App\\Models\\User', 29, '{\"data\":\"You have a new referral\"}', '2023-05-28 15:19:55', '2023-05-28 15:19:20', '2023-05-28 15:19:55'),
('b6f883ab-40e5-4ae2-a027-ee86cf27de9e', 'App\\Notifications\\CallSlipReschedule', 'App\\Models\\User', 5, '{\"data\":\"Your call slip with ID #5 has been updated. Please check your appointments for the latest details.\"}', NULL, '2023-05-15 14:35:11', '2023-05-15 14:35:11'),
('bef5f3bb-37d1-486e-a1f0-6aed4941ed10', 'App\\Notifications\\CallslipNotification', 'App\\Models\\User', 5, '{\"data\":\"You have a new appointment\"}', NULL, '2023-05-15 12:35:20', '2023-05-15 12:35:20'),
('c1b704e6-59b7-4e0e-927c-f24664a9a254', 'App\\Notifications\\CallSlipCancelled', 'App\\Models\\User', 5, '{\"data\":\"Your appointment has been cancelled\"}', NULL, '2023-05-15 14:35:17', '2023-05-15 14:35:17'),
('ceffc042-e1b3-40f9-81b8-eea83cc41cb1', 'App\\Notifications\\ReferredNotification', 'App\\Models\\User', 34, '{\"data\":\"You have been referred for counseling\"}', '2023-05-29 23:45:49', '2023-05-29 23:38:00', '2023-05-29 23:45:49'),
('d130c8c6-87c0-45bb-831f-3b0fd5e7037e', 'App\\Notifications\\ReferredNotification', 'App\\Models\\User', 27, '{\"data\":\"You have been referred for counseling\"}', '2023-05-25 05:52:58', '2023-05-25 05:52:45', '2023-05-25 05:52:58'),
('ded25aef-5cb1-46f4-b474-fe27d8d00837', 'App\\Notifications\\ReferredNotification', 'App\\Models\\User', 34, '{\"data\":\"You have been referred for counseling\"}', '2023-05-29 23:45:49', '2023-05-29 05:04:05', '2023-05-29 23:45:49'),
('e37de6bc-7cf1-4b22-8f3c-a68b9bdfeb8e', 'App\\Notifications\\CallslipNotification', 'App\\Models\\User', 5, '{\"data\":\"You have a new appointment\"}', NULL, '2023-05-15 14:35:45', '2023-05-15 14:35:45'),
('e51471fc-6383-4a27-b194-8789805dae3f', 'App\\Notifications\\ReferralNotification', 'App\\Models\\User', 3, '{\"data\":\"You have a new referral\"}', '2023-05-25 05:53:30', '2023-05-25 05:52:43', '2023-05-25 05:53:30'),
('f6b65e63-f8b2-45f2-9a21-8f5ea79b2593', 'App\\Notifications\\ReferredNotification', 'App\\Models\\User', 22, '{\"data\":\"You have been referred for counseling\"}', '2023-05-18 01:23:53', '2023-05-18 01:20:05', '2023-05-18 01:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`id`, `reason`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Academics', 'Struggles with academic performance and challenges in learning.', '2023-05-17 22:08:02', '2023-05-17 22:08:02'),
(2, 'Attendance and Tardiness', 'Issues with consistent attendance and punctuality.', '2023-05-17 22:08:24', '2023-05-17 22:08:24'),
(3, 'Adjustment', 'Difficulty adapting to new environments or changes in life circumstances.', '2023-05-17 22:08:49', '2023-05-17 22:08:49'),
(4, 'Behavioral Problems', 'Concerns regarding disruptive or problematic behavior.', '2023-05-17 22:09:15', '2023-05-17 22:09:15'),
(5, 'Bullying', 'Experiencing bullying or being involved in bullying incidents.', '2023-05-17 22:09:45', '2023-05-17 22:09:45'),
(6, 'Career Choice', 'Uncertainty or difficulty in deciding on a career path.', '2023-05-17 22:10:09', '2023-05-17 22:10:09'),
(7, 'Depression', 'Experiencing persistent feelings of sadness, hopelessness, or lack of motivation.', '2023-05-17 22:10:37', '2023-05-17 22:10:37'),
(8, 'Discipline', 'Challenges with self-control, following rules, or behaving appropriately.', '2023-05-17 22:10:57', '2023-05-17 22:10:57'),
(9, 'Drugs/Drug Abuse', 'Issues related to substance use or addiction.', '2023-05-17 22:11:18', '2023-05-17 22:11:18'),
(10, 'Early Pregnancy', 'Coping with the challenges of pregnancy at a young age.', '2023-05-17 22:11:39', '2023-05-17 22:11:39'),
(11, 'Family Conflicts', 'Difficulties within the family unit causing tension or conflict.', '2023-05-17 22:12:00', '2023-05-17 22:12:00'),
(12, 'Financial', 'Struggles with financial resources or managing personal finances.', '2023-05-17 22:12:24', '2023-05-17 22:12:24'),
(13, 'Health', 'Concerns related to physical or mental health conditions.', '2023-05-17 22:12:43', '2023-05-17 22:12:43'),
(14, 'Loss/Death', 'Coping with the loss of a loved one or experiencing grief.', '2023-05-17 22:13:07', '2023-05-17 22:13:07'),
(15, 'Love and Relationships', 'Challenges in romantic or interpersonal relationships.', '2023-05-17 22:13:26', '2023-05-17 22:13:26'),
(16, 'Motivation', 'Lack of drive or enthusiasm towards goals or tasks.', '2023-05-17 22:13:46', '2023-05-17 22:13:46'),
(17, 'Phobia/Panic and Anxiety', 'Experiencing intense fears or anxiety-related symptoms.', '2023-05-17 22:14:02', '2023-05-17 22:14:02'),
(18, 'Prejudice and Discrimination', 'Facing bias or unfair treatment based on personal characteristics.', '2023-05-17 22:14:24', '2023-05-17 22:14:24'),
(19, 'Premarital Sex/Sex', 'Dealing with issues related to sexual activity or relationships.', '2023-05-17 22:14:47', '2023-05-17 22:14:47'),
(20, 'Single Parenting/Early Parenthood', 'Navigating the responsibilities and challenges of being a single parent or becoming a parent at a young age.', '2023-05-17 22:15:08', '2023-05-17 22:15:08'),
(21, 'Social Relations', 'Difficulties in forming or maintaining social connections.', '2023-05-17 22:15:25', '2023-05-17 22:15:25'),
(22, 'Stress', 'Coping with overwhelming pressures and demands.', '2023-05-17 22:15:49', '2023-05-17 22:15:49'),
(23, 'Study Habits', 'Struggles with effective study techniques or organization.', '2023-05-17 22:16:07', '2023-05-17 22:16:07'),
(24, 'Time Management', 'Challenges in managing and prioritizing time effectively.', '2023-05-17 22:16:24', '2023-05-17 22:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `referral_details` varchar(500) DEFAULT NULL,
  `referral_previous_interventions` varchar(500) DEFAULT NULL,
  `reason_id` bigint(20) UNSIGNED DEFAULT NULL,
  `instructor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `counselor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `first_choice` datetime DEFAULT NULL,
  `second_choice` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `student_id`, `referral_details`, `referral_previous_interventions`, `reason_id`, `instructor_id`, `created_at`, `updated_at`, `counselor_id`, `status`, `first_choice`, `second_choice`) VALUES
(12, 34, 'She has been experiencing a lack of motivation and struggles with maintaining focus on her studies. She has mentioned feeling overwhelmed and unmotivated to pursue her academic goals.', 'She has attended three counseling sessions in the past semester to address his motivation and academic performance. During these sessions, strategies were discussed to improve her study habits, set achievable goals, and manage stress.', 16, 33, '2023-05-30 14:13:24', '2023-05-30 14:13:24', 32, 'pending', '2023-05-30 08:00:00', '2023-05-30 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `user_type` enum('admin','counselor','instructor','student') NOT NULL DEFAULT 'student',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `year_level` int(11) DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `municipal` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `user_type`, `password`, `remember_token`, `created_at`, `updated_at`, `year_level`, `course_id`, `department_id`, `barangay`, `municipal`, `province`, `profile_image`, `contact`) VALUES
(20, 'Admin', 'admin@gmail.com', NULL, 'admin', '$2y$10$gC73vsVBqT/dxxckvFYqv.UjDLCbNNQwpHQLq23.pnvbyKl7vkJ0G', 'bO8CEDmQ0njFxpWoaomboaQpRcY9UJ1gici4rOl95khKFO0kvkOYZlwzFc8r', '2023-04-17 01:19:48', '2023-05-25 22:15:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Counselor', 'misscounselortest@gmail.com', NULL, 'counselor', '$2y$10$rhzTfIYtUVDVu/ieMDVkV.ccUvQfi1o6XILrjMmSHy2GiPkGvNl1.', 'vEJ4gmBPbxRgxP5FQ1chiJN0fpymWsBnFmrpbsUGvvduqlQ5k63NoNwMd2Rh', '2023-05-29 04:37:17', '2023-05-29 23:36:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Instructor', 'rozelene13@gmail.com', NULL, 'instructor', '$2y$10$rqfNgPpew74EiShezil59edAYSc5Tc5Mygrfl3mLC05baibHn6MUK', NULL, '2023-05-29 05:00:24', '2023-05-29 05:00:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'Student', 'rozelene.olaer@bisu.edu.ph', NULL, 'student', '$2y$10$zq6IDcVfTrUEBaCp0IrbVexNUqSYZ2L3kZq80Go3yJJfTTsQMkbPW', NULL, '2023-05-29 05:01:14', '2023-05-29 05:01:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `availabilities`
--
ALTER TABLE `availabilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `availabilities_counselor_id_foreign` (`counselor_id`);

--
-- Indexes for table `callslips`
--
ALTER TABLE `callslips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `callslips_student_id_foreign` (`student_id`),
  ADD KEY `callslips_instructor_id_foreign` (`instructor_id`),
  ADD KEY `callslips_counselor_id_foreign` (`counselor_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_department_id_foreign` (`department_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_callslip_id_foreign` (`callslip_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referrals_counselor_id_foreign` (`counselor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_course_id_foreign` (`course_id`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `availabilities`
--
ALTER TABLE `availabilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `callslips`
--
ALTER TABLE `callslips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `availabilities`
--
ALTER TABLE `availabilities`
  ADD CONSTRAINT `availabilities_counselor_id_foreign` FOREIGN KEY (`counselor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `callslips`
--
ALTER TABLE `callslips`
  ADD CONSTRAINT `callslips_counselor_id_foreign` FOREIGN KEY (`counselor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `callslips_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `callslips_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_callslip_id_foreign` FOREIGN KEY (`callslip_id`) REFERENCES `callslips` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_counselor_id_foreign` FOREIGN KEY (`counselor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
