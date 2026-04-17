-- ================================================================
-- FICHIER SQL DE NETTOYAGE ET INSERTION DE DONNÉES
-- Pour système de recommandation JobSquare
-- Généré le: 2026-04-17 13:56:21
-- ================================================================

-- ================================================================
-- PARTIE 1: NETTOYAGE DES BALISES HTML
-- ================================================================

-- Nettoyage de la table blog (colonne text)
UPDATE blog 
SET text = REGEXP_REPLACE(
    REGEXP_REPLACE(
        REGEXP_REPLACE(
            REGEXP_REPLACE(text, '<[^>]+>', ''),
            '&[a-zA-Z]+;', ' '
        ),
        '\r\n', ' '
    ),
    '  +', ' '
)
WHERE text LIKE '%<%';

-- Nettoyage de la table listings (colonne JobDescription)
UPDATE listings 
SET JobDescription = REGEXP_REPLACE(
    REGEXP_REPLACE(
        REGEXP_REPLACE(
            REGEXP_REPLACE(JobDescription, '<[^>]+>', ''),
            '&[a-zA-Z]+;', ' '
        ),
        '\r\n', ' '
    ),
    '  +', ' '
)
WHERE JobDescription LIKE '%<%';

-- Nettoyage de la table listings (colonne JobRequirements)
UPDATE listings 
SET JobRequirements = REGEXP_REPLACE(
    REGEXP_REPLACE(
        REGEXP_REPLACE(
            REGEXP_REPLACE(JobRequirements, '<[^>]+>', ''),
            '&[a-zA-Z]+;', ' '
        ),
        '\r\n', ' '
    ),
    '  +', ' '
)
WHERE JobRequirements LIKE '%<%';

-- Nettoyage de la table users (colonne CompanyDescription)
UPDATE users 
SET CompanyDescription = REGEXP_REPLACE(
    REGEXP_REPLACE(
        REGEXP_REPLACE(
            REGEXP_REPLACE(CompanyDescription, '<[^>]+>', ''),
            '&[a-zA-Z]+;', ' '
        ),
        '\r\n', ' '
    ),
    '  +', ' '
)
WHERE CompanyDescription LIKE '%<%';

-- ================================================================
-- PARTIE 2: INSERTION DES DONNÉES POUR SYSTÈME DE RECOMMANDATION
-- ================================================================

-- ================================================================
-- INSERTION DE 150 UTILISATEURS CANDIDATS
-- ================================================================

INSERT INTO `users` (`sid`, `username`, `password`, `email`, `user_group_sid`, `registration_date`, `active`, `verification_key`, `featured`, `ip`, `reference_uid`, `Location_City`, `Phone`, `CompanyName`, `FullName`, `WebSite`, `Logo`, `trial`, `CommercialRegister`, `Location_Country`, `CompanyDescription`, `PrivateSpace`, `CounterCvAccess`, `Secteur`, `Gender`, `birth`, `Gouvernorat`, `Location_State`, `Location_ZipCode`, `Location_Latitude`, `Location_Longitude`, `GooglePlace`, `Location`, `extUserID`, `update_at`) VALUES
(2000000, 'said.el idrissi0@email.ma', 'said.el idrissi0@email.ma', 'said.el idrissi0@email.ma', 
        36, '2026-02-09 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212626038128', 
        NULL, 'Said El Idrissi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Qualité, Production, Maintenance, Agronomie, Agroalimentaire', NULL, 0, '2012', 
        'Homme', 
        '1999-01-28 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-04-03'),
(2000001, 'aicha.lamrani1@email.ma', 'aicha.lamrani1@email.ma', 'aicha.lamrani1@email.ma', 
        36, '2024-11-12 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212608731751', 
        NULL, 'Aicha Lamrani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Radiologie, Assistance médicale, Médecine, Pharmacie, Transport, Supply chain, Optimisation logistique', NULL, 0, '2003', 
        'Homme', 
        '2004-03-12 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-04-03'),
(2000002, 'karim.el idrissi2@email.ma', 'karim.el idrissi2@email.ma', 'karim.el idrissi2@email.ma', 
        36, '2024-11-06 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212683818457', 
        NULL, 'Karim El Idrissi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Paie, Recrutement, Gestion RH, SQL, Cloud, Node.js', NULL, 0, '2002', 
        'Femme', 
        '1997-11-14 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-03-25'),
(2000003, 'karim.fassi3@email.ma', 'karim.fassi3@email.ma', 'karim.fassi3@email.ma', 
        36, '2024-05-15 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212616081044', 
        NULL, 'Karim Fassi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Excel, Fiscalité, Comptabilité, Analyse financière, Négociation commerciale, Commerce international, Vente B2B, Paie', NULL, 0, '2005', 
        'Femme', 
        '1996-08-10 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-02-17'),
(2000004, 'nadia.el alaoui4@email.ma', 'nadia.el alaoui4@email.ma', 'nadia.el alaoui4@email.ma', 
        36, '2025-04-20 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212645185387', 
        NULL, 'Nadia El Alaoui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: SEO, Social Media, Stratégie marketing, Google Ads, Agroalimentaire, Production agricole, Agriculture, Formation', NULL, 0, '2006', 
        'Homme', 
        '2002-06-05 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-03-29'),
(2000005, 'laila.lamrani5@email.ma', 'laila.lamrani5@email.ma', 'laila.lamrani5@email.ma', 
        36, '2025-08-17 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212771511447', 
        NULL, 'Laila Lamrani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Électricité, Génie mécanique, Formation, Recrutement', NULL, 0, '2001', 
        'Homme', 
        '2003-05-27 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-04-16'),
(2000006, 'samira.el kettani6@email.ma', 'samira.el kettani6@email.ma', 'samira.el kettani6@email.ma', 
        36, '2025-03-03 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Rabat', '+212759631914', 
        NULL, 'Samira El Kettani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Droit du travail, Gestion RH, Négociation, Prospection, Vente, Pharmacie, Soins infirmiers, Assistance médicale', NULL, 0, '2010', 
        'Femme', 
        '2002-09-28 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.0209, -6.8417, 
        'Rabat, Maroc', 
        'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, '2026-04-10'),
(2000007, 'salma.alami7@email.ma', 'salma.alami7@email.ma', 'salma.alami7@email.ma', 
        36, '2025-01-20 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212700143599', 
        NULL, 'Salma Alami', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Content marketing, Social Media, SEO, Comptabilité, Fiscalité, Analyse financière', NULL, 0, '2008', 
        'Homme', 
        '1999-07-01 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-04-16'),
(2000008, 'laila.chraibi8@email.ma', 'laila.chraibi8@email.ma', 'laila.chraibi8@email.ma', 
        36, '2025-06-07 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212707401894', 
        NULL, 'Laila Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Pédagogie, Gestion de classe, Paie, Recrutement, Droit du travail, Accueil, Gestion administrative', NULL, 0, '2013', 
        'Femme', 
        '1996-12-23 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-02-16'),
(2000009, 'amina.benjelloun9@email.ma', 'amina.benjelloun9@email.ma', 'amina.benjelloun9@email.ma', 
        36, '2025-08-10 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212706836083', 
        NULL, 'Amina Benjelloun', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Gestion de chantier, Autocad, Génie civil, Accueil, Bureautique', NULL, 0, '2001', 
        'Homme', 
        '2002-06-04 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-02-21'),
(2000010, 'amina.bennani10@email.ma', 'amina.bennani10@email.ma', 'amina.bennani10@email.ma', 
        36, '2026-02-13 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212697336892', 
        NULL, 'Amina Bennani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Pharmacie, Médecine, Production, Génie mécanique, Maintenance, Qualité', NULL, 0, '2014', 
        'Femme', 
        '1997-06-25 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-04-12'),
(2000011, 'youssef.lamrani11@email.ma', 'youssef.lamrani11@email.ma', 'youssef.lamrani11@email.ma', 
        36, '2024-11-15 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Fès', '+212720248532', 
        NULL, 'Youssef Lamrani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Supply chain, Transport, Soins infirmiers, Médecine, Pharmacie, Accueil, Organisation, Secrétariat', NULL, 0, '2008', 
        'Femme', 
        '2003-09-19 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 34.0181, -5.0078, 
        'Fès, Maroc', 
        'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, '2026-03-16'),
(2000012, 'salma.bennis12@email.ma', 'salma.bennis12@email.ma', 'salma.bennis12@email.ma', 
        36, '2024-07-08 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Casablanca', '+212711098340', 
        NULL, 'Salma Bennis', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Bureautique, Organisation, Gestion administrative, Accueil, Assistance médicale, Pharmacie', NULL, 0, '2015', 
        'Homme', 
        '2000-11-26 13:56:21', 'Casablanca-Settat', 
        'Casablanca-Settat', NULL, 33.5731, -7.5898, 
        'Casablanca, Maroc', 
        'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, '2026-03-17'),
(2000013, 'nadia.fassi13@email.ma', 'nadia.fassi13@email.ma', 'nadia.fassi13@email.ma', 
        36, '2024-11-23 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212772682765', 
        NULL, 'Nadia Fassi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Génie civil, Gestion de chantier, Autocad, BTP, Paie, Gestion RH, Formation, Droit du travail', NULL, 0, '2003', 
        'Femme', 
        '1998-04-21 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-02-27'),
(2000014, 'aicha.el idrissi14@email.ma', 'aicha.el idrissi14@email.ma', 'aicha.el idrissi14@email.ma', 
        36, '2026-03-18 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212781608858', 
        NULL, 'Aicha El Idrissi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Génie civil, Autocad, Conduite de travaux, Techniques de vente, Vente, Relationnel, CRM', NULL, 0, '2013', 
        'Homme', 
        '2001-04-16 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-04-03'),
(2000015, 'aicha.lamrani15@email.ma', 'aicha.lamrani15@email.ma', 'aicha.lamrani15@email.ma', 
        36, '2024-08-14 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212790755011', 
        NULL, 'Aicha Lamrani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Relationnel, Techniques de vente, Vente, Prospection, SEO, Content marketing, Restauration, Animation', NULL, 0, '2003', 
        'Homme', 
        '2006-04-22 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-04-15'),
(2000016, 'karim.el idrissi16@email.ma', 'karim.el idrissi16@email.ma', 'karim.el idrissi16@email.ma', 
        36, '2024-05-04 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212649477818', 
        NULL, 'Karim El Idrissi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Pharmacie, Radiologie, Assistance médicale, Soins infirmiers, Analyse financière, SAP, Fiscalité, Stratégie marketing', NULL, 0, '2002', 
        'Femme', 
        '2003-04-06 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-03-03'),
(2000017, 'mohammed.alami17@email.ma', 'mohammed.alami17@email.ma', 'mohammed.alami17@email.ma', 
        36, '2024-12-19 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Oujda', '+212776268948', 
        NULL, 'Mohammed Alami', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Agronomie, Agroalimentaire, Contentieux, Droit des affaires, Contrats, Conseil juridique', NULL, 0, '2005', 
        'Femme', 
        '2005-11-17 13:56:21', 'Oriental', 
        'Oriental', NULL, 34.6867, -1.9114, 
        'Oujda, Maroc', 
        'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, '2026-03-25'),
(2000018, 'rachid.el idrissi18@email.ma', 'rachid.el idrissi18@email.ma', 'rachid.el idrissi18@email.ma', 
        36, '2024-11-01 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Marrakech', '+212653857451', 
        NULL, 'Rachid El Idrissi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Accueil, Gestion administrative, Secrétariat, Bureautique, Java, Cloud, Cybersécurité, Node.js', NULL, 0, '2013', 
        'Femme', 
        '2001-09-29 13:56:21', 'Marrakech-Safi', 
        'Marrakech-Safi', NULL, 31.6295, -7.9811, 
        'Marrakech, Maroc', 
        'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, '2026-04-11'),
(2000019, 'mohammed.lamrani19@email.ma', 'mohammed.lamrani19@email.ma', 'mohammed.lamrani19@email.ma', 
        36, '2025-12-29 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212682687046', 
        NULL, 'Mohammed Lamrani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: E-learning, Pédagogie, Prospection, Vente, Négociation', NULL, 0, '2001', 
        'Femme', 
        '2002-03-03 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-03-01'),
(2000020, 'youssef.taoufik20@email.ma', 'youssef.taoufik20@email.ma', 'youssef.taoufik20@email.ma', 
        36, '2025-11-14 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212688127830', 
        NULL, 'Youssef Taoufik', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Médecine, Soins infirmiers, Vente B2B, Négociation commerciale, Merchandising', NULL, 0, '2001', 
        'Femme', 
        '2001-05-18 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-03-21'),
(2000021, 'aicha.chraibi21@email.ma', 'aicha.chraibi21@email.ma', 'aicha.chraibi21@email.ma', 
        36, '2025-11-10 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Marrakech', '+212622711812', 
        NULL, 'Aicha Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Radiologie, Pharmacie, Assistance médicale, Prospection, Relationnel, Techniques de vente, SAP, Fiscalité', NULL, 0, '2012', 
        'Femme', 
        '2003-01-24 13:56:21', 'Marrakech-Safi', 
        'Marrakech-Safi', NULL, 31.6295, -7.9811, 
        'Marrakech, Maroc', 
        'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, '2026-03-19'),
(2000022, 'hassan.bennis22@email.ma', 'hassan.bennis22@email.ma', 'hassan.bennis22@email.ma', 
        36, '2025-01-15 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212728432736', 
        NULL, 'Hassan Bennis', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Négociation commerciale, Vente B2B, Maintenance, Génie mécanique, Qualité', NULL, 0, '2012', 
        'Homme', 
        '2005-11-24 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-04-08'),
(2000023, 'nadia.chraibi23@email.ma', 'nadia.chraibi23@email.ma', 'nadia.chraibi23@email.ma', 
        36, '2025-12-14 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212650410513', 
        NULL, 'Nadia Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Production, Électricité, Génie mécanique, Qualité, Autocad, Conduite de travaux, Gestion de chantier, Génie civil', NULL, 0, '2008', 
        'Homme', 
        '1999-08-17 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-03-17'),
(2000024, 'fatima.chraibi24@email.ma', 'fatima.chraibi24@email.ma', 'fatima.chraibi24@email.ma', 
        36, '2026-02-02 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212656514554', 
        NULL, 'Fatima Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Social Media, Google Ads, Stratégie marketing, Négociation commerciale, Vente B2B, Commerce international, Maintenance, Production', NULL, 0, '2005', 
        'Homme', 
        '2004-11-09 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-04-02'),
(2000025, 'amina.berrada25@email.ma', 'amina.berrada25@email.ma', 'amina.berrada25@email.ma', 
        36, '2024-11-07 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212775333836', 
        NULL, 'Amina Berrada', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Techniques de vente, Négociation, CRM, Radiologie, Pharmacie, Assistance médicale, Soins infirmiers, Marketing digital', NULL, 0, '2011', 
        'Femme', 
        '2003-05-10 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-04-06'),
(2000026, 'omar.taoufik26@email.ma', 'omar.taoufik26@email.ma', 'omar.taoufik26@email.ma', 
        36, '2024-08-09 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Rabat', '+212742193318', 
        NULL, 'Omar Taoufik', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Python, Cloud, DevOps, Pédagogie, Gestion de classe, Formation professionnelle, E-learning', NULL, 0, '2011', 
        'Femme', 
        '2005-07-18 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.0209, -6.8417, 
        'Rabat, Maroc', 
        'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, '2026-03-03'),
(2000027, 'nadia.el alaoui27@email.ma', 'nadia.el alaoui27@email.ma', 'nadia.el alaoui27@email.ma', 
        36, '2024-08-21 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Casablanca', '+212746039317', 
        NULL, 'Nadia El Alaoui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Gestion RH, Recrutement, DevOps, Cloud', NULL, 0, '2008', 
        'Femme', 
        '2005-11-21 13:56:21', 'Casablanca-Settat', 
        'Casablanca-Settat', NULL, 33.5731, -7.5898, 
        'Casablanca, Maroc', 
        'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, '2026-02-17'),
(2000028, 'nadia.sefrioui28@email.ma', 'nadia.sefrioui28@email.ma', 'nadia.sefrioui28@email.ma', 
        36, '2025-02-11 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212637867604', 
        NULL, 'Nadia Sefrioui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Médecine, Assistance médicale, Pharmacie, Radiologie, Secrétariat, Accueil, Bureautique', NULL, 0, '2001', 
        'Femme', 
        '2004-05-24 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-04-13'),
(2000029, 'ahmed.taoufik29@email.ma', 'ahmed.taoufik29@email.ma', 'ahmed.taoufik29@email.ma', 
        36, '2025-09-06 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212670498155', 
        NULL, 'Ahmed Taoufik', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Gestion des stocks, Transport, E-learning, Pédagogie, Formation professionnelle, Agronomie, Production agricole, Agriculture', NULL, 0, '2005', 
        'Homme', 
        '2004-11-23 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-03-15'),
(2000030, 'rachid.benjelloun30@email.ma', 'rachid.benjelloun30@email.ma', 'rachid.benjelloun30@email.ma', 
        36, '2025-10-08 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212644721790', 
        NULL, 'Rachid Benjelloun', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: CRM, Vente, Techniques de vente, Excel, Comptabilité, SAP, Fiscalité, Vente B2B', NULL, 0, '2008', 
        'Homme', 
        '2000-10-03 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-04-16'),
(2000031, 'laila.bennani31@email.ma', 'laila.bennani31@email.ma', 'laila.bennani31@email.ma', 
        36, '2025-08-28 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212644785447', 
        NULL, 'Laila Bennani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Réception, Restauration, Gestion hôtelière, Service client, Gestion RH, Formation, Recrutement, Paie', NULL, 0, '2006', 
        'Femme', 
        '1997-04-08 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-02-24'),
(2000032, 'said.taoufik32@email.ma', 'said.taoufik32@email.ma', 'said.taoufik32@email.ma', 
        36, '2024-12-25 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212754999759', 
        NULL, 'Said Taoufik', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Animation, Gestion hôtelière, Réception, Restauration, Relationnel, CRM, Vente, Techniques de vente', NULL, 0, '2009', 
        'Femme', 
        '1999-12-14 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-02-18'),
(2000033, 'samira.berrada33@email.ma', 'samira.berrada33@email.ma', 'samira.berrada33@email.ma', 
        36, '2025-09-04 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Casablanca', '+212606975076', 
        NULL, 'Samira Berrada', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Optimisation logistique, Transport, Vente, Relationnel, Prospection', NULL, 0, '2008', 
        'Homme', 
        '2006-01-14 13:56:21', 'Casablanca-Settat', 
        'Casablanca-Settat', NULL, 33.5731, -7.5898, 
        'Casablanca, Maroc', 
        'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, '2026-02-26'),
(2000034, 'youssef.el alaoui34@email.ma', 'youssef.el alaoui34@email.ma', 'youssef.el alaoui34@email.ma', 
        36, '2025-09-03 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Rabat', '+212739684827', 
        NULL, 'Youssef El Alaoui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Commerce international, Négociation commerciale, Merchandising, Stratégie marketing, Google Ads, Négociation, Prospection', NULL, 0, '2011', 
        'Femme', 
        '2006-02-02 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.0209, -6.8417, 
        'Rabat, Maroc', 
        'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, '2026-03-20'),
(2000035, 'ahmed.bennis35@email.ma', 'ahmed.bennis35@email.ma', 'ahmed.bennis35@email.ma', 
        36, '2025-03-16 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212794235433', 
        NULL, 'Ahmed Bennis', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Comptabilité, Excel, Fiscalité, Angular, Python, SQL, Cloud', NULL, 0, '2008', 
        'Homme', 
        '2005-08-19 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-03-22'),
(2000036, 'amina.taoufik36@email.ma', 'amina.taoufik36@email.ma', 'amina.taoufik36@email.ma', 
        36, '2025-06-18 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212658760062', 
        NULL, 'Amina Taoufik', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Techniques de vente, CRM, Prospection, Gestion de classe, Pédagogie, E-learning', NULL, 0, '2015', 
        'Homme', 
        '1999-04-28 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-04-02'),
(2000037, 'fatima.el alaoui37@email.ma', 'fatima.el alaoui37@email.ma', 'fatima.el alaoui37@email.ma', 
        36, '2024-12-17 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Rabat', '+212745190127', 
        NULL, 'Fatima El Alaoui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Fiscalité, Comptabilité, Conseil juridique, Contentieux, Droit des affaires, Contrats, Commerce international, Négociation commerciale', NULL, 0, '2007', 
        'Homme', 
        '2003-08-07 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.0209, -6.8417, 
        'Rabat, Maroc', 
        'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, '2026-03-03'),
(2000038, 'hassan.berrada38@email.ma', 'hassan.berrada38@email.ma', 'hassan.berrada38@email.ma', 
        36, '2025-06-25 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212736926405', 
        NULL, 'Hassan Berrada', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Animation, Restauration, Java, Node.js, SQL', NULL, 0, '2008', 
        'Femme', 
        '1996-04-25 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-03-01'),
(2000039, 'omar.bennani39@email.ma', 'omar.bennani39@email.ma', 'omar.bennani39@email.ma', 
        36, '2024-07-02 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212766975322', 
        NULL, 'Omar Bennani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Analyse financière, Excel, Sage, Gestion de classe, Pédagogie', NULL, 0, '2009', 
        'Femme', 
        '2001-08-30 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-03-16'),
(2000040, 'rachid.el idrissi40@email.ma', 'rachid.el idrissi40@email.ma', 'rachid.el idrissi40@email.ma', 
        36, '2024-09-28 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212750485352', 
        NULL, 'Rachid El Idrissi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Droit des affaires, Contrats, Contentieux, Conseil juridique, BTP, Conduite de travaux, Radiologie, Soins infirmiers', NULL, 0, '2008', 
        'Femme', 
        '2001-12-16 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-03-19'),
(2000041, 'mohammed.chraibi41@email.ma', 'mohammed.chraibi41@email.ma', 'mohammed.chraibi41@email.ma', 
        36, '2025-03-05 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Oujda', '+212749324268', 
        NULL, 'Mohammed Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Node.js, React, Java, Python, Production agricole, Agroalimentaire', NULL, 0, '2005', 
        'Homme', 
        '2004-05-17 13:56:21', 'Oriental', 
        'Oriental', NULL, 34.6867, -1.9114, 
        'Oujda, Maroc', 
        'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, '2026-02-25'),
(2000042, 'nadia.benjelloun42@email.ma', 'nadia.benjelloun42@email.ma', 'nadia.benjelloun42@email.ma', 
        36, '2025-10-06 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Casablanca', '+212746364925', 
        NULL, 'Nadia Benjelloun', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Vente, Relationnel, CRM, Prospection, Gestion de chantier, Conduite de travaux, Autocad, Accueil', NULL, 0, '2001', 
        'Femme', 
        '1997-05-15 13:56:21', 'Casablanca-Settat', 
        'Casablanca-Settat', NULL, 33.5731, -7.5898, 
        'Casablanca, Maroc', 
        'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, '2026-03-24'),
(2000043, 'samira.el kettani43@email.ma', 'samira.el kettani43@email.ma', 'samira.el kettani43@email.ma', 
        36, '2026-02-19 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Casablanca', '+212726692887', 
        NULL, 'Samira El Kettani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Marketing digital, SEO, Google Ads, Stratégie marketing, Fiscalité, Sage, Excel, Comptabilité', NULL, 0, '2007', 
        'Homme', 
        '1997-06-26 13:56:21', 'Casablanca-Settat', 
        'Casablanca-Settat', NULL, 33.5731, -7.5898, 
        'Casablanca, Maroc', 
        'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, '2026-04-13'),
(2000044, 'laila.bennis44@email.ma', 'laila.bennis44@email.ma', 'laila.bennis44@email.ma', 
        36, '2025-05-27 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212666547878', 
        NULL, 'Laila Bennis', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Cybersécurité, Node.js, Python, Gestion RH, Formation, Secrétariat, Gestion administrative, Accueil', NULL, 0, '2012', 
        'Femme', 
        '1998-07-20 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-03-28'),
(2000045, 'rachid.berrada45@email.ma', 'rachid.berrada45@email.ma', 'rachid.berrada45@email.ma', 
        36, '2024-10-25 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212642711265', 
        NULL, 'Rachid Berrada', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: CRM, Techniques de vente, Négociation, Contentieux, Droit des affaires, Conseil juridique, Contrats', NULL, 0, '2005', 
        'Homme', 
        '1998-03-20 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-03-05'),
(2000046, 'laila.tazi46@email.ma', 'laila.tazi46@email.ma', 'laila.tazi46@email.ma', 
        36, '2025-12-04 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212726739335', 
        NULL, 'Laila Tazi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: React, SQL, Qualité, Maintenance, Électricité', NULL, 0, '2015', 
        'Femme', 
        '2002-01-23 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-04-06'),
(2000047, 'omar.el alaoui47@email.ma', 'omar.el alaoui47@email.ma', 'omar.el alaoui47@email.ma', 
        36, '2025-04-14 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212676989509', 
        NULL, 'Omar El Alaoui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Agriculture, Production agricole, Agroalimentaire, Gestion de chantier, Génie civil, Autocad, DevOps, React', NULL, 0, '2007', 
        'Femme', 
        '2003-10-09 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-03-08'),
(2000048, 'amina.fassi48@email.ma', 'amina.fassi48@email.ma', 'amina.fassi48@email.ma', 
        36, '2025-08-04 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Oujda', '+212682552805', 
        NULL, 'Amina Fassi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Formation professionnelle, Gestion de classe, Électricité, Qualité, Génie mécanique, Production, Python, DevOps', NULL, 0, '2011', 
        'Femme', 
        '2004-03-01 13:56:21', 'Oriental', 
        'Oriental', NULL, 34.6867, -1.9114, 
        'Oujda, Maroc', 
        'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, '2026-02-17'),
(2000049, 'karim.berrada49@email.ma', 'karim.berrada49@email.ma', 'karim.berrada49@email.ma', 
        36, '2026-01-15 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212685898782', 
        NULL, 'Karim Berrada', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Merchandising, Vente B2B, Négociation commerciale, Cloud, Cybersécurité, SQL, Python, Restauration', NULL, 0, '2014', 
        'Homme', 
        '2000-06-13 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-02-25'),
(2000050, 'karim.chraibi50@email.ma', 'karim.chraibi50@email.ma', 'karim.chraibi50@email.ma', 
        36, '2024-07-18 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Marrakech', '+212788115887', 
        NULL, 'Karim Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Vente B2B, Commerce international, Négociation commerciale, Réception, Animation, Organisation, Gestion administrative', NULL, 0, '2015', 
        'Femme', 
        '2004-05-13 13:56:21', 'Marrakech-Safi', 
        'Marrakech-Safi', NULL, 31.6295, -7.9811, 
        'Marrakech, Maroc', 
        'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, '2026-03-15'),
(2000051, 'salma.alami51@email.ma', 'salma.alami51@email.ma', 'salma.alami51@email.ma', 
        36, '2026-01-22 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Rabat', '+212732304656', 
        NULL, 'Salma Alami', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Électricité, Génie mécanique, Qualité, Production, Recrutement, Paie, Droit du travail, Accueil', NULL, 0, '2005', 
        'Homme', 
        '1999-12-20 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.0209, -6.8417, 
        'Rabat, Maroc', 
        'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, '2026-03-04'),
(2000052, 'ahmed.el idrissi52@email.ma', 'ahmed.el idrissi52@email.ma', 'ahmed.el idrissi52@email.ma', 
        36, '2025-05-19 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Marrakech', '+212601045652', 
        NULL, 'Ahmed El Idrissi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: SEO, Marketing digital, Google Ads, Content marketing, Paie, Droit du travail, Recrutement, Radiologie', NULL, 0, '2008', 
        'Homme', 
        '2000-04-22 13:56:21', 'Marrakech-Safi', 
        'Marrakech-Safi', NULL, 31.6295, -7.9811, 
        'Marrakech, Maroc', 
        'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, '2026-04-10'),
(2000053, 'aicha.alami53@email.ma', 'aicha.alami53@email.ma', 'aicha.alami53@email.ma', 
        36, '2024-05-13 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212638908446', 
        NULL, 'Aicha Alami', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Animation, Gestion hôtelière, Service client, Analyse financière, Comptabilité, Excel', NULL, 0, '2001', 
        'Femme', 
        '2005-08-25 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-03-26'),
(2000054, 'fatima.el kettani54@email.ma', 'fatima.el kettani54@email.ma', 'fatima.el kettani54@email.ma', 
        36, '2026-03-14 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212729035111', 
        NULL, 'Fatima El Kettani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Pharmacie, Soins infirmiers, Négociation commerciale, Commerce international', NULL, 0, '2012', 
        'Homme', 
        '2005-05-05 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-03-18'),
(2000055, 'ahmed.el alaoui55@email.ma', 'ahmed.el alaoui55@email.ma', 'ahmed.el alaoui55@email.ma', 
        36, '2025-08-26 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Fès', '+212637128471', 
        NULL, 'Ahmed El Alaoui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Commerce international, Négociation commerciale, Vente B2B, Conduite de travaux, Autocad, Gestion de chantier, Génie civil, JavaScript', NULL, 0, '2001', 
        'Homme', 
        '1997-11-19 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 34.0181, -5.0078, 
        'Fès, Maroc', 
        'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, '2026-03-22'),
(2000056, 'youssef.berrada56@email.ma', 'youssef.berrada56@email.ma', 'youssef.berrada56@email.ma', 
        36, '2025-10-27 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212720402533', 
        NULL, 'Youssef Berrada', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: SEO, Google Ads, Formation professionnelle, E-learning', NULL, 0, '2014', 
        'Femme', 
        '2002-12-11 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-03-21'),
(2000057, 'nadia.el alaoui57@email.ma', 'nadia.el alaoui57@email.ma', 'nadia.el alaoui57@email.ma', 
        36, '2025-07-10 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212623441389', 
        NULL, 'Nadia El Alaoui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Droit du travail, Paie, Formation, Recrutement, Pharmacie, Radiologie', NULL, 0, '2008', 
        'Femme', 
        '2002-11-22 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-03-05'),
(2000058, 'fatima.benjelloun58@email.ma', 'fatima.benjelloun58@email.ma', 'fatima.benjelloun58@email.ma', 
        36, '2024-08-22 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Oujda', '+212617269571', 
        NULL, 'Fatima Benjelloun', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Droit des affaires, Contentieux, Conseil juridique, Node.js, JavaScript, Java', NULL, 0, '2014', 
        'Femme', 
        '2001-05-12 13:56:21', 'Oriental', 
        'Oriental', NULL, 34.6867, -1.9114, 
        'Oujda, Maroc', 
        'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, '2026-02-21'),
(2000059, 'laila.fassi59@email.ma', 'laila.fassi59@email.ma', 'laila.fassi59@email.ma', 
        36, '2024-08-08 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212622923042', 
        NULL, 'Laila Fassi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Stratégie marketing, SEO, Content marketing, Merchandising, Vente B2B, Contrats, Droit des affaires, Contentieux', NULL, 0, '2011', 
        'Femme', 
        '2003-10-20 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-04-11'),
(2000060, 'ahmed.chraibi60@email.ma', 'ahmed.chraibi60@email.ma', 'ahmed.chraibi60@email.ma', 
        36, '2024-09-01 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212690957098', 
        NULL, 'Ahmed Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Secrétariat, Bureautique, Accueil, Droit des affaires, Conseil juridique', NULL, 0, '2003', 
        'Homme', 
        '2000-11-21 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-04-02'),
(2000061, 'omar.alami61@email.ma', 'omar.alami61@email.ma', 'omar.alami61@email.ma', 
        36, '2025-01-26 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Casablanca', '+212747111887', 
        NULL, 'Omar Alami', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Relationnel, Prospection, Négociation, Vente, Contentieux, Contrats, Commerce international, Vente B2B', NULL, 0, '2007', 
        'Femme', 
        '2002-06-07 13:56:21', 'Casablanca-Settat', 
        'Casablanca-Settat', NULL, 33.5731, -7.5898, 
        'Casablanca, Maroc', 
        'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, '2026-02-27'),
(2000062, 'zineb.taoufik62@email.ma', 'zineb.taoufik62@email.ma', 'zineb.taoufik62@email.ma', 
        36, '2025-08-17 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212630933592', 
        NULL, 'Zineb Taoufik', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: CAO, Qualité, Maintenance, BTP, Génie civil, Conduite de travaux, Gestion de chantier, E-learning', NULL, 0, '2001', 
        'Homme', 
        '2002-08-24 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-04-12'),
(2000063, 'karim.lazrak63@email.ma', 'karim.lazrak63@email.ma', 'karim.lazrak63@email.ma', 
        36, '2025-07-27 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212658537987', 
        NULL, 'Karim Lazrak', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Maintenance, Qualité, Génie mécanique, Électricité, Médecine, Pharmacie, Soins infirmiers', NULL, 0, '2002', 
        'Homme', 
        '2005-08-01 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-02-27'),
(2000064, 'aicha.berrada64@email.ma', 'aicha.berrada64@email.ma', 'aicha.berrada64@email.ma', 
        36, '2025-10-09 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212760484960', 
        NULL, 'Aicha Berrada', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Organisation, Accueil, Paie, Gestion RH, Recrutement, Formation, Restauration, Animation', NULL, 0, '2011', 
        'Femme', 
        '2005-09-30 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-03-30'),
(2000065, 'zineb.fassi65@email.ma', 'zineb.fassi65@email.ma', 'zineb.fassi65@email.ma', 
        36, '2024-10-09 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Rabat', '+212739167582', 
        NULL, 'Zineb Fassi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Bureautique, Organisation, Accueil, Secrétariat, Optimisation logistique, Supply chain, Gestion des stocks, Soins infirmiers', NULL, 0, '2001', 
        'Femme', 
        '2003-04-25 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.0209, -6.8417, 
        'Rabat, Maroc', 
        'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, '2026-04-12'),
(2000066, 'said.fassi66@email.ma', 'said.fassi66@email.ma', 'said.fassi66@email.ma', 
        36, '2026-02-06 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Oujda', '+212684989266', 
        NULL, 'Said Fassi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Production, Électricité, Maintenance, Merchandising, Commerce international, Gestion RH, Formation, Droit du travail', NULL, 0, '2001', 
        'Homme', 
        '2005-07-30 13:56:21', 'Oriental', 
        'Oriental', NULL, 34.6867, -1.9114, 
        'Oujda, Maroc', 
        'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, '2026-03-24'),
(2000067, 'laila.el idrissi67@email.ma', 'laila.el idrissi67@email.ma', 'laila.el idrissi67@email.ma', 
        36, '2024-09-01 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212649696776', 
        NULL, 'Laila El Idrissi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Agriculture, Production agricole, Commerce international, Merchandising, Pédagogie, Gestion de classe', NULL, 0, '2014', 
        'Homme', 
        '1997-10-04 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-03-09'),
(2000068, 'laila.taoufik68@email.ma', 'laila.taoufik68@email.ma', 'laila.taoufik68@email.ma', 
        36, '2025-01-02 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Fès', '+212679196303', 
        NULL, 'Laila Taoufik', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Contrats, Contentieux, Conseil juridique, Droit des affaires, Vente B2B, Commerce international', NULL, 0, '2005', 
        'Homme', 
        '2001-11-25 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 34.0181, -5.0078, 
        'Fès, Maroc', 
        'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, '2026-04-11'),
(2000069, 'omar.el kettani69@email.ma', 'omar.el kettani69@email.ma', 'omar.el kettani69@email.ma', 
        36, '2025-12-21 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212689628957', 
        NULL, 'Omar El Kettani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Vente, Prospection, CRM, Radiologie, Médecine, Restauration, Service client', NULL, 0, '2004', 
        'Femme', 
        '2001-08-15 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-03-23'),
(2000070, 'aicha.chraibi70@email.ma', 'aicha.chraibi70@email.ma', 'aicha.chraibi70@email.ma', 
        36, '2024-09-09 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212798469544', 
        NULL, 'Aicha Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Qualité, Production, Génie mécanique, Organisation, Accueil, Gestion administrative, Bureautique', NULL, 0, '2009', 
        'Homme', 
        '1997-06-24 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-04-17'),
(2000071, 'laila.lamrani71@email.ma', 'laila.lamrani71@email.ma', 'laila.lamrani71@email.ma', 
        36, '2025-11-19 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Marrakech', '+212722951787', 
        NULL, 'Laila Lamrani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Comptabilité, Sage, Fiscalité, Génie mécanique, Qualité, Électricité, Maintenance, CRM', NULL, 0, '2012', 
        'Homme', 
        '1998-05-09 13:56:21', 'Marrakech-Safi', 
        'Marrakech-Safi', NULL, 31.6295, -7.9811, 
        'Marrakech, Maroc', 
        'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, '2026-02-26'),
(2000072, 'zineb.alami72@email.ma', 'zineb.alami72@email.ma', 'zineb.alami72@email.ma', 
        36, '2024-11-25 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212765420978', 
        NULL, 'Zineb Alami', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Comptabilité, Analyse financière, Excel, Python, Cybersécurité', NULL, 0, '2001', 
        'Femme', 
        '2001-06-15 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-02-24'),
(2000073, 'samira.chraibi73@email.ma', 'samira.chraibi73@email.ma', 'samira.chraibi73@email.ma', 
        36, '2024-09-27 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Oujda', '+212722256386', 
        NULL, 'Samira Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Négociation, Vente, Animation, Gestion hôtelière, Restauration, Réception', NULL, 0, '2014', 
        'Femme', 
        '2006-01-05 13:56:21', 'Oriental', 
        'Oriental', NULL, 34.6867, -1.9114, 
        'Oujda, Maroc', 
        'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, '2026-03-09'),
(2000074, 'youssef.alami74@email.ma', 'youssef.alami74@email.ma', 'youssef.alami74@email.ma', 
        36, '2024-09-23 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212779602847', 
        NULL, 'Youssef Alami', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Paie, Formation, Droit du travail, Recrutement, SAP, Analyse financière, Excel, Fiscalité', NULL, 0, '2013', 
        'Femme', 
        '1997-06-18 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-03-02'),
(2000075, 'amina.el kettani75@email.ma', 'amina.el kettani75@email.ma', 'amina.el kettani75@email.ma', 
        36, '2025-03-14 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212650787787', 
        NULL, 'Amina El Kettani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Qualité, Électricité, CAO, Production, React, SQL', NULL, 0, '2001', 
        'Homme', 
        '2000-05-12 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-03-20'),
(2000076, 'hassan.bennis76@email.ma', 'hassan.bennis76@email.ma', 'hassan.bennis76@email.ma', 
        36, '2025-03-13 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Fès', '+212705892925', 
        NULL, 'Hassan Bennis', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Secrétariat, Accueil, Bureautique, Gestion administrative, Vente B2B, Négociation commerciale, Social Media, Google Ads', NULL, 0, '2014', 
        'Femme', 
        '2001-06-06 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 34.0181, -5.0078, 
        'Fès, Maroc', 
        'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, '2026-03-04'),
(2000077, 'karim.berrada77@email.ma', 'karim.berrada77@email.ma', 'karim.berrada77@email.ma', 
        36, '2024-07-07 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Oujda', '+212729394639', 
        NULL, 'Karim Berrada', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Service client, Animation, Réception, Contentieux, Conseil juridique, Droit des affaires, Contrats', NULL, 0, '2014', 
        'Femme', 
        '2004-01-08 13:56:21', 'Oriental', 
        'Oriental', NULL, 34.6867, -1.9114, 
        'Oujda, Maroc', 
        'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, '2026-02-25'),
(2000078, 'hassan.bennis78@email.ma', 'hassan.bennis78@email.ma', 'hassan.bennis78@email.ma', 
        36, '2025-10-13 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Oujda', '+212688901702', 
        NULL, 'Hassan Bennis', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Formation professionnelle, Pédagogie, Gestion de classe, E-learning, Angular, Java, React, Optimisation logistique', NULL, 0, '2002', 
        'Femme', 
        '1998-05-20 13:56:21', 'Oriental', 
        'Oriental', NULL, 34.6867, -1.9114, 
        'Oujda, Maroc', 
        'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, '2026-02-20'),
(2000079, 'youssef.el alaoui79@email.ma', 'youssef.el alaoui79@email.ma', 'youssef.el alaoui79@email.ma', 
        36, '2024-05-20 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Rabat', '+212658662184', 
        NULL, 'Youssef El Alaoui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Droit des affaires, Conseil juridique, Contrats, Contentieux, Organisation, Secrétariat, Bureautique', NULL, 0, '2012', 
        'Femme', 
        '2003-05-20 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.0209, -6.8417, 
        'Rabat, Maroc', 
        'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, '2026-02-25'),
(2000080, 'ahmed.sefrioui80@email.ma', 'ahmed.sefrioui80@email.ma', 'ahmed.sefrioui80@email.ma', 
        36, '2026-01-06 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212703043566', 
        NULL, 'Ahmed Sefrioui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Gestion hôtelière, Animation, Réception, Paie, Recrutement, Gestion RH, Droit du travail', NULL, 0, '2012', 
        'Femme', 
        '2004-04-07 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-02-20'),
(2000081, 'zineb.berrada81@email.ma', 'zineb.berrada81@email.ma', 'zineb.berrada81@email.ma', 
        36, '2025-07-22 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212660702592', 
        NULL, 'Zineb Berrada', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Assistance médicale, Médecine, Secrétariat, Organisation, Accueil, Bureautique', NULL, 0, '2004', 
        'Homme', 
        '2001-10-17 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-03-27'),
(2000082, 'aicha.lazrak82@email.ma', 'aicha.lazrak82@email.ma', 'aicha.lazrak82@email.ma', 
        36, '2024-11-07 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212727976710', 
        NULL, 'Aicha Lazrak', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Content marketing, Stratégie marketing, SEO, Accueil, Gestion administrative, Secrétariat, Organisation', NULL, 0, '2015', 
        'Femme', 
        '2003-04-15 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-03-10'),
(2000083, 'rachid.berrada83@email.ma', 'rachid.berrada83@email.ma', 'rachid.berrada83@email.ma', 
        36, '2025-12-29 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Marrakech', '+212619206089', 
        NULL, 'Rachid Berrada', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Vente, Techniques de vente, Relationnel, E-learning, Pédagogie, Formation professionnelle, Gestion de classe', NULL, 0, '2005', 
        'Homme', 
        '1997-09-24 13:56:21', 'Marrakech-Safi', 
        'Marrakech-Safi', NULL, 31.6295, -7.9811, 
        'Marrakech, Maroc', 
        'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, '2026-04-16'),
(2000084, 'rachid.el kettani84@email.ma', 'rachid.el kettani84@email.ma', 'rachid.el kettani84@email.ma', 
        36, '2025-04-08 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Fès', '+212660262108', 
        NULL, 'Rachid El Kettani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Négociation commerciale, Commerce international, Vente B2B, Merchandising, Agroalimentaire, Agriculture', NULL, 0, '2010', 
        'Homme', 
        '1996-07-18 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 34.0181, -5.0078, 
        'Fès, Maroc', 
        'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, '2026-02-19'),
(2000085, 'samira.el kettani85@email.ma', 'samira.el kettani85@email.ma', 'samira.el kettani85@email.ma', 
        36, '2024-05-14 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Rabat', '+212727792869', 
        NULL, 'Samira El Kettani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Comptabilité, Excel, Analyse financière, Fiscalité, BTP, Génie civil, Conduite de travaux, Autocad', NULL, 0, '2010', 
        'Femme', 
        '2003-05-30 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.0209, -6.8417, 
        'Rabat, Maroc', 
        'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, '2026-03-04'),
(2000086, 'karim.lazrak86@email.ma', 'karim.lazrak86@email.ma', 'karim.lazrak86@email.ma', 
        36, '2025-01-17 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212679869634', 
        NULL, 'Karim Lazrak', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Génie civil, BTP, Formation, Gestion RH, Droit du travail, Paie, CAO, Génie mécanique', NULL, 0, '2004', 
        'Femme', 
        '2001-07-28 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-02-19'),
(2000087, 'salma.berrada87@email.ma', 'salma.berrada87@email.ma', 'salma.berrada87@email.ma', 
        36, '2026-03-10 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212778021117', 
        NULL, 'Salma Berrada', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Conduite de travaux, BTP, Animation, Restauration, Gestion hôtelière, Service client', NULL, 0, '2009', 
        'Femme', 
        '2005-12-31 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-03-07'),
(2000088, 'aicha.bennani88@email.ma', 'aicha.bennani88@email.ma', 'aicha.bennani88@email.ma', 
        36, '2024-05-15 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Rabat', '+212733239702', 
        NULL, 'Aicha Bennani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Réception, Gestion hôtelière, Restauration, Vente B2B, Merchandising, Commerce international', NULL, 0, '2011', 
        'Homme', 
        '2005-02-27 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.0209, -6.8417, 
        'Rabat, Maroc', 
        'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, '2026-03-17'),
(2000089, 'hassan.bennis89@email.ma', 'hassan.bennis89@email.ma', 'hassan.bennis89@email.ma', 
        36, '2025-05-19 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Rabat', '+212698803529', 
        NULL, 'Hassan Bennis', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Radiologie, Soins infirmiers, Pharmacie, Vente, Relationnel, Techniques de vente, Animation, Service client', NULL, 0, '2003', 
        'Homme', 
        '1997-06-23 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.0209, -6.8417, 
        'Rabat, Maroc', 
        'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, '2026-02-17'),
(2000090, 'mohammed.bennani90@email.ma', 'mohammed.bennani90@email.ma', 'mohammed.bennani90@email.ma', 
        36, '2025-10-26 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Oujda', '+212658913461', 
        NULL, 'Mohammed Bennani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Comptabilité, Fiscalité, JavaScript, Cybersécurité, Gestion de chantier, Conduite de travaux, BTP, Génie civil', NULL, 0, '2012', 
        'Femme', 
        '2001-03-18 13:56:21', 'Oriental', 
        'Oriental', NULL, 34.6867, -1.9114, 
        'Oujda, Maroc', 
        'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, '2026-02-18'),
(2000091, 'amina.lazrak91@email.ma', 'amina.lazrak91@email.ma', 'amina.lazrak91@email.ma', 
        36, '2026-03-04 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212776348452', 
        NULL, 'Amina Lazrak', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Excel, Comptabilité, Social Media, Stratégie marketing, Marketing digital, Google Ads', NULL, 0, '2009', 
        'Homme', 
        '2005-04-11 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-03-05'),
(2000092, 'amina.alami92@email.ma', 'amina.alami92@email.ma', 'amina.alami92@email.ma', 
        36, '2026-02-09 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212715726474', 
        NULL, 'Amina Alami', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Analyse financière, SAP, Comptabilité, Fiscalité, Contentieux, Droit des affaires, Contrats, Maintenance', NULL, 0, '2001', 
        'Homme', 
        '2001-10-10 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-03-04'),
(2000093, 'omar.el kettani93@email.ma', 'omar.el kettani93@email.ma', 'omar.el kettani93@email.ma', 
        36, '2025-04-28 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Fès', '+212626489819', 
        NULL, 'Omar El Kettani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Organisation, Secrétariat, Accueil, BTP, Conduite de travaux, Autocad, Gestion de chantier, Analyse financière', NULL, 0, '2007', 
        'Homme', 
        '1997-09-20 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 34.0181, -5.0078, 
        'Fès, Maroc', 
        'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, '2026-04-03'),
(2000094, 'zineb.el alaoui94@email.ma', 'zineb.el alaoui94@email.ma', 'zineb.el alaoui94@email.ma', 
        36, '2025-09-01 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Oujda', '+212639118531', 
        NULL, 'Zineb El Alaoui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Animation, Réception, Gestion hôtelière, Service client, Vente B2B, Merchandising, Commerce international, Négociation commerciale', NULL, 0, '2009', 
        'Homme', 
        '2005-09-05 13:56:21', 'Oriental', 
        'Oriental', NULL, 34.6867, -1.9114, 
        'Oujda, Maroc', 
        'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, '2026-02-20'),
(2000095, 'karim.el idrissi95@email.ma', 'karim.el idrissi95@email.ma', 'karim.el idrissi95@email.ma', 
        36, '2024-11-03 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212656376269', 
        NULL, 'Karim El Idrissi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Production agricole, Agronomie, Agroalimentaire, Gestion de classe, E-learning, Angular, SQL, Python', NULL, 0, '2013', 
        'Homme', 
        '2003-09-20 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-03-04'),
(2000096, 'mohammed.sefrioui96@email.ma', 'mohammed.sefrioui96@email.ma', 'mohammed.sefrioui96@email.ma', 
        36, '2026-02-16 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212773305993', 
        NULL, 'Mohammed Sefrioui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Comptabilité, Analyse financière, Excel, Merchandising, Vente B2B, Commerce international', NULL, 1, '2010', 
        'Homme', 
        '1998-10-13 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-04-10'),
(2000097, 'ahmed.chraibi97@email.ma', 'ahmed.chraibi97@email.ma', 'ahmed.chraibi97@email.ma', 
        36, '2024-11-27 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212674381931', 
        NULL, 'Ahmed Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Transport, Supply chain, Optimisation logistique, BTP, Gestion de chantier, Gestion RH, Recrutement, Droit du travail', NULL, 0, '2001', 
        'Homme', 
        '1997-02-23 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-04-03'),
(2000098, 'salma.chraibi98@email.ma', 'salma.chraibi98@email.ma', 'salma.chraibi98@email.ma', 
        36, '2024-10-25 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Fès', '+212687957657', 
        NULL, 'Salma Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Contrats, Contentieux, Droit des affaires, Conseil juridique, Cloud, Python, Java', NULL, 0, '2014', 
        'Femme', 
        '1998-11-22 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 34.0181, -5.0078, 
        'Fès, Maroc', 
        'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, '2026-04-06'),
(2000099, 'mohammed.lazrak99@email.ma', 'mohammed.lazrak99@email.ma', 'mohammed.lazrak99@email.ma', 
        36, '2025-04-25 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Casablanca', '+212609921538', 
        NULL, 'Mohammed Lazrak', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Radiologie, Médecine, Électricité, Production, Génie mécanique, Qualité, Conduite de travaux, Gestion de chantier', NULL, 0, '2003', 
        'Homme', 
        '2000-09-03 13:56:21', 'Casablanca-Settat', 
        'Casablanca-Settat', NULL, 33.5731, -7.5898, 
        'Casablanca, Maroc', 
        'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, '2026-04-16'),
(2000100, 'hassan.taoufik100@email.ma', 'hassan.taoufik100@email.ma', 'hassan.taoufik100@email.ma', 
        36, '2024-11-17 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Fès', '+212787836731', 
        NULL, 'Hassan Taoufik', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Gestion de classe, E-learning, Négociation commerciale, Merchandising, Commerce international', NULL, 0, '2006', 
        'Homme', 
        '2001-07-02 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 34.0181, -5.0078, 
        'Fès, Maroc', 
        'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, '2026-03-30'),
(2000101, 'omar.tazi101@email.ma', 'omar.tazi101@email.ma', 'omar.tazi101@email.ma', 
        36, '2024-11-04 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Casablanca', '+212692390144', 
        NULL, 'Omar Tazi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: E-learning, Gestion de classe, Agriculture, Production agricole, Agroalimentaire', NULL, 0, '2012', 
        'Femme', 
        '1997-01-10 13:56:21', 'Casablanca-Settat', 
        'Casablanca-Settat', NULL, 33.5731, -7.5898, 
        'Casablanca, Maroc', 
        'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, '2026-03-25'),
(2000102, 'karim.el alaoui102@email.ma', 'karim.el alaoui102@email.ma', 'karim.el alaoui102@email.ma', 
        36, '2025-08-12 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212654255043', 
        NULL, 'Karim El Alaoui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Génie civil, Conduite de travaux, Gestion de chantier, Agronomie, Agriculture, Contrats, Contentieux, Conseil juridique', NULL, 0, '2014', 
        'Homme', 
        '2000-12-20 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-03-27'),
(2000103, 'samira.el kettani103@email.ma', 'samira.el kettani103@email.ma', 'samira.el kettani103@email.ma', 
        36, '2025-11-17 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Oujda', '+212750465819', 
        NULL, 'Samira El Kettani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Transport, Supply chain, Soins infirmiers, Médecine, Radiologie, Pharmacie', NULL, 0, '2012', 
        'Femme', 
        '1999-09-11 13:56:21', 'Oriental', 
        'Oriental', NULL, 34.6867, -1.9114, 
        'Oujda, Maroc', 
        'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, '2026-04-06'),
(2000104, 'mohammed.lazrak104@email.ma', 'mohammed.lazrak104@email.ma', 'mohammed.lazrak104@email.ma', 
        36, '2025-10-26 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212691447592', 
        NULL, 'Mohammed Lazrak', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Gestion de classe, E-learning, Pédagogie, Formation professionnelle, Paie, Formation', NULL, 0, '2005', 
        'Femme', 
        '1999-02-02 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-02-22'),
(2000105, 'said.chraibi105@email.ma', 'said.chraibi105@email.ma', 'said.chraibi105@email.ma', 
        36, '2024-07-11 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Fès', '+212797803348', 
        NULL, 'Said Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Gestion des stocks, Transport, Optimisation logistique, Supply chain, Assistance médicale, Radiologie, Soins infirmiers, Pédagogie', NULL, 0, '2008', 
        'Femme', 
        '2005-05-02 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 34.0181, -5.0078, 
        'Fès, Maroc', 
        'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, '2026-04-17'),
(2000106, 'said.bennani106@email.ma', 'said.bennani106@email.ma', 'said.bennani106@email.ma', 
        36, '2024-11-24 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212690395687', 
        NULL, 'Said Bennani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Vente B2B, Merchandising, Négociation commerciale, Relationnel, Vente, Prospection', NULL, 0, '2005', 
        'Homme', 
        '1998-11-06 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-04-08'),
(2000107, 'mohammed.chraibi107@email.ma', 'mohammed.chraibi107@email.ma', 'mohammed.chraibi107@email.ma', 
        36, '2025-10-26 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Oujda', '+212789042407', 
        NULL, 'Mohammed Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Médecine, Assistance médicale, Soins infirmiers, Techniques de vente, Vente, Négociation, Relationnel', NULL, 0, '2013', 
        'Femme', 
        '2001-10-01 13:56:21', 'Oriental', 
        'Oriental', NULL, 34.6867, -1.9114, 
        'Oujda, Maroc', 
        'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, '2026-02-26'),
(2000108, 'mohammed.bennani108@email.ma', 'mohammed.bennani108@email.ma', 'mohammed.bennani108@email.ma', 
        36, '2025-07-12 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212743309621', 
        NULL, 'Mohammed Bennani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Électricité, Production, E-learning, Pédagogie, Formation professionnelle, Gestion de classe', NULL, 0, '2012', 
        'Femme', 
        '2001-09-14 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-02-28'),
(2000109, 'rachid.el alaoui109@email.ma', 'rachid.el alaoui109@email.ma', 'rachid.el alaoui109@email.ma', 
        36, '2025-11-12 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Marrakech', '+212693443043', 
        NULL, 'Rachid El Alaoui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: SEO, Google Ads, Gestion de chantier, Autocad', NULL, 0, '2006', 
        'Femme', 
        '2004-05-31 13:56:21', 'Marrakech-Safi', 
        'Marrakech-Safi', NULL, 31.6295, -7.9811, 
        'Marrakech, Maroc', 
        'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, '2026-04-06'),
(2000110, 'mohammed.sefrioui110@email.ma', 'mohammed.sefrioui110@email.ma', 'mohammed.sefrioui110@email.ma', 
        36, '2025-09-21 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Marrakech', '+212714800712', 
        NULL, 'Mohammed Sefrioui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Commerce international, Vente B2B, Négociation commerciale, Merchandising, Supply chain, Transport, Gestion des stocks, Production agricole', NULL, 0, '2002', 
        'Femme', 
        '2005-08-23 13:56:21', 'Marrakech-Safi', 
        'Marrakech-Safi', NULL, 31.6295, -7.9811, 
        'Marrakech, Maroc', 
        'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, '2026-03-05'),
(2000111, 'mohammed.fassi111@email.ma', 'mohammed.fassi111@email.ma', 'mohammed.fassi111@email.ma', 
        36, '2024-07-17 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212759237162', 
        NULL, 'Mohammed Fassi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Secrétariat, Bureautique, Organisation, Gestion administrative, Production agricole, Agronomie, Agroalimentaire', NULL, 0, '2015', 
        'Homme', 
        '2001-01-28 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-03-30'),
(2000112, 'youssef.el alaoui112@email.ma', 'youssef.el alaoui112@email.ma', 'youssef.el alaoui112@email.ma', 
        36, '2025-09-18 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212768920819', 
        NULL, 'Youssef El Alaoui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Bureautique, Accueil, Secrétariat, Soins infirmiers, Pharmacie, SAP, Fiscalité, Comptabilité', NULL, 0, '2006', 
        'Femme', 
        '2004-04-19 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-04-09'),
(2000113, 'samira.el kettani113@email.ma', 'samira.el kettani113@email.ma', 'samira.el kettani113@email.ma', 
        36, '2024-11-13 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212797936735', 
        NULL, 'Samira El Kettani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Contentieux, Droit des affaires, Gestion administrative, Bureautique, Accueil', NULL, 0, '2002', 
        'Homme', 
        '2006-04-18 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-03-15'),
(2000114, 'samira.berrada114@email.ma', 'samira.berrada114@email.ma', 'samira.berrada114@email.ma', 
        36, '2025-11-24 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212783118726', 
        NULL, 'Samira Berrada', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Soins infirmiers, Radiologie, Assistance médicale, Médecine, Optimisation logistique, Supply chain, Gestion des stocks', NULL, 0, '2007', 
        'Femme', 
        '1998-09-08 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-03-09'),
(2000115, 'omar.lamrani115@email.ma', 'omar.lamrani115@email.ma', 'omar.lamrani115@email.ma', 
        36, '2025-12-28 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212713103118', 
        NULL, 'Omar Lamrani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Accueil, Secrétariat, Bureautique, SQL, Node.js, Java', NULL, 0, '2012', 
        'Femme', 
        '1997-03-23 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-03-31'),
(2000116, 'aicha.bennani116@email.ma', 'aicha.bennani116@email.ma', 'aicha.bennani116@email.ma', 
        36, '2024-05-17 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Rabat', '+212758417991', 
        NULL, 'Aicha Bennani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Électricité, Maintenance, Génie mécanique, Production, Assistance médicale, Soins infirmiers', NULL, 0, '2008', 
        'Homme', 
        '1996-08-28 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.0209, -6.8417, 
        'Rabat, Maroc', 
        'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, '2026-02-22'),
(2000117, 'ahmed.fassi117@email.ma', 'ahmed.fassi117@email.ma', 'ahmed.fassi117@email.ma', 
        36, '2025-08-29 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212627738722', 
        NULL, 'Ahmed Fassi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Gestion hôtelière, Réception, Optimisation logistique, Gestion des stocks, Transport, React, Python, Node.js', NULL, 0, '2006', 
        'Homme', 
        '2003-01-04 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-04-07'),
(2000118, 'zineb.el alaoui118@email.ma', 'zineb.el alaoui118@email.ma', 'zineb.el alaoui118@email.ma', 
        36, '2025-11-07 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Oujda', '+212625040454', 
        NULL, 'Zineb El Alaoui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Maintenance, Qualité, Électricité, Paie, Droit du travail, Gestion RH, Recrutement, Transport', NULL, 0, '2014', 
        'Homme', 
        '2005-03-20 13:56:21', 'Oriental', 
        'Oriental', NULL, 34.6867, -1.9114, 
        'Oujda, Maroc', 
        'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, '2026-03-12'),
(2000119, 'salma.fassi119@email.ma', 'salma.fassi119@email.ma', 'salma.fassi119@email.ma', 
        36, '2024-08-25 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212704630356', 
        NULL, 'Salma Fassi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Python, Cybersécurité, DevOps, Node.js, Pharmacie, Radiologie, Soins infirmiers, Accueil', NULL, 0, '2009', 
        'Femme', 
        '1997-09-03 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-03-22'),
(2000120, 'fatima.lamrani120@email.ma', 'fatima.lamrani120@email.ma', 'fatima.lamrani120@email.ma', 
        36, '2025-11-19 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212611530301', 
        NULL, 'Fatima Lamrani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Prospection, Négociation, Relationnel, Gestion de chantier, Génie civil, Autocad, Conduite de travaux, Cybersécurité', NULL, 0, '2003', 
        'Homme', 
        '1996-08-27 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-02-24'),
(2000121, 'salma.el alaoui121@email.ma', 'salma.el alaoui121@email.ma', 'salma.el alaoui121@email.ma', 
        36, '2024-09-24 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212766047237', 
        NULL, 'Salma El Alaoui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Négociation, Vente, Relationnel, Agriculture, Agronomie, Agroalimentaire, Sage, Fiscalité', NULL, 0, '2009', 
        'Homme', 
        '2000-07-19 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-04-16'),
(2000122, 'samira.benjelloun122@email.ma', 'samira.benjelloun122@email.ma', 'samira.benjelloun122@email.ma', 
        36, '2025-12-31 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Rabat', '+212671743210', 
        NULL, 'Samira Benjelloun', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Contrats, Contentieux, Droit des affaires, Commerce international, Vente B2B', NULL, 0, '2001', 
        'Femme', 
        '1998-08-01 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.0209, -6.8417, 
        'Rabat, Maroc', 
        'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, '2026-03-17'),
(2000123, 'amina.el idrissi123@email.ma', 'amina.el idrissi123@email.ma', 'amina.el idrissi123@email.ma', 
        36, '2025-05-22 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Marrakech', '+212653574956', 
        NULL, 'Amina El Idrissi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Soins infirmiers, Pharmacie, Social Media, Marketing digital, Content marketing, Conseil juridique, Contrats, Droit des affaires', NULL, 0, '2005', 
        'Homme', 
        '2003-02-13 13:56:21', 'Marrakech-Safi', 
        'Marrakech-Safi', NULL, 31.6295, -7.9811, 
        'Marrakech, Maroc', 
        'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, '2026-02-16'),
(2000124, 'said.lamrani124@email.ma', 'said.lamrani124@email.ma', 'said.lamrani124@email.ma', 
        36, '2026-03-04 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212732584456', 
        NULL, 'Said Lamrani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Fiscalité, Analyse financière, DevOps, Java, SQL, Cloud', NULL, 0, '2009', 
        'Homme', 
        '2000-11-22 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-03-15'),
(2000125, 'zineb.bennani125@email.ma', 'zineb.bennani125@email.ma', 'zineb.bennani125@email.ma', 
        36, '2025-09-05 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Fès', '+212781357957', 
        NULL, 'Zineb Bennani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Supply chain, Optimisation logistique, Formation professionnelle, Pédagogie, E-learning, Gestion de classe, Social Media, Stratégie marketing', NULL, 0, '2004', 
        'Homme', 
        '2003-07-30 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 34.0181, -5.0078, 
        'Fès, Maroc', 
        'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, '2026-03-03'),
(2000126, 'ahmed.el idrissi126@email.ma', 'ahmed.el idrissi126@email.ma', 'ahmed.el idrissi126@email.ma', 
        36, '2025-04-05 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Marrakech', '+212657644950', 
        NULL, 'Ahmed El Idrissi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Supply chain, Transport, Optimisation logistique, Agroalimentaire, Production agricole, Agronomie, Production, Qualité', NULL, 0, '2012', 
        'Femme', 
        '1998-06-25 13:56:21', 'Marrakech-Safi', 
        'Marrakech-Safi', NULL, 31.6295, -7.9811, 
        'Marrakech, Maroc', 
        'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, '2026-03-15'),
(2000127, 'karim.chraibi127@email.ma', 'karim.chraibi127@email.ma', 'karim.chraibi127@email.ma', 
        36, '2026-01-13 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Casablanca', '+212756462885', 
        NULL, 'Karim Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Assistance médicale, Radiologie, Pharmacie, Soins infirmiers, Production, Électricité, Qualité', NULL, 0, '2002', 
        'Homme', 
        '1998-10-06 13:56:21', 'Casablanca-Settat', 
        'Casablanca-Settat', NULL, 33.5731, -7.5898, 
        'Casablanca, Maroc', 
        'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, '2026-04-07'),
(2000128, 'amina.bennis128@email.ma', 'amina.bennis128@email.ma', 'amina.bennis128@email.ma', 
        36, '2025-01-29 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Agadir', '+212612781987', 
        NULL, 'Amina Bennis', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Gestion administrative, Organisation, Agronomie, Agroalimentaire, Électricité, Génie mécanique, Production, CAO', NULL, 0, '2013', 
        'Femme', 
        '1997-08-11 13:56:21', 'Souss-Massa', 
        'Souss-Massa', NULL, 30.4278, -9.5981, 
        'Agadir, Maroc', 
        'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, '2026-03-05'),
(2000129, 'salma.chraibi129@email.ma', 'salma.chraibi129@email.ma', 'salma.chraibi129@email.ma', 
        36, '2024-07-19 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Casablanca', '+212698822011', 
        NULL, 'Salma Chraibi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Médecine, Assistance médicale, Soins infirmiers, Contentieux, Droit des affaires, Conseil juridique, Contrats, Prospection', NULL, 0, '2004', 
        'Homme', 
        '2001-11-07 13:56:21', 'Casablanca-Settat', 
        'Casablanca-Settat', NULL, 33.5731, -7.5898, 
        'Casablanca, Maroc', 
        'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, '2026-04-13'),
(2000130, 'ahmed.el idrissi130@email.ma', 'ahmed.el idrissi130@email.ma', 'ahmed.el idrissi130@email.ma', 
        36, '2025-03-12 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212683789123', 
        NULL, 'Ahmed El Idrissi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Radiologie, Pharmacie, Agroalimentaire, Agriculture, Production agricole, Agronomie', NULL, 0, '2003', 
        'Femme', 
        '2000-09-04 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-03-04'),
(2000131, 'youssef.alami131@email.ma', 'youssef.alami131@email.ma', 'youssef.alami131@email.ma', 
        36, '2025-07-15 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Oujda', '+212625397382', 
        NULL, 'Youssef Alami', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Prospection, CRM, Relationnel, Bureautique, Gestion administrative, Accueil', NULL, 0, '2001', 
        'Homme', 
        '1997-05-01 13:56:21', 'Oriental', 
        'Oriental', NULL, 34.6867, -1.9114, 
        'Oujda, Maroc', 
        'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, '2026-03-17'),
(2000132, 'laila.berrada132@email.ma', 'laila.berrada132@email.ma', 'laila.berrada132@email.ma', 
        36, '2025-01-07 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212609989815', 
        NULL, 'Laila Berrada', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Techniques de vente, Prospection, Vente, Relationnel, Agronomie, Agroalimentaire', NULL, 0, '2011', 
        'Homme', 
        '2001-07-08 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-03-29'),
(2000133, 'youssef.el idrissi133@email.ma', 'youssef.el idrissi133@email.ma', 'youssef.el idrissi133@email.ma', 
        36, '2024-05-02 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212754351651', 
        NULL, 'Youssef El Idrissi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: SAP, Analyse financière, Fiscalité, Python, Java, JavaScript, Cybersécurité, Service client', NULL, 0, '2007', 
        'Homme', 
        '1996-10-15 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-03-20'),
(2000134, 'rachid.bennani134@email.ma', 'rachid.bennani134@email.ma', 'rachid.bennani134@email.ma', 
        36, '2025-09-02 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Casablanca', '+212774143309', 
        NULL, 'Rachid Bennani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Formation, Droit du travail, Pédagogie, Formation professionnelle, Contentieux, Droit des affaires, Conseil juridique', NULL, 0, '2005', 
        'Homme', 
        '2000-02-04 13:56:21', 'Casablanca-Settat', 
        'Casablanca-Settat', NULL, 33.5731, -7.5898, 
        'Casablanca, Maroc', 
        'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, '2026-03-11'),
(2000135, 'mohammed.taoufik135@email.ma', 'mohammed.taoufik135@email.ma', 'mohammed.taoufik135@email.ma', 
        36, '2025-07-01 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212624556882', 
        NULL, 'Mohammed Taoufik', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Soins infirmiers, Médecine, Formation, Recrutement, Paie, Gestion RH, E-learning, Pédagogie', NULL, 0, '2009', 
        'Femme', 
        '1997-09-02 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-03-14'),
(2000136, 'hassan.benjelloun136@email.ma', 'hassan.benjelloun136@email.ma', 'hassan.benjelloun136@email.ma', 
        36, '2024-05-17 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Fès', '+212602042713', 
        NULL, 'Hassan Benjelloun', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Gestion des stocks, Transport, Supply chain, Optimisation logistique, Négociation commerciale, Merchandising, Commerce international, Vente B2B', NULL, 0, '2001', 
        'Femme', 
        '1996-09-05 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 34.0181, -5.0078, 
        'Fès, Maroc', 
        'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, '2026-03-25'),
(2000137, 'ahmed.taoufik137@email.ma', 'ahmed.taoufik137@email.ma', 'ahmed.taoufik137@email.ma', 
        36, '2025-05-09 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212602867418', 
        NULL, 'Ahmed Taoufik', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Autocad, Gestion de chantier, Conduite de travaux, Génie civil, Pédagogie, E-learning', NULL, 0, '2005', 
        'Femme', 
        '2004-05-18 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-02-27'),
(2000138, 'mohammed.fassi138@email.ma', 'mohammed.fassi138@email.ma', 'mohammed.fassi138@email.ma', 
        36, '2025-08-11 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tanger', '+212764062698', 
        NULL, 'Mohammed Fassi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Gestion des stocks, Supply chain, Optimisation logistique, Transport, Génie civil, Gestion de chantier, Conduite de travaux', NULL, 0, '2011', 
        'Femme', 
        '1997-06-03 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.7595, -5.834, 
        'Tanger, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, '2026-03-25'),
(2000139, 'salma.lamrani139@email.ma', 'salma.lamrani139@email.ma', 'salma.lamrani139@email.ma', 
        36, '2026-03-04 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Fès', '+212759778398', 
        NULL, 'Salma Lamrani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Prospection, Vente, Techniques de vente, Contrats, Contentieux', NULL, 0, '2010', 
        'Femme', 
        '2004-06-04 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 34.0181, -5.0078, 
        'Fès, Maroc', 
        'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, '2026-03-17'),
(2000140, 'zineb.sefrioui140@email.ma', 'zineb.sefrioui140@email.ma', 'zineb.sefrioui140@email.ma', 
        36, '2025-08-05 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Rabat', '+212796397598', 
        NULL, 'Zineb Sefrioui', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Réception, Animation, Agronomie, Agriculture, Production agricole, Agroalimentaire', NULL, 0, '2008', 
        'Homme', 
        '2001-09-14 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.0209, -6.8417, 
        'Rabat, Maroc', 
        'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, '2026-03-12'),
(2000141, 'rachid.fassi141@email.ma', 'rachid.fassi141@email.ma', 'rachid.fassi141@email.ma', 
        36, '2025-05-18 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212627914778', 
        NULL, 'Rachid Fassi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Qualité, Maintenance, Conduite de travaux, Génie civil', NULL, 0, '2010', 
        'Homme', 
        '2006-02-17 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-02-28'),
(2000142, 'aicha.berrada142@email.ma', 'aicha.berrada142@email.ma', 'aicha.berrada142@email.ma', 
        36, '2024-08-31 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212620748966', 
        NULL, 'Aicha Berrada', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: DevOps, Java, JavaScript, SEO, Social Media, Stratégie marketing, Agroalimentaire, Agriculture', NULL, 0, '2015', 
        'Homme', 
        '2000-03-15 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-03-23'),
(2000143, 'said.el kettani143@email.ma', 'said.el kettani143@email.ma', 'said.el kettani143@email.ma', 
        36, '2026-01-07 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212776869100', 
        NULL, 'Said El Kettani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Autocad, BTP, Conduite de travaux, Pharmacie, Médecine, Soins infirmiers, Supply chain, Gestion des stocks', NULL, 0, '2012', 
        'Femme', 
        '2002-12-08 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-04-05'),
(2000144, 'nadia.alami144@email.ma', 'nadia.alami144@email.ma', 'nadia.alami144@email.ma', 
        36, '2025-12-17 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212743412392', 
        NULL, 'Nadia Alami', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Analyse financière, Excel, SAP, Fiscalité, Négociation commerciale, Vente B2B, E-learning, Gestion de classe', NULL, 0, '2004', 
        'Femme', 
        '1999-05-16 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-04-05'),
(2000145, 'salma.tazi145@email.ma', 'salma.tazi145@email.ma', 'salma.tazi145@email.ma', 
        36, '2024-05-03 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Kénitra', '+212714946942', 
        NULL, 'Salma Tazi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Production agricole, Agroalimentaire, Agriculture, Agronomie, Fiscalité, Sage, BTP, Conduite de travaux', NULL, 0, '2014', 
        'Homme', 
        '1999-05-28 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.261, -6.5802, 
        'Kénitra, Maroc', 
        'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, '2026-02-24'),
(2000146, 'samira.benjelloun146@email.ma', 'samira.benjelloun146@email.ma', 'samira.benjelloun146@email.ma', 
        36, '2025-09-06 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Meknès', '+212743153433', 
        NULL, 'Samira Benjelloun', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Animation, Service client, Agroalimentaire, Agronomie, Agriculture, Production agricole', NULL, 0, '2007', 
        'Homme', 
        '1997-12-27 13:56:21', 'Fès-Meknès', 
        'Fès-Meknès', NULL, 33.8935, -5.5473, 
        'Meknès, Maroc', 
        'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, '2026-04-14'),
(2000147, 'samira.bennani147@email.ma', 'samira.bennani147@email.ma', 'samira.bennani147@email.ma', 
        36, '2025-04-13 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212793290717', 
        NULL, 'Samira Bennani', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Pédagogie, Formation professionnelle, CRM, Relationnel', NULL, 0, '2012', 
        'Femme', 
        '2000-04-22 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-04-17'),
(2000148, 'youssef.fassi148@email.ma', 'youssef.fassi148@email.ma', 'youssef.fassi148@email.ma', 
        36, '2025-05-30 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Rabat', '+212783101486', 
        NULL, 'Youssef Fassi', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: Merchandising, Vente B2B, Commerce international, Optimisation logistique, Gestion des stocks, Transport, Supply chain', NULL, 0, '2008', 
        'Homme', 
        '2000-08-13 13:56:21', 'Rabat-Salé-Kénitra', 
        'Rabat-Salé-Kénitra', NULL, 34.0209, -6.8417, 
        'Rabat, Maroc', 
        'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, '2026-02-28'),
(2000149, 'salma.alami149@email.ma', 'salma.alami149@email.ma', 'salma.alami149@email.ma', 
        36, '2024-10-26 13:56:21', 1, NULL, 0, '127.0.0.1', NULL, 
        'Tétouan', '+212766422761', 
        NULL, 'Salma Alami', NULL, NULL, NULL, NULL, NULL, 
        'Compétences: JavaScript, Cybersécurité, SQL, Cloud, Électricité, Maintenance, Production', NULL, 0, '2003', 
        'Homme', 
        '2001-10-01 13:56:21', 'Tanger-Tétouan-Al Hoceïma', 
        'Tanger-Tétouan-Al Hoceïma', NULL, 35.5889, -5.3626, 
        'Tétouan, Maroc', 
        'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, '2026-04-06');

-- ================================================================
-- INSERTION DE 200 OFFRES D'EMPLOI
-- ================================================================

INSERT INTO `listings` (`sid`, `listing_type_sid`, `user_sid`, `product_info`, `active`, `keywords`, `featured`, `views`, `activation_date`, `expiration_date`, `featured_last_showed`, `access_type`, `access_list`, `contract_id`, `data_source`, `external_id`, `Title`, `JobCategory`, `EmploymentType`, `JobDescription`, `JobRequirements`, `Objective`, `Skills`, `preview`, `FormationDescription`, `Motorized`, `Study`, `Experience`, `Licence`, `Location_State`, `Location_ZipCode`, `Resume`, `Location_City`, `Location_pays`, `Location_gouvernorat`, `Location_ville`, `Location`, `complex`, `checkouted`, `Photo`, `Phone`, `OtherPhone`, `GooglePlace`, `Location_Latitude`, `Location_Longitude`, `application_redirects`, `id_Training_Categories`, `id_Training_Lieu`, `Duree`, `Location_Country`, `id_Job_Nombredepostesvacants`, `id_Job_Experience`, `id_Job_Niveaudtude`, `id_Job_Rmunrationpropose`, `id_Job_Langue`, `id_Job_Genre`, `id_Job_Position`, `id_Job_Nombredepostesouverts`, `id_Job_Postesvacants`, `id_Job_Vacancy`, `id_Job_Vacancies`, `id_Job_MotsCls`, `id_Resume_careerlevel`, `salary`, `id_Resume_CurrentStatus`, `Linkedin_link`, `Facebook_link`, `Twitter_link`, `Behance_link`, `Instagram_link`, `GitHub_link`, `StackOverflow_link`, `YouTube_link`, `Blog_link`, `Website_link`, `Other_link`, `cin_file`, `book_file`, `diploma_file`, `resume_modele_sid`, `modele_color`, `update_date`, `date_add`, `email_notify`, `listing_alert_mesage`) VALUES
(6000, 6, 1100009, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef de Réception Hôtellerie & Tourisme Tanger', 
        0, 406, 
        '2026-03-22 13:56:21', '2026-05-21 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef de Réception', '2012', '76', 
        'Digital Ventures recherche un(e) Chef de Réception pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef de Réception
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Hôtellerie & Tourisme.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Animation, Service client, Gestion hôtelière, Réception, Restauration

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Animation, Service client, Gestion hôtelière, Réception, Restauration', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Animation, Service client, Gestion hôtelière', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-16 13:56:21', '2026-03-22 13:56:21', 1, ''),
(6001, 6, 1100037, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Qualité Alimentaire Agriculture & Agroalimentaire Marrakech', 
        1, 241, 
        '2026-03-22 13:56:21', '2026-05-21 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Qualité Alimentaire', '2013', '76', 
        'Tangier Logistics recherche un(e) Responsable Qualité Alimentaire pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Qualité Alimentaire
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Agriculture & Agroalimentaire.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Agronomie, Agroalimentaire, Agriculture

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Agronomie, Agroalimentaire, Agriculture', 0, NULL, NULL, 
        'Ingénieur', 
        '5 ans et plus', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Agronomie, Agroalimentaire, Agriculture', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-16 13:56:21', '2026-03-22 13:56:21', 1, ''),
(6002, 6, 1100016, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Gestionnaire de Stock Logistique & Transport Rabat', 
        1, 64, 
        '2026-03-25 13:56:21', '2026-05-24 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Gestionnaire de Stock', '2011', '76', 
        'Moroccan Innovations recherche un(e) Gestionnaire de Stock pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Gestionnaire de Stock
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Supply chain, Optimisation logistique, Gestion des stocks, Transport

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Supply chain, Optimisation logistique, Gestion des stocks, Transport', 0, NULL, NULL, 
        'Bac+3', 
        '2 à 3 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '995', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Supply chain, Optimisation logistique, Gestion des stocks', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-17 13:56:21', '2026-03-25 13:56:21', 1, ''),
(6003, 6, 1100020, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Assistant Administratif Administration & Services Meknès', 
        0, 417, 
        '2026-04-17 13:56:21', '2026-06-16 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Assistant Administratif', '2014', '76', 
        'Digital Ventures recherche un(e) Assistant Administratif pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Assistant Administratif
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Administration & Services.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion administrative, Secrétariat, Bureautique, Organisation

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion administrative, Secrétariat, Bureautique, Organisation', 0, NULL, NULL, 
        'Ingénieur', 
        '1 à 2 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion administrative, Secrétariat, Bureautique', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-09 13:56:21', '2026-04-17 13:56:21', 1, ''),
(6004, 6, 1100034, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Infirmier Santé & Médical Casablanca', 
        1, 179, 
        '2026-04-12 13:56:21', '2026-06-11 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Infirmier', '2008', '76', 
        'Rabat Industries recherche un(e) Infirmier pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Infirmier
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Santé & Médical.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Soins infirmiers, Radiologie, Assistance médicale, Pharmacie, Médecine

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Soins infirmiers, Radiologie, Assistance médicale, Pharmacie, Médecine', 0, NULL, NULL, 
        'Bac+2', 
        '3 à 5 ans', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Soins infirmiers, Radiologie, Assistance médicale', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-23 13:56:21', '2026-04-12 13:56:21', 1, ''),
(6005, 6, 1100027, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Gouvernante Hôtellerie & Tourisme Kénitra', 
        0, 28, 
        '2026-04-10 13:56:21', '2026-06-09 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Gouvernante', '2012', '76', 
        'Atlantic Solutions recherche un(e) Gouvernante pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Gouvernante
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Hôtellerie & Tourisme.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Réception, Animation, Restauration, Gestion hôtelière

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Réception, Animation, Restauration, Gestion hôtelière', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Réception, Animation, Restauration', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-03 13:56:21', '2026-04-10 13:56:21', 1, ''),
(6006, 6, 1100004, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Logistique Logistique & Transport Tanger', 
        1, 485, 
        '2026-04-01 13:56:21', '2026-05-31 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Logistique', '2011', '76', 
        'Kingdom Enterprises recherche un(e) Responsable Logistique pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Logistique
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Transport, Optimisation logistique, Gestion des stocks, Supply chain

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Transport, Optimisation logistique, Gestion des stocks, Supply chain', 0, NULL, NULL, 
        'Bac+3', 
        '5 ans et plus', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Transport, Optimisation logistique, Gestion des stocks', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-10 13:56:21', '2026-04-01 13:56:21', 1, ''),
(6007, 6, 1100029, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Export Manager Commerce & Vente Marrakech', 
        0, 467, 
        '2026-03-21 13:56:21', '2026-05-20 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Export Manager', '2009', '76', 
        'TechnoSoft Morocco recherche un(e) Export Manager pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Export Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Merchandising, Négociation commerciale, Commerce international, Vente B2B

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Merchandising, Négociation commerciale, Commerce international, Vente B2B', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '995', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Merchandising, Négociation commerciale, Commerce international', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-08 13:56:21', '2026-03-21 13:56:21', 1, ''),
(6008, 6, 1100024, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chargé d\'Affaires Commerce & Vente Meknès', 
        1, 375, 
        '2026-04-15 13:56:21', '2026-06-14 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chargé d\'Affaires', '2009', '76', 
        'Maroc Distribution recherche un(e) Chargé d\'Affaires pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chargé d\'Affaires
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Vente B2B, Merchandising, Commerce international, Négociation commerciale

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Vente B2B, Merchandising, Commerce international, Négociation commerciale', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '995', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Vente B2B, Merchandising, Commerce international', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-17 13:56:21', '2026-04-15 13:56:21', 1, ''),
(6009, 6, 1100047, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Logistique Logistique & Transport Meknès', 
        0, 245, 
        '2026-03-29 13:56:21', '2026-05-28 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Logistique', '2011', '76', 
        'Agadir Export recherche un(e) Responsable Logistique pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Logistique
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion des stocks, Optimisation logistique, Supply chain, Transport

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion des stocks, Optimisation logistique, Supply chain, Transport', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '995', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion des stocks, Optimisation logistique, Supply chain', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-31 13:56:21', '2026-03-29 13:56:21', 1, ''),
(6010, 6, 1100040, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Médecin Généraliste Santé & Médical Agadir', 
        1, 428, 
        '2026-03-23 13:56:21', '2026-05-22 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Médecin Généraliste', '2008', '76', 
        'Moroccan Innovations recherche un(e) Médecin Généraliste pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Médecin Généraliste
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Santé & Médical.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Soins infirmiers, Médecine, Radiologie

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Soins infirmiers, Médecine, Radiologie', 0, NULL, NULL, 
        'Bac+3', 
        '1 à 2 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '995', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Soins infirmiers, Médecine, Radiologie', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-28 13:56:21', '2026-03-23 13:56:21', 1, ''),
(6011, 6, 1100036, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Conseiller Juridique Juridique & Conseil Meknès', 
        1, 481, 
        '2026-03-22 13:56:21', '2026-05-21 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Conseiller Juridique', '2015', '76', 
        'InnovateTech recherche un(e) Conseiller Juridique pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Conseiller Juridique
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Juridique & Conseil.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Droit des affaires, Conseil juridique, Contentieux, Contrats

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Droit des affaires, Conseil juridique, Contentieux, Contrats', 0, NULL, NULL, 
        'Bac+5', 
        '1 à 2 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '993', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Droit des affaires, Conseil juridique, Contentieux', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-13 13:56:21', '2026-03-22 13:56:21', 1, ''),
(6012, 6, 1100028, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Marketing Marketing & Communication Tanger', 
        0, 78, 
        '2026-04-05 13:56:21', '2026-06-04 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Marketing', '2005', '76', 
        'Royal Business recherche un(e) Responsable Marketing pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Marketing
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Marketing digital, SEO, Google Ads

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Marketing digital, SEO, Google Ads', 0, NULL, NULL, 
        'Bac+3', 
        '5 ans et plus', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '995', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Marketing digital, SEO, Google Ads', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-21 13:56:21', '2026-04-05 13:56:21', 1, ''),
(6013, 6, 1100016, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Génie Civil BTP & Construction Agadir', 
        0, 417, 
        '2026-03-29 13:56:21', '2026-05-28 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Génie Civil', '2007', '76', 
        'Mediterranean Group recherche un(e) Ingénieur Génie Civil pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Génie Civil
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur BTP & Construction.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion de chantier, Génie civil, Autocad

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion de chantier, Génie civil, Autocad', 0, NULL, NULL, 
        'Ingénieur', 
        '1 à 2 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion de chantier, Génie civil, Autocad', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-20 13:56:21', '2026-03-29 13:56:21', 1, ''),
(6014, 6, 1100018, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Formateur Professionnel Éducation & Formation Rabat', 
        0, 250, 
        '2026-04-14 13:56:21', '2026-06-13 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Formateur Professionnel', '2010', '76', 
        'InnovateTech recherche un(e) Formateur Professionnel pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Formateur Professionnel
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Éducation & Formation.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Formation professionnelle, E-learning, Pédagogie

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Formation professionnelle, E-learning, Pédagogie', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Formation professionnelle, E-learning, Pédagogie', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-30 13:56:21', '2026-04-14 13:56:21', 1, ''),
(6015, 6, 1100021, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Directeur Commercial Commerce & Vente Marrakech', 
        1, 302, 
        '2026-04-05 13:56:21', '2026-06-04 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Directeur Commercial', '2009', '76', 
        'Sahara Tech recherche un(e) Directeur Commercial pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Directeur Commercial
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Négociation commerciale, Commerce international, Vente B2B

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Négociation commerciale, Commerce international, Vente B2B', 0, NULL, NULL, 
        'Ingénieur', 
        '1 à 2 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Négociation commerciale, Commerce international, Vente B2B', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-31 13:56:21', '2026-04-05 13:56:21', 1, ''),
(6016, 6, 1100013, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Vendeur Comptoir Commerce & Vente Marrakech', 
        1, 348, 
        '2026-04-07 13:56:21', '2026-06-06 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Vendeur Comptoir', '2002', '76', 
        'Oriental Industries recherche un(e) Vendeur Comptoir pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Vendeur Comptoir
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Prospection, CRM, Relationnel, Techniques de vente, Négociation

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Prospection, CRM, Relationnel, Techniques de vente, Négociation', 0, NULL, NULL, 
        'Bac+3', 
        '1 à 2 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Prospection, CRM, Relationnel', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-29 13:56:21', '2026-04-07 13:56:21', 1, ''),
(6017, 6, 1100029, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Structure BTP & Construction Oujda', 
        0, 34, 
        '2026-04-05 13:56:21', '2026-06-04 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Structure', '2007', '76', 
        'Oasis Industries recherche un(e) Ingénieur Structure pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Structure
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur BTP & Construction.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
BTP, Autocad, Gestion de chantier

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'BTP, Autocad, Gestion de chantier', 0, NULL, NULL, 
        'Bac+3', 
        '2 à 3 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'BTP, Autocad, Gestion de chantier', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-06 13:56:21', '2026-04-05 13:56:21', 1, ''),
(6018, 6, 1100044, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Marketing Marketing & Communication Oujda', 
        1, 16, 
        '2026-04-03 13:56:21', '2026-06-02 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Marketing', '2005', '76', 
        'Moroccan Innovations recherche un(e) Responsable Marketing pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Marketing
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Google Ads, Social Media, Stratégie marketing

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Google Ads, Social Media, Stratégie marketing', 0, NULL, NULL, 
        'Ingénieur', 
        '1 à 2 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Google Ads, Social Media, Stratégie marketing', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-06 13:56:21', '2026-04-03 13:56:21', 1, ''),
(6019, 6, 1100012, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Directeur Commercial Commerce & Vente Tétouan', 
        0, 448, 
        '2026-04-02 13:56:21', '2026-06-01 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Directeur Commercial', '2009', '76', 
        'Atlantic Solutions recherche un(e) Directeur Commercial pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Directeur Commercial
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Vente B2B, Commerce international, Négociation commerciale, Merchandising

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Vente B2B, Commerce international, Négociation commerciale, Merchandising', 0, NULL, NULL, 
        'Ingénieur', 
        '1 à 2 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Vente B2B, Commerce international, Négociation commerciale', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-22 13:56:21', '2026-04-02 13:56:21', 1, ''),
(6020, 6, 1100017, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Attaché Commercial Commerce & Vente Marrakech', 
        0, 377, 
        '2026-03-23 13:56:21', '2026-05-22 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Attaché Commercial', '2002', '76', 
        'Casablanca Trading recherche un(e) Attaché Commercial pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Attaché Commercial
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Relationnel, Techniques de vente, Vente, CRM, Négociation, Prospection

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Relationnel, Techniques de vente, Vente, CRM, Négociation, Prospection', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '993', 
        '1001', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Relationnel, Techniques de vente, Vente', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-24 13:56:21', '2026-03-23 13:56:21', 1, ''),
(6021, 6, 1100046, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef Comptable Finance & Comptabilité Marrakech', 
        0, 137, 
        '2026-04-05 13:56:21', '2026-06-04 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef Comptable', '2003', '76', 
        'Atlas Services recherche un(e) Chef Comptable pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef Comptable
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Finance & Comptabilité.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Analyse financière, Excel, Comptabilité, SAP, Sage

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Analyse financière, Excel, Comptabilité, SAP, Sage', 0, NULL, NULL, 
        'Ingénieur', 
        '1 à 2 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Analyse financière, Excel, Comptabilité', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-29 13:56:21', '2026-04-05 13:56:21', 1, ''),
(6022, 6, 1100049, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Data Scientist Informatique & Technologies Tétouan', 
        0, 21, 
        '2026-03-20 13:56:21', '2026-05-19 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Data Scientist', '2001', '76', 
        'Oasis Industries recherche un(e) Data Scientist pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Data Scientist
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Angular, SQL, React, Java, JavaScript, Cybersécurité

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Angular, SQL, React, Java, JavaScript, Cybersécurité', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '996', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Angular, SQL, React', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-03 13:56:21', '2026-03-20 13:56:21', 1, ''),
(6023, 6, 1100023, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef d\'Exploitation Logistique & Transport Kénitra', 
        1, 464, 
        '2026-03-22 13:56:21', '2026-05-21 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef d\'Exploitation', '2011', '76', 
        'Sahara Tech recherche un(e) Chef d\'Exploitation pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef d\'Exploitation
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Transport, Gestion des stocks, Optimisation logistique, Supply chain

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Transport, Gestion des stocks, Optimisation logistique, Supply chain', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Transport, Gestion des stocks, Optimisation logistique', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-04 13:56:21', '2026-03-22 13:56:21', 1, ''),
(6024, 6, 1100019, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Métreur Vérificateur BTP & Construction Oujda', 
        1, 294, 
        '2026-03-24 13:56:21', '2026-05-23 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Métreur Vérificateur', '2007', '76', 
        'Atlas Services recherche un(e) Métreur Vérificateur pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Métreur Vérificateur
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur BTP & Construction.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Génie civil, Conduite de travaux, Gestion de chantier

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Génie civil, Conduite de travaux, Gestion de chantier', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Génie civil, Conduite de travaux, Gestion de chantier', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-31 13:56:21', '2026-03-24 13:56:21', 1, ''),
(6025, 6, 1100011, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chargé de Recrutement Ressources Humaines Marrakech', 
        1, 162, 
        '2026-03-31 13:56:21', '2026-05-30 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chargé de Recrutement', '2004', '76', 
        'InnovateTech recherche un(e) Chargé de Recrutement pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chargé de Recrutement
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ressources Humaines.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion RH, Droit du travail, Paie, Formation, Recrutement

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion RH, Droit du travail, Paie, Formation, Recrutement', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion RH, Droit du travail, Paie', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-02 13:56:21', '2026-03-31 13:56:21', 1, ''),
(6026, 6, 1100002, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Assistant Médical Santé & Médical Tétouan', 
        1, 375, 
        '2026-03-31 13:56:21', '2026-05-30 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Assistant Médical', '2008', '76', 
        'Moroccan Innovations recherche un(e) Assistant Médical pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Assistant Médical
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Santé & Médical.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Pharmacie, Assistance médicale, Médecine, Soins infirmiers, Radiologie

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Pharmacie, Assistance médicale, Médecine, Soins infirmiers, Radiologie', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Pharmacie, Assistance médicale, Médecine', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-27 13:56:21', '2026-03-31 13:56:21', 1, ''),
(6027, 6, 1100021, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef d\'Exploitation Logistique & Transport Fès', 
        1, 107, 
        '2026-04-09 13:56:21', '2026-06-08 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef d\'Exploitation', '2011', '76', 
        'TechnoSoft Morocco recherche un(e) Chef d\'Exploitation pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef d\'Exploitation
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Supply chain, Optimisation logistique, Transport

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Supply chain, Optimisation logistique, Transport', 0, NULL, NULL, 
        'Bac+2', 
        '3 à 5 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '995', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Supply chain, Optimisation logistique, Transport', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-26 13:56:21', '2026-04-09 13:56:21', 1, ''),
(6028, 6, 1100007, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chargé de Communication Marketing & Communication Tanger', 
        0, 405, 
        '2026-03-21 13:56:21', '2026-05-20 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chargé de Communication', '2005', '76', 
        'Royal Business recherche un(e) Chargé de Communication pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chargé de Communication
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Stratégie marketing, Social Media, Content marketing, Marketing digital, SEO

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Stratégie marketing, Social Media, Content marketing, Marketing digital, SEO', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Stratégie marketing, Social Media, Content marketing', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-21 13:56:21', '2026-03-21 13:56:21', 1, ''),
(6029, 6, 1100021, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Key Account Manager Commerce & Vente Casablanca', 
        0, 455, 
        '2026-04-17 13:56:21', '2026-06-16 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Key Account Manager', '2002', '76', 
        'Rabat Industries recherche un(e) Key Account Manager pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Key Account Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Prospection, Relationnel, CRM, Négociation, Vente, Techniques de vente

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Prospection, Relationnel, CRM, Négociation, Vente, Techniques de vente', 0, NULL, NULL, 
        'Bac+3', 
        '2 à 3 ans', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Prospection, Relationnel, CRM', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-12 13:56:21', '2026-04-17 13:56:21', 1, ''),
(6030, 6, 1100039, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef de Cuisine Hôtellerie & Tourisme Rabat', 
        1, 196, 
        '2026-03-30 13:56:21', '2026-05-29 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef de Cuisine', '2012', '76', 
        'Atlas Services recherche un(e) Chef de Cuisine pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef de Cuisine
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Hôtellerie & Tourisme.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion hôtelière, Réception, Restauration, Animation, Service client

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion hôtelière, Réception, Restauration, Animation, Service client', 0, NULL, NULL, 
        'Bac+2', 
        '1 à 2 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '1001', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion hôtelière, Réception, Restauration', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-20 13:56:21', '2026-03-30 13:56:21', 1, ''),
(6031, 6, 1100017, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef de Projet IT Informatique & Technologies Marrakech', 
        1, 401, 
        '2026-03-24 13:56:21', '2026-05-23 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef de Projet IT', '2001', '76', 
        'Moroccan Innovations recherche un(e) Chef de Projet IT pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef de Projet IT
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Angular, Python, Java

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Angular, Python, Java', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '996', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Angular, Python, Java', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-13 13:56:21', '2026-03-24 13:56:21', 1, ''),
(6032, 6, 1100048, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Vendeur Comptoir Commerce & Vente Agadir', 
        0, 440, 
        '2026-04-05 13:56:21', '2026-06-04 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Vendeur Comptoir', '2002', '76', 
        'Kingdom Enterprises recherche un(e) Vendeur Comptoir pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Vendeur Comptoir
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Techniques de vente, Négociation, CRM, Relationnel, Prospection

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Techniques de vente, Négociation, CRM, Relationnel, Prospection', 0, NULL, NULL, 
        'Bac+5', 
        '2 à 3 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '993', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Techniques de vente, Négociation, CRM', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-10 13:56:21', '2026-04-05 13:56:21', 1, ''),
(6033, 6, 1100015, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Coordinateur Transport Logistique & Transport Marrakech', 
        1, 344, 
        '2026-04-03 13:56:21', '2026-06-02 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Coordinateur Transport', '2011', '76', 
        'Tangier Logistics recherche un(e) Coordinateur Transport pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Coordinateur Transport
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Optimisation logistique, Supply chain, Transport

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Optimisation logistique, Supply chain, Transport', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Optimisation logistique, Supply chain, Transport', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-27 13:56:21', '2026-04-03 13:56:21', 1, ''),
(6034, 6, 1100041, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Coordinateur Transport Logistique & Transport Agadir', 
        1, 492, 
        '2026-04-16 13:56:21', '2026-06-15 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Coordinateur Transport', '2011', '76', 
        'Casablanca Trading recherche un(e) Coordinateur Transport pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Coordinateur Transport
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion des stocks, Supply chain, Transport

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion des stocks, Supply chain, Transport', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion des stocks, Supply chain, Transport', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-19 13:56:21', '2026-04-16 13:56:21', 1, ''),
(6035, 6, 1100014, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Traffic Manager Marketing & Communication Agadir', 
        1, 370, 
        '2026-04-13 13:56:21', '2026-06-12 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Traffic Manager', '2005', '76', 
        'Casablanca Trading recherche un(e) Traffic Manager pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Traffic Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Google Ads, Social Media, Content marketing, Marketing digital, SEO

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Google Ads, Social Media, Content marketing, Marketing digital, SEO', 0, NULL, NULL, 
        'Ingénieur', 
        '1 à 2 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1001', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Google Ads, Social Media, Content marketing', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-31 13:56:21', '2026-04-13 13:56:21', 1, ''),
(6036, 6, 1100030, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Professeur Éducation & Formation Tanger', 
        1, 499, 
        '2026-03-19 13:56:21', '2026-05-18 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Professeur', '2010', '76', 
        'Maroc Distribution recherche un(e) Professeur pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Professeur
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Éducation & Formation.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Pédagogie, E-learning, Formation professionnelle

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Pédagogie, E-learning, Formation professionnelle', 0, NULL, NULL, 
        'Bac+5', 
        '1 à 2 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1001', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Pédagogie, E-learning, Formation professionnelle', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-17 13:56:21', '2026-03-19 13:56:21', 1, ''),
(6037, 6, 1100014, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Analyste Business Intelligence Informatique & Technologies Tanger', 
        1, 191, 
        '2026-03-19 13:56:21', '2026-05-18 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Analyste Business Intelligence', '2001', '76', 
        'Atlas Services recherche un(e) Analyste Business Intelligence pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Analyste Business Intelligence
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Python, JavaScript, Angular, Cybersécurité

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Python, JavaScript, Angular, Cybersécurité', 0, NULL, NULL, 
        'Bac+5', 
        '1 à 2 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Python, JavaScript, Angular', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-18 13:56:21', '2026-03-19 13:56:21', 1, ''),
(6038, 6, 1100017, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Vendeur Comptoir Commerce & Vente Oujda', 
        1, 185, 
        '2026-04-09 13:56:21', '2026-06-08 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Vendeur Comptoir', '2002', '76', 
        'Digital Ventures recherche un(e) Vendeur Comptoir pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Vendeur Comptoir
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Vente, Prospection, Techniques de vente

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Vente, Prospection, Techniques de vente', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Vente, Prospection, Techniques de vente', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-30 13:56:21', '2026-04-09 13:56:21', 1, ''),
(6039, 6, 1100015, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Délégué Commercial Commerce & Vente Meknès', 
        0, 163, 
        '2026-03-30 13:56:21', '2026-05-29 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Délégué Commercial', '2002', '76', 
        'Mediterranean Group recherche un(e) Délégué Commercial pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Délégué Commercial
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Relationnel, Négociation, CRM

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Relationnel, Négociation, CRM', 0, NULL, NULL, 
        'Bac+3', 
        '2 à 3 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Relationnel, Négociation, CRM', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-24 13:56:21', '2026-03-30 13:56:21', 1, ''),
(6040, 6, 1100014, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Gestionnaire RH Ressources Humaines Casablanca', 
        1, 224, 
        '2026-03-24 13:56:21', '2026-05-23 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Gestionnaire RH', '2004', '76', 
        'Atlantic Solutions recherche un(e) Gestionnaire RH pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Gestionnaire RH
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ressources Humaines.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion RH, Recrutement, Paie, Droit du travail, Formation

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion RH, Recrutement, Paie, Droit du travail, Formation', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '995', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion RH, Recrutement, Paie', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-05 13:56:21', '2026-03-24 13:56:21', 1, ''),
(6041, 6, 1100029, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Traffic Manager Marketing & Communication Marrakech', 
        1, 326, 
        '2026-03-24 13:56:21', '2026-05-23 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Traffic Manager', '2005', '76', 
        'Atlantic Solutions recherche un(e) Traffic Manager pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Traffic Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Content marketing, Social Media, SEO, Marketing digital, Stratégie marketing, Google Ads

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Content marketing, Social Media, SEO, Marketing digital, Stratégie marketing, Google Ads', 0, NULL, NULL, 
        'Bac+3', 
        '1 à 2 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Content marketing, Social Media, SEO', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-18 13:56:21', '2026-03-24 13:56:21', 1, ''),
(6042, 6, 1100023, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Professeur Éducation & Formation Meknès', 
        1, 333, 
        '2026-03-31 13:56:21', '2026-05-30 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Professeur', '2010', '76', 
        'Maroc Distribution recherche un(e) Professeur pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Professeur
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Éducation & Formation.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Formation professionnelle, E-learning, Gestion de classe

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Formation professionnelle, E-learning, Gestion de classe', 0, NULL, NULL, 
        'Ingénieur', 
        '5 ans et plus', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Formation professionnelle, E-learning, Gestion de classe', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-27 13:56:21', '2026-03-31 13:56:21', 1, ''),
(6043, 6, 1100026, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Auditeur Financier Finance & Comptabilité Marrakech', 
        1, 408, 
        '2026-04-17 13:56:21', '2026-06-16 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Auditeur Financier', '2003', '76', 
        'Kingdom Enterprises recherche un(e) Auditeur Financier pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Auditeur Financier
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Finance & Comptabilité.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Excel, SAP, Sage, Comptabilité

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Excel, SAP, Sage, Comptabilité', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Excel, SAP, Sage', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-30 13:56:21', '2026-04-17 13:56:21', 1, ''),
(6044, 6, 1100038, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Conseiller Juridique Juridique & Conseil Marrakech', 
        1, 86, 
        '2026-04-05 13:56:21', '2026-06-04 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Conseiller Juridique', '2015', '76', 
        'Agadir Export recherche un(e) Conseiller Juridique pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Conseiller Juridique
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Juridique & Conseil.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Contrats, Droit des affaires, Contentieux, Conseil juridique

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Contrats, Droit des affaires, Contentieux, Conseil juridique', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Contrats, Droit des affaires, Contentieux', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-09 13:56:21', '2026-04-05 13:56:21', 1, ''),
(6045, 6, 1100039, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Délégué Commercial Commerce & Vente Fès', 
        0, 5, 
        '2026-04-04 13:56:21', '2026-06-03 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Délégué Commercial', '2002', '76', 
        'Oasis Industries recherche un(e) Délégué Commercial pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Délégué Commercial
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Prospection, Techniques de vente, Vente, Négociation, Relationnel

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Prospection, Techniques de vente, Vente, Négociation, Relationnel', 0, NULL, NULL, 
        'Bac+5', 
        '5 ans et plus', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Prospection, Techniques de vente, Vente', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-28 13:56:21', '2026-04-04 13:56:21', 1, ''),
(6046, 6, 1100005, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Professeur Éducation & Formation Rabat', 
        1, 312, 
        '2026-04-06 13:56:21', '2026-06-05 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Professeur', '2010', '76', 
        'Casablanca Trading recherche un(e) Professeur pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Professeur
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Éducation & Formation.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion de classe, Formation professionnelle, Pédagogie, E-learning

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion de classe, Formation professionnelle, Pédagogie, E-learning', 0, NULL, NULL, 
        'Ingénieur', 
        '5 ans et plus', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '993', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion de classe, Formation professionnelle, Pédagogie', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-03 13:56:21', '2026-04-06 13:56:21', 1, ''),
(6047, 6, 1100041, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Juriste d\'Entreprise Juridique & Conseil Agadir', 
        1, 223, 
        '2026-04-16 13:56:21', '2026-06-15 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Juriste d\'Entreprise', '2015', '76', 
        'Atlas Services recherche un(e) Juriste d\'Entreprise pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Juriste d\'Entreprise
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Juridique & Conseil.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Contentieux, Contrats, Conseil juridique

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Contentieux, Contrats, Conseil juridique', 0, NULL, NULL, 
        'Ingénieur', 
        '1 à 2 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '995', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Contentieux, Contrats, Conseil juridique', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-10 13:56:21', '2026-04-16 13:56:21', 1, ''),
(6048, 6, 1100026, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chargé d\'Affaires Commerce & Vente Rabat', 
        1, 489, 
        '2026-04-15 13:56:21', '2026-06-14 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chargé d\'Affaires', '2009', '76', 
        'Casablanca Trading recherche un(e) Chargé d\'Affaires pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chargé d\'Affaires
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Commerce international, Vente B2B, Merchandising, Négociation commerciale

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Commerce international, Vente B2B, Merchandising, Négociation commerciale', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Commerce international, Vente B2B, Merchandising', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-09 13:56:21', '2026-04-15 13:56:21', 1, ''),
(6049, 6, 1100009, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Auditeur Financier Finance & Comptabilité Agadir', 
        0, 226, 
        '2026-04-06 13:56:21', '2026-06-05 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Auditeur Financier', '2003', '76', 
        'Maghreb Consulting recherche un(e) Auditeur Financier pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Auditeur Financier
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Finance & Comptabilité.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Analyse financière, Fiscalité, Sage

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Analyse financière, Fiscalité, Sage', 0, NULL, NULL, 
        'Bac+5', 
        '2 à 3 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Analyse financière, Fiscalité, Sage', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-19 13:56:21', '2026-04-06 13:56:21', 1, ''),
(6050, 6, 1100023, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Attaché Commercial Commerce & Vente Tanger', 
        0, 322, 
        '2026-04-14 13:56:21', '2026-06-13 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Attaché Commercial', '2002', '76', 
        'Moroccan Innovations recherche un(e) Attaché Commercial pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Attaché Commercial
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Vente, Relationnel, Prospection, CRM, Négociation, Techniques de vente

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Vente, Relationnel, Prospection, CRM, Négociation, Techniques de vente', 0, NULL, NULL, 
        'Bac+3', 
        '2 à 3 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Vente, Relationnel, Prospection', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-23 13:56:21', '2026-04-14 13:56:21', 1, ''),
(6051, 6, 1100004, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Talent Acquisition Specialist Ressources Humaines Casablanca', 
        0, 152, 
        '2026-04-15 13:56:21', '2026-06-14 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Talent Acquisition Specialist', '2004', '76', 
        'Oriental Industries recherche un(e) Talent Acquisition Specialist pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Talent Acquisition Specialist
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ressources Humaines.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Recrutement, Droit du travail, Formation, Paie, Gestion RH

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Recrutement, Droit du travail, Formation, Paie, Gestion RH', 0, NULL, NULL, 
        'Ingénieur', 
        '1 à 2 ans', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Recrutement, Droit du travail, Formation', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-08 13:56:21', '2026-04-15 13:56:21', 1, ''),
(6052, 6, 1100029, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Contrôleur de Gestion Finance & Comptabilité Kénitra', 
        0, 105, 
        '2026-03-31 13:56:21', '2026-05-30 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Contrôleur de Gestion', '2003', '76', 
        'Atlantic Solutions recherche un(e) Contrôleur de Gestion pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Contrôleur de Gestion
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Finance & Comptabilité.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Analyse financière, Fiscalité, SAP, Sage, Excel

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Analyse financière, Fiscalité, SAP, Sage, Excel', 0, NULL, NULL, 
        'Bac+5', 
        '1 à 2 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Analyse financière, Fiscalité, SAP', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-16 13:56:21', '2026-03-31 13:56:21', 1, ''),
(6053, 6, 1100042, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Gouvernante Hôtellerie & Tourisme Oujda', 
        0, 245, 
        '2026-04-10 13:56:21', '2026-06-09 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Gouvernante', '2012', '76', 
        'Rabat Industries recherche un(e) Gouvernante pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Gouvernante
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Hôtellerie & Tourisme.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Réception, Service client, Restauration, Animation

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Réception, Service client, Restauration, Animation', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Réception, Service client, Restauration', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-08 13:56:21', '2026-04-10 13:56:21', 1, ''),
(6054, 6, 1100049, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Industriel Ingénierie & Production Tétouan', 
        1, 462, 
        '2026-03-29 13:56:21', '2026-05-28 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Industriel', '2006', '76', 
        'Tangier Logistics recherche un(e) Ingénieur Industriel pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Industriel
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ingénierie & Production.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Génie mécanique, Maintenance, Qualité, Électricité

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Génie mécanique, Maintenance, Qualité, Électricité', 0, NULL, NULL, 
        'Bac+3', 
        '5 ans et plus', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '993', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Génie mécanique, Maintenance, Qualité', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-19 13:56:21', '2026-03-29 13:56:21', 1, ''),
(6055, 6, 1100029, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef de Chantier BTP & Construction Fès', 
        1, 449, 
        '2026-03-31 13:56:21', '2026-05-30 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef de Chantier', '2007', '76', 
        'Maroc Distribution recherche un(e) Chef de Chantier pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef de Chantier
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur BTP & Construction.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion de chantier, Génie civil, Autocad, Conduite de travaux, BTP

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion de chantier, Génie civil, Autocad, Conduite de travaux, BTP', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion de chantier, Génie civil, Autocad', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-03 13:56:21', '2026-03-31 13:56:21', 1, ''),
(6056, 6, 1100010, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Business Developer Commerce & Vente Tétouan', 
        0, 81, 
        '2026-04-01 13:56:21', '2026-05-31 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Business Developer', '2002', '76', 
        'Meknès Solutions recherche un(e) Business Developer pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Business Developer
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Vente, Relationnel, Techniques de vente, CRM, Prospection

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Vente, Relationnel, Techniques de vente, CRM, Prospection', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Vente, Relationnel, Techniques de vente', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-01 13:56:21', '2026-04-01 13:56:21', 1, ''),
(6057, 6, 1100038, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Analyste Business Intelligence Informatique & Technologies Fès', 
        0, 391, 
        '2026-04-07 13:56:21', '2026-06-06 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Analyste Business Intelligence', '2001', '76', 
        'Fes Technologies recherche un(e) Analyste Business Intelligence pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Analyste Business Intelligence
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Angular, SQL, Cybersécurité

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Angular, SQL, Cybersécurité', 0, NULL, NULL, 
        'Bac+2', 
        '3 à 5 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Angular, SQL, Cybersécurité', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-30 13:56:21', '2026-04-07 13:56:21', 1, ''),
(6058, 6, 1100028, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Sales Manager Commerce & Vente Meknès', 
        0, 5, 
        '2026-04-08 13:56:21', '2026-06-07 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Sales Manager', '2009', '76', 
        'Royal Business recherche un(e) Sales Manager pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Sales Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Merchandising, Vente B2B, Commerce international, Négociation commerciale

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Merchandising, Vente B2B, Commerce international, Négociation commerciale', 0, NULL, NULL, 
        'Bac+3', 
        '5 ans et plus', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Merchandising, Vente B2B, Commerce international', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-12 13:56:21', '2026-04-08 13:56:21', 1, ''),
(6059, 6, 1100017, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Méthodes Ingénierie & Production Rabat', 
        1, 222, 
        '2026-04-15 13:56:21', '2026-06-14 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Méthodes', '2006', '76', 
        'Mediterranean Group recherche un(e) Responsable Méthodes pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Méthodes
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ingénierie & Production.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
CAO, Maintenance, Génie mécanique

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'CAO, Maintenance, Génie mécanique', 0, NULL, NULL, 
        'Bac+2', 
        '3 à 5 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'CAO, Maintenance, Génie mécanique', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-02 13:56:21', '2026-04-15 13:56:21', 1, ''),
(6060, 6, 1100039, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Commercial Commerce & Vente Fès', 
        0, 346, 
        '2026-04-11 13:56:21', '2026-06-10 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Commercial', '2009', '76', 
        'Agadir Export recherche un(e) Responsable Commercial pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Commercial
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Merchandising, Commerce international, Négociation commerciale, Vente B2B

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Merchandising, Commerce international, Négociation commerciale, Vente B2B', 0, NULL, NULL, 
        'Bac+2', 
        '3 à 5 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Merchandising, Commerce international, Négociation commerciale', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-15 13:56:21', '2026-04-11 13:56:21', 1, ''),
(6061, 6, 1100034, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Traffic Manager Marketing & Communication Rabat', 
        0, 48, 
        '2026-04-17 13:56:21', '2026-06-16 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Traffic Manager', '2005', '76', 
        'Oasis Industries recherche un(e) Traffic Manager pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Traffic Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
SEO, Marketing digital, Social Media, Content marketing, Google Ads

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'SEO, Marketing digital, Social Media, Content marketing, Google Ads', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '996', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'SEO, Marketing digital, Social Media', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-07 13:56:21', '2026-04-17 13:56:21', 1, ''),
(6062, 6, 1100017, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Cybersécurité Informatique & Technologies Marrakech', 
        1, 174, 
        '2026-03-31 13:56:21', '2026-05-30 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Cybersécurité', '2001', '76', 
        'InnovateTech recherche un(e) Ingénieur Cybersécurité pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Cybersécurité
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Python, Java, Cybersécurité, SQL

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Python, Java, Cybersécurité, SQL', 0, NULL, NULL, 
        'Bac+3', 
        '3 à 5 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '993', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Python, Java, Cybersécurité', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-25 13:56:21', '2026-03-31 13:56:21', 1, ''),
(6063, 6, 1100034, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef d\'Exploitation Logistique & Transport Casablanca', 
        1, 335, 
        '2026-04-10 13:56:21', '2026-06-09 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef d\'Exploitation', '2011', '76', 
        'Oasis Industries recherche un(e) Chef d\'Exploitation pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef d\'Exploitation
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Supply chain, Transport, Optimisation logistique, Gestion des stocks

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Supply chain, Transport, Optimisation logistique, Gestion des stocks', 0, NULL, NULL, 
        'Bac+5', 
        '2 à 3 ans', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Supply chain, Transport, Optimisation logistique', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-24 13:56:21', '2026-04-10 13:56:21', 1, ''),
(6064, 6, 1100020, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Directeur d\'Hôtel Hôtellerie & Tourisme Oujda', 
        0, 38, 
        '2026-04-15 13:56:21', '2026-06-14 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Directeur d\'Hôtel', '2012', '76', 
        'Maroc Distribution recherche un(e) Directeur d\'Hôtel pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Directeur d\'Hôtel
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Hôtellerie & Tourisme.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Service client, Animation, Restauration

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Service client, Animation, Restauration', 0, NULL, NULL, 
        'Bac+3', 
        '3 à 5 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Service client, Animation, Restauration', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-21 13:56:21', '2026-04-15 13:56:21', 1, ''),
(6065, 6, 1100045, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef d\'Exploitation Logistique & Transport Tanger', 
        1, 270, 
        '2026-03-30 13:56:21', '2026-05-29 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef d\'Exploitation', '2011', '76', 
        'Rabat Industries recherche un(e) Chef d\'Exploitation pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef d\'Exploitation
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion des stocks, Optimisation logistique, Transport

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion des stocks, Optimisation logistique, Transport', 0, NULL, NULL, 
        'Bac+2', 
        '1 à 2 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion des stocks, Optimisation logistique, Transport', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-03 13:56:21', '2026-03-30 13:56:21', 1, ''),
(6066, 6, 1100008, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef de Culture Agriculture & Agroalimentaire Oujda', 
        0, 173, 
        '2026-04-01 13:56:21', '2026-05-31 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef de Culture', '2013', '76', 
        'Atlantic Solutions recherche un(e) Chef de Culture pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef de Culture
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Agriculture & Agroalimentaire.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Agroalimentaire, Agriculture, Production agricole, Agronomie

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Agroalimentaire, Agriculture, Production agricole, Agronomie', 0, NULL, NULL, 
        'Bac+2', 
        '3 à 5 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Agroalimentaire, Agriculture, Production agricole', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-25 13:56:21', '2026-04-01 13:56:21', 1, ''),
(6067, 6, 1100010, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Analyste Business Intelligence Informatique & Technologies Kénitra', 
        1, 16, 
        '2026-03-26 13:56:21', '2026-05-25 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Analyste Business Intelligence', '2001', '76', 
        'Maghreb Consulting recherche un(e) Analyste Business Intelligence pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Analyste Business Intelligence
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
JavaScript, SQL, DevOps

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'JavaScript, SQL, DevOps', 0, NULL, NULL, 
        'Bac+2', 
        '3 à 5 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'JavaScript, SQL, DevOps', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-02 13:56:21', '2026-03-26 13:56:21', 1, ''),
(6068, 6, 1100050, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Key Account Manager Commerce & Vente Tétouan', 
        0, 144, 
        '2026-03-28 13:56:21', '2026-05-27 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Key Account Manager', '2002', '76', 
        'Maghreb Consulting recherche un(e) Key Account Manager pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Key Account Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
CRM, Négociation, Relationnel, Techniques de vente, Prospection

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'CRM, Négociation, Relationnel, Techniques de vente, Prospection', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'CRM, Négociation, Relationnel', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-07 13:56:21', '2026-03-28 13:56:21', 1, ''),
(6069, 6, 1100005, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Gestionnaire RH Ressources Humaines Rabat', 
        1, 59, 
        '2026-04-03 13:56:21', '2026-06-02 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Gestionnaire RH', '2004', '76', 
        'Royal Business recherche un(e) Gestionnaire RH pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Gestionnaire RH
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ressources Humaines.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion RH, Formation, Droit du travail, Recrutement

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion RH, Formation, Droit du travail, Recrutement', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '1001', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion RH, Formation, Droit du travail', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-10 13:56:21', '2026-04-03 13:56:21', 1, ''),
(6070, 6, 1100035, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Content Manager Marketing & Communication Kénitra', 
        0, 243, 
        '2026-04-06 13:56:21', '2026-06-05 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Content Manager', '2005', '76', 
        'Sahara Tech recherche un(e) Content Manager pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Content Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
SEO, Google Ads, Marketing digital

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'SEO, Google Ads, Marketing digital', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '993', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'SEO, Google Ads, Marketing digital', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-07 13:56:21', '2026-04-06 13:56:21', 1, ''),
(6071, 6, 1100003, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Serveur Hôtellerie & Tourisme Tétouan', 
        0, 52, 
        '2026-03-22 13:56:21', '2026-05-21 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Serveur', '2012', '76', 
        'Fes Technologies recherche un(e) Serveur pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Serveur
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Hôtellerie & Tourisme.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Animation, Gestion hôtelière, Restauration, Service client

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Animation, Gestion hôtelière, Restauration, Service client', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Animation, Gestion hôtelière, Restauration', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-04 13:56:21', '2026-03-22 13:56:21', 1, ''),
(6072, 6, 1100049, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Gestionnaire de Paie Finance & Comptabilité Oujda', 
        0, 489, 
        '2026-03-18 13:56:21', '2026-05-17 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Gestionnaire de Paie', '2003', '76', 
        'Agadir Export recherche un(e) Gestionnaire de Paie pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Gestionnaire de Paie
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Finance & Comptabilité.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Sage, Fiscalité, Analyse financière, Comptabilité

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Sage, Fiscalité, Analyse financière, Comptabilité', 0, NULL, NULL, 
        'Ingénieur', 
        '5 ans et plus', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '995', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Sage, Fiscalité, Analyse financière', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-22 13:56:21', '2026-03-18 13:56:21', 1, ''),
(6073, 6, 1100004, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Traffic Manager Marketing & Communication Tanger', 
        0, 220, 
        '2026-04-05 13:56:21', '2026-06-04 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Traffic Manager', '2005', '76', 
        'Maghreb Consulting recherche un(e) Traffic Manager pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Traffic Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Stratégie marketing, Marketing digital, SEO, Content marketing

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Stratégie marketing, Marketing digital, SEO, Content marketing', 0, NULL, NULL, 
        'Ingénieur', 
        '5 ans et plus', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Stratégie marketing, Marketing digital, SEO', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-24 13:56:21', '2026-04-05 13:56:21', 1, ''),
(6074, 6, 1100045, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'SEO Specialist Marketing & Communication Oujda', 
        1, 33, 
        '2026-03-30 13:56:21', '2026-05-29 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'SEO Specialist', '2005', '76', 
        'Kingdom Enterprises recherche un(e) SEO Specialist pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de SEO Specialist
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
SEO, Google Ads, Social Media, Content marketing

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'SEO, Google Ads, Social Media, Content marketing', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'SEO, Google Ads, Social Media', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-28 13:56:21', '2026-03-30 13:56:21', 1, ''),
(6075, 6, 1100020, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chargé d\'Affaires Commerce & Vente Agadir', 
        1, 9, 
        '2026-03-25 13:56:21', '2026-05-24 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chargé d\'Affaires', '2009', '76', 
        'Atlas Services recherche un(e) Chargé d\'Affaires pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chargé d\'Affaires
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Merchandising, Commerce international, Vente B2B

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Merchandising, Commerce international, Vente B2B', 0, NULL, NULL, 
        'Bac+3', 
        '5 ans et plus', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Merchandising, Commerce international, Vente B2B', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-14 13:56:21', '2026-03-25 13:56:21', 1, ''),
(6076, 6, 1100032, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Office Manager Administration & Services Agadir', 
        1, 7, 
        '2026-04-11 13:56:21', '2026-06-10 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Office Manager', '2014', '76', 
        'Agadir Export recherche un(e) Office Manager pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Office Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Administration & Services.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Accueil, Organisation, Gestion administrative, Secrétariat

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Accueil, Organisation, Gestion administrative, Secrétariat', 0, NULL, NULL, 
        'Ingénieur', 
        '1 à 2 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '993', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Accueil, Organisation, Gestion administrative', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-13 13:56:21', '2026-04-11 13:56:21', 1, ''),
(6077, 6, 1100002, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Métreur Vérificateur BTP & Construction Rabat', 
        1, 411, 
        '2026-04-04 13:56:21', '2026-06-03 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Métreur Vérificateur', '2007', '76', 
        'Mediterranean Group recherche un(e) Métreur Vérificateur pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Métreur Vérificateur
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur BTP & Construction.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Autocad, BTP, Gestion de chantier, Génie civil

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Autocad, BTP, Gestion de chantier, Génie civil', 0, NULL, NULL, 
        'Bac+3', 
        '1 à 2 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Autocad, BTP, Gestion de chantier', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-06 13:56:21', '2026-04-04 13:56:21', 1, ''),
(6078, 6, 1100048, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Formateur en Ligne Éducation & Formation Tanger', 
        1, 338, 
        '2026-04-12 13:56:21', '2026-06-11 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Formateur en Ligne', '2010', '76', 
        'Digital Ventures recherche un(e) Formateur en Ligne pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Formateur en Ligne
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Éducation & Formation.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
E-learning, Pédagogie, Formation professionnelle, Gestion de classe

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'E-learning, Pédagogie, Formation professionnelle, Gestion de classe', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'E-learning, Pédagogie, Formation professionnelle', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-10 13:56:21', '2026-04-12 13:56:21', 1, ''),
(6079, 6, 1100002, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Conducteur de Travaux BTP & Construction Kénitra', 
        0, 196, 
        '2026-04-05 13:56:21', '2026-06-04 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Conducteur de Travaux', '2007', '76', 
        'Oasis Industries recherche un(e) Conducteur de Travaux pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Conducteur de Travaux
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur BTP & Construction.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Conduite de travaux, BTP, Gestion de chantier

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Conduite de travaux, BTP, Gestion de chantier', 0, NULL, NULL, 
        'Bac+3', 
        '3 à 5 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Conduite de travaux, BTP, Gestion de chantier', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-16 13:56:21', '2026-04-05 13:56:21', 1, ''),
(6080, 6, 1100043, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef de Chantier BTP & Construction Tétouan', 
        1, 354, 
        '2026-04-15 13:56:21', '2026-06-14 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef de Chantier', '2007', '76', 
        'Mediterranean Group recherche un(e) Chef de Chantier pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef de Chantier
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur BTP & Construction.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Conduite de travaux, Autocad, Génie civil, BTP, Gestion de chantier

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Conduite de travaux, Autocad, Génie civil, BTP, Gestion de chantier', 0, NULL, NULL, 
        'Bac+5', 
        '5 ans et plus', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1001', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Conduite de travaux, Autocad, Génie civil', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-03 13:56:21', '2026-04-15 13:56:21', 1, ''),
(6081, 6, 1100009, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Supply Chain Manager Logistique & Transport Meknès', 
        1, 80, 
        '2026-03-28 13:56:21', '2026-05-27 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Supply Chain Manager', '2011', '76', 
        'Atlantic Solutions recherche un(e) Supply Chain Manager pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Supply Chain Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Optimisation logistique, Supply chain, Transport, Gestion des stocks

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Optimisation logistique, Supply chain, Transport, Gestion des stocks', 0, NULL, NULL, 
        'Bac+2', 
        '1 à 2 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Optimisation logistique, Supply chain, Transport', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-14 13:56:21', '2026-03-28 13:56:21', 1, ''),
(6082, 6, 1100042, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef de Réception Hôtellerie & Tourisme Rabat', 
        1, 334, 
        '2026-03-29 13:56:21', '2026-05-28 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef de Réception', '2012', '76', 
        'InnovateTech recherche un(e) Chef de Réception pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef de Réception
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Hôtellerie & Tourisme.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Réception, Animation, Gestion hôtelière

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Réception, Animation, Gestion hôtelière', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '995', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Réception, Animation, Gestion hôtelière', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-13 13:56:21', '2026-03-29 13:56:21', 1, ''),
(6083, 6, 1100009, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Commercial Commerce & Vente Tanger', 
        0, 337, 
        '2026-03-22 13:56:21', '2026-05-21 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Commercial', '2009', '76', 
        'InnovateTech recherche un(e) Responsable Commercial pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Commercial
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Vente B2B, Merchandising, Commerce international, Négociation commerciale

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Vente B2B, Merchandising, Commerce international, Négociation commerciale', 0, NULL, NULL, 
        'Bac+5', 
        '2 à 3 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Vente B2B, Merchandising, Commerce international', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-18 13:56:21', '2026-03-22 13:56:21', 1, ''),
(6084, 6, 1100001, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Directeur d\'Hôtel Hôtellerie & Tourisme Meknès', 
        1, 417, 
        '2026-04-01 13:56:21', '2026-05-31 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Directeur d\'Hôtel', '2012', '76', 
        'Oriental Industries recherche un(e) Directeur d\'Hôtel pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Directeur d\'Hôtel
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Hôtellerie & Tourisme.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Animation, Gestion hôtelière, Réception

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Animation, Gestion hôtelière, Réception', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Animation, Gestion hôtelière, Réception', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-10 13:56:21', '2026-04-01 13:56:21', 1, ''),
(6085, 6, 1100013, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Serveur Hôtellerie & Tourisme Agadir', 
        1, 434, 
        '2026-04-10 13:56:21', '2026-06-09 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Serveur', '2012', '76', 
        'Atlas Services recherche un(e) Serveur pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Serveur
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Hôtellerie & Tourisme.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Service client, Restauration, Animation

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Service client, Restauration, Animation', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '996', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Service client, Restauration, Animation', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-20 13:56:21', '2026-04-10 13:56:21', 1, ''),
(6086, 6, 1100050, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Supply Chain Manager Logistique & Transport Tanger', 
        0, 382, 
        '2026-03-23 13:56:21', '2026-05-22 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Supply Chain Manager', '2011', '76', 
        'Mediterranean Group recherche un(e) Supply Chain Manager pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Supply Chain Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Optimisation logistique, Transport, Supply chain

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Optimisation logistique, Transport, Supply chain', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '995', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Optimisation logistique, Transport, Supply chain', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-28 13:56:21', '2026-03-23 13:56:21', 1, ''),
(6087, 6, 1100044, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Conducteur de Travaux BTP & Construction Oujda', 
        0, 218, 
        '2026-03-22 13:56:21', '2026-05-21 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Conducteur de Travaux', '2007', '76', 
        'Fes Technologies recherche un(e) Conducteur de Travaux pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Conducteur de Travaux
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur BTP & Construction.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Conduite de travaux, Gestion de chantier, Génie civil

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Conduite de travaux, Gestion de chantier, Génie civil', 0, NULL, NULL, 
        'Bac+5', 
        '2 à 3 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Conduite de travaux, Gestion de chantier, Génie civil', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-07 13:56:21', '2026-03-22 13:56:21', 1, ''),
(6088, 6, 1100003, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Secrétaire de Direction Administration & Services Oujda', 
        1, 341, 
        '2026-04-02 13:56:21', '2026-06-01 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Secrétaire de Direction', '2014', '76', 
        'Fes Technologies recherche un(e) Secrétaire de Direction pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Secrétaire de Direction
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Administration & Services.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion administrative, Bureautique, Organisation

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion administrative, Bureautique, Organisation', 0, NULL, NULL, 
        'Bac+3', 
        '2 à 3 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion administrative, Bureautique, Organisation', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-03 13:56:21', '2026-04-02 13:56:21', 1, ''),
(6089, 6, 1100013, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Community Manager Marketing & Communication Agadir', 
        0, 499, 
        '2026-04-07 13:56:21', '2026-06-06 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Community Manager', '2005', '76', 
        'Fes Technologies recherche un(e) Community Manager pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Community Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
SEO, Social Media, Google Ads, Marketing digital, Stratégie marketing, Content marketing

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'SEO, Social Media, Google Ads, Marketing digital, Stratégie marketing, Content marketing', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'SEO, Social Media, Google Ads', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-22 13:56:21', '2026-04-07 13:56:21', 1, ''),
(6090, 6, 1100001, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chargé d\'Accueil Administration & Services Tanger', 
        1, 478, 
        '2026-04-13 13:56:21', '2026-06-12 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chargé d\'Accueil', '2014', '76', 
        'Moroccan Innovations recherche un(e) Chargé d\'Accueil pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chargé d\'Accueil
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Administration & Services.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Organisation, Secrétariat, Accueil, Bureautique

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Organisation, Secrétariat, Accueil, Bureautique', 0, NULL, NULL, 
        'Bac+5', 
        '5 ans et plus', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Organisation, Secrétariat, Accueil', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-08 13:56:21', '2026-04-13 13:56:21', 1, ''),
(6091, 6, 1100025, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Contrôleur de Gestion Finance & Comptabilité Fès', 
        0, 447, 
        '2026-03-19 13:56:21', '2026-05-18 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Contrôleur de Gestion', '2003', '76', 
        'Tangier Logistics recherche un(e) Contrôleur de Gestion pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Contrôleur de Gestion
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Finance & Comptabilité.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Fiscalité, SAP, Analyse financière, Comptabilité, Excel

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Fiscalité, SAP, Analyse financière, Comptabilité, Excel', 0, NULL, NULL, 
        'Bac+2', 
        '1 à 2 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Fiscalité, SAP, Analyse financière', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-05 13:56:21', '2026-03-19 13:56:21', 1, ''),
(6092, 6, 1100023, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Dessinateur Projeteur BTP & Construction Marrakech', 
        1, 292, 
        '2026-04-12 13:56:21', '2026-06-11 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Dessinateur Projeteur', '2007', '76', 
        'Maroc Distribution recherche un(e) Dessinateur Projeteur pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Dessinateur Projeteur
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur BTP & Construction.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Autocad, BTP, Conduite de travaux, Génie civil

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Autocad, BTP, Conduite de travaux, Génie civil', 0, NULL, NULL, 
        'Bac+2', 
        '1 à 2 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Autocad, BTP, Conduite de travaux', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-15 13:56:21', '2026-04-12 13:56:21', 1, ''),
(6093, 6, 1100043, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Réceptionniste Hôtellerie & Tourisme Oujda', 
        1, 239, 
        '2026-03-27 13:56:21', '2026-05-26 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Réceptionniste', '2012', '76', 
        'Kingdom Enterprises recherche un(e) Réceptionniste pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Réceptionniste
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Hôtellerie & Tourisme.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Service client, Gestion hôtelière, Restauration

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Service client, Gestion hôtelière, Restauration', 0, NULL, NULL, 
        'Bac+3', 
        '1 à 2 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '995', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Service client, Gestion hôtelière, Restauration', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-29 13:56:21', '2026-03-27 13:56:21', 1, ''),
(6094, 6, 1100044, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Community Manager Marketing & Communication Rabat', 
        0, 91, 
        '2026-04-09 13:56:21', '2026-06-08 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Community Manager', '2005', '76', 
        'Agadir Export recherche un(e) Community Manager pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Community Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Marketing digital, Google Ads, Social Media, Stratégie marketing, SEO, Content marketing

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Marketing digital, Google Ads, Social Media, Stratégie marketing, SEO, Content marketing', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Marketing digital, Google Ads, Social Media', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-03 13:56:21', '2026-04-09 13:56:21', 1, ''),
(6095, 6, 1100038, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Export Manager Commerce & Vente Oujda', 
        0, 220, 
        '2026-03-31 13:56:21', '2026-05-30 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Export Manager', '2009', '76', 
        'Casablanca Trading recherche un(e) Export Manager pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Export Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Négociation commerciale, Vente B2B, Commerce international, Merchandising

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Négociation commerciale, Vente B2B, Commerce international, Merchandising', 0, NULL, NULL, 
        'Ingénieur', 
        '5 ans et plus', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Négociation commerciale, Vente B2B, Commerce international', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-15 13:56:21', '2026-03-31 13:56:21', 1, ''),
(6096, 6, 1100006, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Métreur Vérificateur BTP & Construction Marrakech', 
        1, 30, 
        '2026-03-28 13:56:21', '2026-05-27 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Métreur Vérificateur', '2007', '76', 
        'TechnoSoft Morocco recherche un(e) Métreur Vérificateur pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Métreur Vérificateur
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur BTP & Construction.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Conduite de travaux, Autocad, Gestion de chantier, BTP, Génie civil

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Conduite de travaux, Autocad, Gestion de chantier, BTP, Génie civil', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Conduite de travaux, Autocad, Gestion de chantier', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-03 13:56:21', '2026-03-28 13:56:21', 1, ''),
(6097, 6, 1100028, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable des Ventes Commerce & Vente Casablanca', 
        1, 190, 
        '2026-04-03 13:56:21', '2026-06-02 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable des Ventes', '2002', '76', 
        'Kingdom Enterprises recherche un(e) Responsable des Ventes pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable des Ventes
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Techniques de vente, CRM, Négociation, Prospection, Relationnel

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Techniques de vente, CRM, Négociation, Prospection, Relationnel', 0, NULL, NULL, 
        'Bac+3', 
        '5 ans et plus', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Techniques de vente, CRM, Négociation', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-31 13:56:21', '2026-04-03 13:56:21', 1, ''),
(6098, 6, 1100002, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Analyste Financier Finance & Comptabilité Casablanca', 
        1, 323, 
        '2026-03-30 13:56:21', '2026-05-29 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Analyste Financier', '2003', '76', 
        'InnovateTech recherche un(e) Analyste Financier pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Analyste Financier
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Finance & Comptabilité.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Sage, Fiscalité, Excel

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Sage, Fiscalité, Excel', 0, NULL, NULL, 
        'Bac+3', 
        '5 ans et plus', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '993', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Sage, Fiscalité, Excel', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-21 13:56:21', '2026-03-30 13:56:21', 1, ''),
(6099, 6, 1100027, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef de Production Ingénierie & Production Casablanca', 
        0, 169, 
        '2026-04-07 13:56:21', '2026-06-06 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef de Production', '2006', '76', 
        'Digital Ventures recherche un(e) Chef de Production pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef de Production
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ingénierie & Production.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Production, Électricité, CAO

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Production, Électricité, CAO', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Production, Électricité, CAO', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-24 13:56:21', '2026-04-07 13:56:21', 1, ''),
(6100, 6, 1100039, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Business Developer Commerce & Vente Oujda', 
        0, 143, 
        '2026-03-21 13:56:21', '2026-05-20 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Business Developer', '2002', '76', 
        'Oasis Industries recherche un(e) Business Developer pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Business Developer
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Prospection, Négociation, Techniques de vente

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Prospection, Négociation, Techniques de vente', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Prospection, Négociation, Techniques de vente', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-07 13:56:21', '2026-03-21 13:56:21', 1, ''),
(6101, 6, 1100015, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chargé d\'Affaires Commerce & Vente Rabat', 
        1, 141, 
        '2026-03-22 13:56:21', '2026-05-21 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chargé d\'Affaires', '2009', '76', 
        'Fes Technologies recherche un(e) Chargé d\'Affaires pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chargé d\'Affaires
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Négociation commerciale, Merchandising, Vente B2B, Commerce international

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Négociation commerciale, Merchandising, Vente B2B, Commerce international', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '996', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Négociation commerciale, Merchandising, Vente B2B', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-28 13:56:21', '2026-03-22 13:56:21', 1, ''),
(6102, 6, 1100019, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Export Manager Commerce & Vente Fès', 
        1, 7, 
        '2026-04-09 13:56:21', '2026-06-08 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Export Manager', '2009', '76', 
        'Moroccan Innovations recherche un(e) Export Manager pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Export Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Négociation commerciale, Merchandising, Commerce international

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Négociation commerciale, Merchandising, Commerce international', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Négociation commerciale, Merchandising, Commerce international', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-11 13:56:21', '2026-04-09 13:56:21', 1, ''),
(6103, 6, 1100011, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Cybersécurité Informatique & Technologies Fès', 
        0, 144, 
        '2026-04-12 13:56:21', '2026-06-11 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Cybersécurité', '2001', '76', 
        'Agadir Export recherche un(e) Ingénieur Cybersécurité pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Cybersécurité
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Cybersécurité, Java, React, Node.js

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Cybersécurité, Java, React, Node.js', 0, NULL, NULL, 
        'Bac+2', 
        '1 à 2 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Cybersécurité, Java, React', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-24 13:56:21', '2026-04-12 13:56:21', 1, ''),
(6104, 6, 1100016, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef de Culture Agriculture & Agroalimentaire Meknès', 
        1, 365, 
        '2026-03-18 13:56:21', '2026-05-17 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef de Culture', '2013', '76', 
        'Maroc Distribution recherche un(e) Chef de Culture pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef de Culture
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Agriculture & Agroalimentaire.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Agroalimentaire, Agronomie, Agriculture, Production agricole

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Agroalimentaire, Agronomie, Agriculture, Production agricole', 0, NULL, NULL, 
        'Bac+5', 
        '2 à 3 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '1001', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Agroalimentaire, Agronomie, Agriculture', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-23 13:56:21', '2026-03-18 13:56:21', 1, ''),
(6105, 6, 1100012, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chargé d\'Accueil Administration & Services Casablanca', 
        0, 58, 
        '2026-03-26 13:56:21', '2026-05-25 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chargé d\'Accueil', '2014', '76', 
        'Digital Ventures recherche un(e) Chargé d\'Accueil pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chargé d\'Accueil
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Administration & Services.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Secrétariat, Accueil, Bureautique, Gestion administrative

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Secrétariat, Accueil, Bureautique, Gestion administrative', 0, NULL, NULL, 
        'Bac+5', 
        '5 ans et plus', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '995', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Secrétariat, Accueil, Bureautique', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-05 13:56:21', '2026-03-26 13:56:21', 1, ''),
(6106, 6, 1100013, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Gestionnaire RH Ressources Humaines Tanger', 
        1, 99, 
        '2026-04-12 13:56:21', '2026-06-11 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Gestionnaire RH', '2004', '76', 
        'InnovateTech recherche un(e) Gestionnaire RH pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Gestionnaire RH
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ressources Humaines.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion RH, Formation, Paie, Droit du travail, Recrutement

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion RH, Formation, Paie, Droit du travail, Recrutement', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion RH, Formation, Paie', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-18 13:56:21', '2026-04-12 13:56:21', 1, ''),
(6107, 6, 1100003, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Commercial B2B Commerce & Vente Kénitra', 
        0, 384, 
        '2026-04-02 13:56:21', '2026-06-01 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Commercial B2B', '2002', '76', 
        'Kingdom Enterprises recherche un(e) Commercial B2B pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Commercial B2B
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Négociation, Techniques de vente, Relationnel, Prospection

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Négociation, Techniques de vente, Relationnel, Prospection', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Négociation, Techniques de vente, Relationnel', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-24 13:56:21', '2026-04-02 13:56:21', 1, ''),
(6108, 6, 1100005, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef de Chantier BTP & Construction Marrakech', 
        0, 21, 
        '2026-04-13 13:56:21', '2026-06-12 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef de Chantier', '2007', '76', 
        'Tangier Logistics recherche un(e) Chef de Chantier pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef de Chantier
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur BTP & Construction.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Génie civil, Conduite de travaux, Autocad

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Génie civil, Conduite de travaux, Autocad', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Génie civil, Conduite de travaux, Autocad', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-17 13:56:21', '2026-04-13 13:56:21', 1, ''),
(6109, 6, 1100029, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Analyste Financier Finance & Comptabilité Kénitra', 
        1, 225, 
        '2026-03-18 13:56:21', '2026-05-17 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Analyste Financier', '2003', '76', 
        'Kingdom Enterprises recherche un(e) Analyste Financier pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Analyste Financier
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Finance & Comptabilité.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Comptabilité, Sage, SAP, Fiscalité, Analyse financière

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Comptabilité, Sage, SAP, Fiscalité, Analyse financière', 0, NULL, NULL, 
        'Bac+3', 
        '3 à 5 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Comptabilité, Sage, SAP', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-28 13:56:21', '2026-03-18 13:56:21', 1, ''),
(6110, 6, 1100019, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Gestionnaire de Stock Logistique & Transport Tétouan', 
        0, 51, 
        '2026-04-04 13:56:21', '2026-06-03 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Gestionnaire de Stock', '2011', '76', 
        'Mediterranean Group recherche un(e) Gestionnaire de Stock pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Gestionnaire de Stock
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Optimisation logistique, Transport, Gestion des stocks, Supply chain

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Optimisation logistique, Transport, Gestion des stocks, Supply chain', 0, NULL, NULL, 
        'Bac+5', 
        '1 à 2 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Optimisation logistique, Transport, Gestion des stocks', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-29 13:56:21', '2026-04-04 13:56:21', 1, ''),
(6111, 6, 1100043, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Professeur Éducation & Formation Oujda', 
        1, 34, 
        '2026-03-30 13:56:21', '2026-05-29 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Professeur', '2010', '76', 
        'Mediterranean Group recherche un(e) Professeur pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Professeur
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Éducation & Formation.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Formation professionnelle, Pédagogie, E-learning

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Formation professionnelle, Pédagogie, E-learning', 0, NULL, NULL, 
        'Ingénieur', 
        '5 ans et plus', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Formation professionnelle, Pédagogie, E-learning', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-17 13:56:21', '2026-03-30 13:56:21', 1, ''),
(6112, 6, 1100032, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Technicien Agricole Agriculture & Agroalimentaire Kénitra', 
        0, 323, 
        '2026-04-17 13:56:21', '2026-06-16 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Technicien Agricole', '2013', '76', 
        'TechnoSoft Morocco recherche un(e) Technicien Agricole pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Technicien Agricole
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Agriculture & Agroalimentaire.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Production agricole, Agriculture, Agroalimentaire, Agronomie

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Production agricole, Agriculture, Agroalimentaire, Agronomie', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '1001', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Production agricole, Agriculture, Agroalimentaire', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-27 13:56:21', '2026-04-17 13:56:21', 1, ''),
(6113, 6, 1100038, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Gestionnaire Administratif Administration & Services Agadir', 
        0, 403, 
        '2026-03-22 13:56:21', '2026-05-21 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Gestionnaire Administratif', '2014', '76', 
        'InnovateTech recherche un(e) Gestionnaire Administratif pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Gestionnaire Administratif
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Administration & Services.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Bureautique, Gestion administrative, Accueil, Secrétariat, Organisation

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Bureautique, Gestion administrative, Accueil, Secrétariat, Organisation', 0, NULL, NULL, 
        'Bac+5', 
        '1 à 2 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1001', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Bureautique, Gestion administrative, Accueil', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-29 13:56:21', '2026-03-22 13:56:21', 1, ''),
(6114, 6, 1100050, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Secrétaire de Direction Administration & Services Meknès', 
        1, 234, 
        '2026-04-03 13:56:21', '2026-06-02 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Secrétaire de Direction', '2014', '76', 
        'Sahara Tech recherche un(e) Secrétaire de Direction pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Secrétaire de Direction
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Administration & Services.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Bureautique, Organisation, Accueil

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Bureautique, Organisation, Accueil', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '995', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Bureautique, Organisation, Accueil', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-14 13:56:21', '2026-04-03 13:56:21', 1, ''),
(6115, 6, 1100048, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Directeur d\'Hôtel Hôtellerie & Tourisme Marrakech', 
        0, 470, 
        '2026-03-25 13:56:21', '2026-05-24 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Directeur d\'Hôtel', '2012', '76', 
        'Rabat Industries recherche un(e) Directeur d\'Hôtel pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Directeur d\'Hôtel
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Hôtellerie & Tourisme.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Service client, Réception, Restauration, Animation

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Service client, Réception, Restauration, Animation', 0, NULL, NULL, 
        'Ingénieur', 
        '5 ans et plus', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Service client, Réception, Restauration', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-17 13:56:21', '2026-03-25 13:56:21', 1, ''),
(6116, 6, 1100039, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Supply Chain Manager Logistique & Transport Rabat', 
        1, 66, 
        '2026-04-05 13:56:21', '2026-06-04 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Supply Chain Manager', '2011', '76', 
        'Oasis Industries recherche un(e) Supply Chain Manager pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Supply Chain Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Transport, Optimisation logistique, Gestion des stocks, Supply chain

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Transport, Optimisation logistique, Gestion des stocks, Supply chain', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Transport, Optimisation logistique, Gestion des stocks', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-08 13:56:21', '2026-04-05 13:56:21', 1, ''),
(6117, 6, 1100049, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chargé de Communication Marketing & Communication Tétouan', 
        1, 487, 
        '2026-03-30 13:56:21', '2026-05-29 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chargé de Communication', '2005', '76', 
        'Meknès Solutions recherche un(e) Chargé de Communication pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chargé de Communication
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Stratégie marketing, Google Ads, SEO

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Stratégie marketing, Google Ads, SEO', 0, NULL, NULL, 
        'Bac+5', 
        '5 ans et plus', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '996', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Stratégie marketing, Google Ads, SEO', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-07 13:56:21', '2026-03-30 13:56:21', 1, ''),
(6118, 6, 1100037, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Technicien de Maintenance Ingénierie & Production Casablanca', 
        1, 205, 
        '2026-03-19 13:56:21', '2026-05-18 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Technicien de Maintenance', '2006', '76', 
        'Mediterranean Group recherche un(e) Technicien de Maintenance pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Technicien de Maintenance
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ingénierie & Production.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Électricité, Maintenance, Production, Qualité, CAO

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Électricité, Maintenance, Production, Qualité, CAO', 0, NULL, NULL, 
        'Bac+2', 
        '3 à 5 ans', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Électricité, Maintenance, Production', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-25 13:56:21', '2026-03-19 13:56:21', 1, ''),
(6119, 6, 1100044, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Gouvernante Hôtellerie & Tourisme Meknès', 
        0, 143, 
        '2026-04-05 13:56:21', '2026-06-04 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Gouvernante', '2012', '76', 
        'Oasis Industries recherche un(e) Gouvernante pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Gouvernante
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Hôtellerie & Tourisme.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Restauration, Service client, Gestion hôtelière, Animation, Réception

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Restauration, Service client, Gestion hôtelière, Animation, Réception', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Restauration, Service client, Gestion hôtelière', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-28 13:56:21', '2026-04-05 13:56:21', 1, ''),
(6120, 6, 1100044, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Marketing Marketing & Communication Agadir', 
        0, 195, 
        '2026-04-03 13:56:21', '2026-06-02 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Marketing', '2005', '76', 
        'Meknès Solutions recherche un(e) Responsable Marketing pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Marketing
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Google Ads, Stratégie marketing, Content marketing, SEO

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Google Ads, Stratégie marketing, Content marketing, SEO', 0, NULL, NULL, 
        'Bac+3', 
        '2 à 3 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Google Ads, Stratégie marketing, Content marketing', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-18 13:56:21', '2026-04-03 13:56:21', 1, ''),
(6121, 6, 1100013, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Agronome Agriculture & Agroalimentaire Oujda', 
        1, 151, 
        '2026-03-22 13:56:21', '2026-05-21 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Agronome', '2013', '76', 
        'TechnoSoft Morocco recherche un(e) Ingénieur Agronome pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Agronome
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Agriculture & Agroalimentaire.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Agroalimentaire, Agronomie, Production agricole

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Agroalimentaire, Agronomie, Production agricole', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Agroalimentaire, Agronomie, Production agricole', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-25 13:56:21', '2026-03-22 13:56:21', 1, ''),
(6122, 6, 1100037, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Industriel Ingénierie & Production Tanger', 
        1, 334, 
        '2026-04-13 13:56:21', '2026-06-12 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Industriel', '2006', '76', 
        'Moroccan Innovations recherche un(e) Ingénieur Industriel pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Industriel
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ingénierie & Production.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Génie mécanique, Électricité, Maintenance, Qualité, Production

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Génie mécanique, Électricité, Maintenance, Qualité, Production', 0, NULL, NULL, 
        'Ingénieur', 
        '5 ans et plus', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Génie mécanique, Électricité, Maintenance', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-08 13:56:21', '2026-04-13 13:56:21', 1, ''),
(6123, 6, 1100006, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Secrétaire de Direction Administration & Services Marrakech', 
        1, 41, 
        '2026-04-06 13:56:21', '2026-06-05 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Secrétaire de Direction', '2014', '76', 
        'Kingdom Enterprises recherche un(e) Secrétaire de Direction pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Secrétaire de Direction
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Administration & Services.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion administrative, Organisation, Secrétariat

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion administrative, Organisation, Secrétariat', 0, NULL, NULL, 
        'Bac+3', 
        '1 à 2 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion administrative, Organisation, Secrétariat', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-13 13:56:21', '2026-04-06 13:56:21', 1, ''),
(6124, 6, 1100041, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chargé d\'Accueil Administration & Services Casablanca', 
        1, 77, 
        '2026-03-23 13:56:21', '2026-05-22 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chargé d\'Accueil', '2014', '76', 
        'Kingdom Enterprises recherche un(e) Chargé d\'Accueil pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chargé d\'Accueil
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Administration & Services.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Organisation, Accueil, Secrétariat, Gestion administrative

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Organisation, Accueil, Secrétariat, Gestion administrative', 0, NULL, NULL, 
        'Bac+3', 
        '1 à 2 ans', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Organisation, Accueil, Secrétariat', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-04 13:56:21', '2026-03-23 13:56:21', 1, ''),
(6125, 6, 1100038, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Assistant Médical Santé & Médical Rabat', 
        0, 426, 
        '2026-03-24 13:56:21', '2026-05-23 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Assistant Médical', '2008', '76', 
        'Agadir Export recherche un(e) Assistant Médical pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Assistant Médical
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Santé & Médical.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Radiologie, Pharmacie, Assistance médicale, Soins infirmiers

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Radiologie, Pharmacie, Assistance médicale, Soins infirmiers', 0, NULL, NULL, 
        'Bac+3', 
        '2 à 3 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '996', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Radiologie, Pharmacie, Assistance médicale', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-28 13:56:21', '2026-03-24 13:56:21', 1, ''),
(6126, 6, 1100045, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Commercial Commerce & Vente Tanger', 
        1, 470, 
        '2026-04-10 13:56:21', '2026-06-09 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Commercial', '2009', '76', 
        'Maroc Distribution recherche un(e) Responsable Commercial pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Commercial
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Négociation commerciale, Merchandising, Vente B2B, Commerce international

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Négociation commerciale, Merchandising, Vente B2B, Commerce international', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '996', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Négociation commerciale, Merchandising, Vente B2B', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-14 13:56:21', '2026-04-10 13:56:21', 1, ''),
(6127, 6, 1100012, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Commercial Commerce & Vente Tétouan', 
        1, 19, 
        '2026-03-19 13:56:21', '2026-05-18 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Commercial', '2009', '76', 
        'Casablanca Trading recherche un(e) Responsable Commercial pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Commercial
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Négociation commerciale, Merchandising, Commerce international

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Négociation commerciale, Merchandising, Commerce international', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Négociation commerciale, Merchandising, Commerce international', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-25 13:56:21', '2026-03-19 13:56:21', 1, ''),
(6128, 6, 1100022, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Qualité Ingénierie & Production Kénitra', 
        1, 363, 
        '2026-03-20 13:56:21', '2026-05-19 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Qualité', '2006', '76', 
        'Meknès Solutions recherche un(e) Ingénieur Qualité pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Qualité
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ingénierie & Production.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Qualité, Génie mécanique, CAO

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Qualité, Génie mécanique, CAO', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '995', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Qualité, Génie mécanique, CAO', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-07 13:56:21', '2026-03-20 13:56:21', 1, ''),
(6129, 6, 1100011, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Vétérinaire Agriculture & Agroalimentaire Marrakech', 
        0, 322, 
        '2026-03-26 13:56:21', '2026-05-25 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Vétérinaire', '2013', '76', 
        'Casablanca Trading recherche un(e) Vétérinaire pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Vétérinaire
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Agriculture & Agroalimentaire.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Production agricole, Agriculture, Agronomie, Agroalimentaire

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Production agricole, Agriculture, Agronomie, Agroalimentaire', 0, NULL, NULL, 
        'Bac+3', 
        '2 à 3 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Production agricole, Agriculture, Agronomie', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-24 13:56:21', '2026-03-26 13:56:21', 1, ''),
(6130, 6, 1100022, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Industriel Ingénierie & Production Casablanca', 
        0, 159, 
        '2026-04-08 13:56:21', '2026-06-07 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Industriel', '2006', '76', 
        'TechnoSoft Morocco recherche un(e) Ingénieur Industriel pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Industriel
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ingénierie & Production.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Génie mécanique, Production, Maintenance, CAO, Qualité, Électricité

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Génie mécanique, Production, Maintenance, CAO, Qualité, Électricité', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Génie mécanique, Production, Maintenance', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-23 13:56:21', '2026-04-08 13:56:21', 1, ''),
(6131, 6, 1100038, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Juriste d\'Entreprise Juridique & Conseil Casablanca', 
        0, 462, 
        '2026-03-26 13:56:21', '2026-05-25 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Juriste d\'Entreprise', '2015', '76', 
        'Moroccan Innovations recherche un(e) Juriste d\'Entreprise pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Juriste d\'Entreprise
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Juridique & Conseil.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Droit des affaires, Conseil juridique, Contentieux, Contrats

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Droit des affaires, Conseil juridique, Contentieux, Contrats', 0, NULL, NULL, 
        'Bac+3', 
        '5 ans et plus', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Droit des affaires, Conseil juridique, Contentieux', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-25 13:56:21', '2026-03-26 13:56:21', 1, ''),
(6132, 6, 1100033, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur DevOps Informatique & Technologies Kénitra', 
        0, 371, 
        '2026-04-16 13:56:21', '2026-06-15 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur DevOps', '2001', '76', 
        'Maroc Distribution recherche un(e) Ingénieur DevOps pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur DevOps
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
JavaScript, SQL, Angular

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'JavaScript, SQL, Angular', 0, NULL, NULL, 
        'Bac+5', 
        '2 à 3 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'JavaScript, SQL, Angular', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-21 13:56:21', '2026-04-16 13:56:21', 1, ''),
(6133, 6, 1100021, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Enseignant Éducation & Formation Casablanca', 
        0, 103, 
        '2026-03-23 13:56:21', '2026-05-22 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Enseignant', '2010', '76', 
        'Oriental Industries recherche un(e) Enseignant pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Enseignant
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Éducation & Formation.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Formation professionnelle, Pédagogie, E-learning

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Formation professionnelle, Pédagogie, E-learning', 0, NULL, NULL, 
        'Bac+5', 
        '2 à 3 ans', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Formation professionnelle, Pédagogie, E-learning', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-03 13:56:21', '2026-03-23 13:56:21', 1, ''),
(6134, 6, 1100028, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Vétérinaire Agriculture & Agroalimentaire Kénitra', 
        1, 312, 
        '2026-03-23 13:56:21', '2026-05-22 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Vétérinaire', '2013', '76', 
        'Atlas Services recherche un(e) Vétérinaire pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Vétérinaire
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Agriculture & Agroalimentaire.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Agriculture, Agronomie, Agroalimentaire

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Agriculture, Agronomie, Agroalimentaire', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Agriculture, Agronomie, Agroalimentaire', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-26 13:56:21', '2026-03-23 13:56:21', 1, ''),
(6135, 6, 1100029, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Juriste d\'Entreprise Juridique & Conseil Rabat', 
        0, 67, 
        '2026-04-13 13:56:21', '2026-06-12 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Juriste d\'Entreprise', '2015', '76', 
        'Tangier Logistics recherche un(e) Juriste d\'Entreprise pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Juriste d\'Entreprise
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Juridique & Conseil.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Contrats, Contentieux, Droit des affaires

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Contrats, Contentieux, Droit des affaires', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Contrats, Contentieux, Droit des affaires', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-28 13:56:21', '2026-04-13 13:56:21', 1, ''),
(6136, 6, 1100005, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Médecin Généraliste Santé & Médical Oujda', 
        0, 357, 
        '2026-03-31 13:56:21', '2026-05-30 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Médecin Généraliste', '2008', '76', 
        'Meknès Solutions recherche un(e) Médecin Généraliste pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Médecin Généraliste
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Santé & Médical.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Radiologie, Assistance médicale, Soins infirmiers, Médecine, Pharmacie

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Radiologie, Assistance médicale, Soins infirmiers, Médecine, Pharmacie', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Radiologie, Assistance médicale, Soins infirmiers', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-17 13:56:21', '2026-03-31 13:56:21', 1, ''),
(6137, 6, 1100005, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Industriel Ingénierie & Production Agadir', 
        1, 335, 
        '2026-03-21 13:56:21', '2026-05-20 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Industriel', '2006', '76', 
        'Sahara Tech recherche un(e) Ingénieur Industriel pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Industriel
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ingénierie & Production.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Électricité, Génie mécanique, CAO

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Électricité, Génie mécanique, CAO', 0, NULL, NULL, 
        'Bac+5', 
        '1 à 2 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Électricité, Génie mécanique, CAO', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-17 13:56:21', '2026-03-21 13:56:21', 1, ''),
(6138, 6, 1100036, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Médecin Généraliste Santé & Médical Fès', 
        1, 92, 
        '2026-04-12 13:56:21', '2026-06-11 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Médecin Généraliste', '2008', '76', 
        'Rabat Industries recherche un(e) Médecin Généraliste pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Médecin Généraliste
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Santé & Médical.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Médecine, Radiologie, Soins infirmiers

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Médecine, Radiologie, Soins infirmiers', 0, NULL, NULL, 
        'Bac+3', 
        '2 à 3 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '993', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Médecine, Radiologie, Soins infirmiers', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-14 13:56:21', '2026-04-12 13:56:21', 1, ''),
(6139, 6, 1100019, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Kinésithérapeute Santé & Médical Kénitra', 
        0, 288, 
        '2026-03-20 13:56:21', '2026-05-19 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Kinésithérapeute', '2008', '76', 
        'Kingdom Enterprises recherche un(e) Kinésithérapeute pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Kinésithérapeute
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Santé & Médical.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Pharmacie, Soins infirmiers, Radiologie

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Pharmacie, Soins infirmiers, Radiologie', 0, NULL, NULL, 
        'Bac+3', 
        '3 à 5 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Pharmacie, Soins infirmiers, Radiologie', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-15 13:56:21', '2026-03-20 13:56:21', 1, ''),
(6140, 6, 1100037, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Technicien de Laboratoire Santé & Médical Kénitra', 
        1, 109, 
        '2026-03-21 13:56:21', '2026-05-20 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Technicien de Laboratoire', '2008', '76', 
        'Royal Business recherche un(e) Technicien de Laboratoire pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Technicien de Laboratoire
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Santé & Médical.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Assistance médicale, Pharmacie, Soins infirmiers, Médecine

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Assistance médicale, Pharmacie, Soins infirmiers, Médecine', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Assistance médicale, Pharmacie, Soins infirmiers', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-28 13:56:21', '2026-03-21 13:56:21', 1, ''),
(6141, 6, 1100025, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Technicien Agricole Agriculture & Agroalimentaire Casablanca', 
        1, 384, 
        '2026-04-08 13:56:21', '2026-06-07 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Technicien Agricole', '2013', '76', 
        'Kingdom Enterprises recherche un(e) Technicien Agricole pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Technicien Agricole
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Agriculture & Agroalimentaire.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Agriculture, Agroalimentaire, Production agricole, Agronomie

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Agriculture, Agroalimentaire, Production agricole, Agronomie', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Agriculture, Agroalimentaire, Production agricole', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-23 13:56:21', '2026-04-08 13:56:21', 1, ''),
(6142, 6, 1100033, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Community Manager Marketing & Communication Casablanca', 
        1, 343, 
        '2026-03-22 13:56:21', '2026-05-21 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Community Manager', '2005', '76', 
        'Tangier Logistics recherche un(e) Community Manager pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Community Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Content marketing, Social Media, Marketing digital, SEO

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Content marketing, Social Media, Marketing digital, SEO', 0, NULL, NULL, 
        'Bac+3', 
        '3 à 5 ans', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Content marketing, Social Media, Marketing digital', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-07 13:56:21', '2026-03-22 13:56:21', 1, ''),
(6143, 6, 1100018, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Comptable Finance & Comptabilité Meknès', 
        0, 440, 
        '2026-04-05 13:56:21', '2026-06-04 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Comptable', '2003', '76', 
        'Digital Ventures recherche un(e) Comptable pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Comptable
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Finance & Comptabilité.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Comptabilité, SAP, Sage, Excel

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Comptabilité, SAP, Sage, Excel', 0, NULL, NULL, 
        'Bac+5', 
        '5 ans et plus', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Comptabilité, SAP, Sage', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-19 13:56:21', '2026-04-05 13:56:21', 1, ''),
(6144, 6, 1100045, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Structure BTP & Construction Kénitra', 
        0, 136, 
        '2026-03-29 13:56:21', '2026-05-28 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Structure', '2007', '76', 
        'Oriental Industries recherche un(e) Ingénieur Structure pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Structure
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur BTP & Construction.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Autocad, BTP, Conduite de travaux

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Autocad, BTP, Conduite de travaux', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '993', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Autocad, BTP, Conduite de travaux', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-06 13:56:21', '2026-03-29 13:56:21', 1, ''),
(6145, 6, 1100003, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Administrateur Système Informatique & Technologies Rabat', 
        0, 45, 
        '2026-04-15 13:56:21', '2026-06-14 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Administrateur Système', '2001', '76', 
        'TechnoSoft Morocco recherche un(e) Administrateur Système pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Administrateur Système
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Cloud, DevOps, Cybersécurité, SQL, Python

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Cloud, DevOps, Cybersécurité, SQL, Python', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Cloud, DevOps, Cybersécurité', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-10 13:56:21', '2026-04-15 13:56:21', 1, ''),
(6146, 6, 1100009, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chargé de Recrutement Ressources Humaines Oujda', 
        1, 299, 
        '2026-04-17 13:56:21', '2026-06-16 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chargé de Recrutement', '2004', '76', 
        'Tangier Logistics recherche un(e) Chargé de Recrutement pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chargé de Recrutement
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ressources Humaines.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Formation, Paie, Recrutement

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Formation, Paie, Recrutement', 0, NULL, NULL, 
        'Bac+3', 
        '3 à 5 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Formation, Paie, Recrutement', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-23 13:56:21', '2026-04-17 13:56:21', 1, ''),
(6147, 6, 1100050, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Directeur Commercial Commerce & Vente Tétouan', 
        1, 88, 
        '2026-03-21 13:56:21', '2026-05-20 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Directeur Commercial', '2009', '76', 
        'Maghreb Consulting recherche un(e) Directeur Commercial pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Directeur Commercial
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Vente B2B, Négociation commerciale, Commerce international

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Vente B2B, Négociation commerciale, Commerce international', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Vente B2B, Négociation commerciale, Commerce international', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-22 13:56:21', '2026-03-21 13:56:21', 1, ''),
(6148, 6, 1100024, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Méthodes Ingénierie & Production Meknès', 
        1, 240, 
        '2026-04-10 13:56:21', '2026-06-09 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Méthodes', '2006', '76', 
        'Atlantic Solutions recherche un(e) Responsable Méthodes pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Méthodes
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ingénierie & Production.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
CAO, Génie mécanique, Production

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'CAO, Génie mécanique, Production', 0, NULL, NULL, 
        'Bac+5', 
        '2 à 3 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'CAO, Génie mécanique, Production', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-27 13:56:21', '2026-04-10 13:56:21', 1, ''),
(6149, 6, 1100050, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Commercial Commerce & Vente Rabat', 
        1, 181, 
        '2026-03-18 13:56:21', '2026-05-17 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Commercial', '2009', '76', 
        'Oriental Industries recherche un(e) Responsable Commercial pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Commercial
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Négociation commerciale, Vente B2B, Merchandising

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Négociation commerciale, Vente B2B, Merchandising', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '995', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Négociation commerciale, Vente B2B, Merchandising', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-19 13:56:21', '2026-03-18 13:56:21', 1, ''),
(6150, 6, 1100049, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Directeur d\'Hôtel Hôtellerie & Tourisme Casablanca', 
        1, 448, 
        '2026-04-04 13:56:21', '2026-06-03 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Directeur d\'Hôtel', '2012', '76', 
        'Tangier Logistics recherche un(e) Directeur d\'Hôtel pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Directeur d\'Hôtel
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Hôtellerie & Tourisme.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion hôtelière, Restauration, Service client, Réception

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion hôtelière, Restauration, Service client, Réception', 0, NULL, NULL, 
        'Bac+3', 
        '5 ans et plus', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion hôtelière, Restauration, Service client', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-31 13:56:21', '2026-04-04 13:56:21', 1, ''),
(6151, 6, 1100012, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Industriel Ingénierie & Production Tanger', 
        1, 84, 
        '2026-03-27 13:56:21', '2026-05-26 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Industriel', '2006', '76', 
        'TechnoSoft Morocco recherche un(e) Ingénieur Industriel pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Industriel
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ingénierie & Production.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
CAO, Maintenance, Génie mécanique

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'CAO, Maintenance, Génie mécanique', 0, NULL, NULL, 
        'Bac+3', 
        '1 à 2 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'CAO, Maintenance, Génie mécanique', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-11 13:56:21', '2026-03-27 13:56:21', 1, ''),
(6152, 6, 1100023, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Architecte Cloud Informatique & Technologies Meknès', 
        0, 461, 
        '2026-04-06 13:56:21', '2026-06-05 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Architecte Cloud', '2001', '76', 
        'InnovateTech recherche un(e) Architecte Cloud pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Architecte Cloud
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Cloud, DevOps, Node.js

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Cloud, DevOps, Node.js', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Cloud, DevOps, Node.js', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-22 13:56:21', '2026-04-06 13:56:21', 1, ''),
(6153, 6, 1100010, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chargé de Recrutement Ressources Humaines Meknès', 
        0, 152, 
        '2026-03-28 13:56:21', '2026-05-27 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chargé de Recrutement', '2004', '76', 
        'Digital Ventures recherche un(e) Chargé de Recrutement pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chargé de Recrutement
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ressources Humaines.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Paie, Droit du travail, Recrutement, Gestion RH, Formation

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Paie, Droit du travail, Recrutement, Gestion RH, Formation', 0, NULL, NULL, 
        'Ingénieur', 
        '1 à 2 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Paie, Droit du travail, Recrutement', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-15 13:56:21', '2026-03-28 13:56:21', 1, ''),
(6154, 6, 1100047, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Métreur Vérificateur BTP & Construction Meknès', 
        1, 230, 
        '2026-04-01 13:56:21', '2026-05-31 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Métreur Vérificateur', '2007', '76', 
        'Maroc Distribution recherche un(e) Métreur Vérificateur pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Métreur Vérificateur
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur BTP & Construction.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Autocad, Génie civil, Conduite de travaux, BTP, Gestion de chantier

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Autocad, Génie civil, Conduite de travaux, BTP, Gestion de chantier', 0, NULL, NULL, 
        'Bac+2', 
        '1 à 2 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Autocad, Génie civil, Conduite de travaux', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-25 13:56:21', '2026-04-01 13:56:21', 1, ''),
(6155, 6, 1100023, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Export Manager Commerce & Vente Tanger', 
        0, 130, 
        '2026-04-10 13:56:21', '2026-06-09 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Export Manager', '2009', '76', 
        'Atlas Services recherche un(e) Export Manager pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Export Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Merchandising, Commerce international, Vente B2B

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Merchandising, Commerce international, Vente B2B', 0, NULL, NULL, 
        'Bac+3', 
        '1 à 2 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Merchandising, Commerce international, Vente B2B', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-16 13:56:21', '2026-04-10 13:56:21', 1, ''),
(6156, 6, 1100004, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Assistant Administratif Administration & Services Fès', 
        0, 425, 
        '2026-04-17 13:56:21', '2026-06-16 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Assistant Administratif', '2014', '76', 
        'Oriental Industries recherche un(e) Assistant Administratif pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Assistant Administratif
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Administration & Services.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Organisation, Accueil, Gestion administrative, Bureautique

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Organisation, Accueil, Gestion administrative, Bureautique', 0, NULL, NULL, 
        'Bac+2', 
        '3 à 5 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Organisation, Accueil, Gestion administrative', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-14 13:56:21', '2026-04-17 13:56:21', 1, ''),
(6157, 6, 1100037, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'SEO Specialist Marketing & Communication Rabat', 
        1, 205, 
        '2026-03-22 13:56:21', '2026-05-21 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'SEO Specialist', '2005', '76', 
        'Casablanca Trading recherche un(e) SEO Specialist pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de SEO Specialist
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Content marketing, Social Media, Marketing digital

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Content marketing, Social Media, Marketing digital', 0, NULL, NULL, 
        'Bac+5', 
        '2 à 3 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Content marketing, Social Media, Marketing digital', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-06 13:56:21', '2026-03-22 13:56:21', 1, ''),
(6158, 6, 1100050, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Data Scientist Informatique & Technologies Fès', 
        1, 75, 
        '2026-04-04 13:56:21', '2026-06-03 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Data Scientist', '2001', '76', 
        'Kingdom Enterprises recherche un(e) Data Scientist pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Data Scientist
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
React, Java, Cloud, Node.js, Cybersécurité, DevOps

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'React, Java, Cloud, Node.js, Cybersécurité, DevOps', 0, NULL, NULL, 
        'Bac+5', 
        '5 ans et plus', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1001', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'React, Java, Cloud', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-21 13:56:21', '2026-04-04 13:56:21', 1, ''),
(6159, 6, 1100030, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Délégué Commercial Commerce & Vente Tétouan', 
        1, 443, 
        '2026-04-02 13:56:21', '2026-06-01 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Délégué Commercial', '2002', '76', 
        'Oasis Industries recherche un(e) Délégué Commercial pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Délégué Commercial
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Techniques de vente, CRM, Relationnel

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Techniques de vente, CRM, Relationnel', 0, NULL, NULL, 
        'Bac+3', 
        '1 à 2 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Techniques de vente, CRM, Relationnel', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-07 13:56:21', '2026-04-02 13:56:21', 1, ''),
(6160, 6, 1100024, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Kinésithérapeute Santé & Médical Tanger', 
        1, 327, 
        '2026-04-04 13:56:21', '2026-06-03 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Kinésithérapeute', '2008', '76', 
        'Mediterranean Group recherche un(e) Kinésithérapeute pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Kinésithérapeute
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Santé & Médical.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Pharmacie, Soins infirmiers, Assistance médicale, Radiologie, Médecine

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Pharmacie, Soins infirmiers, Assistance médicale, Radiologie, Médecine', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Pharmacie, Soins infirmiers, Assistance médicale', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-10 13:56:21', '2026-04-04 13:56:21', 1, ''),
(6161, 6, 1100008, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Sales Manager Commerce & Vente Tétouan', 
        0, 433, 
        '2026-03-22 13:56:21', '2026-05-21 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Sales Manager', '2009', '76', 
        'Royal Business recherche un(e) Sales Manager pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Sales Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Commerce international, Merchandising, Vente B2B, Négociation commerciale

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Commerce international, Merchandising, Vente B2B, Négociation commerciale', 0, NULL, NULL, 
        'Bac+5', 
        '1 à 2 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Commerce international, Merchandising, Vente B2B', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-15 13:56:21', '2026-03-22 13:56:21', 1, ''),
(6162, 6, 1100041, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chargé de Communication Marketing & Communication Agadir', 
        0, 392, 
        '2026-04-02 13:56:21', '2026-06-01 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chargé de Communication', '2005', '76', 
        'Kingdom Enterprises recherche un(e) Chargé de Communication pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chargé de Communication
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Google Ads, Marketing digital, SEO, Stratégie marketing, Content marketing

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Google Ads, Marketing digital, SEO, Stratégie marketing, Content marketing', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Google Ads, Marketing digital, SEO', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-27 13:56:21', '2026-04-02 13:56:21', 1, ''),
(6163, 6, 1100002, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Avocat d\'Affaires Juridique & Conseil Kénitra', 
        1, 167, 
        '2026-04-05 13:56:21', '2026-06-04 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Avocat d\'Affaires', '2015', '76', 
        'Atlantic Solutions recherche un(e) Avocat d\'Affaires pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Avocat d\'Affaires
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Juridique & Conseil.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Contrats, Droit des affaires, Conseil juridique, Contentieux

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Contrats, Droit des affaires, Conseil juridique, Contentieux', 0, NULL, NULL, 
        'Ingénieur', 
        '5 ans et plus', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '995', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Contrats, Droit des affaires, Conseil juridique', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-06 13:56:21', '2026-04-05 13:56:21', 1, ''),
(6164, 6, 1100031, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Développeur Python Informatique & Technologies Kénitra', 
        1, 15, 
        '2026-04-08 13:56:21', '2026-06-07 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Développeur Python', '2001', '76', 
        'Agadir Export recherche un(e) Développeur Python pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Développeur Python
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Node.js, JavaScript, DevOps, Cloud, SQL, Cybersécurité

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Node.js, JavaScript, DevOps, Cloud, SQL, Cybersécurité', 0, NULL, NULL, 
        'Bac+3', 
        '3 à 5 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Node.js, JavaScript, DevOps', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-28 13:56:21', '2026-04-08 13:56:21', 1, ''),
(6165, 6, 1100047, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Infirmier Santé & Médical Tanger', 
        1, 344, 
        '2026-03-30 13:56:21', '2026-05-29 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Infirmier', '2008', '76', 
        'Digital Ventures recherche un(e) Infirmier pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Infirmier
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Santé & Médical.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Médecine, Soins infirmiers, Assistance médicale, Pharmacie

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Médecine, Soins infirmiers, Assistance médicale, Pharmacie', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Médecine, Soins infirmiers, Assistance médicale', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-22 13:56:21', '2026-03-30 13:56:21', 1, ''),
(6166, 6, 1100008, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Logistique Logistique & Transport Oujda', 
        1, 64, 
        '2026-03-19 13:56:21', '2026-05-18 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Logistique', '2011', '76', 
        'Agadir Export recherche un(e) Responsable Logistique pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Logistique
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion des stocks, Optimisation logistique, Supply chain, Transport

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion des stocks, Optimisation logistique, Supply chain, Transport', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '995', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion des stocks, Optimisation logistique, Supply chain', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-28 13:56:21', '2026-03-19 13:56:21', 1, ''),
(6167, 6, 1100043, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'DRH Ressources Humaines Fès', 
        1, 452, 
        '2026-04-08 13:56:21', '2026-06-07 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'DRH', '2004', '76', 
        'Oasis Industries recherche un(e) DRH pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de DRH
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ressources Humaines.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Gestion RH, Droit du travail, Formation, Paie

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Gestion RH, Droit du travail, Formation, Paie', 0, NULL, NULL, 
        'Bac+2', 
        '3 à 5 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Gestion RH, Droit du travail, Formation', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-13 13:56:21', '2026-04-08 13:56:21', 1, ''),
(6168, 6, 1100030, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Supply Chain Manager Logistique & Transport Fès', 
        1, 333, 
        '2026-03-27 13:56:21', '2026-05-26 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Supply Chain Manager', '2011', '76', 
        'Meknès Solutions recherche un(e) Supply Chain Manager pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Supply Chain Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Optimisation logistique, Transport, Supply chain

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Optimisation logistique, Transport, Supply chain', 0, NULL, NULL, 
        'Bac+3', 
        '5 ans et plus', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Optimisation logistique, Transport, Supply chain', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-17 13:56:21', '2026-03-27 13:56:21', 1, ''),
(6169, 6, 1100028, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Export Manager Commerce & Vente Rabat', 
        1, 305, 
        '2026-04-09 13:56:21', '2026-06-08 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Export Manager', '2009', '76', 
        'Sahara Tech recherche un(e) Export Manager pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Export Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Vente B2B, Commerce international, Négociation commerciale

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Vente B2B, Commerce international, Négociation commerciale', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '993', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Vente B2B, Commerce international, Négociation commerciale', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-15 13:56:21', '2026-04-09 13:56:21', 1, ''),
(6170, 6, 1100004, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Méthodes Ingénierie & Production Tanger', 
        1, 10, 
        '2026-04-01 13:56:21', '2026-05-31 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Méthodes', '2006', '76', 
        'Mediterranean Group recherche un(e) Responsable Méthodes pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Méthodes
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ingénierie & Production.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Génie mécanique, Qualité, Maintenance, Production

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Génie mécanique, Qualité, Maintenance, Production', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '995', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Génie mécanique, Qualité, Maintenance', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-11 13:56:21', '2026-04-01 13:56:21', 1, ''),
(6171, 6, 1100006, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Directeur Financier Finance & Comptabilité Oujda', 
        1, 252, 
        '2026-04-04 13:56:21', '2026-06-03 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Directeur Financier', '2003', '76', 
        'Atlantic Solutions recherche un(e) Directeur Financier pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Directeur Financier
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Finance & Comptabilité.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Analyse financière, Excel, Comptabilité

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Analyse financière, Excel, Comptabilité', 0, NULL, NULL, 
        'Bac+2', 
        '5 ans et plus', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Analyse financière, Excel, Comptabilité', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-19 13:56:21', '2026-04-04 13:56:21', 1, ''),
(6172, 6, 1100021, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Logistique Logistique & Transport Tétouan', 
        1, 446, 
        '2026-04-02 13:56:21', '2026-06-01 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Logistique', '2011', '76', 
        'Casablanca Trading recherche un(e) Responsable Logistique pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Logistique
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Optimisation logistique, Supply chain, Transport, Gestion des stocks

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Optimisation logistique, Supply chain, Transport, Gestion des stocks', 0, NULL, NULL, 
        'Bac+3', 
        '5 ans et plus', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '1001', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Optimisation logistique, Supply chain, Transport', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-08 13:56:21', '2026-04-02 13:56:21', 1, ''),
(6173, 6, 1100023, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Développeur Mobile Informatique & Technologies Casablanca', 
        1, 377, 
        '2026-04-13 13:56:21', '2026-06-12 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Développeur Mobile', '2001', '76', 
        'Atlantic Solutions recherche un(e) Développeur Mobile pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Développeur Mobile
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Python, Angular, Cybersécurité, JavaScript, SQL, Cloud

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Python, Angular, Cybersécurité, JavaScript, SQL, Cloud', 0, NULL, NULL, 
        'Bac+5', 
        '2 à 3 ans', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '995', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Python, Angular, Cybersécurité', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-15 13:56:21', '2026-04-13 13:56:21', 1, ''),
(6174, 6, 1100041, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Gestionnaire Administratif Administration & Services Fès', 
        1, 429, 
        '2026-03-28 13:56:21', '2026-05-27 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Gestionnaire Administratif', '2014', '76', 
        'Atlas Services recherche un(e) Gestionnaire Administratif pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Gestionnaire Administratif
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Administration & Services.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Secrétariat, Bureautique, Organisation, Accueil

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Secrétariat, Bureautique, Organisation, Accueil', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Secrétariat, Bureautique, Organisation', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-01 13:56:21', '2026-03-28 13:56:21', 1, ''),
(6175, 6, 1100026, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Qualité Ingénierie & Production Marrakech', 
        1, 26, 
        '2026-03-30 13:56:21', '2026-05-29 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Qualité', '2006', '76', 
        'Digital Ventures recherche un(e) Ingénieur Qualité pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Qualité
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ingénierie & Production.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Production, Qualité, Génie mécanique, Maintenance, CAO, Électricité

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Production, Qualité, Génie mécanique, Maintenance, CAO, Électricité', 0, NULL, NULL, 
        'Bac+3', 
        '2 à 3 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Production, Qualité, Génie mécanique', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-18 13:56:21', '2026-03-30 13:56:21', 1, ''),
(6176, 6, 1100022, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Data Scientist Informatique & Technologies Agadir', 
        1, 21, 
        '2026-04-09 13:56:21', '2026-06-08 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Data Scientist', '2001', '76', 
        'Kingdom Enterprises recherche un(e) Data Scientist pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Data Scientist
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Node.js, Java, JavaScript

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Node.js, Java, JavaScript', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Node.js, Java, JavaScript', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-27 13:56:21', '2026-04-09 13:56:21', 1, ''),
(6177, 6, 1100018, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Génie Civil BTP & Construction Meknès', 
        0, 82, 
        '2026-03-23 13:56:21', '2026-05-22 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Génie Civil', '2007', '76', 
        'Maghreb Consulting recherche un(e) Ingénieur Génie Civil pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Génie Civil
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur BTP & Construction.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
BTP, Conduite de travaux, Gestion de chantier

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'BTP, Conduite de travaux, Gestion de chantier', 0, NULL, NULL, 
        'Bac+3', 
        '2 à 3 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '1000', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'BTP, Conduite de travaux, Gestion de chantier', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-25 13:56:21', '2026-03-23 13:56:21', 1, ''),
(6178, 6, 1100031, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Qualité Alimentaire Agriculture & Agroalimentaire Casablanca', 
        0, 121, 
        '2026-03-20 13:56:21', '2026-05-19 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Qualité Alimentaire', '2013', '76', 
        'Agadir Export recherche un(e) Responsable Qualité Alimentaire pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Qualité Alimentaire
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Agriculture & Agroalimentaire.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Agriculture, Agronomie, Production agricole, Agroalimentaire

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Agriculture, Agronomie, Production agricole, Agroalimentaire', 0, NULL, NULL, 
        'Ingénieur', 
        '3 à 5 ans', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '999', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Agriculture, Agronomie, Production agricole', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-03 13:56:21', '2026-03-20 13:56:21', 1, ''),
(6179, 6, 1100024, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Compliance Officer Juridique & Conseil Marrakech', 
        0, 18, 
        '2026-04-12 13:56:21', '2026-06-11 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Compliance Officer', '2015', '76', 
        'Oasis Industries recherche un(e) Compliance Officer pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Compliance Officer
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Juridique & Conseil.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Contentieux, Conseil juridique, Droit des affaires

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Contentieux, Conseil juridique, Droit des affaires', 0, NULL, NULL, 
        'Bac+2', 
        '3 à 5 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '994', 
        '999', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Contentieux, Conseil juridique, Droit des affaires', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-26 13:56:21', '2026-04-12 13:56:21', 1, ''),
(6180, 6, 1100022, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Auditeur Financier Finance & Comptabilité Kénitra', 
        0, 407, 
        '2026-03-28 13:56:21', '2026-05-27 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Auditeur Financier', '2003', '76', 
        'Oasis Industries recherche un(e) Auditeur Financier pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Auditeur Financier
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Finance & Comptabilité.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Excel, Comptabilité, Fiscalité, SAP, Analyse financière, Sage

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Excel, Comptabilité, Fiscalité, SAP, Analyse financière, Sage', 0, NULL, NULL, 
        'Ingénieur', 
        '5 ans et plus', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '996', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Excel, Comptabilité, Fiscalité', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-10 13:56:21', '2026-03-28 13:56:21', 1, ''),
(6181, 6, 1100041, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Secrétaire de Direction Administration & Services Tétouan', 
        1, 172, 
        '2026-04-01 13:56:21', '2026-05-31 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Secrétaire de Direction', '2014', '76', 
        'Maroc Distribution recherche un(e) Secrétaire de Direction pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Secrétaire de Direction
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Administration & Services.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Secrétariat, Bureautique, Organisation, Accueil, Gestion administrative

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Secrétariat, Bureautique, Organisation, Accueil, Gestion administrative', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Secrétariat, Bureautique, Organisation', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-11 13:56:21', '2026-04-01 13:56:21', 1, ''),
(6182, 6, 1100023, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'DRH Ressources Humaines Marrakech', 
        1, 127, 
        '2026-04-10 13:56:21', '2026-06-09 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'DRH', '2004', '76', 
        'Agadir Export recherche un(e) DRH pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de DRH
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ressources Humaines.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Paie, Gestion RH, Droit du travail, Recrutement

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Paie, Gestion RH, Droit du travail, Recrutement', 0, NULL, NULL, 
        'Bac+2', 
        '1 à 2 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Paie, Gestion RH, Droit du travail', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-21 13:56:21', '2026-04-10 13:56:21', 1, ''),
(6183, 6, 1100014, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Juriste d\'Entreprise Juridique & Conseil Oujda', 
        1, 346, 
        '2026-04-02 13:56:21', '2026-06-01 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Juriste d\'Entreprise', '2015', '76', 
        'Casablanca Trading recherche un(e) Juriste d\'Entreprise pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Juriste d\'Entreprise
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Juridique & Conseil.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Contentieux, Droit des affaires, Conseil juridique

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Contentieux, Droit des affaires, Conseil juridique', 0, NULL, NULL, 
        'Ingénieur', 
        '5 ans et plus', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '994', 
        '1001', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Contentieux, Droit des affaires, Conseil juridique', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-17 13:56:21', '2026-04-02 13:56:21', 1, ''),
(6184, 6, 1100044, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef de Projet Digital Marketing & Communication Casablanca', 
        0, 104, 
        '2026-03-27 13:56:21', '2026-05-26 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef de Projet Digital', '2005', '76', 
        'Meknès Solutions recherche un(e) Chef de Projet Digital pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef de Projet Digital
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Social Media, Stratégie marketing, Content marketing

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Social Media, Stratégie marketing, Content marketing', 0, NULL, NULL, 
        'Bac+5', 
        '1 à 2 ans', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '995', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Social Media, Stratégie marketing, Content marketing', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-28 13:56:21', '2026-03-27 13:56:21', 1, ''),
(6185, 6, 1100028, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Assistant Administratif Administration & Services Rabat', 
        1, 445, 
        '2026-03-18 13:56:21', '2026-05-17 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Assistant Administratif', '2014', '76', 
        'Fes Technologies recherche un(e) Assistant Administratif pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Assistant Administratif
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Administration & Services.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Organisation, Secrétariat, Accueil

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Organisation, Secrétariat, Accueil', 0, NULL, NULL, 
        'Bac+5', 
        '5 ans et plus', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Organisation, Secrétariat, Accueil', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-11 13:56:21', '2026-03-18 13:56:21', 1, ''),
(6186, 6, 1100005, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Secrétaire de Direction Administration & Services Tétouan', 
        1, 321, 
        '2026-04-10 13:56:21', '2026-06-09 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Secrétaire de Direction', '2014', '76', 
        'Atlantic Solutions recherche un(e) Secrétaire de Direction pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Secrétaire de Direction
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Administration & Services.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Bureautique, Organisation, Secrétariat

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Bureautique, Organisation, Secrétariat', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Bureautique, Organisation, Secrétariat', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-15 13:56:21', '2026-04-10 13:56:21', 1, ''),
(6187, 6, 1100011, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef de Projet IT Informatique & Technologies Marrakech', 
        1, 326, 
        '2026-03-29 13:56:21', '2026-05-28 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef de Projet IT', '2001', '76', 
        'Rabat Industries recherche un(e) Chef de Projet IT pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef de Projet IT
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Informatique & Technologies.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
SQL, DevOps, Angular, React, Node.js

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'SQL, DevOps, Angular, React, Node.js', 0, NULL, NULL, 
        'Ingénieur', 
        '2 à 3 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'SQL, DevOps, Angular', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-23 13:56:21', '2026-03-29 13:56:21', 1, ''),
(6188, 6, 1100003, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Agronome Agriculture & Agroalimentaire Rabat', 
        1, 96, 
        '2026-04-08 13:56:21', '2026-06-07 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Agronome', '2013', '76', 
        'TechnoSoft Morocco recherche un(e) Ingénieur Agronome pour rejoindre son équipe à Rabat.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Agronome
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Agriculture & Agroalimentaire.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Agroalimentaire, Agronomie, Agriculture

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Agroalimentaire, Agronomie, Agriculture', 0, NULL, NULL, 
        'Bac+3', 
        '5 ans et plus', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Rabat', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Rabat 34.0209 -6.8417', 
        NULL, 1, NULL, NULL, NULL, 'Rabat, Maroc', 
        34.0209, -6.8417, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '993', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Agroalimentaire, Agronomie, Agriculture', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-18 13:56:21', '2026-04-08 13:56:21', 1, ''),
(6189, 6, 1100047, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Gestionnaire RH Ressources Humaines Meknès', 
        1, 75, 
        '2026-03-26 13:56:21', '2026-05-25 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Gestionnaire RH', '2004', '76', 
        'TechnoSoft Morocco recherche un(e) Gestionnaire RH pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Gestionnaire RH
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ressources Humaines.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Formation, Gestion RH, Droit du travail, Recrutement, Paie

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Formation, Gestion RH, Droit du travail, Recrutement, Paie', 0, NULL, NULL, 
        'Bac+3', 
        '3 à 5 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '996', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Formation, Gestion RH, Droit du travail', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-01 13:56:21', '2026-03-26 13:56:21', 1, ''),
(6190, 6, 1100012, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Supply Chain Manager Logistique & Transport Agadir', 
        1, 395, 
        '2026-03-27 13:56:21', '2026-05-26 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Supply Chain Manager', '2011', '76', 
        'InnovateTech recherche un(e) Supply Chain Manager pour rejoindre son équipe à Agadir.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Supply Chain Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Optimisation logistique, Supply chain, Transport

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Optimisation logistique, Supply chain, Transport', 0, NULL, NULL, 
        'Bac+2', 
        '2 à 3 ans', 
        NULL, 'Souss-Massa', '', NULL, 'Agadir', 
        0, 0, 0, 'Maroc Souss-Massa Agadir 30.4278 -9.5981', 
        NULL, 1, NULL, NULL, NULL, 'Agadir, Maroc', 
        30.4278, -9.5981, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '995', 
        '1001', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Optimisation logistique, Supply chain, Transport', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-02 13:56:21', '2026-03-27 13:56:21', 1, ''),
(6191, 6, 1100030, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Contrôleur de Gestion Finance & Comptabilité Marrakech', 
        1, 333, 
        '2026-03-26 13:56:21', '2026-05-25 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Contrôleur de Gestion', '2003', '76', 
        'InnovateTech recherche un(e) Contrôleur de Gestion pour rejoindre son équipe à Marrakech.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Contrôleur de Gestion
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Finance & Comptabilité.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Analyse financière, Comptabilité, Sage

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Analyse financière, Comptabilité, Sage', 0, NULL, NULL, 
        'Bac+5', 
        '2 à 3 ans', 
        NULL, 'Marrakech-Safi', '', NULL, 'Marrakech', 
        0, 0, 0, 'Maroc Marrakech-Safi Marrakech 31.6295 -7.9811', 
        NULL, 1, NULL, NULL, NULL, 'Marrakech, Maroc', 
        31.6295, -7.9811, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '995', 
        '999', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Analyse financière, Comptabilité, Sage', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-12 13:56:21', '2026-03-26 13:56:21', 1, ''),
(6192, 6, 1100035, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Commercial Commerce & Vente Oujda', 
        0, 417, 
        '2026-04-06 13:56:21', '2026-06-05 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Commercial', '2009', '76', 
        'Moroccan Innovations recherche un(e) Responsable Commercial pour rejoindre son équipe à Oujda.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Commercial
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Commerce & Vente.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Merchandising, Vente B2B, Commerce international, Négociation commerciale

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Merchandising, Vente B2B, Commerce international, Négociation commerciale', 0, NULL, NULL, 
        'Bac+3', 
        '5 ans et plus', 
        NULL, 'Oriental', '', NULL, 'Oujda', 
        0, 0, 0, 'Maroc Oriental Oujda 34.6867 -1.9114', 
        NULL, 1, NULL, NULL, NULL, 'Oujda, Maroc', 
        34.6867, -1.9114, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '996', 
        '1001', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Merchandising, Vente B2B, Commerce international', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-06 13:56:21', '2026-04-06 13:56:21', 1, ''),
(6193, 6, 1100046, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Formateur en Ligne Éducation & Formation Fès', 
        1, 282, 
        '2026-04-05 13:56:21', '2026-06-04 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Formateur en Ligne', '2010', '76', 
        'Atlantic Solutions recherche un(e) Formateur en Ligne pour rejoindre son équipe à Fès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Formateur en Ligne
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Éducation & Formation.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
E-learning, Formation professionnelle, Gestion de classe

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'E-learning, Formation professionnelle, Gestion de classe', 0, NULL, NULL, 
        'Bac+3', 
        '2 à 3 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Fès', 
        0, 0, 0, 'Maroc Fès-Meknès Fès 34.0181 -5.0078', 
        NULL, 1, NULL, NULL, NULL, 'Fès, Maroc', 
        34.0181, -5.0078, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'E-learning, Formation professionnelle, Gestion de classe', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-13 13:56:21', '2026-04-05 13:56:21', 1, ''),
(6194, 6, 1100019, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Ingénieur Qualité Ingénierie & Production Casablanca', 
        0, 225, 
        '2026-04-17 13:56:21', '2026-06-16 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Ingénieur Qualité', '2006', '76', 
        'Maroc Distribution recherche un(e) Ingénieur Qualité pour rejoindre son équipe à Casablanca.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Ingénieur Qualité
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ingénierie & Production.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Génie mécanique, CAO, Qualité, Électricité, Production, Maintenance

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Génie mécanique, CAO, Qualité, Électricité, Production, Maintenance', 0, NULL, NULL, 
        'Ingénieur', 
        '5 ans et plus', 
        NULL, 'Casablanca-Settat', '', NULL, 'Casablanca', 
        0, 0, 0, 'Maroc Casablanca-Settat Casablanca 33.5731 -7.5898', 
        NULL, 1, NULL, NULL, NULL, 'Casablanca, Maroc', 
        33.5731, -7.5898, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '990', 
        '993', 
        '1000', 
        '2201', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Génie mécanique, CAO, Qualité', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-30 13:56:21', '2026-04-17 13:56:21', 1, ''),
(6195, 6, 1100014, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Chef de Production Ingénierie & Production Tanger', 
        1, 190, 
        '2026-04-06 13:56:21', '2026-06-05 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Chef de Production', '2006', '76', 
        'Casablanca Trading recherche un(e) Chef de Production pour rejoindre son équipe à Tanger.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Chef de Production
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Ingénierie & Production.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Production, Génie mécanique, Qualité, Maintenance

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Production, Génie mécanique, Qualité, Maintenance', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tanger', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tanger 35.7595 -5.834', 
        NULL, 1, NULL, NULL, NULL, 'Tanger, Maroc', 
        35.7595, -5.834, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '996', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Production, Génie mécanique, Qualité', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-17 13:56:21', '2026-04-06 13:56:21', 1, ''),
(6196, 6, 1100012, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Community Manager Marketing & Communication Kénitra', 
        1, 240, 
        '2026-03-29 13:56:21', '2026-05-28 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Community Manager', '2005', '76', 
        'Meknès Solutions recherche un(e) Community Manager pour rejoindre son équipe à Kénitra.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Community Manager
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Marketing & Communication.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
3 à 5 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Social Media, Content marketing, SEO, Google Ads

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Social Media, Content marketing, SEO, Google Ads', 0, NULL, NULL, 
        'Bac+3', 
        '3 à 5 ans', 
        NULL, 'Rabat-Salé-Kénitra', '', NULL, 'Kénitra', 
        0, 0, 0, 'Maroc Rabat-Salé-Kénitra Kénitra 34.261 -6.5802', 
        NULL, 1, NULL, NULL, NULL, 'Kénitra, Maroc', 
        34.261, -6.5802, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '1001', 
        '2200', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Social Media, Content marketing, SEO', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-11 13:56:21', '2026-03-29 13:56:21', 1, ''),
(6197, 6, 1100037, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Kinésithérapeute Santé & Médical Meknès', 
        1, 26, 
        '2026-03-28 13:56:21', '2026-05-27 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Kinésithérapeute', '2008', '76', 
        'Maghreb Consulting recherche un(e) Kinésithérapeute pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Kinésithérapeute
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Santé & Médical.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
1 à 2 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Pharmacie, Médecine, Assistance médicale

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Pharmacie, Médecine, Assistance médicale', 0, NULL, NULL, 
        'Bac+2', 
        '3 à 5 ans', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '995', 
        '1000', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Pharmacie, Médecine, Assistance médicale', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-13 13:56:21', '2026-03-28 13:56:21', 1, ''),
(6198, 6, 1100012, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Responsable Logistique Logistique & Transport Tétouan', 
        1, 374, 
        '2026-03-18 13:56:21', '2026-05-17 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Responsable Logistique', '2011', '76', 
        'Royal Business recherche un(e) Responsable Logistique pour rejoindre son équipe à Tétouan.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Responsable Logistique
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Logistique & Transport.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
2 à 3 ans d\'expérience requise

COMPÉTENCES TECHNIQUES:
Supply chain, Gestion des stocks, Transport

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Supply chain, Gestion des stocks, Transport', 0, NULL, NULL, 
        'Bac+5', 
        '3 à 5 ans', 
        NULL, 'Tanger-Tétouan-Al Hoceïma', '', NULL, 'Tétouan', 
        0, 0, 0, 'Maroc Tanger-Tétouan-Al Hoceïma Tétouan 35.5889 -5.3626', 
        NULL, 1, NULL, NULL, NULL, 'Tétouan, Maroc', 
        35.5889, -5.3626, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '989', 
        '994', 
        '999', 
        '2203', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Supply chain, Gestion des stocks, Transport', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-03-18 13:56:21', '2026-03-18 13:56:21', 1, ''),
(6199, 6, 1100034, 
        'a:11:{s:16:\"listing_type_sid\";s:1:\"6\";s:5:\"price\";s:6:\"900.00\";}', 
        1, 'Conseiller Juridique Juridique & Conseil Meknès', 
        0, 117, 
        '2026-04-11 13:56:21', '2026-06-10 13:56:21', NULL, 
        'everyone',NULL, NULL, NULL, 
        'Conseiller Juridique', '2015', '76', 
        'Oasis Industries recherche un(e) Conseiller Juridique pour rejoindre son équipe à Meknès.

MISSIONS PRINCIPALES:
- Assurer les missions liées au poste de Conseiller Juridique
- Collaborer avec les équipes en place
- Contribuer au développement de l\'entreprise
- Participer aux projets stratégiques
- Garantir la qualité des livrables

ENVIRONNEMENT DE TRAVAIL:
Intégrez une entreprise dynamique dans le secteur Juridique & Conseil.
Nous offrons un environnement de travail moderne et stimulant.

AVANTAGES:
CNSS, Mutuelle santé, Formation continue, Évolution de carrière', 'FORMATION:
Diplôme Bac+3 minimum en lien avec le poste

EXPÉRIENCE:
5 ans et plus d\'expérience requise

COMPÉTENCES TECHNIQUES:
Contrats, Droit des affaires, Conseil juridique

COMPÉTENCES COMPORTEMENTALES:
- Autonomie et rigueur
- Esprit d\'équipe
- Capacité d\'adaptation
- Sens de l\'organisation
- Excellente communication', 
        NULL, 'Contrats, Droit des affaires, Conseil juridique', 0, NULL, NULL, 
        'Bac+5', 
        '5 ans et plus', 
        NULL, 'Fès-Meknès', '', NULL, 'Meknès', 
        0, 0, 0, 'Maroc Fès-Meknès Meknès 33.8935 -5.5473', 
        NULL, 1, NULL, NULL, NULL, 'Meknès, Maroc', 
        33.8935, -5.5473, 0, NULL, NULL, NULL, 'Maroc', NULL, 
        '988', 
        '993', 
        '1000', 
        '2202', 
        '1011,1013', '1023', NULL, NULL, NULL, NULL, '1', 
        'Contrats, Droit des affaires, Conseil juridique', 0, NULL, NULL, 
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 
        '2026-04-15 13:56:21', '2026-04-11 13:56:21', 1, '');

-- ================================================================
-- INSERTION DE 50 CANDIDATURES
-- ================================================================

INSERT INTO `applications` (`id`, `listing_id`, `jobseeker_id`, `comments`, `date`, `resume`, `file`, `mime_type`, `file_id`, `username`, `email`, `hidden`, `status`, `order`, `notes`, `deja_vu`, `date_last_vu`, `Phone`) VALUES
(1000, 6022, 2000036, 
        'Candidature via plateforme', 
        '2026-04-11 13:56:21', 
        'cv_candidate_0.pdf', NULL, 'application/pdf', 
        'file_0', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 1, 
        '2026-03-23 13:56:21', NULL),
(1001, 6127, 2000086, 
        'Candidature via plateforme', 
        '2026-03-12 13:56:21', 
        'cv_candidate_1.pdf', NULL, 'application/pdf', 
        'file_1', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 0, 
        '2026-02-17 13:56:21', NULL),
(1002, 6173, 2000045, 
        'Candidature via plateforme', 
        '2026-03-16 13:56:21', 
        'cv_candidate_2.pdf', NULL, 'application/pdf', 
        'file_2', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 0, 
        '2026-02-20 13:56:21', NULL),
(1003, 6163, 2000082, 
        'Candidature via plateforme', 
        '2026-03-05 13:56:21', 
        'cv_candidate_3.pdf', NULL, 'application/pdf', 
        'file_3', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 1, 
        '2026-03-27 13:56:21', NULL),
(1004, 6123, 2000059, 
        'Candidature via plateforme', 
        '2026-03-15 13:56:21', 
        'cv_candidate_4.pdf', NULL, 'application/pdf', 
        'file_4', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 1, 
        '2026-03-21 13:56:21', NULL),
(1005, 6132, 2000067, 
        'Candidature via plateforme', 
        '2026-02-24 13:56:21', 
        'cv_candidate_5.pdf', NULL, 'application/pdf', 
        'file_5', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 0, 
        '2026-03-06 13:56:21', NULL),
(1006, 6041, 2000128, 
        'Candidature via plateforme', 
        '2026-03-23 13:56:21', 
        'cv_candidate_6.pdf', NULL, 'application/pdf', 
        'file_6', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 0, 
        '2026-04-16 13:56:21', NULL),
(1007, 6041, 2000108, 
        'Candidature via plateforme', 
        '2026-02-17 13:56:21', 
        'cv_candidate_7.pdf', NULL, 'application/pdf', 
        'file_7', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 0, 
        '2026-04-03 13:56:21', NULL),
(1008, 6033, 2000147, 
        'Candidature via plateforme', 
        '2026-02-17 13:56:21', 
        'cv_candidate_8.pdf', NULL, 'application/pdf', 
        'file_8', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 1, 
        '2026-02-25 13:56:21', NULL),
(1009, 6059, 2000084, 
        'Candidature via plateforme', 
        '2026-03-06 13:56:21', 
        'cv_candidate_9.pdf', NULL, 'application/pdf', 
        'file_9', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 1, 
        '2026-04-13 13:56:21', NULL),
(1010, 6116, 2000030, 
        'Candidature via plateforme', 
        '2026-04-17 13:56:21', 
        'cv_candidate_10.pdf', NULL, 'application/pdf', 
        'file_10', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 0, 
        '2026-03-23 13:56:21', NULL),
(1011, 6050, 2000134, 
        'Candidature via plateforme', 
        '2026-03-25 13:56:21', 
        'cv_candidate_11.pdf', NULL, 'application/pdf', 
        'file_11', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 1, 
        '2026-04-16 13:56:21', NULL),
(1012, 6012, 2000037, 
        'Candidature via plateforme', 
        '2026-04-09 13:56:21', 
        'cv_candidate_12.pdf', NULL, 'application/pdf', 
        'file_12', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 0, 
        '2026-03-26 13:56:21', NULL),
(1013, 6047, 2000031, 
        'Candidature via plateforme', 
        '2026-03-18 13:56:21', 
        'cv_candidate_13.pdf', NULL, 'application/pdf', 
        'file_13', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 1, 
        '2026-04-09 13:56:21', NULL),
(1014, 6164, 2000123, 
        'Candidature via plateforme', 
        '2026-04-15 13:56:21', 
        'cv_candidate_14.pdf', NULL, 'application/pdf', 
        'file_14', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 1, 
        '2026-03-28 13:56:21', NULL),
(1015, 6140, 2000135, 
        'Candidature via plateforme', 
        '2026-02-18 13:56:21', 
        'cv_candidate_15.pdf', NULL, 'application/pdf', 
        'file_15', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 1, 
        '2026-02-19 13:56:21', NULL),
(1016, 6176, 2000110, 
        'Candidature via plateforme', 
        '2026-03-11 13:56:21', 
        'cv_candidate_16.pdf', NULL, 'application/pdf', 
        'file_16', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 0, 
        '2026-03-14 13:56:21', NULL),
(1017, 6149, 2000146, 
        'Candidature via plateforme', 
        '2026-04-14 13:56:21', 
        'cv_candidate_17.pdf', NULL, 'application/pdf', 
        'file_17', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 1, 
        '2026-03-23 13:56:21', NULL),
(1018, 6010, 2000118, 
        'Candidature via plateforme', 
        '2026-02-28 13:56:21', 
        'cv_candidate_18.pdf', NULL, 'application/pdf', 
        'file_18', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 1, 
        '2026-03-10 13:56:21', NULL),
(1019, 6054, 2000149, 
        'Candidature via plateforme', 
        '2026-03-01 13:56:21', 
        'cv_candidate_19.pdf', NULL, 'application/pdf', 
        'file_19', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 0, 
        '2026-03-25 13:56:21', NULL),
(1020, 6069, 2000108, 
        'Candidature via plateforme', 
        '2026-04-14 13:56:21', 
        'cv_candidate_20.pdf', NULL, 'application/pdf', 
        'file_20', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 0, 
        '2026-02-24 13:56:21', NULL),
(1021, 6122, 2000068, 
        'Candidature via plateforme', 
        '2026-02-25 13:56:21', 
        'cv_candidate_21.pdf', NULL, 'application/pdf', 
        'file_21', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 0, 
        '2026-03-10 13:56:21', NULL),
(1022, 6121, 2000056, 
        'Candidature via plateforme', 
        '2026-04-10 13:56:21', 
        'cv_candidate_22.pdf', NULL, 'application/pdf', 
        'file_22', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 0, 
        '2026-03-05 13:56:21', NULL),
(1023, 6130, 2000007, 
        'Candidature via plateforme', 
        '2026-03-12 13:56:21', 
        'cv_candidate_23.pdf', NULL, 'application/pdf', 
        'file_23', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 1, 
        '2026-03-15 13:56:21', NULL),
(1024, 6134, 2000060, 
        'Candidature via plateforme', 
        '2026-03-18 13:56:21', 
        'cv_candidate_24.pdf', NULL, 'application/pdf', 
        'file_24', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 0, 
        '2026-02-18 13:56:21', NULL),
(1025, 6153, 2000040, 
        'Candidature via plateforme', 
        '2026-03-22 13:56:21', 
        'cv_candidate_25.pdf', NULL, 'application/pdf', 
        'file_25', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 0, 
        '2026-03-08 13:56:21', NULL),
(1026, 6096, 2000061, 
        'Candidature via plateforme', 
        '2026-03-29 13:56:21', 
        'cv_candidate_26.pdf', NULL, 'application/pdf', 
        'file_26', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 1, 
        '2026-04-09 13:56:21', NULL),
(1027, 6052, 2000016, 
        'Candidature via plateforme', 
        '2026-03-15 13:56:21', 
        'cv_candidate_27.pdf', NULL, 'application/pdf', 
        'file_27', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 1, 
        '2026-02-25 13:56:21', NULL),
(1028, 6007, 2000103, 
        'Candidature via plateforme', 
        '2026-04-07 13:56:21', 
        'cv_candidate_28.pdf', NULL, 'application/pdf', 
        'file_28', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 1, 
        '2026-04-12 13:56:21', NULL),
(1029, 6191, 2000032, 
        'Candidature via plateforme', 
        '2026-03-08 13:56:21', 
        'cv_candidate_29.pdf', NULL, 'application/pdf', 
        'file_29', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 1, 
        '2026-04-12 13:56:21', NULL),
(1030, 6115, 2000048, 
        'Candidature via plateforme', 
        '2026-03-13 13:56:21', 
        'cv_candidate_30.pdf', NULL, 'application/pdf', 
        'file_30', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 1, 
        '2026-04-15 13:56:21', NULL),
(1031, 6083, 2000060, 
        'Candidature via plateforme', 
        '2026-03-01 13:56:21', 
        'cv_candidate_31.pdf', NULL, 'application/pdf', 
        'file_31', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 1, 
        '2026-03-09 13:56:21', NULL),
(1032, 6159, 2000143, 
        'Candidature via plateforme', 
        '2026-03-29 13:56:21', 
        'cv_candidate_32.pdf', NULL, 'application/pdf', 
        'file_32', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 0, 
        '2026-03-09 13:56:21', NULL),
(1033, 6134, 2000120, 
        'Candidature via plateforme', 
        '2026-03-25 13:56:21', 
        'cv_candidate_33.pdf', NULL, 'application/pdf', 
        'file_33', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 1, 
        '2026-04-01 13:56:21', NULL),
(1034, 6118, 2000072, 
        'Candidature via plateforme', 
        '2026-04-13 13:56:21', 
        'cv_candidate_34.pdf', NULL, 'application/pdf', 
        'file_34', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 1, 
        '2026-03-28 13:56:21', NULL),
(1035, 6016, 2000067, 
        'Candidature via plateforme', 
        '2026-03-26 13:56:21', 
        'cv_candidate_35.pdf', NULL, 'application/pdf', 
        'file_35', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 0, 
        '2026-02-16 13:56:21', NULL),
(1036, 6165, 2000145, 
        'Candidature via plateforme', 
        '2026-02-28 13:56:21', 
        'cv_candidate_36.pdf', NULL, 'application/pdf', 
        'file_36', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 0, 
        '2026-03-14 13:56:21', NULL),
(1037, 6040, 2000090, 
        'Candidature via plateforme', 
        '2026-03-04 13:56:21', 
        'cv_candidate_37.pdf', NULL, 'application/pdf', 
        'file_37', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 1, 
        '2026-04-01 13:56:21', NULL),
(1038, 6022, 2000101, 
        'Candidature via plateforme', 
        '2026-03-05 13:56:21', 
        'cv_candidate_38.pdf', NULL, 'application/pdf', 
        'file_38', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 0, 
        '2026-04-01 13:56:21', NULL),
(1039, 6146, 2000005, 
        'Candidature via plateforme', 
        '2026-03-27 13:56:21', 
        'cv_candidate_39.pdf', NULL, 'application/pdf', 
        'file_39', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 0, 
        '2026-04-03 13:56:21', NULL),
(1040, 6015, 2000118, 
        'Candidature via plateforme', 
        '2026-03-05 13:56:21', 
        'cv_candidate_40.pdf', NULL, 'application/pdf', 
        'file_40', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 0, 
        '2026-03-27 13:56:21', NULL),
(1041, 6033, 2000029, 
        'Candidature via plateforme', 
        '2026-03-16 13:56:21', 
        'cv_candidate_41.pdf', NULL, 'application/pdf', 
        'file_41', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 0, 
        '2026-02-18 13:56:21', NULL),
(1042, 6165, 2000024, 
        'Candidature via plateforme', 
        '2026-03-17 13:56:21', 
        'cv_candidate_42.pdf', NULL, 'application/pdf', 
        'file_42', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 0, 
        '2026-03-08 13:56:21', NULL),
(1043, 6055, 2000051, 
        'Candidature via plateforme', 
        '2026-02-23 13:56:21', 
        'cv_candidate_43.pdf', NULL, 'application/pdf', 
        'file_43', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 0, 
        '2026-04-02 13:56:21', NULL),
(1044, 6089, 2000129, 
        'Candidature via plateforme', 
        '2026-03-25 13:56:21', 
        'cv_candidate_44.pdf', NULL, 'application/pdf', 
        'file_44', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 0, 
        '2026-03-13 13:56:21', NULL),
(1045, 6171, 2000061, 
        'Candidature via plateforme', 
        '2026-03-16 13:56:21', 
        'cv_candidate_45.pdf', NULL, 'application/pdf', 
        'file_45', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 0, 
        '2026-03-11 13:56:21', NULL),
(1046, 6100, 2000053, 
        'Candidature via plateforme', 
        '2026-03-23 13:56:21', 
        'cv_candidate_46.pdf', NULL, 'application/pdf', 
        'file_46', NULL, NULL, 0, 
        'Rejetée', 
        9999, NULL, 1, 
        '2026-03-26 13:56:21', NULL),
(1047, 6152, 2000031, 
        'Candidature via plateforme', 
        '2026-04-06 13:56:21', 
        'cv_candidate_47.pdf', NULL, 'application/pdf', 
        'file_47', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 1, 
        '2026-03-29 13:56:21', NULL),
(1048, 6161, 2000066, 
        'Candidature via plateforme', 
        '2026-03-23 13:56:21', 
        'cv_candidate_48.pdf', NULL, 'application/pdf', 
        'file_48', NULL, NULL, 0, 
        'En attente', 
        9999, NULL, 0, 
        '2026-03-27 13:56:21', NULL),
(1049, 6166, 2000110, 
        'Candidature via plateforme', 
        '2026-04-10 13:56:21', 
        'cv_candidate_49.pdf', NULL, 'application/pdf', 
        'file_49', NULL, NULL, 0, 
        'Acceptée', 
        9999, NULL, 0, 
        '2026-03-29 13:56:21', NULL);

-- ================================================================
-- RÉSUMÉ DES OPÉRATIONS
-- ================================================================
-- Nettoyage HTML effectué sur:
--   - blog.text
--   - listings.JobDescription
--   - listings.JobRequirements
--   - users.CompanyDescription
--
-- Données insérées:
--   - 150 utilisateurs candidats (IDs: 2000000-2000149)
--   - 200 offres d'emploi (IDs: 6000-6199)
--   - 50 candidatures (IDs: 1000-1049)
--
-- TOTAL: 400 lignes de données insérées
-- ================================================================
