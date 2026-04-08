<?php

/**
 * SJB_WYSIWYGEditorProvider - wrapper for using different
 * WYSIWYG editor with the same interface
 */
class SJB_WYSIWYGEditorProvider
{
    var $editor;
    var $editorsInfo;

    /**
     * Set the specific editor type from available editors list
     * or set default editor
     */
    public function __construct($type)
    {
        $this->editorsInfo = new SJB_WYSIWYGEditorsInfo();
        if (array_key_exists($type, $fullEditorsInfo = $this->editorsInfo->getAvailableEditorsFullInfo())) {
            $this->editor = new $fullEditorsInfo[$type]['class_name'];
        } else {
            $defaultEditor = $this->editorsInfo->getDefaultEditor();
            $this->editor = new $defaultEditor;
        }
    }

    /**
     * return HTML code due to specific editor type and
     * function parameters
     */
    function getEditorHTML($name, $content = '', $height = 200, $width = '100%', $conf = null, $params = null)
    {
        return $this->editor->getHTML($name, $content, $height, $width, $conf, $params);
    }
}


class SJB_WYSIWYGEditorsInfo
{

    var $defaultEditor;
    var $availableEditors;

    function getAvailableEditorsList()
    {
        $result = array();
        foreach ($this->availableEditors as $type => $editor)
            $result[$type] = $editor['name'];
        return $result;
    }

    function getDefaultEditor()
    {
        return $this->defaultEditor;
    }

    function getAvailableEditorsFullInfo()
    {
        return $this->availableEditors;
    }

    public function __construct()
    {
        $this->defaultEditor = 'SJB_TinymceWrapper';
        $this->availableEditors = array(
            'tinymce' => array(
                'name' => 'Tinymce',
                'class_name' => 'SJB_TinymceWrapper'
            ),
            'none' => array(
                'name' => 'Simple TextArea',
                'class_name' => 'SJB_textareaWrapper'
            ),
        );
    }

}


/**
 * Parent class for different WYSWYG Editors
 */
class SJB_WYSIWYGWrapper
{
    var $editorDir; //Directory with editor package files

    public function __construct()
    {
        $this->editorDir = SJB_System::getSystemSettings('EXTERNAL_COMPONENTS_DIR');
    }

    function setEditorPath($relativeEditorPath)
    {
        $this->editorDir .= $relativeEditorPath;
    }

}


/**
 * Type of WYSIWYG editor, displays simple textarea
 * with specific name and content from function arguments
 */
class SJB_textareaWrapper
{
    function getHTML($name, $content, $height, $width, $conf = null, $params = null)
    {
        if (strpos($width, '%') === false && strpos($width, 'px') === false)
            $width .= 'px';
        if (strpos($height, '%') === false && strpos($height, 'px') === false)
            $height .= 'px';
        $class = !empty($params['class']) ? $params['class'] : '';
        return "<textarea name='{$name}' style='width:{$width}; height:{$height}' class='{$class}'>"
        . $content . "</textarea>";
    }
}

class SJB_TinymceWrapper extends SJB_WYSIWYGWrapper
{
    private static $included = false;

    function getHTML($name, $content, $height, $width, $conf = null)
    {
        if (strpos($width, '%') === false && strpos($width, 'px') === false)
            $width .= 'px';
        if (strpos($height, '%') === false && strpos($height, 'px') === false)
            $height .= 'px';


        $settings = ', menubar: false, relative_urls: false, convert_urls: false, browser_spellcheck: true';
        switch ($conf) {
            case 'Admin':
                $settings .= ",plugins: ['autolink link media paste code table imagetools textcolor']";
                $settings .= ",toolbar: 'formatselect | bold italic underline | alignment | forecolor | link image2 media | numlist bullist outdent indent | table code'";
                $settings .= ",setup: function(editor) { editor.addButton('alignment', { type: 'listbox', icon: 'alignleft', tooltip: 'Align', onselect: function(e) { tinyMCE.execCommand(this.value()); }, values: [ {icon: 'alignleft', value: 'JustifyLeft'}, {icon: 'alignright', value: 'JustifyRight'}, {icon: 'aligncenter', value: 'JustifyCenter'}, {icon: 'alignjustify', value: 'JustifyFull'}, ], onPostRender: function() { this.value('JustifyLeft'); } }); }";
                $settings .= ",extended_valid_elements: '*[*]'";
                $settings .= ",valid_children : '+body[style]'";
                $settings .= ",external_plugins: {'image2':  window.SJB_UserSiteUrl + '/system/ext/tinymce/plugins/image/plugin.js'}";
                break;
            case 'Basic':
            default:
                $settings .= ",plugins: ['autolink link paste']";
                $settings .= ",toolbar: 'bold italic underline link numlist bullist outdent indent alignleft aligncenter alignright alignjustify'";
                $settings .= ",valid_elements: 'br,p[*],span[*],ol[*],ul[*],li[*],em[*],a[*],strong[*]'";
                break;
        }

        $include = '';
        if (!self::$included) {
            self::$included = true;
            $include = '<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.4.3/tinymce.min.js"></script>';
            $include .= "<script>var tinyconfig = { selector: 'textarea', height:'{$height}', width:'{$width}' {$settings}, content_css: window.SJB_UserSiteUrl + '/system/ext/tinymce/themes/advanced/skins/default/content.css' };</script>";
        }
        SJB_TemplateProcessor::_tpl_javascript('', $include . "<script>tinymce.init({content_css: window.SJB_UserSiteUrl + '/system/ext/tinymce/themes/advanced/skins/default/content.css', selector: '[name=\"{$name}\"]', height:'{$height}', width:'{$width}' {$settings} });</script>");
        $class = !empty($params['class']) ? $params['class'] : '';
        return "<textarea id='{$name}' name='{$name}' class='{$class}'>$content</textarea>";
    }
}

