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
                            document.querySelector(".view").close()
                            exibirMarcacao()
                            Swal.fire(
                                'Sucesso!',
                                sms,
                                'success'
                            )
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
function addEventos(){

    $(".tabelaPaciente div img").on({
        mouseover:(elemento)=>{
            let accao = elemento.target.id
            if (accao.slice(0, 3) === 'act') {
                $("div.campo"+accao.slice(3)+" p").text('Actualizar').fadeIn(400)
            } else if (accao.slice(0, 3) === 'elm') {
                $("div.campo"+accao.slice(3)+" p").text('Eliminar').fadeIn(400)
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
                        console.log(informacoes)
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
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Tem Certeza quem Pretende Eliminar?',
                    text: "Não há maneira de reverter essa accão!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, Eliminar!',
                    cancelButtonText: 'Não, cancelar!',
                    reverseButtons: true
                }).then((result) => {

                    if (result.isConfirmed) {
                        swalWithBootstrapButtons.fire(
                            'Sucesso!',
                            'Dados da Marcação Foram Eliminados.',
                            'success'
                        )
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
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelado',
                            'Os dados Estão Seguros :)',
                            'error'
                        )
                    }
                })
            }
            else {

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