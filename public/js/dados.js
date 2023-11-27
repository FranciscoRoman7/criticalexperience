// Obtener el valor del contador del almacenamiento local (si existe)
let globalCounter = localStorage.getItem('counter') || 0;

// Función para actualizar la visualización del contador
function updateCounterView() {
  counterValue.textContent = globalCounter; // Actualiza el valor mostrado
}

// Restablecer la visualización inicial del contador
updateCounterView();

// Event listener para incrementar el bonificador
incrementBtn.addEventListener('click', () => {
  globalCounter++; // Incrementa el bonificador
  localStorage.setItem('counter', globalCounter); // Guarda el valor en localStorage
  updateCounterView(); // Actualiza la visualización del contador
});

// Event listener para decrementar el bonificador
decrementBtn.addEventListener('click', () => {
  globalCounter--; // Decrementa el bonificador
  localStorage.setItem('counter', globalCounter); // Guarda el valor en localStorage
  updateCounterView(); // Actualiza la visualización del contador
});

// Función para obtener el tipo de dado a partir del texto del botón
function getDiceType(button) {
    const buttonText = button.textContent;
    const matches = buttonText.match(/Tirar D(\d+)/);
    if (matches && matches.length >= 2) {
        return `D${matches[1]}`;
    } else {
        return "Tipo de Dado Desconocido";
    }
}

// Función para tirar un dado
function rollDie(sides) {
    return Math.floor(Math.random() * sides) + 1;
}

// Función para guardar los datos de la tirada en la base de datos
function saveRollToDatabaseAndUpdateList(result, diceType) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const url = 'dados/guardar'; // Ruta del controlador en Laravel

    const data = {
        _token: token,
        tipo_dado: parseInt(diceType.substring(1)),
        bonificador: globalCounter,
        resultado: result
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Respuesta del servidor:', data);
        // Después de guardar los datos, redirigir a la función mostrar del controlador
        window.location.href = 'dados'; // Reemplaza con la ruta correcta si es diferente
    })
    .catch(error => {
        console.error('Error al procesar la respuesta:', error);
    });
}

// Función para obtener la lista actualizada de tiradas desde el servidor
function updateRollList() {
    const url = 'dados'; // Reemplaza esto con la ruta correcta de tu aplicación
fetch(url)
  .then(response => {
    if (!response.ok) {
      throw new Error('La solicitud no pudo ser completada.');
    }
    return response.json();
  })
  .then(data => {
    // Manejar los datos recibidos
    console.log('Datos recibidos:', data);

    // Actualizar el DOM con los datos recibidos
    const historyList = document.querySelector('.history-list');
    historyList.innerHTML = ''; // Limpiar la lista antes de actualizar

    data.tiradas.forEach(tirada => {
      const listItem = document.createElement('li');
      listItem.textContent = `D${tirada.tipo_dado}: Resultado: ${tirada.resultado} + Bonificador: ${tirada.bonificador} = Total: ${tirada.total}`;
      historyList.appendChild(listItem);
    });
  })
  .catch(error => {
    console.error('Error al obtener las tiradas:', error);
  });

}

// Event listener para tirar dados
const rollDieButtons = document.querySelectorAll('.roll-die');
rollDieButtons.forEach(button => {
    button.addEventListener('click', () => {
        const sides = button.getAttribute('data-sides');
        const result = rollDie(sides);
        const diceType = getDiceType(button);
        saveRollToDatabaseAndUpdateList(result, diceType);
    });
});

// Obtener referencia al botón "Borrar Historial"
const clearHistoryBtn = document.querySelector('.clear-history');

// Event listener para borrar historial
clearHistoryBtn.addEventListener('click', () => {
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const url = 'dados/borrar'; // Ruta del controlador en Laravel para borrar el historial

  fetch(url, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': token
    }
  })
  .then(response => response.json())
  .then(data => {
    console.log('Respuesta del servidor:', data); // Manejar la respuesta del servidor aquí
    // Actualizar la lista de tiradas después de borrar el historial
    window.location.href = 'dados'; 
  })
  .catch(error => {
    console.error('Error al procesar la respuesta:', error);
  });
});