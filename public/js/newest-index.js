const menuBars = document.querySelector(".menu-bars");
const overlay = document.querySelector(".overlay");
const languagesIcon = document.querySelector(".navbar-languages-list");
const languagesList = document.querySelector(".languages-list");
const userNavbarArrow = document.querySelector(".user-navbar-arrow");
const userAddsList = document.querySelector(".user-adds-list");
const userNavbarImage = document.querySelector(".navbar-user-image-wrapper");

const mobileLanguageTitle = document.querySelector(".mobile-language-title");
const mobileLanguagesList = document.querySelector(".mobile-languages-list");

const videos = document.getElementsByTagName("video");
const videoPlayIcons = document.querySelectorAll(".play-wrapper");

const filterSelects = document.querySelectorAll(".select-filter");
const subSelectsCheckBoxes = document.querySelectorAll(".sub-select-check");

const searchUsersForm = document.querySelector(".search-users-form");
const searchUsersIcon = document.querySelector(".search-users-icon");

const searchBenefactorsForm = document.querySelector(
    ".search-benefactors-form"
);
const searchBenefactorsIcon = document.querySelector(
    ".search-benefactors-icon"
);

// modal buttons
const postsBtn = document.querySelector(".main-posts-add-post-button");
const profilePostsBtn = document.querySelector(".profile-add-post-button");
const appealsBtn = document.querySelector(".main-posts-add-appeal-button");
const profileAppealsBtn = document.querySelector(".profile-add-appeal-button");
const postsModalWrapper = document.querySelector(".posts-modal-wrapper");
const appealsModalWrapper = document.querySelector(".appeals-modal-wrapper");
const postsModalContnt = document.querySelector(".posts-modal-content");
const appealsModalContnt = document.querySelector(".appeals-modal-content");
const closePostsModal = document.querySelector(".close-posts-modal");
const closeAppealsModal = document.querySelector(".close-appeals-modal");

const usersFilterIcon = document.querySelector(".users-filter-icon");
const usersFilterSelects = document.querySelector(".users-filter-selects");

if (usersFilterIcon) {
    usersFilterIcon.addEventListener("click", () => {
        usersFilterSelects.classList.toggle("sh-users-filter-selects");
    });
}

const showPostsModal = () => {
    postsModalWrapper.style.display = "block";
    postsModalContnt.classList.add("show-posts-modal-content");
};

const closePostsModalHandler = () => {
    postsModalWrapper.style.display = "none";
    postsModalContnt.classList.remove("show-posts-modal-content");
};

const closeAppealsModalHandler = () => {
    appealsModalWrapper.style.display = "none";
    appealsModalContnt.classList.remove("show-posts-modal-content");
};

const showAppealsModal = () => {
    appealsModalWrapper.style.display = "block";
    appealsModalContnt.classList.add("show-posts-modal-content");
};

if (postsBtn) {
    postsBtn.addEventListener("click", showPostsModal);
}

if (profilePostsBtn) {
    profilePostsBtn.addEventListener("click", showPostsModal);
}

if (profileAppealsBtn) {
    profileAppealsBtn.addEventListener("click", showAppealsModal);
}

if (appealsBtn) {
    appealsBtn.addEventListener("click", showAppealsModal);
}

if (closePostsModal) {
    closePostsModal.addEventListener("click", closePostsModalHandler);
}

if (closeAppealsModal) {
    closeAppealsModal.addEventListener("click", closeAppealsModalHandler);
}

if (menuBars) {
    menuBars.addEventListener("click", toggleOverlay);
}

function toggleOverlay() {
    overlay.classList.toggle("show-overlay");
}

function showLanguagesList() {
    languagesList.classList.toggle("show-languages-list");
}

if (languagesIcon) {
    languagesIcon.addEventListener("click", showLanguagesList);
}

if (userNavbarArrow) {
    userNavbarArrow.addEventListener("click", showUserAddsList);
}

function showUserAddsList() {
    userAddsList.classList.toggle("show-user-adds-list");
}

if (videoPlayIcons) {
    videoPlayIcons.forEach((item) => {
        item.addEventListener("click", () => {
            item.classList.add("rm-play-wrapper");
            const targetedVideo = item.previousElementSibling;
            targetedVideo.play();
        });
    });
}

Array.from(videos).forEach((video) => {
    video.addEventListener("play", () => {
        const videoPlayIcon = video.nextElementSibling;
        videoPlayIcon.classList.add("rm-play-wrapper");
    });

    video.addEventListener("pause", () => {
        const videoPlayIcon = video.nextElementSibling;
        videoPlayIcon.classList.remove("rm-play-wrapper");
    });
});

const removeAllUsersFilters = () => {
    const filters = document.querySelectorAll(".select-sub");
    filters.forEach((filter) => {
        filter.classList.add("rm-select");
    });
};

filterSelects.forEach((item) => {
    item.addEventListener("click", () => {
        removeAllUsersFilters();
        item.querySelector(".select-sub").classList.remove("rm-select");
    });
});

subSelectsCheckBoxes.forEach((item) => {
    item.addEventListener("click", () => {
        const target = item.closest(".sub-select-item");
        target.querySelector(".anchor").click();
    });
});

if (mobileLanguageTitle) {
    mobileLanguageTitle.addEventListener("click", () => {
        console.log("aaa");
        mobileLanguagesList.classList.toggle("show-mobile-languages-list");
    });
}

if (searchUsersIcon) {
    searchUsersIcon.addEventListener("click", () => {
        searchUsersForm.submit();
    });
}

if (searchBenefactorsIcon) {
    searchBenefactorsIcon.addEventListener("click", () => {
        console.log("aa");
        searchBenefactorsForm.submit();
    });
}
