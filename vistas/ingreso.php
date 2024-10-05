<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
} else {


  require 'header.php';

  if ($_SESSION['compras'] == 1) {

?>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h1 class="box-title">INGRESOS <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> AGREGAR</button></h1>
                <div class="box-tools pull-right">

                </div>
              </div>
              <!--box-header-->
              <!--centro-->
              <div class="panel-body table-responsive" id="listadoregistros">
                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                  <thead>
                    <th>OPCIONES</th>
                    <th>FECHA</th>
                    <th>PROVEEDOR</th>
                    <th>USUARIO</th>
                    <th>DOCUMENTO</th>
                    <th>NUMERO</th>
                    <th>TOTAL COMPRA</th>
                    <th>ESTADO</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>OPCIONES</th>
                    <th>FECHA</th>
                    <th>PROVEEDOR</th>
                    <th>USUARIO</th>
                    <th>DOCUMENTO</th>
                    <th>NUMERO</th>
                    <th>TOTAL COMPRA</th>
                    <th>ESTADO</th>
                  </tfoot>
                </table>
              </div>
              <div class="panel-body" id="formularioregistros">
                <form action="" name="formulario" id="formulario" method="POST">
                  <div class="form-group col-lg-8 col-md-8 col-xs-12">
                    <label for="">PROVEEDOR(*):</label>
                    <input class="form-control" type="hidden" name="idingreso" id="idingreso">
                    <select name="idproveedor" id="idproveedor" class="form-control selectpicker" data-live-search="true" required>

                    </select>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-xs-12">
                    <label for="">FECHA(*): </label>
                    <input class="form-control" type="date" name="fecha_hora" id="fecha_hora" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-xs-12">
                    <label for="">TIPO COMPROBANTE(*): </label>
                    <select name="tipo_comprobante" id="tipo_comprobante" class="form-control selectpicker" required>
                      <option value="Factura">FACTURA</option>
                      <option value="Ticket">TICKET</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-xs-6">
                    <label for="">SERIE: </label>
                    <input class="form-control" type="text" name="serie_comprobante" id="serie_comprobante" maxlength="7" placeholder="Serie">
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-xs-6">
                    <label for="">NUMERO: </label>
                    <input class="form-control" type="text" name="num_comprobante" id="num_comprobante" maxlength="10" placeholder="Número" required>
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-xs-6">
                    <label for="">IMPUESTO: </label>
                    <input class="form-control" type="text" name="impuesto" id="impuesto">
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a data-toggle="modal" href="#myModal">
                      <button id="btnAgregarArt" type="button" class="btn btn-primary"><span class="fa fa-plus"></span>AGREGAR</button>
                    </a>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                      <thead style="background-color:#A9D0F5">
                        <th>OPCIONES</th>
                        <th>SUELA</th>
                        <th>STOCK</th>
                        <th>CANTIDAD</th>
                        <th>PRECIO COMPRA</th>
                        <th>PRECIO VENTA</th>
                        <th>SUBTOTAL</th>
                        <th>ACCION</th>
                      </thead>
                      <tbody>

                      </tbody>
                      <tfoot>
                        <th>
                          <ul style="list-style:none">
                            <li>SUB TOTAL</li>
                            <li id="inpuesto_name">Impuesto(12%)</li>
                            <li>TOTAL</li>
                          </ul>
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>
                          <ul style="list-style:none">
                            <li id="_subtotal">Q. 0.00</li>
                            <li id="_impuesto">Q. 0.00</li>
                            <li id="total">Q. 0.00</li>
                          </ul>
                          <input type="hidden" name="total_compra" id="total_compra">
                        </th>
                        <th></th>
                      </tfoot> 
                    </table>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-Success" type="submit" id="btnGuardar"><i class="fa fa-save"></i> GUARDAR</button>
                    <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i class="fa fa-arrow-circle-left"></i> CANCELAR</button>
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

    <!--Modal-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">SELECCIONE ARTICULO</h4>
          </div>
          <div class="modal-body">
            <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>OPCIONES</th>
                <th>SUELA</th>
                <th>HORMA</th>
                <th>CODIGO</th>
                <th>STOCK</th>
                <th>IMAGEN</th>
              </thead>
              <tbody>

              </tbody>
              <tfoot>
                <th>OPCIONES</th>
                <th>SUELA</th>
                <th>HORMA</th>
                <th>CODIGO</th>
                <th>STOCK</th>
                <th>IMAGEN</th>
              </tfoot>
            </table>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" type="button" data-dismiss="modal">CERRAR</button>
          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal-->
  <?php
  } else {
    require 'noacceso.php';
  }

  require 'footer.php';
  ?>
  <script src="scripts/ingreso.js"></script>
<?php
}

ob_end_flush();
?>