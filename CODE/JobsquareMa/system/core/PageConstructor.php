<?php

class SJB_PageConstructor
{
    /**
     * @param SJB_PageConfig $page_config
     * @return string
     */
    public static function getPage($page_config)
    {
        SJB_System::setPageTitle($page_config->getPageTitle());
        SJB_System::setGlobalTemplateVariable('user_page_uri', $page_config->getPageUri());
        SJB_System::setPageKeywords($page_config->getPageKeywords());
		$listingTypeID=false;
        SJB_System::setPageDescription($page_config->getPageDescription());
        if ($page_config->getMainContentFunction() == 'add_listing') {
            $passed_parameters_via_uri = SJB_Request::getVar('passed_parameters_via_uri', false);
            if ($passed_parameters_via_uri) {
                $passed_parameters_via_uri = SJB_UrlParamProvider::getParams();
				//----- ajouté par Ched  13-04-202 : 
					$listingTypeID = isset($passed_parameters_via_uri[0]) ? $passed_parameters_via_uri[0] :false;
                 //------------------------------
                if (isset($passed_parameters_via_uri[2])) {
					
                    $page_config->setMainContentFunction('add_listing_step');
                }
            }
        }
		//----- ajouté par Ched  13-04-202 : 
		 if ($page_config->getMainContentFunction() == 'edit_listing') {
            $passed_parameters_via_uri = SJB_Request::getVar('passed_parameters_via_uri', false);
            if ($passed_parameters_via_uri) {
                $passed_parameters_via_uri = SJB_UrlParamProvider::getParams();
				
					$listingTypeID = isset($passed_parameters_via_uri[0]) ? $passed_parameters_via_uri[0] :false;
           
                if (isset($passed_parameters_via_uri[1])) {
					$listingTypeID = "Resume";
                    $page_config->setMainContentFunction('edit_listing_step');
                }
            }
        }
		//------------------------------
        $maincontent = SJB_System::executeFunction(
            $page_config->getMainContentModule(),
            $page_config->getMainContentFunction(),
            $page_config->getParameters(),
            $page_config->getPageUri()
        );

        if ($page_config->hasRawOutput()) {
            return $maincontent;
        }

        $page_templates_set_name = SJB_System::getSystemSettings('PAGE_TEMPLATES_MODULE_NAME');
        $template_supplier = new SJB_TemplateSupplier($page_templates_set_name);

        $tp = new SJB_TemplateProcessor($template_supplier);
         //----- ajouté par Ched  13-04-202 : 
		
		$tp->assign('listingTypeID', $listingTypeID);
		 //------------------------------
        $tp->assign('MAIN_CONTENT', $maincontent);

        if (SJB_Navigator::getURI() == '/') {
            $url = SJB_H::getUserSiteUrl();
            $theme = ThemeManager::getCurrentTheme();
            if (!in_array($theme, ['_system/admin', 'Facebook'])) {
                $logo = $url . '/templates/' . $theme . '/assets/images/' . rawurlencode(ThemeManager::getThemeSettings($theme)['logo']);
                $ldjson = [
                    '@context' => 'http://schema.org',
                    '@type' => 'WebSite',
                    'url' => $url,
                    'image' => $logo,
                    'description' => SJB_Settings::getValue('home_page_description'),
                    'keywords' => SJB_Settings::getValue('home_page_keywords'),
                    'name' => SJB_Settings::getValue('site_title'),
                    'potentialAction' => [
                        '@type' => 'SearchAction',
                        'target' => $url . '/jobs/?keywords[all_words]={q}',
                        'query-input' => 'required name=q',
                    ],
                ];
                $ldjson = '<script type="application/ld+json">' . json_encode($ldjson) .  '</script>';
                $tp->_tpl_head([], $ldjson);

                $tp->_tpl_head([], sprintf('
                <meta property="og:title" content="%s"/>
                <meta property="og:site_name" content="%s"/>
                <meta property="og:type" content="website"/>
                <meta property="og:image" content="%s"/>
                <meta property="og:description" content="%s"/>
                <meta property="og:url" content="%s"/>
                '
                    ,
                    htmlspecialchars(SJB_Settings::getValue('home_page_title', SJB_Settings::getValue('site_title')), ENT_QUOTES),
                    htmlspecialchars(SJB_Settings::getValue('site_title'), ENT_QUOTES),
                    htmlspecialchars($logo, ENT_QUOTES),
                    htmlspecialchars(SJB_Settings::getValue('home_page_description'), ENT_QUOTES),
                    htmlspecialchars($url, ENT_QUOTES)
                ));
            }
        }

        $tp->registerGlobalVariables();

        $template = $page_config->getPageTemplate();
        $template_supplier->addContainerTemplate($template);

        if (SJB_Request::isAjax())
            $template = 'empty.tpl';
        else if (empty($template))
            $template = SJB_Settings::getSettingByName('DEFAULT_PAGE_TEMPLATE');

        return $tp->fetch($template);
    }
}

