$(document).ready(function() {
    $('.btn.btn-danger').click(function() {
        if (confirm('Are you sure?')) {
            var id = $(this).attr("id");
            var url = "/article/delete/" + id;
            $(location).attr('href', url);
        } else {
            alert('Why did you press cancel? You should have confirmed');
        }


    })
})