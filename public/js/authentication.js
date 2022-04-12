const typesList = document.querySelectorAll(".user-type");
const interestingsList = document.querySelector(".interesting-types");
const registerForm = document.querySelector(".register-form");
const interestingListLabel = document.querySelector(".interesting-types-label");
const childTypesLabel = document.querySelector(".child-types-label");
const childTypesSelect = document.querySelector(".child-types-select");
const additionalTypes = document.querySelector(".additionals-group");
const organisationDescriptionLabel = document.querySelector(
    ".organisation-label"
);
const organisationDescriptionInput = document.querySelector(
    ".organisation-input"
);

const organisationDiv = document.querySelector(".organisation-div");
const showPasswordIcon = document.querySelector(".show-password-icon");

if (showPasswordIcon) {
    showPasswordIcon.addEventListener("click", () => {
        const passwordInput = showPasswordIcon.previousElementSibling;
        if (passwordInput.type == "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
}

if (childTypesSelect) {
    childTypesSelect.addEventListener("change", (e) => {
        if (e.target.value === "organisation") {
            console.log(organisationDiv);
            organisationDiv.classList.add("show-organisation");
        } else {
            organisationDiv.classList.remove("show-organisation");
        }
    });
}

typesList.forEach((item) => {
    item.addEventListener("change", (e) => {
        let selectedValue = e.target.value;
        if (selectedValue === "user") {
            fetchAllInterstingTypes();
            interestingListLabel.classList.add("show-interestings-list");
            additionalTypes.classList.add("show-additional-types");
        } else {
            interestingListLabel.classList.remove("show-interestings-list");
            organisationDiv.classList.remove("show-organisation");
            additionalTypes.classList.remove("show-additional-types");
            const interestingListsSelect =
                document.querySelector(".interesting-types");
            if (interestingListsSelect) interestingListsSelect.remove();
        }
    });
});

const insertAfter = (referenceNode, newNode) => {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
};

const createSelectInput = (interestingTypes = null) => {
    const interestingTypesWrapper = document.createElement("div");
    interestingTypesWrapper.classList.add("interesting-types");
    interestingTypes.forEach((type) => {
        const checkboxWrapper = document.createElement("div");
        checkboxWrapper.classList.add("checkbox-wrapper");
        const label = document.createElement("label");
        label.textContent = type.name;
        label.setAttribute("for", type.id);
        const option = document.createElement("input");
        option.setAttribute("type", "checkbox");
        option.setAttribute("id", type.id);
        option.classList.add("type-checkbox");
        option.setAttribute("name", "interesting_type[]");
        option.setAttribute("value", type.id);
        checkboxWrapper.appendChild(label);
        checkboxWrapper.appendChild(option);
        interestingTypesWrapper.appendChild(checkboxWrapper);
        insertAfter(interestingListLabel, interestingTypesWrapper);
    });
    document
        .querySelector(".interesting-types-group-div")
        .classList.add("show-interesting-types");
};

const fetchAllInterstingTypes = () => {
    axios.get("/interesting-types").then((response) => {
        if (response.data.length === 0) {
            return false;
        }
        createSelectInput(response.data);
    });
};

