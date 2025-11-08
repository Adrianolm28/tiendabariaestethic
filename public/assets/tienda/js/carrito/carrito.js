var carrito = [];

// Cargar el carrito desde localStorage al cargar la página
function cargarCarritoDesdeLocalStorage() {
  var carritoGuardado = localStorage.getItem("carrito");
  if (carritoGuardado) {
    carrito = JSON.parse(carritoGuardado);
    console.log("Carrito cargado desde localStorage:", carrito);
    actualizarVistaCarrito();
  }
}

// Guardar el carrito en localStorage
function guardarCarritoEnLocalStorage() {
  localStorage.setItem("carrito", JSON.stringify(carrito));
}

// Cargar el carrito al cargar la página
$(document).ready(function () {
  cargarCarritoDesdeLocalStorage();
});

$("#productos-container").on("click", ".add-to-cart-btn", function () {
  console.log("Botón de agregar al carrito clickeado");
  var productId = $(this).data("id");
  var productName = $(this).data("nombre");
  var productPrice = parseFloat($(this).data("precio"));
 
 /*  var productQuantity = 1; */
  var productQuantity = parseInt($(`#quantity-${productId}`).val());
  var productImage = $(this).data("imagen");
  var productSistema = $(this).data("sistema");

  if (isNaN(productQuantity) || productQuantity <= 0) {
    productQuantity = 1; // Establecer el valor por defecto como 1
  }

  var discountedPrice = parseFloat($(this).data("precio-con-descuento"));
  var productPriceTransferencia = parseFloat($(this).data("preciotransferencia"));

  if (discountedPrice > 0) {
    productPrice = discountedPrice;
  }

  var productoExistenteIndex = carrito.findIndex(function (item) {
    return item.id === productId;
  });

  if (productoExistenteIndex !== -1) {
    carrito[productoExistenteIndex].cantidad += productQuantity;
  } else {
    var producto = {
      id: productId,
      nombre: productName,
      precio: productPrice,
      precio_transferencia: productPriceTransferencia,
      cantidad: productQuantity,
      imagen: productImage,
      id_sistema: productSistema
    };
    carrito.push(producto);
  }

  console.log("Carrito actualizado:", carrito);
  mostrarNotificacion();
  actualizarVistaCarrito();
  guardarCarritoEnLocalStorage();

  
   
    
});

function actualizarVistaCarrito() {
  var carritoDropdown = $(".cart-dropdown");
  var cartList = carritoDropdown.find(".cart-list");
  cartList.empty();

  var totalItems = 0;
  var subtotal = 0;

  carrito.forEach(function (producto) {
    totalItems += producto.cantidad;
    subtotal += producto.cantidad * producto.precio;

    var productoHtml = `
            <div class="product-widget">
                <div class="product-img">
                <img src="${base_url}/public/assets/img_tienda/productos/${
      producto.imagen
    }" alt="">
                </div>
                <div class="product-body">
                    <h3 class="product-name">${producto.nombre}</h3>
                    <h4 class="product-price">
                        <button class="btn btn-sm btn-secondary decrement-qty">-</button>
                        <span class="qty">${producto.cantidad}</span>
                        <button class="btn btn-sm btn-secondary increment-qty">+</button>
                        x S/.${(producto.precio * producto.cantidad).toFixed(2)}
                    </h4>
                </div>
                <button class="btn btn-sm btn-secondary delete"><i class="fa fa-close"></i></button>
            </div>
         `;
    cartList.append(productoHtml);
  });

  $(".cart-summary small").text(totalItems + " Producto(s) seleccionados");
  $(".dropdown-toggle .qty").text(totalItems);

  carritoDropdown
    .find(".cart-summary h5")
    .text("SUBTOTAL: S/." + subtotal.toFixed(2));

  // Actualizar también el contenido del sidebar SIDEBAR
  var sidebarCartList = $(".sidebar_prueba").find(".cart-list");
  sidebarCartList.empty();
  sidebarCartList.html(cartList.html());

  $(".sidebar_prueba .cart-summary small").text(totalItems + " Producto(s) seleccionados");
  $(".sidebar_prueba .cart-summary h5").text("SUBTOTAL: S/." + subtotal.toFixed(2));

  $(".decrement-qty").click(function () {
    var index = $(this).closest(".product-widget").index();
    if (carrito[index].cantidad > 1) {
      carrito[index].cantidad--;
      carrito[index].precioTotal =
        carrito[index].cantidad * carrito[index].precio;
      actualizarVistaCarrito();
      guardarCarritoEnLocalStorage();
    }
  });

  $(".increment-qty").click(function () {
    var index = $(this).closest(".product-widget").index();
    carrito[index].cantidad++;
    carrito[index].precioTotal =
      carrito[index].cantidad * carrito[index].precio;
    actualizarVistaCarrito();
    guardarCarritoEnLocalStorage();
  });

  $(".delete").click(function () {
    console.log("click en eliminar");
    var index = $(this).closest(".product-widget").index();
    carrito.splice(index, 1);
    console.log(carrito);
    actualizarVistaCarrito();

    guardarCarritoEnLocalStorage();
  });
}

$(".vaciar").click(function () {
  // Vacía el array y el localStorage
  carrito = [];
  localStorage.removeItem("carrito");
  actualizarVistaCarrito();
  // Notifica a otras vistas (como la página de carrito)
  document.dispatchEvent(new Event('carritoVaciado'));
  guardarCarritoEnLocalStorage();
});

function mostrarNotificacion() {
  Swal.fire({
    icon: "success",
    title: "Producto agregado al carrito",
    showConfirmButton: false,
    timer: 1500 // Duración de la notificación en milisegundos
  });
}

// Funciones para abrir y cerrar el sidebar

// Permitir que actualizarVistaCarrito sea llamada desde fuera si se usa en layout.php
window.actualizarVistaCarrito = actualizarVistaCarrito;
window.carrito = carrito;
