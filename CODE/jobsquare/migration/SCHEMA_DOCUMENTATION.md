# Documentation du Schéma MongoDB

**Base de données**: jobsquaremadb

**Date de migration**: 2026-04-23 09:54:51

**Nombre total de collections**: 60

---

## Collection: `admins`

**Nombre de documents**: 2

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `name` | varchar(255) | Oui | - |
| `email` | varchar(255) | Oui | - |
| `password` | varchar(255) | Oui | - |
| `owner` | int(11) | Oui | 0 |
| `permissions_type` | varchar(255) | Oui | - |
| `permissions` | varchar(255) | Oui | - |
| `status` | varchar(255) | Oui | Pending |
| `recover_key` | varchar | Oui | - |

---

## Collection: `applications`

**Nombre de documents**: 50

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `id` | int(10) | Non | - |
| `listing_id` | int(11) | Non | - |
| `jobseeker_id` | int(11) | Non | - |
| `comments` | text | Non | - |
| `date` | datetime | Non | - |
| `resume` | varchar(255) | Non | - |
| `file` | text | Oui | - |
| `mime_type` | varchar(255) | Non | - |
| `file_id` | text | Non | - |
| `username` | varchar(255) | Oui | - |
| `email` | varchar(100) | Oui | - |
| `hidden` | tinyint(4) | Non | 0 |
| `status` | varchar(255) | Oui | - |
| `order` | double | Non | 9999 |
| `notes` | text | Oui | - |
| `deja_vu` | int(1) | Non | 0 |
| `date_last_vu` | date | Non | - |
| `Phone` | varchar | Oui | - |

---

## Collection: `banner_groups`

**Nombre de documents**: 7

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `id` | varchar(20) | Non | - |
| `number_banners_display_at_once` | int | Oui | - |

---

## Collection: `banners`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `id` | int(11) | Non | - |
| `user_sid` | int(11) | Oui | - |
| `title` | text | Non | - |
| `link` | text | Non | - |
| `image_path` | text | Non | - |
| `show` | int(11) | Non | 0 |
| `width` | int(11) | Non | - |
| `height` | int(11) | Non | - |
| `type` | varchar(255) | Non | - |
| `click` | int(11) | Non | 0 |
| `active` | tinyint(1) | Non | 0 |
| `groupSID` | int(11) | Non | - |
| `param` | varchar(20) | Oui |  |
| `openBannerIn` | varchar(255) | Oui | - |
| `bannerType` | enum | Oui | - |
| `code` | text | Oui | - |
| `status` | enum | Oui | - |
| `contract_sid` | int | Oui | - |

---

## Collection: `blog`

**Nombre de documents**: 17

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `date` | date | Oui | - |
| `title` | varchar(255) | Oui | - |
| `text` | longtext | Oui | - |
| `active` | tinyint(1) | Non | 0 |
| `keywords` | varchar(255) | Oui | - |
| `description` | varchar(255) | Oui | - |
| `image` | varchar(255) | Oui | - |
| `url` | varchar | Oui | - |

---

## Collection: `blog_category`

**Nombre de documents**: 31

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `blog_id` | int(11) | Non | - |
| `category` | varchar(255) | Non | - |
| `url` | varchar | Oui | - |

---

## Collection: `breadcrumbs_structure`

**Nombre de documents**: 3

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `id` | int(11) | Non | - |
| `parent_id` | int(11) | Non | 0 |
| `name` | varchar(255) | Non | - |
| `uri` | varchar | Oui | - |

---

## Collection: `browse`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `page_uri` | varchar(255) | Non | - |
| `parameters` | text | Oui | - |

---

## Collection: `cities`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `name` | varchar(255) | Non | - |
| `state_sid` | int(11) | Non | - |
| `country_sid` | int | Oui | - |

---

## Collection: `contract_packages`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `id` | int(10) | Non | - |
| `class_name` | varchar(255) | Oui | - |
| `contract_id` | int(10) | Oui | - |

---

## Collection: `contracts`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `id` | int(10) | Non | - |
| `user_sid` | int(10) | Non | - |
| `product_sid` | int(11) | Non | 0 |
| `creation_date` | date | Oui | - |
| `expired_date` | date | Oui | - |
| `price` | float | Oui | - |
| `serialized_extra_info` | text | Oui | - |
| `gateway_id` | varchar(255) | Oui | - |
| `invoice_id` | varchar(255) | Oui | - |
| `number_of_postings` | int(11) | Non | 0 |
| `status` | varchar | Oui | - |

---

## Collection: `countries`

**Nombre de documents**: 1

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `name` | varchar | Oui | - |

---

## Collection: `email_templates`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `name` | varchar(255) | Oui | - |
| `group` | varchar(255) | Oui | - |
| `cc` | varchar(100) | Oui | - |
| `subject` | varchar(254) | Oui | - |
| `text` | text | Oui | - |
| `hidden` | tinyint | Oui | - |

---

## Collection: `facebook`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `facebook_id` | varchar(255) | Non | - |
| `access` | text | Non | - |

---

## Collection: `guest_alerts`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `email` | varchar(255) | Oui | - |
| `data` | text | Oui | - |
| `last_send` | datetime | Oui | - |
| `email_frequency` | enum | Oui | - |
| `subscription_date` | datetime | Oui | - |
| `status` | tinyint(4) | Non | 1 |
| `alert_key` | varchar | Oui | - |

---

## Collection: `invoices`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `user_sid` | int(10) | Oui | - |
| `date` | datetime | Oui | - |
| `payment_method` | varchar(255) | Oui | - |
| `sub_total` | double | Oui | 0 |
| `total` | double | Oui | 0 |
| `serialized_items_info` | text | Oui | - |
| `serialized_tax_info` | text | Oui | - |
| `status` | varchar(255) | Oui | - |
| `include_tax` | tinyint(4) | Oui | - |
| `callback_data` | text | Oui | - |
| `product_sid` | varchar(255) | Oui | - |
| `status_paid` | tinyint(1) | Non | 0 |
| `recurring_id` | varchar | Oui | - |

---

## Collection: `jobg8_listings_properties`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `listingSid` | int(10) | Non | - |
| `jobReference` | varchar(100) | Oui | - |
| `jobType` | varchar | Oui | - |

---

## Collection: `jobg8_mapping`

**Nombre de documents**: 33

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `type` | varchar(255) | Non | - |
| `jobg8_field_value` | varchar(255) | Non | - |
| `sjb_field_value` | varchar(255) | Oui | - |
| `allow` | tinyint | Oui | - |

---

## Collection: `linkedin`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `linkedin_id` | varchar(255) | Non | - |
| `access` | text | Non | - |

---

## Collection: `listing_complex_fields`

**Nombre de documents**: 11

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `field_sid` | int(10) | Oui | - |
| `id` | varchar(255) | Oui | - |
| `order` | int(10) | Oui | - |
| `caption` | varchar(255) | Oui | - |
| `type` | varchar(255) | Oui | - |
| `is_required` | tinyint(1) | Non | 0 |
| `maximum` | float | Oui | - |
| `minimum` | float | Oui | - |
| `maxlength` | varchar(255) | Oui | - |
| `template` | varchar(255) | Oui | - |
| `choiceLimit` | int | Oui | - |

---

## Collection: `listing_feeds`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `name` | varchar(100) | Non | - |
| `template` | varchar(200) | Non | - |
| `description` | text | Non | - |
| `mime_type` | varchar(255) | Non | application/rss+xml |
| `id` | varchar(255) | Non | - |
| `order` | int | Oui | - |

---

## Collection: `listing_field_list`

**Nombre de documents**: 488

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `field_sid` | int(10) | Oui | - |
| `order` | int(10) | Oui | - |
| `value` | varchar | Oui | - |

---

## Collection: `listing_fields`

**Nombre de documents**: 66

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `id` | varchar(255) | Oui | - |
| `listing_type_sid` | int(10) | Non | 0 |
| `order` | int(10) | Oui | - |
| `caption` | varchar(255) | Oui | - |
| `type` | varchar(50) | Oui | - |
| `default_value` | varchar(255) | Oui | - |
| `is_required` | tinyint(1) | Non | 0 |
| `maxlength` | varchar(255) | Oui |  |
| `width` | int(5) | Oui | 0 |
| `height` | int(5) | Oui | 0 |
| `second_width` | int(5) | Oui | 0 |
| `second_height` | int(5) | Oui | 0 |
| `template` | varchar(255) | Oui | - |
| `minimum` | float | Oui | 0 |
| `maximum` | float | Oui | 0 |
| `choiceLimit` | int(11) | Oui | 0 |
| `add_parameter` | varchar(20) | Oui | - |
| `parent_sid` | int(10) | Oui | - |
| `hidden` | tinyint(1) | Non | 0 |
| `display_as` | varchar | Oui | - |

---

## Collection: `listing_types`

**Nombre de documents**: 3

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `id` | varchar(255) | Oui | - |
| `name` | varchar(255) | Oui | - |
| `show_brief_or_detailed` | tinyint(1) | Non | 0 |
| `waitApprove` | tinyint(1) | Non | 0 |
| `email_alert` | int(5) | Oui | - |
| `guest_alert_email` | int | Oui | - |

---

## Collection: `listings`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `listing_type_sid` | int(10) | Non | 0 |
| `user_sid` | int(10) | Oui | - |
| `product_info` | text | Oui | - |
| `active` | tinyint(4) | Oui | 0 |
| `keywords` | longtext | Oui | - |
| `featured` | tinyint(4) | Non | 0 |
| `views` | int(11) | Non | 0 |
| `activation_date` | datetime | Oui | - |
| `expiration_date` | datetime | Oui | - |
| `featured_last_showed` | datetime | Oui | - |
| `access_type` | enum | Oui | - |
| `access_list` | text | Oui | - |
| `contract_id` | int(10) | Non | 0 |
| `data_source` | int(10) | Oui | - |
| `external_id` | varchar(1000) | Oui | - |
| `Title` | varchar(255) | Oui | - |
| `JobCategory` | text | Oui | - |
| `EmploymentType` | text | Oui | - |
| `JobDescription` | longtext | Oui | - |
| `JobRequirements` | longtext | Oui | - |
| `Objective` | longtext | Oui | - |
| `Skills` | longtext | Oui | - |
| `preview` | tinyint(1) | Oui | 0 |
| `FormationDescription` | longtext | Oui | - |
| `Motorized` | tinyint(1) | Oui | - |
| `Study` | text | Oui | - |
| `Experience` | text | Oui | - |
| `Licence` | tinyint(1) | Oui | - |
| `Location_State` | text | Oui | - |
| `Location_ZipCode` | varchar(255) | Oui | - |
| `Resume` | varchar(255) | Oui | - |
| `Location_City` | varchar(255) | Oui | - |
| `Location_pays` | int(11) | Non | - |
| `Location_gouvernorat` | int(11) | Non | - |
| `Location_ville` | int(11) | Non | - |
| `Location` | varchar(500) | Oui | - |
| `complex` | longtext | Oui | - |
| `checkouted` | tinyint(1) | Non | 1 |
| `Photo` | varchar(255) | Oui | - |
| `Phone` | varchar(255) | Oui | - |
| `OtherPhone` | varchar(256) | Oui | - |
| `GooglePlace` | varchar(255) | Oui | - |
| `Location_Latitude` | double | Oui | - |
| `Location_Longitude` | double | Oui | - |
| `application_redirects` | int(11) | Non | 0 |
| `id_Training_Categories` | text | Oui | - |
| `id_Training_Lieu` | varchar(255) | Oui | - |
| `Duree` | varchar(255) | Oui | - |
| `Location_Country` | text | Oui | - |
| `id_Job_Nombredepostesvacants` | int(10) | Oui | - |
| `id_Job_Experience` | text | Oui | - |
| `id_Job_Niveaudtude` | text | Oui | - |
| `id_Job_Rmunrationpropose` | text | Oui | - |
| `id_Job_Langue` | text | Oui | - |
| `id_Job_Genre` | text | Oui | - |
| `id_Job_Position` | int(10) | Oui | - |
| `id_Job_Nombredepostesouverts` | int(10) | Oui | - |
| `id_Job_Postesvacants` | int(10) | Oui | - |
| `id_Job_Vacancy` | int(10) | Oui | - |
| `id_Job_Vacancies` | text | Oui | - |
| `id_Job_MotsCls` | varchar(255) | Oui | - |
| `id_Resume_careerlevel` | int(10) | Non | - |
| `salary` | int(11) | Oui | - |
| `id_Resume_CurrentStatus` | int(10) | Oui | - |
| `Linkedin_link` | varchar(300) | Non | - |
| `Facebook_link` | varchar(300) | Non | - |
| `Twitter_link` | varchar(300) | Non | - |
| `Behance_link` | varchar(300) | Non | - |
| `Instagram_link` | varchar(300) | Non | - |
| `GitHub_link` | varchar(300) | Non | - |
| `StackOverflow_link` | varchar(300) | Non | - |
| `YouTube_link` | varchar(300) | Non | - |
| `Blog_link` | varchar(300) | Non | - |
| `Website_link` | varchar(300) | Non | - |
| `Other_link` | varchar(300) | Non | - |
| `cin_file` | varchar(255) | Non | - |
| `book_file` | varchar(255) | Non | - |
| `diploma_file` | varchar(255) | Non | - |
| `resume_modele_sid` | int(10) | Non | - |
| `modele_color` | int(10) | Non | - |
| `update_date` | datetime | Non | - |
| `date_add` | datetime | Non | - |
| `email_notify` | tinyint(1) | Non | 1 |
| `listing_alert_mesage` | varchar | Oui | - |

---

## Collection: `listings_active_period`

**Nombre de documents**: 28

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `listing_sid` | int(10) | Non | - |
| `number_of_days` | int(10) | Oui | 0 |
| `featured_period` | int | Oui | - |

---

## Collection: `listings_properties`

**Nombre de documents**: 36

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `object_sid` | int(10) | Oui | - |
| `id` | varchar(255) | Oui | - |
| `value` | text | Oui | - |
| `add_parameter` | varchar(255) | Oui | - |
| `complex_enum` | int | Oui | - |

---

## Collection: `listings_to_jobg8`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `listing_sid` | int(10) | Non | - |
| `action` | varchar(10) | Non | - |
| `postingType` | enum | Oui | - |

---

## Collection: `messages`

**Nombre de documents**: 11

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `message` | varchar | Oui | - |

---

## Collection: `navigation_menu`

**Nombre de documents**: 52

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `id` | int(11) | Non | - |
| `name` | varchar(255) | Non | - |
| `url` | varchar(255) | Non | - |
| `parent` | int | Oui | - |

---

## Collection: `pages`

**Nombre de documents**: 4

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `uri` | varchar(255) | Non |  |
| `pass_parameters_via_uri` | int(11) | Oui | - |
| `module` | varchar(255) | Non |  |
| `function` | varchar(255) | Non |  |
| `template` | varchar(255) | Oui | - |
| `title` | varchar(255) | Oui | - |
| `access_type` | varchar(25) | Non |  |
| `parameters` | text | Non | - |
| `keywords` | text | Oui | - |
| `description` | text | Non | - |
| `ID` | int(10) | Non | - |

---

## Collection: `parsers`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `id` | int(11) | Non | - |
| `type_id` | int(11) | Non | 0 |
| `name` | varchar(100) | Oui | - |
| `description` | text | Non | - |
| `url` | text | Non | - |
| `usr_id` | int(11) | Non | 0 |
| `usr_name` | varchar(255) | Oui | - |
| `maper` | text | Oui | - |
| `default_value` | text | Oui | - |
| `maper_user` | text | Oui | - |
| `default_value_user` | text | Oui | - |
| `xml` | text | Non | - |
| `active` | tinyint(3) | Non | 0 |
| `add_new_user` | tinyint(1) | Non | 0 |
| `username` | varchar(255) | Non | - |
| `external_id` | varchar(255) | Oui | 0 |
| `product_sid` | int(10) | Oui | - |
| `import_type` | varchar | Oui | - |

---

## Collection: `payment_gateways`

**Nombre de documents**: 8

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `id` | varchar(64) | Non |  |
| `name` | varchar(255) | Oui | - |
| `caption` | varchar(255) | Oui | - |
| `active` | tinyint(4) | Oui | - |
| `position` | int | Oui | - |

---

## Collection: `payment_gateways_properties`

**Nombre de documents**: 20

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `object_sid` | int(10) | Oui | - |
| `id` | varchar(255) | Oui | - |
| `value` | text | Oui | - |
| `add_parameter` | varchar | Oui | - |

---

## Collection: `permissions`

**Nombre de documents**: 52

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `id` | int(11) | Non | - |
| `type` | varchar(255) | Non | - |
| `name` | varchar(255) | Non | - |
| `role` | varchar(255) | Non | - |
| `value` | varchar(255) | Non | - |
| `params` | varchar(255) | Oui | - |

---

## Collection: `posting_pages`

**Nombre de documents**: 9

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `page_id` | varchar(255) | Oui | - |
| `page_name` | varchar(255) | Oui | - |
| `description` | text | Oui | - |
| `listing_type_sid` | int(10) | Oui | - |
| `order` | int | Oui | - |

---

## Collection: `products`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `name` | varchar(255) | Oui | - |
| `detailed_description` | text | Oui | - |
| `user_group_sid` | int(11) | Oui | - |
| `availability_from` | datetime | Oui | - |
| `availability_to` | datetime | Oui | - |
| `trial` | tinyint(1) | Non | 0 |
| `active` | tinyint(1) | Non | 0 |
| `serialized_extra_info` | text | Oui | - |
| `order` | int(11) | Non | 1 |
| `number_of_postings` | int(11) | Non | 0 |
| `recurring` | tinyint(4) | Non | 0 |
| `deleted` | tinyint | Oui | - |

---

## Collection: `promotions`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `code` | varchar(255) | Oui | - |
| `discount` | float | Oui | - |
| `type` | enum | Oui | - |
| `product_sid` | text | Oui | - |
| `maximum_uses` | int(11) | Oui | 0 |
| `start_date` | datetime | Oui | - |
| `end_date` | datetime | Oui | - |
| `active` | tinyint | Oui | - |

---

## Collection: `promotions_history`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `user_sid` | int(10) | Oui | - |
| `code_sid` | int(10) | Oui | - |
| `invoice_sid` | int(10) | Oui | - |
| `product_sid` | varchar(255) | Oui | - |
| `date` | datetime | Oui | - |
| `code_info` | text | Oui | - |
| `amount` | float | Oui | - |
| `paid` | tinyint | Oui | - |

---

## Collection: `refine_search`

**Nombre de documents**: 19

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `id` | int(10) | Non | - |
| `field_id` | int(10) | Non | - |
| `listing_type_sid` | int(10) | Non | - |
| `order` | int(10) | Non | 0 |
| `user_field` | tinyint | Oui | - |

---

## Collection: `relations_listing_fields_posting_pages`

**Nombre de documents**: 73

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `field_sid` | int(10) | Non | - |
| `page_sid` | int(10) | Non | - |
| `listing_type_sid` | int(10) | Non | - |
| `order` | int | Oui | - |

---

## Collection: `resume_colors`

**Nombre de documents**: 50

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `modele_sid` | int(10) | Non | - |
| `color` | varchar(255) | Non | - |
| `code` | varchar(255) | Non | - |
| `image` | varchar(255) | Non | - |
| `order` | int | Oui | - |

---

## Collection: `resume_models`

**Nombre de documents**: 9

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `name` | varchar(255) | Non | - |
| `image` | varchar(255) | Non | - |
| `template` | varchar(255) | Non | - |
| `template_display` | varchar(255) | Non | - |
| `default_color_sid` | varchar(10) | Non | - |
| `default_color` | varchar(255) | Non | - |
| `order` | int | Oui | - |

---

## Collection: `secteurs`

**Nombre de documents**: 4

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `name` | varchar(255) | Non | - |
| `keywords` | text | Non | - |
| `description` | text | Non | - |
| `url` | varchar(300) | Non | - |
| `picture` | varchar(300) | Non | - |
| `display` | int | Oui | - |

---

## Collection: `session`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `session_id` | varchar(255) | Non | - |
| `user_sid` | int(11) | Non | - |
| `time` | int(11) | Non | - |

---

## Collection: `settings`

**Nombre de documents**: 14

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `name` | varchar(255) | Oui | - |

---

## Collection: `shopping_cart`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `user_sid` | int(11) | Oui | - |

---

## Collection: `states`

**Nombre de documents**: 12

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `name` | varchar(255) | Non | - |
| `country_sid` | int(11) | Non | - |
| `keywords` | text | Non | - |
| `description` | text | Non | - |
| `url` | varchar(300) | Non | - |
| `picture` | varchar(300) | Non | - |
| `display` | int | Oui | - |

---

## Collection: `task_scheduler_log`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `last_executed_date` | datetime | Non | - |
| `notifieds_sent` | int(11) | Non | - |
| `expired_listings` | int(11) | Non | - |
| `expired_contracts` | int(11) | Non | - |

---

## Collection: `transactions`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `transaction_id` | varchar(255) | Non |  |
| `user_sid` | int(10) | Oui | - |
| `invoice_sid` | int(10) | Oui | - |
| `payment_method` | varchar(255) | Oui | - |
| `description` | text | Oui | - |
| `date` | date | Oui | - |

---

## Collection: `uploaded_files`

**Nombre de documents**: 10

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `id` | varchar(255) | Non | - |
| `file_name` | varchar(255) | Oui | - |
| `file_group` | varchar(255) | Oui | - |
| `saved_file_name` | varchar(255) | Oui | - |
| `mime_type` | varchar(255) | Oui | - |
| `creation_time` | varchar | Oui | - |

---

## Collection: `user_groups`

**Nombre de documents**: 2

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `id` | varchar(255) | Oui | - |
| `default_product` | int(11) | Oui | 0 |
| `name` | varchar | Oui | - |

---

## Collection: `user_groups_properties`

**Nombre de documents**: 10

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `object_sid` | int(10) | Oui | - |
| `id` | varchar(255) | Oui | - |
| `value` | text | Oui | - |
| `add_parameter` | varchar | Oui | - |

---

## Collection: `user_listing`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(11) | Non | - |
| `user_id` | int(11) | Oui | - |
| `listing_id` | int(11) | Oui | - |
| `status` | enum | Oui | - |

---

## Collection: `user_profile_field_list`

**Nombre de documents**: 60

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `field_sid` | int(10) | Oui | - |
| `order` | int(10) | Oui | - |
| `value` | varchar | Oui | - |

---

## Collection: `user_profile_fields`

**Nombre de documents**: 26

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `user_group_sid` | int(10) | Oui | - |
| `order` | int(10) | Oui | - |
| `id` | varchar(255) | Oui | - |
| `caption` | varchar(255) | Oui | - |
| `type` | varchar(50) | Oui | - |
| `default_value` | varchar(255) | Oui | - |
| `is_required` | tinyint(1) | Non | 0 |
| `maxlength` | int(10) | Oui | - |
| `width` | int(5) | Oui | - |
| `height` | int(5) | Oui | - |
| `second_width` | int(5) | Oui | - |
| `second_height` | int(5) | Oui | - |
| `template` | varchar(255) | Oui | - |
| `parent_sid` | int(10) | Oui | - |
| `hidden` | tinyint(1) | Non | 0 |
| `display_as` | varchar(255) | Oui | - |
| `choiceLimit` | int | Oui | - |

---

## Collection: `user_sessions`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `session_key` | varchar(32) | Non |  |
| `user_sid` | int(11) | Non | 0 |
| `remote_ip` | varchar(32) | Non |  |
| `user_agent` | varchar(255) | Non |  |
| `start` | int | Oui | - |

---

## Collection: `users`

**Nombre de documents**: 189

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `username` | varchar(255) | Oui | - |
| `password` | varchar(255) | Oui | - |
| `email` | varchar(255) | Oui | - |
| `user_group_sid` | int(10) | Oui | - |
| `registration_date` | datetime | Oui | - |
| `active` | int(1) | Oui | 0 |
| `verification_key` | varchar(255) | Oui | - |
| `featured` | tinyint(4) | Non | 0 |
| `ip` | varchar(15) | Oui | - |
| `reference_uid` | varchar(255) | Oui | - |
| `Location_City` | varchar(255) | Oui | - |
| `Phone` | varchar(255) | Oui | - |
| `CompanyName` | varchar(255) | Oui | - |
| `FullName` | varchar(255) | Oui | - |
| `WebSite` | varchar(255) | Oui | - |
| `Logo` | varchar(255) | Oui | - |
| `trial` | text | Oui | - |
| `CommercialRegister` | varchar(255) | Oui | - |
| `Location_Country` | text | Oui | - |
| `CompanyDescription` | text | Oui | - |
| `PrivateSpace` | varchar(255) | Oui | - |
| `CounterCvAccess` | int(3) | Non | 0 |
| `Secteur` | text | Oui | - |
| `Gender` | text | Oui | - |
| `birth` | datetime | Oui | - |
| `Gouvernorat` | text | Oui | - |
| `Location_State` | text | Oui | - |
| `Location_ZipCode` | varchar(255) | Oui | - |
| `Location_Latitude` | double | Oui | - |
| `Location_Longitude` | double | Oui | - |
| `GooglePlace` | varchar(255) | Oui | - |
| `Location` | text | Oui | - |
| `extUserID` | varchar(255) | Oui | - |

---

## Collection: `users_featured`

**Nombre de documents**: 5

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `username` | varchar(255) | Oui | - |
| `password` | varchar(255) | Oui | - |
| `email` | varchar(255) | Oui | - |
| `user_group_sid` | int(10) | Oui | - |
| `registration_date` | datetime | Oui | - |
| `active` | int(1) | Oui | 0 |
| `verification_key` | varchar(255) | Oui | - |
| `featured` | tinyint(4) | Non | 0 |
| `ip` | varchar(15) | Oui | - |
| `reference_uid` | varchar(255) | Oui | - |
| `Location_City` | varchar(255) | Oui | - |
| `Phone` | varchar(255) | Oui | - |
| `CompanyName` | varchar(255) | Oui | - |
| `FullName` | varchar(255) | Oui | - |
| `WebSite` | varchar(255) | Oui | - |
| `Logo` | varchar(255) | Oui | - |
| `trial` | text | Oui | - |
| `CommercialRegister` | varchar(255) | Oui | - |
| `Location_Country` | text | Oui | - |
| `CompanyDescription` | text | Oui | - |
| `PrivateSpace` | varchar(255) | Oui | - |
| `CounterCvAccess` | int(3) | Non | 0 |
| `Secteur` | text | Oui | - |
| `Gender` | text | Oui | - |
| `birth` | datetime | Oui | - |
| `Gouvernorat` | text | Oui | - |
| `Location_State` | text | Oui | - |
| `Location_ZipCode` | varchar(255) | Oui | - |
| `Location_Latitude` | double | Oui | - |
| `Location_Longitude` | double | Oui | - |
| `GooglePlace` | varchar(255) | Oui | - |
| `Location` | text | Oui | - |
| `extUserID` | varchar(255) | Oui | - |
| `api_key` | varchar | Oui | - |

---

## Collection: `users_properties`

**Nombre de documents**: 0

### Schéma des champs

| Champ | Type SQL | Nullable | Défaut |
|-------|----------|----------|--------|
| `sid` | int(10) | Non | - |
| `object_sid` | int(10) | Oui | - |
| `id` | varchar(255) | Oui | - |
| `value` | text | Oui | - |
| `add_parameter` | varchar | Oui | - |

---

