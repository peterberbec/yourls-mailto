<?php
/**
Plugin Name: Mailto: quickshare
Plugin URI: http://yourls.org/
Description: Add mailto: to the list of Quick Share destinations
Version: 1.0
Author: Peter Ryan Berbec
Author URI: peter@berb.ec
**/


yourls_add_action( 'share_links', 'prb_yourls_mailto' );

function prb_yourls_mailto( $args ) {
    list( $longurl, $shorturl, $title, $text ) = $args;
    $shorturl = rawurlencode( $shorturl );
    $title = rawurlencode( htmlspecialchars_decode( $title ) );

    $prb_path = YOURLS_PLUGINURL . '/' . yourls_plugin_basename( dirname(__FILE__) );
    $prb_icon = $prb_path.'/mailto.png';

    echo <<<MAILTO

    <style type="text/css">
    #share_mt{
        background:transparent url("$prb_icon") left center no-repeat;
    }
    </style>

    <a id="share_mt"
        title="Share via mailto"
        onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,height=1024,width=768,left=100');return false;">Email
    </a>

    <script type="text/javascript">

    // Dynamically update Mailto link
    // when user clicks on the "Share" Action icon, event $('#tweet_body').keypress() is fired, so we'll add to this
      $('#tweet_body').keypress(function(){
          var mt_title = encodeURIComponent( $('#titlelink').val() );
          var mt_url = encodeURIComponent( $('#copylink').val() );
          var mt = 'mailto:?subject='+mt_title+'&body='+mt_title+'%0A'+mt_url;
          $('#share_mt').attr('href', mt);        
      });
    </script>

MAILTO;
}
