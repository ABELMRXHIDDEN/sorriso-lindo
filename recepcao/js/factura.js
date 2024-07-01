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
                        url:"../../ajax/ajax-factura.php",
                        type:"POST",
                        data :{

                            ActPag:true,
                            Id: numeroBilhete.value,

                        },
                        success:(sms)=>{
                            document.querySelector(".view").close()
                            exibirMarcacao()
                            Swal.fire(
                                'Sucesso!',
                                'Pagamento Efectuado Com Sucesso',
                                'success'
                            )
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
        exibirMarcacao: true,
    }

    $.ajax({
        url:'../../ajax/ajax-factura.php',
        type:'POST',
        data:dados,
        success:(Mensagem)=>{
            Mensagem=JSON.parse(Mensagem)
            console.log(Mensagem)
            let tabela="<div class='titulo2'>" +
                "<div class='coluna'>Nome Completo</div>" +
                "<div class='coluna'>Nº Bilhete</div>" +
                "<div class='coluna'>Género</div>" +
                "<div class='coluna'>Data Marcação</div>" +
                "<div class='coluna'>Hora Marcação</div>" +
                "<div class='coluna'>#</div>"+
                "</div>"+
                ""

            for(i=0;i<Mensagem.length; i++)
                if (Mensagem[i]['status']==='1'){
                tabela+="<div class='linha2'>" +
                    "<div class='coluna'>"+Mensagem[i]['nomeCompleto']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['numeroBilhete']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['genero']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['datamarcacao']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['horamarcacao']+"</div>" +
                    "<div class='coluna campo"+Mensagem[i]['idmarcacao']+"'>" +
                    "<a target='_blank' href='../../"+Mensagem[i]['factura']+"'><img id='imp"+Mensagem[i]['idmarcacao']+"' src='../../img/icones/print_144px.png' class='icone-paciente'></a>"+
                    "<p>Imprimir</p>" +
                    "</div>" +
                    "</div>"

                }else{
                    tabela+="<div class='linha2'>" +
                        "<div class='coluna'>"+Mensagem[i]['nomeCompleto']+"</div>" +
                        "<div class='coluna'>"+Mensagem[i]['numeroBilhete']+"</div>" +
                        "<div class='coluna'>"+Mensagem[i]['genero']+"</div>" +
                        "<div class='coluna'>"+Mensagem[i]['datamarcacao']+"</div>" +
                        "<div class='coluna'>"+Mensagem[i]['horamarcacao']+"</div>" +
                        "<div class='coluna campo"+Mensagem[i]['idmarcacao']+"'>" +
                        "<img id='pgr"+Mensagem[i]['idmarcacao']+"' src='../../img/icones/money_96px.png' class='icone-paciente'>"+
                        "<p>Pagar</p>" +
                        "</div>" +
                        "</div>"
                }


            $(".tabelaPaciente").html(tabela)
            addEventos()
        }

    })

}
function addEventos(){

    $(".tabelaPaciente div img").on({
        mouseover:(elemento)=>{
            let accao = elemento.target.id
            if (accao.slice(0, 3) === 'pgr') {
                $("div.campo"+accao.slice(3)+" p").text('Pagar').fadeIn(400)
            } else if (accao.slice(0, 3) === 'imp') {
                $("div.campo"+accao.slice(3)+" p").text('Imprimir').fadeIn(400)
            }
        },
        click:(elemento)=>{
            let accao=elemento.target.id
            if(accao.slice(0,3)==='pgr'){

              dadosFact(accao.slice(3))

                    }

        },
        mouseleave:(elemento)=>{
            let accao = elemento.target.id
            $("div.campo"+accao.slice(3)+" p").fadeOut(0)
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
        exibirMensagem(erro,6000,500)

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
                Swal.fire(
                    'Sucesso!',
                    Mensagem,
                    'success'
                )
                document.getElementById('Limpar').click()
                exibirMarcacao()
                document.getElementById("fechar-cad").click()
            }

        })
    }
}
function dadosFact(idMArc){

            $.ajax({
                url: '../../ajax/ajax-factura.php',
                type: 'POST',
                data: {
                    Id: idMArc,
                    exibirListafac: true
                },
                success: (informacoes) => {

                    informacoes=JSON.parse(informacoes)
                    nome = informacoes['nomeCompleto']
                    datanas = informacoes['dataNascimento']
                    $("#nomeCompleto").val(nome)
                    $("#dataNascimento").val(datanas)
                    dataMarcacao.value=informacoes['datamarcacao']
                    horaMarcacao.value=informacoes['horamarcacao']
                    $("#Total").val(informacoes['total'])
                    $("#numeroBilhete").val(informacoes['idmarcacao'])
                    Adicionar.disabled = false
                    console.log(informacoes)

                    Pay.showModal()
                }
            })

    }
function pesquisarMarcacao(){
    if($("#PesCol").val()!==""){
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
            let tabela="<div class='titulo2'>" +
                "<div class='coluna'>Nome Completo</div>" +
                "<div class='coluna'>Nº Bilhete</div>" +
                "<div class='coluna'>Género</div>" +
                "<div class='coluna'>Data Marcação</div>" +
                "<div class='coluna'>Hora Marcação</div>" +
                "<div class='coluna'>#</div>"+
                "</div>"+
                ""

            for(i=0;i<Mensagem.length; i++){
                tabela+="<div class='linha2'>" +
                    "<div class='coluna'>"+Mensagem[i]['nomeCompleto']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['numeroBilhete']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['genero']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['datamarcacao']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['horamarcacao']+"</div>" +
                    "<div class='coluna campo"+Mensagem[i]['idmarcacao']+"'><img src='../../img/icones/actualizar.png' id='act"+Mensagem[i]['idmarcacao']+"' class='icone-paciente'>" +
                    "<img src='../../img/icones/eliminar.png' class='icone-paciente' id='elm"+Mensagem[i]['idmarcacao']+"'>" +
                    "<a target='_blank' href='../../"+Mensagem[i]['comprovativo']+"'><img src='../../img/icones/print_144px.png' class='icone-paciente'></a>"+
                    "<p>Elimin</p>" +
                    "</div>" +
                    "</div>"
            }



            $(".tabelaPaciente").html(tabela)
            addEventos()
        }


    })
    }
    else {
        exibirMarcacao()
    }
}
$(()=>{
    $("#PesCol").keyup(()=>{
        pesquisarMarcacao()
    })
})