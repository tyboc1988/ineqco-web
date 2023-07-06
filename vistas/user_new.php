<div class="container is-fluid mb-6">
	<h1 class="title has-text-centered">Usuarios</h1>
	<h2 class="subtitle has-text-centered">Nuevo usuario</h2>
</div>

<div class="container pb-6 pt-6 has-text-centered">
	<?php require_once "./php/main.php"; ?>
	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/usuario_guardar.php" method="POST" class="FormularioAjax" autocomplete="ON" >
	<div class="box">
		<div class="columns">

			<div class="column">
				<div class="control">
					<label class="label">Nombre</label>
					<input class="input has-text-centered" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" oninput="this.value = this.value.toUpperCase()" required >
				</div>
			</div>

			<div class="column">
				<div class="control">
					<label class="label">Usuario</label>
					<input class="input has-text-centered" type="text" name="usuario_usuario"  maxlength="30" oninput="this.value = this.value.toLowerCase()" required >
				</div>
			</div>

		</div>
		
		<div class="columns">
			
			<div class="column">
					<div class="control">
						<label class="label">Clave</label>
						<input class="input has-text-centered" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9/*-+.¡?=)(/&%$#°_:;@]{7,100}" maxlength="100" required >
					</div>
			</div>

			<div class="column">
					<div class="control">
						<label class="label">Repetir Clave</label>
						<input class="input has-text-centered" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9/*-+.¡?=)(/&%$#°_:;@]{7,100}" maxlength="100" required >
					</div>
			</div>

		</div>
		<br>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</div>
	</form>	
</div>