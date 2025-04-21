document.addEventListener("DOMContentLoaded", function () {
    if (!document.getElementById("tragamonedas")) return; 

    const btnGirar = document.getElementById("girar");
    const carruseles = document.querySelectorAll(".contenedor");
    const mensaje = document.getElementById("mensaje");
    const tragamonedas = document.getElementById("tragamonedas");
    const slideHeight = 280;
    const totalSlides = 5;

    function reiniciarCarruseles() {
        carruseles.forEach(contenedor => {
            contenedor.style.transition = "none";
            contenedor.style.transform = "translateY(0px)";
            contenedor.querySelectorAll(".slide").forEach(slide => slide.classList.remove("glow"));
        });
        mensaje.style.opacity = "0";
    }

    function girarCarrusel(contenedor, delay, callback) {
        let inicioGiro = performance.now();
        let velocidad = 30;
        let animando = true;

        function animarGiro(tiempoActual) {
            if (!animando) return;
            let tiempoTranscurrido = tiempoActual - inicioGiro;
            let desplazamiento = (tiempoTranscurrido * velocidad) % (totalSlides * slideHeight);
            contenedor.style.transform = `translateY(-${desplazamiento}px)`;
            requestAnimationFrame(animarGiro);
        }
        requestAnimationFrame(animarGiro);

        setTimeout(() => {
            animando = false;
            let indiceFinal = Math.floor(Math.random() * totalSlides);
            let desplazamientoFinal = (indiceFinal * slideHeight) - (slideHeight / 2) + (contenedor.parentElement.clientHeight / 2);
            contenedor.style.transition = "transform 0.8s cubic-bezier(0.25, 1, 0.5, 1)";
            contenedor.style.transform = `translateY(-${desplazamientoFinal}px)`;

            setTimeout(() => {
                contenedor.children[indiceFinal].classList.add("glow");
                callback(indiceFinal);
            }, 800);
        }, delay);
    }

    btnGirar.addEventListener("click", () => {
        btnGirar.disabled = true;
        tragamonedas.style.opacity = "1"; // Mostrar la máquina
        reiniciarCarruseles();

        let resultados = [];
        let girosCompletados = 0;

        carruseles.forEach((contenedor, i) => {
            girarCarrusel(contenedor, 2000 + i * 300, (indice) => {
                resultados[i] = indice;
                girosCompletados++;

                if (girosCompletados === carruseles.length) {
                    mostrarMensaje(resultados);

                    setTimeout(() => {
                        mensaje.style.opacity = "0";
                        tragamonedas.style.opacity = "0"; // Ocultar después de 5 segundos
                        btnGirar.disabled = false;
                    }, 5000);
                }
            });
        });
    });

    function mostrarMensaje(resultados) {
        let [r1, r2, r3] = resultados;
        if (r1 === r2 && r2 === r3) {
            mensaje.innerText = "¡GANASTE! 🎉";
        } else if (r1 === r2 || r1 === r3 || r2 === r3) {
            mensaje.innerText = "¡CASI! 😬";
        } else {
            mensaje.innerText = "Sigue intentando 😢";
        }
        mensaje.style.opacity = "1";
    }

});