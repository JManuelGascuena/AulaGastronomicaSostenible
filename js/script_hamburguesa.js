document.addEventListener("DOMContentLoaded", function () {
  const navToggle = document.querySelector(".nav-toggle");
  const navLista = document.querySelector(".nav-lista");
  const icon = navToggle.querySelector("i");

  navToggle.addEventListener("click", function () {
    navLista.classList.toggle("show");

    // Intercambia el icono de hamburguesa (bars) por el de cerrar (xmark)
    if (navLista.classList.contains("show")) {
      icon.classList.remove("fa-bars");
      icon.classList.add("fa-xmark");
    } else {
      icon.classList.remove("fa-xmark");
      icon.classList.add("fa-bars");
    }
  });
});
