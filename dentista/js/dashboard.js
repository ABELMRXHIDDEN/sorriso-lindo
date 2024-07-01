let valores=[25, 50]
let valores1=[10, 20, 40, 40, 10, 50,40, 20, 30, 10, 20, 40]
let a;
let b;
let tipo='pie'
$(()=>{
    tempoReal()
    $.ajax({
        url: '../../ajax/ajax-paciente.php',
        type: 'POST',
        data: {
            Dashboard: true,
        },
        success: (Mensagem) => {
            pacientesCadastrados.innerText = Mensagem;
            hoje = new Date();
            data = hoje.getDate() + "/0" + (hoje.getMonth() + 1) + "/" + hoje.getFullYear()
            marc.innerText += " " + data
        }
    })
    setInterval(tempoReal,2000)
})
function tempoReal(){
    $.ajax({
        url:'../../ajax/ajax-marcacao.php',
        type: 'POST',
        data:{
            Marchoje: true,
        },
        success:(Mensagem)=>{
            Mensagem=JSON.parse(Mensagem)
            marcQtd.innerText=Mensagem;
        }
})
    $.ajax({
        url:'../../ajax/ajax-marcacao.php',
        type: 'POST',
        data:{
            PacienteAtendido: true,
        },
        success:(Mensagem)=>{
            Mensagem=JSON.parse(Mensagem)
            qtdAt.innerText=Mensagem;
        }
    })
        $.ajax({
            url:'../../ajax/ajax-marcacao.php',
            type: 'POST',
            data:{
                TodasMarc: true,
            },
            success:(Mensagem)=>{
                Mensagem=JSON.parse(Mensagem)
                todasmar.innerText=Mensagem;
            }
        })
    }
$(()=>{
    btnMarcacaoHoje.addEventListener('click',()=>{
window.location.href="view-marcacoes-hoje.php"
    })

})
$(()=>{
    const ctx = document.getElementById('myChart');

   a= new Chart(ctx, {
        type: tipo,
        data: {
            labels: ['Atendidos Hoje', 'Agurdando Atendimento'],
            datasets: [{
                label: 'Total',
                data: valores,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    const ctx2 = document.getElementById('myChart2');

    b= new Chart(ctx2, {
        type: 'line',
        data: {
            labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            datasets: [{
                label: 'Pacientes Cadastrados',
                data: valores1,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    setInterval(exibirMarcacao,2000)
    setInterval(paciente,2000)


})

    function exibirMarcacao(){
        $.ajax({
            url:'../../ajax/ajax-marcacao.php',
            type:'POST',
            data:{
                grafico1: true
            },
            dataType:"JSON",
            success:(Mensagem)=>{
                valores[0]=Mensagem[0]
                valores[1]=Mensagem[1]
                a.update()
            }


        })
    }
function paciente(){
    let dados={
        exibirPacientes: true
    }

    $.ajax({
        url:'../../ajax/ajax-paciente.php',
        type:'POST',
        data:dados,
        success:(Mensagem)=>{
            Mensagem=JSON.parse(Mensagem)

            let m1=0;
            let m2=0;
            let m3=0;
            let m4=0;
            let m5=0
            let m6 =0;
            let m7=0;
            let m8=0;
            let m9=0;
            let m10=0;
            let m11=0
            let m12 =0;
            for (let i=0; i<Mensagem.length; i++){
                if(new Date(Mensagem[i]['datamarcacao']).getMonth()===0){
                    m1++;
                }
                else if (new Date(Mensagem[i]['dataCadastro']).getMonth()===1){
                    m2++;
                }
                else if (new Date(Mensagem[i]['dataCadastro']).getMonth()===2){
                    m3++;
                }else if (new Date(Mensagem[i]['dataCadastro']).getMonth()===3){
                    m4++;
                }
                else if (new Date(Mensagem[i]['dataCadastro']).getMonth()===4){
                    m5++;
                }
                else if (new Date(Mensagem[i]['dataCadastro']).getMonth()===5){
                    m6++;
                }else if (new Date(Mensagem[i]['dataCadastro']).getMonth()===6){
                    m7++;
                }
                else if (new Date(Mensagem[i]['dataCadastro']).getMonth()===7){
                    m8++;
                }
                else if (new Date(Mensagem[i]['dataCadastro']).getMonth()===8){
                    m9++;
                }else if (new Date(Mensagem[i]['dataCadastro']).getMonth()===9){
                    m10++;
                }
                else if (new Date(Mensagem[i]['dataCadastro']).getMonth()===10){
                    m11++;
                }
                else if (new Date(Mensagem[i]['dataCadastro']).getMonth()===11){
                    m12++;
                }

            }

            valores1[0]=m1;
            valores1[1]=m2;
            valores1[2]=m3;
            valores1[3]=m4;
            valores1[4]=m5;
            valores1[5]=m6;
            valores1[6]=m7;
            valores1[7]=m8;
            valores1[8]=m9;
            valores1[9]=m10;
            valores1[10]=m11;
            valores1[11]=m12;
            b.update()
        }


    })
}
/*$(()=>{
    document.getElementById('btn-pa').addEventListener('click',(e)=>{
        document.querySelector('#btn-pa').style.backgroundColor='var(--blue)'
        document.querySelector('#btn-pa div div').style.color='var(--white)'
    })
})
*/