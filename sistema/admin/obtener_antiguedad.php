
	<?php

	  require("../../class/cnmysql.php");

       date_default_timezone_set('America/Mexico_City');
      $fecha_del_dia=date('Y-m-d');//fecha actual 
	   $resultado = $_GET['y'] ;

			$fecha1 = new DateTime($resultado);
			$fecha2 = new DateTime($fecha_del_dia);
			$fecha = $fecha1->diff($fecha2);
			//printf('%d años, %d meses, %d días', $fecha->y, $fecha->m, $fecha->d);
		?>

  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Antiguedad Años</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                         <input  type="text" id="ant_anios" name="ant_anios" placeholder="Antiguedad" value='<?php echo $fecha->y; ; ?>'>Años
                         
                        </div>
                      </div>


                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Antiguedad Meses</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                         <input  type="text" id="ant_mes" name="ant_mes" placeholder="Antiguedad" value='<?php echo  $fecha->m; ;?>'>Meses 
                         
                        </div>
                      </div>

                               <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Antiguedad Dias</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                        <input  type="text" id="ant_dias" name="ant_dias" placeholder="Antiguedad" value='<?php echo  $fecha->d; ;?>'>Dias
                         
                        </div>
                      </div>



<?php
	 $antiguedad = $fecha->y;

		  $sql01 = "SELECT * from tbl_cat_vacaciones where Anios = ".$antiguedad."  ";
                           if($qry01 = $mysqli->query($sql01)) {
                                while($data01 = mysqli_fetch_assoc($qry01)){  
								  $diasant = $data01['Dias'];
								  ?>
									<input  type="text" id="diasvacaciones" name="diasvacaciones" placeholder="Dias Vacaciones" value="<?php echo $diasant; ?>">Dias Vacaciones <br>
									  <?php
								}
						   }

?>
