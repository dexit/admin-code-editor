<?php

class Admin_Code_Editor_General

{
    private static $DEFAULT_ONLY_DISPLAY_WHEN 			= array('inside-the-loop', 'in-main-query');
    private static $DEFAULT_HIDE_ON_TEMPLATES 			= array();
    private static $DEFAULT_HIDE_CODE_EDITOR_TYPES 	= array();
    private static $DEFAULT_ACTIVE_ADMIN_TAB 				= 'html-edit';
    private static $ALLOWABLE_DISABLED_TEMPLATES 		= array('front-page', 'home', 'archives', 'search-results');
    private static $ALLOWABLE_ACTIVE_TAB_IDS 				= array('html-edit', 'css-edit', 'js-edit' );

    private $post_id, $disabled_templates, $only_display_in_main_query, $only_display_in_loop, $hide_code_editor_types, $active_admin_tab;

    function __construct($post_id) {

	    $this->post_id = $post_id;

    }


    public function updateDataFromPOST() {

    	// update disabled templates
			if (isset($_POST['wp-ace-disabled-templates'])) {
				$temp_disabled_templates = $_POST['wp-ace-disabled-templates'];
				if (is_array($temp_disabled_templates) {
					$invalid_template_found = 0;
					foreach ($temp_disabled_templates as &$temp_disabled_template) {
					  if (!in_array($temp_disabled_template, $ALLOWABLE_DISABLED_TEMPLATES)) {
					  	$invalid_template_found = 1;
					  	break;
					  }
					}
					if ($invalid_template_found) {
						$this->disabled_templates = array();
					} else {
						$this->disabled_templates = $temp_disabled_templates;
					}
				} else {
					$this->disabled_templates = array();
				}
				
				update_post_meta($this->post_id, '_wp_ace_disabled_templates', $this->disabled_templates );
			} else {
				$this->disabled_templates = array();
				update_post_meta($this->post_id, '_wp_ace_disabled_templates', array() );
			}

			// update 'only display in loop' status
 			if (isset($_POST['wp-ace-only-display-in-loop'])) {
				$this->only_display_in_loop = true;
				update_post_meta($this->post_id, '_wp_ace_display_only_in_loop', 1 );
			}	else {
				$this->only_display_in_loop = false;
				update_post_meta($this->post_id, '_wp_ace_display_only_in_loop', 0 );
			}

			// update 'only display in main query' status
			if (isset($_POST['wp-ace-only-display-in-main-query'])) {
				$this->only_display_in_main_query = $_POST['wp-ace-only-display-in-main-query'];
				update_post_meta($this->post_id, '_wp_ace_display_only_in_main_query', 1);
			} else {
				$this->only_display_in_main_query = false;
				update_post_meta($this->post_id, '_wp_ace_display_only_in_main_query', 0);
			}

			// update 'last active tab' status
			if (in_array($_POST['wp-ace-last-active-tab'], $ALLOWABLE_ACTIVE_TAB_IDS )) {
				update_post_meta($this->post_id, '_wp_ace_last_active_tab', $_POST['wp-ace-last-active-tab'] );
			} else {
				update_post_meta($this->post_id, '_wp_ace_last_active_tab', $DEFAULT_ACTIVE_ADMIN_TAB );
			}
			
    }

    public function getDisabledTemplates() {
    	$this->disabled_templates;
			if ($this->disabled_templates === null) {
				$this->disabled_templates = get_post_meta($this->post_id, '_wp_ace_disabled_templates', true);
				if ($this->disabled_templates == '') {
					$temp = get_option('wp_ace_default_disabled_template', self::$DEFAULT_HIDE_ON_TEMPLATES);
					$this->disabled_templates = get_option('wp_ace_default_disabled_template', self::$DEFAULT_HIDE_ON_TEMPLATES);
				}
			} 
			$this->disabled_templates;
			return $this->disabled_templates;

    }

    public function homeTemplateIsDisabled() {
    	$this->getDisabledTemplates();
    	return in_array('home', $this->disabled_templates);
    }

    public function frontPageTemplateIsDisabled() {
    	$this->getDisabledTemplates();
    	return in_array('front-page', $this->disabled_templates);    	
    }

    public function searchTemplateIsDisabled() {
    	$this->getDisabledTemplates();
    	return in_array('search-results', $this->disabled_templates);    	
    }

    public function archiveTemplateIsDisabled() {
    	$this->getDisabledTemplates();
    	return in_array('archives', $this->disabled_templates);    	
    }

    public function getOnlyDisplayInLoopStatus() {

			if ($this->only_display_in_loop == null) {
				$this->only_display_in_loop = get_post_meta($this->post_id, '_wp_ace_display_only_in_loop', true);
				if ($this->only_display_in_loop == '') {
					$conditional_display = get_option('wp_ace_default_conditional_display', self::$DEFAULT_ONLY_DISPLAY_WHEN);

					if (!empty($conditional_display) && in_array('inside-the-loop', $conditional_display) ) {
						$this->only_display_in_loop = true;
						return true;
					} else {
						return false;
					}
					
				}
			}
			
			if (empty($this->only_display_in_loop)) {
				return false;
			} else {
				return true; 
			}
			

    }

    public function getOnlyDisplayInMainQueryStatus() {

			if ($this->only_display_in_main_query === null) {
				$this->only_display_in_main_query = get_post_meta($this->post_id, '_wp_ace_display_only_in_main_query', true);
				if ($this->only_display_in_main_query == '') {
					$conditional_display = get_option('wp_ace_default_conditional_display', self::$DEFAULT_ONLY_DISPLAY_WHEN);
					if (!empty($conditional_display) && in_array('in-main-query', $conditional_display) ) {

						$this->only_display_in_main_query = true;
						return true;
					} else {
						return false;
					}
				}
			}
			
			if (empty($this->only_display_in_main_query)) {
				$this->only_display_in_main_query;
				return false;
			} else {
				$this->only_display_in_main_query;
				return true; 
			}
			
    }

    public function getHiddenCodeEditorTypes() {

			if (empty($this->hide_code_editor_types)) {
				$this->hide_code_editor_types = get_option('wp_ace_default_disabled_code', self::$DEFAULT_HIDE_CODE_EDITOR_TYPES );
			} else {
				return false;
			}
			
			return $this->hide_code_editor_types;

    }

    public function htmlEditorIsDisabled() {
    	$this->getHiddenCodeEditorTypes();
    	if (empty($this->hide_code_editor_types)) {
    		return false;
    	} else {
    		return in_array('html', $this->hide_code_editor_types); 
    	}
    	
    }

    public function cssEditorIsDisabled() {
    	$this->getHiddenCodeEditorTypes();
    	
    	if (empty($this->hide_code_editor_types)) {
    		return false;
    	} else {
    		return in_array('css', $this->hide_code_editor_types);
    	}
    }

    public function jsEditorIsDisabled() {
    	$this->getHiddenCodeEditorTypes();
    	
    	if (empty($this->hide_code_editor_types)) {
    		return false;
    	} else {
    		return in_array('js', $this->hide_code_editor_types);
    	} 
    }

    public function getActiveAdminTab() {

			if (empty($this->active_admin_tab)) {
				$this->active_admin_tab = get_post_meta($this->post_id, '_wp_ace_last_active_tab', true);
				if (empty($this->active_admin_tab)) {
					$this->active_admin_tab = self::$DEFAULT_ACTIVE_ADMIN_TAB;
				}
			} 
			
			return $this->active_admin_tab;

    }

    private function inAllowableDisabledTemplates($templates) {

    }

}

?>