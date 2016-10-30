$(function () {
    $('.m-delete-picture').click(function (event) {
        var $element = $(this);
        var url = $element.attr('href'),
            id = $element.data('picture-id');

        if (confirm('Remove car model picture?')) {
            $.post(url, { id: id }, function (result) {
                if (result) {
                    $element.parent().parent().parent().remove();
                }
            });
        }

        event.preventDefault();
        event.stopPropagation();
    });
});