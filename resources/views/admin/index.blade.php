<!doctype html>
<html lang="us">
    <head>
    <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Admin</title>
    </head>
    <body>
        <div class="row">
            &nbsp;&nbsp;&nbsp;__DEMO_CLIENT__
            <br>
            <br>
           
                <div class="row">

                    <div class="col-md-1"></div>

                    <div class="col-md-6">
                        <label class="form-label">File (TXT)</label>
                        <input type="file" class="form-control" name="file" id="file">
                    </div>

                    <div class="col-md-5"> </div>

                    <div class="col-md-1"></div>
                    
                    <div class="col-11 p-3">
                    
                        <button type="button" class="btn btn-primary" onClick="btnSend()">Send</button>

                    </div>

                    <div class="col-6 text-center">
                    
                        RESULTS

                    </div>

                    <div class="col-6 text-center"></div>

                    <div class="col-3 text-center">
                    
                        File

                    </div>

                    <div class="col-3 text-center">
                    
                        Credits

                    </div>

                    <div class="col-6 text-center"></div>

                    <div class="col-3 text-center">
                    
                        <a href="#" id="linkFile"></a>

                    </div>

                    <div class="col-3 text-center" id="countCredits">
                    
                        
                    </div>


                </div>

        </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    </body>

    <script>

        const btnSend = () => {

            if ($('#file').get(0).files.length === 0) {
                
                alert("No files selected.");

                return true;

            }
            
            var form = new FormData();

            form.append("file", $('#file')[0].files[0], "emails_to_process.txt");

            var settings = {
                "url": "http://127.0.0.1:8000/api/processDataFile",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Accept": "application/json",
                    "Authorization": "Bearer 16|H0RDlUbw20daXreZcbzXKmhjInf6amy09DF9fMEw"
                },
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "dataType": "json",
                "data": form
            };

            $.ajax(settings).done(function (response) {

                console.log( response.response.results.download );

                if( response.response.results == "No credits" ){

                    $('#countCredits').html('No credits');

                    return true;

                }

                $("#linkFile").removeAttr("href");

                $("#linkFile").attr("href", response.response.results.download);

                $("#linkFile").text("download");

                $('#countCredits').html(response.response.results.credits);

                $('#file').val('');
                
            });

        }

    </script>


</html>