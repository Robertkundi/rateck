<?php

namespace Elementor;

class ElementsKit_Extend_Parallax{
    public function __construct()
    {
        add_action('elementor/element/section/section_effects/after_section_end', array( $this, 'after_section_end' ), 10, 2);
        add_action('elementor/frontend/section/after_render', array($this, 'after_section_render'), 10, 2);
    }

    

    public function after_section_end($control, $args)
    {
        $control->start_controls_section(
            'ekit_section_parallax',
            array(
                'label' => esc_html__('Parallax Effects', 'bascart-essential'),
                'tab' => Controls_Manager::TAB_ADVANCED,
            )
        );
        $control->add_control(
            'ekit_section_parallax_bg',
            [
                'label' => esc_html__('Background Image Parallax', 'bascart-essential'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'bascart-essential'),
                'label_off' => esc_html__('Hide', 'bascart-essential'),
                'render_type' => 'none',
				'frontend_available' => true,
            ]
        );
        $control->add_control(
            'ekit_section_parallax_bg_speed', [
                'label' => esc_html__('Speed', 'bascart-essential'),
                'type' => Controls_Manager::NUMBER,
                'max' => .9,
                'min' => .1,
                'step' => .1,
                'default' => 0.5,
                'condition' => [
                    'ekit_section_parallax_bg' => 'yes',
                ]
            ]
        );

        $control->add_control(
            'ekit_section_parallax_multi',
            array(
                'label' => esc_html__('Multi Item Parallax', 'bascart-essential'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'bascart-essential'),
                'label_off' => esc_html__('Hide', 'bascart-essential'),
            )
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'parallax_style',  [
            'label' => esc_html__('Effect Type', 'bascart-essential'),
            'type' => Controls_Manager::SELECT,
            'default' => 'animation',
            'options' => [
                'animation' => esc_html__('Css Animation', 'bascart-essential'),
                'mousemove' => esc_html__('Mouse Move', 'bascart-essential'),
                'onscroll' => esc_html__('On Scroll', 'bascart-essential'),
                'tilt' => esc_html__('Parallax Tilt', 'bascart-essential'),
            ],
        ]
        );
        $repeater->add_control(
            'item_source',
            [
                'label' => esc_html__( 'Item source', 'bascart-essential' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'toggle' => false,
                'default' => 'image',
                'options' => [
                    'image' => [
                        'title' => 'Image',
                        'icon' => 'eicon-image',
                    ],
                    'shape' => [
                        'title' => 'Shape',
                        'icon' => 'eicon-divider-shape',
                    ],
                ],
                'classes' => 'elementor-control-start-end',
                'render_type' => 'ui',

            ]
        );
        $repeater->add_control(
            'image',[
                'label' => esc_html__('Choose Image', 'bascart-essential'),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'item_source' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'shape',  [
                'label' => esc_html__('Choose Shape', 'bascart-essential'),
                'type' => Controls_Manager::SELECT,
                'default' => 'angle',
                'options' => [
                    'angle' => esc_html__('Shape 1', 'bascart-essential'),
                    'double_stroke' => esc_html__('Shape 2', 'bascart-essential'),
                    'fat_stroke' => esc_html__('Shape 3', 'bascart-essential'),
                    'fill_circle' => esc_html__('Shape 4', 'bascart-essential'),
                    'round_triangle' => esc_html__('Shape 5', 'bascart-essential'),
                    'single_stroke' => esc_html__('Shape 6', 'bascart-essential'),
                    'stroke_circle' => esc_html__('Shape 7', 'bascart-essential'),
                    'triangle' => esc_html__('Shape 8', 'bascart-essential'),
                    'zigzag' => esc_html__('Shape 9', 'bascart-essential'),
                    'zigzag_2' => esc_html__('Shape 10', 'bascart-essential'),
                    'shape_1' => esc_html__('Shape 11', 'bascart-essential'),
                    'shape_2' => esc_html__('Shape 12', 'bascart-essential'),
                    'shape_3' => esc_html__('Shape 13', 'bascart-essential'),
                    'shape_4' => esc_html__('Shape 14', 'bascart-essential'),
                ],
                'condition' => [
                    'item_source' => 'shape',
                ]
            ]
        );

        $repeater->add_control(
             'shape_color',
            [
                'label' => esc_html__( 'Color', 'bascart-essential' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'item_source' => 'shape',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-parallax-graphic" => 'fill: {{VALUE}}; stroke: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'width_type',
            [
                'label' => esc_html__( 'Width', 'bascart-essential' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Auto', 'bascart-essential' ),
                    'custom' => esc_html__( 'Custom', 'bascart-essential' ),
                ],

            ]
        );

        $repeater->add_responsive_control(
            'custom_width',
            [
                'label' => esc_html__( 'Custom Width', 'bascart-essential' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'width_type' => 'custom',
                ],
                'device_args' => [
                    Controls_Stack::RESPONSIVE_TABLET => [
                        'condition' => [
                            'ekit_prlx_width_tablet' => [ 'custom' ],
                        ],
                    ],
                    Controls_Stack::RESPONSIVE_MOBILE => [
                        'condition' => [
                            'ekit_prlx_width_mobile' => [ 'custom' ],
                        ],
                    ],
                ],
                'size_units' => [ 'px', '%', 'vw' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-parallax-graphic' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'source_rotate', [
                'label' => esc_html__('Rotate', 'bascart-essential'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-parallax-graphic" => 'transform: rotate({{SIZE}}{{UNIT}})',
                ],

            ]
        );

        $repeater->add_responsive_control(
            'pos_x', [
                'label' => esc_html__('Position X (%)', 'bascart-essential'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%','px'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 10,
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}.ekit-section-parallax-layer" => 'left: {{SIZE}}{{UNIT}}',
                ],

            ]
        );

        $repeater->add_responsive_control(
            'pos_y',[
                'label' => esc_html__('Position Y (%)', 'bascart-essential'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%','px'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 200,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 10,
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}.ekit-section-parallax-layer" => 'top: {{SIZE}}{{UNIT}}',

                ],

            ]
        );
        $repeater->add_responsive_control(
            'animation',
            [
                'label' => esc_html__( 'Animation', 'bascart-essential' ),
                'type' => Controls_Manager::SELECT2,
                'frontend_available' => true,
                'default' => 'ekit-fade',
                'options' => [
                    'ekit-fade'=> 'Fade',
                    'ekit-rotate'=> 'Rotate',
                    'ekit-bounce'=> 'Bounce',
                    'ekit-zoom'=> 'Zoom',
                    'ekit-rotate-box'=> 'RotateBox',
                    'ekit-left-right'=> 'Left Right',
                    'bounce'=> 'Bounce 2',
                    'flash'=> 'Flash',
                    'pulse'=> 'Pulse',
                    'shake'=> 'Shake',
                    'headShake'=> 'HeadShake',
                    'swing'=> 'Swing',
                    'tada'=> 'Tada',
                    'wobble'=> 'Wobble',
                    'jello'=> 'Jello',
                ],
                'condition' => [
                    'parallax_style' => 'animation',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => '-webkit-animation-name:{{UNIT}}',
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'animation-name:{{UNIT}}',
                ],
            ]
        );
        $repeater->add_control(
            'item_opacity',
            [
                'label' => esc_html__( 'Opacity', 'bascart-essential' ),
                'description' => esc_html__( 'Opacity will be (0-1), default value 1', 'bascart-essential' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '1',
                'min' => 0,
                'step' => 1,
                'render_type' => 'none',
                'frontend_available' => true,
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'opacity:{{UNIT}}'
                ],
            ]
        );

        $repeater->add_control(
            'animation_speed',
            [
                'label' => esc_html__( 'Animation speed', 'bascart-essential' ) . ' (s)',
                'type' => Controls_Manager::NUMBER,
                'default' => '5',
                'min' => 1,
                'step' => 100,
                'render_type' => 'none',
                'frontend_available' => true,
                'condition' => [
                    'parallax_style' => 'animation',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => '-webkit-animation-duration:{{UNIT}}s',
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'animation-duration:{{UNIT}}s'
                ],
            ]
        );
        $repeater->add_control(
            'animation_iteration_count',
            [
                'label' => esc_html__( 'Animation Iteration Count', 'bascart-essential' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'unset',
                'options' => [
                    'infinite' => esc_html__( 'Infinite', 'bascart-essential' ),
                    'unset' => esc_html__( 'Unset', 'bascart-essential' ),
                ],
                'condition' => [
                    'parallax_style' => 'animation',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'animation-iteration-count:{{UNIT}}'
                ],
            ]
        );
        $repeater->add_control(
            'animation_direction',
            [
                'label' => esc_html__( 'Animation Direction', 'bascart-essential' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => esc_html__( 'Normal', 'bascart-essential' ),
                    'reverse' => esc_html__( 'Reverse', 'bascart-essential' ),
                    'alternate' => esc_html__( 'Alternate', 'bascart-essential' ),
                ],
                'condition' => [
                    'parallax_style' => 'animation',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'animation-direction:{{UNIT}}'
                ],
            ]
        );

        $repeater->add_control(
            'parallax_speed', [
                'label' => esc_html__('Speed', 'bascart-essential'),
                'type' => Controls_Manager::NUMBER,
                'default' => esc_html__('100', 'bascart-essential'),
                'condition' => [
                    'parallax_style' => 'mousemove',
                ]
            ]
        );

        $repeater->add_control(
            'parallax_transform', [
                'label' => esc_html__( 'Parallax style', 'bascart-essential' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'translateY',
                'options' => [
                    'translateX' => esc_html__( 'X axis', 'bascart-essential' ),
                    'translateY' => esc_html__( 'Y axis', 'bascart-essential' ),
                    'rotate' => esc_html__( 'rotate', 'bascart-essential' ),
                    'rotateX' => esc_html__( 'rotateX', 'bascart-essential' ),
                    'rotateY' => esc_html__( 'rotateY', 'bascart-essential' ),
                    'scale' => esc_html__( 'scale', 'bascart-essential' ),
                    'scaleX' => esc_html__( 'scaleX', 'bascart-essential' ),
                    'scaleY' => esc_html__( 'scaleY', 'bascart-essential' ),
                ],
                'condition' => [
                    'parallax_style' => 'onscroll'
                ],
            ]
        );
        $repeater->add_control(
            'parallax_transform_value', [
                'label' => esc_html__( 'Parallax Transition ', 'bascart-essential' ),
                'description' => esc_html__( 'X, Y and Z Axis will be pixels, Rotate will be degrees (0-180), scale will be ratio', 'bascart-essential' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '250',
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'smoothness', [
                'label' => esc_html__( 'Smoothness', 'bascart-essential' ),
                'description' => esc_html__( 'factor that slowdown the animation, the more the smoothier (default: 700)', 'bascart-essential' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '700',
                'min' => 0,
                'max' => 1000,
                'step' => 100,
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'offsettop',[
                'label' => esc_html__( 'Offset Top', 'bascart-essential' ),
                'description' => esc_html__( 'default: 0; when the element is visible', 'bascart-essential' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'offsetbottom', [
                'label' => esc_html__( 'Offset Bottom', 'bascart-essential' ),
                'description' => esc_html__( 'default: 0; when the element is visible', 'bascart-essential' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'maxtilt',[
                'label' => esc_html__( 'MaxTilt', 'bascart-essential' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '20',
                'condition' => [
                    'parallax_style' => 'tilt',
                ]
            ]
        );
        $repeater->add_control(
            'scale',[
                'label' => esc_html__( 'Image Scale', 'bascart-essential' ),
                'description' => esc_html__( '2 = 200%, 1.5 = 150%, etc.. Default 1', 'bascart-essential' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '1',
                'condition' => [
                    'parallax_style' => 'tilt',
                ]
            ]
        );
        $repeater->add_control(
            'disableaxis', [
                'label' => esc_html__( 'Disable Axis', 'bascart-essential' ),
                'description' => esc_html__( 'What axis should be disabled. Can be X or Y.', 'bascart-essential' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'None', 'bascart-essential' ),
                    'x' => esc_html__( 'X axis', 'bascart-essential' ),
                    'y' => esc_html__( 'Y axis', 'bascart-essential' ),
                ],

                'condition' => [
                    'parallax_style' => 'tilt',
                ]
            ]
        );
        $repeater->add_control(
            'zindex',   [
                'label' => esc_html__('Z-index', 'bascart-essential'),
                'type' => Controls_Manager::NUMBER,
                'default' => esc_html__('2', 'bascart-essential'),
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'z-index: {{UNIT}}',
                ],
            ]
        );
        $control->add_control(
            'ekit_section_parallax_multi_items',
            [
                'label' => esc_html__( 'Parallax', 'bascart-essential' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ parallax_style }}}',
                'condition' => [
                    'ekit_section_parallax_multi' => 'yes'
                ],

            ]
        );

        $control->end_controls_section();
    }

    public function after_section_render(Element_Base $element)
    {
        $data     = $element->get_data();
        $settings = $data['settings'];
        // d($settings);
        
        if  (
                (isset($settings['ekit_section_parallax_multi']) && $settings['ekit_section_parallax_multi'] == 'yes') || 
                (isset($settings['ekit_section_parallax_bg']) && $settings['ekit_section_parallax_bg'] == 'yes')
            ){

            echo "
            <script>
                window.elementskit_section_parallax_data.section".$data['id']." = JSON.parse('".json_encode($settings)."');
            </script>
            ";
        }
    }

}