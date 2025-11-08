document.addEventListener("DOMContentLoaded", function () {
  const agregarCampoButtons = document.querySelectorAll(".agregar-campo");

  agregarCampoButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      // Encuentra el contenedor de la lista de precios correspondiente al botón clicado
      const container = this.closest(".packages");

      // Encuentra la lista de precios dentro del contenedor
      const listPrecio = container.querySelector(".list-precio");

      // Crea un nuevo campo de entrada
      const newInput = document.createElement("input");
      newInput.type = "text";
      newInput.className = "edit-input";
      newInput.name = "nuevoDato[]"; // Usa un array para nuevos datos
      newInput.placeholder = "Nuevo Dato";

      // Crea un nuevo elemento de lista y agrega el campo de entrada
      const listItem = document.createElement("li");
      listItem.appendChild(newInput);

      // Agrega el nuevo campo de entrada a la lista existente
      listPrecio.appendChild(listItem);
    });
  });
});

function check() {
  var checkBox = document.getElementById("checbox");
  var text1 = document.getElementsByClassName("text1");
  var text2 = document.getElementsByClassName("text2");

  for (var i = 0; i < text1.length; i++) {
    if (checkBox.checked == true) {
      text1[i].style.display = "block";
      text2[i].style.display = "none";
    } else if (checkBox.checked == false) {
      text1[i].style.display = "none";
      text2[i].style.display = "block";
    }
  }
}

// Llamada inicial para establecer el estado deseado al cargar la página
check();



