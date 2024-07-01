$(()=>{
    $.ajax({
        url:'../../ajax/ajax-usuario.php',
        type:'POST',
        data:{
          id:idUser.value,
          pegarFunc:true,
        },
        success:(Mensagem)=>{
            Mensagem=JSON.parse(Mensagem)
            nomeCompleto.value=Mensagem['nomeCompleto']
            numeroBilhete.value=Mensagem['numeroBilhete']
            cargo.value=Mensagem['cargo']
            numeroTelefone.value=Mensagem['numeroTelefone']
            dataNascimento.value=Mensagem['dataNascimento']
            endereco.value=Mensagem['endereco']
            Genero.value=Mensagem['genero']
            email.value=Mensagem['email']
            senha.value=Mensagem['senha']
        }
    })
    document.getElementById('Actualizar').addEventListener('click',()=>{

        if (foto.files!==null && foto.files.length!==0){
            let arquivo=foto.files[0]
            let fd = new FormData()
            fd.append('fotografia',arquivo)
            $.ajax({
                url:'../../ajax/ajax-usuario.php',
                type:'POST',
                processData: false,
                contentType:false,
                dataType:"JSON",
                data:fd,
                success:(Mensagem)=>{
                    if (typeof (Mensagem)==='object'){
                        $.ajax({
                            url: '../../ajax/ajax-usuario.php',
                            type: 'POST',
                            dataType: "JSON",
                            data: {
                                Actualizar: true,
                                id:idUser.value,
                               nome: nomeCompleto.value,
                                nbi:numeroBilhete.value,
                                tel: numeroTelefone.value,
                                datanas: dataNascimento.value,
                                morada:endereco.value,
                                sexo:Genero.value,
                                Email:email.value,
                                Senha:senha.value,
                                Foto:Mensagem[1],
                            },
                            success:(info)=>{
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'bottom-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: 'Informações Salvas Com Sucesso!'
                                })
                            }
                        })

                    }
                    else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: Mensagem
                    })
                    }
                },

            })


        }
        else {
            $.ajax({
                url: '../../ajax/ajax-usuario.php',
                type: 'POST',
                dataType: "JSON",
                data: {
                    Actualizar2: true,
                    id:idUser.value,
                    nome: nomeCompleto.value,
                    nbi:numeroBilhete.value,
                    tel: numeroTelefone.value,
                    datanas: dataNascimento.value,
                    morada:endereco.value,
                    sexo:Genero.value,
                    Email:email.value,
                    Senha:senha.value,
                },
                success:(info)=>{
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Informações Salvas Com Sucesso!'
                    })
                }
            })
        }


    })
})
