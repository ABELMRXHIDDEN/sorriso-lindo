let biAct=""
    $(()=>{

     exibirPaciente()


    $("#exibirCadastro").on({
        click:()=>{
            viewCadastrar()
        },
        mouseover:()=>{
            $("#sms-cadas").text('Adicionar Pacientes').fadeIn(400)
        },
        mouseleave: ()=>{
            $("#sms-cadas").text('Adicionar Pacientes').fadeOut(0)
        }
    })
    $("#Cadastrar").click(Cadastrar)
    $("#PesCol").keyup(()=>{

        pesquisarPaciente()
    })
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
        $.ajax({
            url:'../../ajax/ajax-paciente.php',
            type:'POST',
            data:{
                verificarBi:true,
                NBI:nbi,
            },
            success:(sms)=>{
                sms=JSON.parse(sms)
                if(sms!==true){
                    $("#numeroBilhete").css({borderBottom:'1.5px solid red'})
                    erro+=" Nº de bilhete já foi usado em outro Cadastro"
                }
            }
        })
        const regexNome = /^[a-zA-ZÀ-ÖØ-öø-ÿ]+([\-'\s][a-zA-ZÀ-ÖØ-öø-ÿ]+)*$/;
        const regexBilhete = /^[0-9]{6}[0-3][0-9][0-1][0-9][0-9]{2}[0-9]{3}[A-Z]$/;
        const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const regexTelefone = /^[29]\d{8}$/;
        const regexEndereco = /^[A-Za-z]+\s\d+(?:\s[A-Za-z]+){0,2}(?:,\s[A-Za-z]+)?$/;


        if (nome.length<9 || !regexNome.test(nome)){
            erro+="Nome Completo |"
            $("#nomeCompleto").css({borderBottom:'1.5px solid red'})
        }
        if (nbi.length!==14 || regexBilhete.test(nbi)){
            erro+="Nº Bilhete |"
            $("#numeroBilhete").css({borderBottom:'1.5px solid red'})
        }
        if (endereco.length<12){
            erro+="Endereco |"
            $("#endereco").css({borderBottom:'1.5px solid red'})
        }
        if (tel.length!==9 || !regexTelefone.test(tel)){
            erro+="Nº de Telefone |"
            $("#numeroTelefone").css({borderBottom:'1.5px solid red'})
        }
        if (email.length<9 || !regexEmail.test(email)){
            erro+="Email |"
            $("#Email").css({borderBottom:'1.5px solid red'})
        }

    }
    if (erro!==''){
        exibirMensagem(erro,500,6000)

    }
    else {
        let dados={
            Nome:nome,
            NBI:nbi,
            Sexo: genero,
            Tel:tel,
            Endereco: endereco,
            Email: email,
            dataNascimento: datanas,
            Adicionar: true
        }

        $.ajax({
            url:'../../ajax/ajax-paciente.php',
            type:'POST',
            data:dados,
            success:(Mensagem)=>{
                exibirMensagem(Mensagem,500,4000)
                document.getElementById('Limpar').click()
                document.getElementById('fechar-cad').click()
                exibirPaciente()
        
                Swal.fire(
                  'Sucesso!',
                  'Paciente Cadastrado Com Sucesso!',
                  'success'
                )
            }

        })

}
}
function exibirMensagem(mensagem,transicao,tempoExibicao){
    $(".Mensagem").text(mensagem).fadeIn(transicao).animate({right: '0px'})
    setTimeout(()=>{
        $(".Mensagem").animate({right: '-450px'},{duration:2000}).fadeOut(transicao)
    },tempoExibicao)

}

function exibirPaciente(){
    $("#PesCol").val('')
    let dados={
        exibirPacientes: true
    }

    $.ajax({
        url:'../../ajax/ajax-paciente.php',
        type:'POST',
        data:dados,
        success:(Mensagem)=>{

            Mensagem=JSON.parse(Mensagem)
            let tabela="<div class='titulo'>" +
                "<div class='coluna'>Nome Completo</div>" +
                "<div class='coluna'>Nº Bilhete</div>" +
                "<div class='coluna'>Género</div>" +
                "<div class='coluna'>Nº Telefone</div>" +
                "<div class='coluna'>#</div>"+
                "</div>"+
                ""

            for(i=0;i<Mensagem.length; i++){
                tabela+="<div class='linha'>" +
                    "<div class='coluna'>"+Mensagem[i]['nomeCompleto']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['numeroBilhete']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['genero']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['numeroTelefone']+"</div>" +
                    "<div class='coluna campo"+Mensagem[i]['numeroBilhete']+"'><img src='../../img/icones/actualizar.png' id='act"+Mensagem[i]['numeroBilhete']+"' class='icone-paciente'>" +
                    "<img src='../../img/icones/eliminar.png' class='icone-paciente' id='elm"+Mensagem[i]['numeroBilhete']+"'>" +
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

    $(".tabelaPaciente .coluna img").on({
        mouseover:(elemento)=>{
            let accao = elemento.target.id
            if (accao.slice(0, 3) === 'act') {
                $(".campo"+accao.slice(3)+" p").text('Actualizar').fadeIn(400)
            } else if (accao.slice(0, 3) === 'elm') {
                $(".campo"+accao.slice(3)+" p").text('Eliminar').fadeIn(400)
            }
        },
        click:(elemento)=>{
            let accao=elemento.target.id
            if(accao.slice(0,3)==='act'){
                $.ajax({
                    url:'../../ajax/ajax-paciente.php',
                    type:'POST',
                    data:{
                        NBI:accao.slice(3),
                        Pesquisar:true
                    },
                    success:(informacoes)=>{
                       informacoes= JSON.parse(informacoes)
                        nome=informacoes['nomeCompleto']
                        nbi=informacoes['numeroBilhete']
                        datanas=informacoes['dataNascimento']
                        email=informacoes['email']
                        tel=informacoes['numeroTelefone']
                        genero=informacoes['genero']
                        endereco=informacoes['endereco']
                        $("#nomeCompleto").val(nome)
                        $("#numeroBilhete").val(nbi)
                        $("#dataNascimento").val(datanas)
                        $("#Genero").val(genero)
                        $("#endereco").val(endereco)
                        $("#Email").val(email)
                        $("#numeroTelefone").val(tel)

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
                            'Dados do Paciente Foram Eliminados.',
                            'success'
                        )
                        $.ajax({
                            url:'../../ajax/ajax-paciente.php',
                            type:'post',
                            data:{
                                Eliminar:true,
                                NBI: accao.slice(3)
                            },
                            success:()=>{
                                exibirPaciente()
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
                alert("Erro!")
            }
    },
        mouseleave:(elemento)=>{
            let accao = elemento.target.id
                $(".campo"+accao.slice(3)+" p").fadeOut(0)
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
            let tabela="<div class='titulo'>" +
                "<div class='coluna'>Nome Completo</div>" +
                "<div class='coluna'>Nº Bilhete</div>" +
                "<div class='coluna'>Género</div>" +
                "<div class='coluna'>Nº Telefone</div>" +
                "<div class='coluna'>#</div>"+
                "</div>"+
                ""

            for(i=0;i<Mensagem.length; i++){
                tabela+="<div class='linha'>" +
                    "<div class='coluna'>"+Mensagem[i]['nomeCompleto']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['numeroBilhete']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['genero']+"</div>" +
                    "<div class='coluna'>"+Mensagem[i]['numeroTelefone']+"</div>" +
                    "<div class='coluna campo"+Mensagem[i]['numeroBilhete']+"'><img src='../../img/icones/actualizar.png' id='act"+Mensagem[i]['numeroBilhete']+"' class='icone-paciente'>" +
                    "<img src='../../img/icones/eliminar.png' class='icone-paciente' id='elm"+Mensagem[i]['numeroBilhete']+"'>" +
                    "<p>Elimin</p>" +
                    "</div>" +
                    "</div>"
            }


          $(".tabelaPaciente").html(tabela)
addEventos()
        }

    })

}