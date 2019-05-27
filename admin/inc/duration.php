<script type="text/javascript"  src="<?php echo ADMIN_ASSETS_URL ?>DateJS/date.js"></script>
        <script>
          var myVideos = [];

          window.URL = window.URL || window.webkitURL;

          document.getElementById('fileUp').onchange = setFileInfo;

          function setFileInfo() {
            var files = this.files;
            myVideos.push(files[0]);
            var video = document.createElement('video');
            video.preload = 'metadata';

            video.onloadedmetadata = function() {
              window.URL.revokeObjectURL(video.src);
              var duration = video.duration;
              var duration = (new Date).clearTime()
                                .addSeconds(duration)
                                .toString('H:mm:ss');

              myVideos[myVideos.length - 1].duration = duration;
              updateInfos();
            }

            video.src = URL.createObjectURL(files[0]);;
          }


          function updateInfos() {
            var infos = document.getElementById('infos');
            infos.textContent = "";
            for (var i = 0; i < myVideos.length; i++) {
              infos.value += myVideos[i].duration + '\n';
            }
          }
        </script>