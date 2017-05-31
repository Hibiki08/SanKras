function activeAjax($this, url) {
    var value = $this.attr('data-value');
    var id = $this.data().id;
    $this.find('.progress').show();
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        data: {id: id, value: value},
        success: function (response) {
        if (response.status == true) {
            if (value == 1) {
                $this.find('span').text('Деактивировать');
                $this.attr('data-value', 0);
                $this.closest('tr').find('.status').text('Да');
            } else {
                $this.find('span').text('Активировать');
                $this.attr('data-value', 1);
                $this.closest('tr').find('.status').text('Нет');
            }
        }
        $this.find('.progress').hide();
    },
    error: function () {
        $this.find('.progress').hide();
    }
    });
}

function deleteAjax($this, url) {
    $this.find('.progress').show();
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        data: {id: $this.data().id},
        success: function (response) {
            if (response.status == true) {
                $this.closest('tr').remove();
            }
        },
        error: function () {
            $this.find('.progress').hide();
        }
    });
}

function sortAjax(data, url) {
        $('.row-fluid .sort-progress').show();
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            data: {data: data},
            success: function (response) {
                console.log(response);
                if (response.status == true) {
                    $('#sort').removeClass('disabled');
                    $('.sections').removeClass('sort');
                    $(".sortable").sortable('disable');
                    $('.row-fluid .sort-progress').hide();
                    $('#save-sort').hide();
                }
            },
            error: function () {
                $('.row-fluid .sort-progress').hide();
                console.log(response);
            }
        });
}

$(document).ready(function() {
    $('#sort').click(function() {
        $(this).addClass('disabled');
        $('.sections').addClass('sort');
        $(".sortable").sortable({
            placeholder: "ui-state-highlight",
        }).sortable('enable');
        $('#save-sort').show();
    });

});
