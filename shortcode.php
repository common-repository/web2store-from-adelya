<?php

    // Security
    if(!defined('ABSPATH')){
        exit;
    }

    // Call processing page
    include('translate.php');


/***************************** START OF FUNCTION SHORTCODES *************************************/
    function w2s_shortcodeAdelya($atts){ // Function for create shortcode

        // Call translate file
        include('translate.php');

        // Call variables
		global $wpdb, $table_prefix;
        $table_name = ($wpdb->prefix).'options';


        // Recovery Result of CodeGroup value
        $resultCodeGroup = $wpdb->get_row(
            "
            SELECT option_value
            FROM $table_name
           WHERE option_name = 'AdelyaCodeGroup'
            "
        );

        // Recovery result of Server value
        $resultServer = $wpdb->get_row(
            "
            SELECT option_value
            FROM $table_name
            WHERE option_name = 'AdelyaServeur'
            "
        );

        // Recovery result of Catalog Reference
        $resultRefCatalog = $wpdb->get_row(
            "
            SELECT option_value
            FROM $table_name
            WHERE option_name = 'AdelyaRefCatalog'
            "
        );


        // Recovery of the value entered by the user in the shortcode
        $atts = shortcode_atts(array(
            'module'=>'aggregate',
            'ref' => '',
            ),
            $atts
        );


        // URL Array Web2Store
        $iframes = array(
            'aggregate'=>'/aggregate/aggregate.html?lang=',
            'login'=>'/login/login.html?lang=',
            'signup'=>'/signup/signup.html?lang=',
            'loyalty'=>'/loyalty/loyalty.html?lang=',
            'account'=>'/account/account.html?lang=',
            'histo'=>'/histo/histo.html?lang=',
            'components'=>'/components/components.html?lang=',
            'storelocator'=>'/storelocator/storelocator.html?lang=',
            'store'=>'/store/store.html?lang=',
            'catalog' =>'/catalog/Cadeaux-catalogue.html?lang=',
            'deals'=>'/deals/deals.html?lang=',
            'giftcard' =>'/giftcard/giftcard.html?lang=',
            'suscribe_newsletter' =>'composants/newsletter/subscribe.jsp?l=fr&code=',
            'unsuscribe_newsletter' =>'composants/newsletter/unsubscribe.jsp?l=fr&code=',
            'logout' =>'webtostore/components/login/process/logout.jsp?cg='
        );


        // Lang module Web2Store
        $lang = [''];

        if (get_locale() == 'fr_FR') {
            $lang = 'fr';
        }else{
            $lang = 'en';
        }


        // URL Web2Store

        if($iframes[$atts["module"]] == $iframes['catalog']){
            $url = 'https://'.$resultServer->option_value.'/Adelyaview/'.$resultCodeGroup->option_value.'/'.$atts['ref'].$iframes[$atts["module"]].$lang;
        } elseif($iframes[$atts["module"]] == $iframes['suscribe_newsletter']) {
            $url = 'https://'.$resultServer->option_value.'/Adelyaview/'.$iframes[$atts["module"]].$resultCodeGroup->option_value;
        } elseif($iframes[$atts["module"]] == $iframes['unsuscribe_newsletter']) {
            $url = 'https://'.$resultServer->option_value.'/Adelyaview/'.$iframes[$atts["module"]].$resultCodeGroup->option_value;
        } elseif($iframes[$atts["module"]] == $iframes['logout']){
            $url = 'https://'.$resultServer->option_value.'/Adelyaview/'.$iframes[$atts["module"]].$resultCodeGroup->option_value.'&lang='.$lang;
        } else {
            $url = 'https://'.$resultServer->option_value.'/Adelyaview/'.$resultCodeGroup->option_value.$iframes[$atts["module"]].$lang;
        }
        


        


        // If the shortcode exists, we send the module otherwise "error message"
        if($iframes[$atts["module"]] == false){
            echo $url;
             //return '<h2>' . $json_lang->exist . '</h2>' ;
        }else{
            if($iframes[$atts["module"]] == $iframes['suscribe_newsletter']){
                return '<input type="button" value="Abonnement" onClick="open(\'' . $url. '\',\'other\',\'top=100,left=700,width=480,height=800,status=no,scrollbars=yes\').focus();" />' ;
            }elseif($iframes[$atts["module"]] == $iframes['unsuscribe_newsletter']){
                return '<input type="button" value="Désabonnement" onClick="open(\'' . $url. '\',\'other\',\'top=100,left=700,width=480,height=800,status=no,scrollbars=yes\').focus();" />' ;
            }else{
                return '<span class="adelya"><iframe class="adelya-i" style="width:100%; border:none;" src="' . $url .'"></iframe></span><script type="text/javascript">window.onload= function(){iFrameResize({}, "iframe.adelya-i")}</script>';
            }
             
        }
    }

/***************************** END OF FUNCTION *************************************/


/***************************** START OF FUNCTION SCRIPT_RESIZE *************************************/
    function w2s_script_resize(){ //Function for resize Iframe Web2Store

        // Call variables
        global $wpdb, $table_prefix;
        $table_name = ($wpdb->prefix).'options';

        // Recovery result of Server value
         $resultServer = $wpdb->get_row(
                "
                SELECT option_value
                FROM $table_name
                WHERE option_name = 'AdelyaServeur'
                "
            );


         // Recovery result of resize value 0 = yes; 1 = no
         $resize = $wpdb->get_row(
            "
            SELECT option_value
            FROM $table_name
            WHERE option_name = 'Resize_Web2Store'
            "
        );


        // If $ajust = 0, resize Web2Store's iframe
        if ($resize->option_value == '0' ){
             wp_enqueue_script('script_resize', 'https://'.$resultServer->option_value.'/Adelyaview/webtostore/js/lib/iframeResizer/iframeResizer.min.js');
        }
    }

    // Call Function resize start
    add_action('wp_enqueue_scripts', 'w2s_script_resize');

?>