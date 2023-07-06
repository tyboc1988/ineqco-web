function buscarEmpleado(tipoEmpleado) {
    var matricula = $("#" + tipoEmpleado + "_matricula").val();
  
    $.ajax({
        url: './php/buscar_empleado.php',
        method: 'POST',
        data: {
          matricula: matricula,
          tipo: tipoEmpleado
        },
        success: function(data) {
          
          var response = JSON.parse(data);
          if (response.status == 'success') {
              $("input[name='" + tipoEmpleado + "_plaza']").val(response.plaza);
              $("input[name='" + tipoEmpleado + "_nombre']").val(response.nombre);
              $("input[name='" + tipoEmpleado + "_categoria']").val(response.categoria);
              $("input[name='" + tipoEmpleado + "_horario']").val(response.horario);
              $("input[name='" + tipoEmpleado + "_descansos']").val(response.descansos);
          } else {
              alert('Empleado no encontrado');
          }
        },
        error: function() {
            console.log('Error');
        }
    });
  }
  