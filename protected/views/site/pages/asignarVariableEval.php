<?php 

if (!isset(Yii::app()->user->id)) {
  header('Location: index.php?r=site/login');
}
?>

<h1>Asignación de Variables a Empresas</h1>
<hr>
<div class="row">
  <!-- <form name="formulario" action="funciones/post_asignarVariable.php" method="POST" enctype="multipart/form-data"> -->
  <!-- <form name="formulario" action="" method="POST" enctype="multipart/form-data"> -->
  <form id="formulario_asignacion" method="POST">
    <div class="col-md-6 col-sm-12">
    <!-- Select para seleccionar la empresa -->
      <div class="form-group">
        <label for="">Nombre EESS</label>
        <select class="form-control" name="eess_rut">
          <?php
          $eess = Yii::app()->db->createCommand("SELECT eess_rut, eess_nombre_corto FROM min_eess where eess_estado = 1")->query()->readAll();
          foreach ($eess as $key => $value) {
            ?>
            <option value="<?php echo $value['eess_rut']; ?>">
              <?php echo $key . ' - ' . $value['eess_nombre_corto']; ?>
            </option>
          <?php 
        }
        ?>
        </select>
      </div>
    </div>

    <div class="col-md-6 col-sm-12">
    <!-- Select para seleccionar multiples variables de evaluación -->
      <div class="form-group">
        <label for="var_id">Variables Evaluación</label>
        <select multiple class="form-control" name="var_id[]">
          <?php
          $eess = Yii::app()->db->createCommand("SELECT var_id, var_nombre FROM min_variable_evaluacion WHERE eess_rut = 76458497 ORDER BY var_nombre")->query()->readAll();
          foreach ($eess as $key => $value) {
            ?>
            <option value="<?php echo $value['var_id']; ?>">
              <?php echo ($key + 1) . ' - ' . $value['var_nombre']; ?>
            </option>
          <?php 
        }
        ?>
          </select>
      </div>
    </div>

    <div class="col-12" style="float: right; margin-right: 1em;">
        <button class="btn btn-primary" type="submit">Guardar</button>
    </div>
  </form>
  <p style="display: none;" id="notification">Thank You!</p>

  <script>
    $(document).ready( function() {
      $('#formulario_asignacion').on('submit', function(e) {
        e.preventDefault();

        // Espacio para algún loader

        // Llamada AJAX
        $.ajax({
          type: 'POST',                                 // Método de envío de datos
          url: 'funciones/post_asignarVariable.php',    // Se conecta al controlador
          data: $(this).serialize()                     // Obtener datos del formulario
          
        }).done(function(data) {                        // Obtiene datos desde el controlador
          
        }).fail(function() {                            // Método para controlar fallos

        });

        return false;                                   // Evita la recarga de la página
      });
    });
  </script>
</div>

<br>

<!-- Tabla muestra de variables activas en empresas. -->
<div>
  <table class="table bg-light table-striped table-bordered table-responsive table-inverse">
    <thead class="bg-primary text-white">
      <tr>
        <th>Empresa</th>
        <th>Variables asignadas</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $eess_s = Yii::app()->db->createCommand("SELECT eess_rut, UPPER(eess_nombre_corto) as eess_nombre_corto FROM min_eess where eess_estado = 1 ORDER BY eess_nombre_corto")->query()->readAll();
    foreach ($eess_s as $empresa) {
      ?>
      <tr>
        <td scope="row"><?php echo $empresa['eess_nombre_corto'] ?></td>
        <?php
        $var_Activa = Yii::app()->db->createCommand("SELECT var_id, var_nombre FROM min_variable_evaluacion WHERE eess_rut = 76458497 ORDER BY var_nombre")->query()->readAll();
        ?>
        <td><?php foreach ($var_Activa as $asd) {
              echo $asd['var_nombre'] . '<br/>';
            } ?></td>
        <td></td>
      </tr>
    <?php

  }
  ?>
    </tbody>
  </table>
</div>