let total=0;
let checados="";
let NomePaciente="";
let listaperg=[]
let servicos=[]
$(()=>{
    $.ajax({
        url:"../../ajax/ajax-servicos.php",
        type: "POST",
        data:{
            ExibirSer: true,
        },
        success:(Mensagem)=> {
            Mensagem = JSON.parse(Mensagem)
            let itens=""
            for (let i=0;i<Mensagem.length;i++){
                itens+="" +
                    "<option value='"+Mensagem[i]['idservicos']+"'>"+Mensagem[i]['nome']+"   "+Mensagem[i]['preco']+" Kz</option>"
            }
            opcaoSer.innerHTML=itens
        }
})
})
$(()=>{

    $.ajax({
        url:"../../ajax/ajax-marcacao.php",
        type: "POST",
        data:{
            IdMar:window.location.search.slice(4),
            PegarId: true,
        },
        success:(Mensagem)=>{
            Mensagem=JSON.parse(Mensagem)
            console.log(Mensagem)
            if (Mensagem){
Nome.innerText=Mensagem['nomeCompleto']
idpac.value=Mensagem['idpaciente']

        }
            else {
                Swal.fire(
                    'Erro!',
                    'Actualize a Página',
                    'error'
                )

            }
        }
    })

})
$(()=>{
    document.getElementById('infor-add').addEventListener('click',()=>{
        perguntas.showModal()
    })
    fechar.addEventListener('click',()=>{
        perguntas.close()
    })
    Salvar.addEventListener('click',()=>{

        $.ajax({
            url: "../../ajax/ajax-marcacao.php",
            type:"POST",
            data: {
                PegarIdmarc:true,
                IdMar:window.location.search.slice(4),
            },
            success(Mensagem){
                Mensagem=JSON.parse(Mensagem)
                $.ajax({
                    url:"../../ajax/ajax-paciente.php",
                    type:"POST",
                    data: {
                        Id:Mensagem['idpaciente'],

                    },
                    success:()=>{

                    }
                })
            }
        })
    })

})



$(()=>{
    rel.addEventListener('click',()=>{
        Relatorio.showModal()
    })
    salvarRelatorio.addEventListener('click',()=>{
        $.ajax({
            url: "../../ajax/ajax-factura.php",
            type:"POST",
            data:{
             SalvarRelatorio: true,
            IdDentista:IdUser.value,
            IdMarcacao: window.location.search.slice(4),
            Relatorio: document.getElementById('txt-rel').value
            },
            success(Mensagem){
              if (Mensagem!==false){
                Swal.fire(
                    'Sucesso!',
                    'Relatório Salvo com Sucesso',
                    'success'
                )
                  fechar1.click()
              }
              else {
                Swal.fire(
                    'Erro!',
                    'Erro ao salvar o relatório',
                    'error'
                )
              }


            }
        })
    })

})
$(()=>{
    document.getElementById('fechar1').addEventListener('click',()=>{
        Relatorio.close()
    })
    document.getElementById('fechar2').addEventListener('click',()=>{
        Receita.close()
    })
    md_Rec.addEventListener('click',()=>{
        Receita.showModal()
    })
    qtdRec.addEventListener('keyup',()=>{
        med="";
        for (let i=1;i<=qtdRec.value; i++){
            med+="<div>" +
                "<div class='form-floating'>" +
                "<input type='text' class='form-control' id='md"+i+"'>" +
                "<label>"+i+"º Medicamento</label>"+
                "</div>" +
                "</div>" +
                "<div>" +
                "<div class='form-floating'>" +
                "<input class='form-control' type='number' id='qtd"+i+"'>" +
                "<label>Qtd</label>"+
                "</div>" +
                "</div>" +
                "<div>" +
                "<div class='form-floating'>" +
                "<textarea class='form-control' id='descr"+i+"'></textarea>" +
                "<label>Descrição de Uso</label>" +
                "</div>" +
                "</div>"
        }
        Medicamentos.innerHTML=med;
    })
    Emitir.addEventListener('click',()=>{
        tb="<table cellspacing='0'>" +
            "<tr>" +
            "<th>Medicamentos</th>" +
            "<th>Quantidade</th>" +
            "<th>Descrição</th>" +
            "</tr>" +
            ""
        for (let i=1;i<=qtdRec.value; i++){
            tb+="<tr>" +
                "<td>"+document.getElementById('md'+i).value+"</td>" +
                "<td>"+document.getElementById('qtd'+i).value+"</td>" +
                "<td>"+document.getElementById('descr'+i).value+"</td>" +
                "</tr>"
        }
        let estilo="<style>" +
            "td,th{ padding: 4px 10px;margin:0;text-align: center;border: 1px solid #ddd; border-collapse: collapse}" +
            "" +
            "</style>"
        tb+="</table>"
        win=window.open('','','width=700,height=700')
        win.document.write("<html lang='pt'><head>" +
            "<meta charset='UTF-8'>" +
            "<link rel='stylesheet' href='../../css/boostrap/css/bootstrap.css'>"+
            estilo+
            "</head>")
        win.document.write("<body><div class='modal-header'><h3>Clínica Dentária Sorriso Lindo</h3>")
        win.document.write("<img width='20%' src='http://localhost/img/log2o.png'></div>")
        win.document.write("<h3>Nome Completo: "+NomePaciente+"</h3>")
        win.document.write(tb)
let d=new Date();
        win.document.write("<b>Assinatura Dentista:</b>")
        win.document.write("<div style='position: fixed; border-bottom: 0;' class='modal-footer'>" +
            "<p>Emitido aos"+d.getDate()+"/"+0+(d.getMonth()+1)+"/"+d.getFullYear()+"</p>" +
            "" +
            "</div>")
        win.document.write("</body></html")
        win.print()

    })
})

$(()=>{

    document.querySelector('#add').addEventListener('click',()=>{
        if (document.querySelector('#pergunta-nm').value==='' ||
            opcao.value===''){
                Swal.fire(
                    'Erro!',
                    'Preencha todos Campos',
                    'error'
                )
        }
        else {
        listaperg.unshift({

            Pergunta: document.querySelector('#pergunta-nm').value,

            Resposta: opcao.value});

        renderPergunta()
        document.querySelector('#pergunta-nm').value=''

        }
    })


})
function renderPergunta(){
    tstS()
    let tb=""
    for (let i=0; i<listaperg.length;i++){
        tb+="<div  class=\"caixa-pr\">\n" +
            "                <div class=\"modal-header\">\n" +
            "                    <div class=\"pergunta\">"+listaperg[i].Pergunta+"</div>\n" +
            "                    <button type=\"button\" id='cx"+i+"' class=\"btn-close\"></button>\n" +
            "                </div>\n" +
            "                <div class=\"resposta\">"+listaperg[i].Resposta+"</div>\n" +
            "            </div>"
    }
    document.querySelector('.perg').innerHTML=tb
    addEv()
}
function addEv(){
    $('.btn-close').click((e)=>{
       listaperg.splice((e.target.id).slice(2),1)
        renderPergunta()
    })

}
function tstS(){
    if (listaperg.length>0){
        document.getElementById('Salvar').style.display='block'
    }
    else {
        document.getElementById('Salvar').style.display='none'
    }
}
$(()=>{
    document.querySelector("#Salvar").addEventListener('click',()=>{
        for (let i=0; i<listaperg.length; i++) {
            console.log(listaperg[i].Pergunta)
            console.log(listaperg[i].Resposta)
            $.ajax({
                url: "../../ajax/ajax-paciente.php",
                type:"POST",
                data: {
                    Pergunta: listaperg[i].Pergunta,
                    Resposta: listaperg[i].Resposta,
                    Id: idpac.value,
                    salvRes: true
                }
                ,
                success: (Mensagem)=>{
                    console.log(Mensagem)
            }

            })
            perguntas.close()
            Swal.fire(
                'Sucesso!',
                'Informações Salvas com Sucesso',
                'success'
            )
        }
    })
})



$(()=>{
    terminar.addEventListener('click',()=>{
    
        $.ajax({
            url: "../../ajax/ajax-marcacao.php",
            type: "POST",
            data: {
                Id: window.location.search.slice(4),
                Terminar: true
            }
            ,

            success:()=>{
                for (let i=0;i<servicos.length;i++){
                 total+=parseInt(servicos[i].Preco)
                
                }

            }

        })



        $.ajax({
            url: "../../ajax/ajax-factura.php",
            type: "POST",
            data: {
                IdMar: window.location.search.slice(4),
                EmitirFactura: true,
                Total:total,

            }
            ,

            success:()=>{
                window.location.href="view-marcacoes-hoje.php"

            }

        })
    })
})

$(()=>{
    $(()=>{

        document.querySelector('#add2').addEventListener('click',()=>{
            if (opcaoSer.value===''){
                Swal.fire(
                    'Erro!',
                    'Preencha todos Campos',
                    'error'
                )
            }
            else {
                $.ajax({

                    type:"POST",
                    url:"../../ajax/ajax-servicos.php",
                    data:{
                        Id: opcaoSer.value,
                        ExibirNm:true
                    },
                    success:(Mensagem)=>{
                        Mensagem=JSON.parse(Mensagem)
                            console.log(Mensagem)
                        servicos.unshift({

                            Servico: opcaoSer.value,
                            Qtd: qtdSer.value,
                        Nome: Mensagem['nome'],
                            Preco: Mensagem['preco']*qtdSer.value
                        });
                        total+=Mensagem['preco']*qtdSer.value
                        renderPergunta2()
                      qtdSer.value=''
                    }
                })




            }
        })


    })

})
function renderPergunta2(){
    let tb=""

    for (let i=0; i<servicos.length;i++){



                tb += "<div  class=\"caixa-pr\">\n" +
                    "                <div class=\"modal-header\">\n" +
                    "                    <div class=\"pergunta\">" + servicos[i].Nome + "</div>\n" +
                    "                    <button type=\"button\" id='sr" + i + "' class=\"btn-close\"></button>\n" +
                    "                </div>\n" +
                    "                <div class=\"resposta\">" + servicos[i].Qtd + "x</div>\n" +
                    "            </div>"
            }
            document.querySelector('.srvRes').innerHTML = tb
            addEv()
        }

function addEv2(){
    $('.btn-close').click((e)=>{
        servicos.splice((e.target.id).slice(2),1)
        renderPergunta()
    })

}
$(()=>{
    document.getElementById('Guardar').addEventListener('click',()=>{
        for (let i=0; i<servicos.length;i++){
            $.ajax({
                url: "../../ajax/ajax-factura.php",
                type:"POST",
                data: {
                    addConsulta:true,
                    IdMar:window.location.search.slice(4),
                    Ser:servicos[i].Servico,
                    Qtd:servicos[i].Qtd
                },
                success(Mensagem){
                    Mensagem=JSON.parse(Mensagem)


                    Swal.fire(
                        'Sucesso!',
                        'Serviços Salvos!',
                        'success'
                    )
                    document.querySelector('.srvRes').innerHTML=''
                    renderPergunta2()

                }
            })
        }
    })
})