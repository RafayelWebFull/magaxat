const appealModalVideoInput = document.querySelector(".app-vi");
const appealsModalForm = document.querySelector(".appeals-modal-form");

if (appealModalVideoInput) {
    appealModalVideoInput.addEventListener("change", (e) => {
        const fileSize = e.target.files[0].size / 1024 / 1024;
        const mediaErrorSpan = document.querySelector(".app-ve");
        if (fileSize > 11) {
            appealsModalForm.addEventListener("submit", preventForm);
            mediaErrorSpan.textContent =
                "Video size cannot be larger than 10MB";
            return false;
        } else {
            mediaErrorSpan.textContent = "";
            appealsModalForm.removeEventListener("submit", preventForm);
        }
    });
}

function preventForm(e) {
    e.preventDefault();
}
