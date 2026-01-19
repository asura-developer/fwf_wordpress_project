<?php
/**
 * Plugin Name: Naroth Labels Translates with Q-translate
 * Plugin URI: #
 * Description: To replace string in one langauge or multi langauges with Q-translate X
 * Version: 1.0
 * Author: Naroth
 * Author URI: #
 */

add_action('admin_menu','create_menu_for_wai');
function create_menu_for_wai(){
    add_submenu_page(
            // parent slug
            'options-general.php',
            // page-title
            'Naroth Labels',
            // menu title 
            'Naroth Labels',
            // Capability of user level
            'administrator',
            // slug submenu
            'naroth-labels',
            // function communicate with with page
            'naroth_labels_function'
    );   
}

include('nt-listing.php');

function __nt($text){
     if(isKhmer()){
        $text = str_replace('DATE', 'ថ្ងៃ', $text);
        $text = str_replace('NATIONAL CONCRETE', 'ណេសិនណល ខនគ្រីត', $text);
        $text = str_replace('Read more', 'អានបន្ត', $text);
        $text = str_replace('read more', 'អានបន្ត', $text);
        $text = str_replace('READ', 'អាន', $text);
        $text = str_replace('Search ... ', 'ស្វែងរក ... ', $text);
        $text = str_replace('MORE PORFOLIO', 'ស្នាដៃផ្សេងទៀត', $text);

        $text = str_replace('RELATED TECHNICAL', 'បច្ចេកទេសពាក់ព័ន្ធ', $text);
        $text = str_replace('RELATED NEWS', 'ព័ត៌មានផ្សេងទៀត', $text);
        $text = str_replace('RELATED PROJECTS', 'គម្រោងផ្សេងទៀត', $text);
        
        $text = str_replace('ENQUIRY FORM', 'បែបបទស្នើសុំ', $text);
        $text = str_replace('Your name', 'ឈ្មោះ​របស់​អ្នក', $text);
        $text = str_replace('Subject', 'កម្ផវត្ថុ', $text);
        $text = str_replace('Your email', 'អ៊ីមែល​របស់​អ្នក', $text);
        $text = str_replace('Your Phone', 'ទូរស័ព្ទ​របស់​អ្នក', $text);
        $text = str_replace('Your message', 'សារ​របស់​អ្នក', $text);
        $text = str_replace('Send', 'ផ្ញើ', $text);
    
        echo $text;
     }else{
        echo $text;
     }
    
}

function isKhmer(){
    $current_url = $_SERVER['REQUEST_URI'];
    $result = explode('/kh/',$current_url);
    if(count($result)>1){
        return true;
    }else{
        return false;
    }
}


// Q translate x translate Khmer

// Khmer month replacement
function KhmerNumDate ($text) {
	
	// Number translate to Khmer
	$text = str_replace('1', '១', $text);
    $text = str_replace('2', '២', $text);
    $text = str_replace('3', '៣', $text);
    $text = str_replace('4', '៤', $text);
    $text = str_replace('5', '៥', $text);
    $text = str_replace('6', '៦', $text);
    $text = str_replace('7', '៧', $text);
    $text = str_replace('8', '៨', $text);
    $text = str_replace('9', '៩', $text);
	$text = str_replace('0', '០', $text); 
	
	// Month translate
	$text = str_replace('January', 'មករា', $text);
	$text = str_replace('February', 'កុម្ភៈ', $text);
	$text = str_replace('March', 'មីនា', $text);
	$text = str_replace('April', 'មេសា', $text);
	$text = str_replace('May', 'ឧសភា', $text);
	$text = str_replace('June', 'មិថុនា', $text);
	$text = str_replace('July', 'កក្កដា', $text);
	$text = str_replace('August', 'សីហា', $text);
	$text = str_replace('September', 'កញ្ញា', $text);
	$text = str_replace('October', 'តុលា', $text);
	$text = str_replace('November', 'វិច្ឆិកា', $text);
	$text = str_replace('December', 'ធ្នូ', $text);

	// Day translate
	$text = str_replace('Sunday', 'អាទិត្យ', $text);
	$text = str_replace('Monday', 'ច័ន្ទ', $text);
	$text = str_replace('Tuesday', 'អង្គារ', $text);
	$text = str_replace('Wednesday', 'ពុធ', $text);
	$text = str_replace('Thursday', 'ព្រហស្បតិ៍', $text);
	$text = str_replace('Friday', 'សុក្រ', $text);
	$text = str_replace('Saturday', 'សៅរ៍', $text);

    // other
    // $text = str_replace('Saturday', 'ថ្ងៃសៅរ៍', $text);

    return $text;
}

if(isKhmer()){
	add_filter('get_date', 'KhmerNumDate');
	add_filter('get_the_date', 'KhmerNumDate');
	add_filter('get_the_time', 'KhmerNumDate');
}



