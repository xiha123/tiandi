$('.submit-course-add').click(addCourse);
$('#add-form').submit(addCourse);

function addCourse(e) {
    e.preventDefault();

    var data = {};
    $.each($('#add-form').serializeArray(), function (index, item) {
        data[item.name] = item.value;
    });

    _td.api.addGodCourse(data).then(function () {
        location.reload();
    }, function (res) {
        showAlert(false, res.error);
    });
}

$('.js-remove-course').click(function () {
    var course_id = $(this).parent().parent().attr('data-id');
    _td.api.removeGodCourse({
        id: course_id
    }).then(function () {
        location.reload();
    }, function (res) {
        showAlert(false, res.error);
    });
});
