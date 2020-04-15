let my_number = null;

var rows = [], media_attached = false, notifications_hash = {}, stop = false;

function initReport() {
    rows = [
        ["Phone Number", "Result"]
    ];
};

function init() {
    messageListner();
    initReport();
    window.onload = function() {
        if(window.location.host !== 'web.whatsapp.com')
            window.open("https://web.whatsapp.com", "_blank");
        else {
            my_number = window.localStorage.getItem("last-wid").split("@")[0].substring(1);
        }
    };
}

function messageListner() {
    chrome.runtime.onMessage.addListener(listner);
}

function listner(request, sender, sendResponse){
    if(request.type === 'download_group')
        download_group();
    else if(request.type === 'sheet')
        process_sheet(request.data, request.message);
    else if(request.type === 'attachment')
        attachMedia(request.media_type);
    else if(request.type === 'download_report')
        download_report();
    else if(request.type === 'number_message')
        messanger(request.numbers, request.message, request.time_gap, request.csv_data, request.customization);
    else if(request.type === 'help')
        help();
    else if(request.type === 'stop') {
        stop = true;
    }
}

function sendChromeMessage(message) {
    chrome.runtime.sendMessage(message);
}


async function process_sheet(data, message) {
    var numbers = [];
    for (let i = 0; i < data.length; i++) {
        for (let j = 0; j < data[i].length; j++) {
            numbers.push(data[i][j]);
        }
    }
    messanger(numbers, message);
}

async function help() {
    await openNumber('919175419148');
    var message = 'Hi, I need help in using WA Web Sender';
    messageBox = document.querySelectorAll("[contenteditable='true']")[1], event = document.createEvent("UIEvents"), messageBox.innerHTML = message.replace(/ /gm, " "), event.initUIEvent("input", !0, !0, window, 1), messageBox.dispatchEvent(event);
}

async function get_messages(message, csv_data) {
    var messages = [];

    chrome.storage.sync.get('json_api',function (store) {
        if(store.json_api){
            $( store.json_api ).each(function( index ,value ) {
                messages.push(value.message);
            });
        }
    });
    return messages;
}

async function setMessages(message, csv_data) {
    var messages = [];
    for (var i = 1; i < csv_data.length; i++) {
        var temp_message = message;
        for (var j = 0; j < csv_data[0].length; j++) {
            var variable = csv_data[0][j];
            var curr_text = csv_data[i][j];
            temp_message = temp_message.replaceAll('{{'+variable+'}}', curr_text);
        }
        messages.push(temp_message);
    }
    return messages;
}

async function messanger(numbers, message, time_gap, csv_data, customization) {
    initReport();
    notifications_hash['type'] = 'send_notification';
    notifications_hash['title'] = 'Your messages are being sent';
    notifications_hash['message'] = '';
    sendChromeMessage(notifications_hash);

    // comment by hasan
    // if(customization) {
    //     var messages = await setMessages(message, csv_data);
    // }
    // wite by hasan new function
    var messages= await get_messages();

    for (let i = 0; i < numbers.length; i++) {
        console.log(stop);
        if(stop) {
            stop = false;
            break;
        }
        var number = numbers[i];
       message=messages[i];
        number = number.replace(/\D/g, '');
        // commint by hassan
        // if(customization)
        //     message = messages[i];

        var a = null;
        if (number.length < 10) {
            rows.push([numbers[i], 'Invalid Number']);
            continue;
        }
        try {
            var curr_time_gap = time_gap;
            if(i===0)
                curr_time_gap = 1;
            a = await openNumber(number, curr_time_gap);
        } catch (e) {
            continue
        }
        if (!a) {
            rows.push([numbers[i], 'Invalid Number']);
            continue;
        } else if (!message) {
            rows.push([numbers[i], 'Invalid Message']);
            continue;
        } else if (message) {
            await sendMessage(number, message);
            rows.push([number, 'Message sent']);
        }

        if (media_attached) {
            await sendAttachment(number);
        }
    }

    chrome.storage.sync.set({'json_api':[]});


    media_attached = false;
    notifications_hash['type'] = 'send_notification';
    notifications_hash['title'] = 'Your messages are sent';
    notifications_hash['message'] = 'Open the extension to download the report';
    sendChromeMessage(notifications_hash);
}

async function sendAttachment(number) {
    let name = null,
        t = document.querySelector("[aria-selected='true'] img") ? document.querySelector("[aria-selected='true'] img")
            .getAttribute("src") : null;
    document.querySelector("[aria-selected='true'] [title]") ? name = document.querySelector("[aria-selected='true'] [title]")
        .getAttribute("title")
        .trim() : document.querySelector("header span[title]") && (name = document.querySelector("header span[title]")
        .getAttribute("title")
        .replace(/[^A-Z0-9]/gi, "")
        .trim());
    let n = !1;
    try {
        if (n = await openNumber(my_number)) {
            let n = document.querySelectorAll("[data-testid='forward-chat']"), o = n[n.length - 1];
            await o.click();
            let l = document.querySelectorAll("[data-animate-modal-body='true'] div[class=''] > div div[tabindex='-1']");
            for (let n = 0; n < l.length; n++) {
                if(l[n].querySelector("span[dir='auto']")) {
                    let o = l[n].querySelector("span[dir='auto']"),
                        s = l[n].querySelector("span[dir='auto']").title.trim();
                    if (s === name || s.replace(/[^A-Z0-9]/gi, "")
                        .trim() === name) {
                        let e = !t || !l[n].querySelector("img") || l[n].querySelector("img").src === t;
                        if (!e) continue;
                        await sendMedia(o), document.querySelector("[data-icon='send']").click();
                        rows.push([number, 'attachment sent']);
                        break
                    }
                }
            }
        }
    }catch (e) {
        console.log(e, "ERROR");
        rows.push([number, 'attachment failed']);
    }
}

async function sendMedia(e) {
    return new Promise(t => {
        setTimeout(function() {
            e.click(), t()
        }, 500)
    })
}


async function openNumber(number) {
    openNumber(number, 1);
}

async function openNumber(number, time_gap) {
    if(!time_gap)
        time_gap = 3;
    return new Promise(t => {
        openNumberTab(number)
            .then(() => {
                setTimeout(async function() {
                    let e = !1;
                    e = await hasOpened(), t(e)
                }, (time_gap*1000))
            })
    })
}

async function openNumberTab(number) {
    return new Promise(t => {
        let n = document.getElementById("whatsapp-message-sender");
        n || ((n = document.createElement("a"))
            .id = "whatsapp-message-sender", document.body.append(n)), n.setAttribute("href", `https://api.whatsapp.com/send?phone=${number}`), setTimeout(() => {
            n.click(), t()
        }, 500)
    });
}

async function eventFire(e, t) {
    var n = document.createEvent("MouseEvents");
    return n.initMouseEvent(t, !0, !0, window, 0, 0, 0, 0, 0, !1, !1, !1, !1, 0, null), new Promise(function(t) {
        var o = setInterval(function() {
            document.querySelector('span[data-icon="send"]') && (e.dispatchEvent(n), t((clearInterval(o), "BUTTON CLICKED")))
        }, 500)
    })
}

async function hasOpened() {
    let e = !0;
    return await waitTillWindow(), document.querySelector('[data-animate-modal-popup="true"]') && (e = !1), e
}

async function waitTillWindow() {
    document.querySelector('[data-animate-modal-popup="true"]') && !document.querySelector('[data-animate-modal-body="true"]')
        .innerText.includes("invalid") && setTimeout(async function() {
        await waitTillWindow()
    }, 500)
}

function sendMessage(number, message){
    messageBox = document.querySelectorAll("[contenteditable='true']")[1], event = document.createEvent("UIEvents"), messageBox.innerHTML = message.replace(/ /gm, " "), event.initUIEvent("input", !0, !0, window, 1), messageBox.dispatchEvent(event), eventFire(document.querySelector('span[data-icon="send"]'), "click")
}

function download_report(){
    let s = "data:text/csv;charset=utf-8," + rows.map(e => e.join(","))
        .join("\n");
    var o = encodeURI(s),
        l = document.createElement("a");
    l.setAttribute("href", o), l.setAttribute("download", "report.csv"), document.body.appendChild(l), l.click()
};

async function download_group() {
    var e = document.querySelector('div[title="Search…"]')
            .parentElement.parentElement.parentElement.parentElement.children[1].lastElementChild.textContent,
        t = document.querySelector('div[title="Search…"]')
            .parentElement.parentElement.parentElement.parentElement.children[1].firstElementChild.textContent;
    if ("online" === e || "typing..." === e || "check here for contact info" === e || "" === e || e.includes("last seen"));
    else {
        var n = [
            ["Numbers"]
        ];
        e.split(", ")
            .forEach(e => {
                arr = [], arr.push(e), n.push(arr)
            });
        let s = "data:text/csv;charset=utf-8," + n.map(e => e.join(","))
            .join("\n");
        var o = encodeURI(s),
            l = document.createElement("a");
        l.setAttribute("href", o), l.setAttribute("download", t + ".csv"), document.body.appendChild(l), l.click()
    }
}

async function clickOnElements(e) {
    let t = document.createEvent("MouseEvents");
    t.initEvent("mouseover", !0, !0);
    const n = document.querySelector(e)
        .dispatchEvent(t);
    t.initEvent("mousedown", !0, !0);
    const o = document.querySelector(e)
        .dispatchEvent(t);
    t.initEvent("mouseup", !0, !0);
    const l = document.querySelector(e)
        .dispatchEvent(t);
    t.initEvent("click", !0, !0);
    const s = document.querySelector(e)
        .dispatchEvent(t);
    return n ? new Promise(e => {
        e()
    }) : await clickOnElements(e)
}
async function clickMediaIcon(e) {
    let t = null;
    "pv" === e ? t = '[data-icon="attach-image"]' : "doc" === e ? t = '[data-icon="attach-document"]' : "cn" === e && (t = '[data-icon="attach-contact"]'), t && await clickOnElements(t)
}

async function attachMedia(type) {
    try {
        hasOpenedSelf = await openNumber(my_number), await clickOnElements('[data-testid="clip"] svg'), await clickMediaIcon(type);
    } catch (e) {
        console.log(type, "ERROR")
    }
    media_attached = true;
    setTimeout(function(){
        notifications_hash['type'] = 'send_notification';
        notifications_hash['title'] = 'First message is always sent to you';
        notifications_hash['message'] = "Now open the extension and click on 'Send Message'";
        sendChromeMessage(notifications_hash);
    }, 5000);
}

init();
