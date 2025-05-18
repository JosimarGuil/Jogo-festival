



var counter = document.querySelector(".counter");
var counterTotal = 0;
var pergunta = document.querySelector(".pergunta");
var opcoes = document.querySelector(".opcoes");
var perguntaActual = 0;

counter.innerHTML = "0 +";

var perguntas = [
    {
        questao: "1. O que é um mouse?",
        opcoes: [
            'A) Um dispositivo de entrada',
            'B) Um sistema operacional',
            'C) Um tipo de software',
            'D) Um aplicativo de edição de texto',
            'E) Uma linguagem de programação'
        ],
        resposta: 'A) Um dispositivo de entrada'
    },
    {
        questao: "2. Qual é a função principal do teclado?",
        opcoes: [
            'A) Armazenar dados',
            'B) Processar imagens',
            'C) Inserir texto e comandos',
            'D) Conectar dispositivos USB',
            'E) Transmitir áudio'
        ],
        resposta: 'C) Inserir texto e comandos'
    },
    {
        questao: "3. O que é um monitor?",
        opcoes: [
            'A) Um dispositivo de entrada',
            'B) Um sistema de segurança',
            'C) Uma linguagem de programação',
            'D) Um dispositivo de saída',
            'E) Um tipo de cabo'
        ],
        resposta: 'D) Um dispositivo de saída'
    },
    {
        questao: "4. O que significa a sigla RAM?",
        opcoes: [
            'A) Random Access Memory',
            'B) Read Access Memory',
            'C) Random Archive Module',
            'D) Read Archive Memory',
            'E) Random Apply Memory'
        ],
        resposta: 'A) Random Access Memory'
    },
    {
        questao: "5. Qual é o navegador padrão do Windows?",
        opcoes: [
            'A) Google Chrome',
            'B) Firefox',
            'C) Safari',
            'D) Microsoft Edge',
            'E) Opera'
        ],
        resposta: 'D) Microsoft Edge'
    },
    {
        questao: "6. O que é um sistema operacional?",
        opcoes: [
            'A) Um aplicativo de redes sociais',
            'B) Um programa de edição de imagens',
            'C) Um software que gerencia o hardware do computador',
            'D) Um dispositivo de armazenamento',
            'E) Um cabo de conexão'
        ],
        resposta: 'C) Um software que gerencia o hardware do computador'
    },
    {
        questao: "7. Qual é a principal função de um antivírus?",
        opcoes: [
            'A) Armazenar dados',
            'B) Melhorar a qualidade de áudio',
            'C) Proteger contra ameaças digitais',
            'D) Conectar dispositivos externos',
            'E) Acelerar o processador'
        ],
        resposta: 'C) Proteger contra ameaças digitais'
    },
    {
        questao: "8. O que é um pendrive?",
        opcoes: [
            'A) Um dispositivo de armazenamento portátil',
            'B) Um tipo de teclado',
            'C) Uma impressora portátil',
            'D) Um sistema operacional',
            'E) Um cabo de internet'
        ],
        resposta: 'A) Um dispositivo de armazenamento portátil'
    },
    {
        questao: "9. Qual destes é um sistema operacional?",
        opcoes: [
            'A) Firefox',
            'B) Android',
            'C) Chrome',
            'D) Safari',
            'E) WhatsApp'
        ],
        resposta: 'B) Android'
    },
    {
        questao: "10. O que é um arquivo PDF?",
        opcoes: [
            'A) Um arquivo de imagem',
            'B) Um arquivo de texto simples',
            'C) Um arquivo de vídeo',
            'D) Um arquivo de formato portátil',
            'E) Um arquivo de planilha'
        ],
        resposta: 'D) Um arquivo de formato portátil'
    },
    {
        questao: "11. O que é um processador?",
        opcoes: [
            'A) Um tipo de memória',
            'B) Uma unidade de armazenamento',
            'C) O cérebro do computador',
            'D) Um dispositivo de saída',
            'E) Uma placa de rede'
        ],
        resposta: 'C) O cérebro do computador'
    },
    {
        questao: "12. O que é um IP?",
        opcoes: [
            'A) Um tipo de cabo',
            'B) Um endereço de rede',
            'C) Um sistema de áudio',
            'D) Uma linguagem de programação',
            'E) Um dispositivo de armazenamento'
        ],
        resposta: 'B) Um endereço de rede'
    },
    {
        questao: "13. Qual é a função principal do Excel?",
        opcoes: [
            'A) Criar apresentações',
            'B) Processar textos',
            'C) Gerenciar planilhas',
            'D) Reproduzir vídeos',
            'E) Editar imagens'
        ],
        resposta: 'C) Gerenciar planilhas'
    },
    {
        questao: "14. Qual desses é um periférico de entrada?",
        opcoes: [
            'A) Impressora',
            'B) Monitor',
            'C) Mouse',
            'D) Caixa de som',
            'E) Projetor'
        ],
        resposta: 'C) Mouse'
    },
    {
        questao: "15. O que é um byte?",
        opcoes: [
            'A) Uma unidade de energia',
            'B) Uma unidade de temperatura',
            'C) Uma unidade de dados',
            'D) Um tipo de software',
            'E) Um cabo de conexão'
        ],
        resposta: 'C) Uma unidade de dados'
    }
];

// Embaralhando as perguntas
var quizes = perguntas.sort(() => Math.random() - 0.5);

function carregarPergunta() {
    opcoes.innerText = "";
    pergunta.innerText = quizes[perguntaActual].questao;

    quizes[perguntaActual].opcoes.forEach(opcao => {
        opcoes.innerHTML += `
            <div class='pergutas1'>
                <input type='radio' name='escolha' value='${opcao}'>
                <p style='margin-left: 10px;'>${opcao}</p>
            </div>
        `;
    });
}

function proximaPergunta() {
    document.querySelector('.success').innerText = "";
    document.querySelector('.error').innerText = "";

    const escolha = document.querySelector("input[name='escolha']:checked");

    if (escolha) {
        if (escolha.value === quizes[perguntaActual].resposta) {
            counterTotal++;
            counter.innerHTML = counterTotal + " +";
            swal("Sucesso!", "Resposta certa", "success");
        } else {
            swal("Falha!", "Resposta errada", "error");
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
    } else {
        document.querySelector('.error').innerText = "Por favor selecione uma opção!";
    }
}

// Inicializando
carregarPergunta();
