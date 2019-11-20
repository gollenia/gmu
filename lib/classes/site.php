<?php

namespace Contexis;

class Site extends \Timber\Site {
	

	private $config;


	/** Add timber support. */
	public function __construct($config) {
		$this->config = $config;
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'wp_print_styles', array( $this, 'deregister_styles' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'add_meta_boxes', array($this, 'meta_box_add') );
		parent::__construct();
		$this->add_shortcodes();
		$this->add_blocks();
		$this->add_widgets();
	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['menu'] = new \Timber\Menu();
		$context['site'] = $this;
		$context['footer_area'] = \Timber::get_widgets('footer_area');
		return $context;
	}

	public function add_shortcodes() {
		// get all shortcodes from the shortcodesfolder
		$files = scandir(__DIR__ . '/../shortcodes');
		foreach($files as $file) {
			if ("php" === substr($file, -3)) {
				require_once(__DIR__ . '/../shortcodes/' . $file);
				$shortcode = substr($file, 0, -4);
				add_shortcode( $shortcode, $shortcode . "_shortcode" );
			}
		}
	}

	public function add_blocks() {
		// get all blocks from the blocks folder
		$files = scandir(__DIR__ . '/../blocks');
		foreach($files as $file) {
			if ("php" === substr($file, -3)) {
				require_once(__DIR__ . '/../blocks/' . $file);
				
				$block = explode(".", substr($file, 0, -4))[1];
				$namespace = explode(".", substr($file, 0, -4))[0];
				add_action( 'init', function() use ($block, $namespace) {
					register_block_type( $namespace . '/' . $block, array(
						'render_callback' => $namespace . '_' . $block . '_render',
					) );
				});
			}
		}	
	}

	
	public function meta_box_add()
	{
    	add_meta_box( 'ctx_options', 'Optionen', array($this, 'meta_box_fields'), array('post', 'page'), 'side', 'high' );
	}

	public function meta_box_fields() {
		foreach($this->config['page_options'] as $option) {
			$values = get_post_custom( $post->ID );
			echo '<div class="components-base-control__field">';
			echo '<label class="components-base-control__label" for="' . $option['id'] . '">' . $option['name'] . '</label>';
			echo '<' . $option['tag'] . ' type="' . $option['type'] .'" name="ctx_options_' . $option['id'] . '" id="' . $option['id'] . '" value="" class="components-text-control__' . $option['tag'] . '"/>';
			if ("select" === $option['tag']) {
				foreach($option['items'] as $item) {
					echo '<option value="red"';
					$iset = isset( $values['ctx_options_' . $item['value']]) ? esc_attr( $values['ctx_options_' . $item['value']][0] ) : '';
					echo selected($iset, $item['value']);
					echo '>' . $item['title'] . '</option>';
				}
				echo "</select>";
			}
			echo '</div>';
		}
	}


	public function add_widgets () {
		$config = $this->config;
		add_action( 'widgets_init', function() use ($config) {
			foreach ($config['widget_areas'] as $area) {
				register_sidebar($area);	
			}
		});		
	}

	public function deregister_styles() {
		wp_dequeue_style( 'wp-block-library' );
	}

	public function theme_supports() {
		// in config.yml, add your theme support!
		foreach($this->config['theme_support'] as $theme_support) {
			if($theme_support['options']) {
				add_theme_support( $theme_support['name'], $theme_support['options'] );
			} else {
				add_theme_support( $theme_support['name'] );
			}
		}		

		add_theme_support(
			'editor-color-palette', $this->config['colors']
		);
		
	}

}