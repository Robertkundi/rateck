<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;
class Bascart_Logo extends Widget_Base {


  public $base;

    public function get_name() {
        return 'logo';
    }

    public function get_title() {

        return esc_html__( 'Site Logo', 'bascart' );

    }

    public function get_icon() { 
        return 'eicon-image';
    }

    public function get_categories() {
        return [ 'bascart-elements' ];
    }

    protected function register_controls() {

      $this->start_controls_section(
         'section_tab',
         [
               'label' => esc_html__('Logo settings', 'bascart'),
         ]
      );

	    $this->add_control(
            'site_logo',
            [
                'label' => esc_html__('Logo', 'bascart'),
                'type' => Controls_Manager::MEDIA,
              
            ]
        );
    
        $this->add_responsive_control(
            'logo_size_width',
            [
                'label' => esc_html__('Logo Width', 'bascart'),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bascart-widget-logo img' => 'max-width: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_align', [
                'label'          => esc_html__( 'Alignment', 'bascart' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
    
                    'left'         => [
                        'title'    => esc_html__( 'Left', 'bascart' ),
                        'icon'     => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title'    => esc_html__( 'Center', 'bascart' ),
                        'icon'     => 'fa fa-align-center',
                    ],
                    'right'         => [
                        'title'     => esc_html__( 'Right', 'bascart' ),
                        'icon'     => 'fa fa-align-right',
                    ],
                ],
               'default'         => '',
               'selectors' => [
                   '{{WRAPPER}} .bascart-widget-logo' => 'text-align: {{VALUE}};'
               ],
            ]
        );
 

        $this->add_responsive_control(
			'logo_padding',
			[
				'label' =>esc_html__( 'Padding', 'bascart' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bascart-widget-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
      );
       
        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings_for_display();


        $tpl = get_widget_template($this->get_name());
        include $tpl;
    }
    protected function content_template() { }
}
