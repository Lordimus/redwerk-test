jQuery(document).ready(function ($) {
    const imageContainer = $('.rw-olx-meta-image');
    const imageInput = imageContainer.find('#rw_olx_meta_image');

    $('.rw-olx-meta-image-add').click(function (event) {
        event.preventDefault();

        const thisButton = $(this);

        const customUploader = wp.media({
            title: 'Insert image',
            library: {
                type: 'image'
            },
            button: {
                text: 'Use these image'
            },
            multiple: false
        }).on('select', function () {
            let attachment = customUploader.state().get('selection').first().toJSON();
            imageInput.val(attachment.id);
            imageContainer.find('.rw-olx-meta-image-content').remove();
            imageContainer.prepend(`<div class="rw-olx-meta-image-content"></div>`);
            imageContainer.find('.rw-olx-meta-image-content').append(`<img src="${attachment.sizes.thumbnail.url}" alt="${attachment.alt}" /><br />`);
            imageContainer.find('.rw-olx-meta-image-content').append(`<button class="button button-primary rw-olx-meta-image-remove">Remove image</button>`);
            thisButton.text('Change image');
        }).open();
    });

    imageContainer.on('click', '.rw-olx-meta-image-remove', function (event) {
        event.preventDefault();
        imageInput.val('');
        imageContainer.find('.rw-olx-meta-image-content').remove();
        imageContainer.find('.rw-olx-meta-image-add').text('Add image');
    });
});