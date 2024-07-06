let currentPage = document.getElementById('project-container').dataset.currentPage;

$(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var newPage = $(this).text();

    // Определение направления анимации
    if (parseInt(newPage) > currentPage) {
        $('#project-container').addClass('slide-out-left');
    } else {
        $('#project-container').addClass('slide-out-right');
    }

    getProjects(url, newPage);
    window.history.pushState("", "", url);
});

function getProjects(url, newPage) {
    $.ajax({
        url: url
    }).done(function(data) {
        setTimeout(function() {
            var newProjects = $(data).find('#project-container').html();
            $('#project-container').html(newProjects).removeClass('slide-out-left slide-out-right');

            if (parseInt(newPage) > currentPage) {
                $('#project-container').addClass('slide-in-right');
            } else {
                $('#project-container').addClass('slide-in-left');
            }

            // Обновляем текущую страницу
            currentPage = parseInt(newPage);

            // Обновляем пагинацию
            var newPagination = $(data).find('#pagination-container').html();
            $('#pagination-container').html(newPagination);

            // Удаляем классы анимации после завершения
            $('#project-container').on('animationend', function() {
                $(this).removeClass('slide-in-left slide-in-right');
            });
        }, 500); // Продолжительность анимации выезда
    }).fail(function() {
        alert('Projects could not be loaded.');
    });
}
