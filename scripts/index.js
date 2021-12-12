const addStudentPopUp = document.getElementById("addStudentPopUp");
const addStudentButton = document.getElementById("addStudentButton");
const goBackButton = document.getElementById("goBack");
const popUpBackground = document.getElementById("popUpBackground");
const goBackIfStudentExists = document.getElementById("goBackIfStudentExists");

goBackButton.addEventListener("click", function() {
	hideAddStudentPopUp();
});

function hideAddStudentPopUp() {
	addStudentPopUp.style.display = "none";
}

addStudentButton.addEventListener("click", function() {
	showPopUpAddStudent();
});

function showPopUpAddStudent() {
	addStudentPopUp.style.display = "block";
}

if (goBackIfStudentExists) {
	goBackIfStudentExists.addEventListener("click", function() {
		hidestudentExistsPopUp();
	});
}

function hidestudentExistsPopUp() {
	studentExistsPopUp.style.display = "none";
	addStudentPopUp.style.display = "block";
}



