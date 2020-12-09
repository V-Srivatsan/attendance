function checkInp() {
    var option = $("#subjects").val();
    var roll = $("#details").find('input[name="roll"]').val();
    var pass = $("#details").find('input[name="pass"]').val();
    if (option != -1 && pass != "" && roll > 0 && roll < 42) {
        $("#btn").show();
    }
    else {
        $("#btn").hide();
    }
}

function validate() {
    var option = $("#subjects").val();
    var roll = $("#details").find('input[name="roll"]').val();
    var pass = $("#details").find('input[name="pass"]').val();
    var subjects = ['English', 'Maths', 'Science', 'Social'];
    var subj = subjects[option];
    $("#loading").show();
    $.post('login_server.php', {'pass': pass, 'subj': subj, 'roll': roll},
    function (response) {
        $("#result").empty().append(response);
        $("#loading").hide();
    });
}

function checkAdmin() {
    $(document).ready(function() {
        $("#admin_form").submit(function () {
            var pass = $("#admin_form").find('input[name="pass"]').val();
            $("#loading").show();
            $.post('admin_server.php', {'pass': pass},
            function (response) {
                $("#loading").hide();
                $("#output").empty().append(response);
            });
            return false;
        });
    });
}

function changePass() {
    $("#load_pwd").show();
    $.post('admin_server.php', {'change_pass': 'true'}, function (response) {
        $("#load_pwd").hide();
        $("#output").append(response);
    });
}

function delIP() {
    $("#load_pwd").show();
    $.post('admin_server.php', {'del_IP': 'true'}, function (response) {
        $("#load_pwd").hide();
        $("#output").append(response);
    });
}

function reset() {
    $("#load_pwd").show();
    $.post('admin_server.php', {'reset': 'true'}, function (response) {
        $("#load_pwd").hide();
        $("#output").append(response);
    });
}
