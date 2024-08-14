import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import axios from 'axios';

// 日付を-1してYYYY-MM-DDの書式で返すメソッド
function formatDate(date, pos) {
    const dt = new Date(date);
    if(pos==="end"){
        dt.setDate(dt.getDate() - 1);
    }
    return dt.getFullYear() + '-' +('0' + (dt.getMonth()+1)).slice(-2)+ '-' +  ('0' + dt.getDate()).slice(-2);
}

const calendarElRegular = document.getElementById("calendar-regular");
const calendarElShift = document.getElementById("calendar-shift");

//let click = 0;
//let oneClickTimer;

// カレンダーの設定
const calendarRegular = new Calendar(calendarElRegular, {
    plugins: [dayGridPlugin, interactionPlugin],
    initialView: "dayGridMonth", 
    customButtons:{//カスタムボタン
        eventAddButton:{//新しい予約追加ボタン
            text: '予定追加',
            click: function() {
                //初期化（前の入力をクリアする）
                document.getElementById("new-id").value = "";
                document.getElementById("new-event_title").value ="";
                document.getElementById("new-start_date").value ="";
                document.getElementById("new-end_date").value ="";
                document.getElementById("new-event_body").value ="";
                document.getElementById("new-event_color").value ="blue";
                // 新規予定追加モーダルを開く
                document.getElementById('modal-add').style.display ='flex';
            }
        }
    },
    headerToolbar: {
        start: "prev,next today",
        center: "title",
        end: "eventAddButton dayGridMonth,timeGridWeek",
    },
    height: "auto",
    selectable: true, // 日程の選択を可能にする
    select: function (info) { // 日程を選択した後に行う処理を記述
        // 選択した日程を反映（のこりは初期化
        
        document.getElementById("new-id").value = "";
        document.getElementById("new-event_title").value = "";
        document.getElementById("new-start_date").value = formatDate(info.start); // 選択した開始日を反映
        document.getElementById("new-end_date").value = formatDate(info.end, "end"); // 選択した終了日を反映
        document.getElementById("new-event_body").value = "";
        document.getElementById("new-event_color").value = "blue";

        // 新規予定追加モーダルを開く
        document.getElementById('modal-add').style.display = 'flex';
        
        document.getElementById("new-id").value = "";
        document.getElementById("new-event_title").value = "";
        document.getElementById("new-start_date").value = formatDate(info.start); // 選択した開始日を反映
        document.getElementById("new-end_date").value = formatDate(info.end, "end"); // 選択した終了日を反映
        document.getElementById("new-event_body").value = "";
        document.getElementById("new-event_color").value = "blue";

        // 新規予定追加モーダルを開く
        document.getElementById('modal-shift').style.display = 'flex';
    },
    events: function(info, successCallback, failureCallback){// eventsはページが切り替わるたびに実行される
        // axiosでLaravelの予定取得処理を呼び出す
        axios
            .post('/calendar/get', {  
                // 現在カレンダーが表示している日付の期間(1月ならば、start_date=1月1日、end_date=1月31日となる)
                    start_date: info.start.valueOf(),
                    end_date: info.end.valueOf(),
            })
            .then((response) => {
                    // イベント重複防止
                    calendarRegular.removeAllEvents();// 未確定要素（ドキュメントにはない？）
                    successCallback(response.data); // successCallbackに予定をオブジェクト型で入れるとカレンダーに表示できる
            })
            .catch((error) => {
                // バリデーションエラーなど
                    console.error("Error fetchubg events",error);
                    alert("登録失敗"+ error.response.data.message || error.message);
            });
        },
        // 予定をクリックすると予定編集モーダルが表示される
    eventClick: function(info) {
        // console.log(info.event); // info.event内に予定の全情報が入っているので、必要に応じて参照すること
        document.getElementById("id").value = info.event.id;
        document.getElementById("delete-id").value = info.event.id;
        document.getElementById("event_title").value = info.event.title;
        document.getElementById("start_date").value = formatDate(info.event.start);
        document.getElementById("end_date").value = formatDate(info.event.end, "end");
        document.getElementById("event_body").value = info.event.extendedProps.description;
        document.getElementById("event_color").value = info.event.backgroundColor;

        // 予定編集モーダルを開く
        document.getElementById('modal-update').style.display = 'flex';
    },
});

const calendarShift = new Calendar(calendarElShift, {
    plugins: [dayGridPlugin, interactionPlugin],
    initialView: "dayGridMonth", 
    customButtons:{//カスタムボタン
        eventAddButton:{//新しい予約追加ボタン
            text: '予定(シフト)追加',
            click: function() {
                //初期化（前の入力をクリアする）
                document.getElementById("new-id").value = "";
                document.getElementById("new-event_title").value ="";
                document.getElementById("new-start_date").value ="";
                document.getElementById("new-end_date").value ="";
                document.getElementById("new-event_body").value ="";
                document.getElementById("new-event_color").value ="blue";
                // 新規予定追加モーダルを開く
                document.getElementById('modal-add').style.display ='flex';
            }
        }
    },
    headerToolbar: {
        start: "prev,next today",
        center: "title",
        end: "eventAddButton dayGridMonth,timeGridWeek",
    },
    height: "auto",
    selectable: true, // 日程の選択を可能にする
    select: function (info) { // 日程を選択した後に行う処理を記述
        // 選択した日程を反映（のこりは初期化
        
        document.getElementById("new-id").value = "";
        document.getElementById("new-event_title").value = "";
        document.getElementById("new-start_date").value = formatDate(info.start); // 選択した開始日を反映
        document.getElementById("new-end_date").value = formatDate(info.end, "end"); // 選択した終了日を反映
        document.getElementById("new-event_body").value = "";
        document.getElementById("new-event_color").value = "blue";

        // 新規予定追加モーダルを開く
        document.getElementById('modal-add').style.display = 'flex';
        
        document.getElementById("new-id").value = "";
        document.getElementById("new-event_title").value = "";
        document.getElementById("new-start_date").value = formatDate(info.start); // 選択した開始日を反映
        document.getElementById("new-end_date").value = formatDate(info.end, "end"); // 選択した終了日を反映
        document.getElementById("new-event_body").value = "";
        document.getElementById("new-event_color").value = "blue";

        // 新規予定追加モーダルを開く
        document.getElementById('modal-shift').style.display = 'flex';
    },
    events: function(info, successCallback, failureCallback){// eventsはページが切り替わるたびに実行される
        // axiosでLaravelの予定取得処理を呼び出す
        axios
            .post('/calendar/madeShift', {  
                // 現在カレンダーが表示している日付の期間(1月ならば、start_date=1月1日、end_date=1月31日となる)
                    start_date: info.start.valueOf(),
                    end_date: info.end.valueOf(),
            })
            .then((response) => {
                    // イベント重複防止
                    calendarRegular.removeAllEvents();// 未確定要素（ドキュメントにはない？）
                    successCallback(response.data); // successCallbackに予定をオブジェクト型で入れるとカレンダーに表示できる
            })
            .catch((error) => {
                // バリデーションエラーなど
                    console.error("Error fetchubg events",error);
                    alert("登録失敗"+ error.response.data.message || error.message);
            });
        },
        // 予定をクリックすると予定編集モーダルが表示される
    eventClick: function(info) {
        // console.log(info.event); // info.event内に予定の全情報が入っているので、必要に応じて参照すること
        document.getElementById("id").value = info.event.id;
        document.getElementById("delete-id").value = info.event.id;
        document.getElementById("event_title").value = info.event.title;
        document.getElementById("start_date").value = formatDate(info.event.start);
        document.getElementById("end_date").value = formatDate(info.event.end, "end");
        document.getElementById("event_body").value = info.event.extendedProps.description;
        document.getElementById("event_color").value = info.event.backgroundColor;

        // 予定編集モーダルを開く
        document.getElementById('modal-update').style.display = 'flex';
    },
});


calendarRegular.render();

//新規予定追加のモーダルを閉鎖
window.toggleCalenfar = function(){
    
    var button = document.getElementById('botton1');
    if(calendarElRegular.style.display === 'none'){
        calendarElRegular.style.display = 'block';
        calendarElRegular.style.display = 'none';
        calendarRegular.render();
        button.innerText = 'シフト用カレンダーへ切り替え';
        button.setAttribute('aria-pressed', 'true');
    }else{
        calendarElRegular.style.display = 'none';
        calendarElShift.style.display = 'block';
        button.innerText = '通常用カレンダーへ切り替え';
        button.setAttribute('aria-pressed', 'false');
    }
};

//新規予定追加のモーダルを閉鎖
window.closeAddModel = function(){
    document.getElementById('modal-add').style.display='none';
}
// 予定編集モーダルを閉じる
window.closeUpdateModel = function(){
    document.getElementById('modal-update').style.display='none';
}
window.deleteEvent = function(){
    'use strict';
    
    if (confirm('削除したら復元できません。\n本当に削除しますか？')) {
        document.getElementById('delete-form').submit();
    }
}