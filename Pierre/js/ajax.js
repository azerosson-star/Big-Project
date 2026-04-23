temp = document.getElementsByTagName('template')[0]
main = document.getElementsByTagName("main")[0]
contenu_page = document.querySelector('#contenu')
inputs = document.querySelectorAll('[name="ville"]')
image = document.querySelector('img')
inputs.forEach(element => {
    element.addEventListener("change", call_api)
});
function call_api(e) {
    ville = e.target.value
    requete = new XMLHttpRequest();
    lien = 'https://api.weatherapi.com/v1/forecast.json?key=064012d2ca954542948141920262004&q=' + ville
    requete.open('POST', lien);
    requete.send();
    requete.onreadystatechange = function (event) {
        if (this.readyState == XMLHttpRequest.DONE)
            if (this.status === 200) {
                // console.log(this.responseText)
                contenu_api = JSON.parse(this.responseText)
                console.log(contenu_api.location.name)
                temp_c = contenu_api.current.temp_c
                wind_dir = contenu_api.current.wind_dir
                uv = contenu_api.current.uv
                icone = contenu_api.current.condition.icon
                contenu_temp = temp.content.cloneNode(true)
                contenu_page.innerHTML = ""
                contenu_page.appendChild(contenu_temp);
                contenu_page.innerHTML = contenu_page.innerHTML.replaceAll("TEMPERATURE",temp_c)
                contenu_page.innerHTML = contenu_page.innerHTML.replaceAll("VENT",wind_dir)
                contenu_page.innerHTML = contenu_page.innerHTML.replaceAll("TEMP_UV",uv)
                contenu_page.innerHTML = contenu_page.innerHTML.replaceAll("SOURCE",icone)
            }
    }
}
