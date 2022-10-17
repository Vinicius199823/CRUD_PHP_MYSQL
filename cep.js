function searchCEP(){
    let cep = document.getElementById('CEP').value;

    if(cep !== ""){

        let url = `https://viacep.com.br/ws/${cep}/json/`;
        let req = new XMLHttpRequest();

        req.open("GET",url);
        req.send();

        req.onload = function(){
            if(req.status === 200){
                let endereco = JSON.parse(req.response);
                document.getElementById("logr").value = endereco.logradouro;
                document.getElementById("bairro").value = endereco.bairro;
                document.getElementById("cidade").value = endereco.localidade;
                document.getElementById("UF").value = endereco.uf;
                

            }
            else if(req.status === 400)
                alert("CEP invalido!");
        }
    }
}

window.onload = function (){
    let cep = document.getElementById("CEP");
    cep.addEventListener("blur",searchCEP);
}