<?php

namespace Ew_Product_Countdown\Widgets;

use Ew_Product_Countdown\Widgets\WoocommerceProductCountdownBase;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class WoocommerceProductCountdown extends WoocommerceProductCountdownBase
{
    public function get_name(): string
    {
        return 'woocommerce_product_countdown';
    }

    public function get_title(): ?string
    {
        return __('نمایش محصول ویژه', 'ew-product-countdown');
    }

    public function get_icon(): string
    {
        return 'eicon-countdown';
    }

    public function get_categories(): array
    {
        return ['custom-widget-category'];
    }


    private function get_woocommerce_sale_products(): array
    {
        $sale_product_ids = wc_get_product_ids_on_sale();
        $product_options = [];

        if (!empty($sale_product_ids)) {
            foreach ($sale_product_ids as $product_id) {
                $product = wc_get_product($product_id);
                if ($product) {
                    $product_options[$product_id] = $product->get_name();
                }
            }
        }

        return $product_options;
    }

    protected function register_controls(): void
    {
        $this->start_controls_section(
            'ew-product-countdown-content_section',
            [
                'label' => __( 'Content', 'ew-product-countdown' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'product_id',
            [
                'label' => __( 'Product', 'ew-product-countdown' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_woocommerce_sale_products(),
                'default' => '',
            ]
        );

        $this->add_control(
            'countdown_end_date',
            [
                'label' => __( 'Countdown End Date', 'ew-product-countdown' ),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'default' => '',
            ]
        );
        $this->add_control(
            'late_text',
            [
                'label' => __( 'Late Text', 'ew-product-countdown' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('دیر رسیدی !! تخفیف محصول  تمام شده است :)', 'ew-product-countdown'),
            ]
        );

        $this->add_control(
            'days_text',
            [
                'label' => __( 'Days Text', 'ew-product-countdown' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Days', 'ew-product-countdown'),
            ]
        );

        $this->add_control(
            'hours_text',
            [
                'label' => __( 'Hours Text', 'ew-product-countdown' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Hours', 'ew-product-countdown'),
            ]
        );

        $this->add_control(
            'minutes_text',
            [
                'label' => __( 'Minutes Text', 'ew-product-countdown' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Minutes', 'ew-product-countdown'),
            ]
        );

        $this->add_control(
            'seconds_text',
            [
                'label' => __( 'Seconds Text', 'ew-product-countdown' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Seconds', 'ew-product-countdown'),
            ]
        );

        $this->add_control(
            'product_text_length',
            [
                'label' => __( 'Product Text Length', 'ew-product-countdown' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 20,
            ]
        );
        $this->end_controls_section();

        // Card Style Section
        $this->start_controls_section(
            'card_style_section',
            [
                'label' => __( 'Card Style', 'ew-product-countdown' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_background_color',
            [
                'label' => __( 'Card Background Color', 'ew-product-countdown' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .special-offer' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'label' => __( 'Card Border', 'ew-product-countdown' ),
                'selector' => '{{WRAPPER}} .special-offer',
            ]
        );

        $this->add_control(
            'card_border_radius',
            [
                'label' => __( 'Card Border Radius', 'ew-product-countdown' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .special-offer' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_box_shadow',
                'label' => __( 'Card Box Shadow', 'ew-product-countdown' ),
                'selector' => '{{WRAPPER}} .special-offer',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'product_title_typography',
                'label' => __( 'Product Title Typography', 'ew-product-countdown' ),
                'selector' => '{{WRAPPER}} .special-offer .text h2',
            ]
        );

        $this->add_control(
            'product_title_color',
            [
                'label' => __( 'Product Title Color', 'ew-product-countdown' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .special-offer .text h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'product_price_typography',
                'label' => __( 'Product Price Typography', 'ew-product-countdown' ),
                'selector' => '{{WRAPPER}} .special-offer .price',
            ]
        );

        $this->add_control(
            'product_price_color',
            [
                'label' => __( 'Product Price Color', 'ew-product-countdown' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff0000',
                'selectors' => [
                    '{{WRAPPER}} .special-offer .price' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Timer Style Section
        $this->start_controls_section(
            'timer_style_section',
            [
                'label' => __( 'Timer Style', 'ew-product-countdown' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'timer_typography',
                'label' => __( 'Timer Typography', 'ew-product-countdown' ),
                'selector' => '{{WRAPPER}} .special-offer .box-head .box h1, {{WRAPPER}} .special-offer .box-head .box h2',
            ]
        );

        $this->add_control(
            'timer_color',
            [
                'label' => __( 'Timer Color', 'ew-product-countdown' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .special-offer .box-head .box h1' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .special-offer .box-head .box h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Late Text Style Section
        $this->start_controls_section(
            'late_text_style_section',
            [
                'label' => __( 'Late Text Style', 'ew-product-countdown' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'late_text_typography',
                'label' => __( 'Late Text Typography', 'ew-product-countdown' ),
                'selector' => '{{WRAPPER}} .special-offer .alert h1',
            ]
        );


        $this->add_control(
            'late_text_color',
            [
                'label' => __( 'Late Text Color', 'ew-product-countdown' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .special-offer .alert h4' => 'color: {{VALUE}};',
                ],
            ]
        );



        $this->end_controls_section();
    }

    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
        $product = wc_get_product($settings['product_id']);
        $end_date = strtotime($settings['countdown_end_date']);

        if (!$product) {
            return;
        }

        $current_time = current_time('timestamp');
        $countdown_time = $end_date > $current_time ? $end_date - $current_time : 0;
        $countdown_days = floor($countdown_time / (60 * 60 * 24));
        $countdown_hours = floor(($countdown_time % (60 * 60 * 24)) / (60 * 60));
        $countdown_minutes = floor(($countdown_time % (60 * 60)) / 60);
        $countdown_seconds = $countdown_time % 60;

        $this->render_template($settings, $product, $countdown_time, $countdown_days, $countdown_hours, $countdown_minutes, $countdown_seconds);
    }

    protected function render_template($settings, $product, $countdown_time, $countdown_days, $countdown_hours, $countdown_minutes, $countdown_seconds)
    {
        ?>
        <div class="special-offer">
            <div class="offer-content">
                <div class="image">
                    <?php echo $product->get_image(); ?>
                    <?php if ($product->is_on_sale()): ?>
                        <span class="sale-tag">
                            <?php
                            $regular_price = $product->get_regular_price();
                            $sale_price = $product->get_sale_price();
                            $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100) . '%';
                            echo esc_html($discount_percentage);
                            ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="text">
                    <h2><a href="<?php echo esc_url(get_permalink($product->get_id())); ?>"><?php echo esc_html($product->get_name()); ?></a></h2>
                    <ul class="review">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <li><i class="lni lni-star-filled"></i></li>
                        <?php endfor; ?>
                        <li><span><?php echo $product->get_review_count(); ?> امتیاز </span></li>
                    </ul>
                    <div class="price">
                        <?php echo $product->get_price_html(); ?>
                    </div>
                    <p><?php echo wp_trim_words(esc_html($product->get_short_description()), $settings['product_text_length']); ?></p>
                </div>
                <div class="box-head">
                    <div class="box">
                        <h1 id="days"><?php echo $countdown_days; ?></h1>
                        <h2 id="daystxt"><?php echo esc_html($settings['days_text']); ?></h2>
                    </div>
                    <div class="box">
                        <h1 id="hours"><?php echo $countdown_hours; ?></h1>
                        <h2 id="hourstxt"><?php echo esc_html($settings['hours_text']); ?></h2>
                    </div>
                    <div class="box">
                        <h1 id="minutes"><?php echo $countdown_minutes; ?></h1>
                        <h2 id="minutestxt"><?php echo esc_html($settings['minutes_text']); ?></h2>
                    </div>
                    <div class="box">
                        <h1 id="seconds"><?php echo $countdown_seconds; ?></h1>
                        <h2 id="secondstxt"><?php echo esc_html($settings['seconds_text']); ?></h2>
                    </div>
                </div>
                <?php if ($countdown_time <= 0): ?>
                    <div class="alert" style="background: #cc1818;">
                        <h4 style="padding: 10px 20px;color: <?php echo esc_attr($settings['late_text_color']); ?>;">
                            <?php echo esc_html($settings['late_text']); ?>
                        </h4>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
