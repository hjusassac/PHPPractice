const placeList = document.getElementById("places");
const edit = document.getElementById("edit");
const done = document.getElementById("done");
const table = document.getElementById("List");
const dataList = document.querySelector("#tableBody");

let hideEditButtons = true;

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
