$(":file").filestyle();
function changeProfilePicture()
{
    var selectedImg = $('#profilePicture')[0].files[0];

    if (selectedImg)
    {
        var previewId = document.getElementById('profileImage');
        previewId.src = '';

        var oReader = new FileReader();
        oReader.onload = function(e)
        {
            previewId.src=e.target.result;
        }
        oReader.readAsDataURL(selectedImg);

        $('#uploadButton').removeClass('disabled');
    }
}

function uploadProfilePicture()
{
    var file2 = document.getElementById("profilePicture").files[0];
    if(file2){
        var ext = file2.type;
    }
    var about = $('#aboutMe').val();
    var email = $('#email').val();
    var birth = $('#birth').val();
    var name = $('#name').val();
    var surname = $('#surname').val();
    var formdata = new FormData();
    formdata.append("pic", file2);
    formdata.append("ext", ext);
    formdata.append("about", about);  // {'pic': file2, 'ext': ext, 'about':about}
    formdata.append("email", email);
    formdata.append("birth", birth);
    formdata.append("name", name);
    formdata.append("surname", surname);
    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.open("POST", "http://tourismmap.net/updateProfile");
    ajax.send(formdata);
}

function completeHandler(event)
{
    var response = this.responseText;
    window.location='http://tourismmap.net/profile';
}
function progressHandler(event)
{
    var percent = (event.loaded / event.total) * 100;
    $('#mediaProgress').fadeIn();
    document.getElementById('progressBar').style.width = percent+'%';
}