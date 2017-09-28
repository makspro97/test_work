function show1(){
        $.ajax({
            type: "POST",
            url: "show.php",
            data: "id_m="+$("#idCom").val(),
            success: function(html){
                $("#v_content").html(html);
            }
        });
        return false;
    }
$(document).ready(function(){
    $('#idCom').change(show1);
});

$(document).on('click','#edit_c', function(){
    $('.edit').toggle();
});
 
$(document).on('click', '#save_c', function(){
        $.ajax({
            type: "POST",
            url: "save.php",
            data: {"edit_name" : $("#edit_name").val(),
                "edit_est" : $("#edit_est").val(),
                "edit_comp" : $("#edit_comp").val(),
                "edit_id" : $("#idCom").val()},
            success: function(){
                alert ("Information saved!");
                $(document).ready(function(){
                    $('#idCom').ready(function(){
                        show1();
                    });
                });
            }
        });
        window.parent.location.href='index.php';
        return false;
});

$(document).on('click', '#new_save', function(){
        $.ajax({
            type: "POST",
            url: "new.php",
            data: {"new_name" : $("#new_name").val(),
                "new_est" : $("#new_est").val(),
                "new_comp" : $("#new_comp").val()},
            success: function(){
                alert ("Information saved!");
                location.reload();

            }
        });
        //return false;
});

$(document).on('click', '#delete_b', function(){
        $.ajax({
            type: "POST",
            url: "remove.php",
            data: "id_rem="+$("#remove_comp").val(),
            success: function(){
                alert ("Information delete!");
                location.reload();

            }
        });
        //return false;
});

