
let formulario = document.querySelector("form");

document.addEventListener('DOMContentLoaded', function() {

  var evento;

  //Se declara el calendario
    var calendarEl = document.getElementById('calendario');

  //Propiedades del calendario  
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: "es",
      displayEventTime:false,
      headerToolbar: {

        left:'prev,next today',
        center:'title',
        right:'dayGridMonth,listWeek'

      },
      
      events: "calendario/mostrar" ,
    //Modal introducción de un evento.
      dateClick:function(info){
        formulario.reset();

        formulario.start.value=info.dateStr;
        formulario.end.value=info.dateStr;
        $("#btguardar").show();
        $("#btmodificar").hide();
        $("#bteliminar").hide();

        $("#evento").modal("show");

      },
      //Modal de modificación del formulario.
      eventClick:function(info){

        $("#btguardar").hide();
        $("#btmodificar").show();
        $("#bteliminar").show();

        evento = info.event;
        console.log(evento);

        axios.post("calendario/editar/"+info.event.id).then(
          (respuesta) => {

            formulario.title.value = respuesta.data.title;
            formulario.descripcion.value = respuesta.data.descripcion;
            formulario.start.value = respuesta.data.start;
            formulario.end.value = respuesta.data.end;

            $("#evento").modal("show");

          }

        ).catch(

          error=>{

            if(error.response){

              console.log(error.response.data);

            }
          }
        );
      }


    });

    calendar.render();

    //Boton de agregar
    document.getElementById("btguardar").addEventListener("click",function(){

       enviarDatos("calendario/agregar");

    });

    //Boton de eliminación
    document.getElementById("bteliminar").addEventListener("click", function(event) {
      // Evitar el comportamiento predeterminado del botón
      event.preventDefault();
      // Ocultar cualquier modal por defecto que pueda estar visible
      $(".modal").modal("hide");
      // Mostrar modal de confirmación
      $("#confirmacionEliminar").modal("show");
    });
    
    //Botón "Eliminar" en el modal de confirmación
    document.getElementById("confirmarEliminar").addEventListener("click", function() {
      enviarDatos("calendario/borrar/" + evento.id);
      $("#confirmacionEliminar").modal("hide");
    });
    //Boton de modificación
    document.getElementById("btmodificar").addEventListener("click",function(){

      enviarDatos("calendario/actualizar/"+evento.id);

  });

  function enviarDatos(url){
    // Se crea un objeto FormData a partir de un formulario
    const datos = new FormData(formulario);
        console.log(datos);
        // Realiza una solicitud POST utilizando Axios
        axios.post(url, datos).then(
          (respuesta) => {// Función que se ejecuta si la solicitud es exitosa
            calendar.refetchEvents();// Actualiza o recarga los eventos del calendario utilizando FullCalendar
            $("#evento").modal("hide"); // Cierra el modal.

          }

        ).catch(
          error=>{
            if(error.response){
              console.log(error.response.data);
            }
          }
        )
  }

  });

  //Cuando no se introduzcan datos en algún campo esto mostrará los campos con borde rojo
  document.getElementById('btguardar').addEventListener('click', function() {
    var inputs = document.querySelectorAll('form input, form textarea');

    inputs.forEach(function(input) {
      if (input.value.trim() === '') {
        input.classList.add('is-invalid');
      } else {
        input.classList.remove('is-invalid');
      }
    });

    var invalidInputs = document.querySelectorAll('.is-invalid');
    if (invalidInputs.length > 0) {
      invalidInputs[0].focus();
    } else {
      
    }
  });

  //Muestra el boton guardar y oculta los otros dos cuando se pulsa el boton
  document.addEventListener('DOMContentLoaded', function() {
    var btnCrearEvento = document.getElementById('btnCrearEvento');

    btnCrearEvento.addEventListener('click', function() {
        formulario.title.value = '';
        formulario.descripcion.value = '';
        formulario.start.value = '';
        formulario.end.value = '';
        document.getElementById('btmodificar').style.display = 'none';
        document.getElementById('bteliminar').style.display = 'none';
        document.getElementById('btguardar').style.display = 'block';
    });

});

