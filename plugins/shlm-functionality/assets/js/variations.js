wp.blocks.registerBlockVariation(
    'core/post-featured-image',
    {
        name: 'sotp_post_featured_image',
        title: 'Post Featured Image + Caption',
        description: 'Displays the post\'s featured image with caption.',
        isActive: [ 'namespace' ],
        attributes: {
            namespace: 'sotp_post_featured_image',
            className: 'sotp-post-featured-image'
        },
        scope: [ 'inserter' ]
    }
);