/**
 * Created by anflorea on 17/04/16.
 */
f = {};

f.send_it = function () {
    var message = $('#the-message').val();
    $.ajax({
        type: "POST",
        url: "sql/speak.php",
        data: {
            "message": message
        }
    }).then(function (response) {
        $('#the-message').val("");
        f.update_chat();
    })
}

f.send_message = function () {
    $('#send-message').click(function () {
        f.send_it();
    })
}

f.press_enter = function() {
    $('#the-message').keypress(function (keycode) {
        if (keycode.which == 13) {
            f.send_it();
        }
    })
}

f.update_loby = function () {
    $.ajax({
        type: "GET",
        url: "sql/get_games.php"
    }).then(function (response) {
        if (response)
            $('#game-lobby').html("");
        var arr = jQuery.parseJSON(response);
        // console.log(response);
        var str = $('#game-lobby');
        for (var i = 0; i < arr.length; i++) {
            var p1 = arr[i]['p1'];
            var id = arr[i]['id'];
            var div = $('<div class="one-game">' + p1 + '</div><br />');
            div.click(function () {
                $.ajax({
                    url: "sql/join.php",
                    method: "POST",
                    data: {
                        "id": id
                    }
                }).then (function (response) {

                })
            })
            str.prepend(div);
        }
    })
}

f.update_chat = function () {
    $.ajax({
        type: "GET",
        url: "sql/chat.php"
    }).then(function (response) {
        var arr = jQuery.parseJSON(response);
        // console.log(response);
        var str = "";
        for (var i = arr.length - 1; i >= 0; i--) {
            var nick = arr[i]['nick'];
            var message = arr[i]['message'];
            var time = arr[i]['timestamp'];
            str += nick + ": " + message + "<br />";
        }
        $('#the-chat').html(str);
        var height = $('#the-chat')[0].scrollHeight;
        $('#the-chat').scrollTop(height);
    })
}

f.search_for_game = function() {
    $.ajax({
        url: "sql/game_exists.php",
        type: "GET"
    }).then(function (response) {
        if (response == true)
            window.location = "game/index.php";
    })
}

f.heart_beat = function () {
    setTimeout(function () {
        f.update_chat();
        f.update_loby();
        f.search_for_game();
        f.heart_beat();
    }, 1000);
}

f.create_new_game = function () {
    $('#create_game').click(function () {
        $.ajax({
            type: "POST",
            url: "sql/newgame.php"
        }).then(function (response) {
            f.update_loby();
        })
    })
}

$(document).ready(function () {
    f.send_message();
    f.heart_beat();
    f.update_chat();
    f.update_loby();
    f.press_enter();
    f.create_new_game();
})