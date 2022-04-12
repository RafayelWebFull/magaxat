const addCommentBtn = document.querySelectorAll(".main-post-add-comment-btn");
const commentIcon = document.querySelectorAll(".main-post-comments-icon");
export const showCommentSection = async (e) => {
    const clickedCommentIcon = e.target;
    const addCommentSection = clickedCommentIcon.closest(
        ".main-post-socials-wrapper"
    ).nextElementSibling;

    addCommentSection.classList.toggle("show-main-post-comment-form-wrapper");

    const commentsSection = addCommentSection.nextElementSibling;

    commentsSection.classList.toggle("show-main-post-comments-section");
    commentsSection.scrollTop = commentsSection.scrollHeight;

    const shownCommentsSection = commentsSection.querySelectorAll(".comment");

    // if (shownCommentsSection.length > 0) {
    //     commentsSection.classList.toggle("show-main-post-comments-section");

    //     shownCommentsSection.forEach((section) => {
    //         section.remove();
    //     });
    //     return false;
    // }

    const comments = await fetchAllComments(clickedCommentIcon.id);
    if (comments.length === 0) {
        return false;
    }

    comments.forEach((comment) => {
        const commentDiv = `<div id="comment" class="comment">
            <div class="comment-date">
            <span class="comment-user-name">${comment.user.name}</span>
            <span class="comment-date">${new Date(comment.created_at)
                .toLocaleString()
                .replace(",", "")}</span>
            </div>
            <p class="comment-body">${comment.title}</p>
          </div>
            `;
        commentsSection.innerHTML += commentDiv;
    });

    // addCommentSection.classList.toggle("show-main-post-comments-section");
};

if (commentIcon) {
    commentIcon.forEach((icon) => {
        icon.addEventListener("click", showCommentSection);
    });
}

export const fetchAllComments = async (postId) => {
    const response = await axios.get(`/posts/${postId}/all-comments`);
    return response.data;
};

export const addComment = async (e) => {
    e.preventDefault();
    const addCommentBtn = e.target;
    const commentInput = e.target
        .closest(".main-post-comment-form")
        .querySelector(".main-post-form-textarea");

    const errorLabel = e.target.previousElementSibling;
    if (commentInput.value === "") {
        errorLabel.classList.add("show-comment-error-div");
        errorLabel.innerText = "Title Field Cannot Be Empty";
    } else {
        const response = await axios.post(
            `/posts/${commentInput.id}/add-comment`,
            {
                title: commentInput.value,
            }
        );

        const newComment = response.data;

        commentInput.value = "";
        const commentForm = addCommentBtn.closest(
            ".main-post-comment-form-wrapper"
        );

        const commentsCount = commentForm.previousElementSibling.querySelector(
            ".comments-count-span"
        );

        commentsCount.innerText = parseInt(commentsCount.innerText) + 1;
        errorLabel.classList.remove("show-comment-error-div");

        const newcommentDiv = `<div id="comment" class="comment">
        <div class="comment-date">
        <span class="comment-user-name">${newComment.user.name}</span>
        <span class="comment-date">${new Date(newComment.created_at)
            .toLocaleString()
            .replace(",", "")}</span>
        </div>
        <p class="comment-body">${newComment.title}</p>
      </div>
        `;
        const commentsSection = commentForm.nextElementSibling;
        commentsSection.classList.add("show-main-post-comments-section");
        commentsSection.innerHTML += newcommentDiv;
        commentsSection.scrollTop = commentsSection.scrollHeight;
    }
};

if (addCommentBtn) {
    addCommentBtn.forEach((item) => {
        item.addEventListener("click", addComment);
    });
}
