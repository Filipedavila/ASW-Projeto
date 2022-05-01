function search(idConcelho) {
    let request = new XMLHttpRequest();
    var freguesias = document.getElementById("freg");
    if (freguesias != null )     freguesias.innerText= "";
    request.onreadystatechange = function(){

        if(this.readyState == 4 && this.status == 200){




            let data = JSON.parse(this.responseText);
            console.log(data[0]);

            data.forEach( freguesia => {
                let optionNew = "<option value='"+freguesia.cod_freguesia+"'>"+ freguesia.nome +" </option>";
                freguesias.innerHTML += optionNew;


            })
        }}

    request.open("GET", "resources/register/location.php?request=Freguesia&id="+idConcelho, true);
    request.setRequestHeader('Content-Type', 'application/json');
    request.send();



}