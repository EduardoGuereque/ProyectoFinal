const params = new URLSearchParams(window.location.search);
const id = parseInt(params.get("id"));
const cancion = canciones.find(c => c.id === id);

if (!cancion) {
    document.getElementById("detalle-cancion").innerHTML = "<h2>Canción no encontrada</h2>";
} else {
    document.title = `${cancion.titulo} - ${cancion.artista}`;

    document.getElementById("detalle-cancion").innerHTML = `
        <div class="card shadow-lg p-4 text-center">
            <h1>${cancion.titulo}</h1>
            <h4 class="text-muted">${cancion.artista} — ${cancion.anio}</h4>

            <img src="${cancion.imagen}" class="img-fluid rounded shadow mt-3">

            ${cancion.audio ? `
                <audio controls class="w-100 mt-4">
                    <source src="${cancion.audio}" type="audio/mpeg">
                </audio>
            ` : "<p class='text-secondary mt-3'>Audio no disponible</p>"}

            <p class="mt-4 text-secondary px-5">${cancion.descripcion}</p>

            <button class="btn btn-outline-dark mt-3" onclick="window.history.back()">Volver</button>
        </div>
    `;
}

const contenedor = document.getElementById("canciones-relacionadas");

cancion.relacionadas.forEach(idRel => {
    const r = canciones.find(c => c.id === idRel);

    contenedor.innerHTML += `
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm">
                <img src="${r.imagen}" class="card-img-top">
                <div class="card-body text-center">
                    <h6 class="fw-bold">${r.titulo}</h6>
                    <a href="detalles.html?id=${r.id}" class="btn btn-sm btn-outline-danger">Escuchar</a>
                </div>
            </div>
        </div>
    `;
});
