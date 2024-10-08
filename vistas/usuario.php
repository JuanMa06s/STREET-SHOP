<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['acceso']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">USUARIOS <button class="btn btn-success" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus-circle"></i>AGREGAR</button></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>OPCIONES</th>
      <th>NOMBRE</th>
      <th>DOCUMENTO</th>
      <th>NUMERO DE DOCUMENTO</th>
      <th>TELEFONO</th>
      <th>EMAIL</th>
      <th>LOGIN</th>
      <th>FOTO</th>
      <th>ESTADO</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>OPCIONES</th>
      <th>NOMBRE</th>
      <th>DOCUMENTO</th>
      <th>NUMERO DE DOCUMENTO</th>
      <th>TELEFONO</th>
      <th>EMAIL</th>
      <th>LOGIN</th>
      <th>FOTO</th>
      <th>ESTADO</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-12 col-md-12 col-xs-12">
      <label for="">NOMBRE(*):</label>
      <input class="form-control" type="hidden" name="idusuario" id="idusuario">
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">TIPO DE DOCUMENTO(*):</label>
     <select name="tipo_documento" id="tipo_documento" class="form-control select-picker" required>
       <option value="DPI">DPI</option>
     </select>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">NUMERO DE DOCUMENTO(*):</label>
      <input type="text" class="form-control" name="num_documento" id="num_documento" placeholder="Documento" maxlength="20">
    </div>
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">DIRECCION</label>
      <input class="form-control" type="text" name="direccion" id="direccion"  maxlength="70">
    </div>
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">TELEFONO</label>
      <input class="form-control" type="text" name="telefono" id="telefono" maxlength="20" placeholder="NUMERO DE TELEFONO">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">EMAIL: </label>
      <input class="form-control" type="email" name="email" id="email" maxlength="70" placeholder="EMAIL">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">CARGO</label>
      <select name="cargo" id="cargo" class="form-control select-picker" required>
       <option value="vendedor">VENDEDOR</option>
       <option value="comprador">COMPRADOR</option>
       <option value="admin">ADMIN</option>
       </select>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">LOGIN(*):</label>
      <input class="form-control" type="text" name="login" id="login" maxlength="20" placeholder="NOMBRE DE USUARIO" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">CONTRASEÑA(*):</label>
      <input class="form-control" type="password" name="clave" id="clave" maxlength="64" placeholder="Clave">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label>PERMISOS</label>
      <ul id="permisos" style="list-style: none;">
        
      </ul>
    </div>
        <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">IMAGEN:</label>
      <input class="form-control" type="file" name="imagen" id="imagen">
      <input type="hidden" name="imagenactual" id="imagenactual">
      <img src="" alt="" width="150px" height="120" id="imagenmuestra">
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  GUARDAR</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> CANCELAR</button>
    </div>
  </form>
</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php';
 ?>
 <script src="scripts/usuario.js"></script>
 <?php 
}

ob_end_flush();
  ?>
