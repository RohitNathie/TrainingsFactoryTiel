<style>
    body{
        background: wheat;
    }
    /* Style for mood item */
    .mood-item {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
    }

    /* Style for mood name and date */
    .mood-name {
        font-size: 18px;
        font-weight: bold;
        margin: 0;
    }

    .mood-date {
        font-size: 14px;
        color: #666;
        margin: 0;
    }

    /* Style for mood content */
    .mood-content {
        margin-top: 10px;
        font-size: 16px;
    }

    /* Style for view link */
    .view-link {
        display: block;
        margin-top: 10px;
        text-align: right;
    }

    .view-link a {
        color: #009688;
    }

    .view-link a:hover {
        text-decoration: underline;
    }

    /* Style for no mood message */
    .no-mood {
        font-size: 18px;
        color: #666;
        margin-top: 20px;
        text-align: center;
    }

    .no-mood-message {
        font-size: 16px;
        color: #999;
        margin-top: 10px;
        text-align: center;
    }
</style>
<!DOCTYPE html>
<html>
<body>
<link href="<?= base_url(); ?>/public/assets/css/style.css" rel="stylesheet" type="text/css">
<script src="<?= base_url(); ?>js/script.js" type="text/javascript"></script>
<img src="<?= base_url('uploads/myimage.jpg') ?>" alt="My Image">
<img src="<?= base_url('uploads/myimage.jpg') ?>" alt="My Image">



</body>
</html>

