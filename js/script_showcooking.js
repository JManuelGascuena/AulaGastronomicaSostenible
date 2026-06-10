const videoModal = document.getElementById("videoModal");
const videoFrame = document.getElementById("videoFrame");
const modalTitle = document.getElementById("videoModalLabel");

videoModal.addEventListener("show.bs.modal", (event) => {
  // Botón que disparó el modal
  const button = event.relatedTarget;
  // Extraer info de los atributos data-bs-*
  const videoId = button.getAttribute("data-bs-id");
  const title = button.getAttribute("data-bs-title");

  // Actualizar el src del iframe y el título
  videoFrame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
  modalTitle.textContent = title;
});

// Limpiar el video cuando se cierra el modal (para que deje de sonar)
videoModal.addEventListener("hide.bs.modal", () => {
  videoFrame.src = "";
});
