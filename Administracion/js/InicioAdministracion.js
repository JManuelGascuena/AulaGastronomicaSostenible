function actualizarEstado(checkbox) {
  const idVideo = checkbox.getAttribute("data-id");
  const estado = checkbox.checked ? 1 : 0;

  // Usamos Fetch para enviar los datos a un archivo PHP procesador
  fetch("./api/actualizar_estado.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `id=${idVideo}&publicado=${estado}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data !== "ok") {
        alert("Error al actualizar el estado");
        checkbox.checked = !checkbox.checked; // Revierte si falla
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      checkbox.checked = !checkbox.checked;
    });
}

//PARA MANEJAR EL VIDEO MODAL
const videoModal = document.getElementById("videoModal");
videoModal.addEventListener("show.bs.modal", function (event) {
  // Botón que disparó el modal
  const button = event.relatedTarget;
  // Extraer el ID del video de los atributos data-bs-*
  const videoId = button.getAttribute("data-bs-id");
  const videoTitle = button.getAttribute("data-bs-title");

  // Actualizar el título del modal
  const modalTitle = videoModal.querySelector(".modal-title");
  modalTitle.textContent = videoTitle;

  // IMPORTANTE: Añadir ?autoplay=1 al final de la URL
  const videoFrame = videoModal.querySelector("#videoFrame");
  //videoFrame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
  videoFrame.src = `https://youtube.com/embed/${videoId}?autoplay=1&rel=0`;
});

// Limpiar el src al cerrar el modal para que el video deje de sonar
videoModal.addEventListener("hide.bs.modal", function () {
  const videoFrame = videoModal.querySelector("#videoFrame");
  videoFrame.src = "";
});
