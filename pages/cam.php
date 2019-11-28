<?php

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Camagru Camera</title>
<style type="text/css">
        #container
        {
            margin: 0px auto;
            width: 500px;
            height: 375px;
            border: 5px #333 solid;
        }
        #videoElement
        {
            width: 500px;
            height: 375px;
            background-color: #666;
        }
        #canvas
        {
            width: 500px;
            height: 375px;
        }
</style>
</head>
<body>
    <div id="container">
        <video autoplay="true" id="videoElement"></video><br />
    </div><br />
        <button id="capture">Say Cheese</button><br />
        <canvas id="canvas"></canvas><br />
    <script>
        const videoElement = document.getElementById('videoElement');
        const canvas = document.getElementById('canvas');
        const context = canvas.getContext('2d');
        const Capturebutton = document.getElementById('capture');
        const constraints = {video: true, audio: false};

        Capturebutton.addEventListener('click', () =>
        {
            context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
        });
        navigator.mediaDevices.getUserMedia(constraints).then((stream) => 
        {
            videoElement.srcObject = stream;
        });
    </script>
</body>
</html>