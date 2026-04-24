# JobSquare — Migration SQL → MongoDB

## Stratégie de modélisation NoSQL

### Principes appliqués
- **Embedding** : données souvent consultées ensemble → un seul document
- **Referencing** : données volumineuses ou partagées → référence par ObjectId
- **Dénormalisation ciblée** : champs fréquemment lus dupliqués pour éviter les jointures

---

## Collections MongoDB

### 1. `users`
Fusion de : `users`, `users_properties`, `user_profile_fields`, `user_profile_field_list`, `users_featured`, `user_listing`, `facebook`, `linkedin`, `session`, `user_sessions`

```json
{
  "_id": ObjectId,
  "username": String,
  "password": String,         // bcrypt hash
  "email": String,            // unique index
  "role": "jobseeker" | "employer" | "admin",
  "active": Boolean,
  "verification_key": String,
  "featured": Boolean,
  "ip": String,
  "reference_uid": String,
  "registration_date": ISODate,

  // Profil commun
  "profile": {
    "full_name": String,
    "phone": String,
    "location": {
      "city": String,
      "state": String,          // Gouvernorat
      "country": String,
      "zip_code": String,
      "latitude": Number,
      "longitude": Number
    },
    "gender": String,
    "birth_date": ISODate,
    "website": String,
    "logo": String,             // URL
    "private_space": String
  },

  // Profil Employer
  "company": {
    "name": String,
    "description": String,
    "commercial_register": String,
    "sector": String
  },

  // Profil JobSeeker (embedded CV data)
  "cv": {
    "model_sid": Number,
    "color_sid": Number,
    "experiences": [
      {
        "title": String,
        "company": String,
        "start_date": ISODate,
        "end_date": ISODate,
        "description": String
      }
    ],
    "education": [
      {
        "degree": String,
        "institution": String,
        "year": Number
      }
    ],
    "skills": [String],
    "languages": [String],
    "uploaded_cv_path": String
  },

  // Intégrations sociales
  "social": {
    "facebook": { "id": String, "token": String },
    "linkedin": { "id": String, "token": String }
  },

  // Stats
  "counter_cv_access": Number,
  "trial": Object,

  // Timestamps
  "created_at": ISODate,
  "updated_at": ISODate
}
```
**Index** : `email` (unique), `role`, `profile.location.state`, `company.sector`

---

### 2. `listings`
Fusion de : `listings`, `listings_active_period`, `listings_properties`, `listing_complex_fields`, `listing_types`, `listing_fields`, `listing_field_list`, `listing_feeds`, `listings_to_jobg8`, `jobg8_listings_properties`, `jobg8_mapping`

```json
{
  "_id": ObjectId,
  "listing_type": "job_offer" | "cv",
  "user_id": ObjectId,         // ref → users

  // Données employeur dénormalisées (perf)
  "employer_snapshot": {
    "user_id": ObjectId,
    "company_name": String,
    "logo": String,
    "location_city": String
  },

  "title": String,
  "active": Boolean,
  "featured": Boolean,
  "views": Number,
  "access_type": "everyone" | "no_one",
  "access_list": [ObjectId],

  // Dates
  "activation_date": ISODate,
  "expiration_date": ISODate,
  "created_at": ISODate,
  "updated_at": ISODate,

  // Contenu offre d'emploi
  "job": {
    "category": String,
    "employment_type": String,    // CDI, CDD, Stage...
    "description": String,
    "requirements": String,
    "skills": [String],
    "study_level": String,
    "experience": String,
    "salary_min": Number,
    "salary_max": Number,
    "salary_currency": String,
    "motorized": Boolean,
    "licence": Boolean,
    "location": {
      "state": String,
      "city": String,
      "country": String,
      "latitude": Number,
      "longitude": Number
    }
  },

  // Contenu CV
  "cv": {
    "objective": String,
    "formation_description": String
  },

  // SEO / Feed
  "keywords": [String],
  "external_id": String,
  "data_source": Number,
  "contract_id": Number,
  "preview": Boolean,
  "product_info": Object
}
```
**Index** : `user_id`, `active`, `listing_type`, `job.category`, `job.location.state`, `expiration_date`, text(`title`, `job.description`)

---

### 3. `applications`
Fusion de : `applications`

```json
{
  "_id": ObjectId,
  "listing_id": ObjectId,      // ref → listings
  "jobseeker_id": ObjectId,    // ref → users

  // Snapshot dénormalisé
  "jobseeker_snapshot": {
    "full_name": String,
    "email": String,
    "phone": String,
    "username": String
  },
  "listing_snapshot": {
    "title": String,
    "company_name": String
  },

  "comments": String,
  "resume": String,
  "file": String,
  "mime_type": String,
  "file_id": String,
  "status": "pending" | "viewed" | "shortlisted" | "rejected" | "accepted",
  "hidden": Boolean,
  "notes": String,
  "seen": Boolean,
  "last_seen_at": ISODate,
  "order": Number,
  "created_at": ISODate,
  "updated_at": ISODate
}
```
**Index** : `listing_id`, `jobseeker_id`, `status`, compound(`listing_id`, `jobseeker_id`, unique)

---

### 4. `contracts`
Fusion de : `contracts`, `contract_packages`, `products`, `invoices`, `transactions`, `promotions`, `promotions_history`, `shopping_cart`

```json
{
  "_id": ObjectId,
  "user_id": ObjectId,
  "product": {
    "sid": Number,
    "name": String,
    "price": Number,
    "listing_type_sid": Number,
    "number_of_listings": Number,
    "listing_duration": Number,
    "expiration_period": Number,
    "featured": Boolean,
    "post_job": Boolean,
    "post_resume": Boolean,
    "resume_access": Boolean
  },
  "status": "active" | "expired" | "cancelled",
  "creation_date": ISODate,
  "expired_date": ISODate,
  "price": Number,
  "gateway_id": String,
  "invoice_id": String,
  "number_of_postings": Number,
  "transactions": [
    {
      "gateway": String,
      "amount": Number,
      "status": String,
      "date": ISODate
    }
  ],
  "promotions": [
    {
      "code": String,
      "discount": Number,
      "applied_at": ISODate
    }
  ]
}
```

---

### 5. `blog_posts`
Fusion de : `blog`, `blog_category`

```json
{
  "_id": ObjectId,
  "title": String,
  "slug": String,
  "content": String,
  "category": { "id": Number, "name": String },
  "author_id": ObjectId,
  "active": Boolean,
  "created_at": ISODate,
  "updated_at": ISODate
}
```

---

### 6. `settings` (collection singleton-like)
Fusion de : `settings`, `email_templates`, `payment_gateways`, `payment_gateways_properties`, `navigation_menu`, `pages`, `banners`, `banner_groups`, `breadcrumbs_structure`, `browse`, `refine_search`, `posting_pages`, `permissions`

```json
{
  "_id": ObjectId,
  "key": String,               // unique
  "value": Mixed,
  "group": String,
  "updated_at": ISODate
}
```

---

### 7. `uploaded_files`
```json
{
  "_id": ObjectId,
  "user_id": ObjectId,
  "filename": String,
  "path": String,
  "mime_type": String,
  "size": Number,
  "created_at": ISODate
}
```

---

## Mapping résumé (60 → 7 collections)

| Tables SQL originales | Collection MongoDB |
|---|---|
| users, users_properties, user_profile_fields, user_profile_field_list, users_featured, user_listing, facebook, linkedin, session, user_sessions | **users** |
| listings, listings_active_period, listings_properties, listing_complex_fields, listing_types, listing_fields, listing_field_list, listing_feeds, listings_to_jobg8, jobg8_listings_properties, jobg8_mapping | **listings** |
| applications | **applications** |
| contracts, contract_packages, products, invoices, transactions, promotions, promotions_history, shopping_cart | **contracts** |
| blog, blog_category | **blog_posts** |
| settings, email_templates, payment_gateways, payment_gateways_properties, navigation_menu, pages, banners, banner_groups, breadcrumbs_structure, browse, refine_search, posting_pages, permissions, secteurs, countries, states, cities, parsers, admins, user_groups, user_groups_properties, messages, task_scheduler_log, guest_alerts, resume_colors, resume_models | **settings** (+ seeders) |
| uploaded_files | **uploaded_files** |