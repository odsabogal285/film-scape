{{-- @extends('adminlte::auth.login') --}}
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background: #444;
    }
    .container {
        position: relative;
        width: 70vw;
        height: 80vh;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }
    .container::before {
        content: "";
        position: absolute;
        top: 0;
        left: -50%;
        width: 100%;
        height: 100%;
        background: linear-gradient(-45deg, #005b96, #0077ad);
        z-index: 6;
        transform: translateX(100%);
        transition: 1s ease-in-out;
    }
    .signin-signup {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-around;
        z-index: 5;
    }
    form {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 40%;
        min-width: 238px;
        padding: 0 10px;
    }
    form.sign-in-form {
        opacity: 1;
        transition: 0.5s ease-in-out;
        transition-delay: 1s;
    }
    form.sign-up-form {
        opacity: 0;
        transition: 0.5s ease-in-out;
        transition-delay: 1s;
    }
    .title {
        font-size: 35px;
        color: #ff5b08;
        margin-bottom: 10px;
    }
    .input-field {
        width: 100%;
        height: 50px;
        background: #f0f0f0;
        margin: 10px 0;
        border: 2px solid #ff5b08;
        border-radius: 50px;
        display: flex;
        align-items: center;
    }
    .input-field i {
        flex: 1;
        text-align: center;
        color: #666;
        font-size: 18px;
    }
    .input-field input {
        flex: 5;
        background: none;
        border: none;
        outline: none;
        width: 100%;
        font-size: 18px;
        font-weight: 600;
        color: #444;
    }
    .btn {
        width: 150px;
        height: 50px;
        border: none;
        border-radius: 50px;
        background: #ff5b08;
        color: #fff;
        font-weight: 600;
        margin: 10px 0;
        text-transform: uppercase;
        cursor: pointer;
    }
    .btn:hover {
        background: #0f1120;
    }
    .social-text {
        margin: 10px 0;
        font-size: 16px;
    }
    .social-media {
        display: flex;
        justify-content: center;
    }
    .social-icon {
        height: 45px;
        width: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #444;
        border: 1px solid #444;
        border-radius: 50px;
        margin: 0 5px;
    }
    a {
        text-decoration: none;
    }
    .social-icon:hover {
        color: #ff5b08;
        border-color: #ff5b08;
    }
    .panels-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }
    .panel {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        width: 35%;
        min-width: 238px;
        padding: 0 10px;
        text-align: center;
        z-index: 6;
    }
    .left-panel {
        pointer-events: none;
    }
    .content {
        color: #fff;
        transition: 1.1s ease-in-out;
        transition-delay: 0.5s;
    }
    .panel h3 {
        font-size: 24px;
        font-weight: 600;
    }
    .panel p {
        font-size: 15px;
        padding: 10px 0;
    }
    .image {
        width: 100%;
        transition: 1.1s ease-in-out;
        transition-delay: 0.4s;
    }
    .left-panel .image,
    .left-panel .content {
        transform: translateX(-200%);
    }
    .right-panel .image,
    .right-panel .content {
        transform: translateX(0);
    }
    .account-text {
        display: none;
    }
    /*Animation*/
    .container.sign-up-mode::before {
        transform: translateX(0);
    }
    .container.sign-up-mode .right-panel .image,
    .container.sign-up-mode .right-panel .content {
        transform: translateX(200%);
    }
    .container.sign-up-mode .left-panel .image,
    .container.sign-up-mode .left-panel .content {
        transform: translateX(0);
    }
    .container.sign-up-mode form.sign-in-form {
        opacity: 0;
    }
    .container.sign-up-mode form.sign-up-form {
        opacity: 1;
    }
    .container.sign-up-mode .right-panel {
        pointer-events: none;
    }
    .container.sign-up-mode .left-panel {
        pointer-events: all;
    }
    /*Responsive*/
    @media (max-width:779px) {
        .container {
            width: 100vw;
            height: 100vh;
        }
    }
    @media (max-width:635px) {
        .container::before {
            display: none;
        }
        form {
            width: 80%;
        }
        form.sign-up-form {
            display: none;
        }
        .container.sign-up-mode2 form.sign-up-form {
            display: flex;
            opacity: 1;
        }
        .container.sign-up-mode2 form.sign-in-form {
            display: none;
        }
        .panels-container {
            display: none;
        }
        .account-text {
            display: initial;
            margin-top: 30px;
        }
    }
    @media (max-width:320px) {
        form {
            width: 90%;
        }
    }
</style>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link rel="stylesheet" href="styles.css">
        <title>Film Scape</title>
    </head>
    <body style="background: #ffffff">
        <div class="container">
            <div class="signin-signup">
                <form action="login" class="sign-in-form" method="post">
                    @csrf
                    <h2 class="title">Inicio de sesión</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Usuario" name="email">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Contraseña" name="password">
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="submit" value="Inicia sesión" class="btn">
                    <p class="social-text">O inicia sesión con alguna red social</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                    <p class="account-text">¿No tienes una cuenta? <a href="#" id="sign-up-btn2">Registrate</a></p>
                </form>
                <form action="register" class="sign-up-form" method="post">
                    @csrf
                    <h2 class="title">Registrate</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nombre Completo" name="name">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text" placeholder="Email" name="email" >
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Contraseña">
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña">
                    </div>
                    <input type="submit" value="Registrate" class="btn">
                    <p class="social-text">O inicia sesion con alguna red social</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                    <p class="account-text">¿Ya tienes una cuenta? <a href="#" id="sign-in-btn2">Inicia sesión</a></p>
                </form>
            </div>
            <div class="panels-container">
                <div class="panel left-panel">
                    <div class="content">
                        <h3>Accede con un clic</h3>
                        <p>Tu portal personal siempre a un paso</p>
                        <button class="btn" id="sign-in-btn">Inicia sesión</button>
                    </div>
                    <img src="{{asset('img/9174459_6308-removebg-preview.png')}}" alt="" class="image">
                </div>
                <div class="panel right-panel">
                    <div class="content">
                        <h3>Regístrate fácilmente</h3>
                        <p>Navega con libertad: Tu entrada al mundo comienza aquí</p>
                        <button class="btn" id="sign-up-btn">Registrate</button>
                    </div>
                    <img src="{{asset('img/10819567_4574122-removebg-preview(1).png')}}" alt="" class="image">
                </div>
            </div>
        </div>
    </body>
</html>

<script>
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");
    const sign_in_btn2 = document.querySelector("#sign-in-btn2");
    const sign_up_btn2 = document.querySelector("#sign-up-btn2");
    sign_up_btn.addEventListener("click", () => {
        container.classList.add("sign-up-mode");
    });
    sign_in_btn.addEventListener("click", () => {
        container.classList.remove("sign-up-mode");
    });
    sign_up_btn2.addEventListener("click", () => {
        container.classList.add("sign-up-mode2");
    });
    sign_in_btn2.addEventListener("click", () => {
        container.classList.remove("sign-up-mode2");
    });
</script>
