<div class="container is-fluid mb-6">
	<h1 class="title has-text-centered">EQUIPO DE COMPUTO</h1>
	<h2 class="subtitle has-text-centered">Registrar Equipo</h2>
</div>

<div class="container pb-6 pt-6 has-text-centered">
    <?php
        require_once "./php/main.php";
    ?>
	<div class="form-rest mb-6 mt-6"></div>
	
	<form action="./php/computer_guardar.php" method="POST" class="FormularioAjax" autocomplete="ON" >
	
    <div class="box">

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="is-small label">SERIE:</label>
            </div>
            <div class="field-body">
                <div class="field">
                <p class="control">
                <input class="input is-small has-text-centered" type="text" name="serie" pattern="[A-Z 0-9/*-+]{0,23}" maxlength="23" oninput="this.value = this.value.toUpperCase()">
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
					<input class="input is-small has-text-centered"  type="text" name="prei" pattern="[0-9 /*-+.]{0,40}" maxlength="40" oninput="this.value = this.value.toUpperCase()">
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
                <input class="input is-small has-text-centered"  type="text" name="nni" pattern="[A-Z 0-9/*-+]{0,12}" maxlength="12" oninput="this.value = this.value.toUpperCase()">
                </p>
                </div>
            </div>
        </div>

			<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">Modelo:</label>
				</div>
				<div class="field-body">
					<div class="field">
					<p class="control">
					<input class="input is-small has-text-centered"  type="text" name="modelo" pattern="[A-Z 0-9/*-+]{0,27}" maxlength="27" oninput="this.value = this.value.toUpperCase()">
					</p>
					</div>
				</div>
			</div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">NOMBRE EQUIPO:</label>
            </div>
            <div class="field-body">
                <div class="field">
                <p class="control">
                <input class="input is-small has-text-centered"  type="text" name="nombre_equipo" pattern="[A-Z 0-9/*-+]{0,15}" maxlength="15" oninput="this.value = this.value.toUpperCase()">
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
					<input class="input is-small has-text-centered"  type="text" name="usuario" pattern="[A-Z 0-9/*-+]{0,20}" maxlength="20" oninput="this.value = this.value.toLowerCase()">
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
                <input class="input is-small has-text-centered"  type="text" name="nombre_usuario"pattern="[A-Z 0-9/*-+]{0,40}" maxlength="40" oninput="this.value = this.value.toUpperCase()">
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
					<input class="input is-small has-text-centered"  type="text" name="matricula" pattern="[A-Z 0-9/*-+]{0,9}" maxlength="9" oninput="this.value = this.value.toUpperCase()">
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
                <input class="input is-small has-text-centered"  type="text" name="cargo" pattern="[A-Z 0-9/*-+]{0,29}" maxlength="29" oninput="this.value = this.value.toUpperCase()">
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
					<input class="input is-small has-text-centered"  type="text" name="ip" pattern="[A-Z 0-9/*-+.]{0,15}" maxlength="15" oninput="this.value = this.value.toUpperCase()">
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
                <input class="input is-small has-text-centered"  type="text" name="area" pattern="[A-Z 0-9/*-+]{0,26}" maxlength="26" oninput="this.value = this.value.toUpperCase()">
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
					<input class="input is-small has-text-centered"  type="text" name="departamento" pattern="[A-Z 0-9/*-+]{0,33}" maxlength="33" oninput="this.value = this.value.toUpperCase()">
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
                    <select name="unidad" class="input is-small has-text-centered">
                        <option value="H.G.S.Z. N°38">H.G.S.Z. N°38</option>
                        <option value="O.T.A. S.J.C.">O.T.A. S.J.C.</option>                        
                    </select>
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
					<input class="input is-small has-text-centered"  type="text" name="nodo" pattern="[A-Z 0-9/*-+]{0,9}" maxlength="9" oninput="this.value = this.value.toUpperCase()">
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
                <input class="input is-small has-text-centered"  type="text" name="extension" pattern="[A-Z 0-9/*-+]{0,5}" maxlength="5" oninput="this.value = this.value.toUpperCase()">
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
                <input class="input is-small has-text-centered"  type="text" name="comentarios" pattern="[A-Z 0-9/*-+]{0,80}" maxlength="80" oninput="this.value = this.value.toUpperCase()">
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
					<input class="input is-small has-text-centered"  type="text" name="estatus" pattern="[A-Z 0-9/*-+.]{0,12}" maxlength="12" oninput="this.value = this.value.toUpperCase()">
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
                <input class="input" type="date" name="ultimo_mantenimiento">
                </p>
                </div>
            </div>
        </div>
		

    </div>
	<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">REGISTRAR</button>
		</p>
	</form>	
</div>