$(document).ready(function() {
    // Listen for modal show event
    $('#view-product').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget); // Button that triggered the modal
        var title = button.data('title'); // Extract data-title attribute
        var image = button.data('image'); // Extract data-image attribute
        var price = button.data('price'); // Extract data-price attribute
        var slug = button.data('slug');
        var description = button.data('description'); // Extract data-description attribute
        var published = button.data('published');

        // Strip HTML and limit to 100 characters
        var strippedDescription = description.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ');
        strippedDescription = strippedDescription.replace(/\s+/g, ' ').trim(); // Normalize spaces                
        var limitedDescription = strippedDescription.substring(0, 100); // Limit to 100 characters

        // Update modal content
        $('#modal-product-title').text(title);
        $('#modal-product-image').attr('src', image);
        $('#modal-product-price').text(price);
        $('#modal-product-description').text(limitedDescription + '...');
        $('#more-details-link').attr('href', '/single-product/' + slug);
        if (published == 1) {
            $('#add-to-cart').show();
        } else {
            $('#add-to-cart').hide();
        }

        $('#add-to-cart').attr('data-id', button.data('id'));
    });
});