/**
 * Created by anflorea on 17/04/16.
 */
f = {};

f.refresh_like_a_coke = function() {
    window.location = window.location;
}

f.heart_beat = function() {
    setTimeout(function () {
        f.refresh_like_a_coke();
        f.heart_beat();
    }, 1000);
}

$(document).ready(function () {
    f.heart_beat();
})