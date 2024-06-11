$(document).ready(function () {
    $(".sidebar ul li").on('click', function (e) {
        e.preventDefault();
        
        // Remove active class from all list items
        $(".sidebar ul li.active").removeClass('active');
        
        // Add active class to the clicked list item
        $(this).addClass('active');

        // Get the target detail element
        var target = $(this).data('target');

        // Hide all detail contents
        $(".detail-content").removeClass('active');

        // Show the target detail content
        $(target).addClass('active');
    });

    $('.open-btn').on('click', function () {
        $('.sidebar').addClass('active');
    });

    $('.close-btn').on('click', function () {
        $('.sidebar').removeClass('active');
    });
});