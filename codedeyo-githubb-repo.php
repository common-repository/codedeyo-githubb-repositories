<?php
/*
Plugin Name: Codedeyo GitHubb Repositories 
Plugin URI: https://wordpress.org/plugins/codedeyo-githubb-repo/
Version: 1.00
Description: Showcase user repositories with a shortcode.
Author: Adeleye Ayodeji
Author URI: http://adeleyeayodeji.com/
Text Domain: codedeyo-githubb-repo
Domain Path: /languages
*/

//Adding settings link
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'githubbrepolink');
function githubbrepolink( $links ) {
  $links[] = '<a href="' .
    admin_url( 'admin.php?page=codedeyo-githubb-repo' ) .
    '">' . __('Go to Settings') . '</a>';
  return $links;
}

 add_action( 'admin_init', 'gitupdateusersettings' );

   if( !function_exists("gitupdateusersettings") ) { 
    function gitupdateusersettings() {  
     register_setting( 'git-user-settings-codedeyo', 'gituser_username' ); 
    }
     }

//Adding js and css script to wordpress
  function codedeyo_githubb_repo_style(){
      //wp_enqueue_script( 'codedeyo-js', plugin_dir_url( __FILE__ ).'assets/js/core2.js' );
     wp_enqueue_style( 'codedeyo-style', plugin_dir_url( __FILE__ ).'assets/css/git-style.css' );
      
  }
  function load_codedeyo_js(){
   echo "<script src='".plugin_dir_url( __FILE__ ).'assets/js/core2.js'."'></script>";
  }
  add_action('admin_enqueue_scripts', 'codedeyo_githubb_repo_style');
  add_action( 'wp_footer', 'load_codedeyo_js', 100);

	// adding to the menu
	function codedeyo_githubb_repo_menu(){
		add_menu_page(
      'Codedeyo GitHubb Repositories', // $page_title
      'Codedeyo GitHubb Repositories', // $menu_title
      'manage_options', //  $capability
      'codedeyo-githubb-repo', // $menu_slug
      'codedeyo_githubb_repo_page', // $function
      plugin_dir_url( __FILE__ ) . 'assets/loader/icon.png', // Plugin $icon_url
      200 // Plugin $position
    );
	}
	add_action('admin_menu', 'codedeyo_githubb_repo_menu');

	function codedeyo_githubb_repo_page(){
		?>
<div class="wrap">
    <div class="mainrepo2">
        <center>
            <h2 class="githeaderr"><img src="<?php echo plugin_dir_url( __FILE__ ).'assets/'; ?>loader/icon.png"
                    height="17px"> Codedeyo GitHubb Repositories</h2>
            <small>Use this shortcode<code>[githubb-repo]</code></small>
            <small>Developed by <a href="https://adeleyeayodeji.com" target="_blank">Adeleye Ayodeji</a></small>
        </center>
        <div class="githeader">
            <span>
                <img id="gitpic">
                <code class="codestyle">
                    <small id="githead"></small>
                </code>
            </span>
            <span class="repotitle">
                <h3 class="titlegit">
                    :: popular repositories
                </h3>
            </span>
        </div>
        <div class="mainrepo">
            <ol id='gitcontent'>
                <center id="imageload">
                    <img src="<?php echo plugin_dir_url( __FILE__ ).'assets/'; ?>loader/loader.gif" height="50px">
                    <p id="errorlog"></p>
                </center>
            </ol>
        </div>
    </div>

    <form method="post" action="options.php">
        <?php settings_fields( 'git-user-settings-codedeyo' ); ?>
        <?php do_settings_sections( 'git-user-settings-codedeyo' ); ?>
        <p>
            Enter GitHubb Username: <input id="gitbasevalue" type="text" name="gituser_username"
                value="<?php echo str_replace(' ', '',get_option( 'gituser_username' )); ?>"
                placeholder="e.g adeleyeayodeji">
        </p>
        <?php submit_button(); ?>
    </form>
</div>
<?php
    echo "<script src='".plugin_dir_url( __FILE__ ).'assets/js/core2.js'."'></script>";
	}



  //Adding shortcode
  function codedeyo_githubb_repo_function(){
      wp_enqueue_style( 'codedeyo-style', plugin_dir_url( __FILE__ ).'assets/css/git-style.css' );
    $codedeyo = "<div class='wrap'>"; 
    ?>
<div class="mainrepo2">
    <input type="hidden" id="gitbasevalue" value="<?php echo str_replace(' ', '',get_option( 'gituser_username' )); ?>">
    <div class="githeader">
        <span>
            <img id="gitpic">
            <code class="codestyle">
                <small id="githead"></small>
            </code>
        </span>
        <span class="repotitle">
            <code class="titlegit">
                <small>
                    Developed by <a href="https://adeleyeayodeji.com" target="_blank">Adeleye Ayodeji</a>
                </small>
            </code>
        </span>
    </div>
    <div class="mainrepo">
        <ol id='gitcontent'>
            <center id="imageload">
                <img src="<?php echo plugin_dir_url( __FILE__ ).'assets/'; ?>loader/loader.gif" height="50px">
            </center>
        </ol>
    </div>
</div>
<?php $codedeyo .= "</div>";
    return $codedeyo;
  }

  add_shortcode('githubb-repo','codedeyo_githubb_repo_function');
?>