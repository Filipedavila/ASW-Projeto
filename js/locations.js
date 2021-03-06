

function getDistritos() {
    var request = new XMLHttpRequest();

    let freguesias = document.getElementById("freg");
  if(freguesias != null) {
      let freguesiasChild = freguesias.lastElementChild;
      while (freguesiasChild) {
          freguesiasChild.remove();
          freguesiasChild = freguesias.lastElementChild
      }
  }


    request.onreadystatechange = function(){

        if(this.readyState == 4 && this.status == 200){


    let data = JSON.parse(this.responseText);

    let select = document.getElementById("dist");
    data.forEach( distrito => {
        let optionNew = "<option value='"+distrito.cod_distrito+"' onclick='getConcelho("+distrito.cod_distrito +")'>"+ distrito.nome_distrito +" </option>";
        select.innerHTML += optionNew;


    })
    }}

    request.open("GET", "./resources/register/location.php?request=Distritos", true);
    request.setRequestHeader('Content-Type', 'application/json');
    request.send();
}



function getConcelho(idDistrito){
    let request = new XMLHttpRequest();


    var freguesias = document.getElementById("freg");
    var concelhos = document.getElementById("conc");
    if (freguesias != null )     freguesias.innerText= "";
    if (concelhos != null)    concelhos.innerText ="";

    request.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            let data = JSON.parse(this.responseText);

            let optionNew;
            data.forEach( concelho => {
                 optionNew = "<option value='"+concelho.cod_concelho+"' onclick='getFreguesia("+concelho.cod_concelho+")'>"+ concelho.nome_concelho +" </option>";
                concelhos.innerHTML += optionNew;


            });
            optionNew = "<option  placeholder='Selecione' selected>Selecione</option>";
            concelhos.innerHTML += optionNew;
        }}

    request.open("GET", "./resources/register/location.php?request=Concelho&id="+idDistrito, true);
    request.setRequestHeader('Content-Type', 'application/json');
    request.send();
}






    function getFreguesia(idConcelho) {
            let request = new XMLHttpRequest();
        var freguesias = document.getElementById("freg");
        if (freguesias != null )     freguesias.innerText= "";
        request.onreadystatechange = function(){

            if(this.readyState == 4 && this.status == 200){




                let data = JSON.parse(this.responseText);
                console.log(data[0]);
                let optionNew;
                data.forEach( freguesia => {
                     optionNew = "<option value='"+freguesia.cod_freguesia+"'>"+ freguesia.nome_freguesia +" </option>";
                    freguesias.innerHTML += optionNew;


                })
                optionNew = "<option  selected>Selecione</option>";
                freguesias.innerHTML += optionNew;
            }}

        request.open("GET", "./resources/register/location.php?request=Freguesia&id="+idConcelho, true);
        request.setRequestHeader('Content-Type', 'application/json');
        request.send();



}