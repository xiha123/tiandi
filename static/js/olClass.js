$(document).ready(function() {
    var $curTag = $('.tab [data-id="' + (window.location.hash.slice(1) || '') + '"]');
    $curTag.length && $curTag.trigger('click');
});
