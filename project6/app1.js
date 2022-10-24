const submit = document.getElementById("submit");
const placeList = document.getElementById("places");
const nameInput = document.getElementById("placeName");
const memoInput = document.getElementById("memo");
const edit = document.getElementById("edit");
const done = document.getElementById("done");
let hideEditButtons = true;

const table = document.getElementById("List");
const dataList = document.querySelector("#tableBody");
const rowModel = document.querySelector("#rowModel");

// const dataNames = ["placeName", "mapProvider", "mapLink", "memo", "rating", "id"];
let placesLog, sendEdit=false;

function highlight(elem) {
    elem.focus();
    elem.style.backgroundColor = "pink";
    elem.nextElementSibling.style.display = "inline-block";
}
function dehighlight(elem) {
    elem.style.backgroundColor = "";
    elem.nextElementSibling.style.display = "none"
}
function showPlacesList(elem, content) {    // deprecated
    elem.lastElementChild.innerHTML = content;
    elem.style.display = "block";
}
function showPlacesListNew(array) { 
    // reset container that has the entries before append
    dataList.innerHTML = "";

    // 1) get the html table model
    // 2) clone the model node and put content and append
    for(let item of array) {
        // clone node for place list display
        let row = rowModel.cloneNode(true);

        row.setAttribute("data-id", item["id"]);
        row.querySelector(".name").innerHTML = item["placeName"];

        if(item["mapProvider"]=="N/A" && item["mapLink"]=="N/A") {
            row.querySelector(".link").innerHTML = item["mapLink"];
        }else if(item["mapProvider"]=="N/A"){
            row.querySelector(".link").innerHTML = `<a href="${item["mapLink"]}" target="_blank">${item["mapLink"]}</a>`;
        }else{
            row.querySelector(".link").innerHTML = `<a href="${item["mapLink"]}" target="_blank">${item["mapProvider"]}</a>`;
        }

        row.querySelector(".memo").innerHTML = item["memo"];
        row.querySelector(".rating").innerHTML = item["rating"]=="Not Sure" ? item["rating"] : giveStars(item["rating"]);
        
        // hide buttons by default to only show when Edit is clicked
        if(hideEditButtons)
            row.querySelector(".buttons").style.display="none";
        else
            row.querySelector(".editEntry").setAttribute("value", `${item["placeName"]}`);

        // append the row
        dataList.appendChild(row);
    }

    addDeleteEvents();
    addEditEvents();
}
function grabKeys(array) { // array=[{"...":"...", "...":"...", ...}, {"...":"...", "...":"...", ...}, ...]
    let result = Object.keys(array[array.length-1]);
    return result;
}
function giveStars(x) {
    let stars = ["★", "★★", "★★★", "★★★★", "★★★★★"];
    return stars[parseInt(x)-1];
}

const filePath = "places1.php";

function sendxhr(method, filePath, data) {
    const xhr = new XMLHttpRequest();

    xhr.open(method, filePath);
    xhr.send(data);

    xhr.addEventListener('readystatechange', function() {
        if(this.readyState == 4) {
            console.log("Request Sent");
            // when successfully sent request, grab the response and show in html
            // placesLog = xhr.responseText;
            placesLog = JSON.parse(xhr.responseText);
            // dataNames = grabKeys(placesLog);
            showPlacesListNew(placesLog);
        }
    })
}

function submission() {
    const formPlace = document.getElementById("favPlace");
    const data = new FormData(formPlace);

    if(sendEdit) data.set("edit", sendEdit);
    // let dataInput = [];

    // for(let i of dataNames) dataInput.push(data.get(i));

    if(data.get("mapLink") == "") {
        data.set("mapProvider", "N/A");
        data.set("", "N/A");
    }

    if(isValidData(data)){ // alert when there's no input where required
        data.get("name") == "" ? highlight(nameInput) : highlight(memoInput);
    } else {
        if(data.get("mapProvider") == "none") data.set(data.get("mapProvider"), "N/A");
        if(data.get("rating") == undefined) data.set(data.get("rating"), "Not Sure");
        dehighlight(nameInput);
        dehighlight(memoInput);
        sendxhr("POST", filePath, data);
    }
}

function isValidData(data){
    return 
        data.get("placename") != "" 
        && data.get("memo") != "What's so special with this place?" 
        && data.get("memo") != "";
}

submit.addEventListener("click", submission);

sendxhr("GET", filePath);

edit.addEventListener("click", function(){
    console.log("Edit or Delete");
    showOrHide(false); // show edit and delete buttons next to each entry
    edit.style.display = "none"; // hide the edit button once clicked to forbid keep adding buttons
    done.style.display = "block"; // show the done button 
})

done.addEventListener("click", function() {
    console.log("Edit or Delete done");
    sendEdit=false;
    showOrHide(true); // show edit and delete buttons next to each entry
    done.style.display = "none"; // hide the done button once clicked to forbid keep adding buttons
    edit.style.display = "block"; // show the edit button 
})

function showOrHide(bull) { // show or hide the edit/delete buttons
    hideEditButtons = bull;
    let buttons = dataList.querySelectorAll(".buttons");
    if(hideEditButtons) {
        for(let button of buttons) button.style.display = "none";
    } else {
        for(let button of buttons) button.style.display = "inline-block";
    }
}


function createFormData(type, value) { // type: edit or delete, value: unique entry
    let sendingData = new FormData();
    sendingData.set(type, true);        
    sendingData.set("placeId", value);
    return sendingData;
}

function addDeleteEvents() {
    let deleteButtons = dataList.querySelectorAll(".deleteEntry");
    for(let deleteButton of deleteButtons) {
        deleteButton.addEventListener("click", function(event){
            let id = event.currentTarget.closest('.tableRow').getAttribute('data-id');

            // console.log("I clicked to delete "+event.target.value);
            let dataED = createFormData("delete", id);
            // console.log("edit:"+dataEdit.get("edit")+"-"+dataEdit.get("placeName"));
            sendxhr("POST", filePath, dataED);
        })
    }
}
function addEditEvents() {
    let editButtons = dataList.querySelectorAll(".editEntry");
    for(let editButton of editButtons) {
        editButton.addEventListener("click", function(event){
            sendEdit=true;
            console.log("I clicked to edit "+event.target.value);
            let targetEntry = event.target.parentElement.parentElement;
            // 1. grab value from event target innerHTML
            let dataLink = targetEntry.querySelector(".link");
            let provider;
            if(dataLink.innerHTML == "N/A") {
                provider = undefined;
                dataLink = "";
            }else {
                provider = dataLink.firstElementChild.innerHTML;
                dataLink = dataLink.firstElementChild.getAttribute("href");
            }

            let savedValues={
                "placeName": targetEntry.querySelector(".name").innerHTML, 
                "mapProvider": provider, 
                "mapLink": dataLink, 
                "memo": targetEntry.querySelector(".memo").innerHTML, 
                "rating": targetEntry.querySelector(".rating").innerHTML
            };

            // 2. reset form input
            const formPlace = document.getElementById("favPlace");
            formPlace.reset();

            // 3. give event target innerHTML value to form favPlace
            formPlace.querySelector("#placeName").setAttribute("value",savedValues["placeName"]);
            formPlace.querySelector("#placeName").focus();
            let providerOptions = formPlace.querySelector("#mapProvider").querySelectorAll("option");
            switch (savedValues["mapProvider"]) {
                case "Google Maps":
                    selectDeselect(providerOptions, 1, true);
                    break;
                case "Naver Map":
                    selectDeselect(providerOptions, 2, true);
                    break;
                case "Kakao Map":
                    selectDeselect(providerOptions, 3, true);
                    break;
                default:
                    selectDeselect(providerOptions, false, true);
                    break;
            }
            formPlace.querySelector("#mapLink").setAttribute("value",savedValues["mapLink"]);
            formPlace.querySelector("#memo").innerHTML = savedValues["memo"];
            let ratingOptions = document.getElementsByName("rating");
            switch (savedValues["rating"].length) {
                case 1:
                    selectDeselect(ratingOptions, 0);
                    break;
                case 2:
                    selectDeselect(ratingOptions, 1);
                    break;
                case 3:
                    selectDeselect(ratingOptions, 2);
                    break;
                case 4:
                    selectDeselect(ratingOptions, 3);
                    break;
                case 5:
                    selectDeselect(ratingOptions, 4);
                    break;
                default:
                    selectDeselect(ratingOptions);
                    break;
            }
        })
    }
}

function selectDeselect(elemArray, index=false, option=false) { // option=false -> radio or checkbox
    for(elem of elemArray) {
        if(option) elem.selected = false;
        else elem.checked = false;
    }
    if(index) {    
        if(option) elemArray[index].selected = true;
        else elemArray[index].checked = true;
    }
}