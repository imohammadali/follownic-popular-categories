<?php

class FNPC_acf_field extends acf_field
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
	private $FNPC_domain = 'fnpc-popular-categories';
	private $FNPC_nonce = 'fn-popular-categories-nonce';

	private $slick_version = '1.8.0';
	private $bootstrap_version = '5.1.3';
	private $popper_version = '2.9.2';

	public function __construct()
	{
		$this->name = 'FNPC_field';

		$this->label = __('Popular Categories', $this->FNPC_domain);

		$this->category = __('Popular Categories', $this->FNPC_domain);

		$this->defaults = array(
			'value' => true,
		);

		$this->l10n = array(
			'error' => "enter valid input"
		);

		parent::__construct();
	}

	function render_field_settings($field)
	{
		$select_options = [
			1 => __('enable', $this->FNPC_domain),
			2 => __('disable', $this->FNPC_domain)
		];
		acf_render_field_setting($field, array(
			'label'        => __('enable', $this->FNPC_domain),
			'instructions' => __('enable popular Categories', $this->FNPC_domain),
			'key'          => 'FNPC_enable',
			'type'         => 'select',
			'name'         => 'FNPC',
			'choices'      => $select_options,
			'value'        => 1
		));
	}

	function render_field($field)
	{
		$this->renderMetaBox();
	}

	/**
	 * @param WP_Post $post Current save/edit post object
	 *
	 * @return void
	 */
	public function renderMetaBox()
	{
		$fs_categories = get_terms(
			array(
				'taxonomy'   => 'service_category',
				'hide_empty' => false,
			)
		);
		include(FNPC_CORE_PATH . 'view/metabox_view.php');
	}
}

new FNPC_acf_field();
