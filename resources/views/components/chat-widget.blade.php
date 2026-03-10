<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- ===== Chat Widget Component ===== -->
<style>
    .site-chat-button {
        position: fixed;
        right: 20px;
        bottom: 165px;
        z-index: 3100;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #btn-send-mess {
        background-color: #ff0000
    }

    #btn-send-mess:hover {
        background-color: #e92525
    }

    #search-phone-btn-2 {
    width: 70px;
    padding: 11px 0;
    margin: 13px;
    border: 1px solid rgba(255, 0, 0, 0.6);
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 13px;
    color: #ff4d4d;
    flex-shrink: 0;
        justify-content: center;
    background: linear-gradient(145deg, #ff0000, #ff0000cc);

    box-shadow:
        0 0 6px rgba(255, 0, 0, 0.4),
        inset 0 0 6px rgba(255, 0, 0, 0.25);

    transition: all 0.25s ease;
}
#chat-messages-list {
    overflow-y: auto;
    flex: 1;
    padding: 12px;
    background: #fff;
    scrollbar-width: thin;
    scrollbar-color: #ff0000 #111;
}

#chat-messages-list::-webkit-scrollbar {
    width: 6px;
}

#chat-messages-list::-webkit-scrollbar-thumb {
    background: #ff0000;
    border-radius: 10px;
}
    #search-phone-btn-2:hover {
    color: #fff;
    border-color: #ff0000;
    box-shadow:
        0 0 10px rgba(255, 0, 0, 0.8),
        0 0 20px rgba(255, 0, 0, 0.5),
        inset 0 0 8px rgba(255, 0, 0, 0.4);
    transform: translateY(-1px);
}
#search-phone-btn-2:active {
    transform: scale(0.95);
    box-shadow:
        0 0 6px rgba(255, 0, 0, 0.6),
        inset 0 0 10px rgba(0, 0, 0, 0.8);
}


    .chat-route-back {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .site-chat-footer-navbar {
        border-top: 1px solid #ddd;
        /* viền mặc định */
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }

    /* Khi input bên trong được focus */
    .site-chat-footer-navbar:focus-within {
        border-top-color: transparent;
        /* ẩn viền trên */
        box-shadow: 0 -4px 10px rgba(255, 0, 0, 0.747);
        /* hiệu ứng bóng nổi */
    }

    .chat-back-btn {
        border: none;
        background: transparent;
        cursor: pointer;
        padding: 4px;
        color: #fff;
        /* header text màu trắng */
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
    }

    .chat-back-btn:hover {
        background: rgba(255, 255, 255, 0.15);
    }

    .chat-header-text {
        font-size: 16px;
        font-weight: 600;
        color: #ffffff;
        text-shadow: 0 0 6px rgba(255, 0, 0, 0.7);
        padding-top: 2px;
    }

    #chat-input {
    background: #ffffff;
    color: #2b2b2b;
    border: 1px solid rgba(255, 0, 0, 0.3) !important;
    border-radius: 8px;
    padding: 8px 12px;
    }
#chat-input:focus {
    border-color: #ff0000 !important;
    box-shadow: 0 0 8px rgba(255, 0, 0, 0.6);
}
    #chat-send {
        background: transparent;
        /* bỏ nền */
        border: none;
        /* bỏ viền */
        font-size:20px;
        padding: 0;
        /* chỉ để vừa icon */
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        /* nếu muốn bo tròn */
        color: #ff0000;
        /* margin-bottom: 6px; */
    }

    /* màu đỏ cho icon SVG */
    #chat-send svg {
        fill: #ff2b2b;
        /* màu đỏ */
        filter: drop-shadow(0 0 6px rgba(255, 0, 0, 0.8));
        width: 20px;
        /* chỉnh kích thước icon */
        height: 20px;
        transition: transform 0.2s;
        /* hiệu ứng nhỏ khi hover */
    }

    /* hiệu ứng hover (tuỳ chọn) */
    #chat-send:hover svg {
        transform: scale(1.25);
        /* icon phóng to nhẹ */
    }

    /* ripple effect cho button khi có badge */
    .chat-toggle.has-badge {
        position: relative;
        overflow: hidden;
    }

    .chat-toggle.has-badge::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.822);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        animation: ripple 1s infinite;
    }

    @keyframes ripple {
        0% {
            width: 0;
            height: 0;
            opacity: 1;
        }

        100% {
            width: 120%;
            height: 120%;
            opacity: 0;
        }
    }

    /* Moved messenger button styles here so chat + messenger are managed in one component */
    .messenger-btn {
        position: fixed;
        bottom: 91px;
        right: 20px;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background-color: transparent;
        border-radius: 50%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .messenger-btn:hover {
        transform: scale(1.1);
    }

    .messenger-btn img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .input_box {
        position: relative;
        display: flex;
        flex-direction: column;
        margin: 16px 0px 10px 0px;
    }

    /* input/textarea mặc định */
    /* input mặc định */
    .input-field {
    width: 100%;
    height: 44px;
    font-size: 15px;
    background: #fff !important;
    color: #2b2b2b!important;
    padding: 14px 16px 6px 16px;
    border: 1px solid rgba(255, 0, 0, 0.692)!important;
    border-radius: 12px;
    outline: none;
    transition: all 0.25s ease;
    
    /* Inner dark depth */
    box-shadow: inset 0 0 4px rgba(255, 0, 0, 0.8);
}
.input-field:hover {
    color: #2b2b2b;
    border-color: rgba(255, 0, 0, 0.904)!important;
    box-shadow:
        0 0 6px rgba(255, 0, 0, 0.651),
        inset 0 0 6px rgba(252, 0, 0, 0.9);
}
.input-field:hover::placeholder {
    color: #2b2b2b;
}


    /* label mặc định */
    .label {
        position: absolute;
        top: 8px;
        left: 20px;
        font-size: 15px;
        color: #2b2b2b;
        transition: 0.2s;
        pointer-events: none;
    }

    /* label nổi */
    .input-field:focus~.label,
    .input-field:not(:placeholder-shown)~.label {
        top: -13px;
        left: 20px;
        font-size: 12px;
        background: #f8f9fb;
        color: #fa0808;
        padding: 0 8px;
        margin: 0;
        border-radius: 10px;
        line-height: 22px
    }

    /* trạng thái focus */
    .input-field:focus {
    border-color: 1px solid #ff1515!important;
    box-shadow:
        0 0 0 2px rgba(255, 0, 0, 0.507),
        0 0 6px rgba(255, 0, 0, 0.836),
        inset 0 0 2px rgba(255, 0, 0, 0.9);
}


    /* LỖI → đổi màu viền + label */
    .input-field.is-invalid {
    border-color: #ff0000 !important;
    box-shadow:
        0 0 2px rgba(228, 0, 0, 0.8),
        inset 0 0 6px rgba(255, 0, 0, 0.9);
}
.input-field::placeholder {
    color: #2b2b2b;
}

    .input-field.is-invalid~.label {
        color: #fa1818 !important;
    }

    /* hiển thị text lỗi ngay trong label */
    .label.error-message::after {
        content: attr(data-error);
        margin-left: 6px;
        color: #ee1212;
        font-weight: 600;
    }

    .site-chat-footer-navbar {
    width: 100%;
    min-height: 60px;
    padding: 8px 10px;
    background: #fff;
    border-top: 1px solid rgba(255, 0, 0, 0.699);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}


    .chat-nav-buttons {
    display: flex;
    align-items: center;
    justify-content: space-around;
    flex: 1;
    gap: 10px;
}
#chat-history-screen {
    padding: 14px;
    flex: 1;
    display: flex;
    flex-direction: column;
    height: 380px;
    background: #fff;
}
#chat-history-screen > div:first-child {
    padding-bottom: 12px;
    border-bottom: 1px solid rgba(255, 0, 0, 0.644);
    margin-bottom: 12px;
}
#chat-history-screen h6 {
    font-size: 14px;
    font-weight: 600;
    margin: 0;
    color: #ff4d4d;
    text-shadow: 0 0 6px rgba(255, 0, 0, 0.6);
}
    .chat-nav-buttons.hidden {
        display: none !important;
    }

    .chat-input-group {
        display: none;
        gap: 8px;
        flex: 1;
    }

    .chat-input-group.visible {
        display: flex !important;
    }

    .chat-nav-btn {
    background: transparent;
    border: none;
    font-size: 18px;
    color: #2b2b2b;
    cursor: pointer;
    padding: 10px;
    border-radius: 10px;
    transition: all 0.25s ease;
}

    .chat-nav-btn:hover {
    color: #fff;
    text-shadow: 0 0 6px rgba(255, 0, 0, 0.8);
    background: rgba(255, 0, 0, 0.5);
}
.chat-nav-btn.active {
    color: #fff;
    background: rgba(255, 0, 0, 70%);
    box-shadow: 0 0 8px rgba(255, 0, 0);
}

    .site-chat-panel {
        position: fixed;
        right: 85px;
        bottom: 15px;
        width: 360px;
        max-height: calc(100vh - 280px);
         background: #fff;
        border: 1px solid rgba(206, 0, 0, 0.815);
        border-radius: 12px;
       box-shadow:
        0 0 10px rgba(255, 0, 0, 0.459),
        0 0 20px rgba(255, 0, 0, 0.384);
    backdrop-filter: blur(12px);
        display: none;
        flex-direction: column;
        overflow: hidden;
        z-index: 3000;
        transition: all 0.3s ease;
    }

    /* visible state */
    .site-chat-panel.open {
        display: flex !important;
    }

    .site-chat-header {
        padding: 10px 18px;
        background: linear-gradient(90deg, #e70000, #ff0000);
        color: #fff;
        font-weight: 600;
        font-size: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(255, 0, 0, 0.4);
         box-shadow: 0 0 10px rgba(255, 0, 0, 0.3);
        flex-wrap: nowrap;
        gap: 10px;
    }

    .site-chat-close-btn {
        background: rgb(255, 255, 255);
        border: none;
        color: #000000;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        padding: 0px 0px;
        margin: 0;
        border-radius: 4px;
        transition: all 0.2s ease;
        flex-shrink: 0;
        min-width: 32px;
        min-height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .site-chat-close-btn:hover {
        background: rgb(0, 0, 0);
        color:#fff;
    }

    .site-chat-close-btn:active {
        background: rgba(255, 255, 255, 0.25);
        transform: scale(0.95);
    }

    .site-chat-body {
        padding: 0;
        overflow: auto;
        flex: 1;
        background: #fbfbfb;
        scrollbar-color: #ff0000 #e4e4e4;
        max-height: 400px;
        -webkit-overflow-scrolling: touch;
    }
    .site-chat-body::-webkit-scrollbar {
    width: 6px;
}
.site-chat-body::-webkit-scrollbar-thumb {
    background: #ff0000;
    border-radius: 10px;
}

    .site-chat-footer {
        padding: 12px;
        border-top: 1px solid rgba(255, 0, 0, 0.3);
         background: #e4e4e4;
        flex-shrink: 0;
    }

    .site-chat-message {
        margin-bottom: 8px;
        display: block;
        word-break: break-word;
    }

    .site-chat-message.me {
        text-align: right;
    }

    .site-chat-message .bubble {
        display: inline-block;
        padding: 10px 14px;
        border-radius: 16px;
        max-width: 85%;
        font-size: 13px;
        word-wrap: break-word;
        line-height: 1.4;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .site-chat-message.me .bubble {
        background: linear-gradient(135deg, #ff1a1a, #b30000);
    color: #fff;
    box-shadow: 0 0 8px rgba(255, 0, 0, 0.6);
        border-radius: 16px 4px 16px 16px;
    }

    .site-chat-message.other .bubble {
        background: #1a1f2b;
    color: #ddd;
    border: 1px solid rgba(255, 0, 0, 0.2);
        border-radius: 4px 16px 16px 16px;
    }
#chat-create-new-from-history-btn {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid rgba(255, 0, 0, 0.5);
    background: linear-gradient(145deg, #1a1a1a, #111);
    color: #ff4d4d;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.25s ease;
}

#chat-create-new-from-history-btn:hover {
    color: #fff;
    border-color: #ff0000;
    box-shadow:
        0 0 10px rgba(255, 0, 0, 0.7),
        0 0 20px rgba(255, 0, 0, 0.3);
    transform: translateY(-1px);
}

#chat-create-new-from-history-btn:active {
    transform: scale(0.97);
}
    .site-chat-empty {
        color: #777;
        text-align: center;
        padding: 24px 16px;
        font-size: 13px;
    }

    .chat-form-group {
        margin-bottom: 10px;
    }

    .chat-form-group label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 2px;
        color: #333;
        text-transform: uppercase;
    }

    .chat-form-group input,
    .chat-form-group textarea {
        width: 100%;
        padding: 6px 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 13px;
        box-sizing: border-box;
        font-family: inherit;
        transition: all 0.2s ease;
        -webkit-appearance: none;
        appearance: none;
    }

    .chat-form-group input:focus,
    .chat-form-group textarea:focus {
        outline: none;
        border-color: #f71919;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    .chat-form-group textarea {
        resize: vertical;
        min-height: 80px;
        font-family: inherit;
    }

    .chat-continue-screen {
        padding: 24px 16px;
        text-align: center;
    }

    .chat-continue-screen p {
        font-size: 13px;
        color: #666;
        margin-bottom: 12px;
        line-height: 1.5;
    }

    .chat-continue-screen p strong {
        color: #333;
        display: block;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .chat-continue-screen .button-group {
        display: flex;
        gap: 10px;
        margin-top: 16px;
    }

    .chat-continue-screen button {
        flex: 1;
        padding: 10px;
        border: none;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.2s ease;
    }

    .chat-continue-screen .btn-continue {
        background: #f71919;
        color: #fff;
    }

    .chat-continue-screen .btn-continue:hover {
        background: #f71919;
        transform: translateY(-1px);
    }

    .chat-continue-screen .btn-new {
        background: #e9ecef;
        color: #495057;
    }

    .chat-continue-screen .btn-new:hover {
        background: #dee2e6;
    }

    /* Recent chats list styles */
    .chat-recent-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
        max-height: 320px;
        overflow-y: auto;
        padding-right: 4px;
    }
    .chat-recent-list::-webkit-scrollbar {
    width: 5px;
}

.chat-recent-list::-webkit-scrollbar-thumb {
    background: #ff0000;
    border-radius: 10px;
}
    .chat-recent-item {
        margin-top: 2px;
        padding: 10px 12px;
        border: 1px solid rgba(255, 0, 0, 0.726);
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.25s ease;
    }

    .chat-recent-item:hover {
        /* background: #f8f9fa; */
         border-color: rgba(255, 0, 0, 0.7);
        box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
        transform: translateY(-2px);
    }

    .chat-recent-item-info {
        flex: 1;
        min-width: 0;
    }

    .chat-recent-item-name {
        font-size: 13px;
        font-weight: 600;
        color: #2b2b2b;
        margin-bottom: 4px;
    }

    .chat-recent-item-preview {
        font-size: 12px;
        color: #2b2b2b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .chat-recent-item-badge {
        display: inline-block;
        min-width: 20px;
        height: 20px;
        padding: 2px 6px;
        background: #f71919;
        color: #fff;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 600;
        text-align: center;
        margin-left: 8px;
    }

    /* ===== CHAT BUTTON GAMING DARK ===== */
.site-chat-button .chat-toggle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 1px solid rgba(228, 0, 0, 0.6);
    
    /* Dark glass background */
    background: radial-gradient(circle at 30% 30%, #e70000, #ff0000);
    
    /* Neon glow */
    box-shadow:
        0 0 8px rgba(255, 0, 0, 0.6),
        0 0 18px rgba(255, 0, 0, 0.4),
        inset 0 0 8px rgba(255, 0, 0, 0.3);

    color: #ffffff;
    font-size: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.25s ease;
    position: relative;
    overflow: hidden;
}

    .site-chat-button .chat-toggle:hover {
    transform: scale(1.12);
    box-shadow:
        0 0 12px rgba(255, 0, 0, 0.9),
        0 0 28px rgba(255, 0, 0, 0.7),
        inset 0 0 10px rgba(255, 0, 0, 0.5);
}
.site-chat-button .chat-toggle svg,
.site-chat-button .chat-toggle i {
    filter: drop-shadow(0 0 6px rgba(255, 0, 0, 0.8));
}

    .site-chat-button .chat-toggle:active {
    transform: scale(0.92);
}

    .site-chat-button .chat-toggle:focus {
        outline: none;
        box-shadow: 0 0 0 4px rgba(255, 23, 23, 0.5)
    }
.site-chat-button .chat-toggle::before {
    content: "";
    position: absolute;
    width: 140%;
    height: 140%;
    background: conic-gradient(
        from 0deg,
        transparent,
        rgba(255, 255, 255, 0.5),
        transparent 30%
    );
    animation: rotateGlow 4s linear infinite;
}

@keyframes rotateGlow {
    100% { transform: rotate(360deg); }
}

    /* small badge to indicate an existing session (user can return to continue) */
    .site-chat-button .chat-toggle .chat-badge {
        position: absolute;
        top: 18px;
        right: 17px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
       background: #f1fb55;
        /* amber badge */
        box-shadow: 0 0 0 1.5px rgba(255, 0, 0, 0.562);
        z-index: 12000;
        animation: pulse-badge 1.5s infinite;
    }

    @keyframes pulse-badge {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }
    /* Mobile responsive styles */
    @media (max-width: 768px) {
        .site-chat-button {
            right: 15px;
            bottom: 200px;
        }

        #scrollTopBtn {
            width: 50px;
            height: 50px;
            bottom: 80px;
            right: 15px;
        }
.site-chat-button .chat-toggle svg,
.site-chat-button .chat-toggle i {
	padding-top: 10px;
    font-size: 30px;
}
        .messenger-btn {
            right: 15px;
            bottom: 140px;
            width: 50px;
            height: 50px;
        }
		.site-chat-button .chat-toggle .chat-badge {
			top: 12px;
    right: 12px;
    width: 9px;
    height: 9px;
		}
        .site-chat-panel {
            right: 0;
            width: 95%;
            bottom: 23%;
            max-height: 100vh;
            border-radius: 12px 12px 0 0;
            max-height: calc(100vh - 60px);
        }

        .site-chat-button .chat-toggle {
            width: 50px;
            height: 50px;
            font-size: 35px;
            padding-bottom: 12px;
        }

        .site-chat-header {
            padding: 12px 14px;
            font-size: 14px;
        }

        .site-chat-body {
            max-height: calc(100vh - 280px);
            padding: 0;
        }

        .chat-form-group label {
            font-size: 11px;
        }

        .chat-form-group input,
        .chat-form-group textarea {
            font-size: 16px;
            /* Prevents zoom on iOS */
            padding: 12px;
        }

        .chat-form-group textarea {
            min-height: 60px;
        }

        .site-chat-message .bubble {
            max-width: 90%;
            padding: 8px 12px;
            font-size: 14px;
        }

        .chat-recent-item {
            padding: 12px;
            margin-bottom: 4px;
        }

        .chat-recent-item-name {
            font-size: 14px;
        }

        .chat-recent-item-preview {
            font-size: 12px;
        }

        .site-chat-footer {
            padding: 10px;
        }

        .input-group {
            gap: 6px !important;
        }
    }

    /* Extra small devices (phones < 375px) */
    @media (max-width: 374px) {
        .site-chat-button {
            right: 10px;
            bottom: 110px;
        }

        .messenger-btn {
            right: 10px;
            bottom: 55px;
        }

        .site-chat-panel {
            border-radius: 8px 8px 0 0;
        }

        .site-chat-button .chat-toggle {
            width: 48px;
            height: 48px;
            font-size: 14px;
        }

        .site-chat-header {
            padding: 10px 12px;
            font-size: 13px;
        }

        .chat-form-group {
            margin-bottom: 10px;
        }

        .chat-form-group input,
        .chat-form-group textarea {
            padding: 10px;
            font-size: 15px;
        }

        .site-chat-message .bubble {
            max-width: 88%;
            padding: 8px 10px;
            font-size: 13px;
        }
    }

    /* Landscape mode on mobile */
    @media (max-width: 768px) and (orientation: landscape) {
        .site-chat-panel {
            max-height: calc(100vh - 40px);
            bottom: 0;

            right: 0;
        }

        .site-chat-body {
            max-height: calc(100vh - 180px);
        }

        .chat-form-group textarea {
            min-height: 40px;
        }
    }

    /* Tablet styles (769px to 1024px) */
    @media (min-width: 769px) and (max-width: 1024px) {
        .site-chat-panel {
            width: 380px;
            right: 85px;
            bottom: 15px;
        }

        .site-chat-button {
            right: 15px;
        }

        .messenger-btn {
            right: 15px;
        }
    }

    /* Large screens (1025px and up) */
    @media (min-width: 1025px) {
        .site-chat-panel {
            width: 380px;
            right: 85px;
            bottom: 15px;
        }

        .site-chat-button .chat-toggle:hover {
            transform: scale(1.05);
        }
    }

    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {
        .site-chat-button .chat-toggle {
            min-height: 48px;
            min-width: 48px;
        }

        .chat-form-group input,
        .chat-form-group textarea {
            font-size: 16px;
        }

        .chat-continue-screen button,
        .site-chat-footer button {
            min-height: 44px;
        }
    }
</style>

<div class="site-chat-button">
    <button id="chat-toggle-btn" class="chat-toggle btn btn-danger" aria-label="Mở chat" data-action="toggle"
        role="button">
        <i class="fa-solid fa-message"></i>
        <span class="chat-badge" id="chat-badge" style="display:none"></span>
    </button>
</div>

<div id="site-chat" class="site-chat-panel" aria-hidden="true" data-state="closed" role="region"
    aria-label="Chat widget">
    <div class="site-chat-header">
        <span id="site-chat-title">HIẾU STORE</span>
        <button class="site-chat-close-btn" id="chat-close-btn" title="Đóng" data-action="close" type="button"
            aria-label="Đóng chat">✕</button>
    </div>
    <div class="site-chat-body" id="chat-body" role="main">
        <!-- Screen 1: Nhập thông tin ban đầu -->
        <div id="chat-info-form" style="height: 380px;">
            <h5
                style="text-align: center;padding: 8px 0px 6px 0px;margin-bottom: 0px;border-bottom: 1px solid #c4c4c4;color: #2b2b2b;">
                Chat ngay với chúng tôi!</h5>
            <form id="chat-form-init" style="padding: 0px 16px 10px 16px;" novalidate>

                <!-- Họ và tên -->
                <div class="input_box">
                    <input type="text" id="input-name" class="input-field" placeholder=" " required autocomplete="off">
                    <label for="input-name" class="label">Họ và tên <strong>*</strong></label>
                </div>

                <!-- Số điện thoại -->
                <div class="input_box">
                    <input type="tel" id="input-phone" class="input-field" placeholder=" " required autocomplete="off"
                        inputmode="tel">
                    <label for="input-phone" class="label">Số điện thoại <strong>*</strong></label>
                </div>

                <!-- Email -->
                <div class="input_box">
                    <input type="email" id="input-email" class="input-field" placeholder=" " autocomplete="off">
                    <label for="input-email" class="label">Email</label>
                </div>

                <!-- Nội dung -->
                <div class="input_box">
                    <textarea id="input-message" class="input-field" placeholder=" " style="height: 90px;"
                        spellcheck="false"></textarea>
                    <label for="input-message" class="label">Nội dung tin nhắn <strong>*</strong></label>
                </div>

                <button type="submit" class="btn btn-danger btn-sm w-100" id="btn-send-mess"
                    style="padding: 10px; font-weight: 600;"><i class="fa-solid fa-paper-plane"></i> &nbsp;Bắt đầu trò
                    chuyện</button>


                <!-- Tìm cuộc trò chuyện cũ -->
                {{-- <div style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #e5e5e5;">
                    <p style="font-size: 12px; color: #999; margin-bottom: 8px;">Hoặc tìm cuộc trò chuyện cũ:</p>
                    <div style="display: flex; gap: 6px;">
                        <button type="button" id="search-phone-btn"
                            style="padding: 8px 12px; background: #e92525; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 12px;">
                            Tìm
                        </button>
                    </div>
                </div> --}}



        </div>


        <!-- Screen 2: Lịch sử chat (thay thế continue screen) -->
        <div id="chat-history-screen"
            style="display:none; padding: 14px; overflow: hidden; flex: 1; flex-direction: column; display: flex;height: 380px;">
            <div style="padding-bottom: 12px; border-bottom: 1px solid #e5e5e5; margin-bottom: 12px;">
                <h6 style="font-size: 14px; font-weight: 600; margin: 0; color: #2b2b2b;">Lịch sử trò chuyện (7 ngày)</h6>
            </div>
            <div>
                <div id="chat-history-list" class="chat-recent-list" role="list"></div>
                <div id="chat-history-empty" class="site-chat-empty" style="display: none;" role="status">Không có cuộc
                    trò chuyện nào</div>
            </div>
            <div style="padding-top: 12px; border-top: 1px solid #e5e5e5; margin-top: 12px;">
                <button id="chat-create-new-from-history-btn" type="button"
                    style="width: 100%; padding: 10px; background: #e9ecef; color: #495057; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 13px; transition: all 0.2s ease;">+
                    Tạo cuộc trò chuyện mới</button>
            </div>
        </div>

        <!-- Screen 3: Tin nhắn -->
        <div id="chat-messages-area" style="display:none;flex-direction:column;flex:1;height: 380px;">
            <div id="chat-messages-list" style="overflow-y: auto; flex: 1; padding: 12px;" role="log"
                aria-label="Tin nhắn chat" aria-live="polite"></div>
        </div>
        
        <!-- Screen 4: Tìm kiếm bằng SĐT -->
        <div id="chat-search-phone-screen" class="chat-search-phone-screen"
            style="display:none; padding: 16px;height: 380px;">
            <h6 style="font-size: 16px; font-weight: 600; color: #2b2b2b; margin-bottom: 4px; margin-top:10px;">
                Nhập số điện thoại để hiển thị lại tin nhắn cũ
            </h6>
            <p style="font-size: 13px; color: #363636; margin: 0;">
                * Tin nhắn chỉ được lưu trong 7 ngày
            </p>

            <div style="display: flex; gap: 8px;">
                <div class="input_box" style="flex: 1;">
                    <input type="tel" id="search-phone-input-2" class="input-field" placeholder=" " required
                        autocomplete="off" inputmode="tel">
                    <label for="search-phone-input-2" class="label">Số điện thoại <strong
                            style="color:red">*</strong></label>
                </div>
                <button type="button" id="search-phone-btn-2"
                    style="width: 70px;padding: 11px 0px;margin: 13px;color: #fff; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;flex-shrink: 0;font-size: 13px;">Tìm</button>
            </div>
            <hr style="margin: 5px 0; border-top: 2px solid #3b3b3b; opacity: 0.5;">

            <!-- Danh sách chat inline trong search screen -->
            <div id="chat-results-list-container" style="display: none; max-height: 280px;">
                <h6 style="font-size: 14px; font-weight: 600; margin-bottom: 10px; margin-top: 10px;">Các
                    cuộc trò chuyện cũ:</h6>
                <div id="chat-inline-list" class="chat-recent-list" role="list"></div>
                <div id="chat-inline-empty" class="site-chat-empty" style="display: none;" role="status">Không có cuộc
                    trò chuyện nào</div>
            </div>
        </div>

        <!-- Screen 5: Danh sách các cuộc trò chuyện cũ (giữ lại nhưng không dùng) -->
        <div id="chat-recent-list-screen"
            style="display:none; padding: 0; overflow: hidden; flex: 1; flex-direction: column;height: 380px;">
            <div style="padding: 14px; border-bottom: 1px solid #e5e5e5; background: #fff;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <button id="chat-recent-back-btn" type="button"
                        style="background: none; border: none; cursor: pointer; font-size: 16px; color: #666; padding: 0;"
                        aria-label="Quay lại">←</button>
                    <h6 style="font-size: 14px; font-weight: 600; margin: 0;">Danh sách trò chuyện</h6>
                    <div style="width: 24px;"></div>
                </div>
            </div>
            <div style="flex: 1; overflow-y: auto; padding: 12px;">
                <div id="chat-recent-list-container" class="chat-recent-list" role="list"></div>
                <div id="chat-recent-empty" class="site-chat-empty" style="display: none;" role="status">Không có cuộc
                    trò chuyện nào</div>
            </div>
        </div>
        <!--Screen 7: hỏi lại chat cũ hoặc tạo mới-->
        <div id="chat-session-choice" style="display:none; flex-direction:column; gap:12px; padding:16px;">
    <h3 style="font-size:16px; color: #fff; margin-bottom:10px;">TIẾP TỤC TRÒ CHUYỆN?</h3>

    <button id="continue-old-session" class="btn btn-danger w-100">
        Tiếp tục chat cũ
    </button>

    <button id="start-new-session" class="btn btn-secondary w-100">
        Tạo cuộc trò chuyện mới
    </button>
</div>
    </div>
    <div class="site-chat-footer-navbar">
        <!-- 3 icon navbar -->
        <div class="chat-nav-buttons">
            <button type="button" id="chat-nav-home" class="chat-nav-btn active" title="Trang chủ">
                <i class="fa-solid fa-house"></i>
            </button>
            <button type="button" class="chat-nav-btn" id="search-phone-btn" title="Tin nhắn">
                <i class="fa-solid fa-comment-dots"></i>
            </button>
            <button type="button" class="chat-nav-btn" title="Cài đặt">
                <i class="fa-solid fa-gear"></i>
            </button>
        </div>
        
        <!-- input gửi tin -->
        <div class="chat-input-group" style="align-items:center;gap:6px;">
            <!-- nút chọn file -->
            <button id="chat-attach" type="button"
                style="background:transparent;border:none;cursor:pointer;margin-left: 2px;padding: 10px 6px 10px 0px;">
                <i class="fa-regular fa-images" style="font-size:20px;color:#ff0000;"></i>
            </button>
            <input type="file" id="chat-file" style="display:none;" accept="image/*">

            <!-- input chat -->
            <input id="chat-input" type="text" class="form-control" placeholder="Nhập tin nhắn..."
                style="font-size:13px;flex:1;padding:10px 4px 10px 4px;border-radius:6px;border:1px solid #ddd;">

            <!-- nút gửi -->
            <button id="chat-send" class="btn btn-danger btn-sm"
                style="white-space:nowrap;padding:10px 8px;font-weight:600;border-radius:6px;">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>




</div>
</form>
<!-- Preview popup -->
<div id="chat-image-preview-popup" style="display:none; position:fixed; bottom:70px; right:100px; 
    background:#fff; border:1px solid #ddd; border-radius:8px; padding:8px; box-shadow:0 4px 12px rgba(0,0,0,0.15); z-index:9999; max-width:220px;">
    <div style="display:flex; flex-direction:column; gap:6px;">
        <img id="chat-image-preview-img" src="" style="width:200px; border-radius:6px;" />
        <div style="display:flex; justify-content:space-between; gap:6px;">
            <button id="chat-image-send" class="btn btn-sm btn-danger" style="flex:1; padding:4px 6px;">Gửi</button>
            <button id="chat-image-remove" class="btn btn-sm btn-secondary" style="flex:1; padding:4px 6px;">Xóa</button>
        </div>
    </div>
</div>

<script>
    // Ultra-simple chat widget using data attributes and direct DOM manipulation
    window.chatWidget = {
        // State variables
        chatSessionId: localStorage.getItem('chat_session_id') || null,
        polling: null,
        sessionCreated: false,
        foundSessionId: null,

        // Initialize everything
        init: function () {
            console.log('[Chat] Init called');

            // Check if DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', () => this.setupUI());
                return;
            }

            this.setupUI();
        },

// Dành cho khách, gọi khi mở chat hoặc online
markMessagesReadCustomer: function () {
    if (!this.chatSessionId) return;

    $.ajax({
        url: '{{ route("chat.markReadCustomer") }}',
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { chat_session_id: this.chatSessionId },
        success: function(res) {
            console.log('[Chat] Mark messages read for customer', res);
        },
        error: function(err) {
            console.error('[Chat] Mark read customer failed', err);
        }
    });
},

        // Setup UI and bind events
        setupUI: function () {
            console.log('[Chat] SetupUI called');

            const navHome = document.getElementById('chat-nav-home');
            // Get elements
            const panel = document.getElementById('site-chat');
            const titleBar = document.getElementById('site-chat-title');
            const toggleBtn = document.getElementById('chat-toggle-btn');
            const closeBtn = document.getElementById('chat-close-btn');

            if (!panel || !toggleBtn || !closeBtn) {
                console.error('[Chat] Cannot find required elements');
                return;
            }

            // Store in window for reference
            window.chatPanel = panel;
            window.chatToggleBtn = toggleBtn;
            window.chatCloseBtn = closeBtn;

            const self = this;

            // ===== NAVBAR GLOBAL ACTIVE HELPER =====
            const navButtons = document.querySelectorAll('.chat-nav-btn');

            function setActive(btn) {
                navButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            }

            // Lưu hàm vào this để dùng nơi khác (nếu cần)
            this.setActiveNav = setActive;
            // Toggle button click
            toggleBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                console.log('[Chat] Toggle button clicked');
                self.togglePanel();
            });

            // Close button click
            closeBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                console.log('[Chat] Close button clicked');
                self.closePanel();
            });

            // Esc key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && panel.classList.contains('open')) {
                    console.log('[Chat] Esc pressed');
                    self.closePanel();
                }
            });

            // Send button
            const sendBtn = document.getElementById('chat-send');
            if (sendBtn) {
                sendBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    self.sendMessage();
                });
            }
            // Form submit
            const initForm = document.getElementById('chat-form-init');
            if (initForm) {
                initForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    if (navHome) self.setActiveNav(navHome);
                    self.createSession();
                });
            }
            // Chat input Enter
            const chatInput = document.getElementById('chat-input');
            if (chatInput) {
                chatInput.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        self.sendMessage();
                    }
                });
            }

            // Continue button - tiếp tục chat cũ (REMOVED - now using history screen)
            // New button - tạo chat mới (REMOVED - now using history screen)

            // Create new message (from messages header)
            const createNewBtn = document.getElementById('chat-create-new-btn');
            if (createNewBtn) {
                createNewBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    self.startNewSession();
                });
            }

            // Create new from history screen
            const createNewFromHistoryBtn = document.getElementById('chat-create-new-from-history-btn');
            if (createNewFromHistoryBtn) {
                createNewFromHistoryBtn.addEventListener('click', (e) => {
                    if (titleBar) titleBar.textContent = "HIẾU STORE";
                    e.preventDefault();
                    self.setActiveNav(navHome);
                    self.startNewSession();
                });
            }

            // Search phone button in init form
            const searchPhoneBtn = document.getElementById('search-phone-btn');
            if (searchPhoneBtn) {
                searchPhoneBtn.addEventListener('click', (e) => {
                    if (titleBar) titleBar.innerHTML = `<div class="chat-route-back">
            <button type="button" id="search-back-btn" class="chat-back-btn" aria-label="Quay lại" title="Quay lại" style="padding-top: 0px;">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <span class="chat-header-text">TÌM KIẾM TRÒ CHUYỆN CŨ</span>
        </div>`;
                    e.preventDefault();
                    self.setActiveNav(searchPhoneBtn);
                    self.showSearchPhoneScreen();
                });
            }

            // Search phone button in search screen
            const searchPhoneBtn2 = document.getElementById('search-phone-btn-2');
            if (searchPhoneBtn2) {
                searchPhoneBtn2.addEventListener('click', (e) => {
                    if (titleBar) titleBar.innerHTML = `<div class="chat-route-back">
            <button type="button" id="search-back-btn" class="chat-back-btn" aria-label="Quay lại" title="Quay lại" style="padding-top: 0px;">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <span class="chat-header-text">TÌM KIẾM TRÒ CHUYỆN CŨ</span>
        </div>`;
                    e.preventDefault();
                    self.setActiveNav(searchPhoneBtn2);
                    self.searchChatByPhone();
                });
            }

            // Back button in recent list screen
            const recentBackBtn = document.getElementById('chat-recent-back-btn');
            if (recentBackBtn) {
                recentBackBtn.addEventListener('click', (e) => {
                    e.preventDefault();

                    const recentScreen = document.getElementById('chat-recent-list-screen');
                    const searchScreen = document.getElementById('chat-search-phone-screen');
                    if (recentScreen) recentScreen.style.display = 'none';
                    if (searchScreen) searchScreen.style.display = 'block';
                });
            }

            // Search phone input Enter key
            const searchPhoneInput2 = document.getElementById('search-phone-input-2');
            if (searchPhoneInput2) {
                searchPhoneInput2.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        self.searchChatByPhone();
                    }
                });
            }

            // Check if session exists
            this.sessionCreated = !!this.chatSessionId;
            console.log('[Chat] Session exists:', this.sessionCreated);

            // Update small badge on the toggle so returning users notice an existing session
            this.updateToggleBadge();

            // Show appropriate screen
            this.showInitialScreen();

            console.log('[Chat] SetupUI complete!');

            // Navbar: nút Trang chủ
            
            if (navHome) {
                navHome.addEventListener('click', (e) => {
                    if (titleBar) titleBar.textContent = "HIẾU STORE";
                    e.preventDefault();
                    self.setActiveNav(navHome);
                    self.showInitForm();
                });
            }
            document.addEventListener("click", function (e) {
                // Back button in search screen
                if (e.target.id === "search-back-btn" || e.target.closest("#search-back-btn")) {
                    const titleBar = document.getElementById("site-chat-title");
                    titleBar.textContent = "HIẾU STORE";

                    self.setActiveNav(navHome);
                    self.showInitForm();
                    return;
                }

                // Back button in history screen
                if (e.target.id === "history-back-btn" || e.target.closest("#history-back-btn")) {
                    const titleBar = document.getElementById("site-chat-title");
                    titleBar.textContent = "HIẾU STORE";

                    self.setActiveNav(navHome);
                    self.showInitForm();
                    return;
                }

                // Back button in messages screen
                if (e.target.id === "messages-back-btn" || e.target.closest("#messages-back-btn")) {
                    self.showChatHistoryScreen();
                    self.setActiveNav(searchPhoneBtn2);
                    return;
                }                

            });
    // ====== USER ACTIVITY TRACKER (chỉ reset lastActivity, KHÔNG setOnline ở đây) ======
this.lastActivity = Date.now();

['mousemove', 'keydown', 'click', 'scroll', 'touchstart'].forEach(ev => {
    document.addEventListener(ev, () => {
        self.lastActivity = Date.now();
    }, { passive: true });
});

// ====== HEARTBEAT 30s kiểm tra online ======
// giới hạn để không gửi 2 lần giống nhau
this._lastStatus = null;

setInterval(() => {
    if (!self.chatSessionId) return;

    const now  = Date.now();
    const idle = now - self.lastActivity;

    let newStatus = null;

    if (idle < 30000) newStatus = 1;        // online
    else if (idle > 3600000) newStatus = 0; // offline
    else return; // không thay đổi → không gửi request

    if (self._lastStatus === newStatus) return;  // không gửi trùng

    self._lastStatus = newStatus;

    if (newStatus === 1) self.setOnline();
    else self.setOffline();

}, 30000);

// -----------------------------
// OFFLINE WHEN TAB CLOSED — reliable with pagehide + sendBeacon
// -----------------------------
function sendOfflineBeacon() {
    if (!self.chatSessionId) return;

    const url = '{{ route("chat.updateStatus") }}';
    const data = new FormData();

    data.append('chat_session_id', self.chatSessionId);
    data.append('is_online', 0);
    data.append('_token', document.querySelector('meta[name="csrf-token"]').content);

    navigator.sendBeacon(url, data);
}


// pagehide fires on bfcache / navigation away in many browsers
window.addEventListener('pagehide', sendOfflineBeacon);
// fallback trướcunload
window.addEventListener('beforeunload', sendOfflineBeacon);

        },

        // Cập nhật trạng thái online
        setOnline: function () {
    if (!this.chatSessionId) return;

    $.ajax({
        url: '{{ route("chat.updateStatus") }}',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            chat_session_id: this.chatSessionId,
            is_online: 1
        },
        success: function () {
            console.log('[Chat] Online updated');
        }
    });
    // Khi vừa online → đánh dấu các tin từ admin là đã đọc
    this.markMessagesReadCustomer();
},



        // Cập nhật trạng thái offline
        setOffline: function () {
    if (!this.chatSessionId) return;

    $.ajax({
        url: '{{ route("chat.updateStatus") }}',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            chat_session_id: this.chatSessionId,
            is_online: 0
        }
    });
},


        // Show initial screen - just show form by default
        showInitialScreen: function () {
            // Always show init form initially
            // The actual check (valid or not) will happen when user clicks to open panel
            this.showInitForm();
        },

        // Show chat history screen - display list of chats for current customer
        showChatHistoryScreen: function () {
            console.log('[Chat] Showing chat history screen');

            // Close any open Bootstrap modals and remove backdrop
            const allModals = document.querySelectorAll('.modal.show');
            allModals.forEach(modal => {
                const bootstrapModal = bootstrap.Modal.getInstance(modal);
                if (bootstrapModal) {
                    bootstrapModal.hide();
                }
            });
            // Remove any leftover modal-backdrop divs
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());

            // Get customer phone from current chat session
            const self = this;
            $.ajax({
                url: '{{ route("chat.checkSession") }}',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { chat_session_id: this.chatSessionId },
                success: function (res) {
                    if (res.status === 'success' && res.customer_phone) {
                        // Fetch history for this phone
                        $.ajax({
                            url: '{{ route("chat.getRecentChats") }}',
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            data: { phone: res.customer_phone },
                            success: function (historyRes) {
                                if (historyRes && historyRes.chats) {
                                    self.renderChatHistory(historyRes.chats);

                                }
                            }
                        });
                    }
                }
            });

            // Show history screen
            const initForm = document.getElementById('chat-info-form');
            const historyScreen = document.getElementById('chat-history-screen');
            const messagesArea = document.getElementById('chat-messages-area');
            const searchScreen = document.getElementById('chat-search-phone-screen');
            const recentScreen = document.getElementById('chat-recent-list-screen');
            const inputFooter = document.getElementById('chat-input-footer');
            const titleBar = document.getElementById('site-chat-title');

            // Update header to show back button and history title
            if (titleBar) {
                titleBar.innerHTML = `<div class="chat-route-back">
                <button type="button" id="history-back-btn" class="chat-back-btn" aria-label="Quay lại" title="Quay lại" style="padding-top: 0px;">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <span class="chat-header-text">LỊCH SỬ TRÒ CHUYỆN</span>
            </div>`;
            }

            if (initForm) initForm.style.display = 'none';
            if (historyScreen) {
                historyScreen.style.display = 'flex';
                historyScreen.style.flexDirection = 'column';
                historyScreen.style.flex = '1';
            }
            if (messagesArea) messagesArea.style.display = 'none';
            if (searchScreen) searchScreen.style.display = 'none';
            if (recentScreen) recentScreen.style.display = 'none';
            if (inputFooter) inputFooter.style.display = 'none';
            // Show navbar buttons, hide input group

            const navButtons = document.querySelector('.chat-nav-buttons');
            const inputGroup = document.querySelector('.chat-input-group');
            if (navButtons) navButtons.classList.remove('hidden');
            if (inputGroup) inputGroup.classList.remove('visible');
        },

        // Render chat history list
        renderChatHistory: function (chats) {
            const historyList = document.getElementById('chat-history-list');
            const emptyMsg = document.getElementById('chat-history-empty');

            if (!historyList) {
                console.error('[Chat] chat-history-list not found');
                return;
            }

            historyList.innerHTML = '';

            if (!chats || chats.length === 0) {
                if (emptyMsg) emptyMsg.style.display = 'block';
                return;
            }

            if (emptyMsg) emptyMsg.style.display = 'none';

            const self = this;
            chats.forEach((chat) => {
                const item = document.createElement('div');
                item.className = 'chat-recent-item';

                const info = document.createElement('div');
                info.className = 'chat-recent-item-info';

                const name = document.createElement('div');
                name.className = 'chat-recent-item-name';
                name.textContent = chat.customer_name || 'Khách hàng';

                const preview = document.createElement('div');
                preview.className = 'chat-recent-item-preview';
                preview.textContent = chat.last_message || 'Ảnh';

                info.appendChild(name);
                info.appendChild(preview);

                const badge = document.createElement('div');
                badge.className = 'chat-recent-item-badge';
                if (chat.unread_for_customer > 0) {
    item.appendChild(badge);
}



                item.appendChild(info);
                if (chat.unread_for_customer > 0) {
                    item.appendChild(badge);
                }

                item.addEventListener('click', () => {
                    console.log('[Chat] Selected chat from history:', chat.id);
                    self.selectRecentChat(chat.id);
                });

                historyList.appendChild(item);
            });
        },

        // Show screen asking to continue or create new (DEPRECATED - now using showChatHistoryScreen)
        showContinueOrNewScreen: function () {
            // This function is kept for backward compatibility but is no longer used
            // It shows the old dialog, which we've replaced with the history screen
        },

        // Start new session
        startNewSession: function () {
            console.log('[Chat] Starting new session');

            // Close any open Bootstrap modals and remove backdrop
            const allModals = document.querySelectorAll('.modal.show');
            allModals.forEach(modal => {
                const bootstrapModal = bootstrap.Modal.getInstance(modal);
                if (bootstrapModal) {
                    bootstrapModal.hide();
                }
            });
            // Remove any leftover modal-backdrop divs
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());

            // Preserve old session id so user can view history later
            if (this.chatSessionId) {
                localStorage.setItem('chat_prev_session_id', this.chatSessionId);
            }
            // Clear current session
            localStorage.removeItem('chat_session_id');
            this.chatSessionId = null;
            this.sessionCreated = false;

            // ensure badge is updated (no active session)
            this.updateToggleBadge();

            // Clear polling
            if (this.polling) {
                clearInterval(this.polling);
                this.polling = null;
            }

            // Clear form inputs
            const nameInput = document.getElementById('input-name');
            const phoneInput = document.getElementById('input-phone');
            const emailInput = document.getElementById('input-email');
            const messageInput = document.getElementById('input-message');

            if (nameInput) nameInput.value = '';
            if (phoneInput) phoneInput.value = '';
            if (emailInput) emailInput.value = '';
            if (messageInput) messageInput.value = '';

            // Focus on name input
            if (nameInput) {
                setTimeout(() => nameInput.focus(), 100);
            }

            // Show init form
            this.showInitForm();
        },

        // Toggle panel open/close
       togglePanel: function () {
    const panel = window.chatPanel;
    const self = this;

    // --- ĐÓNG PANEL ---
    if (panel.classList.contains('open')) {
        this.closePanel();
        return;
    }

    // --- MỞ PANEL ---
    panel.classList.add('open');

    // Không có session → hiển thị form nhập thông tin ban đầu
    if (!this.chatSessionId) {
        this.showInitForm();
        return;
    }

    // Có session → kiểm tra hiệu lực
    $.ajax({
        url: '{{ route("chat.checkSession") }}',
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { chat_session_id: this.chatSessionId },

        success: function (res) {

            // Session hợp lệ → hiển thị lựa chọn tiếp tục hoặc tạo mới
            if (res.status === 'success' && res.valid === true) {
                self.showSessionChoice();
                return;
            }

            // Session hết hạn → tạo phiên mới
            localStorage.removeItem('chat_session_id');
            self.chatSessionId = null;
            self.startNewSession();
        },

        error: function () {
            // Lỗi server → fallback về form cơ bản
            self.showInitForm();
        }
    });
},

        // Open panel
        openPanel: function () {
            const panel = window.chatPanel;
            const toggleBtn = window.chatToggleBtn;

            if (!panel || !toggleBtn) {
                console.error('[Chat] Cannot find panel or toggle');
                return;
            }

            console.log('[Chat] Opening panel...');

            panel.classList.add('open');
            panel.setAttribute('aria-hidden', 'false');
            panel.setAttribute('data-state', 'open');
            toggleBtn.setAttribute('aria-expanded', 'true');
            toggleBtn.innerHTML = '<i class="fas fa-times"></i>';
            toggleBtn.setAttribute('aria-label', 'Đóng chat');

            console.log('[Chat] Panel opened. Class:', panel.className);
            console.log('[Chat] Session ID:', this.chatSessionId, 'Session created:', this.sessionCreated);

            const self = this;

            // Khi mở panel, set trạng thái online
            if (this.chatSessionId) {
                this.setOnline();
            }

            // Check session validity AFTER opening panel
            if (this.chatSessionId && this.sessionCreated) {
                console.log('[Chat] Session exists, checking if still valid (within 2 days)...');
                $.ajax({
                    url: '{{ route("chat.checkSession") }}',
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: { chat_session_id: this.chatSessionId },
                    success: function (res) {
                        console.log('[Chat] Session check response:', res);
                        if (res.status === 'success' && res.valid) {
                            console.log('[Chat] ✅ Session VALID (within 2 days), showing messages');
                            self.showChatInterface();
                            self.loadMessages();
                        } else if (res.status === 'success' && res.expired) {
                            console.log('[Chat] ❌ Session EXPIRED (> 2 days), showing init form');
                            self.chatSessionId = null;
                            self.sessionCreated = false;
                            localStorage.removeItem('chat_session_id');
                            self.updateToggleBadge();
                            self.showInitForm();
                        } else {
                            console.log('[Chat] ⚠️ Session check failed or session not found, showing init form');
                            self.showInitForm();
                        }
                    },
                    error: function (err) {
                        console.error('[Chat] ❌ openPanel session check error:', err);
                        self.showInitForm();
                    }
                });
            } else {
                console.log('[Chat] No session found, showing init form');
                this.showInitForm();
            }
        },

        // Close panel
        closePanel: function () {
            const panel = window.chatPanel;
            const toggleBtn = window.chatToggleBtn;

            if (!panel || !toggleBtn) {
                console.error('[Chat] Cannot find panel or toggle');
                return;
            }

            console.log('[Chat] Closing panel...');

            // Remove focus from any element inside panel before hiding
            const focusedElement = panel.querySelector(':focus');
            if (focusedElement) {
                focusedElement.blur();
            }

            // Khi đóng panel, set trạng thái offline
            if (this.chatSessionId) {
                // this.setOffline();
            }

            panel.classList.remove('open');
            panel.setAttribute('aria-hidden', 'true');
            panel.setAttribute('data-state', 'closed');
            toggleBtn.setAttribute('aria-expanded', 'false');
            toggleBtn.innerHTML = '<i class="fa-solid fa-message"></i>';
            toggleBtn.setAttribute('aria-label', 'Mở chat');

            console.log('[Chat] Panel closed. Class:', panel.className);

            if (this.polling) {
                clearInterval(this.polling);
                this.polling = null;
            }

            // restore badge when panel closes (if session still exists)
            this.updateToggleBadge();
        },


        // Show chat interface (messages)
        showChatInterface: function () {
            // Close any open Bootstrap modals and remove backdrop
            const allModals = document.querySelectorAll('.modal.show');
            allModals.forEach(modal => {
                const bootstrapModal = bootstrap.Modal.getInstance(modal);
                if (bootstrapModal) {
                    bootstrapModal.hide();
                }
            });
            // Remove any leftover modal-backdrop divs
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());

            const initForm = document.getElementById('chat-info-form');
            const historyScreen = document.getElementById('chat-history-screen');
            const messagesArea = document.getElementById('chat-messages-area');
            const searchScreen = document.getElementById('chat-search-phone-screen');
            const recentScreen = document.getElementById('chat-recent-list-screen');
            const inputFooter = document.getElementById('chat-input-footer');
            const titleBar = document.getElementById('site-chat-title');
            const self = this;

            if (initForm) initForm.style.display = 'none';
            if (historyScreen) historyScreen.style.display = 'none';
            if (messagesArea) {
                messagesArea.style.display = 'flex';
                messagesArea.style.flexDirection = 'column';
                messagesArea.style.flex = '1';
            }
            if (searchScreen) searchScreen.style.display = 'none';
            if (recentScreen) recentScreen.style.display = 'none';
            // Always show input footer when viewing chat
            if (inputFooter) {
                inputFooter.style.display = 'flex';
            }
            // Hide navbar buttons, show input group
            const navButtons = document.querySelector('.chat-nav-buttons');
            const inputGroup = document.querySelector('.chat-input-group');
            if (navButtons) navButtons.classList.add('hidden');
            if (inputGroup) inputGroup.classList.add('visible');

            // Update title bar with back button to history
            if (titleBar) {
                titleBar.innerHTML = `<div class="chat-route-back">
                <button type="button" id="messages-back-btn" class="chat-back-btn" aria-label="Quay lại" title="Quay lại" style="padding-top: 0px;">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <span class="chat-header-text">TIN NHẮN</span>
            </div>`;

                // Add click handler for messages back button
                const messagesBackBtn = document.getElementById('messages-back-btn');
                if (messagesBackBtn) {
                    messagesBackBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        // Navigate to chat history screen (7-day list)
                        self.showChatHistoryScreen();
                        self.setActiveNav(searchPhoneBtn2);
                    });
                }
            }
        },

        // Show init form
        showInitForm: function () {
            // Close any open Bootstrap modals and remove backdrop
            const allModals = document.querySelectorAll('.modal.show');
            allModals.forEach(modal => {
                const bootstrapModal = bootstrap.Modal.getInstance(modal);
                if (bootstrapModal) {
                    bootstrapModal.hide();
                }
            });
            // Remove any leftover modal-backdrop divs
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());

            const infoForm = document.getElementById('chat-info-form');
            const historyScreen = document.getElementById('chat-history-screen');
            const continueScreen = document.getElementById('chat-continue-screen');
            const messagesArea = document.getElementById('chat-messages-area');
            const searchScreen = document.getElementById('chat-search-phone-screen');
            const recentScreen = document.getElementById('chat-recent-list-screen');
            const inputFooter = document.getElementById('chat-input-footer');

            if (infoForm) infoForm.style.display = 'block';
            if (historyScreen) historyScreen.style.display = 'none';
            if (continueScreen) continueScreen.style.display = 'none';
            if (messagesArea) messagesArea.style.display = 'none';
            if (searchScreen) searchScreen.style.display = 'none';
            if (recentScreen) recentScreen.style.display = 'none';
            if (inputFooter) inputFooter.style.display = 'none';
            // Show navbar buttons, hide input group
            const navButtons = document.querySelector('.chat-nav-buttons');
            const inputGroup = document.querySelector('.chat-input-group');
            if (navButtons) navButtons.classList.remove('hidden');
            if (inputGroup) inputGroup.classList.remove('visible');
        },

        // Show search phone screen
        showSearchPhoneScreen: function () {
            // Close any open Bootstrap modals and remove backdrop
            const allModals = document.querySelectorAll('.modal.show');
            allModals.forEach(modal => {
                const bootstrapModal = bootstrap.Modal.getInstance(modal);
                if (bootstrapModal) {
                    bootstrapModal.hide();
                }
            });
            // Remove any leftover modal-backdrop divs
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());

            const infoForm = document.getElementById('chat-info-form');
            const historyScreen = document.getElementById('chat-history-screen');
            const searchScreen = document.getElementById('chat-search-phone-screen');

            if (infoForm) infoForm.style.display = 'none';
            if (historyScreen) historyScreen.style.display = 'none';
            if (searchScreen) searchScreen.style.display = 'block';

            // Clear previous search result
            const resultMsg = document.getElementById('search-result-msg');
            const useBtn = document.getElementById('use-found-chat-btn');
            if (resultMsg) resultMsg.style.display = 'none';
            if (useBtn) useBtn.style.display = 'none';

            // Show navbar buttons, hide input group
            const navButtons = document.querySelector('.chat-nav-buttons');
            const inputGroup = document.querySelector('.chat-input-group');
            if (navButtons) navButtons.classList.remove('hidden');
            if (inputGroup) inputGroup.classList.remove('visible');
        },

        // Search chat by phone (to view old messages)
        searchChatByPhone: function () {
            const phoneInput = document.getElementById('search-phone-input-2');
            const phone = phoneInput ? phoneInput.value.trim() : '';

            if (!phone) {
                alert('Vui lòng nhập số điện thoại');
                return;
            }

            const self = this;
            const resultMsg = document.getElementById('search-result-msg');
            const listContainer = document.getElementById('chat-results-list-container');
            const inlineList = document.getElementById('chat-inline-list');
            const emptyMsg = document.getElementById('chat-inline-empty');

            $.ajax({
                url: '{{ route("chat.getRecentChats") }}',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { phone: phone },
                success: function (res) {
                    if (res && res.chats && res.chats.length > 0) {
                        // Show success message
                        const msgText = '✅ Tìm thấy: ' + res.chats[0].customer_name + ' - ' + res.chats.length + ' cuộc trò chuyện';
                        if (resultMsg) {
                            resultMsg.textContent = msgText;
                            resultMsg.style.display = 'block';
                            resultMsg.style.background = '#d4edda';
                            resultMsg.style.color = '#155724';
                        }

                        // Render chats to inline list
                        self.renderChatsToInlineList(res.chats);

                        // Show inline list container
                        if (listContainer) listContainer.style.display = 'block';
                    } else if (res && res.status === 'success') {
                        // Found session but no messages
                        const msgText = '⚠️ Tìm thấy nhưng tin nhắn đã bị xóa (hết hạn 7 ngày)';
                        if (resultMsg) {
                            resultMsg.textContent = msgText;
                            resultMsg.style.display = 'block';
                            resultMsg.style.background = '#fff3cd';
                            resultMsg.style.color = '#856404';
                        }

                        // Clear inline list and hide
                        if (inlineList) inlineList.innerHTML = '';
                        if (emptyMsg) emptyMsg.style.display = 'block';
                        if (listContainer) listContainer.style.display = 'block';
                    } else {
                        // Not found
                        if (resultMsg) {
                            resultMsg.textContent = '❌ ' + (res.message || 'Không tìm thấy');
                            resultMsg.style.display = 'block';
                            resultMsg.style.background = '#f8d7da';
                            resultMsg.style.color = '#721c24';
                        }
                        if (listContainer) listContainer.style.display = 'none';
                    }
                },
                error: function () {
                    if (resultMsg) {
                        resultMsg.textContent = '❌ Lỗi kết nối';
                        resultMsg.style.display = 'block';
                        resultMsg.style.background = '#f8d7da';
                        resultMsg.style.color = '#721c24';
                    }
                    if (listContainer) listContainer.style.display = 'none';
                }
            });
        },

        // Render chats to inline list in search screen
        renderChatsToInlineList: function (chats) {
            const inlineList = document.getElementById('chat-inline-list');
            const emptyMsg = document.getElementById('chat-inline-empty');

            if (!inlineList) {
                console.error('[Chat] chat-inline-list not found');
                return;
            }

            inlineList.innerHTML = '';

            if (!chats || chats.length === 0) {
                if (emptyMsg) emptyMsg.style.display = 'block';
                return;
            }

            if (emptyMsg) emptyMsg.style.display = 'none';

            const self = this;
            chats.forEach((chat) => {
                const item = document.createElement('div');
                item.className = 'chat-recent-item';

                const info = document.createElement('div');
                info.className = 'chat-recent-item-info';

                const name = document.createElement('div');
                name.className = 'chat-recent-item-name';
                name.textContent = chat.customer_name || 'Khách hàng';

                const preview = document.createElement('div');
                preview.className = 'chat-recent-item-preview';
                preview.textContent = chat.last_message || 'Ảnh';

                info.appendChild(name);
                info.appendChild(preview);

                const badge = document.createElement('div');
                badge.className = 'chat-recent-item-badge';
                if (chat.unread_for_customer > 0) {
    item.appendChild(badge);
}



                item.appendChild(info);
                if (chat.unread_for_customer > 0) {
                    item.appendChild(badge);
                }

                item.addEventListener('click', () => {
                    console.log('[Chat] Selected chat from inline list:', chat.id);
                    self.selectRecentChat(chat.id);
                });

                inlineList.appendChild(item);
            });
        },

        // Load historical messages (read-only mode)
        loadHistoricalMessages: function () {
            console.log('[Chat] Loading historical messages for session:', this.foundSessionId);
            // Set the current session to the found session so user can chat
            this.chatSessionId = this.foundSessionId;
            localStorage.setItem('chat_session_id', this.chatSessionId);

            this.sessionCreated = true;
            this.showChatInterface();
            this.fetchMessagesFor(this.foundSessionId);
            // Start polling for new messages
            if (!this.polling) {
                this.polling = setInterval(() => this.fetchMessages(), 3000);
            }
        },

        // Show recent chats list screen
        showRecentChatsScreen: function () {
            // Close any open Bootstrap modals and remove backdrop
            const allModals = document.querySelectorAll('.modal.show');
            allModals.forEach(modal => {
                const bootstrapModal = bootstrap.Modal.getInstance(modal);
                if (bootstrapModal) {
                    bootstrapModal.hide();
                }
            });
            // Remove any leftover modal-backdrop divs
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());

            // Get phone from search input
            const phoneInput = document.getElementById('search-phone-input-2');
            const phone = phoneInput ? phoneInput.value.trim() : '';

            if (!phone) {
                alert('Vui lòng nhập số điện thoại');
                return;
            }

            // Hide search screen, show recent list screen
            const searchScreen = document.getElementById('chat-search-phone-screen');
            const recentScreen = document.getElementById('chat-recent-list-screen');
            if (searchScreen) searchScreen.style.display = 'none';
            if (recentScreen) {
                recentScreen.style.display = 'flex';
                recentScreen.style.flexDirection = 'column';
                recentScreen.style.flex = '1';
            }
            // Show navbar buttons, hide input group
            const navButtons = document.querySelector('.chat-nav-buttons');
            const inputGroup = document.querySelector('.chat-input-group');
            if (navButtons) navButtons.classList.remove('hidden');
            if (inputGroup) inputGroup.classList.remove('visible');

            // Fetch and render recent chats for this phone
            const self = this;
            console.log('[Chat] Loading recent chats for phone:', phone);
            $.ajax({
                url: '{{ route("chat.getRecentChats") }}',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { phone: phone },
                success: function (res) {
                    console.log('[Chat] Recent chats response:', res);
                    self.renderRecentChats(res.chats || []);
                },
                error: function (err) {
                    console.error('[Chat] Error loading recent chats:', err);
                    alert('Lỗi tải danh sách cuộc trò chuyện');
                }
            });
        },

        // Render recent chats list
        renderRecentChats: function (chats) {
            const container = document.getElementById('chat-recent-list-container');
            const emptyMsg = document.getElementById('chat-recent-empty');
            const recentScreen = document.getElementById('chat-recent-list-screen');

            console.log('[Chat] renderRecentChats called with chats:', chats);
            console.log('[Chat] recentScreen display:', recentScreen ? recentScreen.style.display : 'NOT FOUND');
            console.log('[Chat] container display:', container ? container.style.display : 'NOT FOUND');

            if (!container) {
                console.error('[Chat] chat-recent-list-container not found');
                return;
            }

            container.innerHTML = '';

            if (!chats || chats.length === 0) {
                console.log('[Chat] No chats to display');
                if (emptyMsg) emptyMsg.style.display = 'block';
                return;
            }

            if (emptyMsg) emptyMsg.style.display = 'none';

            console.log('[Chat] Rendering ' + chats.length + ' chats');
            const self = this;
            chats.forEach((chat) => {
                const item = document.createElement('div');
                item.className = 'chat-recent-item';

                const info = document.createElement('div');
                info.className = 'chat-recent-item-info';

                const name = document.createElement('div');
                name.className = 'chat-recent-item-name';
                name.textContent = chat.customer_name || 'Khách hàng';

                const preview = document.createElement('div');
                preview.className = 'chat-recent-item-preview';
                preview.textContent = chat.last_message || 'Ảnh';

                info.appendChild(name);
                info.appendChild(preview);

                const badge = document.createElement('div');
                badge.className = 'chat-recent-item-badge';
                if (chat.unread_for_customer > 0) {
    item.appendChild(badge);
}


                item.appendChild(info);
                if (chat.unread_for_customer > 0) {
                    item.appendChild(badge);
                }

                item.addEventListener('click', () => {
                    console.log('[Chat] Selected chat:', chat.id);
                    self.selectRecentChat(chat.id);
                });

                container.appendChild(item);
            });
            console.log('[Chat] Rendered ' + chats.length + ' chats successfully');
        },

        // Select a recent chat to view
        selectRecentChat: function (chatSessionId) {
            // Close any open Bootstrap modals and remove backdrop
            const allModals = document.querySelectorAll('.modal.show');
            allModals.forEach(modal => {
                const bootstrapModal = bootstrap.Modal.getInstance(modal);
                if (bootstrapModal) {
                    bootstrapModal.hide();
                }
            });
            // Remove any leftover modal-backdrop divs
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());

            this.chatSessionId = chatSessionId;
            localStorage.setItem('chat_session_id', chatSessionId);
            this.sessionCreated = true;

            // Hide recent list, show messages
            const recentScreen = document.getElementById('chat-recent-list-screen');
            if (recentScreen) recentScreen.style.display = 'none';

            this.showChatInterface();
            this.markMessagesReadCustomer();
            this.fetchMessages();
            // Start polling
            if (!this.polling) {
                this.polling = setInterval(() => this.fetchMessages(), 3000);
            }
        },
        // Render messages into the messages list container
      renderMessages: function(messages,customerName) {
    const list = document.getElementById('chat-messages-list');
    if (!list) return;

    const baseUrl = window.location.origin;

    // Lưu vị trí scroll hiện tại
    const scrollTop = list.scrollTop;
    const scrollHeight = list.scrollHeight;
    const clientHeight = list.clientHeight;
    const isAtBottom = (scrollTop + clientHeight >= scrollHeight - 20); // khoảng margin 20px

    list.innerHTML = '';
    if (!messages || messages.length === 0) {
        list.innerHTML = '<div class="site-chat-empty">Chưa có tin nhắn nào</div>';
        return;
    }

    messages.forEach((m) => {
        const wrap = document.createElement('div');
        wrap.style.display = 'flex';
        wrap.style.gap = '12px';
        wrap.style.marginBottom = '12px';
        wrap.style.justifyContent = m.is_admin ? 'flex-start' : 'flex-end';

        // Xác định tên người gửi
        let senderName = 'Khách';

if (m.is_admin) {
    senderName = (m.admin && m.admin.admin_name) ? m.admin.admin_name : 'Admin';
} else {
    // Ưu tiên tên khách từ API
    senderName = m.customer_name || customerName || 'Khách';
}


        // Xác định avatar
        let avatarUrl;
        if (m.is_admin) {
            // Admin: dùng đường dẫn mặc định
            avatarUrl = baseUrl + '/public/frontend/images/customer/avt_default.webp';
        } else {
            // Khách hàng: lấy từ API (m.avatar) hoặc dùng UI-avatars.com theo tên
            if (m.customer_avatar) {
    avatarUrl = m.customer_avatar;
} else {
    avatarUrl = 'https://ui-avatars.com/api/?name=' + encodeURIComponent(senderName) + '&background=random&size=40';
}

        }

        // Container tin nhắn: avatar + content
        const msgContainer = document.createElement('div');
        msgContainer.style.display = 'flex';
        msgContainer.style.gap = '8px';
        msgContainer.style.alignItems = 'flex-end';
        
        // Nếu là admin: avatar ở bên trái
        if (m.is_admin) {
            const avatarImg = document.createElement('img');
            avatarImg.src = avatarUrl;
            avatarImg.style.width = '40px';
            avatarImg.style.height = '40px';
            avatarImg.style.borderRadius = '50%';
            avatarImg.style.objectFit = 'cover';
            avatarImg.style.border= '2px solid #ddd';
            msgContainer.appendChild(avatarImg);
        }

        // Container chứa tên và tin nhắn
        const contentWrap = document.createElement('div');
        contentWrap.style.display = 'flex';
        contentWrap.style.flexDirection = 'column';
        contentWrap.style.gap = '4px';
        contentWrap.style.alignItems = m.is_admin ? 'flex-start' : 'flex-end';

        // Hiển thị tên người chat và thời gian
        const d = new Date(m.created_at);
        const time = `${d.getHours().toString().padStart(2,'0')}:${d.getMinutes().toString().padStart(2,'0')}`;
        
        const nameElement = document.createElement('small');
        nameElement.style.marginBottom = '-5px';
        nameElement.style.fontSize = '12px';
        nameElement.style.color = '#2b2b2b';
        nameElement.textContent = senderName + ' • ' + time;
        contentWrap.appendChild(nameElement);

        // Bubble tin nhắn
        const bubble = document.createElement('div');
        bubble.style.padding = '6px 8px';
        bubble.style.borderRadius = '12px';
        bubble.style.maxWidth = '200px';
        bubble.style.wordWrap = 'break-word';
        bubble.style.display = 'inline-block';
        
        if (m.is_admin) {
            // Admin: nền nhạt, text tối
            bubble.style.backgroundColor = '#e8eef7';
            bubble.style.color = '#222';
        } else {
            // Khách hàng: nền xanh, text trắng
            bubble.style.backgroundColor = '#007bff';
            bubble.style.color = '#fff';
        }

        if (m.message && m.message.trim() !== '') {
            bubble.textContent = m.message;
        } else if (m.file_path) {
    const img = document.createElement('img');
    img.src = window.location.origin + '/public/chat/images/' + m.file_path;
    img.style.maxWidth = '180px';
    img.style.borderRadius = '8px';
    img.style.cursor = 'pointer';
    img.classList.add('chat-message-image');

    bubble.innerHTML = '';             // clear để chắc chắn không dính text
    bubble.style.padding = '4px';      // padding riêng cho bubble hình
    bubble.appendChild(img);
}

        contentWrap.appendChild(bubble);

        msgContainer.appendChild(contentWrap);

        // Nếu là khách hàng: avatar ở bên phải
        if (!m.is_admin) {
            const avatarImg = document.createElement('img');
            avatarImg.src = avatarUrl;
            avatarImg.style.width = '40px';
            avatarImg.style.height = '40px';
            avatarImg.style.borderRadius = '50%';
            avatarImg.style.objectFit = 'cover';
            avatarImg.style.border= '2px solid #ddd';
            msgContainer.appendChild(avatarImg);
        }

        wrap.appendChild(msgContainer);
        list.appendChild(wrap);
    });

    // Chỉ scroll xuống nếu đang ở cuối
    if (isAtBottom) {
        setTimeout(() => {
            list.scrollTop = list.scrollHeight;
        }, 50);
    }
}
,
        // Update the small toggle badge: show if there's an active session and panel is closed
        updateToggleBadge: function () {
            try {
                const toggleBtn = window.chatToggleBtn || document.getElementById('chat-toggle-btn');
                const panel = window.chatPanel || document.getElementById('site-chat');
                if (!toggleBtn) return;
                // ensure badge element exists (innerHTML changes may remove it)
                let badgeEl = document.getElementById('chat-badge');
                if (!badgeEl) {
                    badgeEl = document.createElement('span');
                    badgeEl.id = 'chat-badge';
                    badgeEl.className = 'chat-badge';
                    badgeEl.style.display = 'none';
                    try { toggleBtn.appendChild(badgeEl); } catch (e) { /* ignore */ }
                }
                // hide badge if panel is open
                if (panel && panel.classList.contains('open')) {
                    badgeEl.style.display = 'none';
                    return;
                }
                // show badge only when there is a stored session id
                if (this.chatSessionId) {
                    badgeEl.style.display = 'block';
                    toggleBtn.classList.add('has-badge');
                } else {
                    badgeEl.style.display = 'none';
                    toggleBtn.classList.remove('has-badge');
                }
            } catch (e) {
                console.error('[Chat] updateToggleBadge error', e);
            }
        },
        // Fetch messages for a given session id (helper)
        fetchMessagesFor: function (sessionId) {
            if (!sessionId) return;
            const self = this;
            $.ajax({
                url: '{{ route("chat.messages") }}',
                method: 'GET',
                data: { chat_session_id: sessionId },
                success: function (res) {
                    if (res && res.status === 'success') {
                        self.renderMessages(res.messages);
                    }
                },
                error: function (err) {
                    console.error('[Chat] Fetch error:', err);
                }
            });
        },
        // Fetch messages from API
        fetchMessages: function () {
            if (!this.chatSessionId) return;
            this.fetchMessagesFor(this.chatSessionId);
        },
        // Load messages (alias for fetchMessages, used on page load)
        loadMessages: function () {
            if (!this.chatSessionId) return;
            const self = this;
            $.ajax({
                url: '{{ route("chat.messages") }}',
                method: 'GET',
                data: { chat_session_id: this.chatSessionId },
                success: function (res) {
                    if (res && res.status === 'success') {
                        self.renderMessages(res.messages);
                        // Start polling after loading initial messages
                        if (!self.polling) {
                            self.polling = setInterval(() => self.fetchMessages(), 3000);
                        }
                    }
                },
                error: function (err) {
                    console.error('[Chat] Load messages error:', err);
                }
            });
        },

        // Create session
        createSession: function () {
            const nameInput = document.getElementById('input-name');
            const phoneInput = document.getElementById('input-phone');
            const emailInput = document.getElementById('input-email');
            const messageInput = document.getElementById('input-message');
            const name = nameInput ? nameInput.value.trim() : '';
            const phone = phoneInput ? phoneInput.value.trim() : '';
            const email = emailInput ? emailInput.value.trim() : '';
            const message = messageInput ? messageInput.value.trim() : '';
            if (!name || !phone) {
                alert('Vui lòng nhập đầy đủ thông tin (Tên, SĐT)');
                return;
            }
            // Generate default avatar from initials
            const initials = name.split(' ').map(n => n[0]).join('').toUpperCase();
            const avatarUrl = 'https://ui-avatars.com/api/?name=' + encodeURIComponent(initials) + '&background=random';
            const self = this;
            $.ajax({
                url: '{{ route("chat.createSession") }}',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    customer_name: name,
                    customer_phone: phone,
                    customer_email: email,
                    customer_message: message,
                    customer_avatar: avatarUrl
                },
                success: function (res) {
                    if (res && res.status === 'success') {
                        self.chatSessionId = res.chat_session_id;
                        localStorage.setItem('chat_session_id', self.chatSessionId);
                        self.sessionCreated = true;
                        console.log('[Chat] Session created:', self.chatSessionId);
                        const initForm = document.getElementById('chat-form-init');
                        if (initForm) initForm.reset();
                        // Update customer online status
                        $.ajax({
                            url: '{{ route("chat.updateStatus") }}',
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            data: {
                                chat_session_id: self.chatSessionId,
                                is_online: true
                            }
                        });
                        if (message) {
                            $.ajax({
                                url: '{{ route("chat.send") }}',
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                data: { message: message, chat_session_id: self.chatSessionId },
                                success: function () {
                                    console.log('[Chat] Initial message sent');
                                    self.fetchMessages();
                                }
                            });
                        }
                        self.showChatInterface();
                        if (!self.polling) {
                            self.polling = setInterval(() => self.fetchMessages(), 3000);
                        }
                        // session now exists; remove badge if present
                        self.updateToggleBadge();
                    } else {
                        alert('Lỗi: ' + (res.message || 'Không thể tạo phiên chat'));
                    }
                },
                error: function (err) {
                    console.error('[Chat] Create session error:', err);
                    alert('Lỗi: không thể tạo phiên chat');
                }
            });
        },

        showSessionChoice: function () {
    const choice = document.getElementById('chat-session-choice');
    const initForm = document.getElementById('chat-info-form');
    const messagesArea = document.getElementById('chat-messages-area');
    const historyScreen = document.getElementById('chat-history-screen');

    if (choice) choice.style.display = 'flex';
    if (initForm) initForm.style.display = 'none';
    if (messagesArea) messagesArea.style.display = 'none';
    if (historyScreen) historyScreen.style.display = 'none';

    const titleBar = document.getElementById('site-chat-title');
    if (titleBar) titleBar.textContent = "HIẾU STORE";

    const self = this;

    // --- TIẾP TỤC CHAT CŨ ---
    const btnContinue = document.getElementById('continue-old-session');
    if (btnContinue) {
        btnContinue.type = 'button'; // ngăn form submit
        btnContinue.onclick = function (e) {
            e.preventDefault(); // phòng trường hợp vẫn trong form
            choice.style.display = 'none';
            self.showChatInterface();
            self.loadMessages(self.chatSessionId);

            if (!self.polling) {
                self.polling = setInterval(() => self.fetchMessages(), 3000);
            }
        };
    }

    // --- TẠO MỚI SESSION ---
    const btnNew = document.getElementById('start-new-session');
    if (btnNew) {
        btnNew.type = 'button';
        btnNew.onclick = function (e) {
            e.preventDefault();
            localStorage.removeItem('chat_session_id');
            self.chatSessionId = null;

            choice.style.display = 'none';
            self.startNewSession(); // alert chỉ xảy ra trong startNewSession()
        };
    }
},


        // Send message
        sendMessage: function () {
            const chatInput = document.getElementById('chat-input');
            const message = chatInput ? chatInput.value.trim() : '';

            if (!message || !this.chatSessionId) {
                if (!this.chatSessionId) alert('Session chưa được tạo');
                return;
            }

            const self = this;

            // Update customer online status
            $.ajax({
                url: '{{ route("chat.updateStatus") }}',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    chat_session_id: this.chatSessionId,
                    is_online: true
                }
            });

            $.ajax({
                url: '{{ route("chat.send") }}',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { message: message, chat_session_id: this.chatSessionId },
                success: function (res) {
                    if (res && res.status === 'success') {
                        console.log('[Chat] Message sent');
                        if (chatInput) chatInput.value = '';
                        self.fetchMessages();
                    } else {
                        alert('Lỗi: ' + (res.message || 'Không thể gửi'));
                    }
                },
                error: function (err) {
                    console.error('[Chat] Send error:', err);
                }
            });
        }
    };
    // Auto-init when script loads
    window.chatWidget.init();
    console.log('[Chat] Script loaded');
    document.getElementById('chat-messages-list').addEventListener('click', function(e){
    if(e.target.tagName === 'IMG' && e.target.classList.contains('chat-message-image')){
        let overlay = document.getElementById('chat-image-zoom');
        if(!overlay){
            overlay = document.createElement('div');
            overlay.id = 'chat-image-zoom';
            overlay.style.cssText = 'display:flex;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.8);justify-content:center;align-items:center;z-index:99999;';
            const img = document.createElement('img');
            img.id = 'chat-image-zoom-img';
            img.style.maxWidth = '90%';
            img.style.maxHeight = '90%';
            img.style.borderRadius = '8px';
            overlay.appendChild(img);
            const closeBtn = document.createElement('button');
            closeBtn.id = 'chat-image-zoom-close';
            closeBtn.textContent = 'X';
            closeBtn.style.cssText = 'position:absolute;top:20px;right:20px;background:#fff;border:none;padding:6px 10px;border-radius:4px;cursor:pointer;font-weight:bold;';
            overlay.appendChild(closeBtn);
            document.body.appendChild(overlay);

            closeBtn.addEventListener('click', ()=> overlay.style.display='none');
            overlay.addEventListener('click', e2 => { if(e2.target===overlay) overlay.style.display='none'; });
        }
        document.getElementById('chat-image-zoom-img').src = e.target.src;
        overlay.style.display = 'flex';
    }
    
});

</script><!-- Floating Messenger Button (moved here from layout for centralized management) -->
<a href="https://m.me/715877854952775" target="_blank" class="messenger-btn" aria-label="Messenger">
    <img src="https://upload.wikimedia.org/wikipedia/commons/b/be/Facebook_Messenger_logo_2020.svg" alt="Messenger" />
</a>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        function showError(input, message) {
            input.classList.add("is-invalid");
            const label = input.parentElement.querySelector(".label");
            label.classList.add("error-message");
            label.setAttribute("data-error", message);
        }

        function clearError(input) {
            input.classList.remove("is-invalid");
            const label = input.parentElement.querySelector(".label");
            label.classList.remove("error-message");
            label.removeAttribute("data-error");
        }

        const nameInput = document.getElementById("input-name");
        const phoneInput = document.getElementById("input-phone");
        const emailInput = document.getElementById("input-email");
        const messageInput = document.getElementById("input-message");

        // Tên
        nameInput.addEventListener("blur", () => {
            if (nameInput.value.trim().length < 2) {
                showError(nameInput, "không được để trống");
            } else clearError(nameInput);
        });

        // Số điện thoại
        phoneInput.addEventListener("input", () => {
            phoneInput.value = phoneInput.value.replace(/\D/g, "").slice(0, 10);
        });

        phoneInput.addEventListener("blur", () => {
            const v = phoneInput.value.trim();
            if (v.length !== 10) {
                showError(phoneInput, "phải đủ 10 số");
            } else clearError(phoneInput);
        });

        // Email
        emailInput.addEventListener("blur", () => {
            const email = emailInput.value.trim();
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email !== "" && !regex.test(email)) {
                showError(emailInput, "không hợp lệ");
            } else clearError(emailInput);
        });

        // Tin nhắn
        messageInput.addEventListener("blur", () => {
            if (messageInput.value.trim() === "") {
                showError(messageInput, "không được để trống");
            } else clearError(messageInput);
        });

    });
const chatFileInput = document.getElementById('chat-file');
const chatAttachBtn = document.getElementById('chat-attach');
const chatPreviewPopup = document.getElementById('chat-image-preview-popup');
const chatPreviewImg = document.getElementById('chat-image-preview-img');
const chatImageSendBtn = document.getElementById('chat-image-send');
const chatImageRemoveBtn = document.getElementById('chat-image-remove');

chatAttachBtn.addEventListener('click', () => chatFileInput.click());

chatFileInput.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;

    // Hiển thị preview trong popup overlay
    const reader = new FileReader();
    reader.onload = function (e) {
        chatPreviewImg.src = e.target.result;
        chatPreviewPopup.style.display = 'flex'; // overlay, nằm trên cùng
    };
    reader.readAsDataURL(file);
});

// Xóa file và ẩn popup
chatImageRemoveBtn.addEventListener('click', () => {
    chatFileInput.value = '';
    chatPreviewImg.src = '';
    chatPreviewPopup.style.display = 'none';
});

// Gửi file
chatImageSendBtn.addEventListener('click', () => {
    const file = chatFileInput.files[0];
    if (!file) return;

    const formData = new FormData();
    formData.append('file', file);
    formData.append('chat_session_id', window.chatSessionId || localStorage.getItem('chat_session_id'));

    fetch('{{ route("chat.send") }}', { // blade route đảm bảo đúng URL
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if(res.status === 'success') {
            chatFileInput.value = '';
            chatPreviewImg.src = '';
            chatPreviewPopup.style.display = 'none';
            // reload tin nhắn
            window.chat.fetchMessages();
        } else {
            alert(res.message || 'Gửi thất bại');
        }
    })
    .catch(err => console.error('[Chat] Send image error:', err));
});

</script>