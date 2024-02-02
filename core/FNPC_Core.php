<?php

class FNPC_Core
{
	/**
	 * Plugin Version
	 * @var string
	 */
	private $version;
	/**
	 * Page that metaBox must show
	 * @var array
	 */
	private array $metaBoxPages;
	private $prefix = '_FNPC_settings_';
	private $FNPC_domain = 'fn-popular-categories';
	private $FNPC_nonce = 'fn-popular-categories-nonce';

	private $slick_version = '1.8.0';
	private $bootstrap_version = '5.1.3';
	private $popper_version = '2.9.2';

	public function __construct($version = '1.0.0')
	{
		$this->version      = $version;
		$this->metaBoxPages = array('post', 'page');
		add_action('acf/include_field_types', array($this, 'FNPC_acf_include_field'));
	}

	/**
	 * add acf fields
	 * @return void
	 */
	function FNPC_acf_include_field()
	{
		include_once('acs-fields/class-fnpc-acf-field.php');
	}

	/**
	 * Run plugin Core
	 * @return void
	 */
	public function run()
	{
		/**
		 * Start plugin translation
		 */
		$this->translate();

		/**
		 * Save metabox
		 */
		add_action('save_post', array($this, 'saveMetaBox'));
		add_action('edit_post', array($this, 'saveMetaBox'));
		add_action('save_term', array($this, 'saveMetaBox'));
		add_action('edit_term', array($this, 'saveMetaBox'));

		/**
		 * Load admin/public scripts
		 */

		$this->addScripts();
	}

	/**
	 * Translate FN categories Tabs
	 * @return void
	 */
	public function translate()
	{
		add_action('plugin_loaded', function () {
			load_plugin_textdomain($this->FNPC_domain, false, basename(FNPC_PATH) . '/languages/');
		});
	}

	/**
	 * Add Admin/Public scripts and styles
	 * @return void
	 */
	public function addScripts()
	{
		/**
		 * load public script
		 */
		add_action('wp_enqueue_scripts', function () {
			if (is_singular() || is_tax()) {
				wp_enqueue_script('FNPC-public-js', FNPC_JS_PATH . 'public.js', array('jquery'), $this->version, true);
				wp_enqueue_style('FNPC-public-style', FNPC_CSS_PATH . 'public.css', array(), $this->version);
			}
		});
		/**
		 * load admin script
		 */
		add_action('admin_enqueue_scripts', function ($hook) {
			wp_enqueue_media();
			wp_register_style('bootstrap-style', FNPC_CSS_PATH . 'bootstrap.min.css', array(), $this->bootstrap_version);
			wp_register_script('bootstrap-script', FNPC_JS_PATH . 'bootstrap.min.js', array(), $this->bootstrap_version);
			wp_register_script('popper-script', FNPC_JS_PATH . 'popper.min.js', array(), $this->popper_version);
			wp_enqueue_script(
				'fn-popular-categories-script',
				FNPC_JS_PATH . 'admin.js',
				array(
					'jquery',
					'jquery-ui-core',
					'jquery-ui-sortable',
					'bootstrap-script',
					'popper-script',
				),
				$this->version,
				true
			);
			wp_enqueue_style(
				'fn-popular-categories-style',
				FNPC_CSS_PATH . 'admin.css',
				array('bootstrap-style'),
				$this->version
			);
			if (isset($_REQUEST['tag_ID'])) {
				[
					$this->prefix . 'fnpc_category_1'  => $fnpc_category_1,
					$this->prefix . 'fnpc_category_2'  => $fnpc_category_2,
					$this->prefix . 'fnpc_category_3'  => $fnpc_category_3,
					$this->prefix . 'fnpc_category_4'  => $fnpc_category_4,
					$this->prefix . 'fnpc_category_5'  => $fnpc_category_5,
					$this->prefix . 'fnpc_category_6'  => $fnpc_category_6,

				] = get_term_meta($_REQUEST['tag_ID'], $this->prefix . 'fn_popular_categories', true);
			} else {
				[
					$this->prefix . 'fnpc_category_1'  => $fnpc_category_1,
					$this->prefix . 'fnpc_category_2'  => $fnpc_category_2,
					$this->prefix . 'fnpc_category_3'  => $fnpc_category_3,
					$this->prefix . 'fnpc_category_4'  => $fnpc_category_4,
					$this->prefix . 'fnpc_category_5'  => $fnpc_category_5,
					$this->prefix . 'fnpc_category_6'  => $fnpc_category_6,
				] = get_post_meta(get_the_ID(), $this->prefix . 'fn_popular_categories', true);
			}

			if (
				$fnpc_category_1 && $fnpc_category_2 && $fnpc_category_3 && $fnpc_category_4 && $fnpc_category_5 && $fnpc_category_6
			) {
				wp_localize_script('fn-popular-categories-script', 'FNPC', array(
					'fnpc_category_1' => $fnpc_category_1,
					'fnpc_category_2' => $fnpc_category_2,
					'fnpc_category_3' => $fnpc_category_3,
					'fnpc_category_4' => $fnpc_category_4,
					'fnpc_category_5' => $fnpc_category_5,
					'fnpc_category_6' => $fnpc_category_6,
				));
			} else {
				wp_localize_script('fn-popular-categories-script', 'FNPC', array());
			}
		});
	}

	/**
	 * @param $post_id
	 *
	 * @return void
	 * [Save meta box data]
	 */
	public function saveMetaBox($post_id)
	{
		if (
			!current_user_can('edit_others_pages')
			|| !wp_verify_nonce($_POST[$this->FNPC_nonce], $post_id . get_current_user_id())
		) {
			return;
		}

		$fnpc_category_1  = $_POST['fnpc_category_1'];
		$fnpc_category_2  = $_POST['fnpc_category_2'];
		$fnpc_category_3  = $_POST['fnpc_category_3'];
		$fnpc_category_4  = $_POST['fnpc_category_4'];
		$fnpc_category_5  = $_POST['fnpc_category_5'];
		$fnpc_category_6  = $_POST['fnpc_category_6'];

		$popular_categories = array(
			$this->prefix . 'fnpc_category_1'       => $fnpc_category_1,
			$this->prefix . 'fnpc_category_2'       => $fnpc_category_2,
			$this->prefix . 'fnpc_category_3'       => $fnpc_category_3,
			$this->prefix . 'fnpc_category_4'       => $fnpc_category_4,
			$this->prefix . 'fnpc_category_5'       => $fnpc_category_5,
			$this->prefix . 'fnpc_category_6'       => $fnpc_category_6,
		);
		if (isset($_REQUEST['tag_ID'])) {
			update_term_meta($_REQUEST['tag_ID'], $this->prefix . 'fn_popular_categories', $popular_categories);
		} else {
			update_post_meta($post_id, $this->prefix . 'fn_popular_categories', $popular_categories);
		}
	}
}
