<!DOCTYPE html>
<html>
<head>
    <title>New Comment on Your Post</title>
</head>
<body>
<h1>Hello {{ $user->name }},</h1>
<p>A new comment has been added to your post titled "<strong>{{ $post->title }}</strong>".</p>

<p><strong>Comment:</strong> {{ $comment->content }}</p>

<p>Thank you for being a part of our community!</p>
</body>
</html>
