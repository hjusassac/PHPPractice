const submit = document.getElementById("submit");
const placeList = document.getElementById("places");
const nameInput = document.getElementById("placeName");
const memoInput = document.getElementById("memo");

const dataNames = ["placeName", "mapProvider", "mapLink", "memo", "rating"];
let placesLog, dataInput;

function highlight(elem) {
    elem.focus();
    elem.style.backgroundColor = "pink";
    elem.nextElementSibling.style.display = "inline-block";
}
function dehighlight(elem) {
    elem.style.backgroundColor = "";
    elem.nextElementSibling.style.display = "none"
}

function submission() {
    const formPlace = document.getElementById("favPlace");
    const data = new FormData(formPlace);
    dataInput = [];
    for(let i of dataNames) dataInput.push(data.get(i));

    if(dataInput[2] == "") {
        data.set(dataNames[1], "N/A");
        data.set(dataNames[2], "N/A");
    } else data.set(dataNames[2], `<a href="${dataInput[2]}"> Visit ${dataInput[1]} >> </a>`);

    const xhr = new XMLHttpRequest();
    const method = "POST";
    const url = "places.php"

    
    if(dataInput[0]=="" || dataInput[3] == "What's so special with this place?" || dataInput[3] == "") { 
        // what should be done to alert there's no input where required
        dataInput[0]=="" ? highlight(nameInput):highlight(memoInput);
    } else {
        if(dataInput[4] == undefined) data.set(dataNames[4], "Not Sure");
        dehighlight(nameInput);
        dehighlight(memoInput);

        xhr.open(method, url);
        xhr.send(data);
    
        xhr.addEventListener('readystatechange', function() {
            console.log("I'm working?");
            if(this.readyState == 4) {
                // when successfully sent request, grab the stored data and show in html
                placesLog = xhr.responseText;
                placeList.innerHTML = "<h2>Places List</h2><hr>"+placesLog;
                placeList.classList.add("container");
            }
        })
    }

}

submit.addEventListener("click", submission);

