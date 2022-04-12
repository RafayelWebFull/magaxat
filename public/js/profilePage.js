const profileListItems = document.querySelectorAll(".profile-item");
const additionalTypeInput = document.getElementById("additional_type");
const organisationDescription = document.querySelector(".org-d");

const additionalTypeHandler = () => {
    if (
        additionalTypeInput.options[additionalTypeInput.selectedIndex].value ==
        "organisation"
    ) {
        organisationDescription.classList.remove("d-none");
        organisationDescription.classList.add("d-block");
    } else {
        organisationDescription.classList.remove("d-block");
        organisationDescription.classList.add("d-none");
    }
};

// additionalTypeInput.addEventListener("change", (e) => {
//     additionalTypeHandler(e);
// });

profileListItems.forEach((item) => {
    item.addEventListener("click", (e) => {
        removeActiveItem();
        e.target.classList.add("active-nav");
    });
});

const removeActiveItem = () => {
    const activeItems = document.querySelectorAll(".active-nav");
    activeItems.forEach((item) => {
        item.classList.remove("active-nav");
    });
};

const tabBtn = document.querySelectorAll(".nav ul li");

function tabs(panelIndex) {
    const tab = document.querySelectorAll(".tab");
    tab.forEach(function (node) {
        node.style.display = "none";
    });
    tab[panelIndex].style.display = "block";
}
tabs(0);

const today = new Date();
const eighteenYearsAgo = today.setFullYear(today.getFullYear() - 18);
const maxDate = new Date(eighteenYearsAgo).toISOString().split("T")[0];
const dateInput = document.getElementById("date_of_birth");
if (dateInput) {
    dateInput.max = maxDate;
}
