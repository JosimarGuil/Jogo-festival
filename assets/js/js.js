
//  varaivel que pega o elemnto contador de pontos 
var counter = document.querySelector(".counter");
// VARÁVEL ONDE OS PONTOS SAO CALCULADO
var counterTotal = 0;
// EXIBINDO O VALOR DA VARIAVEL ONDE OS PONNTOS SAO CALCULADOS  NA VIEW NO ELEMENTO CONTADOR DE PONTOS 
//  varaivel que pega o elemnto ONDE AS PERGUNTAS SÃO EXIBIDAS NA VIEW
var pergunta = document.querySelector(".pergunta");
//  EXIBINDO A PERGUNTA NO ELEMENTO ONDE AS PERGUNTAS SAO EXIBIDAS NA VIEW
var opcoes = document.querySelector(".opcoes");
var perguntaActual = 0;

counter.innerHTML="";

perguntas = [

    {
        questao: "1- Quanto é 1 + 1",
        opcoes: ['1', '2', '4'],
        reposta: 2
    },

    {
        questao: "2- Quanto é 4 + 4",
        opcoes: ['1', '2', '8'],
        reposta: 8
    },

    {
        questao: "3- Quanto é 5 + 1",
        opcoes: ['1', '6', '4'],
        reposta: 6
    },

    {
        questao: "4- Quanto é 7 + 1",
        opcoes: ['8', '6', '4'],
        reposta: 8
    },
]


function carregarPergunta() {
    opcoes.innerText = "";
    pergunta.innerText = perguntas[perguntaActual].questao;
    perguntas[perguntaActual].opcoes.forEach(opcao => {
        opcoes.innerHTML += "<div class='pergutas1'><input type='radio' name='escolha'  value=" + opcao + "><p style='margin-left: 10px;'>" + opcao + "</p> </div>"
    });
}

function proximaPergunta() {
    document.querySelector('.success').innerText = ""
    document.querySelector('.error').innerText = ""

    const escolha = document.querySelector("input[name='escolha']:checked");
    if (escolha) {
        if (parseInt(escolha.value) === perguntas[perguntaActual].reposta) {
            counterTotal++;
            counter.innerHTML = counterTotal + "+";
            swal("Sucesso!", "Resposta certa", "success");
        }
        else {
            swal("Falha!", "Resposta errda", "error");
        }

        perguntaActual++;

        if (perguntaActual < 3) {
            carregarPergunta();
        } else {
            if (counterTotal === 3) {
                swal("VENCEU!", "Você venceu meu cara!", "success");
                const duration = 15 * 1000,
                    animationEnd = Date.now() + duration,
                    defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

                function randomInRange(min, max) {
                    return Math.random() * (max - min) + min;
                }

                const interval = setInterval(function () {
                    const timeLeft = animationEnd - Date.now();

                    if (timeLeft <= 0) {
                        return clearInterval(interval);
                    }

                    const particleCount = 50 * (timeLeft / duration);

                    // since particles fall down, start a bit higher than random
                    confetti(
                        Object.assign({}, defaults, {
                            particleCount,
                            origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 },
                        })
                    );
                    confetti(
                        Object.assign({}, defaults, {
                            particleCount,
                            origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 },
                        })
                    );
                }, 250);
                document.getElementById("resp").style.display = "none";
                document.getElementById("present").style.display = "block";
            }

            else {
                swal("PERDEU!", "Infelizmente você perdeu", "error");
                document.getElementById("resp").style.display = "none";
                document.getElementById("reiniciar").style.display = "block";
            }

        }

    }
    else {
        document.querySelector('.error').innerText = "Por favor selecione uma opção!"
    }



}

counter.innerHTML += "0 +";
carregarPergunta();