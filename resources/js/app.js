import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Agrega una imágen a tu post aquí",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,

    // Mantener la imagen cuando se falla la validacion en el formulario
    init: function () {
        if (document.querySelector('[name="image"]').value.trim()) {
            const imagen = {};
            imagen.size = 1234;
            imagen.name = document.querySelector('[name="image"]').value;

            this.options.addedfile.call(this, imagen);
            this.options.thumbnail.call(
                this,
                imagen,
                `/uploads/${imagen.name}`
            );
            imagen.previewElement.classList.add("dz-success", "dz-completed");
        }
    },
});

// Asignar el value al formulario para almacenarlo en la base de datos
dropzone.on("success", function (file, response) {
    console.log(response.imagen);
    const inputImage = document.querySelector("[name='imagen']");
    inputImage.setAttribute("value", response.imagen);
});

// Remover el value de la imagen cuando se elimine de dropzone
dropzone.on("removedfile", function () {
    const inputImage = (document.querySelector("[name='imagen']").value = "");
});
