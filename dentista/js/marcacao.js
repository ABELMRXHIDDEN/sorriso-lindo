$(()=>{

    exibirMarcacao()


    $("#exibirCadastro").on({
        click:()=>{
            viewCadastrar()
        },
        mouseover:()=>{
            $("#sms-cadas").text('Marcar Paciente').fadeIn(400)
        },
        mouseleave: ()=>{
            $("#sms-cadas").text('Adicionar Pacientes').fadeOut(0)
        }
    })
    $("#Adicionar").click(Cadastrar)

    $("#Actualizar").click(Actualizar)

    $("#Limpar").click(()=>{
        $(".texto").css({borderBottom:'1px solid  #e1c5c5'})

    })
    $("#fechar-cad").click(()=>{
        document.querySelector(".view").close()
    })

    $(".view").keydown((event)=>{

        if (event.which===13){
            Cadastrar()
        }
        else if(event.which===46){
            document.getElementById('Limpar').click()
        }
    })
})

function Cadastrar(){
    let erro="";





    if (dataMarcacao.value==='' || horaMarcacao.value===''){
        erro+='Preencha Todos Campos'
    }
    else {
        $.ajax({
            url:'../../ajax/ajax-marcacao.php',
            type:'POST',
            data:{
                verificarMarcacao:true,
                DataMarcacao:dataMarcacao.value,
                HoraMarcacao: horaMarcacao.value,
            },
            success:(sms)=>{
                sms=JSON.parse(sms)
                if(sms){

                    exibirMensagem('Já existe uma marcação para a data e hora Digitado',500,6000)
                }
                else {
                    $.ajax({
                        url:"../../ajax/ajax-marcacao.php",
                        type:"POST",
                        data :{
                            DataMarcacao:dataMarcacao.value,
                            HoraMarcacao: horaMarcacao.value,
                            AddMarcacao:true,
                            NBI: numeroBilhete.value,

                        },
                        success:(sms)=>{
                            exibirMensagem(sms,600,6000)
                            exibirMarcacao()
                        }

                    })
                }
            }
        })


    }
    if (erro!==''){
        exibirMensagem(erro,500,6000)

    }
}
function exibirMensagem(mensagem,transicao,tempoExibicao){
    $(".Mensagem").text(mensagem).fadeIn(transicao).animate({right: '0px'})
    setTimeout(()=>{
        $(".Mensagem").animate({right: '-450px'},{duration:2000}).fadeOut(transicao)
    },tempoExibicao)

}

function exibirMarcacao(){
    let dados={
        exibirMarcacao: true
    }

    $.ajax({
        url:'../../ajax/ajax-marcacao.php',
        type:'POST',
        data:dados,
        success:(Mensagem)=>{
            Mensagem=JSON.parse(Mensagem)
            let tabela="<tr>" +
                "<th>Nome Completo</th>" +
                "<th>Nº Bilhete</th>" +
                "<th>Género</th>" +
                "<th>Data Marcação</th>" +
                "<th>Hora Marcação</th>" +
                "<th>#</th>"+
                "</tr>"

            for(i=0;i<Mensagem.length; i++){
                tabela+="<tr>" +
                    "<td>"+Mensagem[i]['nomeCompleto']+"</td>" +
                    "<td>"+Mensagem[i]['numeroBilhete']+"</td>" +
                    "<td>"+Mensagem[i]['genero']+"</td>" +
                    "<td>"+Mensagem[i]['datamarcacao']+"</td>" +
                    "<td>"+Mensagem[i]['horamarcacao']+"</td>" +
                    "<td class='campo"+Mensagem[i]['idmarcacao']+"'><img src='../../img/icones/actualizar.png' id='act"+Mensagem[i]['idmarcacao']+"' class='icone-paciente'>" +
                    "<img src='../../img/icones/eliminar.png' class='icone-paciente' id='elm"+Mensagem[i]['idmarcacao']+"'>" +
                    "<a target='_blank' href='../../"+Mensagem[i]['comprovativo']+"'><img src='../../img/icones/print_144px.png' class='icone-paciente'</a>"+
                    "<p>Elimin</p>" +
                    "</td>" +
                    "</tr>"
            }



            $(".tabelaPaciente").html(tabela)
            addEventos()
        }

    })

}
function addEventos(){

    $(".tabelaPaciente td img").on({
        mouseover:(elemento)=>{
            let accao = elemento.target.id
            if (accao.slice(0, 3) === 'act') {
                $("td.campo"+accao.slice(3)+" p").text('Actualizar').fadeIn(400)
            } else if (accao.slice(0, 3) === 'elm') {
                $("td.campo"+accao.slice(3)+" p").text('Eliminar').fadeIn(400)
            }
        },
        click:(elemento)=>{
            let accao=elemento.target.id
            if(accao.slice(0,3)==='act'){
                $.ajax({
                    url:'../../ajax/ajax-marcacao.php',
                    type:'POST',
                    data:{
                        ipMarcacao:accao.slice(3),
                        Pesquisar:true
                    },
                    success:(informacoes)=>{
                        informacoes= JSON.parse(informacoes)
                        nomeCompleto.value=informacoes['nomeCompleto']
                        numeroBilhete.value=informacoes['numeroBilhete']
                        dataNascimento.value=informacoes['dataNascimento']
                        dataMarcacao.value=informacoes['datamarcacao']
                        horaMarcacao.value=informacoes['horamarcacao']
                        idMarcacao.value=informacoes['idmarcacao']
                        viewActualizar()

                    }

                })
            }
            else if(accao.slice(0,3)==='elm'){
                if(confirm("Pretende Eliminar a Marcação?")){
                    $.ajax({
                        url:'../../ajax/ajax-marcacao.php',
                        type:'post',
                        data:{
                            Eliminar:true,
                            idMarcacao: accao.slice(3)
                        },
                        success:()=>{
                            exibirMarcacao()
                        }
                    })
                }
                else {

                }
            }
            else {

            }
        },
        mouseleave:(elemento)=>{
            let accao = elemento.target.id
            $("td.campo"+accao.slice(3)+" p").fadeOut(0)
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
    $("#tituloModal").text('Marcar Paciente')
    document.querySelector('.view').showModal()
    $(".texto").css({borderBottom:'1px solid  #e1c5c5'})
    numeroBilhete.readOnly=false;
    col_lim.style.display='block'

    $("#Limpar").click()
}
function Actualizar(){
    let erro="";


    if (dataMarcacao.value==='' || horaMarcacao.value==='' || idMarcacao.value===''){
        erro='Preencha Todos Campos'
    }

    if (erro!==''){
        exibirMensagem(erro,500,6000)

    }
    else {
        let dados = {
            Data:dataMarcacao.value,
            Hora:horaMarcacao.value,
            ID: idMarcacao.value,
            Actulizar: true
        }

        $.ajax({
            url: '../../ajax/ajax-marcacao.php',
            type: 'POST',
            data: dados,
            success: (Mensagem) => {
                exibirMensagem(Mensagem, 500, 4000)
                document.getElementById('Limpar').click()
                exibirMarcacao()
            }

        })
    }
}
$(()=> {
    $("#numeroBilhete").keyup(() => {
        if (numeroBilhete.value.length === 14) {


            $.ajax({
                url: '../../ajax/ajax-paciente.php',
                type: 'POST',
                data: {
                    NBI: numeroBilhete.value,
                    Pesquisar: true
                },
                success: (informacoes) => {
                    informacoes = JSON.parse(informacoes)
                    nome = informacoes['nomeCompleto']
                    datanas = informacoes['dataNascimento']
                    $("#nomeCompleto").val(nome)
                    $("#dataNascimento").val(datanas)

                    Adicionar.disabled = false
                }
            })
        } else {
            nomeCompleto.value = ''
            dataNascimento.value = ''
            Adicionar.disabled = true
        }
    })
})
function pesquisarMarcacao(){
    let dados={
        PesquisarMarc: true,
        infor:$("#PesCol").val()
    }

    $.ajax({
        url:'../../ajax/ajax-marcacao.php',
        type:'POST',
        data:dados,
        success:(Mensagem)=>{
            Mensagem=JSON.parse(Mensagem)
            let tabela="<tr>" +
                "<th>Nome Completo</th>" +
                "<th>Nº Bilhete</th>" +
                "<th>Género</th>" +
                "<th>Data Marcação</th>" +
                "<th>Hora Marcação</th>" +
                "<th>#</th>"+
                "</tr>"

            for(i=0;i<Mensagem.length; i++){
                tabela+="<tr>" +
                    "<td>"+Mensagem[i]['nomeCompleto']+"</td>" +
                    "<td>"+Mensagem[i]['numeroBilhete']+"</td>" +
                    "<td>"+Mensagem[i]['genero']+"</td>" +
                    "<td>"+Mensagem[i]['datamarcacao']+"</td>" +
                    "<td>"+Mensagem[i]['horamarcacao']+"</td>" +
                    "<td class='campo"+Mensagem[i]['idmarcacao']+"'><img src='../../img/icones/actualizar.png' id='act"+Mensagem[i]['idmarcacao']+"' class='icone-paciente'>" +
                    "<img src='../../img/icones/eliminar.png' class='icone-paciente' id='elm"+Mensagem[i]['idmarcacao']+"'>" +
                    "<a target='_blank' href='../../"+Mensagem[i]['comprovativo']+"'><img src='../../img/icones/print_144px.png' class='icone-paciente'</a>"+
                    "<p>Elimin</p>" +
                    "</td>" +
                    "</tr>"
            }



            $(".tabelaPaciente").html(tabela)
            addEventos()
        }

    })

}
$(()=>{
    $("#PesCol").keyup(()=>{
        pesquisarMarcacao()
    })
})