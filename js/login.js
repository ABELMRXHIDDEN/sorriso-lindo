$(()=>{
    $(".form-login").keydown((e)=>{
        if (e.which===13){
            Login.click()
        }

    })
    Login.onclick=()=>{
        $.ajax({
            url:"../ajax/ajax-login.php",
            type:"POST",
            data:{
            Email:Email.value,
            Senha: Senha.value,
            },
            success:(Mensagem)=>{
                Mensagem=JSON.parse(Mensagem)
                if(typeof(Mensagem)!=="object") {
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
                else {
                    window.location.reload()
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
                        title: Mensagem[1]
                    })
                }
            }
        })
    }
})



