{title}{$listing_title}{/title}
{javascript}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Professional Filter Design for Enterprise Applications */
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary-color: #64748b;
            --secondary-hover: #475569;
            --success-color: #059669;
            --danger-color: #dc2626;
            --warning-color: #d97706;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            --font-size-xs: 0.75rem;
            --font-size-sm: 0.875rem;
            --font-size-base: 1rem;
            --font-size-lg: 1.125rem;
            --font-size-xl: 1.25rem;
            --spacing-1: 0.25rem;
            --spacing-2: 0.5rem;
            --spacing-3: 0.75rem;
            --spacing-4: 1rem;
            --spacing-5: 1.25rem;
            --spacing-6: 1.5rem;
            --spacing-8: 2rem;
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .filters-container {
            margin-top: var(--spacing-6);
            background: #ffffff;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            font-family: var(--font-family);
            position: relative;
        }

        .filters-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--spacing-5) var(--spacing-6);
            background: linear-gradient(135deg, var(--gray-50) 0%, #ffffff 100%);
            border-bottom: 1px solid var(--gray-200);
        }

        .filters-title {
            display: flex;
            align-items: center;
            gap: var(--spacing-3);
            color: var(--gray-800);
            font-size: var(--font-size-lg);
            font-weight: 600;
            letter-spacing: -0.025em;
        }

        .filters-title i {
            color: var(--primary-color);
            font-size: var(--font-size-base);
        }

        .filters-actions {
            display: flex;
            gap: var(--spacing-3);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-2);
            padding: var(--spacing-2) var(--spacing-4);
            border: 1px solid transparent;
            border-radius: var(--radius-md);
            font-size: var(--font-size-sm);
            font-weight: 500;
            line-height: 1.5;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .btn:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

       

        .btn-primary {
            font-weight: 600;
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: #ffffff;
            text-transform: uppercase;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-secondary {
            background: var(--gray-100);
            border-color: var(--gray-300);
            color: var(--gray-700);
        }

        .btn-secondary:hover {
            background: var(--gray-200);
            border-color: var(--gray-400);
        }

        .btn-outline {
            background: transparent;
            border-color: var(--gray-300);
            color: var(--gray-600);
        }

        .btn-outline:hover {
            background: var(--gray-50);
            border-color: var(--gray-400);
            color: var(--gray-700);
        }

        .filters-content {
            padding: var(--spacing-6);
        }

        .filters-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--spacing-5);
            margin-bottom: var(--spacing-5);
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-2);
        }

        .filter-label {
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
            font-size: var(--font-size-sm);
            font-weight: 500;
            color: var(--gray-700);
            margin-bottom: var(--spacing-1);
        }

        .filter-label i {
            color:  var(--primary-color);
            font-size: var(--font-size-xs);
            width: 14px;
        }

        .filter-input {
            padding: var(--spacing-3) var(--spacing-4);
            border: 1px solid var(--gray-300);
            border-radius: var(--radius-md);
            font-size: var(--font-size-sm);
            background: #ffffff;
            transition: all 0.2s ease-in-out;
            color: var(--gray-900);
        }

        .filter-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .filter-input::placeholder {
            color: var(--gray-400);
        }

.date-range {
    display: flex;
    gap: var(--spacing-2); /* Reduced gap between elements */
    align-items: center;
}

.date-range select {
    flex: 1; /* Make both selects take equal space */
    min-width: 0; /* Allow them to shrink if needed */
}

.date-separator {
    display: none; /* Completely remove the separator since it's not needed */
}

        .advanced-filters {
            border-top: 1px solid var(--gray-200);
            margin-top: var(--spacing-5);
            padding-top: var(--spacing-5);
            display: none;
            animation: slideDown 0.3s ease-out;
        }

        .advanced-filters.show {
            display: block;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .toggle-advanced {
            background: none;
            border: none;
            color: var(--primary-color);
            font-weight: 500;
            font-size: var(--font-size-sm);
            cursor: pointer;
            padding: var(--spacing-2) 0;
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
            transition: color 0.2s ease-in-out;
            font-weight: 700;
        }

        .toggle-advanced:hover {
            color: var(--primary-hover);
        }
      
        .chevron {
            transition: transform 0.3s ease-in-out;
            font-size: var(--font-size-xs);
        }

        .chevron.rotated {
            transform: rotate(180deg);
        }

        .sort-section {
            padding: var(--spacing-5) 0;
            border-top: 1px solid var(--gray-200);
            margin-top: var(--spacing-5);
        }

        .sort-title {
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
            font-size: var(--font-size-sm);
            font-weight: 500;
            color: var(--gray-700);
            margin-bottom: var(--spacing-4);
        }

        .sort-title i {
            color: var(--gray-500);
            font-size: var(--font-size-xs);
        }

        .sort-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-3);
        }

        .sort-option {
            display: flex;
            align-items: center;
            gap: var(--spacing-3);
            padding: var(--spacing-3) var(--spacing-4);
            background: #ffffff;
            border: 1px solid var(--gray-300);
            border-radius: var(--radius-md);
            cursor: pointer;
            font-size: var(--font-size-sm);
            transition: all 0.2s ease-in-out;
            color: var(--gray-700);
        }

        .sort-option:hover {
            background: var(--gray-50);
            border-color: var(--gray-400);
        }

        .sort-option.active {
            background: var(--primary-color);
            color: #ffffff;
            border-color: var(--primary-color);
            box-shadow: var(--shadow-sm);
        }

        .sort-option input[type="radio"] {
            display: none;
        }

        .sort-option i {
            font-size: var(--font-size-xs);
            opacity: 0.8;
        }

        .view-toggle-section {
            padding: var(--spacing-4) 0;
            border-top: 1px solid var(--gray-200);
            margin-top: var(--spacing-5);
        }

        .view-toggle-title {
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
            font-size: var(--font-size-sm);
            font-weight: 500;
            color: var(--gray-700);
            margin-bottom: var(--spacing-3);
        }

        .view-toggle-buttons {
            display: flex;
            gap: var(--spacing-2);
        }

        .view-toggle-btn {
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
            padding: var(--spacing-2) var(--spacing-4);
            background: #ffffff;
            border: 1px solid var(--gray-300);
            border-radius: var(--radius-md);
            cursor: pointer;
            font-size: var(--font-size-sm);
            transition: all 0.2s ease-in-out;
            color: var(--gray-700);
        }

        .view-toggle-btn:hover {
            background: var(--gray-50);
            border-color: var(--gray-400);
        }

        .view-toggle-btn.active {
            background: var(--primary-color);
            color: #ffffff;
            border-color: var(--primary-color);
        }

        .applicants-list-view {
            display: none;
        }

        .applicants-list-view.active {
            display: block;
        }

        .applicants-list-view .application-item {
            display: flex;
            align-items: center;
            padding: var(--spacing-4);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-md);
            margin-bottom: var(--spacing-3);
            background: #ffffff;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .applicants-list-view .application-item:hover {
            box-shadow: var(--shadow-md);
            border-color: var(--gray-300);
        }

        .applicants-list-view .application-photo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            margin-right: var(--spacing-4);
            flex-shrink: 0;
        }

        .applicants-list-view .application-info {
            flex: 1;
        }

        .applicants-list-view .application-name {
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: var(--spacing-1);
        }

        .applicants-list-view .application-date {
            color: var(--gray-600);
            font-size: var(--font-size-sm);
        }

        .applicants-list-view .application-status {
            padding: var(--spacing-1) var(--spacing-3);
            border-radius: var(--radius-sm);
            font-size: var(--font-size-xs);
            font-weight: 500;
            margin-left: var(--spacing-4);
        }

        .results-summary {
            padding: var(--spacing-4) var(--spacing-6);
            background: #f1f5f9;
            border-top: 1px solid var(--gray-200);
            color:var(--gray-700);
            font-size: var(--font-size-sm);
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
        }

        .results-summary i {
            color:var(--primary-color);;
            font-size: var(--font-size-xs);
        }

        .filters-container.loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .filters-container.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid var(--gray-300);
            border-top-color: var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        select.filter-input {
          /*  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            appearance: none;*/
        }

        .applicants .applicant-status {
            margin-bottom: var(--spacing-6);
        }

        .applicants .applicant-status__header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--spacing-3) var(--spacing-4);
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            border-radius: 5px 5px 0px 0px;
            margin-bottom: var(--spacing-0);
        }

        .applicants .applicant-status__header h4 {
            font-size: var(--font-size-base);
            font-weight: 600;
            color: var(--gray-800);
            margin: 0;
        }

        .applicants .applicant-status__header .count {
            font-size: var(--font-size-sm);
            color: var(--gray-600);
        }

        .applicants .applicant-status__cards {
            padding: var(--spacing-4);
            border: 1px solid var(--gray-200);
            border-top: none;
            border-radius: 0 0 var(--radius-md) var(--radius-md);
        }

        /* Modal-specific styles to ensure visibility */
        .modal {
            z-index: 9999 !important; /* Higher than default to avoid overlap */
        }

        .modal-dialog {
            z-index: 1060 !important;
        }

        .modal-backdrop {
            z-index: 1050 !important; /* Below modal but above other content */
        }

        @media (max-width: 768px) {
            .filters-container {
                margin-top: var(--spacing-4);
                border-radius: var(--radius-md);
            }

            .filters-header {
                flex-direction: column;
                gap: var(--spacing-4);
                text-align: center;
                padding: var(--spacing-4);
            }

            .filters-content {
                padding: var(--spacing-4);
            }

            .filters-row {
                grid-template-columns: 1fr;
                gap: var(--spacing-4);
            }

            .sort-options {
                grid-template-columns: 1fr;
            }

            .filters-footer {
                flex-direction: column;
                gap: var(--spacing-3);
            }

            .btn {
                justify-content: center;
                width: 100%;
            }

 .date-range {
    display: flex;
    gap: var(--spacing-2); /* Reduced gap between elements */
    align-items: center;
}

.date-range select {
    flex: 1; /* Make both selects take equal space */
    min-width: 0; /* Allow them to shrink if needed */
}

.date-separator {
    display: none; /* Completely remove the separator since it's not needed */
}

            .results-summary {
                padding: var(--spacing-3) var(--spacing-4);
            }

            .view-toggle-buttons {
                flex-direction: column;
            }

            .modal-dialog {
                max-width: 95% !important;
            }
        }

.applicants-list-view .application-item {
            display: flex;
            align-items: center;
            padding: var(--spacing-4);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-md);
            margin-bottom: var(--spacing-3);
            background: #ffffff;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .applicants-list-view .application-photo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            margin-right: var(--spacing-4);
            flex-shrink: 0;
        }

        .applicants-list-view .application-info {
            flex: 1;
        }

        .applicants-list-view .application-name {
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: var(--spacing-1);
        }

        .applicants-list-view .application-date {
            color: var(--gray-600);
            font-size: var(--font-size-sm);
        }

        .retour {
            margin-bottom: 15px;
        }
        
        .filters-container {
            margin-top: 50px;
            background: #f6faff;
            border: 1px solid #2563eb;
           
        }
        .btn-export-pdf i { color:#c70f2b }

        .btn-export-list i { color: #03723a; }

        .btn-export-pdf {
            background: #fff9fa;
            border: #c82444 1px solid;
            color: #c82444;
        }

        .btn-export-list {
            background: #f0f8f4;
            border: 1px solid #03723a;
            color: #03723a;
            max-width: 120px;
        }


        
.button-rapport {
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: sans-serif;
  }
  

  .applicant-status[data-status="Nouveau"] .applicant-status__header {
    background-color: #ffe7d1;

    border: 1px solid #ee810c;
  }
  
  .applicant-status[data-status="Nouveau"] .applicant-status__header h4 {
    font-size: 14px;
    color: #ee810c;    font-weight: 400;
    
  }
  
  .applicant-status[data-status="Interview"] .applicant-status__header  {
    background-color: #d6e4ff;

    border: 1px solid #2563eb;
  }
  .applicant-status[data-status="Interview"] .applicant-status__header h4  {
    font-size: 14px;
    color: #2563eb;    font-weight: 400;

  }
  

  .applicant-status[data-status="Sélectionné"] .applicant-status__header  {
    background-color:  #f1ffe0;;
 
    border: 1px solid  #8bc34a;;
  }
  
  .applicant-status[data-status="Sélectionné"] .applicant-status__header  h4 {
    font-size: 14px;
    color: #8bc34a;
    font-weight: 400;
  }
  

  .applicant-status[data-status="Disqualifié"] .applicant-status__header   {
    background-color: #fddede;

    border: 1px solid #cc3a3a; 
  }
  
  .applicant-status[data-status="Disqualifié"] .applicant-status__header h4  {
    font-size: 14px;
    color: #cc3a3a;    font-weight: 400;

  }
  
 
  .button-rapport:hover {
    opacity: 0.9;
    transform: scale(1.02);
  }

  .element.style {
    background: #fffaf5;
}
  


.applicant-status[data-status="Nouveau"] .applicant-status__cards.ui-sortable  {
    background: #fffaf5;
  }
  

  
  .applicant-status[data-status="Interview"] .applicant-status__cards.ui-sortable  {
    background-color: #f7faff;

  }


  .applicant-status[data-status="Sélectionné"] .applicant-status__cards.ui-sortable   {
    background-color: #f6fffb;
  }
  


  .applicant-status[data-status="Disqualifié"] .applicant-status__cards.ui-sortable  {
    background-color: #fffafa;


  }
  
  .applicant-card__media .media-left {

    background-color: #dddddd;
}


@media (min-width: 992px) {
    .modal-xl {
        width: 90%;
    }
}


.application-details__title {
    font-size: 20px;
    color: var(--primary-color);
    text-transform: uppercase;
    font-weight: 600;
    font-family: 'Open Sans';
}
.details-header {
    background-color: var(--primary-color);
}




.application-details__modal select {
    color: #2563eb;
    background-color: #ffffff;
    border: 1px solid #e1e1e1;
    border-radius: 10px;
    -webkit-border-radius: 10px;
    margin-left: 0;
    padding-right: 10px;
    padding-left: 10px;
    width: 100%;
    height: 46px;
    font-size: 14px;
}
.application-details__right-item__file:before , .profile__info-list__item-email a:before , .application-details__right-item__notes:before {
   display: none;
}

label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 500;
    color: #898989;
}

.application-details__right-item a.btn, .application-details__right-item__notes {
    color: var(--primary-color);
    font-size: 14px;
    padding: 9px 5px 13px 9px;
}

.btn.btn__blue.update-notes { background: #ee810c;}

.btn.btn-orange {
    background: #ee810c;
    border: 1px solid #ee810c!important;
    border-radius: 10px!important;
    color: #fff;
}
.btn.btn__orange { margin-bottom: 10px;}

.btn__blue {
    background: #0055d9;
    border-color: #0055d9;
    color: #fff;
}

.modal-dialog .modal-header {
    border-bottom: none;
    position: absolute;
    z-index: 999;
    right: 5px;
    width: 40px;
    height: 40px;
    background: #fff;
    border-radius: 50%;
    top: 5px;
}

.modal-dialog button.close {




    top: 11px;

    right: -5px;
}


.application-details__right-item--change-statut {
    background: #e8ecef;
    padding: 20px;
    margin-bottom: 10px;
    border-radius: 10px;
}
#pagination-container{
    display:flex;
    align-items:center;
    justify-content:space-between;
}
#pagination-container-bottom{
    display:flex;
    align-items:center;
    justify-content:space-between;
}



.pagination {
    display: block;
    padding-left: 0;
    margin: 20px 0;
    border-radius: 4px;
    width: 100%;
}

@media (max-width: 767px) {
    .pagination .btn.btn-secondary {

       margin-bottom: 15px;
    }
    .pagination a {
        margin-bottom: 15px!important;
    }
    
    .btn-export-pdf {
      
        padding: 0px;
    }
    .btn-export-pdf {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

/* When button is hidden by PHP condition */
.filters-actions:not(:has(#export-pdf-current)) .btn-export-pdf-all {
    /* The "all" button takes full width when "current page" is hidden */
    flex: 1;
}

/* Optional: Add a tooltip explaining why button is hidden */
.btn-export-pdf[style*="display: none"]::after {
    content: " (Tous les CVs sont sur cette page)";
    font-size: 0.9em;
    opacity: 0.8;
}
.export-error-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 99999;
    background: #f8d7da;
    color: #721c24;
    padding: 15px 20px;
    border-radius: 5px;
    border: 1px solid #f5c6cb;
    max-width: 400px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    animation: slideInRight 0.3s ease-out;
}

.export-error-notification.hide {
    animation: slideOutRight 0.3s ease-out;
    animation-fill-mode: forwards;
}

.export-error-notification .close-btn {
    background: none;
    border: none;
    color: #721c24;
    font-size: 20px;
    cursor: pointer;
    margin-left: 15px;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}

}
    </style>
{/javascript}
<div id="exportErrorContainer"></div>
<div class="filters-container">
    <div class="filters-header">
        <div class="filters-title">
            <i class="fas fa-filter"></i>
            Filtres et Tri
        </div>
        <div class="filters-actions">
    {if $totalPages > 1}
        <button id="export-pdf-current" class="btn btn-secondary btn-export-pdf" 
                onclick="exportFilteredPDF('current_page')">
            <i class="fas fa-download"></i>
            Exporter les CVs de la page {$currentPage}
        </button>
    {/if}
    
    <button class="btn btn-secondary btn-export-pdf-all" onclick="exportFilteredPDF('all_pages')">
        <i class="fas fa-download"></i>
        {if $totalPages > 1}
            Exporter tous les CVs
        {else}
            Exporter les CVs
        {/if}
    </button>
    
    <button class="btn btn-secondary btn-export-list" onclick="exportFilteredData(event)">
        <i class="fas fa-file-csv"></i>
        Exporter Liste
    </button>
</div>
    </div>
    <div class="filters-content">
        <div class="filters-row">
            <div class="filter-group">
                <label class="filter-label"><i class="fas fa-search"></i> Rechercher un candidat</label>
                <input type="text" class="filter-input" id="search-filter" placeholder="Nom, email ou mots-clés...">
            </div>
            
            <div class="filter-group">
                <label class="filter-label"><i class="fas fa-calendar"></i> Date de candidature</label>
                    <div class="date-range">
                        <select class="filter-input" id="date-month-filter" >
                        <option value="">Mois</option>
                        <option value="1">Janvier</option>
                        <option value="2">Février</option>
                        <option value="3">Mars</option>
                        <option value="4">Avril</option>
                        <option value="5">Mai</option>
                        <option value="6">Juin</option>
                        <option value="7">Juillet</option>
                        <option value="8">Août</option>
                        <option value="9">Septembre</option>
                        <option value="10">Octobre</option>
                        <option value="11">Novembre</option>
                        <option value="12">Décembre</option>
                    </select>
                    <select class="filter-input" id="date-year-filter">
                        <option value="">Année</option>
                        {* On affiche directement le HTML des options généré par PHP *}
                        {$year_options_html}
                    </select>
                </div>
            </div>
        </div>        
        <button class="toggle-advanced" onclick="toggleAdvanced()">
            <i class="fas fa-chevron-down chevron"></i>
            Filtres avancés
        </button>

        <div class="advanced-filters" id="advancedFilters">
		
            <div class="filters-row">
                <div class="filter-group">
                    <label class="filter-label"><i class="fas fa-envelope"></i> Email du candidat</label>
                    <input type="text" class="filter-input" id="email-filter" placeholder="@exemple.com">
                </div>
                <div class="filter-group">
                    <label class="filter-label"><i class="fas fa-map-marker-alt"></i> Gouvernorat</label>
                    <select class="filter-input" id="gouvernorat-filter">
                        <option value="">Tous les gouvernorats</option>
                        {foreach from=$gouvernorats item=gouvernorat}
                            <option value="{$gouvernorat.sid|escape}">{$gouvernorat.name|escape}</option>
                        {/foreach}
                    </select>
                </div>
<div class="filter-group">
    <label class="filter-label"><i class="fas fa-map-pin"></i> Ville</label>
    <select class="filter-input" id="ville-filter" disabled>
        <option value="">Sélectionnez un gouvernorat</option>
        
        {foreach from=$villes item=ville}
            <option value="{$ville.sid|escape}" data-gouvernorat="{$ville.gouvernorat_sid|escape}">
                {$ville.name|escape}
            </option>
        {/foreach}
		<option value="autre">Autre</option>
    </select>
</div>
            </div>
            <div class="filters-row">
               
				<div class="filter-group">
                <label class="filter-label"><i class="fas fa-tag"></i> Statut de candidature</label>
                <select class="filter-input" id="status-filter">
                    <option value="">Tous les statuts</option>
                    {foreach from=$statuses key="status" item=count}
                        <option value="{$status|escape}">{$status|escape}</option>
                    {/foreach}
                </select>
            </div>

                <div class="filter-group">
                    <label class="filter-label"><i class="fas fa-eye"></i> Statut de consultation</label>
                    <select class="filter-input" id="viewed-filter">
                        <option value="">Toutes les candidatures</option>
                        <option value="viewed">Consultées</option>
                        <option value="unviewed">Non consultées</option>
                    </select>
                </div>

                <div class="filter-group">
        <label class="filter-label"><i class="fas fa-file-signature"></i> Type de Contrat</label>
        <select class="filter-input" id="contract-type-filter">
            <option value="">Tout type</option>
            {foreach from=$contract_types item=option}
                <option value="{$option.name|escape}">{$option.name|escape}</option>
            {/foreach}
        </select>
    </div>
            </div>
            <div class="filters-row">
            <hr>
            </div>

            <div class="filters-row">
            <div class="filter-group">
            <label class="filter-label"><i class="fas fa-briefcase"></i> Expérience</label>
            <!-- MODIFICATION CLÉ : Remplacement du select statique par une boucle dynamique -->
            <select class="filter-input" id="experience-filter">
                <option value="">Toute expérience</option>
                {foreach from=$experience_options item=option}
                    <option value="{$option.id|escape}">{$option.name|escape}</option>
                {/foreach}
            </select>
        </div>
            <div class="filter-group">
            <label class="filter-label"><i class="fas fa-graduation-cap"></i> Niveau d'étude</label>
            <select class="filter-input" id="study-filter">
                <option value="">Tous les niveaux</option>
                {foreach from=$study_options item=option}
                    <option value="{$option.id|escape}">{$option.name|escape}</option>
                {/foreach}
            </select>
        </div>
                <div class="filter-group">
                    <label class="filter-label"><i class="fas fa-language"></i> Langue parlée</label>
                    <select class="filter-input" id="language-filter">
                        <option value="">Toutes les langues</option>
                        {foreach from=$language_options item=option}
                            <option value="{$option.id|escape}">{$option.name|escape}</option>
                        {/foreach}
                    </select>
                </div>
               
            </div>
            <div class="filters-row">
    
    <div class="filter-group">
        <label class="filter-label"><i class="fas fa-building"></i> Secteur d'Activité</label>
        <select class="filter-input" id="job-category-filter">
            <option value="">Tout secteur</option>
            {foreach from=$job_categories item=option}
                <option value="{$option.sid|escape}">{$option.name|escape}</option>
            {/foreach}
        </select>
    </div>
    <div class="filter-group">
        <label class="filter-label"><i class="fas fa-venus-mars"></i> Genre</label>
        <select class="filter-input" id="gender-filter">
            <option value="">Indifférent</option>
            <option value="1021">Féminin</option>
            <option value="1022">Masculin</option>
        </select>
    </div>
</div>
<div class="filters-row">
<hr>
</div>
<!-- NOUVELLE LIGNE POUR LES LIENS -->
<div class="filters-row">
<div class="filter-group">
<label class="filter-label"><i class="fab fa-linkedin"></i> Profil LinkedIn</label>
<select class="filter-input" id="linkedin-filter">
    <option value="">Tous</option>
    <option value="1">Avec LinkedIn</option>
    <option value="0">Sans LinkedIn</option>
</select>
</div>

    <div class="filter-group">
        <label class="filter-label"><i class="fab fa-facebook"></i> Avec Facebook</label>
        <select class="filter-input" id="has-facebook-filter">
            <option value="">Indifférent</option>
            <option value="1">Oui</option>
        </select>
    </div>
    <div class="filter-group">
        <label class="filter-label"><i class="fab fa-instagram"></i> Avec Instagram</label>
        <select class="filter-input" id="has-instagram-filter">
            <option value="">Indifférent</option>
            <option value="1">Oui</option>
        </select>
    </div>
    <div class="filter-group">
        <label class="filter-label"><i class="fab fa-github"></i> Avec GitHub</label>
        <select class="filter-input" id="has-github-filter">
            <option value="">Indifférent</option>
            <option value="1">Oui</option>
        </select>
    </div>

    <div class="filter-group">
        <label class="filter-label"><i class="fas fa-blog"></i> Avec Blog</label>
        <select class="filter-input" id="has-blog-filter">
            <option value="">Indifférent</option>
            <option value="1">Oui</option>
        </select>
    </div>
    <div class="filter-group">
        <label class="filter-label"><i class="fas fa-globe"></i> Avec Site Web</label>
        <select class="filter-input" id="has-website-filter">
            <option value="">Indifférent</option>
            <option value="1">Oui</option>
        </select>
    </div>
    <div class="filter-group">
        <label class="filter-label"><i class="fab fa-twitter"></i> Avec Twitter</label>
        <select class="filter-input" id="has-twitter-filter">
            <option value="">Indifférent</option>
            <option value="1">Oui</option>
        </select>
    </div>
</div>
        </div>
        <div class="filters-footer" style="padding-top: var(--spacing-5); border-top: 1px solid var(--gray-200); display: flex; justify-content: flex-end; gap: var(--spacing-3);">
            <button class="btn btn-secondary" onclick="resetAllFilters()">
                <i class="fas fa-undo"></i>
                Réinitialiser
            </button>
			<button class="btn btn-primary" onclick="applyFilters()">
                <i class="fas fa-search"></i>
                Rechercher
            </button>
            
        </div>
    </div>
    <div class="results-summary">
        <i class="fas fa-info-circle"></i>
        <span id="results-count">Affichage de {$applications|@count} candidatures</span>
    </div>
</div>

<div class="link-footer">

    <!--<a href="{$GLOBALS.site_url}/my-listings/job/" class="btn__back view-applicants-back retour">Retour</a>-->

   <div id="pagination-container">  {* New container for dynamic updates *}
        {if $totalPages > 1}  {* Delete the !$filters_applied condition here *}
        <div class="pagination" style="margin-top: var(--spacing-6); text-align: center; font-family: var(--font-family);" data-pagination="top">
            {if $currentPage > 1}
                <a href="?page={$currentPage-1|escape}{if $appJobId}&appJobId={$appJobId|escape:'url'}{/if}" class="btn btn-secondary">
                    <i class="fas fa-chevron-left"></i> Précédent
                </a>
            {/if}
            {assign var="maxPagesToShow" value=5}
            {assign var="startPage" value=$currentPage - 2}
            {if $startPage < 1}
                {assign var="startPage" value=1}
            {/if}
            {assign var="endPage" value=$startPage + $maxPagesToShow - 1}
            {if $endPage > $totalPages}
                {assign var="endPage" value=$totalPages}
                {assign var="startPage" value=max(1, $totalPages - $maxPagesToShow + 1)}
            {/if}

            {if $startPage > 1}
                <a href="?page=1{if $appJobId}&appJobId={$appJobId|escape:'url'}{/if}" style="padding: var(--spacing-2) var(--spacing-3); background: var(--gray-100); border: 1px solid var(--gray-300); border-radius: var(--radius-md); margin: 0 var(--spacing-1); text-decoration: none; color: var(--gray-700); font-size: var(--font-size-sm); font-weight: 500;">
                    1
                </a>
                {if $startPage > 2}
                    <span style="padding: var(--spacing-2) var(--spacing-3); color: var(--gray-700); margin: 0 var(--spacing-1); font-size: var(--font-size-sm); font-weight: 500;">...</span>
                {/if}
            {/if}

            {section name=page start=$startPage loop=$endPage+1}
                {assign var="page" value=$smarty.section.page.index}
                {if $page == $currentPage}
                    <span style="padding: var(--spacing-2) var(--spacing-3); background: var(--primary-color); color: #ffffff; border-radius: var(--radius-md); margin: 0 var(--spacing-1); font-size: var(--font-size-sm); font-weight: 500;">
                        {$page|escape}
                    </span>
                {else}
                    <a href="?page={$page|escape}{if $appJobId}&appJobId={$appJobId|escape:'url'}{/if}" style="padding: var(--spacing-2) var(--spacing-3); background: var(--gray-100); border: 1px solid var(--gray-300); border-radius: var(--radius-md); margin: 0 var(--spacing-1); text-decoration: none; color: var(--gray-700); font-size: var(--font-size-sm); font-weight: 500;">
                        {$page|escape}
                    </a>
                {/if}
            {/section}

            {if $endPage < $totalPages}
                {if $endPage < $totalPages - 1}
                    <span style="padding: var(--spacing-2) var(--spacing-3); color: var(--gray-700); margin: 0 var(--spacing-1); font-size: var(--font-size-sm); font-weight: 500;">...</span>
                {/if}
                <a href="?page={$totalPages|escape}{if $appJobId}&appJobId={$appJobId|escape:'url'}{/if}" style="padding: var(--spacing-2) var(--spacing-3); background: var(--gray-100); border: 1px solid var(--gray-300); border-radius: var(--radius-md); margin: 0 var(--spacing-1); text-decoration: none; color: var(--gray-700); font-size: var(--font-size-sm); font-weight: 500;">
                    {$totalPages|escape}
                </a>
            {/if}

            {if $currentPage < $totalPages}
                <a href="?page={$currentPage+1|escape}{if $appJobId}&appJobId={$appJobId|escape:'url'}{/if}" class="btn btn-secondary">
                    Suivant <i class="fas fa-chevron-right"></i>
                </a>
            {/if}
        </div>
        {/if}
    </div>
</div>




<div class="applicants" id="applicants-container">
    {foreach from=$statuses key="status" item=count}
        <div class="applicant-status" data-status="{$status|escape}">
            <div class="applicant-status__header">
                <h4>{$status} <span class="count">({$count})</span></h4>
            </div>
            <div class="applicant-status__cards">
                {foreach item=application from=$applications}
                    {if $application.status == $status}
                        <div class="applicant-card" data-app="{$application.id|escape}" {if $application.resume}data-resume="{$application.resume|escape}"{/if}>
                            <article id="application-{$application.id}" class="media well">
                                <div class="applicant-card__media">
                                   
                                    <div style="display:flex">
                                    {if $application.resumeInfo.Photo.file_url}
                                        <div class="media-left profile__img" style="background-image: url('{$application.resumeInfo.Photo.file_url}');"></div>
                                    {else}
                                        <div class="media-left profile__img" style="background-image: url('{$GLOBALS.site_url}/templates/Jobsquare/assets/images/sansphoto.jpg');"></div>
                                    {/if}
                                    <div class="media-body">
                                        <div class="media-heading listing-item__title">
                                            <span class="app-track-link">
                                                {if $application.resume}
                                                    {if $application.resumeInfo}
                                                        <a href="{$GLOBALS.site_url}{$application.resumeInfo|listing_url}">
                                                            {if $application.username}
                                                                {$application.username|escape}
                                                            {else}
                                                                {$application.resumeInfo.Title}
                                                            {/if}
                                                        </a>
                                                    {else}
                                                        Not Available Anymore
                                                    {/if}
                                                {else}
                                                    <a href="?appsID={$application.id}&filename={$application.file|escape:'url'}">{if $application.username}{$application.username|escape}{else}{$application.file}{/if}</a>
                                                {/if}
                                            </span>
                                        </div>
                                        <div class="listing-item__date">{$application.date|date}</div>
                                        {if $application.deja_vu==1}
                                        <div class="media-right text-right" >
                                            {if $application.date_last_vu !="0000-00-00"}<div class="dejavu">vu le: {$application.date_last_vu|date}</div>{/if}
                                        </div>
                                    {/if}
                                    </div>
                                    </div>
                                </div>
                                <div class="applicant-card__comment" >
                                    <span class="small">{$application.notes|escape}</span>
                                </div>
                            </article>
                        </div>
                        {javascript}
                            <div class="modal fade application-details__modal modal-{$application.id}" data-id="{$application.id}" tabindex="-1" role="dialog" aria-labelledby="message-modal-label">
                                <div class="modal-dialog modal-lg modal-xl" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
       
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <div class="details-header">
                                                {if $application.resumeInfo.Photo.file_url}
                                                    <div class="details-header__left">
                                                        <div class="job-seeker__image">
                                                            <div class="profile__image" style="background-image: url('{$application.resumeInfo.Photo.file_url}');" title="{$application.resumeInfo.user.FullName|escape}"></div>
                                                        </div>
                                                    </div>
                                                {else}
                                                    <div class="details-header__left">
                                                        <div class="job-seeker__image">
                                                            <div class="profile__image" style="background-image: url('{$GLOBALS.site_url}/templates/Jobsquare/assets/images/sansphoto.jpg');" title="{$application.resumeInfo.user.FullName|escape}"></div>
                                                        </div>
                                                    </div>
                                                {/if}
                                                <div class="details-header__right">
                                                    <h1 class="details-header__title">
                                                        {if $application.resume}
                                                            {if $application.resumeInfo}
                                                                {if $application.username}
                                                                    {$application.username|escape}
                                                                {else}
                                                                    {$application.resumeInfo.Title}
                                                                {/if}
                                                            {else}
                                                                Not Available Anymore
                                                            {/if}
                                                        {else}
                                                            {$application.username|escape}
                                                        {/if}
                                                    </h1>
                                                    <ul class="listing-item__info clearfix">
                                                        {if $application.email}
                                                            <li class="listing-item__info--item listing-item__info--item-email">
                                                            <i class="fas fa-envelope"></i> <a href="mailto:{$application.email|escape}">
                                                                    {$application.email|escape}
                                                                </a>
                                                            </li>
                                                        {/if}
                                                        {if $application.resumeInfo && $application.resumeInfo.Phone}
                                                            <li class="listing-item__info--item listing-item__info--item-phone">
                                                            <i class="fas fa-phone"></i> <a href="tel:{$application.resumeInfo.Phone}">{$application.resumeInfo.Phone}</a>
                                                            </li>
                                                        {/if}
                                                        {if $application.resumeInfo && $application.resumeInfo.OtherPhone}
                                                            <li class="listing-item__info--item listing-item__info--item-phone">
                                                            <i class="fas fa-phone"></i> <a href="tel:{$application.resumeInfo.OtherPhone}">{$application.resumeInfo.OtherPhone}</a>
                                                            </li>
                                                        {/if}
                                                        <li class="listing-item__info--item listing-item__info--item-datex">
                                                        <i class="fas fa-calendar"></i> {$application.date|date}
                                                    </li>
                                                    </ul>
                                                  
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="details-content">
                                                {if $application.comments != '' || $application.resumeInfo}
                                                    <div class="col-sm-8">
                                                        {if $application.comments != ''}
                                                            <h2 class="application-details__title">Lettre de Motivation</h2>
                                                            <div class="application-details__cover-letter">{$application.comments|escape}</div>
                                                        {/if}
                                                        {if $application.resumeInfo}
                                                            <div>
                                                                <h2 class="application-details__title">CV en ligne</h2>
                                                                <div class="application-details__resume">
                                                                </div>
                                                            </div>
                                                        {/if}
                                                    </div>
                                                {/if}
                                                <div class="{if $application.comments != '' || $application.resumeInfo}col-sm-4{else}col-sm-6{/if}">
                                                    <div class="application-details__right">

                                                    <div class="application-details__right-item application-details__right-item--change-statut">
                                                    <label>Changer le statut de la candidature</label>
                                                        <select>
                                                         
                                                            {foreach from=$statuses key='s' item='c'}
                                                                <option value="{$s|escape}" {if $application.status == $s}selected="selected"{/if}>{$s|escape}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                        {if $application.file}
                                                            <div class="application-details__right-item application-details__right-item--file">
                                                                <a class="btn listings-application-info--item application-details__right-item__file link btn-orange " style="color:#fff"  href="?appsID={$application.id}&filename={$application.file|escape:'url'}"><i class="fas fa-download"></i> Télécharger CV </a>
                                                            </div>
                                                        {elseif $application.resumeInfo.Resume.file_url}
                                                            <div class="application-details__right-item application-details__right-item--file">
                                                                <a class="btn listings-application-info--item application-details__right-item__file link" href="?filename={$application.resumeInfo.Resume.saved_file_name|escape:'url'}&listing_id={$application.resumeInfo.id}"><i class="fas fa-download"></i> Télécharger CV Jobsquare en PDF</a>
                                                            </div>
                                                        {/if}
                                                        {if $application.user.li_profile_url}
                                                            <div class="application-details__right-item application-details__right-item--linkedin">
                                                                <a class="btn listings-application-info--item application-details__right-item__linkedin link" target="_blank" href="{$application.user.li_profile_url}">Profil LinkedIn </a>
                                                            </div>
                                                        {/if}
                                                        {if $application.email}
                                                            <div class="application-details__right-item profile__info-list__item profile__info-list__item-email">
                                                                <a href="mailto:{$application.email|escape}" class="btn application-details__contact application-details__right-item__contact">
                                                                <i class="fas fa-envelope"></i> Contactez  {if $application.resume}
                                                                {if $application.resumeInfo}
                                                                    {if $application.username}
                                                                        {$application.username|escape}
                                                                    {else}
                                                                        {$application.resumeInfo.Title}
                                                                    {/if}
                                                                {else}
                                                                    Not Available Anymore
                                                                {/if}
                                                            {else}
                                                                {$application.username|escape}
                                                            {/if}
                                                                </a>
                                                            </div>
                                                        {/if}
                                                        <div class="application-details__right-item application-details__right-item-notes">
                                                            <div class="application-details__right-item__notes"><i class="fas fa-flag"></i> Notes</div>
                                                            <textarea name="notes">{$application.notes|escape}</textarea>
                                                            <br>
                                                            <div class="note-alert-container" style="margin-bottom: 15px;"></div>
                                                            <button type="button" class="btn clear clearfix primary-button pull-right update-notes"><i class="fa-save fas"></i> Enregister</button><br><span>&nbsp;</span><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {/javascript}
                    {/if}
                {/foreach}
            </div>
        </div>
    {/foreach}
</div>
<div class="link-footer">

    <!--<a href="{$GLOBALS.site_url}/my-listings/job/" class="btn__back view-applicants-back retour">Retour</a>-->

    <div id="pagination-container-bottom">  {* New container for dynamic updates *}
        {if $totalPages > 1}  {* Delete the !$filters_applied condition here *}
        <div class="pagination" style="margin-top: var(--spacing-6); text-align: center; font-family: var(--font-family);" data-pagination="top">
            {if $currentPage > 1}
                <a href="?page={$currentPage-1|escape}{if $appJobId}&appJobId={$appJobId|escape:'url'}{/if}" class="btn btn-secondary">
                    <i class="fas fa-chevron-left"></i> Précédent
                </a>
            {/if}
            {assign var="maxPagesToShow" value=5}
            {assign var="startPage" value=$currentPage - 2}
            {if $startPage < 1}
                {assign var="startPage" value=1}
            {/if}
            {assign var="endPage" value=$startPage + $maxPagesToShow - 1}
            {if $endPage > $totalPages}
                {assign var="endPage" value=$totalPages}
                {assign var="startPage" value=max(1, $totalPages - $maxPagesToShow + 1)}
            {/if}

            {if $startPage > 1}
                <a href="?page=1{if $appJobId}&appJobId={$appJobId|escape:'url'}{/if}" style="padding: var(--spacing-2) var(--spacing-3); background: var(--gray-100); border: 1px solid var(--gray-300); border-radius: var(--radius-md); margin: 0 var(--spacing-1); text-decoration: none; color: var(--gray-700); font-size: var(--font-size-sm); font-weight: 500;">
                    1
                </a>
                {if $startPage > 2}
                    <span style="padding: var(--spacing-2) var(--spacing-3); color: var(--gray-700); margin: 0 var(--spacing-1); font-size: var(--font-size-sm); font-weight: 500;">...</span>
                {/if}
            {/if}

            {section name=page start=$startPage loop=$endPage+1}
                {assign var="page" value=$smarty.section.page.index}
                {if $page == $currentPage}
                    <span style="padding: var(--spacing-2) var(--spacing-3); background: var(--primary-color); color: #ffffff; border-radius: var(--radius-md); margin: 0 var(--spacing-1); font-size: var(--font-size-sm); font-weight: 500;">
                        {$page|escape}
                    </span>
                {else}
                    <a href="?page={$page|escape}{if $appJobId}&appJobId={$appJobId|escape:'url'}{/if}" style="padding: var(--spacing-2) var(--spacing-3); background: var(--gray-100); border: 1px solid var(--gray-300); border-radius: var(--radius-md); margin: 0 var(--spacing-1); text-decoration: none; color: var(--gray-700); font-size: var(--font-size-sm); font-weight: 500;">
                        {$page|escape}
                    </a>
                {/if}
            {/section}

            {if $endPage < $totalPages}
                {if $endPage < $totalPages - 1}
                    <span style="padding: var(--spacing-2) var(--spacing-3); color: var(--gray-700); margin: 0 var(--spacing-1); font-size: var(--font-size-sm); font-weight: 500;">...</span>
                {/if}
                <a href="?page={$totalPages|escape}{if $appJobId}&appJobId={$appJobId|escape:'url'}{/if}" style="padding: var(--spacing-2) var(--spacing-3); background: var(--gray-100); border: 1px solid var(--gray-300); border-radius: var(--radius-md); margin: 0 var(--spacing-1); text-decoration: none; color: var(--gray-700); font-size: var(--font-size-sm); font-weight: 500;">
                    {$totalPages|escape}
                </a>
            {/if}

            {if $currentPage < $totalPages}
                <a href="?page={$currentPage+1|escape}{if $appJobId}&appJobId={$appJobId|escape:'url'}{/if}" class="btn btn-secondary">
                    Suivant <i class="fas fa-chevron-right"></i>
                </a>
            {/if}
        </div>
        {/if}
    </div>
</div>

{javascript}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ismobilejs/0.4.1/isMobile.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    const appJobId = '{$appJobId|escape:'javascript'}';
    const baseUrl = '{$GLOBALS.site_url|escape:'javascript'}';

    var filters = {
        page: 1,
        per_page: 50,  // Match your default $appsPerPage from PHP
        search: '',
        status: '',
        date_month: '',
        date_year: '',
        email: '',
        gouvernorat: '',
        ville: '',
        experience: '',
        viewed: '',
        linkedin: '',
        language: '',
        study: '',
        contract_type: '',
        job_category: '',
        gender: '',
        has_facebook: '',
        has_instagram: '',
        has_twitter: '',
        has_github: '',
        has_blog: '',
        has_website: '',
        appJobId: appJobId || ''
    };

    function changePage(newPage) {
        filters.page = newPage;
        applyFilters(false);  // false to not reset page to 1
    }

    function generatePaginationHTML(response) {
        if (response.total_pages <= 1) {
            return ''; // Hide pagination if only 1 page
        }

        var html = '<div class="pagination" style="margin-top: var(--spacing-6); text-align: center; font-family: var(--font-family);" data-pagination="top">';

        var appJobIdParam = filters.appJobId ? '&appJobId=' + encodeURIComponent(filters.appJobId) : '';

        // Previous button
        if (response.current_page > 1) {
            html += '<a onclick="changePage(' + (response.current_page - 1) + '); return false;" class="btn btn-secondary">' +
                    '<i class="fas fa-chevron-left"></i> Précédent</a>';
        }

        // Calculate page range
        var maxPagesToShow = 5; // Show up to 5 page numbers at a time
        var startPage = response.current_page - 2; // Start 2 pages before current
        if (startPage < 1) startPage = 1; // Don't go below page 1
        var endPage = startPage + maxPagesToShow - 1; // End after maxPagesToShow pages
        if (endPage > response.total_pages) {
            endPage = response.total_pages; // Don't exceed total pages
            startPage = Math.max(1, response.total_pages - maxPagesToShow + 1); // Adjust start if needed
        }

        // Show first page and ellipsis if needed
        if (startPage > 1) {
            html += '<a onclick="changePage(1); return false;" style="padding: var(--spacing-2) var(--spacing-3); background: var(--gray-100); border: 1px solid var(--gray-300); border-radius: var(--radius-md); margin: 0 var(--spacing-1); text-decoration: none; color: var(--gray-700); font-size: var(--font-size-sm); font-weight: 500;">1</a>';
            if (startPage > 2) {
                html += '<span style="padding: var(--spacing-2) var(--spacing-3); color: var(--gray-700); margin: 0 var(--spacing-1); font-size: var(--font-size-sm); font-weight: 500;">...</span>';
            }
        }

        // Show page numbers in range
        for (var page = startPage; page <= endPage; page++) {
            if (page === response.current_page) {
                html += '<span style="padding: var(--spacing-2) var(--spacing-3); background: var(--primary-color); color: #ffffff; border-radius: var(--radius-md); margin: 0 var(--spacing-1); font-size: var(--font-size-sm); font-weight: 500;">' + page + '</span>';
            } else {
                html += '<a onclick="changePage(' + page + '); return false;" style="padding: var(--spacing-2) var(--spacing-3); background: var(--gray-100); border: 1px solid var(--gray-300); border-radius: var(--radius-md); margin: 0 var(--spacing-1); text-decoration: none; color: var(--gray-700); font-size: var(--font-size-sm); font-weight: 500;">' + page + '</a>';
            }
        }

        // Show last page and ellipsis if needed
        if (endPage < response.total_pages) {
            if (endPage < response.total_pages - 1) {
                html += '<span style="padding: var(--spacing-2) var(--spacing-3); color: var(--gray-700); margin: 0 var(--spacing-1); font-size: var(--font-size-sm); font-weight: 500;">...</span>';
            }
            html += '<a onclick="changePage(' + response.total_pages + '); return false;" style="padding: var(--spacing-2) var(--spacing-3); background: var(--gray-100); border: 1px solid var(--gray-300); border-radius: var(--radius-md); margin: 0 var(--spacing-1); text-decoration: none; color: var(--gray-700); font-size: var(--font-size-sm); font-weight: 500;">' + response.total_pages + '</a>';
        }

        // Next button
        if (response.current_page < response.total_pages) {
            html += '<a onclick="changePage(' + (response.current_page + 1) + '); return false;" class="btn btn-secondary">' +
                    'Suivant <i class="fas fa-chevron-right"></i></a>';
        }

        html += '</div>';
        return html;
    }

    function toggleAdvanced() {
        const advancedFilters = document.getElementById('advancedFilters');
        const chevron = document.querySelector('.chevron');
        const button = document.querySelector('.toggle-advanced');
        if (advancedFilters && chevron && button) {
            if (advancedFilters.classList.contains('show')) {
                advancedFilters.classList.remove('show');
                chevron.classList.remove('rotated');
                button.innerHTML = '<i class="fas fa-chevron-down chevron"></i> Filtres avancés';
            } else {
                advancedFilters.classList.add('show');
                chevron.classList.add('rotated');
                button.innerHTML = '<i class="fas fa-chevron-up chevron rotated"></i> Masquer les filtres avancés';
            }
        }
    }

    function resetAllFilters() {
        document.getElementById('search-filter').value = '';
        document.getElementById('status-filter').selectedIndex = 0;
        document.getElementById('date-month-filter').selectedIndex = 0;
        document.getElementById('date-year-filter').selectedIndex = 0;
        document.getElementById('email-filter').value = '';
        document.getElementById('gouvernorat-filter').selectedIndex = 0;
        document.getElementById('ville-filter').selectedIndex = 0;
        document.getElementById('experience-filter').selectedIndex = 0;
        document.getElementById('viewed-filter').selectedIndex = 0;
        document.getElementById('linkedin-filter').selectedIndex = 0;
        document.getElementById('language-filter').selectedIndex = 0;
        document.getElementById('study-filter').selectedIndex = 0;
        document.getElementById('contract-type-filter').selectedIndex = 0;
        document.getElementById('job-category-filter').selectedIndex = 0;
        document.getElementById('gender-filter').selectedIndex = 0;
        document.getElementById('has-facebook-filter').selectedIndex = 0;
        document.getElementById('has-instagram-filter').selectedIndex = 0;
        document.getElementById('has-twitter-filter').selectedIndex = 0;
        document.getElementById('has-github-filter').selectedIndex = 0;
        document.getElementById('has-blog-filter').selectedIndex = 0;
        document.getElementById('has-website-filter').selectedIndex = 0;

        document.getElementById('ville-filter').disabled = true;

        document.querySelectorAll('input[type="radio"][name="sort"]').forEach(radio => {
            radio.checked = radio.value === 'date_desc';
        });

        applyFilters(true);
    }

    function exportFilteredData(event) {
        if (event) {
            event.preventDefault();
        }

        const params = new URLSearchParams();
        params.append('export_action', 'csv');
        params.append('appJobId', appJobId);

        for (const key in filters) {
            if (filters[key] && key !== 'page' && key !== 'per_page') {
                params.append(key, filters[key]);
            }
        }

        window.location.href = baseUrl + '/system/applications/view/?' + params.toString();
    }
    
function showExportError(message) {
    // Remove existing error if any
    const existingError = document.getElementById('exportErrorContainer');
    if (existingError) {
        existingError.innerHTML = '';
    }
    
    // Create error div
    const errorDiv = document.createElement('div');
    errorDiv.className = 'export-error-notification';
    const errorId = 'exportError_' + Date.now(); // DEFINE errorId HERE
    errorDiv.id = errorId;
    
    errorDiv.innerHTML = 
        '<div style="flex: 1;">' +
            '<div style="font-weight: bold; margin-bottom: 5px; display: flex; align-items: center; gap: 8px;">' +
                '<i class="fas fa-exclamation-circle"></i>' +
                '<span>Erreur d\'Export</span>' +
            '</div>' +
            '<div>' + message + '</div>' +
        '</div>' +
        '<button class="close-btn" onclick="closeExportError(\'' + errorId + '\')">&times;</button>'; // Use errorId

    const container = document.getElementById('exportErrorContainer') || document.body;
    container.appendChild(errorDiv);
    
    // Auto-remove after 8 seconds
    setTimeout(() => {
        closeExportError(errorId); // Use errorId
    }, 8000);
}

    function closeExportError(errorId) {
    const errorDiv = document.getElementById(errorId);
    if (errorDiv) {
        errorDiv.classList.add('hide');
        setTimeout(() => {
            if (errorDiv.parentElement) {
                errorDiv.remove();
            }
        }, 300);
    }
}
document.addEventListener('DOMContentLoaded', function() {
    // Check if URL has export_error parameter
    const urlSearch = window.location.search;
    if (urlSearch.includes('export_error=')) {
        const urlParams = new URLSearchParams(urlSearch);
        const errorMsg = urlParams.get('export_error');
        if (errorMsg) {
            // Show error after a short delay
            setTimeout(() => {
                showExportError(decodeURIComponent(errorMsg));
            }, 1000);
            
            // Remove parameter from URL without reloading
            const newUrl = window.location.pathname + 
                          window.location.search.replace(/[?&]export_error=[^&]+/, '').replace(/^&/, '?') + 
                          window.location.hash;
            window.history.replaceState({}, document.title, newUrl);
        }
    }
    
    // Also check for PHP session variable (if your PHP sets it)
    // This is optional - remove if it causes issues
    try {
        if (typeof window.exportErrorFromPHP !== 'undefined') {
            setTimeout(() => {
                showExportError(window.exportErrorFromPHP);
            }, 1500);
        }
    } catch(e) {
        // Ignore errors
    }
});
    function exportFilteredPDF(downloadType = 'all_pages') {
    const params = new URLSearchParams();
    params.append('export_action', 'pdf');
    params.append('appJobId', appJobId);
    
    // Get the current page from the URL or default to 1
    const urlParams = new URLSearchParams(window.location.search);
    const currentPage = urlParams.get('page') || 1;
    
    // If trying to download current page but there's only 1 page, default to "all"
    if (downloadType === 'current_page' && {$totalPages} <= 1) {
        downloadType = 'all_pages';
    }
    
    params.append('download_type', downloadType);
    
    if (downloadType === 'current_page') {
        params.append('page', currentPage);
        params.append('per_page', 50);
    }

    for (const key in filters) {
        if (filters[key] && key !== 'page' && key !== 'per_page') {
            params.append(key, filters[key]);
        }
    }

    window.open(baseUrl + '/system/applications/view/?' + params.toString(), '_blank');
}

    function applyFilters(resetPage = true) {
        // Update global filters with current DOM values
        filters.search = document.getElementById('search-filter').value.trim();
        filters.status = document.getElementById('status-filter').value;
        filters.date_month = document.getElementById('date-month-filter').value;
        filters.date_year = document.getElementById('date-year-filter').value;
        filters.email = document.getElementById('email-filter').value.trim();
        filters.gouvernorat = document.getElementById('gouvernorat-filter').value;
        filters.ville = document.getElementById('ville-filter').value;
        filters.experience = document.getElementById('experience-filter').value;
        filters.viewed = document.getElementById('viewed-filter').value;
        filters.linkedin = document.getElementById('linkedin-filter').value;
        filters.language = document.getElementById('language-filter').value;
        filters.study = document.getElementById('study-filter').value;
        filters.contract_type = document.getElementById('contract-type-filter').value;
        filters.job_category = document.getElementById('job-category-filter').value;
        filters.gender = document.getElementById('gender-filter').value;
        filters.has_facebook = document.getElementById('has-facebook-filter').value;
        filters.has_instagram = document.getElementById('has-instagram-filter').value;
        filters.has_twitter = document.getElementById('has-twitter-filter').value;
        filters.has_github = document.getElementById('has-github-filter').value;
        filters.has_blog = document.getElementById('has-blog-filter').value;
        filters.has_website = document.getElementById('has-website-filter').value;

        if (resetPage) {
            filters.page = 1;
        }

        if (appJobId) {
            filters.appJobId = appJobId;
        }

        document.querySelector('.filters-container').classList.add('loading');
        const urlParams = new URLSearchParams();
        urlParams.append('action2', 'filter_applications');
        urlParams.append('appJobId', appJobId);
        const fetchUrl = baseUrl + '/system/applications/view/?' + urlParams.toString();

        fetch(fetchUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(filters)
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok: ' + response.statusText);
            return response.json();
        })
        .then(data => {
            if (data.success) {
                updateApplicationsDisplay(data.applications, data.statuses);
                document.getElementById('results-count').textContent = 'Affichage de ' + data.count + ' candidatures';
                
                // Update pagination
                var paginationHTML = generatePaginationHTML(data);
                const topContainer = $('#pagination-container');
                const bottomContainer = $('#pagination-container-bottom');
                if (topContainer.length) {
                    topContainer.html(paginationHTML);
                } else {
                    console.warn('Top pagination container (#pagination-container) not found in DOM');
                }
                if (bottomContainer.length) {
            bottomContainer.html(paginationHTML);
        } else {
            console.warn('Bottom pagination container (#pagination-container-bottom) not found in DOM');
        }
            } else {
                console.error('Server error:', data.error);
                alert('Erreur lors du filtrage: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Erreur de connexion: ' + error.message);
        })
        .finally(() => {
            document.querySelector('.filters-container').classList.remove('loading');
        });
    }

    function updateApplicationsDisplay(applications, statuses) {
        const applicantsContainer = document.getElementById('applicants-container');
        if (!applicantsContainer) return;
        applicantsContainer.innerHTML = '';

        Object.keys(statuses).forEach(status => {
            const statusDiv = document.createElement('div');
            statusDiv.className = 'applicant-status';
            statusDiv.dataset.status = status;
            
            const headerDiv = document.createElement('div');
            headerDiv.className = 'applicant-status__header';
            headerDiv.innerHTML = '<h4>' + escapeHtml(status) + ' <span class="count">(' + statuses[status] + ')</span></h4>';
            
            const cardsDiv = document.createElement('div');
            cardsDiv.className = 'applicant-status__cards';
            
            const statusApplications = applications.filter(app => app.status === status);
            statusApplications.forEach(application => {
                const cardDiv = document.createElement('div');
                cardDiv.className = 'applicant-card';
                cardDiv.dataset.app = application.id;
                if (application.resume) cardDiv.dataset.resume = application.resume;
                cardDiv.dataset.experience = application.resumeInfo?.Experience || '0';
                
                const photoUrl = (application.resumeInfo && application.resumeInfo.Photo && application.resumeInfo.Photo.file_url) 
                    ? application.resumeInfo.Photo.file_url 
                    : baseUrl + '/templates/Jobsquare/assets/images/sansphoto.jpg';
                
                const dejavu = (application.deja_vu == 1 && application.date_last_vu !== "0000-00-00") 
                    ? '<div class="media-right text-right" style="float: right;"><div class="dejavu">vu le: ' + escapeHtml(application.date_last_vu) + '</div></div>' 
                    : '';
                
                const username = application.username ? escapeHtml(application.username) : (application.file ? escapeHtml(application.file) : 'Candidat');
                
                cardDiv.innerHTML = 
                    '<article id="application-' + application.id + '" class="media well">' +
                        '<div class="applicant-card__media">' +
                            dejavu +
                            '<div class="media-left profile__img" style="background-image: url(\'' + escapeHtml(photoUrl) + '\');"></div>' +
                            '<div class="media-body">' +
                                '<div class="media-heading listing-item__title">' +
                                    '<span class="app-track-link">' +
                                        (application.resume && application.resumeInfo
                                            ? '<a href="' + baseUrl + escapeHtml(application.resumeInfo.listing_url) + '">' + username + '</a>'
                                            : (application.resume 
                                                ? '<a href="?appsID=' + application.id + '&filename=' + encodeURIComponent(application.file) + '">' + username + '</a>'
                                                : 'Plus disponible')) +
                                    '</span>' +
                                '</div>' +
                                '<div class="listing-item__date">' + escapeHtml(application.date) + '</div>' +
                            '</div>' +
                        '</div>' +
                        (application.notes 
                            ? '<div class="applicant-card__comment"><span class="small">' + escapeHtml(application.notes) + '</span></div>' 
                            : '<div class="applicant-card__comment" style="display: none"><span class="small"></span></div>') +
                    '</article>';
                
                cardsDiv.appendChild(cardDiv);
            });
            
            statusDiv.appendChild(headerDiv);
            statusDiv.appendChild(cardsDiv);
            applicantsContainer.appendChild(statusDiv);
        });
        
        initializeEventHandlers();
        initializeSortableCards();
        
    }

    function escapeHtml(text) {
        const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
        return text ? text.toString().replace(/[&<>"']/g, m => map[m]) : '';
    }

    function initializeEventHandlers() {
        // Handle candidate card clicks
        $('.applicant-card').click(function (e) {
            if (!$(this).hasClass('prevent-click')) {
                e.preventDefault();
                var card = $(this);
                var modal = $('.modal-' + card.data('app'));
                var resume = card.data('resume');
                if (resume) {
                    $.get(window.SJB_UserSiteUrl + '/resume/' + resume + '/', function(data) {
                        modal.find('.application-details__resume').html(data);
                    }).fail(function() {
                    });
                }
                $.get('', {
                    'action': 'application_view',
                    'id': card.data('app')
                });
                modal.modal('show');
            }
        });

        // Handle contact button clicks
        $(document).off('click', '.application-details__contact').on('click', '.application-details__contact', function(e) {
            e.preventDefault();
            var subject = $('#contact-modal input[type="text"]').first();
            subject.val(subject.data('value'));
            $('#contact-modal input[name="id"]').val($(this).closest('.modal').data('id'));
            $('#contact-modal .modal-title').html('Contact ' + $(this).closest('.modal').find('.details-header__title').html());
            $('#contact-modal').find('.alert').hide();
            $('#contact-modal').modal('show');
        });

        // Handle update notes button clicks
        $(document).off('click', '.update-notes').on('click', '.update-notes', function() {
    var $button = $(this);
    var $modal = $button.closest('.modal');
    var id = $modal.data('id');
    var notes = $modal.find('textarea').val();
    var $alertContainer = $modal.find('.note-alert-container'); // Cible le conteneur DANS la modale

    // Efface les anciennes alertes et désactive le bouton
    $alertContainer.html('');
    $button.prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i> Enregistrement...');

    // Lancement de la requête AJAX
    $.post('', {
        'action': 'notes',
        'id': id,
        'notes': notes
    })
    .done(function(response) {
        // --- SUCCÈS ---
        // 1. Mettre à jour la carte du candidat en arrière-plan
        var $applicationCard = $('#application-' + id);
        if (notes.trim() !== '') {
            $applicationCard.find('.applicant-card__comment').show();
            $applicationCard.find('.applicant-card__comment .small').text(notes);
        } else {
            $applicationCard.find('.applicant-card__comment').hide();
        }

        // 2. Afficher l'alerte de succès
        var successAlert = '<div class="alert alert-success">Note enregistrée avec succès !</div>';
        $alertContainer.html(successAlert);
    })
    .fail(function() {
        // --- ÉCHEC ---
        // Afficher l'alerte d'erreur
        var errorAlert = '<div class="alert alert-danger">Erreur : La note n\'a pas pu être enregistrée.</div>';
        $alertContainer.html(errorAlert);
    })
    .always(function() {
        // --- TOUJOURS EXÉCUTÉ (après succès ou échec) ---
        // 1. Réactiver le bouton
        $button.prop('disabled', false).html('<i class="fa-save fas"></i> Enregistrer');

        // 2. Faire disparaître l'alerte après 4 secondes
        setTimeout(function() {
            $alertContainer.fadeOut('slow', function() {
                $(this).html('');
                $(this).show(); // Remettre le conteneur visible pour la prochaine fois
            });
        }, 4000);
    });
});
        // Handle status change dropdown
        $(document).off('change', '.application-details__modal select').on('change', '.application-details__modal select', function() {
            var card = $(this).closest('.modal').data('id');
            card = $('.applicant-card[data-app="' + card + '"]');
            $('.applicant-status[data-status="' + $(this).val() + '"] .applicant-status__cards').append(card);
            
            $.get('', {
                'action': 'set_status',
                'order': card.index() + 1,
                'id': card.data('app'),
                'status': $(this).val()
            });
            
            $('.applicant-status').each(function() {
                $(this).find('.count').text('(' + $(this).find('.applicant-card').length + ')');
            });
        });

        // Handle contact form submission
        document.querySelector('#contact-modal form').addEventListener('submit', function(e) {
            e.preventDefault();
            var alertDiv = $('#contact-modal .alert');
            var submitBtn = $(this).find('[type="submit"]');
            var originalBtnText = submitBtn.html();
            submitBtn.prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i>');
            var form = $(this);
            var params = new URLSearchParams(window.location.search);
            var baseUrl = window.SJB_GlobalSiteUrl;
            $.ajax({
                url: baseUrl + '/system/applications/view/?' + params.toString(),
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#contact-modal').modal('hide');
                        alert(response.message || 'Message envoyé avec succès!');
                    } else {
                        alertDiv.show().text(response.error || 'Erreur lors de l\'envoi du message.');
                    }
                },
                error: function(xhr, status, error) {
                    alertDiv.show().text('Erreur de connexion. Veuillez réessayer. ' + error);
                },
                complete: function() {
                    submitBtn.prop('disabled', false).html(originalBtnText);
                }
            });
        });
    }

    function initializeSortableCards() {
        if (!isMobile.any) {
            $('.applicant-status__cards').sortable({
                connectWith: $('.applicant-status__cards').not($(this)),
                items: '> .applicant-card',
                placeholder: 'ui-state-highlight',
                tolerance: 'pointer',
                start: function(e, ui) {
                    $(this).find('.applicant-card').addClass('prevent-click');
                },
                stop: function(e, ui) {
                    var status = $(ui.item).closest('.applicant-status').data('status');
                    var id = $(ui.item).data('app');
                    
                    $.get('', {
                        'action': 'set_status',
                        'order': $(ui.item).index() + 1,
                        'id': id,
                        'status': status
                    });
                    
                    $('.modal-' + id).find('.details-header select').val(status);
                    $('.applicant-status').each(function() {
                        $(this).find('.count').text('(' + $(this).find('.applicant-card').length + ')');
                    });
                    
                    setTimeout(function(){
                        $('.applicant-card').removeClass('prevent-click');
                    }, 100);
                }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        
        const gouvernoratFilter = document.getElementById('gouvernorat-filter');
        const villeFilter = document.getElementById('ville-filter');
        
        // Store cities with gouvernorat relationship
        const allVilles = Array.from(villeFilter.querySelectorAll('option')).map(opt => ({
            value: opt.value,
            text: opt.textContent,
            gouvernoratId: opt.getAttribute('data-gouvernorat')
        }));

        gouvernoratFilter.addEventListener('change', function() {
            const selectedGouvernoratId = this.value;
            villeFilter.innerHTML = '';
            
            if (selectedGouvernoratId) {
                villeFilter.disabled = false;
                // Add default options
                villeFilter.appendChild(new Option("Toutes les villes", ""));
                
                // Add cities for selected gouvernorat
                allVilles.forEach(ville => {
                    if (ville.gouvernoratId === selectedGouvernoratId) {
                        const option = new Option(ville.text, ville.value);
                        option.setAttribute('data-gouvernorat', ville.gouvernoratId);
                        villeFilter.appendChild(option);
                    }
                });
            } else {
                villeFilter.disabled = true;
                villeFilter.appendChild(new Option("Sélectionnez un gouvernorat", ""));
            }
            villeFilter.appendChild(new Option("Autre", "autre"));
        });
        
        var yearSelect = document.getElementById('date-year-filter');
        if (yearSelect) {
            var currentYear = String(new Date().getFullYear());
            yearSelect.value = currentYear;

            if (yearSelect.value !== currentYear) {
                for (var i = 0; i < yearSelect.options.length; i++) {
                    if (yearSelect.options[i].value === currentYear) {
                        yearSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        }
        
        // Initialize event handlers on page load
        initializeEventHandlers();
        initializeSortableCards();
    });
    </script>
{/javascript}

{if $errors}
    {foreach from=$errors key=error_code item=error_message}
        {if $error_code == 'NO_SUCH_FILE'} <p class="alert alert-danger">Aucun fichier trouvé dans le système</p>
        {elseif $error_code == 'NO_SUCH_APPS'} <p class="alert alert-danger">Aucune candidature avec cet ID</p>
        {elseif $error_code == 'APPLICATIONS_NOT_FOUND'}
            {if $current_filter}
                <p class="alert alert-danger">{tr}Il n'y a pas de candidatures pour "$listing_title"{/tr|escape}</p>
            {else}
                <p class="alert alert-danger">Vous n'avez pas encore de candidatures.</p>
            {/if}
        {/if}
    {/foreach}
{/if}


{* Modale de contact *}
{javascript}
    <div class="modal fade contact-modal" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="contact-modal-label">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="position: relative; width: 100%">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal" method="post">
                    <div class="alert alert-danger" style="display: none;">
                        Oops. Something went wrong. Please contact website administrator to resolve the issue.
                    </div>
                    <input type="hidden" name="contact_action" value="contact">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="name" class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="5" placeholder="Tapez votre message ici..."></textarea>
                    </div>
                    <div class="form-group form-group__btns text-center">
                        <button type="button" class="btn btn__white" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-envelope"></i> Envoyer
                        </button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    <script>
      $('.application-details__contact').click(function(e) {
    e.preventDefault();
    $('#contact-modal input[name="id"]').val($(this).closest('.modal').data('id'));
    $('#contact-modal .modal-title').html('Contact ' + $(this).closest('.modal').find('.details-header__title').html());
    $('#contact-modal').find('.alert').hide();
    $('.contact-modal').modal('show');
});









    

$('#contact-modal').on('hidden.bs.modal', function () {
    setTimeout(function () {
        $('body').addClass('modal-open');
    }, 500);
});
        $('.update-notes').click(function() {
            var notes = $(this).closest('div').find('textarea').val();
            $.post('', {
                'action': 'notes',
                'id': $(this).closest('.modal').data('id'),
                'notes': notes
            });
            var id = $(this).closest('.modal').data('id');
            if (notes != '') {
                $('#application-' + id).find('.applicant-card__comment').show();
                $('#application-' + id).find('.applicant-card__comment .small').text(notes);
            } else {
                $('#application-' + id).find('.applicant-card__comment').hide();
            }
        });

        if (!isMobile.any) {
            $('.applicant-status__cards').sortable({
                connectWith: $('.applicant-status__cards').not($(this)),
                items: '> .applicant-card',
                placeholder: 'ui-state-highlight',
                tolerance: 'pointer',
                start: function(e, ui) {
                    $(this).find('.applicant-card').addClass('prevent-click');
                },
                stop: function(e, ui) {
                    var status = $(ui.item).closest('.applicant-status').data('status');
                    var id = $(ui.item).data('app');
                    $.get('', {
                        'action': 'set_status',
                        'order': $(ui.item).index() + 1,
                        'id': id,
                        'status': status
                    });
                    $('.modal-' + id).find('.details-header select').val(status);
                    $('.applicant-status').each(function() {
                        $(this).find('.count').text('(' + $(this).find('.applicant-card').length + ')');
                    });
                    setTimeout(function(){
                        $('.applicant-card').removeClass('prevent-click');
                    }, 100)
                }
            });
        }

        $('.application-details__modal select').change(function() {
            var card = $(this).closest('.modal').data('id');
            card = $('.applicant-card[data-app="' + card + '"]');
            $('.applicant-status[data-status="' + $(this).val() + '"] .applicant-status__cards').append(card);
            $.get('', {
                'action': 'set_status',
                'order': card.index() + 1,
                'id': card.data('app'),
                'status': $(this).val()
            });
            $('.applicant-status').each(function() {
                $(this).find('.count').text('(' + $(this).find('.applicant-card').length + ')');
            });
        });

        $('.applicant-card').click(function (e) {
            if (!$(this).hasClass('prevent-click')) {
                e.preventDefault();
                var card = $(this);
                var modal = $('.modal-' + card.data('app'));
                var resume = card.data('resume');
                if (resume) {
                    $.get(window.SJB_UserSiteUrl + '/resume/' + resume + '/', function(data) {
                        modal.find('.application-details__resume').html(data);
                    }).fail(function() {
                    });
                }
                $.get('', {
                    'action': 'application_view',
                    'id': card.data('app')
                });
                modal.modal('show');
            }
        });

        $(document).ready(function() {
            $('.nav-pills').scrollLeft($('.nav-pills').width() / 2);
        });
    </script>
{/javascript}
