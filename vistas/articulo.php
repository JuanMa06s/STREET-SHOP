<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['almacen']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">SUELAS <button class="btn btn-success" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus-circle"></i>   AGREGAR</button> <a target="_blank" href="../reportes/rptarticulos.php"><button class="btn btn-info ">REPORTE</button></a></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>OPCIONES</th>
      <th>Nombre</th>
      <th>HORMAS</th>
      <th>CODIGO</th>
      <th>STOCK</th>
      <th>IMAGEN</th>
      <th>DESCRIPCION</th>
      <th>ESTADO</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
       <th>OPCIONES</th>
      <th>NOMBRE</th>
      <th>HORMAS</th>
      <th>CODIGO</th>
      <th>STOCK</th>
      <th>IMAGEN</th>
      <th>DESCRIPCION</th>
      <th>ESTADO</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">NOMBRE(*):</label>
      <input class="form-control" type="hidden" name="idarticulo" id="idarticulo">
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="TIPO SUELA" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">HORMA Y TALLA(*):</label>
      <select name="idcategoria" id="idcategoria" class="form-control selectpicker" data-Live-search="true" required></select>
    </div>
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">STOCK</label>
      <input class="form-control" type="number" name="stock" id="stock"  required>
    </div>
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">DESCRIPCION</label>
      <input class="form-control" type="text" name="descripcion" id="descripcion" maxlength="256" placeholder="">
    </div>
        <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">IMAGEN:</label>
      <input class="form-control" type="file" name="imagen" id="imagen">
      <input type="hidden" name="imagenactual" id="imagenactual">
      <img src="" alt="" width="150px" height="120" id="imagenmuestra">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">CODIGO:</label>
      <input class="form-control" type="text" name="codigo" id="codigo" placeholder="CODIGO DEL PRODUCTO" required>
      <button class="btn btn-success" type="button" onclick="generarbarcode()">GENERAR </button>
      <button class="btn btn-info" type="button" onclick="imprimir()">IMPRIMIR</button>
      <div id="print">
        <svg id="barcode"></svg>
      </div>
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
require 'footer.php'
 ?>
 <script src="scripts/articulo.js"></script>
 <script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>

 <?php 
}

ob_end_flush();
  ?>