(function ($) {
    $('.table').on('click', '.btn-danger', function (e) {
        e.preventDefault()
        let csrf = $("input[name='_csrf']").val()
        let $btn = $(this)
        let url = $btn.parents('form').attr('action')
        console.log(csrf)
        $.ajax(url, {
            type: 'POST',
            data: {
                '_csrf' : csrf,
                '_method': 'DELETE'
            }})
            .done(function (data, text, jqxhr) {
                $btn.parents('tr').fadeOut()
            })
            .fail(function (jqxhr) {
                alert(jqxhr.responseText)
            })
            .always(function () {
                $btn.text('Chargement')
            })
        /*let $a = $(this)
        let url = $a.attr('href')
        $.ajax(url)
            .done(function (data, text, jqxhr) {
                $a.parents('tr').fadeOut()
            })
            .fail(function (jqxhr) {
                alert(jqxhr.responseText)
            })
            .always(function () {
                $a.text('Chargement')
            })*/
    })

})(jQuery)