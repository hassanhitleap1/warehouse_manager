(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga'); // Note: https protocol here

ga('create', 'UA-190269211-1', 'auto'); // Enter your GA identifier
ga('set', 'checkProtocolTask', function(){}); // Removes failing protocol check. @see: http://stackoverflow.com/a/22152353/1958200
ga('require', 'displayfeatures');
ga('send', 'pageview', 'chrome-extension:///klfaghfflijdgoljefdlofkoinndmpia/popup.html'); // Specify the virtual path

var csv_data = [];

$(function(){
    init();
});

function initvars() {
    chrome.storage.local.get(['popup_numbers', 'popup_message', 'popup_send_attachments', 'popup_attachment_type', 'time_gap', 'file_name', 'csv_data', 'customization'], function (result) {
        if(result.popup_numbers !== undefined){
            document.querySelector("textarea#numbers").value = result.popup_numbers;
        }
        if(result.popup_message !== undefined){
            document.querySelector("textarea#message").value = result.popup_message;
        }
        if(result.popup_send_attachments !== undefined){
            document.querySelector("#send_attachments").checked = result.popup_send_attachments;
            send_attachments_trigger();
            if(result.popup_send_attachments && (result.popup_attachment_type !== undefined)){
                document.querySelector("#"+result.popup_attachment_type).checked = true;
            }
        }
        if(result.time_gap !== undefined && result.time_gap !== "")
            document.querySelector("#time_gap").value = result.time_gap;
        else
            document.querySelector("#time_gap").value = "3";
        console.log(result.file_name);
        if((result.file_name !== undefined) || (result.file_name !== '')){
            file_data_style(result.file_name);
            csv_data = result.csv_data;
            if(csv_data){
                var column_headers = csv_data[0];
                $('#customized_arr').empty();
                $('#customized_arr').append($('<option disabled selected></option>').val('Select Option').html('Select Option'));
                $.each(column_headers, function(i, p) {
                    $('#customized_arr').append($('<option></option>').val(p).html(p));
                });
            }
        }
    });
}

function init() {
    checkVisit();
    initvars();
    getMessage();
}


function get_data(str_search) {
    var arr=str_search.split('string_id=');
    var string_id=arr[1];
    var SITE_URL="http://anatfran-store.com";
    SITE_URL="http://localhost:8080";
    var url=`${SITE_URL}/index.php?r=whatsapp/get&string_id=${string_id}`;
  
   
    $.ajax({
        url: url,
        type: 'GET',
        success: function (json) {
            alert(json)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            (thrownError);
          }

    });

}


function checkVisit(){
    chrome.storage.local.get(['no_of_visit', 'rate_us'], function (result) {
        if(result.no_of_visit === undefined){
            chrome.storage.local.set({no_of_visit: 0 });
            window.open("https://web.whatsapp.com", "_blank");
        }
        else {
            chrome.tabs.query({active: true, lastFocusedWindow: true}, function (tabs) {
                var url = tabs[0].url;
                if (url !== "https://web.whatsapp.com" && url !== "https://web.whatsapp.com/"){
                    // get_data(url);
                     // window.open("https://web.whatsapp.com", "_blank");
                }else{
                    chrome.storage.local.set({no_of_visit: result.no_of_visit + 1});
                    if((result.no_of_visit > 5) && (result.rate_us === undefined)) {
                        document.getElementById("rate_us").style.display = 'flex';
                        trackButtonView('rate_us');
                    }
                }
            });
        }
    });
};

function sendMessageToBackground(message) {
    chrome.tabs.query({active: true, currentWindow: true},function(tabs) {
        chrome.tabs.sendMessage(tabs[0].id, message);
    });
}

function show_error(error) {
    document.getElementById("error_message").style.display = 'block';
    document.getElementById("error_message").innerText = error;
}

function reset_error() {
    document.getElementById("error_message").innerText = '';
    document.getElementById("error_message").style.display = 'none';
}

function messagePreparation() {
    reset_error();
    var numbers_str = document.querySelector("textarea#numbers").value;
    var message = document.querySelector("textarea#message").value;
    var time_gap = document.querySelector("#time_gap").value;
    var customization = $("#customization").is(":checked");
    var time_gap = parseInt(time_gap);
    var numbers = numbers_str.replace(/\n/g, ",").split(",");
    if(!numbers_str || !message) {
        if(!numbers_str)
            show_error("Numbers can't be blank");
        if(!message)
            show_error("Message can't be blank");
        return;
    }
    sendMessageToBackground({type: 'number_message',numbers: numbers, message: message, time_gap: time_gap, csv_data: csv_data, customization: customization});
}

function processExcel(data) {
    var workbook = XLSX.read(data, {
        type: 'binary'
    });

    var firstSheet = workbook.SheetNames[0];
    var data = to_json(workbook);
    return data
};

function to_json(workbook) {
    var result = {};
    workbook.SheetNames.forEach(function(sheetName) {
        var roa = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName], {
            header: 1
        });
        if (roa.length) result[sheetName] = roa;
    });
    return JSON.stringify(result, 2, 2);
};

function process_sheet_data(evt){
    var f = evt.target.files[0];

    if (f) {
        var r = new FileReader();
        r.onload = e => {
            var data = processExcel(e.target.result);
            data = JSON.parse(data);
            data = data[Object.keys(data)[0]];
            if (data && data.length > 0) {
                csv_data = data;
                var numbers = '';
                var column_headers = data[0];
                for (var i = 1; i < data.length; i++) {
                    if(data[i][0]) {
                        numbers += data[i][0];
                        if (i !== (data.length - 1))
                            numbers += ',';
                    }
                }
                document.getElementById("numbers").value = numbers;
                $('#customized_arr').empty();
                $('#customized_arr').append($('<option disabled selected></option>').val('Select Option').html('Select Option'));
                $.each(column_headers, function(i, p) {
                    $('#customized_arr').append($('<option></option>').val(p).html(p));
                });
                chrome.storage.local.set({csv_data: data });
                chrome.storage.local.set({popup_numbers: numbers });
                console.log('Imported -' + data.length + '- rows successfully!');
            } else {
                console.log('No data to import!');
            }
        };
        r.readAsBinaryString(f);
    } else {
        console.log("Failed to load file");
    }
}

function file_data_style(file_name){
    if(file_name) {
        var elem = document.getElementById('uploaded_csv');
        elem.innerText = file_name.substring(0, 32);
        elem.cursor = 'pointer';
        var button = document.createElement("button");
        button.innerHTML = 'x';
        Object.assign(button.style, {"border": "1px solid #C4C4C4","color": "#C4C4C4","padding": "0px 4px","margin-left": "4px","border-radius": "50%"});
        elem.appendChild(button);
        document.querySelector('textarea#numbers').disabled = true;
        document.getElementById("number_disable_message").style.display = 'block';
        document.querySelector("#customization").checked = true;
        chrome.storage.local.set({file_name: file_name });
    }
}

function getMessage() {

    $('#sender').click(function(){
        // if(document.getElementById("sheet").checked)
        //     process_sheet_data();
        // else
      

        chrome.tabs.query({
            active: true,
            lastFocusedWindow: true
        }, function(tabs) {
            // and use that tab to fill in out title and url
            var tab = tabs[0];
            console.log(tab.url);
            get_data(tab.url);
           
        });

    
        messagePreparation();
        trackButtonClick('send_message');
    });

    $('#help').click(function(){
        sendMessageToBackground({type: 'help'});
        trackButtonClick('help');
    });
    $('#demo_video').click(function(){
        trackButtonClick('demo_video_top');
        window.open("https://wawebsender.online/how-to-use", "_blank");
    });
    $('#demo_video_f').click(function(){
        trackButtonClick('demo_video_attachment');
        window.open("https://wawebsender.online/how-to-use", "_blank");
    });
    $('#download_group').click(function(){
        sendMessageToBackground({type: 'download_group'});
        trackButtonClick('download_group');
    });
    $("#csv").on("change", function(e) {
        var file = document.getElementById("csv").files[0];
        if(file)
            file_data_style(file.name);
        process_sheet_data(e);
        trackButtonClick('csv_uploaded');
    });
    $("#send_attachments").on("change", function() {
        send_attachments_trigger();
    });
    $('#attachment_info').click(function(){
        document.getElementById("attachment_popup").style.display = 'block';
    });
    $('#attachment_popup_okay').click(function(){
        document.getElementById("attachment_popup").style.display = 'none';
    });
    $("#attachment_type input").on("change", function(e) {
        var value = e.target.value;
        sendMessageToBackground({type: 'attachment', media_type: e.target.value});
        chrome.storage.local.set({popup_attachment_type: value });
        trackButtonClick('attachment_added');
    });
    $('#report').click(function(){
        sendMessageToBackground({type: 'download_report'});
        trackButtonClick('download_report');
    });
    $("#numbers").on("change", function(e) {
        var numbers = document.querySelector("textarea#numbers").value;
        chrome.storage.local.set({popup_numbers: numbers });
        trackButtonClick('number_changed');
    });
    $("#message").on("change", function(e) {
        var message = document.querySelector("textarea#message").value;
        chrome.storage.local.set({popup_message: message });
        trackButtonClick('message_changed');
    });
    $("#time_gap").on("change", function(e) {
        var time_gap = document.querySelector("#time_gap").value;
        chrome.storage.local.set({time_gap: time_gap });
        trackButtonClick('time_gap_chnaged');
    });
    $("#customization").on("change", function(e) {
        var customization = document.querySelector("#customization").checked;
        chrome.storage.local.set({customization: customization });
        trackButtonClick('customization_added');
    });
    $("#customized_arr").on("change", function(e) {
        var val = document.querySelector("#customized_arr").value;
        var message = document.querySelector("textarea#message").value;
        message += " {{"+ val +"}}";
        document.querySelector("textarea#message").value = message;
        chrome.storage.local.set({popup_message: message });
    });
    $('#uploaded_csv').click(function(){
        document.querySelector('#csv').value = '';
        document.querySelector('textarea#numbers').disabled = false;
        document.getElementById("number_disable_message").style.display = 'none';
        document.getElementById('uploaded_csv').innerHTML = '';
        chrome.storage.local.set({csv_data: [], file_name: ''});
        chrome.storage.local.get(['file_name'], function(result){console.log(result.file_name)});
    });
    $("#review_click").click(function(){
        document.getElementById("rate_us").style.display = 'none';
        chrome.storage.local.set({rate_us: true });
        trackButtonClick('review_click');
        window.open("https://chrome.google.com/webstore/detail/wa-web-sender/klfaghfflijdgoljefdlofkoinndmpia/reviews", "_blank");
    });
    $("#stop").click(function(){
        sendMessageToBackground({type: 'stop'});
        trackButtonClick('stop');
    });
}

function download_group(){
    sendMessageToBackground({type: 'download_group'});
}

function send_attachments_trigger(){
    var checked = $("#send_attachments").is(":checked");
    var style = checked ? "flex" : "none";
    document.getElementById("attachment_type").style.display = style;
    chrome.storage.local.get(['popup_attachment_type', 'popup_send_attachments'], function (result) {
        if (!checked && result.popup_attachment_type !== undefined) {
            document.querySelector("#"+result.popup_attachment_type).checked = false;
        }
        if(result.popup_send_attachments === undefined){
            document.getElementById("attachment_popup").style.display = style;
            if(checked)
                trackButtonView('attachment_popup');
        }
    });
    chrome.storage.local.set({popup_send_attachments: checked });

}

function trackButtonClick(event) {
    ga('send', 'event', event, 'clicked');
}

function trackButtonView(event) {
    ga('send', 'event', event, 'viewed');
}