function showAllComment(postId) {
    $.ajax({
        url:"allcomment.php",
        method:"POST",
        data:{postId:postId},
        success:function(data) {
            $('#userComment').html(data);
        }
    });
};

$(document).ready(function () {
    var pId=$('#post_id').val();
    //showAllComment(pId);
    $('#commentSubmit').click(function () {
        var userId=$('#user_id').val();
        var postId=$('#post_id').val();
        var comment=$('#comment').val();
        if(userId==""){
            alert("You have to login");
            //return false;
        }else {
            $.ajax({
                url:"comment.php",
                method:"POST",
                data:{userId:userId,postId:postId,comment:comment},
                success:function (data) {
                    //showAllComment(postId);
                }
            });
        }
    });

    setInterval(function () {
        showAllComment(pId);
    },1000);
});