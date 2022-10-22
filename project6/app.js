const submit = document.getElementById("submit");
const placeList = document.getElementById("places");
const nameInput = document.getElementById("placeName");
const memoInput = document.getElementById("memo");
const edit = document.getElementById("edit");

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
function showPlacesList(elem, content) {
    elem.lastElementChild.innerHTML = content;
    elem.style.display = "block";
}

function createElement(prnt, tagN, inner, clsN, att1, val1, att2, val2) {
    let newE= document.createElement(tagN);
    newE.innerHTML = inner;
    if(clsN) newE.classList.add(clsN);
    if(att1 && val1) {
        newE.setAttribute(att1, val1);
        if(att2 && val2) newE.setAttribute(att2, val2);
    }
    prnt.appendChild(newE);
}

const method = "POST", filePath = "places.php";

function sendxhr(method, filePath, data) {
    const xhr = new XMLHttpRequest();

    xhr.open(method, filePath);
    xhr.send(data);

    xhr.addEventListener('readystatechange', function() {
        console.log("I'm working?");
        if(this.readyState == 4) {
            // when successfully sent request, grab the response and show in html
            placesLog = xhr.responseText;
            showPlacesList(placeList, placesLog);
        }
    })
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

    if(dataInput[0]=="" || dataInput[3] == "What's so special with this place?" || dataInput[3] == "") { 
        // what should be done to alert there's no input where required
        dataInput[0]=="" ? highlight(nameInput):highlight(memoInput);
    } else {
        if(dataInput[4] == undefined) data.set(dataNames[4], "Not Sure");
        dehighlight(nameInput);
        dehighlight(memoInput);
        sendxhr(method, filePath, data);
    }
    
}

submit.addEventListener("click", submission);
// showPlacesList(placeList, placesLog);
sendxhr(method, filePath);

edit.addEventListener("click", function(){
    console.log("hello");
    const checkbox = '<input type="checkbox" name="selectDelete">'
    let listItem = document.getElementsByTagName("tr");
    for(let i=1;i<listItem.length;i++) createElement(listItem[i], "td", checkbox, "edit", "value", i);
})