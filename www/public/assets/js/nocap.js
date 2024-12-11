


//Animación sencilla para que las cards aumenten de tamaño un 10% y cambien de color

const productCards = document.querySelectorAll(".producto");
productCards.forEach((card) => {


  //ANIMACION PARA LAS CARDS
  card.addEventListener("mouseover", () => {
    card.style.transform = "scale(1.1)";
    card.style.backgroundColor = "#fad4f9";
    card.style.position = "relative";
    card.style.zIndex = "1";
  });

  card.addEventListener("mouseout", () => {
    card.style.transform = "scale(1)";
    card.style.backgroundColor = "#ffffff";
    card.style.position = "relative";
    card.style.zIndex = "0";
  });
});


//EventListener para añadir al carrito en los botones de las cards y en la vista de producto también seleciona la cantidad
document.addEventListener('DOMContentLoaded', () => {

  const cantidadInput = document.querySelector('.cantidad');

  // Evento para validar la cantidad cada vez que cambia el input
  if (cantidadInput) {
    cantidadInput.addEventListener('input', function () {
      const cantidad = parseInt(this.value, 10);
      if (isNaN(cantidad) || cantidad <= 0) {
        this.value = 1; // Restablece el valor si hay algún fallo a 1
      }
    });
  }

  //Trabajamos con todos los botones de la clase add-to-cart
  const buttons = document.querySelectorAll('.add-to-cart');

  buttons.forEach(button => {
    button.addEventListener('click', function () {
      const productId = this.getAttribute('data-product-id');
      const productName = this.getAttribute('data-product-name');
      const cantidad = parseInt(cantidadInput ? cantidadInput.value : 1, 10);

      // Enviar una solicitud AJAX al servidor
      fetch('/carrito/agregar', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          id_producto: productId,
          cantidad: cantidad, // Por defecto añade 1 al carrito
        }),
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert(`${productName} se añadió al carrito.`);
            actualizarCarrito(); // Llama a la función para actualizar el carrito
          } else {
            alert(data.message || 'Hubo un error al añadir el producto.');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    });
  });
});


//Funcion para mostrar los datos en el carrito superior
function actualizarCarrito() {
  fetch('/carrito/contenido')//Solicita los datos de la funcion  obtenerCarrito();
    .then(response => response.json())//Pasa los datos a un json para poder iterar sobre ellos
    .then(data => {

      //Seleciona el menu del carrito y por cada producto(x cantidad) en el json
      // introducimos los datos del producto en el carrito del hedaer

      const carritoMenu = document.querySelector('.dropdown-menu');

      carritoMenu.innerHTML = '';

      data.items.forEach(item => {
        carritoMenu.innerHTML += `
                    <a href="/producto/${item.id}" class="dropdown-item">
                        <div class="media">
                            <img src="/assets/img/gorras/${item.imagen}" class="img-size-50 mr-3" alt="${item.nombre}">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">${item.nombre}</h3>
                                <p class="text-sm">Cantidad: ${item.cantidad}</p>
                                <p class="text-sm text-muted">Precio: ${item.precio * item.cantidad}€</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                `;
      });
      carritoMenu.innerHTML += `<a href="/carrito" class="dropdown-item dropdown-footer">Ver Carrito</a>`;
    })
    .catch(error => console.error('Error al actualizar el carrito:', error));
}



//Funcion para cambiar las imagenes del slider de la página de inicio

  let index = 0;

  function moveSlide(step) {
  const slides = document.querySelector('.slides');
  const totalSlides = document.querySelectorAll('.slide').length;


  index += step; //Cambia el index según el parámetro que mandamos (step)

  if (index >= totalSlides) { //Si el slide al que intento acceder es mayor que el index cambia a la primera para hacer el bucle
  index = 0;
} else if (index < 0) {
  index = totalSlides - 1;
}
  slides.style.transform = `translateX(-${index * 100}%)`;//Cambia la foto por la que toca según el index, al tamaño completo del contenedor
}
