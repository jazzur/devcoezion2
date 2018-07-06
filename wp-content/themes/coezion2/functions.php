<?php
    add_action('after_setup_theme' ,'coezion2_custom_logo');
    function coezion2_custom_logo() {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        if ( has_custom_logo() ) {
            return esc_url( $logo[0] );
        } else {
            echo "There is no logo in the admin panel";
        }
    }
    
    add_theme_support('menus');
    
    add_action('wp_enqueue_scripts', 'coezion_insert_css_in_head');
    function coezion_insert_css_in_head() {
        wp_register_style('style', get_bloginfo( 'stylesheet_url' ),'',false,'screen');
        wp_enqueue_style( 'style' );
    }
    
    function register_my_menus() {
        register_nav_menus( array(
            'Top' => __( 'Menu Top' ),
            'footer-menu' => __( 'Menu Footer' )
        ));
    }
    add_action( 'init', 'register_my_menus' );
    
    
    
    function monprefixe_session_start() {
        if ( ! session_id() ) {
            @session_start();
        }
    }
    add_action( 'init', 'monprefixe_session_start', 1 );
    
    function theme_multipages_scripts() {
        wp_deregister_script( 'jquery' );
        wp_enqueue_script( 'jquery','https://code.jquery.com/jquery-1.9.1.min.js');
        wp_enqueue_script( 'jquery','https://code.jquery.com/jquery-1.12.4.min.js');
        wp_enqueue_script( 'jquery','https://code.jquery.com/ui/1.12.1/jquery-ui.js');
        wp_enqueue_script( 'bootstrapjs','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',array('jquery'), false, false);
        wp_enqueue_style( 'bootstrapcss', get_template_directory_uri() . '/css/bootstrap.css' );
        wp_enqueue_style( 'jqueryuicss', get_template_directory_uri() . '/css/jquery-ui.css' );
        
        wp_enqueue_script( 'tablesorter', get_template_directory_uri() . '/js/tablesorter.js', array('jquery'), false, false );
        wp_enqueue_script( 'tablesorterPager', get_template_directory_uri() . '/js/tablesorterPager.js', array('jquery'), false, false );
        wp_enqueue_script( 'announce', get_template_directory_uri() . '/js/annonce.js', array('jquery'), false, false );
        wp_enqueue_script( 'autocomplete_departement', get_template_directory_uri() . '/js/autocomplete_departement.js', array('jquery'), false, false );
        wp_enqueue_script( 'jquery-ui_auto', get_template_directory_uri() . '/js/jquery-ui_auto.js', array('jquery'), false, false );
        
        require_once( get_stylesheet_directory() .'/fonctionCRM.php');
        require_once( get_stylesheet_directory() .'/fonctionmin.php');
        
    }
    add_action( 'wp_enqueue_scripts', 'theme_multipages_scripts' );
    
    add_filter('wp_mail_from_name', 'new_mail_from_name');
    function new_mail_from_name() { return 'COEZION !!!'; }
    
    
    add_action( 'wp_enqueue_scripts', 'my_enqueue' );
    function my_enqueue($hook) {
        //if( 'index.php' != $hook ) { return; }
    
        //wp_enqueue_script( 'ajax-script', plugins_url( 'assets/js/script.js', __FILE__ ), array('jquery') );
        wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), false, false );
        wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'exple_variable' => 1234 ) );
    }
    
    add_action( 'wp_ajax_set_user', 'set_user_coordonees' );
    add_action( 'wp_ajax_nopriv_set_user', 'set_user_coordonees' );
    function set_user_coordonees(){
        if ( isset( $_POST ) ) {
            $array = [];
            // Ajout des données manquantes
            $array["Id"] = $_SESSION["id"];
            $array["Announces"] = $_SESSION["annonce"];
            $array["CVFileName"] = $_SESSION["cv"];
            $array["AvatarFileName"] = $_SESSION["avatar"];
            $array["AvatarEncodedBase64FileContent"] = $_SESSION["avatarcode"];
            $data = array_merge($array, $_POST);

            $ch = curl_init('http://api.infolor.fr/api/CRM/SaveCandidate');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            $resultOfSave = curl_exec($ch);
        
            // Mise à jour des variables sessions
            $_SESSION['mail'] = $_POST['Email'];
            $_SESSION['nom'] = $_POST['LastName'];
            $_SESSION['prenom'] = $_POST['FirstName'];
            $_SESSION['addresse'] = $_POST['Address'];
            $_SESSION['salaire'] = $_POST['WantedSalary'];
            $_SESSION['expe'] = $_POST['ExperienceYears'];
            $_SESSION['cp'] = $_POST['PostalCode'];
            $_SESSION['ville'] = $_POST['City'];
            $_SESSION['competence'] = $_POST['Competencies'];
            $_SESSION['civil'] = $_POST['Civility'];
            $_SESSION['dispo'] = $_POST['Disponibility'];
            //$_SESSION['annonce'] = $_POST['Announces'];
            $_SESSION['mdp'] = $_POST['Password'];
            //$_SESSION['cv'] = $_POST['CVFileName'];
            //$_SESSION['avatar'] = $_POST['AvatarFileName'];
            //$_SESSION['avatarcode'] = $_POST['AvatarEncodedBase64FileContent'];
            $_SESSION['mobile'] =  $_POST['Mobile'];
            
            // reponse
            wp_send_json($resultOfSave);
        } else  {
            wp_send_json_error( 'Erreur de sauvegarde' );
        }
        wp_die();
    }
    
    add_action( 'wp_ajax_set_user_avatar', 'set_user_avatar_file' );
    add_action( 'wp_ajax_nopriv_set_user_avatar', 'set_user_avatar_file' );
    function set_user_avatar_file(){
print_r("OKOKOK");
wp_die();
        if ( isset( $_POST ) ) {
            $array = [];
            // Ajout des données manquantes
            $array["Id"] = $_SESSION["id"];
            $array["Announces"] = $_SESSION["annonce"];
            $array["CVFileName"] = $_SESSION["cv"];
            $array['Email'] = $_SESSION['mail'];
            $array['LastName'] = $_SESSION['nom'];
            $array['FirstName'] = $_SESSION['prenom'];
            $array['Address'] = $_SESSION['addresse'];
            $array['WantedSalary'] = $_SESSION['salaire'];
            $array['ExperienceYears'] = $_SESSION['expe'];
            $array['PostalCode'] = $_SESSION['cp'];
            $array['City'] = $_SESSION['ville'];
            $array['Competencies'] = $_SESSION['competence'];
            $array['Civility'] = $_SESSION['civil'];
            $array['Disponibility'] = $_SESSION['dispo'];
            $array['Password'] = $_SESSION['mdp'];
            $array['Mobile'] = $_SESSION['mobile'];
            $data = array_merge($array, $_POST);

            $ch = curl_init('http://api.infolor.fr/api/CRM/SaveCandidate');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            $resultOfSave = curl_exec($ch);
        
            // Mise à jour des variables sessions
            $_SESSION['avatar'] = $_POST['AvatarFileName'];
            $_SESSION['avatarcode'] = $_POST['AvatarEncodedBase64FileContent'];
            
            
            // reponse
            wp_send_json($resultOfSave);
        } else  {
            wp_send_json_error( 'Erreur de sauvegarde' );
        }
        wp_die();
    }
?>