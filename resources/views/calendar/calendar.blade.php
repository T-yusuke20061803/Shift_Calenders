<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FullCalendar</title>
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- vite用の記述忘れずに -->
         <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    </head>
    <body>
        <button id='button1' aria-pressed="true" onclick="toggleCalendar()">用途切り替え</button>
        <!-- 以下のdivタグ内にカレンダーを表示 通寿とシフト用カレンダー用のdiv -->
        <div id='calendar-regular'></div>
        <div id='calendar-shift' style='display: none;'></div>
        
        <!-- カレンダー新規追加モーダル --><!-- modaｌをmodelに変更した-->
         <div id="modal-add" class="modal">
            <div class="modal-contents">
                <form method="POST" action="{{ route('create') }}">
                    @csrf
                    <input id="new-id" type="hidden" name="id" value="" />
                    <label for="new-event_title">タイトル</label>
                    <input id="new-event_title" class="input-title" type="text" name="event_title" value="" />
                    <label for="new-start_date">開始日時</label>
                    <input id="new-start_date" class="input-date" type="date" name="start_date" value="" />
                    <label for="new-end_date">終了日時</label>
                    <input id="new-end_date" class="input-date" type="date" name="end_date" value="" />
                    <label for="new-event_body" style="display: block">内容</label>
                    <textarea id="new-event_body" name="event_body" rows="3" value=""></textarea>
                    <label for="new-event_color">背景色</label>
                    <select id="new-event_color" name="event_color">
                        <option value="blue" selected>青</option>
                        <option value="green">緑</option>
                        <option value="red">赤</option>
                        <option value="yellow">黄</option>
                        <option value="pink">ピンク</option>
                        <option value="purple">紫</option>
                        <option value="orange">オレンジ</option>
                    </select>
                    <button type="button" onclick="closeAddModel()">キャンセル</button>
                    <button type="submit">決定</button>
                </form>
            </div>
        </div>
        <!--カレンダー編集モーダル-->
        <div id="modal-update" class="modal">
            <div class="modal-contents">
                <form method="post" action="{{ route('update') }}">
                    @csrf
                    @method('PUT')
                    <input id="id" type="hidden" name="id" value="" />
                    <label for="event_title">タイトル</label>
                    <input id="event_title" class="input-title" type="text" name="event_title" value="" />
                    <label for="start_date">開始日時</label>
                    <input id="start_date" class="input-date" type="date" name="start_date" value="" />
                    <label for="end_date">終了日時</label>
                    <input id="end_date" class="input-date" type="date" name="end_date" value="" />
                    <label for="event_body" style="display: block">内容</label>
                    <textarea id="event_body" name="event_body" rows="3" value=""></textarea>
                    <label for="event_color">背景色</label>
                    <select id="event_color" name="event_color">
                        <option value="blue" selected>青</option>
                        <option value="green">緑</option>
                        <option value="red">赤</option>
                        <option value="yellow">黄</option>
                        <option value="pink">ピンク</option>
                        <option value="purple">紫</option>
                        <option value="orange">オレンジ</option>
                    </select>
                    <button type="button" onclick="closeUpdateModel()">キャンセル</button>
                    <button type="submit">決定</button>
                </form>
                <form id = "delete-form" method ="POST" action="{{ route('delete') }}">
                    @csrf
                    @method('DELETE')
                    <input type = "hidden" id ="delete-id" name="id" value=""/>
                    <button class='delete' type="button" onclick="deleteEvent()">削除</button>
                </form>
            </div>
        </div>
    </body>
</html>

<style scoped>

.modal{
    display: none;
    justify-content: center;
    position: absolute;
    z-index: 10; /* カレンダーの曜日表示がz-index=2のため、それ以上にする必要あり */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    height: 100%;
    width: 100%;
    background-color: rgba(0,0,0,0.5);
}
.modal-contents{
    background-color: white;
    height: 400px;
    width: 600px;
    padding: 20px;
}
input{
    padding: 2px;
    border: 1pxx solid black;
    border-radius: 5px;
}
.input-title{
    display: block;
    width: 80%;
    margin: 0 0 20px;
}
.input-date{
    width: 27%;
    margin: 0 5px 20px 0;
}
textarea{
    display: block;
    width: 80%;
    margin: 0 0 20px;
    padding: 2px;
    border: 1px solid black;
    border-radius: 5px;
    resize: none;
}
select{
    display: block;
    width: 20%;
    margin: 0 0 20px;
    padding: 2px;
    border: 1px solid black;
    border-radius: 5px;
}
.fc-event-title-container{
    cursor: pointer;
}
</style>