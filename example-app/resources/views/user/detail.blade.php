<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }


    </style>

</head>

<body>

<div class="container mt-5">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->created_at->format('d M Y') }}</p>
    <p>{{ $post->updated_at }}</p>
    <p>{{ $post->content }}</p>

    @php
        $images = json_decode($post->image, true);
    @endphp

    @if(is_array($images) && count($images) > 0)
        <div class="row">
            @foreach($images as $image)
                <div class="col-md-4">
                    <img src="{{ asset('uploads/post/' . $image) }}" alt="Image" class="img-fluid mb-3">
                </div>
            @endforeach
        </div>
    @endif


    <h3>Comments</h3>
    @foreach($post->comments as $comment)
        <div class="card mb-2">
            <div class="card-body">
                <p>{{ $comment->cmt }}</p>
                <small>By {{ $comment->user->name }} on {{ $comment->created_at->format('d M Y H:i') }}</small>
                <p>Rating: {{ $comment->star }}</p>
                @if(Auth::check() && Auth::id() == $comment->user_id)
                    <button class="btn btn-warning"
                            onclick="openEditCommentPopup({{ $comment->id }}, '{{ $comment->cmt }}', {{ $comment->star }})">
                        Edit
                    </button>
                    <button class="btn btn-danger" onclick="openDeleteCommentPopup({{ $comment->id }})">Delete</button>

                @endif
            </div>
        </div>
    @endforeach

    <div id="deleteCommentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeDeleteCommentPopup()">&times;</span>
            <p>Bạn có chắc chắn muốn xóa bình luận này không?</p>
            <form id="deleteCommentForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Xóa</button>
                <button type="button" class="btn btn-secondary" onclick="closeDeleteCommentPopup()">Hủy</button>
            </form>
        </div>
    </div>

    <div id="editCommentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditCommentPopup()">&times;</span>
            <form id="editCommentForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="edit_star">Rating:</label>
                    <input type="number" name="star" id="edit_star" class="form-control" min="1" max="5" required>
                </div>
                <div class="form-group">
                    <textarea name="cmt" id="edit_cmt" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Comment</button>
            </form>
        </div>
    </div>

    <script>
        function openDeleteCommentPopup(commentId) {
            var modal = document.getElementById('deleteCommentModal');
            var form = document.getElementById('deleteCommentForm');

            form.action = '/comments/' + commentId;

            modal.style.display = 'block';
        }

        function closeDeleteCommentPopup() {
            var modal = document.getElementById('deleteCommentModal');
            modal.style.display = 'none';
        }

        window.onclick = function (event) {
            var modal = document.getElementById('deleteCommentModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>


    <script>
        function openEditCommentPopup(commentId, commentText, starRating) {
            var modal = document.getElementById('editCommentModal');
            var form = document.getElementById('editCommentForm');

            document.getElementById('edit_cmt').value = commentText;
            document.getElementById('edit_star').value = starRating;
            form.action = '/comments/' + commentId;

            modal.style.display = 'block';
        }

        function closeEditCommentPopup() {
            var modal = document.getElementById('editCommentModal');
            modal.style.display = 'none';
        }

        window.onclick = function (event) {
            var modal = document.getElementById('editCommentModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>


    @auth
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="star">Rating:</label>
                <div class="rating">
                    <input type="radio" name="star" id="star5" value="5" required>
                    <label for="star5" class="fas fa-star"></label>

                    <input type="radio" name="star" id="star4" value="4">
                    <label for="star4" class="fas fa-star"></label>

                    <input type="radio" name="star" id="star3" value="3">
                    <label for="star3" class="fas fa-star"></label>

                    <input type="radio" name="star" id="star2" value="2">
                    <label for="star2" class="fas fa-star"></label>

                    <input type="radio" name="star" id="star1" value="1">
                    <label for="star1" class="fas fa-star"></label>
                </div>
            </div>
            <div class="form-group">
                <textarea name="cmt" class="form-control" rows="3" placeholder="Add a comment" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
    @endauth

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.rating input');
            stars.forEach(star => {
                star.addEventListener('change', function() {
                    const checkedStar = this;
                    stars.forEach(s => {
                        if (s.value >= checkedStar.value) {
                            s.nextElementSibling.style.color = '#ffca08';
                        } else {
                            s.nextElementSibling.style.color = '#ccc';
                        }
                    });
                });
            });
        });
    </script>

</div>
</body>
</html>
