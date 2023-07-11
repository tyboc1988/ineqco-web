<?php
    require_once "./php/main.php";
    
    $id=(isset($_GET['computer_id_up'])) ? $_GET['computer_id_up'] : 0;
    $id=limpiar_cadena($id);
    $check_inventario=conexion();
        $check_inventario=$check_inventario->query("SELECT * FROM inventario WHERE inventario_id='$id'");
		
        if($check_inventario->rowCount()>0){
            $datos=$check_inventario->fetch();
?>

<div class="container is-fluid mb-2">
	<h1 class="title has-text-centered"><?php echo $datos['serie']?></h1>
	<h2 class="subtitle has-text-centered">ACTUALIZAR EQUIPO</h2>
</div>

<div class="container pb-6 pt-1 has-text-centered">

	<p class="has-text-right pt-4 pb-4">
		<a href="index.php?vista=computer_search" class="button is-link is-rounded btn-back"><- Regresar atrás</a>
	</p>
	<div class="form-rest mb-6 mt-6"></div>
	
	<form action="./php/computer_actualizar.php" method="POST" class="FormularioAjax" autocomplete="ON" >
    <div class="box">

        <input type="hidden" value="<?php echo $datos['inventario_id']?>" name="inventario_id" required >
	
		

		<div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="is-small label">SERIE:</label>
            </div>
            <div class="field-body">
                <div class="field">
                <p class="control">
                <input class="input is-small has-text-centered" type="text" name="serie" value="<?php echo $datos['serie']?>" pattern="[A-Z 0-9/*-+]{0,23}" maxlength="23" oninput="this.value = this.value.toUpperCase()" readonly>
				
                </p>
                </div>
            </div>
        </div>

		<div class="field is-horizontal">
			<div class="field-label is-normal">
				<label class="label">ESTATUS:</label>
			</div>
			<div class="field-body">
				<div class="field">
				<p class="control">
				<input class="input is-small has-text-centered"  type="text" name="estatus" value="<?php echo $datos['estatus']?>"pattern="[A-Z 0-9/*-+.]{0,12}" maxlength="12" oninput="this.value = this.value.toUpperCase()">
				</p>
				</div>
			</div>
		</div>

		<div class="field is-horizontal">
			<div class="field-label is-normal">
				<label class="label">MODELO:</label>
			</div>
			<div class="field-body">
				<div class="field">
				<p class="control">
				<input class="input is-small has-text-centered"  type="text" name="modelo" value="<?php echo $datos['modelo']?>" pattern="[A-Z 0-9/*-+]{0,27}" maxlength="27" oninput="this.value = this.value.toUpperCase()">
				</p>
				</div>
			</div>
		</div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">NOMBRE DEL EQUIPO:</label>
            </div>
            <div class="field-body">
                <div class="field">
                <p class="control">
                <input class="input is-small has-text-centered"  type="text" name="nombre_equipo" value="<?php echo $datos['nombre_equipo']?>" pattern="[A-Z 0-9/*-+]{0,15}" maxlength="15" oninput="this.value = this.value.toUpperCase()">
                </p>
                </div>
            </div>
        </div>

		<div class="field is-horizontal">
			<div class="field-label is-normal">
				<label class="label">USUARIO:</label>
			</div>
			<div class="field-body">
				<div class="field">
				<p class="control">
				<input class="input is-small has-text-centered"  type="text" name="usuario" value="<?php echo $datos['usuario']?>" pattern="[A-Z 0-9/*-+]{0,20}" maxlength="20" oninput="this.value = this.value.toLowerCase()">
				</p>
				</div>
			</div>
		</div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">NOMBRE DEL USUARIO:</label>
            </div>
            <div class="field-body">
                <div class="field">
                <p class="control">
                <input class="input is-small has-text-centered"  type="text" name="nombre_usuario"value="<?php echo $datos['nombre_usuario']?>" pattern="[A-Z 0-9/*-+]{0,40}" maxlength="40" oninput="this.value = this.value.toUpperCase()">
                </p>
                </div>
            </div>
        </div>

		<div class="field is-horizontal">
			<div class="field-label is-normal">
				<label class="label">MATRÍCULA:</label>
			</div>
			<div class="field-body">
				<div class="field">
				<p class="control">
				<input class="input is-small has-text-centered"  type="text" name="matricula" value="<?php echo $datos['matricula']?>" pattern="[A-Z 0-9/*-+]{0,9}" maxlength="9" oninput="this.value = this.value.toUpperCase()">
				</p>
				</div>
			</div>
		</div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">CARGO:</label>
            </div>
            <div class="field-body">
                <div class="field">
                <p class="control">
                <input class="input is-small has-text-centered"  type="text" name="cargo" value="<?php echo $datos['cargo']?>" pattern="[A-Z 0-9/*-+]{0,29}" maxlength="29" oninput="this.value = this.value.toUpperCase()">
                </p>
			</div>
		</div>

        </div>
			<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">IP:</label>
				</div>
				<div class="field-body">
					<div class="field">
					<p class="control">
					<input class="input is-small has-text-centered"  type="text" name="ip" value="<?php echo $datos['ip']?>" pattern="[A-Z 0-9/*-+.]{0,15}" maxlength="15" oninput="this.value = this.value.toUpperCase()">
					</p>
					</div>
				</div>
		</div>	
			
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">AREA:</label>
            </div>
            <div class="field-body">
                <div class="field">
                <p class="control">
                <input class="input is-small has-text-centered"  type="text" name="area" value="<?php echo $datos['area']?>" pattern="[A-Z 0-9/*-+]{0,26}" maxlength="26" oninput="this.value = this.value.toUpperCase()">
                </p>
                </div>
            </div>
        </div>	

		<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">DEPARTAMENTO:</label>
				</div>
				<div class="field-body">
					<div class="field">
					<p class="control">
					<input class="input is-small has-text-centered"  type="text" name="departamento" value="<?php echo $datos['departamento']?>" pattern="[A-Z 0-9/*-+]{0,33}" maxlength="33" oninput="this.value = this.value.toUpperCase()">
					</p>
					</div>
				</div>
			</div>

		<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">NODO:</label>
				</div>
				<div class="field-body">
					<div class="field">
					<p class="control">
					<input class="input is-small has-text-centered"  type="text" name="nodo" value="<?php echo $datos['nodo']?>" pattern="[A-Z 0-9/*-+]{0,11}" maxlength="11" oninput="this.value = this.value.toUpperCase()">
					</p>
					</div>
				</div>
		</div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">EXTENSION:</label>
            </div>
            <div class="field-body">
                <div class="field">
                <p class="control">
                <input class="input is-small has-text-centered"  type="text" name="extension" value="<?php echo $datos['extension']?>" pattern="[A-Z 0-9/*-+]{0,5}" maxlength="5" oninput="this.value = this.value.toUpperCase()">
                </p>
                </div>
            </div>
        </div>

		<div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">ULTIMO MANTENIMIENTO:</label>
            </div>
            <div class="field-body">
                <div class="field">
                <p class="control">
                <input class="input" type="date" value="<?php echo $datos['ultimo_mantenimiento']?>" name="ultimo_mantenimiento">
                </p>
                </div>
            </div>
        </div>

			<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">PREI:</label>
				</div>
				<div class="field-body">
					<div class="field">
					<p class="control">
					<input class="input is-small has-text-centered"  type="text" name="prei" value="<?php echo $datos['prei']?>" pattern="[0-9 /*-+.]{0,40}" maxlength="40" oninput="this.value = this.value.toUpperCase()">
					</p>
					</div>
				</div>
			</div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">N.N.I:</label>
            </div>
            <div class="field-body">
                <div class="field">
                <p class="control">
                <input class="input is-small has-text-centered"  type="text" name="nni" value="<?php echo $datos['nni']?>" pattern="[A-Z 0-9/*-+]{0,12}" maxlength="12" oninput="this.value = this.value.toUpperCase()">
                </p>
                </div>
            </div>
        </div>

			

				

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">UNIDAD:</label>
            </div>
            <div class="field-body">
                <div class="field">
                <p class="control">
                <input class="input is-small has-text-centered"  type="text" name="unidad" value="<?php echo $datos['unidad']?>" pattern="[A-Z 0-9/*-+]{0,24}" maxlength="24" oninput="this.value = this.value.toUpperCase()">
                </p>
                </div>
            </div>
        </div>	

			

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">COMENTARIOS:</label>
            </div>
            <div class="field-body">
                <div class="field">
                <p class="control">
                <input class="input is-small has-text-centered"  type="text" name="comentarios" value="<?php echo $datos['comentarios']?>" pattern="[A-Z 0-9/*-+]{0,80}" maxlength="80" oninput="this.value = this.value.toUpperCase()">
                </p>
                </div>
            </div>
        </div>

		<br>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">ACTUALIZAR</button>
		</p>
    </div>
	</form>	
    <?php
        }else{
            include "./inc/error_alert.php";
        }
        $check_empleado=null;
    ?>
</div>
