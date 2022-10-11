const submit = document.getElementById("submit");
const placesList = document.getElementById("places");
let respContent;

function submission() {
    let formPlace = document.getElementById("favPlace");
    let data = new FormData(formPlace);

    const xhr = new XMLHttpRequest();
    const method = "POST";
    const url = "places.php"

    xhr.open(method, url);
    xhr.send(data);

    if(data.get("placeName")==""){
        // what should be done to alert there's no input where required
    } else {
        xhr.addEventListener('readystatechange', function() {
            console.log("I'm working?");
            if(this.readyState == 4) {
                respContent = xhr.responseText;
                // var response = JSON.parse(xhr.responseText);
                // console.log(response);
                placesList.innerHTML = "<h2>Places List</h2><hr>"+respContent;
                placesList.classList.add("container");
            }
        })
    }

}

submit.addEventListener("click", submission);

