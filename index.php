<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>

<!--
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
-->

<!------ Include the above in your HEAD tag ---------->
<style>
body {
  font-family: 'Montserrat', sans-serif;
  transition: 3s;
}

.login-container {
  margin-top: 10%;
  border: 1px solid #CCD1D1;
  border-radius: 5px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  max-width: 50%;
}

.ads {
 
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
  color: #fff;
  padding: 15px;
  text-align: center;
}

.ads h1 {
  margin-top: 20%;
}

#fl {
  font-weight: 600;
}

#sl {
  font-weight: 100 !important;
}

.profile-img {
  text-align: center;
}

.profile-img img {
  border-radius: 50%;
  /* animation: mymove 2s infinite; */
}

@keyframes mymove {
  from {border: 1px solid #F2F3F4;}
  to {border: 8px solid #F2F3F4;}
}

.login-form {
  padding: 15px;
}

.login-form h3 {
  text-align: center;
  padding-top: 15px;
  padding-bottom: 15px;
}

.form-control {
  font-size: 14px;
}

.forget-password a {
  font-weight: 500;
  text-decoration: none;
  font-size: 14px;
}




</style>
<body>
    <div class="container login-container">
      <div class="row">
        <div class="col-md-6 ads">
          <br>
          <h1><span id="fl"><img src="logo.png" width="100%" alt=""></span></h1>
        </div>
        <div class="col-md-6 login-form">
          <div class="profile-img">
            
          </div>
          <h3>Bienvenido</h3>
                <form method="POST"  action="session_init.php" autocomplete="off">
                <div class="form-group">
                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Username">
                </div>
                <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                <?php
                if(isset($_GET["error"])) {
                //echo "<div class='error'>Usuario y / o Contraseña erroneos. Intentelo de nuevo.</div>";

                  echo '
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong> ERROR ! </strong>Usuario y / o Contraseña erroneos. Intentelo de nuevo.
                          </div>
                   ';

                }
                ?>
                <input type="submit" value="Accesar" name="enviar" class="btn btn-primary btn-lg btn-block" />
                </div>

                </form>
        </div>
      </div>
    </div>