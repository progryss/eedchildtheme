<?php
// Start  Banner Section Register Block
 acf_register_block_type(array(
    'name'              => 'banner-section',
    'title'             => __('Banner Section'),
    'description'       => __('Banner Text Block'),
    'render_template'   => 'template-parts/blocks/banner-section/banner-section.php',
    'category'          => 'simple-tech-blocks',
    'icon'              => 'admin-comments',
    'enqueue_assets'    => function(){
        wp_enqueue_script( 'im-text-js', get_template_directory_uri(). '/template-parts/blocks/banner-section/banner-section.js', array(), '1.0.0', true );
        wp_enqueue_style( 'im-text-styles', get_template_directory_uri(). '/template-parts/blocks/banner-sectiont/banner-section.css', array(), '1.0.0' );
    },
    'keywords'          => array( 'text' ),
    'supports'           => array( 'anchor' => true ),
    'example'           => array(
        'attributes' => array(
            'mode' => 'preview',
            'data' => array(
                '__is_preview' => true
            )
        )
    )
));
// End  Banner Section Register Block

// Start Card Section Register Block
acf_register_block_type(array(
    'name'              => 'card-section',
    'title'             => __('Card Section'),
    'description'       => __('Card Text Block'),
    'render_template'   => 'template-parts/blocks/card-section/card-section.php',
    'category'          => 'simple-tech-blocks',
    'icon'              => 'admin-comments',
    'enqueue_assets'    => function(){
        wp_enqueue_script( 'im-text-js', get_template_directory_uri(). '/template-parts/blocks/card-section/card-section.js', array(), '1.0.0', true );
        wp_enqueue_style( 'im-text-styles', get_template_directory_uri(). '/template-parts/blocks/card-sectiont/card-section.css', array(), '1.0.0' );
    },
    'keywords'          => array( 'text' ),
    'supports'           => array( 'anchor' => true ),
    'example'           => array(
        'attributes' => array(
            'mode' => 'preview',
            'data' => array(
                '__is_preview' => true
            )
        )
    )
));
// End Card Section Register Block

// Start Testimonials Section Register Block
acf_register_block_type(array(
    'name'              => 'testimonials-section',
    'title'             => __('Testimonials Section'),
    'description'       => __('Testimonials Text Block'),
    'render_template'   => 'template-parts/blocks/testimonials-section/testimonials-section.php',
    'category'          => 'simple-tech-blocks',
    'icon'              => 'admin-comments',
    'enqueue_assets'    => function(){
        wp_enqueue_script( 'im-text-js', get_template_directory_uri(). '/template-parts/blocks/testimonials-section/testimonials-section.js', array(), '1.0.0', true );
        wp_enqueue_style( 'im-text-styles', get_template_directory_uri(). '/template-parts/blocks/testimonials-sectiont/testimonials-section.css', array(), '1.0.0' );
    },
    'keywords'          => array( 'text' ),
    'supports'           => array( 'anchor' => true ),
    'example'           => array(
        'attributes' => array(
            'mode' => 'preview',
            'data' => array(
                '__is_preview' => true
            )
        )
    )
));
// End Testimonials Section Register Block

// Start Content Section Register Block
acf_register_block_type(array(
    'name'              => 'content-section',
    'title'             => __('Content Section'),
    'description'       => __('Content Text Block'),
    'render_template'   => 'template-parts/blocks/content-section/content-section.php',
    'category'          => 'simple-tech-blocks',
    'icon'              => 'admin-comments',
    'enqueue_assets'    => function(){
        wp_enqueue_script( 'im-text-js', get_template_directory_uri(). '/template-parts/blocks/content-section/content-section.js', array(), '1.0.0', true );
        wp_enqueue_style( 'im-text-styles', get_template_directory_uri(). '/template-parts/blocks/content-sectiont/content-section.css', array(), '1.0.0' );
    },
    'keywords'          => array( 'text' ),
    'supports'           => array( 'anchor' => true ),
    'example'           => array(
        'attributes' => array(
            'mode' => 'preview',
            'data' => array(
                '__is_preview' => true
            )
        )
    )
));
// End Content Section Register Block

// Start Two Column Section Register Block
acf_register_block_type(array(
    'name'              => 'two-column-section',
    'title'             => __('Two Column Section'),
    'description'       => __('Two Column Text Block'),
    'render_template'   => 'template-parts/blocks/two-column-section/two-column-section.php',
    'category'          => 'simple-tech-blocks',
    'icon'              => 'admin-comments',
    'enqueue_assets'    => function(){
        wp_enqueue_script( 'im-text-js', get_template_directory_uri(). '/template-parts/blocks/two-column-section/two-column-section.js', array(), '1.0.0', true );
        wp_enqueue_style( 'im-text-styles', get_template_directory_uri(). '/template-parts/blocks/two-column-sectiont/two-column-section.css', array(), '1.0.0' );
    },
    'keywords'          => array( 'text' ),
    'supports'           => array( 'anchor' => true ),
    'example'           => array(
        'attributes' => array(
            'mode' => 'preview',
            'data' => array(
                '__is_preview' => true
            )
        )
    )
));
// End Two Column Section Register Block

// Start Form Section Register Block
acf_register_block_type(array(
    'name'              => 'form-section',
    'title'             => __('Form Section'),
    'description'       => __('Form Text Block'),
    'render_template'   => 'template-parts/blocks/form-section/form-section.php',
    'category'          => 'simple-tech-blocks',
    'icon'              => 'admin-comments',
    'enqueue_assets'    => function(){
        wp_enqueue_script( 'im-text-js', get_template_directory_uri(). '/template-parts/blocks/form-section/form-section.js', array(), '1.0.0', true );
        wp_enqueue_style( 'im-text-styles', get_template_directory_uri(). '/template-parts/blocks/form-sectiont/form-section.css', array(), '1.0.0' );
    },
    'keywords'          => array( 'text' ),
    'supports'           => array( 'anchor' => true ),
    'example'           => array(
        'attributes' => array(
            'mode' => 'preview',
            'data' => array(
                '__is_preview' => true
            )
        )
    )
));
// End Form Section Register Block

// Start Image Card With Link Section Register Block
acf_register_block_type(array(
    'name'              => 'image-card-with-link-section',
    'title'             => __('Image Card With Link Section'),
    'description'       => __('Form Text Block'),
    'render_template'   => 'template-parts/blocks/image-card-with-link-section/image-card-with-link-section.php',
    'category'          => 'simple-tech-blocks',
    'icon'              => 'admin-comments',
    'enqueue_assets'    => function(){
        wp_enqueue_script( 'im-text-js', get_template_directory_uri(). '/template-parts/blocks/image-card-with-link-section/image-card-with-link-section.js', array(), '1.0.0', true );
        wp_enqueue_style( 'im-text-styles', get_template_directory_uri(). '/template-parts/blocks/image-card-with-link-sectiont/image-card-with-link-section.css', array(), '1.0.0' );
    },
    'keywords'          => array( 'text' ),
    'supports'           => array( 'anchor' => true ),
    'example'           => array(
        'attributes' => array(
            'mode' => 'preview',
            'data' => array(
                '__is_preview' => true
            )
        )
    )
));
// End Image Card With Link Section Register Block

// Start Logged In Content Section Register Block
acf_register_block_type(array(
    'name'              => 'logged-in-content-section',
    'title'             => __('Logged In Content Section'),
    'description'       => __('Form Text Block'),
    'render_template'   => 'template-parts/blocks/logged-in-content-section/logged-in-content-section.php',
    'category'          => 'simple-tech-blocks',
    'icon'              => 'admin-comments',
    'enqueue_assets'    => function(){
        wp_enqueue_script( 'im-text-js', get_template_directory_uri(). '/template-parts/blocks/logged-in-content-section/logged-in-content-section.js', array(), '1.0.0', true );
        wp_enqueue_style( 'im-text-styles', get_template_directory_uri(). '/template-parts/blocks/logged-in-content-sectiont/logged-in-content-section.css', array(), '1.0.0' );
    },
    'keywords'          => array( 'text' ),
    'supports'           => array( 'anchor' => true ),
    'example'           => array(
        'attributes' => array(
            'mode' => 'preview',
            'data' => array(
                '__is_preview' => true
            )
        )
    )
));

// End Logged In Content Section Register Block

// Start Instagram Section Register Block
acf_register_block_type(array(
    'name'              => 'instagram-section',
    'title'             => __('Instagram Section'),
    'description'       => __('Form Text Block'),
    'render_template'   => 'template-parts/blocks/instagram-section/instagram-section.php',
    'category'          => 'simple-tech-blocks',
    'icon'              => 'admin-comments',
    'enqueue_assets'    => function(){
        wp_enqueue_script( 'im-text-js', get_template_directory_uri(). '/template-parts/blocks/instagram-section/instagram-section.js', array(), '1.0.0', true );
        wp_enqueue_style( 'im-text-styles', get_template_directory_uri(). '/template-parts/blocks/instagram-sectiont/instagram-section.css', array(), '1.0.0' );
    },
    'keywords'          => array( 'text' ),
    'supports'           => array( 'anchor' => true ),
    'example'           => array(
        'attributes' => array(
            'mode' => 'preview',
            'data' => array(
                '__is_preview' => true
            )
        )
    )
));

// End Instagram Section Register Block

// Start Checkout Section Register Block
acf_register_block_type(array(
    'name'              => 'checkout-section',
    'title'             => __('Checkout Section'),
    'description'       => __('Form Text Block'),
    'render_template'   => 'template-parts/blocks/checkout-section/checkout-section.php',
    'category'          => 'simple-tech-blocks',
    'icon'              => 'admin-comments',
    'enqueue_assets'    => function(){
        wp_enqueue_script( 'im-text-js', get_template_directory_uri(). '/template-parts/blocks/checkout-section/checkout-section.js', array(), '1.0.0', true );
        wp_enqueue_style( 'im-text-styles', get_template_directory_uri(). '/template-parts/blocks/checkout-sectiont/checkout-section.css', array(), '1.0.0' );
    },
    'keywords'          => array( 'text' ),
    'supports'           => array( 'anchor' => true ),
    'example'           => array(
        'attributes' => array(
            'mode' => 'preview',
            'data' => array(
                '__is_preview' => true
            )
        )
    )
));

// End Checkout Section Register Block


