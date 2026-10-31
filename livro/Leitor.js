class Leitor {    
    static voz= 0;
    static velocidade_voz= 2;
    static tom_voz= 1;
    static lingua="pt-Br";   
    static sintetizador= window.speechSynthesis;
    static vozes_do_sistema= this.sintetizador.getVoices();


    static ler_texto(texto_id) {
        // alert("a funcao funcionou");
        let texto;
        try {
            texto = document.getElementById(texto_id).textContent;
        } catch {
            texto = document.getElementById(texto_id).value;
        }
        // alert("até a parte 1 deu certo");
        // alert(texto);
        // alert("até a parte o if deu certo");
        let texto_requisitado = new SpeechSynthesisUtterance();
        texto_requisitado.voice = this.vozes_do_sistema[this.voz];
        texto_requisitado.rate = this.velocidade_voz;
        texto_requisitado.pitch = this.tom_voz;
        texto_requisitado.text = texto;
        texto_requisitado.lang = this.lingua;
        this.sintetizador.speak(texto_requisitado);
    }
}

import * as pdfjsLib from "https://cdn.jsdelivr.net/npm/pdfjs-dist@4.10.38/build/pdf.min.mjs";

pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdn.jsdelivr.net/npm/pdfjs-dist@4.10.38/build/pdf.worker.min.mjs";


async function carregarTextoPDF() {

    const caminhoPDF = "../src/Livros Book for All/Alice no pais das maravilhas.pdf";

    const documento = await pdfjsLib.getDocument(caminhoPDF).promise;

    let textoCompleto = "";

    for (let i = 1; i <= documento.numPages; i++) {

        const pagina = await documento.getPage(i);

        const conteudo = await pagina.getTextContent();

        const textoPagina = conteudo.items
            .map(item => item.str)
            .join(" ");

        textoCompleto += textoPagina + "\n\n";
    }

    document.getElementById("textoExtraido").textContent =
        textoCompleto;

    console.log("Texto extraído:", textoCompleto);

    alert("PDF preparado para leitura!");
}

window.Leitor = Leitor;
window.carregarTextoPDF = carregarTextoPDF;