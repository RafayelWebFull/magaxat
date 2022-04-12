// import { addComment } from "../js/addPostComment.js";
// import { showCommentSection } from "../js/addPostComment.js";
// import { likePostClickHandler } from "../js/addPostLike.js";

// const postsWrapper = document.querySelector(".posts-wrapper");
// let currentPostsIds = [];
// const postDivs = document.querySelectorAll(".main-post");

// const mainPost = document.querySelector(".main-post");

// postDivs.forEach((item) => {
//     currentPostsIds.push(parseInt(item.dataset.id));
// });

// const fetchPosts = async () => {
//     const posts = await axios.get("/loadposts", {
//         params: {
//             ids: currentPostsIds,
//         },
//     });

//     posts.data.forEach((post) => {
//         currentPostsIds.push(post.id);
//     });

//     return posts.data;
// };

// const loadMorePostsAndAddEventListeners = async () => {
//     const loadedPosts = await fetchPosts();
//     loadedPosts.forEach((post) => {
//         postsWrapper.innerHTML += createPost(post);
//     });

//     document.querySelectorAll(".main-post-comments-icon").forEach((item) => {
//         item.removeEventListener("click", showCommentSection);
//         item.addEventListener("click", showCommentSection);
//     });

//     document.querySelectorAll(".main-post-comment-button").forEach((item) => {
//         item.addEventListener("click", addComment);
//     });

//     document.querySelectorAll(".post-heart-icon").forEach((item) => {
//         item.addEventListener("click", likePostClickHandler);
//     });

//     window.addEventListener("scroll", loadPosts);
// };

// const loadSpinner = document.querySelector(".more-posts-loader");

// const loadPosts = () => {
//     if (
//         window.scrollY + document.body.offsetHeight >=
//             document.body.scrollHeight &&
//         mainPost !== null
//     ) {
//         postsWrapper.appendChild(createSpinner());
//         window.removeEventListener("scroll", loadPosts);
//         setTimeout(() => {
//             postsWrapper.querySelector(".more-posts-loader").remove();
//             loadMorePostsAndAddEventListeners();
//         }, 2000);
//     }
// };

// const createSpinner = () => {
//     const spinner = document.createElement("div");
//     spinner.classList.add("more-posts-loader");
//     return spinner;
// };

// const createPost = (post) => {
//     return `
//             <div class="main-post" data-id=${post.id}>
//             <div class="main-post-user-info-wrapper">
//             ${appendUserImage(post)}
//             <div class="main-post-user-names-wrapper">
//                 <span class="main-post-user-name">${post.user.name}</span>
//                 <span class="main-post-user-email">@${post.user.name}</span>
//             </div>
//             <span class="post-date">${new Date(post.created_at)
//                 .toLocaleString()
//                 .replace(",", "")}</span>
//             </div>
//             <p class="main-post-title">${post.title}</p>
//             ${post.description ? appendPostDescription(post) : ""}
//             ${post.image_path ? appendPostImage(post) : ""}
//             ${post.video ? appendPostVideo(post) : ""}
//             <div class="main-post-comment-form-wrapper">
//                 <form class="main-post-comment-form">
//                     <div class="form-group">
//                     <textarea
//                         name="title"
//                         class="form-control main-post-form-textarea"
//                         id="${post.id}"
//                         cols="30"
//                         rows="10"
//                     ></textarea>
//                     </div>
//                     <div class="comment-error-div">
//                         <span class="comment-error-span"></span>
//                     </div>
//                     <button type="button" class="main-post-comment-button">
//                     Add Comment
//                     </button>
//                 </form>
//             </div>
//             <div class="main-post-socials">
//                 <div class="main-post-likes">
//                     <span>${post.likes ? post.likes.length : 0}</span>
//                     <i id=${post.id} class="fas fa-heart main-post-heart-icon
//                         ${
//                             checkIfAuthUserLikedPost(post)
//                                 ? "liked-post-heart-icon"
//                                 : ""
//                         }"></i>
//                 </div>
//                 <div class="main-post-comments">
//                     <span class="comments-count-span">${
//                         post.comments ? post.comments.length : 0
//                     }</span>
//                     <i class="far fa-comments main-post-comments-icon" id=${
//                         post.id
//                     }></i>
//                 </div>
//                 ${appendShareForm(post)}
//             </div>
//             <div class="main-post-comments-section"></div>
//         </div>
//     `;
// };

// function appendUserImage(post) {
//     return `
//         <div class="main-post-user-image-wrapper">
//             <img
//             src="${
//                 post.user.image ? `${post.user.image}` : "images/avatar.png"
//             }"
//             alt="user-image"
//             class="main-post-user-image"
//             />
//         </div>
//     `;
// }

// function appendPostDescription(post) {
//     return `
//         <p class="main-post-description">
//         ${post.description.substring(0, 500)}
//         </p>
//     `;
// }

// function appendPostImage(post) {
//     return `
//         <div class="main-post-image-wrapper">
//         <img src="${post.image_path}" alt="post-image" class="main-post-image" />
//         </div>
//     `;
// }

// function appendPostVideo(post) {
//     return `
//         <div class="main-post-video-wrapper">
//         <video
//             controls
//             src="${post.video.video_path}"
//             alt="video"
//             class="main-post-video"
//         ></video>
//         </div>
//     `;
// }

// function appendShareForm(post) {
//     if (
//         window.uuxyz.uuxyzd == null ||
//         (post.user_id == window.atob(window.uuxyz.uuxyzd) &&
//             post.shared_by == window.atob(window.uuxyz.uuxyzd))
//     ) {
//         return "";
//     } else {
//         const webPath = window.location.origin;
//         const csrfToken = document.querySelector(
//             'meta[name="csrf-token"]'
//         ).content;

//         return `
//         <div class="main-post-share">
//             <form action="${webPath}/posts/${post.id}/share" method="POST">
//                 <input type="hidden" name="_token" value="${csrfToken}"/>
//                 <button class="fa-solid fa-share share-btn"></button>
//             </form>
//         </div>
//     `;
//     }
// }

// // const showPostCommentSection = async (e) => {
// //     const clickedCommentIcon = e.target;
// //     const addCommentSection =
// //         clickedCommentIcon.closest(".main-post-socials").previousElementSibling;

// //     addCommentSection.classList.toggle("show-main-post-comment-form-wrapper");

// //     const commentsSection =
// //         clickedCommentIcon.closest(".main-post-socials").nextElementSibling;

// //     commentsSection.classList.toggle("show-add-comment-section");

// //     const shownCommentsSection = commentsSection.querySelectorAll(".comment");

// //     if (shownCommentsSection.length > 0) {
// //         commentsSection.classList.toggle("show-main-post-comments-section");

// //         shownCommentsSection.forEach((section) => {
// //             section.remove();
// //         });
// //         return false;
// //     }

// //     const comments = await fetchAllComments(clickedCommentIcon.id);
// //     if (comments.length === 0) {
// //         return false;
// //     }

// //     comments.forEach((comment) => {
// //         const commentDiv = `<div id="comment" class="comment">
// //         <div class="comment-date">
// //         <span class="comment-user-name">${comment.user.name}</span>
// //         <span class="comment-date">${new Date(
// //             comment.created_at
// //         ).toDateString()}</span>
// //         </div>
// //         <p class="comment-body">${comment.title}</p>
// //       </div>
// //         `;
// //         clickedCommentIcon.closest(
// //             ".main-post-socials"
// //         ).nextElementSibling.innerHTML += commentDiv;
// //     });

// //     commentsSection.classList.toggle("show-main-post-comments-section");
// // };

// function checkIfAuthUserLikedPost(post) {
//     if (window.uuxyz.uuxyzd !== null) {
//         let liked = false;
//         post.likes.forEach((item) => {
//             item.user_id === window.atob(window.uuxyz.uuxyzd)
//                 ? (liked = true)
//                 : null;
//         });
//         return liked;
//     } else {
//         return false;
//     }
// }

// window.addEventListener("scroll", loadPosts);
