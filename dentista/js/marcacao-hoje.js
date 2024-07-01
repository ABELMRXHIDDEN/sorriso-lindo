$(()=>{

     exibirPaciente()
     setInterval(exibirPaciente,2000)

})



function exibirPaciente(){
    $("#PesCol").val('')
    let dados={
        listarMarchoje: true
    }

    $.ajax({
        url:'../../ajax/ajax-marcacao.php',
        type:'POST',
        data:dados,
        success:(Mensagem)=>{

            Mensagem=JSON.parse(Mensagem)
console.log(Mensagem)
            let tabela="<div class='titulo'>" +
                "<div class='coluna'>Nome Completo</div>" +
                "<div class='coluna'>Nº Bilhete</div>" +
                "<div class='coluna'>Género</div>" +
                "<div class='coluna'>Nº Telefone</div>" +
                "<div class='coluna'>Hora Marcação</div>" +
                "</div>"

            for(i=0;i<Mensagem.length; i++){
                tabela+="<div style='cursor: pointer' class='linha' id='"+Mensagem[i]['idmarcacao']+"'>" +
                    "<div class='coluna'>"+Mensagem[i]['nomeCompleto']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['numeroBilhete']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['genero']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['numeroTelefone']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['horamarcacao']+"</div>" +
                    "<div class=' coluna campo"+Mensagem[i]['numeroBilhete']+"'>" +
                    "<p>Elimin</p>" +
                    "</div>" +
                    "</div>"
            }


          $(".tabelaPaciente").html(tabela)
addEventos()
        }

    })

}
function addEventos(){

    $(".tabelaPaciente .linha").on({
        click:(elemento)=>{
            location.href='http://'+document.location.host+'/dentista/views/view-paciente.php?id='+elemento.target.id+''
        }
    })

}
function viewActualizar(){
    $("#col_cad").fadeOut(0)
    $("#col_act").fadeIn(0)
    $("#tituloModal").text('Actualizar Informações')
    document.querySelector('.view').showModal()
    $(".texto").css({borderBottom:'1px solid  #e1c5c5'})
    numeroBilhete.readOnly=true;
    col_lim.style.display='none'

}
function viewCadastrar(){
    $("#col_cad").fadeIn(0)
    $("#col_act").fadeOut(0)
    $("#tituloModal").text('Adicionar Paciente')
    document.querySelector('.view').showModal()
    $(".texto").css({borderBottom:'1px solid  #e1c5c5'})
    numeroBilhete.readOnly=false;
    col_lim.style.display='block'

    $("#Limpar").click()
}
function Actualizar(){
    let erro="";
    let nome=$("#nomeCompleto").val()
    let nbi=$("#numeroBilhete").val()
    let datanas=$("#dataNascimento").val()
    let genero=$("#Genero").val()
    let endereco=$("#endereco").val()
    let email=$("#Email").val()
    let tel=$("#numeroTelefone").val()



    if (nome==='' || nbi==='' || datanas==='' || genero==='' || endereco==='' || email==='' || tel===''){
        erro='Preencha Todos Campos'
    }
    else {

        if (nome.length<9){
            erro+="Nome Completo |"
            $("#nomeCompleto").css({borderBottom:'1.5px solid red'})
        }
        if (nbi.length!==14){
            erro+="Nº Bilhete |"
            $("#numeroBilhete").css({borderBottom:'1.5px solid red'})
        }
        if (endereco.length<12){
            erro+="Endereco |"
            $("#endereco").css({borderBottom:'1.5px solid red'})
        }
        if (tel.length!==9){
            erro+="Nº de Telefone |"
            $("#numeroTelefone").css({borderBottom:'1.5px solid red'})
        }
        if (email.length<9){
            erro+="Email |"
            $("#Email").css({borderBottom:'1.5px solid red'})
        }

    }
    if (erro!==''){
        exibirMensagem(erro,500,6000)

    }
    else {
        let dados = {
            Nome: nome,
            NBI: nbi,
            Sexo: genero,
            Tel: tel,
            Endereco: endereco,
            Email: email,
            dataNascimento: datanas,
            Actulizar: true
        }

        $.ajax({
            url: '../../ajax/ajax-paciente.php',
            type: 'POST',
            data: dados,
            success: (Mensagem) => {
                exibirMensagem(Mensagem, 500, 4000)
                document.getElementById('Limpar').click()
                exibirPaciente()
            }

        })
    }
}
function pesquisarPaciente(){
    let dados={
        pesquisarPaciente: true,
        pesquisa: $("#PesCol").val(),
    }

    $.ajax({
        url:'../../ajax/ajax-paciente.php',
        type:'POST',
        data:dados,
        success:(Mensagem)=>{

            Mensagem=JSON.parse(Mensagem)
            let tabela="<tr>" +
                "<th>Nome Completo</th>" +
                "<th>Nº Bilhete</th>" +
                "<th>Género</th>" +
                "<th>Nº Telefone</th>" +
                "<th>#</th>"+
                "</tr>"

            for(i=0;i<Mensagem.length; i++){
                tabela+="<tr>" +
                    "<td>"+Mensagem[i]['nomeCompleto']+"</td>" +
                    "<td>"+Mensagem[i]['numeroBilhete']+"</td>" +
                    "<td>"+Mensagem[i]['genero']+"</td>" +
                    "<td>"+Mensagem[i]['numeroTelefone']+"</td>" +
                    "<td class='campo"+Mensagem[i]['numeroBilhete']+"'><img src='../../img/icones/actualizar.png' id='act"+Mensagem[i]['numeroBilhete']+"' class='icone-paciente'>" +
                    "<img src='../../img/icones/eliminar.png' class='icone-paciente' id='elm"+Mensagem[i]['numeroBilhete']+"'>" +
                    "<p>Elimin</p>" +
                    "</td>" +
                    "</tr>"
            }


            $(".tabelaPaciente").html(tabela)
            addEventos()
        }

    })

}