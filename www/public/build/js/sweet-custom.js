$(".deldatabase").click(function () {
    let id = $(this).attr('rel');
    let csrf = $("input[name='_csrf']").val()
    swal({
        type: "error",
        title: 'Supprimer le fichier SQL definitivement ???',
        showCancelButton: true,
        inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
                if (value) {
                    resolve()
                } else {

                }
            })
        }
    })
        .then(function (value) {
        $.ajax({
            type: 'GET',
            url: '/database/dump/delete',
            data:{
                '_csrf' : csrf,
                id : id },
            success:function(data) {
                swal({
                    type: 'success',
                    title: ' Suprimer avec  Succes',
                    confirmButtonColor: '#67d639',
                    html:  data
                }).then(function () {
                    window.location.href = "/database/dump/list";
                })
            },
            error:function(data){
                swal("Error", "Something blew up.", "error");
            }
        });

    })

});

$("#whoisSub").click(function (e) {
    e.preventDefault()
    let whois = $("#whois").val()

    $("#result").html("<img src='../../images/loading.gif' style='width: 300px;'>")

            $.ajax({
                type: 'GET',
                url: '/domain/whois/ask',
                data:{
                    'whois' : whois,
                    },
                success:function(data) {
                    $("#result").html(data)
                },
                error:function(data){
                    $("#result").html("Une erreur s'est produite !!!")
                }
            });

});

$(".submitDataBase").click(function (e) {
e.preventDefault()
    let processus = $('#processus').val()
    let DBdatabase = $('#dataBases').val()
    let DBTable = $('#DBTable').val()
    let DBhost = $('#dataHost').val()
    let DBuser = $('#dataUser').val()
    let DBPassword = $('#DBPassword').val()

    if (processus.length < 1){
        $('#error').html('<b style="color: #dd3b41;">Veuillez renseigner tous les champs !!!</b>').slideUp('slow').delay(5000)
    }
    if (DBdatabase.length < 1 ){
        $('#error').html('<b style="color: #dd3b41;">Veuillez renseigner tous les champs !!!</b>').slideUp('slow').delay(5000)
    }
    if ( DBTable.length < 1 ){
        $('#error').html('<b style="color: #dd3b41;">Veuillez renseigner tous les champs !!!</b>').slideUp('slow').delay(5000)
    }
    if ( DBhost.length < 1){
        $('#error').html('<b style="color: #dd3b41;">Veuillez renseigner tous les champs !!!</b>').slideUp('slow').delay(5000)
    }
    if (DBuser.length < 1){
        $('#error').html('<b style="color: #dd3b41;">Veuillez renseigner tous les champs !!!</b>').slideUp('slow').delay(5000)
    }


    if (processus.length > 1 && DBdatabase.length > 1 && DBTable.length > 1 && DBhost.length > 1 && DBuser.length > 1){
        $.ajax({
            type: 'GET',
            url: '/admin/database/sync',
            data:{
                processus : processus,
                database : DBdatabase,
                table : DBTable,
                host : DBhost,
                user : DBuser,
               password : DBPassword
            },
            success:function(data) {

            },
            error:function(data){
                $("#error").html("Une erreur s'est produite !!!")
            }
        });
    }




})

