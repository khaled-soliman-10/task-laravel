<!DOCTYPE html>
<html>
<head>
    <title>New Comment on Your Post</title>
</head>
<body>
<h1>Hello <?php echo e($user->name); ?>,</h1>
<p>A new comment has been added to your post titled "<strong><?php echo e($post->title); ?></strong>".</p>

<p><strong>Comment:</strong> <?php echo e($comment->content); ?></p>

<p>Thank you for being a part of our community!</p>
</body>
</html>
<?php /**PATH E:\xamp\htdocs\Api\resources\views/emails/comment_added.blade.php ENDPATH**/ ?>