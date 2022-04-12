import React, { useEffect, useState, useRef, Fragment } from "react";
import chat from "../src/chat";
import InputEmoji from "react-input-emoji";
import notify from "../src/notify";

const ChatWrapper = (props) => {
    const [users, setUsers] = useState([]);
    const [messages, setMessages] = useState([]);
    const [newMessage, setNewMessage] = useState(null);
    const [toUserId, setToUserId] = useState(null);
    const [chattingWithUser, setChattingWithUser] = useState(null);
    const [chattingUserImage, setchattingUserImage] = useState(null);
    const [blockedUserId, setBlockedUserId] = useState(null);
    const authId = window.atob(window.uuxyz.uuxyzq);
    const [spinner, setSpinner] = useState(null);
    const [userIsAlreadyBlocked, setUserIsAlreadyBlocked] = useState(null);
    const [blockMessage, setBlockMessage] = useState(null);
    const scrollToEndRef = useRef(null);

    const userBlocker = document.querySelector(".sound-checker");
    const userBlockerBackground = document.querySelector(
        ".sound-checker-background"
    );

    useEffect(() => {
        setUsers(props.fetchedUsers);
    }, [props.fetchedUsers]);

    useEffect(() => {
        window.Echo.leave(`messages.${props.toUserId}.${authId}`);

        fetchAllMessagesWithUser(props.toUserId);
    }, [props.toUserId]);

    // useEffect(() => {
    //     if (props.clicked.value === false) {
    //         fetchAllUsers();
    //     }

    //     if (props.fetchedUsers.length === 0) {
    //         return;
    //     }
    // }, []);

    const changeToUserId = (e, userId) => {
        const activeUsersClass = document.querySelectorAll(
            ".current-active-user"
        );
        activeUsersClass.forEach((item) =>
            item.classList.remove("current-active-user")
        );

        if (e === null) {
            const chatUsersList = document.querySelector(".chat-users-list");
            chatUsersList.children[0].classList.toggle("current-active-user");
        } else {
            const parentElement = e.target.closest(".chat-user-wrapper");
            parentElement
                .querySelector(".user-new-message-alert")
                .classList.remove("show-user-new-message-alert");
            parentElement.classList.toggle("current-active-user");
        }

        window.Echo.leave(`messages.${props.toUserId}.${authId}`);

        setToUserId(userId);
    };

    // const notificationUser = async (nid) => {
    //     const response = await notify.get("/notification-user", {
    //         params: { nid: nid },
    //     });
    //     setUsers([...users, response.data]);
    // };

    // useEffect(() => {
    //     const chatInput = document.querySelector(".react-input-emoji--wrapper");
    //     chatInput.addEventListener("click", (e) => {
    //         e.target.classList.add("react-input-emoji--input2");
    //     });
    // }, []);

    useEffect(() => {
        // const bellIcon = document.querySelector(".bell-icon");
        // if (bellIcon) {
        //     bellIcon.addEventListener("click", () => {
        //         setTimeout(() => {
        //             const acceptNotification =
        //                 document.querySelectorAll(".accept-notify");
        //             acceptNotification.forEach((item) => {
        //                 item.addEventListener("click", () => {
        //                     notificationUser(item.dataset.nid);
        //                 });
        //             });
        //         }, 500);
        //     });
        // }
        // if (users.length !== 0 && props.fetchedUsers.length !== 0) {
        //     changeToUserId(null, props.fetchedUsers[0].unique_id);
        // }
    }, [users]);

    // useEffect(() => {
    //     fetchAllMessagesWithUser(toUserId);
    // }, [toUserId]);

    // useEffect(() => {
    //     console.log(messages);
    // }, [messages]);

    const onKeyUp = (e) => {
        if (props.toUserId === null) {
            return false;
        }

        if (e.keyCode === 13) {
            sendMessage();
        }
    };

    useEffect(() => {
        if (spinner === null) {
            return false;
        }
        showBlockButtons();
    }, [spinner]);

    useEffect(() => {
        if (userIsAlreadyBlocked === null) {
            return;
        }
        if (userIsAlreadyBlocked) {
            addBlockedUserStyle();
        } else {
            removeBlockedUserStyle();
        }
    }, [userIsAlreadyBlocked]);

    useEffect(() => {
        prevMessages.current = messages;
    });

    const prevMessages = useRef([]);

    useEffect(() => {
        document.querySelector(".chat-messages-section").scrollTop =
            document.querySelector(".chat-messages-section").scrollHeight;
    }, [messages]);

    useEffect(() => {
        removeAlertMessagesWrapper();
    }, [props.showAlertMessages]);

    // useEffect(() => {
    //     if (toUserId === null) {
    //         return false;
    //     }
    //     window.Echo.private(`blocked-user-channel.${authId}`).listen(
    //         "BlockUserEvent",
    //         (event) => {
    //             if (
    //                 authId === event.blockedUser.user_id &&
    //                 toUserId === event.blockedUser.blocker_id
    //             ) {
    //                 // setUserIsAlreadyBlocked(true);
    //                 setBlockMessage(`You have been blocked by this user!`);
    //             }
    //         }
    //     );

    //     window.Echo.private(`unblocked-user-channel.${authId}`).listen(
    //         "UnblockUserEvent",
    //         (event) => {
    //             if (event.if_i_still_blocked_the_user) {
    //                 setBlockMessage(
    //                     "You cannot send messages to a user you blocked!"
    //                 );
    //             } else {
    //                 setBlockMessage(null);
    //             }
    //             setUserIsAlreadyBlocked(null);
    //         }
    //     );
    // }, [toUserId]);

    const createAlertMessage = () => {
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

    const checkForTargetChatUserElement = (targetChatUser) => {
        if (targetChatUser) {
            targetChatUser
                .querySelector(".user-new-message-alert")
                .classList.add("show-user-new-message-alert");
        }
    };

    // useEffect(() => {
    //     if (users.length > 0) {
    //         window.Echo.leave(`messages.${authId}`);

    //         window.Echo.private(`messages.${authId}`).listen(
    //             "NewMessageEvent",
    //             (event) => {
    //                 checkChatWrapperStatusBeforeAlertingNewMessageCount(
    //                     users,
    //                     event.message.user
    //                 );

    //                 if (toUserId === event.message.user.unique_id) return false;

    //                 const targetChatUser = document.getElementById(
    //                     event.message.user.unique_id
    //                 );
    //                 checkForTargetChatUserElement(targetChatUser);

    //                 return false;
    //             }
    //         );
    //     }
    // }, [toUserId]);

    // const checkChatWrapperStatusBeforeAlertingNewMessageCount = (
    //     subscribers,
    //     userToCheck
    // ) => {
    //     const targetUser = subscribers.findIndex(
    //         (user) => userToCheck.id === user.id
    //     );

    //     if (targetUser === -1) {
    //         return false;
    //     }

    //     if (document.querySelector(".chat-wrapper") === null) {
    //         createAlertMessage();
    //     } else {
    //         return false;
    //     }
    // };

    const removeAlertMessagesWrapper = () => {
        const alertMessages = document.querySelector(".alert-message-wrapper");
        if (alertMessages) {
            alertMessages.remove();
        }
    };

    // const blockUserStyle = async () => {
    //     if (!chattingWithUser) {
    //         return;
    //     }

    //     if (toUserId === blockedUserId) {
    //         setBlockedUserId(null);
    //         setUserIsAlreadyBlocked(false);
    //         setSpinner(true);

    //         const unBlockResponse = await chat.post("/unblock-user/", {
    //             unblockedUser: blockedUserId,
    //         });
    //         setTimeout(() => {
    //             setSpinner(null);
    //         }, 3000);

    //         if (unBlockResponse.data.stillBlocked) {
    //             setBlockMessage(`You were blocked by this user!`);
    //         } else {
    //             setBlockMessage("");
    //         }
    //     } else {
    //         setBlockedUserId(toUserId);
    //         setUserIsAlreadyBlocked(true);
    //         setSpinner(true);
    //         setBlockMessage(`You cannot send messages to a user you blocked!`);

    //         await chat.post("/block-user/", {
    //             blockedUser: toUserId,
    //         });

    //         setTimeout(() => {
    //             setSpinner(false);
    //         }, 5000);
    //         // setSpinner(false);
    //     }
    // };

    // const removeBlockedUserStyle = () => {
    //     if (userBlockerBackground && userBlockerBackground) {
    //         userBlockerBackground.classList.remove(
    //             "change-sound-checker-background"
    //         );
    //         userBlocker.classList.remove("change-sound-checker");
    //     }
    // };

    // const addBlockedUserStyle = () => {
    //     userBlockerBackground.classList.add("change-sound-checker-background");
    //     userBlocker.classList.add("change-sound-checker");
    // };

    // const showBlockButtons = () => {
    //     if (spinner) {
    //         return <div className="loader"></div>;
    //     } else if (spinner === null) {
    //         return (
    //             <Fragment>
    //                 <div className="sound-checker-background"></div>
    //                 <div
    //                     className="sound-checker"
    //                     onClick={(e) => {
    //                         blockUserStyle(e);
    //                     }}
    //                 ></div>

    //                 <span className="check-sound">блок</span>
    //             </Fragment>
    //         );
    //     } else if (spinner === false && blockMessage !== "") {
    //         return (
    //             <Fragment>
    //                 <div className="sound-checker-background change-sound-checker-background"></div>
    //                 <div
    //                     className="sound-checker change-sound-checker"
    //                     onClick={(e) => {
    //                         blockUserStyle(e);
    //                     }}
    //                 ></div>

    //                 <span className="check-sound">Звук</span>
    //             </Fragment>
    //         );
    //     }
    // };

    window.Echo.private(`unblocked-user-channel.${authId}`).listen(
        "UnblockUserEvent",
        (event) => {
            setUserIsAlreadyBlocked(null);
        }
    );

    const fetchAllUsers = () => {
        if (users.length !== 0) return;
        chat.get("/chat-users").then((response) => {
            setUsers(response.data);
        });
    };

    const renderredMessages = (messages) => {
        if (messages === null) {
            return;
        }
        return messages.map((message, index) => {
            if (message.user.unique_id === authId) {
                return (
                    // <div className="sent-message-wrapper" key={index}>
                    //     <div className="sent-message-user-image-wrapper">
                    //         <img
                    //             src={
                    //                 message.user.image !== null
                    //                     ? `${message.user.image}`
                    //                     : `../../images/avatar.png`
                    //             }
                    //             alt="user-image"
                    //             className="chat-user-image"
                    //         />
                    //     </div>
                    //     <div className="sent-message-info">
                    //         {renderMessageType(message)}
                    //     </div>
                    // </div>
                    <div className="sent-message-wrapper" key={index}>
                        <p className="sent-message-date">
                            {new Date(message.created_at).toLocaleString(
                                "en-US",
                                {
                                    hour: "numeric",
                                    minute: "numeric",
                                    hour12: true,
                                }
                            )}
                        </p>
                        <div className="sent-message">
                            {renderMessageType(message)}
                        </div>
                    </div>
                );
            } else {
                return (
                    // <div className="received-message-wrapper" key={index}>
                    //     <div className="received-message-user-image-wrapper">
                    //         <a href={`/all-users/${toUserId}`}>
                    //             <img
                    //                 src={
                    //                     message.user.image !== null
                    //                         ? `${message.user.image}`
                    //                         : `../../images/avatar.png`
                    //                 }
                    //                 alt="user-image"
                    //                 className="chat-user-image"
                    //             />
                    //         </a>
                    //     </div>
                    //     <div className="received-message-info">
                    //         {renderMessageType(message)}
                    //     </div>
                    // </div>
                    <div className="received-message-wrapper" key={index}>
                        <p className="received-message-date">
                            {new Date(message.created_at).toLocaleString(
                                "en-US",
                                {
                                    hour: "numeric",
                                    minute: "numeric",
                                    hour12: true,
                                }
                            )}
                        </p>
                        <div className="received-message">
                            {renderMessageType(message)}
                        </div>
                    </div>
                );
            }
        });
    };

    const renderMessageType = (message) => {
        if (message.type === "image") {
            return (
                <a download={"image"} href={message.media_path}>
                    <img
                        className="message-image"
                        src={`${message.media_path}`}
                    />
                </a>
            );
        } else if (message.type === "video") {
            return (
                <video
                    controls={true}
                    className="message-video"
                    src={`${message.media_path}`}
                ></video>
            );
        }
        return <p className="message">{message.message}</p>;
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
                    <div className="user-new-message-alert"></div>
                    <div className="chat-user-image-wrapper">
                        <img
                            src={
                                user.image !== null
                                    ? `${user.image}`
                                    : `../../images/avatar.png`
                            }
                            className="chat-user-image"
                            alt=""
                        />
                    </div>
                    <div className="chat-user-name">{user.name}</div>
                </div>
            );
        });
    };

    const renderWelcomeMessage = () => {
        if (toUserId === null) {
            return (
                <p className="welcome-message">
                    <span>Note: </span> You need to subscribe to a user to be
                    able to chat with him, also if a user is not subscribed to
                    you he will not be able to receive your messages
                </p>
            );
        }

        return "";
    };

    const sendMessage = (e) => {
        if (newMessage === null || newMessage === "") {
            return false;
        }

        // console.log("ssss");
        // document.querySelector(".react-input-emoji--input").textContent = "";
        const chatInput = document.querySelector(".chat-input");
        chatInput.value = "";
        chat.post("/messages", {
            to: props.toUserId,
            message: newMessage,
        }).then((response) => {
            setNewMessage(null);
            setMessages([...messages, response.data.sent_message]);
        });
    };

    const sendMedia = (e) => {
        if (props.toUserId == null) {
            return false;
        }
        let formdata = new FormData();
        const image = e.target.files[0];
        formdata.append("file", image);
        formdata.append("to", props.toUserId);
        const fileSize = e.target.files[0].size / 1024 / 1024;
        if (fileSize > 2) {
            alert("maximum size is 2 MB");
            return false;
        }

        chat.post("/messages", formdata).then((response) => {
            setMessages([...messages, response.data.sent_message]);
            e.target.value = "";
        });
    };

    const fetchAllMessagesWithUser = (toUserId) => {
        if (toUserId === null) {
            return false;
        }

        window.Echo.private(`messages.${props.toUserId}.${authId}`).listen(
            "NewMessageEvent",
            (event) => {
                prevMessages.current.push(event.message);
                setMessages([...prevMessages.current]);
            }
        );

        chat.get(
            `/messages?from=${window.btoa(authId)}&to=${window.btoa(toUserId)}`
        ).then((response) => {
            if (response.data.messages.length === 0) {
                setMessages(response.data.messages);
                prevMessages.current = [];
            } else {
                setMessages(response.data.messages);
                prevMessages.current = [];
            }

            setChattingWithUser(response.data.chatting_with_user.name);
            setchattingUserImage(response.data.chatting_with_user.image);
            if (
                response.data.blocked_this_user &&
                response.data.blocked_by_this_user
            ) {
                // setUserIsAlreadyBlocked(true);
                // setBlockedUserId(toUserId);
                // setBlockMessage("You both blocked each other!");
                // addBlockedUserStyle();
            } else if (response.data.blocked_this_user) {
                // setUserIsAlreadyBlocked(true);
                // setBlockedUserId(toUserId);
                // setBlockMessage(
                //     "You cannot send messages to a user you blocked!"
                // );
                // addBlockedUserStyle();
            } else if (response.data.blocked_by_this_user) {
                // setBlockMessage("You were blocked by this user!");
                // removeBlockedUserStyle();
            } else {
                setBlockMessage(null);
                // removeBlockedUserStyle();
            }
        });
    };

    const renderChatButtons = () => {
        return (
            <div>
                <div className="chat-attachement-wrapper">
                    <input
                        className="fas fa-paperclip chat-paperclip"
                        type="file"
                        name="file"
                        accept="image/*,video/*"
                        onChange={(e) => {
                            sendMedia(e);
                        }}
                    />
                </div>

                <InputEmoji
                    onChange={setNewMessage}
                    cleanOnEnter
                    onEnter={(e) => {
                        onKeyUp(e);
                    }}
                    placeholder="Напишите ..."
                />
                <div className="chat-send-wrapper">
                    <i
                        className="fas fa-paper-plane chat-paper-plane"
                        onClick={sendMessage}
                    ></i>
                </div>
            </div>
        );
    };

    const renderBlockedChatMessage = () => {
        return (
            <div>
                <p style={{ textAlign: "center" }}>{blockMessage}</p>
            </div>
        );
    };

    const renderChattingWithUserImage = () => {
        if (chattingWithUser) {
            if (chattingUserImage) {
                return <img src={chattingUserImage} alt="person" />;
            } else {
                return <img src="../../images/avatar.png" alt="person" />;
            }
        }
    };

    return (
        // <div>
        //     {" "}
        //     <i className="fas fa-caret-up chat-arrow"></i>
        //     <div className="chat-wrapper">
        //         <div className="active-users-section">
        //             <div className="active-users-top-section">
        //                 {showBlockButtons()}
        //             </div>
        //             <div className="active-users">
        //                 <div className="active-users-search-wrapper">
        //                     <i className="fas fa-search active-users-search"></i>
        //                     <i className="fas fa-window-close active-users-close"></i>
        //                     <input
        //                         className="active-users-input"
        //                         placeholder="Поиск"
        //                         type="text"
        //                     />
        //                 </div>
        //                 <div className="chat-users-list">
        //                     {renderredUsers(users)}
        //                 </div>
        //             </div>
        //         </div>
        //         <div className="messages-section">
        //             <div className="messages-top-section">
        //                 <div className="chatting-with-user">
        //                     {" "}
        //                     <a href={`/all-users/${toUserId}`}>
        //                         {chattingWithUser}
        //                     </a>
        //                 </div>
        //                 <div className="chatting-user-status">
        //                     <div className="chatting-user-status-icon"></div>
        //                     <div className="chat-status-text">online</div>
        //                 </div>
        //             </div>
        //             <div className="messages-middle-section">
        //                 <div className="scroll" ref={scrollToEndRef}>
        //                     {renderredMessages(messages)}
        //                     {renderWelcomeMessage()}
        //                 </div>
        //             </div>
        //             <div className="messages-bottom-section">
        //                 <div className="chat-inputs-wrapper">
        //                     {blockMessage
        //                         ? renderBlockedChatMessage()
        //                         : renderChatButtons()}
        //                 </div>
        //             </div>
        //         </div>
        //     </div>
        // </div>

        <Fragment>
            <div className="active-chat-wrapper">
                <div className="chatting-with-user">
                    <div className="chatting-with-user-image-wrapper">
                        <i
                            className="fa-solid fa-chevron-left chat-back-icon"
                            onClick={() => {
                                props.setViewChatWrapper(false);
                            }}
                        ></i>
                        {renderChattingWithUserImage()}
                    </div>
                    <div className="chatting-with-user-name">
                        <p>{chattingWithUser}</p>
                    </div>
                </div>
                <div className="chat-messages-section">
                    {/* <div className="sent-message-wrapper">
                        <p className="sent-message-date">12:23pm</p>
                        <p className="sent-message">
                            Hi
                            gfgkfdhgfkdghfdkljghdfglhdfkgjlfdhgkjldfhgdjkslghdsfkjjohn!
                        </p>
                    </div>
                    <div className="received-message-wrapper">
                        <p className="received-message-date">12:23PM</p>
                        <p className="received-message">
                            How arfgfdgfgfdgdfgsdgsdfgfdgsdfgdfe you!
                        </p>
                    </div> */}
                    {renderredMessages(messages)}
                </div>
                <div className="chat-input-wrapper">
                    <div className="chat-attachement-wrapper">
                        <label className="chat-media-input">
                            <i className="fa-solid fa-link">
                                <input
                                    type="file"
                                    className="attachement-input"
                                    accept="image/*,video/*"
                                    onChange={(e) => {
                                        sendMedia(e);
                                    }}
                                />
                            </i>
                        </label>
                    </div>
                    <input
                        type="text"
                        onKeyUp={(e) => {
                            onKeyUp(e);
                        }}
                        className="chat-input"
                        onChange={(e) => {
                            setNewMessage(e.target.value);
                        }}
                    />
                </div>
            </div>
            <div className="chat-send-wrapper">
                <div className="chat-send-button" onClick={sendMessage}>
                    <img src={"../../images/img/send.png"} alt="send" />
                </div>
            </div>
        </Fragment>
    );
};

export default ChatWrapper;
