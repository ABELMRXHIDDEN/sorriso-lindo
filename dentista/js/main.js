
$(()=>{
    let list=document.querySelectorAll('.navegation li');

    function ativeLink(){
        list.forEach(item=>{
            item.classList.remove('hovered')
        })
        this.classList.add('hovered')
    }
    list.forEach((item)=>item.addEventListener('click',ativeLink))
})
$(()=>{
    let navegation=document.querySelector('.navegation');
    let toggle=document.querySelector('.toggle');
    let main=document.querySelector('.main');
    let logotipo=document.querySelector('.logotipo')

    toggle.onclick=()=>{
        navegation.classList.toggle('active')
        main.classList.toggle('active')
        logotipo.classList.toggle('active')
    }
})
$(()=>{
    let dashboard=document.querySelector('#Dashboard')
    dashboard.addEventListener('click',()=>{
        let frame=$(".views")
        frame.attr('src','http://'+document.location.host+'/dentista/views/view-dashboard.php')
        $(".search").fadeOut(400)
    })
})
$(()=>{
    let dashboard=document.querySelector('#definicoes')
    dashboard.addEventListener('click',()=>{

        let frame=$(".views")
        frame.attr('src','http://'+document.location.host+'/dentista/views/view-definicoes.php')
    })
})
$(()=>{
    logout.onclick=()=>{
        $.ajax({
            url:"../../ajax/ajax-login.php",
            type:"POST",
            data:{
                Logout:true,
            },
            success:()=>{
                window.location.reload();
            }
        })
    }


})
$(()=>{
    $("#FotoPerfil").on({
        mouseleave:()=>{
            $("#nomeUser").fadeOut(400)

        },
        mouseover:()=>{
            $("#nomeUser").fadeIn(100)

        },
        click:()=>{
            let dashboard=document.querySelector('#definicoes')


            let frame=$(".views")
            frame.attr('src','http://'+document.location.host+'/recepcao/views/view-definicoes.php')
        }
    })
    infoUser()
})
$(()=>{
    setInterval(infoUser,2000)
})
function infoUser(){
    $.ajax({
        url:'../../ajax/ajax-usuario.php',
        type:'POST',
        data:{
            id:idU.value,
            pegarFunc:true,
        },
        success:(Mensagem)=>{
            Mensagem=JSON.parse(Mensagem)
            nomeUser.innerText=Mensagem['nomeCompleto']
            //cargo.value=Mensagem['cargo']
            foto=Mensagem['foto']
            if (foto!==null){
                FotoPerfil.src="http://"+location.host+"/"+foto;
            }


        }
    })
}