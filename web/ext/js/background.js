var notifications = {
    type: "basic",
    iconUrl: "logo/large.png",
    title: "WA Web Sender is installed",
    message: "Click to view more."
};

chrome.runtime.onInstalled.addListener((async function(e) {
    send_notification("WA Web Sender is installed", '');
}));

chrome.runtime.setUninstallURL("https://wawebsender.online/help-us-improve");

function messageListner() {
    chrome.runtime.onMessage.addListener(listner);
}

function listner(request, sender, sendResponse){
    if(request.type === 'send_notification')
        send_notification(request.title, request.message);
}

function send_notification(title, message) {
    notifications['title'] = title;
    notifications['message'] = message;
    try {
        chrome.notifications.create(notifications, (function(e) {}))
    } catch (e) {}
}

function bcdinit() {
    messageListner();
}

bcdinit();