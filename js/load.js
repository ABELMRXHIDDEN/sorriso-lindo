$(()=>{
    $("#sms-login").text('Carregando o Aplicativo')
    setTimeout(()=>{
        $("#gifDeLoading").fadeOut(0)
        $(".form-login").fadeIn(500)
        $("#sms-login").fadeOut(400)
    },3000)
})