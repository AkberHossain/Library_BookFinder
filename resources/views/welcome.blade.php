<html>
    <head>
        <title>Library</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    </head>
    <body>
        <div class="container text-center">
            <h1>Library information</h1>
            <br><br>
            <hr>
            <br>
            <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="Add New Author">Add New Author</button>
            <br><br>
            <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" data-whatever="Add new Book">Add New Book</button>

        </div>

        <br>

        <hr>


        <br>

        <div class="container">

            <!-- Author Drop Down Box -->

            <select class="form-control _author" id="_author">
                
            </select>

            <!-- Author Drop Down Box -->

            <div id="book-list" >

            </div>

        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-author">
                    {{ csrf_field()}}
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Author Name:</label>
                            <input type="text" name="name" class="form-control" id="recipient-name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="add-author" class="btn btn-primary" data-dismiss="modal">Add</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-book">
                        {{ csrf_field()}}
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Book Name:</label>
                            <input type="text" name="name" class="form-control" id="recipient-name">
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Author Name:</label>
                            <select name="author_id" class="form-control _author">
                            
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="add-book" class="btn btn-primary" data-dismiss="modal">Add</button>
                </div>
                </div>
            </div>
        </div>


        <script>

            $(document).ready(function(){

                updateAuthorList();

                $("#_author").change(function(){
                    
                    $.ajax({
                        url: "get-all-book",
                        type:"GET" ,
                        data:{'author_id' : $(this).children("option:selected").val() }  ,
                        success:function(books){

                            $("#book-list h3").remove();
                            
                            if(books.length > 0)
                            {
                                for(var i=0;i<books.length;i++)
                                {
                                    $("#book-list").append("<p><h3>"+books[i].name+"</h3></p>");
                                }
                            }
                            else
                            {
                                $("#book-list").append("<p><h3>No books For this Author</h3></p>");
                            }
                            
                        }
                    });

                });
                

                $('#exampleModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget)
                    var recipient = button.data('whatever')
                    var modal = $(this)
                    modal.find('.modal-title').text( recipient)
                });

                $('#exampleModal2').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget)
                    var recipient = button.data('whatever')
                    var modal = $(this)
                    modal.find('.modal-title').text( recipient)
                });


                $("#add-author").click(function(){

                    $.ajax({

                        url: '/create-author',
                        type: 'POST',
                        data: $("#form-author").serialize() ,
                        success: function(){
                            updateAuthorList();
                        }
                    });

                });

                $("#add-book").click(function(){

                    $.ajax({

                        url: '/create-book',
                        type: 'POST',
                        data: $("#form-book").serialize(),
                        success: function(){
                            updateAuthorList();
                        }
                    });

                });

                function updateAuthorList(){

                    $.ajax({

                        url: '/get-all-author',
                        type: 'get',
                        success: function(authors){    

                            $("._author option").remove();

                            for(var i=0;i<authors.length;i++)
                            {
                                $("._author").append("<option value='"+authors[i].id+"'>"+authors[i].name+"</option>");
                            }
                            
                            $("#_author").trigger("change");
                        }
                    });    
                }


            });

        </script>

    </body>
</html>