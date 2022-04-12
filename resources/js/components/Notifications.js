import axios from "axios";
import React, { useEffect } from "react";
import notify from "../src/notify";

const Notifications = ({ notifications, setNotifications }) => {
    useEffect(() => {
        renderNotifications(notifications);
    }, [notifications]);

    const checkNotification = async (e) => {
        if (!e.target.dataset.nid || !e.target.dataset.unid) return;

        if (changeSubscribtionForm(e.target, e.target.dataset.unid)) {
            const filteredNotifications = notifications.filter(
                (item) => item.id !== e.target.dataset.nid
            );

            if (notifications.length === filteredNotifications.length) return;

            setNotifications(filteredNotifications);

            const response = await notify.post("/check-notification", {
                nid: e.target.dataset.nid,
                status: e.target.classList.contains("accept-notify")
                    ? "accept"
                    : "decline",
            });

            if (response.error) {
                return false;
            }
        }
    };

    const changeSubscribtionForm = (icon, unid) => {
        const targetedGreenButton = document.querySelector(
            `[data-uunid="${unid}"]`
        );

        if (targetedGreenButton) {
            if (icon.classList.contains("deny-notify")) return true;

            const targetedForm = targetedGreenButton.querySelector(".sub-form");

            targetedForm.setAttribute(
                "action",
                `${window.location.origin}/unsubscribe/${unid}`
            );

            const buttonToChange = targetedForm.querySelector("button");
            buttonToChange.classList.remove("user-subscribe");
            buttonToChange.innerText = "";
            buttonToChange.classList.add("fas", "fa-check", "checkmark-icon");
        }

        return true;
    };

    const renderNotifications = (myNotifications) => {
        if (myNotifications == null) {
            return;
        }

        return myNotifications.map((item) => {
            return (
                <div className="notification" key={item.id}>
                    {/* <div className="notification-title">New Subscribtion</div> */}
                    <div className="notification-info">
                        <div className="notification-user-image">
                            <a href={`all-users/${item.data.user_uniqueid}`}>
                                <img
                                    src={
                                        item.data.user_image ??
                                        `../../images/avatar.png`
                                    }
                                />
                            </a>
                        </div>
                        <p>
                            <span className="notification-main">
                                {item.data.user_name}
                            </span>{" "}
                            subscribed to you, subscribe back to be able to chat
                            with him.
                        </p>
                    </div>
                    <div className="notification-actions-wrapper">
                        <div
                            className={`${
                                item.data.check_if_user_is_subscribed_to_me ===
                                true
                                    ? "d-none"
                                    : "d-block"
                            }`}
                        >
                            <i
                                className="fas fa-check-square accept-notify"
                                data-nid={item.id}
                                data-unid={item.data.user_uniqueid}
                                onClick={(e) => {
                                    checkNotification(e);
                                }}
                            ></i>
                        </div>

                        <div>
                            <i
                                className="fas fa-window-close deny-notify"
                                data-nid={item.id}
                                data-unid={item.data.user_uniqueid}
                                onClick={(e) => {
                                    checkNotification(e);
                                }}
                            ></i>
                        </div>
                    </div>
                </div>
            );
        });
    };

    return (
        <div className="notifications-wrapper">
            <div className="notifications-container">
                <p className="notifications-title">Notifications</p>
                {renderNotifications(notifications)}
            </div>
        </div>
    );
};

export default Notifications;
