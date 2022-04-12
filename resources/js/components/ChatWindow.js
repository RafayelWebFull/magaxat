import React, { Fragment, useEffect, useState } from "react";
import chat from "../src/chat";
import notify from "../src/notify";

import ChatWrapper from "./ChatWrapper";

const ChatWindow = () => {
    const authId = window.atob(window.uuxyz.uuxyzq);
    const [showChatWrapper, setShowChatWrapper] = useState(false);
    const [showAlertMessages, setShowAlertMessages] = useState(true);
    const [toUserId, setToUserId] = useState(null);
    const [viewChatUsersWrapper, setviewChatUsersWrapper] = useState(true);
    const [viewChatWrapper, setViewChatWrapper] = useState(true);

    const [users, setUsers] = useState([]);
    const [clicked, setClicked] = useState({ value: false });

    useEffect(() => {
        if (viewChatWrapper === false && window.screen.width <= 950) {
            setviewChatUsersWrapper(true);
        }
    }, [viewChatWrapper]);

    useEffect(() => {
        window.addEventListener("resize", reportWindowSize);
        if (window.screen.width <= 950) {
            setViewChatWrapper(false);
        } else {
            // console.log("here");
            setviewChatUsersWrapper(true);
            setViewChatWrapper(true);
        }
    }, []);

    const reportWindowSize = () => {
        // window.removeEventListener("resize", reportWindowSize);
        if (window.screen.width <= 950 && viewChatUsersWrapper === true) {
            // console.log(viewChatUsersWrapper);
            setViewChatWrapper(false);
        } else {
            // console.log("here");
            setviewChatUsersWrapper(true);
            setViewChatWrapper(true);
        }
    };

    useEffect(() => {
        const userNavbarcomments = document.querySelector(
            ".navbar-user-comment"
        );
        // userNavbarcomments.addEventListener("click", changeClicked);
        // userNavbarcomments.addEventListener("click", checkChatWrapper);
        const mainDiv = document.querySelector(".main");
        // mainDiv.addEventListener("click", () => {
        //     setShowChatWrapper(false);
        // });

        // const envelopes = document.querySelectorAll(".user-green-message-box");
        // envelopes.forEach((item) => {
        //     item.addEventListener("click", (e) => {
        //         e.stopPropagation();
        //         fetchTopUser(item.dataset.nid);
        //         checkChatWrapper();
        //     });
        // });
    }, []);

    // useEffect(() => {
    //     console.log(viewChatUsersWrapper);
    // }, [viewChatUsersWrapper]);

    useEffect(() => {
        window.Echo.private(`messages.${authId}`).listen(
            "NewMessageEvent",
            (event) => {
                const targetUserDiv = document.getElementById(
                    `${event.message.from}`
                );
                if (targetUserDiv) {
                    if (
                        targetUserDiv.classList.contains(
                            "active-chat-user-wrapper"
                        )
                    ) {
                        return;
                    } else {
                        targetUserDiv
                            .querySelector(".new-message-alert")
                            .classList.remove("rm-new-message-alert");
                    }
                }
            }
        );
    }, []);

    useEffect(() => {
        fetchAllUsers();
    }, []);

    // useEffect(() => {
    //     const bellIcon = document.querySelector(".bell-icon");
    //     if (bellIcon) {
    //         bellIcon.addEventListener("click", () => {
    //             setTimeout(() => {
    //                 const acceptNotification =
    //                     document.querySelectorAll(".accept-notify");

    //                 acceptNotification.forEach((item) => {
    //                     item.addEventListener("click", () => {
    //                         notificationUser(item.dataset.nid);
    //                     });
    //                 });
    //             }, 500);
    //         });
    //     }

    //     window.Echo.private(`messages.${authId}`).listen(
    //         "NewMessageEvent",
    //         (event) => {
    //             checkChatWrapperStatusBeforeAlertingNewMessageCount(
    //                 users,
    //                 event.message.user
    //             );
    //         }
    //     );
    // }, [users]);

    const fetchTopUser = (userId) => {
        setClicked({ ...clicked, value: true });
        chat.get("/top-chat-user", {
            params: { nid: userId },
        }).then((response) => {
            setUsers(response.data);
        });
    };

    const changeToUserId = (e, userId) => {
        const activeUsersClass = document.querySelectorAll(
            ".active-chat-user-wrapper"
        );
        activeUsersClass.forEach((item) =>
            item.classList.remove("active-chat-user-wrapper")
        );

        const parentElement = e.target.closest(".chat-user-wrapper");

        const newMessageAlert =
            parentElement.querySelector(".new-message-alert");

        if (newMessageAlert) {
            newMessageAlert.classList.remove("show-user-new-message-alert");
        }
        parentElement.classList.add("active-chat-user-wrapper");
        parentElement
            .querySelector(".new-message-alert")
            .classList.add("rm-new-message-alert");

        // window.Echo.leave(`messages.${toUserId}.${authId}`);

        setToUserId(userId);
        setViewChatWrapper(true);
        setviewChatUsersWrapper((prevStatus) =>
            viewChatWrapper == true ? prevStatus : false
        );
    };

    const notificationUser = async (nid) => {
        const response = await notify.get("/notification-user", {
            params: { nid: nid },
        });
        setUsers([...users, response.data]);
    };

    const checkChatWrapper = () => {
        setShowChatWrapper((prevStatus) => !prevStatus);
    };

    const changeClicked = () => {
        setUsers([]);
        setClicked({ ...clicked, value: false });
    };

    const fetchAllUsers = () => {
        if (users.length !== 0) return;
        chat.get("/chat-users").then((response) => {
            setUsers(response.data);
        });
    };

    const checkChatWrapperStatusBeforeAlertingNewMessageCount = (
        subscribers,
        userToCheck
    ) => {
        const targetUser = subscribers.findIndex(
            (user) => userToCheck.id === user.id
        );

        if (targetUser === -1) {
            return false;
        } else {
            createAlertMessage();
        }
    };

    const createAlertMessage = () => {
        if (document.querySelector(".chat-wrapper") !== null) return false;

        const messagesCount = document.querySelector(".messages-count");
        if (!messagesCount) {
            const chat = document.querySelector(".chat");
            const alertMessageWrapper = document.createElement("div");
            alertMessageWrapper.classList.add("alert-message-wrapper");
            const alertMessage = document.createElement("div");
            alertMessage.classList.add("alert-new-message");
            const messageCountSpan = document.createElement("span");
            messageCountSpan.classList.add("messages-count");
            messageCountSpan.textContent = 1;
            alertMessageWrapper.appendChild(alertMessage);
            alertMessageWrapper.appendChild(messageCountSpan);
            chat.prepend(alertMessageWrapper);
        } else {
            messagesCount.textContent = parseInt(messagesCount.textContent) + 1;
        }
    };

    const renderLastMessage = (user) => {
        return user.messages.map((message) => {
            if (message.type === "image") {
                return "image file";
            } else if (message.type === "video") {
                return "video file";
            } else {
                return message.message;
            }
        });
    };

    const renderLastMessageDate = (user) => {
        return user.messages.map((message) => {
            return new Date(message.created_at).toLocaleString("en-US", {
                hour: "numeric",
                minute: "numeric",
                hour12: true,
            });
        });
    };

    const renderredUsers = (users) => {
        return users.map((user) => {
            return (
                <div
                    className="chat-user-wrapper"
                    onClick={(e) => {
                        changeToUserId(e, user.unique_id);
                    }}
                    key={user.id}
                    id={user.unique_id}
                >
                    <div className="chat-user-image-wrapper">
                        <img
                            src={
                                user.image !== null
                                    ? `${user.image}`
                                    : `../../images/avatar.png`
                            }
                            className="chat-user-image"
                            alt="user-image"
                        />
                    </div>
                    <div className="chat-user-info-wrapper">
                        <span className="chat-user-name">{user.name}</span>
                        <span className="chat-user-last-message">
                            {renderLastMessage(user)}
                        </span>
                    </div>
                    <div className="chat-user-date-wrapper">
                        <span> {renderLastMessageDate(user)}</span>
                    </div>
                    <div className="new-message-alert rm-new-message-alert"></div>
                </div>
            );
        });
    };

    return (
        // <div className="chat">
        //     <i
        //         className="far fa-comments navbar-user-comment"
        //         onClick={() => {
        //             setShowAlertMessages(!showAlertMessages);
        //         }}
        //     ></i>

        //     {showChatWrapper ? (
        //         <ChatWrapper
        //             showAlertMessages={showAlertMessages}
        //             fetchedUsers={users}
        //             clicked={clicked}
        //         />
        //     ) : (
        //         ""
        //     )}
        // </div>
        <Fragment>
            <div className="chat-wrapper">
                {viewChatUsersWrapper ? (
                    <div className="chat-users-list-wrapper">
                        <div className="chat-users-list">
                            {renderredUsers(users)}
                        </div>
                    </div>
                ) : (
                    ""
                )}

                {viewChatWrapper ? (
                    <ChatWrapper
                        setViewChatWrapper={setViewChatWrapper}
                        toUserId={toUserId}
                    />
                ) : (
                    ""
                )}
            </div>
        </Fragment>
    );
};

export default ChatWindow;
