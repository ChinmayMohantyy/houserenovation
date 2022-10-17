-- 21-06-2022
INSERT INTO `admins` (`id`, `name`, `avatar`, `email`, `email_verified_at`, `mobile`, `password`, `rember_token`, `role`, `status`, `created_at`, `updated_at`) VALUES (NULL, 'Binay Kumar', NULL, 'admin@gmail.com', NULL, NULL, '$2y$10$Atwtnwp8Wku4/m6df31ZK.4PPsIES0zKJHio./KfPs8Qk96y0ho6.', NULL, 'admin', '1', '2022-06-21 13:53:34', '2022-06-21 13:53:34');
--23-06-2022
ALTER TABLE `inventories` CHANGE `inventory_type` `inventory_type` ENUM('s','r') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 's-sellable,r-rentable';
--01-07-2022
ALTER TABLE `inventory_orders` CHANGE `grand_totalprice` `grand_total_price` DOUBLE(10,2) NOT NULL;

--04-07-2022
ALTER TABLE `house_repair_requests` ADD `custom_field` JSON NULL AFTER `tc_agreed`;
--17-08-2022
ALTER TABLE `inventory_orders` CHANGE `grand_total_price` `grand_total_price` DOUBLE(10,2) NOT NULL DEFAULT '0.00';

--22-08-2022
ALTER TABLE `admins` ADD `parent_id` BIGINT NULL AFTER `role`;
ALTER TABLE `roles` ADD `admin_id` BIGINT NULL AFTER `id`;
ALTER TABLE `permissions` ADD `permission_group_id` VARCHAR(100) NOT NULL AFTER `id`;
ALTER TABLE `permissions` ADD `slug` VARCHAR(255) NOT NULL AFTER `guard_name`;
ALTER TABLE `admins` ADD `slug` VARCHAR(100) NULL AFTER `status`;
ALTER TABLE `admin_permission_groups` ADD `slug` VARCHAR(100) NOT NULL AFTER `id`;
ALTER TABLE `warehouse_managers` ADD `admin_id` BIGINT(20) NULL AFTER `id`, ADD `creator_id` BIGINT(20) NULL AFTER `admin_id`;
ALTER TABLE `house_captains` ADD `admin_id` BIGINT(20) NULL AFTER `id`, ADD `creator_id` BIGINT(20) NULL AFTER `admin_id`;
ALTER TABLE `warehouses` ADD `creator_id` BIGINT(20) NULL AFTER `id`;
ALTER TABLE `warehouses` CHANGE `admin_id` `admin_id` BIGINT(20) NULL DEFAULT NULL;
ALTER TABLE `inventories` ADD `admin_id` BIGINT(20) NULL AFTER `id`, ADD `creator_id` BIGINT(20) NULL AFTER `admin_id`;
ALTER TABLE `states` ADD `admin_id` BIGINT(20) NULL AFTER `id`, ADD `creator_id` BIGINT(20) NULL AFTER `admin_id`;
ALTER TABLE `cities` ADD `admin_id` BIGINT(20) NULL AFTER `id`, ADD `creator_id` BIGINT(20) NULL AFTER `admin_id`;
ALTER TABLE `organizations` ADD `admin_id` BIGINT(20) NULL AFTER `id`, ADD `creator_id` BIGINT(20) NULL AFTER `admin_id`;

-- ** chinmay **24/08/2022**
ALTER TABLE `inventory_order_rentable_items` ADD `barcode_number` VARCHAR(255) NULL DEFAULT NULL AFTER `total_price`;

-- chinmay **13.09.2022**
ALTER TABLE `house_repair_requests` ADD `verification_data` LONGTEXT NULL DEFAULT NULL AFTER `verification_document`;
ALTER TABLE `house_repair_requests` ADD `reject_housecaptain_id` VARCHAR(255) NULL DEFAULT NULL AFTER `house_captain_id`;

-- chinmay **15.09.2022**
ALTER TABLE `house_repair_requests` ADD `housecaptain_feedback` LONGTEXT NULL DEFAULT NULL AFTER `rejected_house_captains`;

ALTER TABLE `inventories` ADD `update_quantity` VARCHAR(255) NULL DEFAULT NULL AFTER `available_quantity`;

ALTER TABLE `house_repair_requests` ADD `email` VARCHAR(255) NOT NULL AFTER `street`;
ALTER TABLE `house_repair_requests` ADD `user_status` ENUM('accepted','rejected','pending') NOT NULL DEFAULT 'pending' AFTER `status`;

ALTER TABLE `house_repair_requests` ADD `housecaptain_image_verify` VARCHAR(255) NULL DEFAULT NULL AFTER `housecaptain_feedback`;

ALTER TABLE `house_repair_requests` ADD `housecaptain_inspection_id` VARCHAR(255) NULL DEFAULT NULL AFTER `housecaptain_image_verify`;

ALTER TABLE `house_repair_requests` ADD `reject_request` LONGTEXT NULL DEFAULT NULL AFTER `rejected_house_captains`;

-- new
ALTER TABLE `notifications` CHANGE `link` `link` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `house_repair_requests` ADD `user_accept_id` BIGINT NULL DEFAULT NULL AFTER `user_status`;
ALTER TABLE `house_repair_requests` ADD `admin_accept_id` BIGINT NULL DEFAULT NULL AFTER `user_accept_id`;
ALTER TABLE `house_repair_requests` ADD `completed_date` VARCHAR(255) NULL DEFAULT NULL AFTER `admin_accept_id`;

ALTER TABLE `notifications` CHANGE `user_type` `user_type` ENUM('admin','housecaptain','warehousemanager','field assistant') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;