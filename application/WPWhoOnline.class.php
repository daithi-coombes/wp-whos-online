<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WPWhoOnline
 *
 * @author daithi
 */
class WPWhoOnline {

	/** @var string Holds the html from the view file for parsing */
	private $html;

	/**
	 * constructor
	 */
	public function __construct() {

		//actions
		add_action('init', array(&$this, 'init'));
		add_action('wp_head', array(&$this, 'print_head'));
		add_action('admin_head', array(&$this, 'print_head'));
	}

	/**
	 * Prints the view html.
	 * 
	 * Loads the html then sets shortcodes ( @see WPWhoOnline::set_shortcodes() )
	 * then loads scripts (@see WPWhoOnline::load_scripts() ) and styles
	 * (@see WPWhoOnline::load_styles() ) then prints html
	 * @return void
	 */
	public function get_page() {

		$this->html = file_get_contents(WPWhoOnline_dir . "/public_html/WPWhoOnline.php");
		$this->set_shortcodes();

		$this->load_scripts();
		$this->load_styles();

		print $this->html;
	}

	/**
	 * Prints out html in the &lt;head>
	 */
	public function print_head() {
		
		//vars
		$nonce = wp_create_nonce("register whos online");
		
		//print out head js
		?>
		<script type="text/javascript">
			jQuery.post(ajaxurl, {
				action : 'wpwho_reg_online',
				wp_nonce : '<?= $nonce ?>'
			});
		</script>
		<?php
	}

	/**
	 * Calls methods to run when wp has loaded.
	 */
	public function wp_init() {

		$this->load_scripts();
		$this->load_styles();
	}

	/**
	 * Loads javascript files
	 * 
	 * @return void 
	 */
	private function load_scripts() {
		wp_enqueue_script();
	}

	/**
	 * Loads css files
	 * 
	 * @return void 
	 */
	private function load_styles() {
		;
	}

	/**
	 * Sets values for the shortcodes in the view file.
	 * 
	 * Replaces the codes with values in @see FSNetworkRegister::$html . To add
	 * shortcodes to the view file use the syntax:
	 * <code> <!--[--identifying string--]--> </code>. In the construct of this
	 * class add the value to the array @see FSNetworkRegister::$shortcodes.
	 * eg: $this->shortcodes['identifying string'] = $this->method_returns_html()
	 * 
	 * @return void
	 */
	private function set_shortcodes() {
		foreach ($this->shortcodes as $code => $val)
			$this->html = str_replace("<!--[--{$code}--]-->", $val, $this->html);
	}

}
?>
