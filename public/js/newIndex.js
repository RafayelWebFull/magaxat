const menuBars = document.getElementById("menu-bars");
const overlay = document.querySelector(".overlay");
const userNavbarArrow = document.querySelector(".user-navbar-arrow-down");
const userNavbarList = document.querySelector(".user-navbar-list");
const navbarChatIcon = document.querySelector(".navbar-user-comment");
const chatWrapper = document.querySelector(".chat-wrapper");
const chatArrow = document.querySelector(".chat-arrow");

const postsBtn = document.querySelector(".main-posts-add-post-button");
const appealsBtn = document.querySelector(".main-posts-add-appeal-button");
const postsModalWrapper = document.querySelector(".posts-modal-wrapper");
const appealsModalWrapper = document.querySelector(".appeals-modal-wrapper");
const postsModalContnt = document.querySelector(".posts-modal-content");
const appealsModalContnt = document.querySelector(".appeals-modal-content");
const closePostsModal = document.querySelector(".close-posts-modal");
const closeAppealsModal = document.querySelector(".close-appeals-modal");

const navbarLangIcon = document.querySelector(".navbar-language-item");
const languagesList = document.querySelector(".language-list");
const mobileLanguageTitle = document.querySelector(".mobile-language-title");
const mobileLanguagesList = document.querySelector(".mobile-languages-list");

const filterUsersIcon = document.querySelector(".filter-users-wrapper");
const filtersList = document.querySelector(".filters-list");
const filterItems = document.querySelectorAll(".filter-item");
const subFilterLists = document.querySelectorAll(".sub-filters-list");
const filterArrows = document.querySelectorAll(".filter-item-arrow");

const userGreenButton = document.querySelector(".one-user-green-button");
const userAdditionalInfo = document.querySelector(".user-additional-info");

const logoutAnchor = document.querySelector(".logout");
const logoutForm = document.querySelector(".logout-form");

const profileImageInput = document.querySelector(".profile-image-input");

const mainDiv = document.querySelector(".main");

if (postsModalContnt) {
    postsModalContnt.addEventListener("click", (e) => {
        e.stopPropagation();
    });
}

if (appealsModalContnt) {
    appealsModalContnt.addEventListener("click", (e) => {
        e.stopPropagation();
    });
}

if (postsModalWrapper) {
    postsModalWrapper.addEventListener("click", (e) => {
        postsModalContnt.classList.remove("show-posts-modal-content");
        postsModalWrapper.style.display = "none";
    });
}

if (appealsModalWrapper) {
    appealsModalWrapper.addEventListener("click", () => {
        appealsModalContnt.classList.remove("show-posts-modal-content");
        appealsModalWrapper.style.display = "none";
    });
}

navbarLangIcon.addEventListener("click", () => {
    languagesList.classList.toggle("show-language-list");
});

mainDiv.addEventListener("click", () => {
    // if (chatWrapper) {
    //     chatWrapper.classList.remove("show-chat-wrapper");
    // }

    if (chatArrow) {
        chatArrow.classList.remove("show-chat-arrow");
    }

    if (
        userNavbarList &&
        userNavbarList.classList.contains("show-user-navbar-list")
    ) {
        userNavbarList.classList.remove("show-user-navbar-list");
    }

    if (filtersList) {
        filtersList.classList.remove("show-filters-list");
    }
    if (overlay.classList.contains("menu-slide-right")) {
        menuBars.classList.toggle("menu-active");
        overlay.classList.toggle("menu-slide-right");
        overlay.classList.toggle("menu-slide-left");
    }
});

if (logoutAnchor) {
    logoutAnchor.addEventListener("click", () => {
        logoutForm.submit();
    });
}

const showPostsModal = () => {
    postsModalWrapper.style.display = "block";
    postsModalContnt.classList.add("show-posts-modal-content");
};

const showAppealsModal = () => {
    appealsModalWrapper.style.display = "block";
    appealsModalContnt.classList.add("show-posts-modal-content");
};

if (postsBtn) {
    postsBtn.onclick = () => {
        showPostsModal();
    };
}

if (appealsBtn) {
    appealsBtn.onclick = function () {
        showAppealsModal();
    };
}

if (closePostsModal) {
    closePostsModal.onclick = function () {
        postsModalWrapper.style.display = "none";
    };
}

if (closeAppealsModal) {
    closeAppealsModal.onclick = function () {
        appealsModalWrapper.style.display = "none";
    };
}

if (userGreenButton) {
    userGreenButton.addEventListener("click", () => {
        userAdditionalInfo.classList.toggle("show-additional-info");
    });
}

if (filterUsersIcon) {
    filterUsersIcon.addEventListener("click", (e) => {
        e.stopPropagation();
        subFilterLists.forEach((list) => {
            list.style.display = "none";
        });
        filtersList.classList.toggle("show-filters-list");

        filterArrows.forEach((arrow) => {
            arrow.classList.remove("active-filter-arrow");
        });
    });
}

const filterItemClickHandler = (e) => {
    subFilterLists.forEach((list) => {
        list.style.display = "none";
    });

    e.stopPropagation();

    filterArrows.forEach((arrow) => {
        arrow.classList.remove("active-filter-arrow");
    });

    const clickedItemList = e.target
        .closest(".filter-item")
        .querySelector(".sub-filters-list");

    const filterArrow = e.target
        .closest(".filter-item")
        .querySelector(".filter-item-arrow");
    filterArrow.classList.toggle("active-filter-arrow");

    if (clickedItemList.style.display == "none") {
        clickedItemList.style.display = "block";
    } else {
        clickedItemList.style.display = "none";
    }
};

if (filterItems) {
    filterItems.forEach((item) => {
        item.addEventListener("click", filterItemClickHandler);
    });
}

if (navbarChatIcon) {
    navbarChatIcon.addEventListener("click", (e) => {
        e.stopPropagation();
        // chatWrapper.classList.toggle("show-chat-wrapper");
        // chatArrow.classList.toggle("show-chat-arrow");
    });
}

menuBars.addEventListener("click", toggleMenu);
function toggleMenu() {
    menuBars.classList.toggle("menu-active");
    if (menuBars.classList.contains("menu-active")) {
        overlay.classList.add("menu-slide-right");
        overlay.classList.remove("menu-slide-left");
    } else {
        overlay.classList.remove("menu-slide-right");
        overlay.classList.add("menu-slide-left");
    }
}

if (userNavbarArrow) {
    userNavbarArrow.addEventListener("click", () => {
        userNavbarList.classList.toggle("show-user-navbar-list");
    });
}

if (mobileLanguageTitle) {
    mobileLanguageTitle.addEventListener("click", () => {
        console.log("aaa");
        mobileLanguagesList.classList.toggle("show-mobile-languages-list");
    });
}
