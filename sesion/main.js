// utilizado para mostrar y ocultar contraseña
const pass = document.getElementById("contrasena");
const icon = document.getElementById("ix");

icon.addEventListener("click",e =>{
    if(pass.type === "password"){
        pass.type = "text";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else{
        pass.type = "password";
        icon.classList.add('fa-eye-slash');
        icon.classList.remove('fa-eye');
    }
});
