// const modalChecker = document.querySelector(".modal-checker");
// const modalImageInputContainer = document.querySelector(
//     ".modal-image-container"
// );

// const modalCheckerContainer = document.querySelector(
//     ".modal-checker-container"
// );

// const removeImageInput = () => {
//     document.querySelector(".post-modal-image-container").remove();
// };

// const removeVideoInput = () => {
//     document.querySelector(".post-modal-video-container").remove();
// };

// const addmodalVideoInput = () => {
//     const videoInput = `
//     <div class="form-group post-modal-video-container">
//               <label class="create-post-label" for="video">Video</label>
//               <input type="file" accept="video/*" class="form-control" name="post_video">
//           </div>

//     `;

//     modalCheckerContainer.insertAdjacentHTML("afterend", videoInput);
// };

// const addModalImageInput = () => {
//     const imageInput = `
//     <div class="form-group post-modal-image-container">
//               <label class="create-post-label" for="image">Image</label>
//               <input type="file" accept="image/*" class="form-control" name="post_image">
//           </div>

//     `;

//     modalCheckerContainer.insertAdjacentHTML("afterend", imageInput);
// };

// const changeModalInputs = (e) => {
//     e.target.classList.toggle("change-modal-checker");
//     const imageContainer = document.querySelector(
//         ".post-modal-image-container"
//     );
//     console.log(imageContainer);
//     if (imageContainer) {
//         console.log("image");
//         removeImageInput();
//         addmodalVideoInput();
//     } else {
//         console.log("video");

//         removeVideoInput();
//         addModalImageInput();
//     }
// };

// if (modalChecker) {
//     modalChecker.addEventListener("click", changeModalInputs);
// }

const postModalMediaTypeInput = document.querySelector(".media-type");
postModalMediaTypeInput.addEventListener("change", () => {
    const mediaType =
        postModalMediaTypeInput.options[postModalMediaTypeInput.selectedIndex]
            .value;

    const mediaInput = document.querySelector(".media-input");
    const postsModalForm = document.querySelector(".posts-modal-form");

    if (mediaType === "video") {
        mediaInput.setAttribute("accept", "video/mp4");
        mediaInput.setAttribute("name", "post_video");
        mediaInput.classList.add("post_video");
        if (mediaInput) {
            mediaInput.addEventListener("change", (e) => {
                const fileSize = e.target.files[0].size / 1024 / 1024;
                const mediaErrorSpan = document.querySelector(".mv-e");
                if (fileSize > 11) {
                    postsModalForm.addEventListener("submit", preventForm);
                    mediaErrorSpan.textContent =
                        "Video size cannot be larger than 10MB";
                    return false;
                } else {
                    mediaErrorSpan.textContent = "";
                    postsModalForm.removeEventListener("submit", preventForm);
                }
            });
        }
    } else if (mediaType === "image") {
        mediaInput.classList.remove("post_video");
        mediaInput.setAttribute("accept", "image/*");
        mediaInput.setAttribute("name", "post_image");
    }
});

function preventForm(e) {
    e.preventDefault();
}
