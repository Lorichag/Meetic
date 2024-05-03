var conv = document.querySelector('#addconv');


function ajouterconv(){
    var nouvelleConv = document.createElement('div');
    var option=document.createElement('option'); 
    nouvelleConv.classList.add('newconv');
    option.appendChild(nouvelleConv)
    conv.appendChild(option);
}

